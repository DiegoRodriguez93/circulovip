<?php 
header("Access-Control-Allow-Origin: *");
$monto = $_POST['monto'];
$id_comercio = $_POST['id_comercio'];
$cedula = $_POST['cedula']; 

require '_conexion.php';

//* CHEQUEAMOS SI EL COMERCIO TIENE EL MONTO PARA HACER ESTO

$query_monto_comercio = mysqli_query($mysqli,"SELECT id_comercio, monto FROM estado_de_cuenta_comercios WHERE id_comercio = '$id_comercio' ");

$row = mysqli_fetch_assoc($query_monto_comercio);

$monto_comercio = $row['monto'];

if($monto > $monto_comercio){

    $response = json_encode(array('result'=>false,
    'message'=>'No tiene monto suficiente para realizar esta transferencia, su monto actual son '.$monto_comercio));

    die($response);

}

//* COMPROBAMOS SI LA PERSONA CON ESA CEDULA SE CREO LA CUENTA

$query = mysqli_query($mysqli,"SELECT id_user, usuario, activo FROM usuarios WHERE activo = 1 AND usuario = '$cedula' ");

$contar = mysqli_num_rows($query);

if($contar == 1){

    $row_user = mysqli_fetch_assoc($query);
    //* EXTRAEMOS EL ID DE USARIO
    $id_user = $row_user['id_user'];

    //* COMPROBAMOS SI TIENE ESTADO DE CUENTA YA GENERADO

    $query_estado_socio = mysqli_query($mysqli,"SELECT id_user FROM estado_de_cuenta_usuarios WHERE id_user = '$id_user' ");

    $contar2 = mysqli_num_rows($query_estado_socio);

    if($contar2 == 1){
        //* ACREDITAMOS AL SOCIO CON ESTADO DE CUENTA CREADO
        $update_monto_socio = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
        SET monto = monto + '$monto'
        WHERE id_user = '$id_user' ");

        //* DESCONTAMOS EL DINERO AL COMERCIO
        $update_monto_comercio = mysqli_query($mysqli,"UPDATE estado_de_cuenta_comercios
        SET monto = monto - '$monto'
        WHERE id_comercio = '$id_comercio' ");

        $response = json_encode(array('result'=>true,
        'message'=>'Transacción realizada correctamente'));

        die($response); 

    }else{
        //* CREAMOS EL ESTADO DE CUENTA Y ACREDITAMOS AL SOCIO
        $insert_estado_de_cuenta_socio = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_usuarios (id_user, tipo_user, monto)
        VALUES ('$id_user', '2', '$monto') ");

                //* DESCONTAMOS EL DINERO AL COMERCIO
                $update_monto_comercio = mysqli_query($mysqli,"UPDATE estado_de_cuenta_comercios
                SET monto = monto - '$monto'
                WHERE id_comercio = '$id_comercio' ");

                $response = json_encode(array('result'=>true,
                'message'=>'Transacción realizada correctamente'));

                die($response); 
        

    }



}else{

    $response = json_encode(array('result'=>false,
    'message'=>'La persona con esa cedula no tiene cuenta asociada en el sistema'));

    die($response); 

}

mysqli_close($mysqli);

?>