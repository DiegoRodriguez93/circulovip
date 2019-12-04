<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_user = $_GET['id_user'];

$query = mysqli_query($mysqli,"SELECT t.fecha, t.id_user, t.id_comercio, t.id_cupon, t.monto, c.name, cg.codigo, u.`name` as name_persona, t.id_user_2, us.name as name_2
FROM transacciones AS t
LEFT JOIN comercios AS c ON t.id_comercio = c.id_comercio
LEFT JOIN cupones_generados AS cg ON t.id_cupon = cg.id_cupon
LEFT JOIN usuarios AS u ON u.id_user = t.id_user_2
LEFT JOIN usuarios AS us ON us.id_user = t.id_user
WHERE t.id_user = '$id_user' OR t.id_user_2 = '$id_user'
");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id    = $row['id_user'];
        $id_2    = $row['id_user_2'];
        $fecha = $row['fecha'];
        $name  = $row['name'];
        $tipo  = 'Descuento en comercio';

        if($name == null && $id == $id_user){
            $name = $row['name_persona'];
            $tipo = 'Transferencia a otra persona';
        }
        
        if($name == null && $id_2 == $id_user){
            $tipo = 'Transferencia recibida';
            $name = $row['name_2'];

        }



        $codigo         = $row['codigo'];

        if($id == $id_user){
            $monto          = '-'.$row['monto'];  
        }else{
            $monto          = $row['monto'];
        }

        if($name != null && $row['name_2'] == null && $monto >= 0){
            $tipo = 'Transferencia de un comercio';
        }

        
    
        $response[] = array($fecha, $name, $tipo, $codigo, $monto);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>