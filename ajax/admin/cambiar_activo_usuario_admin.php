<?php 

require '../_conexion.php';

$id     = mysqli_real_escape_string($mysqli,$_POST['id']);
$activo = mysqli_real_escape_string($mysqli,$_POST['activo']);

if($activo == 1){

$newactivo = 2;

}elseif($activo == 2){

$newactivo = 1;

}

$update = mysqli_query($mysqli,"UPDATE usuarios
SET activo = '$newactivo'
WHERE id = '$id' ;");

$res = array('result'=>'true');
echo json_encode($res);
mysqli_close($mysqli);

?>