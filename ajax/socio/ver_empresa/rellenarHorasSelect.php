<?php 

require '../../_conexion.php';

$id_emisor = mysqli_real_escape_string($mysqli, $_POST['id_emisor']);
$id_receptor = mysqli_real_escape_string($mysqli, $_POST['id_receptor']);
$zona_horaria_emisor = mysqli_real_escape_string($mysqli, $_POST['zona_horaria_emisor']);

// EXTRAEMOS LA ZONA HORARIA RECEPTOR
$select = mysqli_query($mysqli, "SELECT zona_horaria FROM usuarios WHERE id = '$id_receptor' ");

$row = mysqli_fetch_assoc($select);
$zona_horaria_receptor = $row['zona_horaria'];




?>