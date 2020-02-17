<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$zona_horaria = mysqli_real_escape_string($mysqli, $_POST['zona_horaria']);

$select = mysqli_query($mysqli, "SELECT * FROM citas 
WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') ");


?>