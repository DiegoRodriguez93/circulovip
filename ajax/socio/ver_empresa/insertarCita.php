<?php 

require '../../_conexion.php';

$id_emisor  = mysqli_real_escape_string($mysqli, $_POST['id_emisor']);
$id_receptor = mysqli_real_escape_string($mysqli, $_POST['id_receptor']);
$dia = mysqli_real_escape_string($mysqli, $_POST['dia']);
$hora = mysqli_real_escape_string($mysqli, $_POST['hora']);

$s = $dia.' '.$hora.':00';
/* $s = strtotime($s); */
$dateTime = DateTime::createFromFormat( 'd/m/Y H:i:s', $s ); 

$date = $dateTime ->format('Y-m-d H:i:s');


$insert = mysqli_query($mysqli, "INSERT INTO citas (id_emisor, id_receptor, dia_hora, estado)
VALUES ('$id_emisor', '$id_receptor', '$date' , '2') ;");

if($insert){

    $res = array('result'=>true,'message'=>'Se ha solicitado la cita correctamente!');

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde!');

}

mysqli_close($mysqli);
echo json_encode($res);

?>