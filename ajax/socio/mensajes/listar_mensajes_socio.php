<?php 

require '../../_conexion.php';

$id_receptor = $_GET['id_receptor'];

if(isset($_GET['limit']) AND $_GET['limit'] != '' AND $_GET['limit'] != null AND $_GET['limit'] == 5){
    $limit = 'limit 5';
}else{$limit = '';}

/* $query = mysqli_query($mysqli,"SELECT m.id_emisor as id_emisor, m.id_receptor, m.fecha as fecha,
m.leido as leido, d.url_avatar as url_avatar, u.nombre as nombre
FROM mensajes as m
LEFT JOIN datos_user as d ON d.id_user = m.id_emisor
INNER JOIN usuarios as u ON u.id = m.id_emisor
WHERE m.id_receptor = '$id_receptor' GROUP BY m.id_emisor ORDER BY m.fecha DESC LIMIT 1 "); */

/*  $query = mysqli_query($mysqli,"SELECT m.id_emisor as id_emisor, m.id_receptor, m.fecha as fecha,
m.leido as leido, d.url_avatar as url_avatar, u.nombre as nombre
FROM mensajes as m
LEFT JOIN datos_user as d ON d.id_user = m.id_emisor
INNER JOIN usuarios as u ON u.id = m.id_emisor
WHERE (m.id_receptor = '$id_receptor' OR m.id_emisor = '$id_receptor' ) AND m.id IN ( 
              SELECT max(id)
              FROM mensajes
              GROUP BY id_emisor
              ) $limit ");  */

$query = mysqli_query($mysqli,"SELECT
m.id_emisor AS id_emisor,
m.id_receptor,
m.fecha AS fecha,
m.leido AS leido,
d.url_avatar AS url_avatar,
u.nombre AS nombre
FROM
mensajes AS m
LEFT JOIN datos_user AS d ON d.id_user = m.id_emisor
INNER JOIN usuarios AS u ON u.id = m.id_emisor
WHERE
(
    m.id_receptor = '$id_receptor'
    OR (
        m.id_emisor = '$id_receptor'
        AND m.id_receptor NOT IN (
            SELECT
                id_receptor
            FROM
                mensajes
            WHERE
                id_emisor = m.id_emisor
        )
    )
)
AND m.id IN (
SELECT
    max(id)
FROM
    mensajes
GROUP BY
    id_emisor
) $limit ");

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
        $fecha_formateada = date("d/m/Y H:i", $time);
       }else{
        $fecha_formateada = null;  
       }

       if($row['leido'] == 1){
           $leido = '<i class="fas fa-envelope fa-2x" style="color: #6610f2"></i>';
        }else{
            $leido = '<i class="fas fa-envelope-open fa-2x" style="color: #95a5a6"></i>';
       }

       if($id_emisor == $id_receptor){
           $id_otro = $row['id_receptor'];
           $query2 = mysqli_query($mysqli, "SELECT u.nombre AS nombre, d.url_avatar AS url_avatar FROM usuarios as u 
           LEFT JOIN datos_user as d ON u.id = d.id_user WHERE u.id = '$id_otro'");
           $row2 = mysqli_fetch_assoc($query2);
           $nombre = $row2['nombre'];
           $url_avatar = $row2['url_avatar'];
       }else{
        $id_otro = $id_emisor;
       }

        $nombre_emisor_fn   = "<p class='pointer'
        onclick='cargarConversacion(`".$id_otro."`,`". $url_avatar."`,`". $nombre."`)'>". $nombre."</p>";

        $fecha_formateada_fn   = "<p class='pointer'
        onclick='cargarConversacion(`".$id_otro."`,`". $url_avatar."`,`".$nombre."`)'>".$fecha_formateada."</p>";

        $leido_fn   = "<p class='pointer'
        onclick='cargarConversacion(`".$id_otro."`,`". $url_avatar."`,`".$row['nombre']."`)'>".$leido."</p>";


        $res[] = array($img_avatar_fn, $nombre_emisor_fn, $leido_fn, $fecha_formateada_fn);
      /*   $res = array_unique($array); */
    }


}else{

    $res = array();

}

echo '{ "data": ' . json_encode($res) . ' }';
mysqli_close($mysqli);

?>