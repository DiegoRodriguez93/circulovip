<?php 
header("Access-Control-Allow-Origin: *");
require '../_conexion.php';

$query = mysqli_query($mysqli,"SELECT id, url_image, href, tipo, time FROM sponsors ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id           = $row['id'];
        $url_image              = $row['url_image'];
        $href           = $row['href'];
        $tipo           = $row['tipo'];
        $time           = $row['time'];

       $eliminar = '<button class="btn btn-danger" onclick="eliminarSponsor('.$id.')">
       <i class="fas fa-trash"></i></button>';


        $response[] = array($id, $url_image,  $href, $tipo, $time.' seg', $eliminar);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>