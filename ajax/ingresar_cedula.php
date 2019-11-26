<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$cedula         = $mysqli->escape_string($_POST['cedula']);
$name           = $mysqli->escape_string($_POST['name']);
$id_comercio    = $mysqli->escape_string($_POST['id_comercio']);

require '_conexion.php';

$query = mysqli_query($mysqli,"SELECT cedula FROM cedulas_agregadas WHERE cedula = '$cedula' ");

$contar = mysqli_num_rows($query);

if($contar > 0 ){

    $res = array('result'=>false,'message'=>'El cliente con esta cedula ya ha sido ingresado anteriormente');

}else{



$result = mysqli_query($mysqli,"INSERT INTO cedulas_agregadas ( cedula, id_comercio, name ) VALUES ( '$cedula', '$id_comercio', '$name' ) ;");

if($result){

    $res = array('result'=>true,'message'=>'Cliente añadido correctamente');

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde');

}

}

echo json_encode($res);
mysqli_close($mysqli);

?>