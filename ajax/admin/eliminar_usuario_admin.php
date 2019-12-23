<?php 

require '../_conexion.php';

$id = mysqli_real_escape_string($mysqli,$_POST['id']);

$delete = mysqli_query($mysqli,"DELETE FROM usuarios WHERE id = '$id' ;");

$res = array('result'=>'true');
echo json_encode($res);
mysqli_close($mysqli);

?>