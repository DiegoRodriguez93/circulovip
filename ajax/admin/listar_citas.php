<?php 
header("Access-Control-Allow-Origin: *");
require '../_conexion.php';

$query = mysqli_query($mysqli,"SELECT id_cita, id_emisor, id_receptor, dia_hora, estado FROM citas ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_cita           = $row['id_cita'];
        $fecha              = $row['dia_hora'];
        $id_emisor           = $row['id_emisor'];
        $id_receptor           = $row['id_receptor'];

        $select2 = mysqli_query($mysqli, "SELECT nombre FROM usuarios WHERE id = '$id_emisor' ");
        $select3 = mysqli_query($mysqli, "SELECT nombre FROM usuarios WHERE id = '$id_receptor' ");

        $row2 = mysqli_fetch_assoc($select2);
        $row3 = mysqli_fetch_assoc($select3);

        $es = $row['estado'];



    /*     $eliminar = '<button class="btn btn-danger" onclick="eliminarFecha('.$id_fecha.')"><i class="fas fa-trash"></i></button>'; */


        $response[] = array($id_cita, $fecha,  $row2['nombre'], $row3['nombre'], $es);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>