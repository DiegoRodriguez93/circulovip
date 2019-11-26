<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$query = mysqli_query($mysqli,"SELECT *
FROM transacciones AS t
INNER JOIN cupones_generados AS cg
ON t.id_cupon = cg.id_cupon
INNER JOIN comercios AS c
ON t.id_comercio = c.id_comercio
INNER JOIN usuarios AS u
ON t.id_user = u.id_user
;");

while($row = mysqli_fetch_array($query)){

    $id = $row['id_transaccion'];
    $fecha = $row['fecha'];
    $cedula = $row['usuario'];
    $name = $row['name'];
    $codigo = $row['codigo'];
    $monto = $row['monto'];

    $response[] = array($id, $fecha, $cedula, $name, $codigo, $monto);
}

echo '{"data":'. json_encode($response) . '}';

mysqli_close($mysqli);


?>