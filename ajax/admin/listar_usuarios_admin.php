<?php 
header("Access-Control-Allow-Origin: *");
require '../_conexion.php';

$query = mysqli_query($mysqli,"SELECT id, nombre, email, activo, fecha_registro, fecha_vencimiento, hash, zona_horaria FROM usuarios ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_user            = $row['id'];
        $nombre             = $row['nombre'];
        $email              = $row['email'];
        $activo             = $row['activo'];
        $fecha_vencimiento  = $row['fecha_vencimiento'];
        $fecha_vencimiento = date_format (new DateTime($fecha_vencimiento), 'd-m-Y');

        $fecha_vencimiento_and_btn = $fecha_vencimiento . 
        ' <button class="btn btn-primary" onclick="editarVencimiento(`'.$id_user.'`)"><i class="fas fa-pen"></i></button> ' ;

        $editarpass = '<button class="btn btn-warning" onclick="cambiarPass(`'.$id_user.'`)"><i class="fas fa-lock"></i></button>';


        if($activo == 1){
            $activo2 = 'Si '. '<button class="btn btn-primary" onclick="cambiarActivoUsuario(`'.$id_user.'`,`1`)"><i class="fas fa-exchange-alt"></i></button>';
        }else{
            $activo2 = 'No '. '<button class="btn btn-primary" onclick="cambiarActivoUsuario(`'.$id_user.'`,`2`)"><i class="fas fa-exchange-alt"></i></button>';;
        }

        $eliminar = '<button class="btn btn-danger" onclick="eliminarUsuario('.$id_user.')"><i class="fas fa-trash"></i></button>';
    
        $zona_horaria = 'GMT'.$row['zona_horaria'];

        $response[] = array( $id_user, $nombre,
          $email, $editarpass, $activo2, $zona_horaria, $fecha_vencimiento_and_btn,  $eliminar);
    
    }
    echo '{ "data" : ' . json_encode($response) . '}' ;

}else{

    echo '{ "data": [] }';

}

mysqli_close($mysqli);

?>