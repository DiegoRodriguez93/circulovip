<?php 

require '../_conexion.php';

$time = mysqli_real_escape_string($mysqli,$_POST['time']);

$update = mysqli_query($mysqli,"UPDATE sponsors
SET time = '$time' ");

if($update){

    $res = array('result'=>true,'message'=>'Tiempo actualizado correctamente');

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error!');

}

mysqli_close($mysqli);
echo json_encode($res);

?>