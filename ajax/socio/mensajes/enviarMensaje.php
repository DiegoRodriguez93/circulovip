<?php 

require '../../_conexion.php';

$id_emisor      = $_POST['id_emisor'];
$id_receptor    = $_POST['id_receptor'];
$mensaje        = mysqli_real_escape_string($mysqli,$_POST['mensaje']);
$mensaje = htmlentities($mensaje);
        
$fecha = date('Y-m-d H:i:s');

$insert = mysqli_query($mysqli,"INSERT INTO mensajes (id_emisor, id_receptor, mensaje, fecha, leido)
VALUES ('$id_emisor', '$id_receptor', '$mensaje', '$fecha', '1') ;");

if($insert){

    echo json_encode(array('result'=>'true'));

}else{

    echo json_encode(array('result'=>'false'));

}

mysqli_close($mysqli);

?>