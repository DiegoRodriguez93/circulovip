<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT sum(monto) as monto, fecha_vencimiento from estado_de_cuenta_comercios
WHERE id_comercio = '$id_comercio' AND monto > 0 group by fecha_vencimiento order by fecha_vencimiento asc ");

$contar = mysqli_num_rows($query);

if($contar > 0){

   while($row = mysqli_fetch_array($query) ){

      $monto = $row['monto'];
      $fecha_vencimiento = $row['fecha_vencimiento']; 
      $fecha = date("d-m-Y", strtotime($fecha_vencimiento));
   
      $response[] = array('monto'=>$monto,'fecha_vencimiento'=>$fecha);
   }

}else{

   $response = array();

}



echo json_encode($response);

mysqli_close($mysqli);