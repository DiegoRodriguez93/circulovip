<?php 
header("Access-Control-Allow-Origin: *");
require '../_conexion.php';

$query = mysqli_query($mysqli,"SELECT id, fecha FROM fechas_ronda ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_fecha           = $row['id'];
        $fecha              = $row['fecha'];

        $eliminar = '<button class="btn btn-danger" onclick="eliminarFecha('.$id_fecha.')"><i class="fas fa-trash"></i></button>';


        $response[] = array( $fecha,  $eliminar);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>