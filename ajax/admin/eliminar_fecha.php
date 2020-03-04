<?php 

require '../_conexion.php';

$id_fecha = mysqli_real_escape_string($mysqli,$_POST['id']);

$delete = mysqli_query($mysqli,"DELETE FROM fechas_ronda WHERE id = '$id_fecha' ;");

$res = array('result'=>true);
echo json_encode($res);
mysqli_close($mysqli);

?>