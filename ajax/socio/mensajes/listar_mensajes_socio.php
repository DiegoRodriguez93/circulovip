<?php 

require '../../_conexion.php';

$id_receptor = $_GET['id_receptor'];

$query = mysqli_query($mysqli,"SELECT m.id_emisor as id_emisor, m.id_receptor, m.fecha, m.leido as leido,
d.url_avatar as url_avatar, u.nombre as nombre
FROM mensajes as m
LEFT JOIN datos_user as d ON d.id_user = m.id_emisor
INNER JOIN usuarios as u ON u.id = m.id_emisor
WHERE m.id_receptor = '$id_receptor' GROUP BY m.id_emisor ORDER BY m.id DESC");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while($row = mysqli_fetch_array($query)){

        $id_emisor = $row['id_emisor'];
        $nombre    = $row['nombre'];
        $url_avatar = $row['url_avatar'];

        if($row['url_avatar'] == null){
            $url_avatar = 'http://localhost/circulovip2/images/profile.jpg';
        }

        if($row['url_avatar'] == null){
            $img_avatar = "<img
            class='img-fluild
            rounded-circle'
            width='40'
            height='40'
            src='http://localhost/circulovip2/images/profile.jpg' >"; 

            $img_avatar_fn = "<img
            onclick='cargarConversacion(`".$id_emisor."`,`".$url_avatar."`,`".$row['nombre']."`)'
            class='img-fluild
            rounded-circle pointer'
            width='40'
            height='40'
            src='http://localhost/circulovip2/images/profile.jpg' >"; 
        }else{
            $img_avatar = "<img
            class='img-fluild rounded-circle'
            width='40'
            height='40'
            src='".$url_avatar."' >";

            $img_avatar_fn = "<img
            onclick='cargarConversacion(`".$id_emisor."`,`".$url_avatar."`,`".$row['nombre']."`)'
            class='img-fluild rounded-circle pointer'
            width='40'
            height='40'
            src='".$url_avatar."' >";
        }

       $fecha           = $row['fecha'];

       if($fecha != null){
        $time = strtotime($fecha);
        $fecha_formateada = date("d/m/Y H:i:s", $time);
       }else{
        $fecha_formateada = null;  
       }

        $nombre_emisor_fn   = "<p class='pointer'
        onclick='cargarConversacion(`".$id_emisor."`,`". $url_avatar."`,`". $nombre."`)'>". $nombre."</p>";

        $fecha_formateada_fn   = "<p class='pointer'
        onclick='cargarConversacion(`".$id_emisor."`,`". $url_avatar."`,`".$nombre."`)'>".$fecha_formateada."</p>";

        $leido_fn   = "<p class='pointer'
        onclick='cargarConversacion(`".$id_emisor."`,`". $url_avatar."`,`".$row['nombre']."`)'>".$row['leido']."</p>";


        $res[] = array($img_avatar_fn, $nombre_emisor_fn, $leido_fn, $fecha_formateada_fn);

    }


}else{

    $res = array();

}

echo '{ "data": ' . json_encode($res) . ' }';
mysqli_close($mysqli);

?>