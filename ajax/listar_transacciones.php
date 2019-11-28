<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT t.id_transaccion,t.monto, u.usuario, c.codigo, us.usuario as usuario_2, t.fecha
FROM transacciones AS t
LEFT JOIN usuarios AS u ON t.id_user = u.id_user
LEFT JOIN cupones_generados AS c ON t.id_cupon = c.id_cupon
LEFT JOIN usuarios AS us ON t.id_user_2 = us.id_user
WHERE t.id_comercio = '$id_comercio'
");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $codigo         = $row['codigo'];
        $usuario        = $row['usuario'];
        $usuario_2        = $row['usuario_2'];
        $fecha          = $row['fecha'];
        $monto          = $row['monto'];
        $id_transaccion = $row['id_transaccion'];

        if($usuario != null){
            $string = $usuario;
            $tipo   = 'Descuento';
        }else{
            $string = $usuario_2;
            $monto  = '-'.$monto;
            $tipo   = 'Transferencia';
        }

        $replacement = '-';

        $cedula = substr_replace($string, $replacement, 7, 0);
    
        $response[] = array($id_transaccion, $fecha, $cedula, $tipo, $codigo, $monto);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>