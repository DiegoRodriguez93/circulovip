<?php 

require '../../_conexion.php';

$id_empresa = mysqli_real_escape_string($mysqli, $_POST['id_empresa']);
$mensaje    = mysqli_real_escape_string($mysqli, $_POST['mensaje']);
$id_user_emisor    = mysqli_real_escape_string($mysqli, $_POST['id_user']);

$select = mysqli_query($mysqli, "SELECT id_user FROM datos_empresa WHERE id_empresa = '$id_empresa' ");

if(mysqli_num_rows($select) == 0){

    die(json_encode(array('result'=>false, 'message'=>'Ha ocurrido un error intenté más tarde')));

}

$row = mysqli_fetch_assoc($select);

$id_user_receptor = $row['id_user'];

$fecha = date('Y-m-d H:i:s');

$insert = mysqli_query($mysqli, "INSERT INTO mensajes (id_emisor, id_receptor, mensaje, fecha, leido) VALUES
('$id_user_emisor', '$id_user_receptor', '$mensaje', '$fecha', 1) ");

if($insert){

    die(json_encode(array('result'=>true, 'message'=>'Mensaje enviado correctamente')));

}else{

    die(json_encode(array('result'=>false, 'message'=>'Ha ocurrido un error intenté más tarde')));

}

mysqli_close($mysqli);

?>