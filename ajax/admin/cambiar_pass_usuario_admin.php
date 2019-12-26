<?php 

require '../_conexion.php';

$id     = mysqli_real_escape_string($mysqli,$_POST['id']);
$pass   = $mysqli->escape_string(password_hash($_POST['pass'], PASSWORD_BCRYPT));

$update = mysqli_query($mysqli,"UPDATE usuarios
SET pass = '$pass'
WHERE id = '$id' ;");

$res = array('result'=>'true');
echo json_encode($res);
mysqli_close($mysqli);

?>