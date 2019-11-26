<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$ci             = $_POST['cedula'];
$id_comercio    = $_POST['id_comercio'];
$monto          = $_POST['monto'];

/*  BUSCAMOS SI LA CEDULA EXISTE */ 

$query_cedula_socio = mysqli_query($mysqli,"SELECT id_user ,usuario FROM usuarios WHERE usuario = '$ci' ");

$contar1 = mysqli_num_rows($query_cedula_socio);

/* CONSULTAMOS SI LA PERSONA TIENE MONTO MAYOR AL SALDO */

$user = $query_cedula_socio->fetch_assoc();

$id_user = $user['id_user'];

$query_monto_socio = mysqli_query($mysqli,"SELECT monto FROM estado_de_cuenta_usuarios WHERE id_user = '$id_user' ");

$contar2 = mysqli_num_rows($query_monto_socio);

if($contar1 == 0){

    $response = array('result'=>false,'message'=>'La persona con esa cédula no tiene cuenta registrada');

}elseif($contar2 > 0){



}

?>