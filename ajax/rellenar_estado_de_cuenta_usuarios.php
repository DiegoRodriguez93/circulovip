<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_user = $_GET['id_user'];

$hoy = date('Y-m-d');

$query = mysqli_query($mysqli,"SELECT sum(monto) as monto FROM estado_de_cuenta_usuarios WHERE id_user = '$id_user' and fecha_vencimiento < '$hoy' ");

$contar_resultados= mysqli_num_rows($query);

if($contar_resultados > 0){

    $row = mysqli_fetch_assoc($query);

    $monto = $row['monto'];

    $response = array('result'=>true,'monto'=>$monto );

}else{

    $response = array('result'=>true,'monto'=>'0' );

}

echo json_encode($response);
mysqli_close($mysqli);


?>