<?php 

require '../../_conexion.php';

$id_receptor = $_GET['id_receptor'];

$query = mysqli_query($mysqli,"SELECT m.id_emisor, m.id_receptor, m.fecha, sum(m.leido) as leido,
d.nombres as nombre_emisor,d.apellidos as apellido_emisor, d.url_avatar as url_avatar
FROM mensajes as m
LEFT JOIN datos_user as d ON d.id_user = m.id_emisor
 WHERE m.id_receptor = '$id_receptor' ORDER BY id DESC ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while($row = mysqli_fetch_array($query)){

        if($row['url_avatar'] == null){
            $img_avatar = "<img class='img-fluild' width='40' height='40' src='http://localhost/circulovip/images/profile.jpg' >"; 
        }else{
            $img_avatar = "<img class='img-fluild' width='40' height='40' src='".$row['url_avatar']."' >";
        }

       $nombre_emisor = $row['nombre_emisor'] . ' ' . $row['apellido_emisor']; 
       $fecha       = $row['fecha'];
       $leido       = $row['leido']; 

       if($fecha != null){
        $time = strtotime($fecha);
        $fecha_formateada = date("d/m/Y H:i:s", $time);
       }else{
        $fecha_formateada = null;  
       }

        $res[] = array($img_avatar, $nombre_emisor, $leido, $fecha_formateada,);

    }


}else{

    $res = array();

}

echo '{ "data": ' . json_encode($res) . ' }';
mysqli_close($mysqli);

?>