<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT * FROM cedulas_agregadas WHERE id_comercio = '$id_comercio' ");

$contar_filas = mysqli_num_rows($query);

if($contar_filas > 0){

    while($row = mysqli_fetch_array($query)){

        $cedula         = $row['cedula'];
        $name           = $row['name'];
        $button         = '<button onclick="transferir('.$cedula.',`'.$name.'`)" class="btn btn-success btn-sm">Transferir $</button>';
    
        $response[] = array($cedula, $name, $button) ;
    }

    
    echo '{ "data" : ' . json_encode($response) . '}' ;


}else{

    echo '{ "data": [] }';
}

mysqli_close($mysqli);

?>