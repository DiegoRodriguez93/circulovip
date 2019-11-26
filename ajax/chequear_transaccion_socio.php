<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

date_default_timezone_set('America/Montevideo');
$fecha_actual = new DateTime('now');
$fecha_formateada = $fecha_actual->format('Y-m-d H:i:s');

$id_user = $_POST['id_user'];

$query = mysqli_query($mysqli,"SELECT id_user, fecha_vencimiento, id_cupon, disponible FROM cupones_generados WHERE id_user = '$id_user' 
AND fecha_vencimiento >= '$fecha_formateada' AND disponible = 1  ");

$contar = mysqli_num_rows($query);

if($contar == 1 ){

while($row = mysqli_fetch_array($query) ){

    $id_cupon = $row['id_cupon'];

    $response = array('result'=>true,'id_cupon'=>$id_cupon);

}

}else{

    $response = array('result'=>false,'message'=>'No hay transacciones activas en este momento');

}

echo json_encode($response);
mysqli_close($mysqli);

?>