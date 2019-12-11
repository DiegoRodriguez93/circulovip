<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

if(isset($_GET['startDate']) AND $_GET['startDate'] != ''){
    $startDate = $_GET['startDate'];
}

if(isset($_GET['endDate']) AND $_GET['endDate'] != ''){
    $endDate = $_GET['endDate'];
}

if(isset($startDate) AND isset($endDate)){

    $filtrar = " WHERE fecha >= '$startDate' and fecha <= '$endDate' ";

}else{

    $filtrar = '';

}

$query = mysqli_query($mysqli,"SELECT * FROM transacciones2_view $filtrar ");

$contar = mysqli_num_rows($query);

if($contar != 0){
    while($row = mysqli_fetch_array($query)){

        $id = $row['id_transaccion'];
        $envia = $row['envia'];
        $fecha = $row['fecha'];
        $monto = $row['monto'];
        $codigo = $row['codigo_cupon'];
        $recibe = $row['recibe'];
    
        $response[] = array($id, $envia, $fecha, $monto, $codigo, $recibe, $contar);
    }
    
   
    
}else{

    $response = array();

}

echo '{"data":'. json_encode($response) . '}';
mysqli_close($mysqli);


?>