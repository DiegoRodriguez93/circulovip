<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT id_transaccion FROM transacciones WHERE id_comercio = '$id_comercio' ");

$query2 = mysqli_query($mysqli,"SELECT id_cupon FROM cupones_generados WHERE id_comercio = '$id_comercio' ");

$query3 = mysqli_query($mysqli,"SELECT id_cedula FROM cedulas_agregadas WHERE id_comercio = '$id_comercio' ");



$contar_descuentos = mysqli_num_rows($query);
$contar_ordenes    = mysqli_num_rows($query2);
$contar_cedulas    = mysqli_num_rows($query3);

$res = array('descuentos'=>$contar_descuentos,'ordenes'=>$contar_ordenes,'cedulas'=>$contar_cedulas);

echo json_encode($res);

mysqli_close($mysqli);


?>