<?php 

require '_conexion.php';

$id_user = $_GET['id_user'];

$query = mysqli_query($mysqli,"SELECT monto, fecha_vencimiento from estado_de_cuenta_usuarios 
WHERE id_user = '$id_user' order by fecha_vencimiento asc ");

while($row = mysqli_fetch_array($query) ){

   $monto = $row['monto'];
   $fecha_vencimiento = $row['fecha_vencimiento']; 
   $fecha = date("d-m-Y", strtotime($fecha_vencimiento));

   $response[] = array('monto'=>$monto,'fecha_vencimiento'=>$fecha);
}

echo json_encode($response);

mysqli_close($mysqli);