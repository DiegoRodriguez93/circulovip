<?php 

require '../../_conexion.php';

$id_user_emisor     = mysqli_real_escape_string($mysqli, $_POST['id_user_emisor']);
$id_user_receptor   = mysqli_real_escape_string($mysqli, $_POST['id_user_receptor']);
$mensaje            = mysqli_real_escape_string($mysqli, $_POST['mensaje']);

$fecha = date('Y-m-d H:i:s');

$insert = mysqli_query($mysqli, "INSERT INTO mensajes (id_emisor, id_receptor, mensaje, fecha, leido) VALUES
('$id_user_emisor', '$id_user_receptor', '$mensaje', '$fecha', 1) ");

if($insert){

    $res = array('result'=>true,'message'=>'Mensaje enviado correctamente');

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde!');

}

mysqli_close($mysqli);
echo json_encode($res);



?>