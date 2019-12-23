<?php 
header("Access-Control-Allow-Origin: *");
require '../_conexion.php';


$query = mysqli_query($mysqli,"SELECT id, email, pass, activo, fecha_registro, hash FROM usuarios ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_user          = $row['id'];
        $fecha_registro   = $row['fecha_registro'];
        $email            = $row['email'];
        $pass             = $row['pass'];
        $activo           = $row['activo'];


        if($activo == 1){
            $activo2 = 'Si '. '<button class="btn btn-primary" onclick="cambiarActivoUsuario(`'.$id_user.'`,`1`)"><i class="fas fa-exchange-alt"></i></button>';
        }else{
            $activo2 = 'No '. '<button class="btn btn-primary" onclick="cambiarActivoUsuario(`'.$id_user.'`,`2`)"><i class="fas fa-exchange-alt"></i></button>';;
        }

        $eliminar = '<button class="btn btn-danger" onclick="eliminarUsuario('.$id_user.')"><i class="fas fa-trash"></i></button>';
    
        $response[] = array($id_user,$fecha_registro,  $email, $pass, $activo2,  $eliminar);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>