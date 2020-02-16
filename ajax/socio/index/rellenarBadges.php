<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);

$select_solicitadas = mysqli_query($mysqli, "SELECT COUNT(id_cita) as citas_solicitadas 
FROM citas WHERE id_emisor = '$id_user' ");

$select_confirmadas = mysqli_query($mysqli, "SELECT COUNT(id_cita) AS citas_confirmadas 
FROM citas WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') AND estado = 1 ");

$select_rechazadas = mysqli_query($mysqli, "SELECT COUNT(id_cita) AS citas_rechazadas
FROM citas WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') AND estado = 0 ");

$select_mensajes = mysqli_query($mysqli,"SELECT COUNT(id) AS mensajes FROM mensajes
WHERE id_emisor = '$id_user' OR id_receptor = '$id_user' ");

$row    = mysqli_fetch_assoc($select_solicitadas);
$row2   = mysqli_fetch_assoc($select_confirmadas);
$row3   = mysqli_fetch_assoc($select_rechazadas);
$row4   = mysqli_fetch_assoc($select_mensajes);

$res = array('citas_solicitadas'=>$row['citas_solicitadas'],
'citas_confirmadas'=>$row2['citas_confirmadas'],
'citas_rechazadas'=>$row3['citas_rechazadas'],
'mensajes'=>$row4['mensajes'],
);

echo json_encode($res);
mysqli_close($mysqli);


?>