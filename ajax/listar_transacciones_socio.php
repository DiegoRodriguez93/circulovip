<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_user = $_GET['id_user'];

$query = mysqli_query($mysqli,"SELECT t.fecha, t.id_user, t.id_comercio, t.id_cupon, t.monto, c.name, cg.codigo
FROM transacciones AS t
INNER JOIN comercios AS c ON t.id_comercio = c.id_comercio
INNER JOIN cupones_generados AS cg ON t.id_cupon = cg.id_cupon
WHERE t.id_user = '$id_user'
");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $fecha          = $row['fecha'];
        $name_comercio  = $row['name'];
        $codigo         = $row['codigo'];
        $monto          = $row['monto'];
    
        $response[] = array($fecha, $name_comercio, $codigo, $monto);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>