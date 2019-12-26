<?php 

require '../_conexion.php';

$id     = mysqli_real_escape_string($mysqli,$_POST['id']);
$fecha_vencimiento     = mysqli_real_escape_string($mysqli,$_POST['fecha_vencimiento']);

$update = mysqli_query($mysqli,"UPDATE usuarios
SET fecha_vencimiento = '$fecha_vencimiento'
WHERE id = '$id' ;");

$res = array('result'=>'true');
echo json_encode($res);
mysqli_close($mysqli);

?>