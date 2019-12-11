<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';


$query = mysqli_query($mysqli,"SELECT * FROM estado_de_cuenta_usuarios_view ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_user        = $row['id_user'];
        $cedula         = $row['cedula'];
        $name           = $row['name'];
        $email          = $row['email'];
        $phone          = $row['phone'];
        $tipo           = $row['tipo'];
        $fecha_registro           = $row['fecha_registro'];
        $disponible     = $row['disponible'];

        if($tipo == 1){
            $tipo_string = 'Socio de vida';
        }else{
            $tipo_string = 'No es socio de vida';
        }
    
        $response[] = array($id_user, $cedula, $name, $email, $phone, $tipo_string, $fecha_registro, $disponible);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>