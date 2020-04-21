<?php 

require '../_conexion.php';

$email = mysqli_real_escape_string($mysqli,$_POST['email']);

$select = mysqli_query($mysqli,"SELECT email FROM usuarios WHERE email = '$email' ");

if(mysqli_num_rows($select) > 0){

    $res = array('result'=>true,'message'=>'Se ha enviado un correo para recuperar la contraseña, revise la bandeja de spam');

}else{

    $res = array('result'=>false,'message'=>'No hay ningun correo electrónico registrado con esa dirección');

}

mysqli_close($mysqli);
echo json_encode($res);

?>