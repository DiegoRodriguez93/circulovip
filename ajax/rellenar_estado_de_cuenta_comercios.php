<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT monto, id_comercio FROM estado_de_cuenta_comercios WHERE id_comercio = '$id_comercio' ");

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