<?php 

require '../../_conexion.php';

$id_producto = mysqli_real_escape_string($mysqli,$_POST['id_producto']);

$delete = mysqli_query($mysqli,"DELETE FROM productos WHERE id_producto = '$id_producto' ");

if($delete){

$res = array('result'=>true);
die(json_encode($res));

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde');
    die(json_encode($res));

}

mysqli_close($mysqli);

?>