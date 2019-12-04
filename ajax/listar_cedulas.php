<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_comercio = $_GET['id_comercio'];

$query = mysqli_query($mysqli,"SELECT * FROM cedulas_agregadas WHERE id_comercio = '$id_comercio' ");

$contar_filas = mysqli_num_rows($query);

if($contar_filas > 0){

    while($row = mysqli_fetch_array($query)){

        $id             = $row['id_cedula'];
        $cedula         = $row['cedula'];
        $name           = $row['name'];
        $btn_tranferir  = '<button onclick="transferir('.$cedula.',`'.$name.'`)" class="btn btn-success btn-sm">Transferir $</button>';
        $btn_eliminar   = '<button onclick="eliminar('.$id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>';
    
        $response[] = array($cedula, $name, $btn_tranferir, $btn_eliminar) ;
    }

    
    echo '{ "data" : ' . json_encode($response) . '}' ;


}else{

    echo '{ "data": [] }';
}

mysqli_close($mysqli);

?>