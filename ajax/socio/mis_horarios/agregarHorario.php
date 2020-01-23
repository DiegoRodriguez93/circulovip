<?php

require '../../_conexion.php';

$lunes      = mysqli_real_escape_string($mysqli, $_POST['lunes']);
$martes     = mysqli_real_escape_string($mysqli, $_POST['martes']);
$miercoles  = mysqli_real_escape_string($mysqli, $_POST['miercoles']);
$jueves     = mysqli_real_escape_string($mysqli, $_POST['jueves']);
$viernes    = mysqli_real_escape_string($mysqli, $_POST['viernes']);
$sabado     = mysqli_real_escape_string($mysqli, $_POST['sabado']);
$domingo    = mysqli_real_escape_string($mysqli, $_POST['domingo']);
$hora       = mysqli_real_escape_string($mysqli, $_POST['hora']);
$id_user    = mysqli_real_escape_string($mysqli, $_POST['id_user']);

$id_dia = '';

if($lunes == '1')       {$id_dia .= '1'; }else{ $id_dia .= '';}
if($martes == '1')      {$id_dia .= '2'; }else{ $id_dia .= '';}
if($miercoles == '1')   {$id_dia .= '3'; }else{ $id_dia .= '';}
if($jueves == '1')      {$id_dia .= '4'; }else{ $id_dia .= '';}
if($viernes == '1')     {$id_dia .= '5'; }else{ $id_dia .= '';}
if($sabado == '1')      {$id_dia .= '6'; }else{ $id_dia .= '';}
if($domingo == '1')     {$id_dia .= '7'; }else{ $id_dia .= '';}

$insert = mysqli_query($mysqli, "INSERT INTO horarios (id_dia, hora, id_user)
 VALUES ('$id_dia', '$hora' , '$id_user')");

 if($insert){

    $res = array('result'=>true,'message'=>'Se ha ingresado el horario correctamente');

 }else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde');

 }

 echo json_encode($res);
 mysqli_close($mysqli);



?>