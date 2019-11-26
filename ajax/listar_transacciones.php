<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT c.codigo, u.usuario, t.fecha,  t.monto, t.id_transaccion, t.id_comercio
FROM transacciones AS t
INNER JOIN usuarios AS u ON t.id_user = u.id_user
INNER JOIN cupones_generados AS c ON t.id_cupon = c.id_cupon
WHERE t.id_comercio = '$id_comercio'
");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $codigo         = $row['codigo'];
        $usuario        = $row['usuario'];
        $fecha          = $row['fecha'];
        $monto          = $row['monto'];
        $id_transaccion = $row['id_transaccion'];

        $string = $usuario;
        $replacement = '-';

        $cedula = substr_replace($string, $replacement, 7, 0);
    
        $response[] = array($id_transaccion, $fecha, $cedula, $codigo, $monto);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>