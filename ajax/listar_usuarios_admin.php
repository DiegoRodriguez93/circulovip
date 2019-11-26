<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';


$query = mysqli_query($mysqli,"SELECT id_user, usuario as cedula, email, name, phone, tipo FROM usuarios ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_user         = $row['id_user'];
        $cedula        = $row['cedula'];
        $email          = $row['email'];
        $name    = $row['name'];
        $phone          = $row['phone'];
        $tipo = $row['tipo'];

        if($tipo == 1){
            $tipo_string = 'Usuario de vida';
        }else{
            $tipo_string = 'Agregado por comercio';
        }
    
        $response[] = array($id_user, $cedula, $email, $name, $phone, $tipo_string);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>