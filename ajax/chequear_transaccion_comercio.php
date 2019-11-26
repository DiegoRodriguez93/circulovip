<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

date_default_timezone_set('America/Montevideo');
$fecha_actual = new DateTime('now');
$fecha_formateada = $fecha_actual->format('Y-m-d H:i:s');

$id_comercio = $_POST['id_comercio'];

$query = mysqli_query($mysqli,"SELECT *
FROM alerta_comercio
WHERE id_comercio = '$id_comercio' 
AND alertado = 0  ");

$contar = mysqli_num_rows($query);

if($contar > 0 ){

$row = mysqli_fetch_assoc($query);

$id     = $row['id'];

$update = mysqli_query($mysqli,"UPDATE alerta_comercio
SET alertado = 1
WHERE id = '$id' ");

$response = array('result'=>true);

}else{

    $response = array('result'=>false,'message'=>'No hay transacciones activas en este momento');

}

echo json_encode($response);
mysqli_close($mysqli);

?>