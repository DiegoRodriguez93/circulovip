<?php 
header("Access-Control-Allow-Origin: *");
$ci             = $_POST['cedula'];
$id_comercio    = $_POST['id_comercio'];
$monto          = $_POST['monto'];

comprobarTransaccion($ci, $id_comercio, $monto); //disparamos la función

function comprobarTransaccion($ci, $id_comercio, $monto){

require '_conexion.php';

/*  BUSCAMOS SI LA CEDULA EXISTE */ 

$query_cedula_socio = mysqli_query($mysqli,"SELECT id_user ,usuario FROM usuarios WHERE usuario = '$ci' ");

$contar1 = mysqli_num_rows($query_cedula_socio);

if($contar1 == 0){
 $response = json_encode(array('result'=>false,'message'=>'La persona con esa cédula no tiene cuenta registrada')) ;
 exit($response);
}

/* CONSULTAMOS SI LA PERSONA TIENE MONTO PARA PAGAR */

$user = $query_cedula_socio->fetch_assoc();

$id_user = $user['id_user'];

$query_monto_socio = mysqli_query($mysqli,"SELECT monto FROM estado_de_cuenta_usuarios WHERE id_user = '$id_user' ");

$contar2 = mysqli_num_rows($query_monto_socio);

if($contar2 == 0){

    $response = json_encode(array('result'=>false,'message'=>'La persona con esa cédula no tiene monto disponible')) ;
    exit($response);

}else{

    $estado = $query_monto_socio->fetch_assoc();  

    $monto_usuario = $estado['monto'];

    if($monto_usuario > $monto){

        // CREAMOS EL CUPÓN DE TRANSACCIÓN

        // FECHA DE VENCIMIENTO
        date_default_timezone_set('America/Montevideo');
        $fecha = new DateTime();
        $fecha->modify('+10 minute'); // VENCIMIENTO 10 MINUTOS
        $fecha_vencimiento = $fecha->format('Y-m-d H:i:s');
    
        // STRING RANDOM DE 8 CARACTERES
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8 ; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $query_ingresar_cupon = mysqli_query($mysqli,"INSERT INTO cupones_generados (fecha_vencimiento, descuento, id_user, id_comercio, codigo, disponible)
        VALUES ('$fecha_vencimiento','$monto', '$id_user', '$id_comercio', '$randomString', 1) ");

        if($query_ingresar_cupon){
            // everything okay
        $response = json_encode(array('result'=>true,'message'=>'Se puedo realizar la transacción correctamente!')) ;
        exit($response);

        }else{
            $response = json_encode(array('result'=>false,'message'=>'Ha ocurrido un error, intenté de nuevo!')) ;
            exit($response);
        }
    }else{

        $response = json_encode(array('result'=>false,'message'=>'La persona con esa cédula no tiene monto disponible')) ;
        exit($response);  

    }
}
}