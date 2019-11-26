<?php 

$host = 'localhost';
$user = 'root';
$pass = 'sist.2k8';
$db =   'vidapesos';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_hoy = date('Y/m/d');
$fecha_mañana = date("Y/m/d", strtotime($fecha_hoy . "+ 24 hours"));

$fecha_carga = substr($fecha_mañana,8);

if($fecha_carga = '01'){

$update_dinero = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
SET monto = 1000
WHERE tipo_user = 1 ");

}

mysqli_close($mysqli);

?>