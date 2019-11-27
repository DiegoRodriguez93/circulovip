<?php
header("Access-Control-Allow-Origin: *");

$id_cupon = $_POST['id_cupon'];

function confirmarTransaccion($id_cupon){

require '_conexion.php';

//* extraemos los datos del cupón para rellenar la transacción

$query = mysqli_query($mysqli,"SELECT id_cupon, descuento, id_user, id_comercio FROM cupones_generados WHERE id_cupon = '$id_cupon' ");

$contar = mysqli_num_rows($query);

if($contar == 0){

    $response = json_encode(array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde')) ;
    exit($response);

}

$row = mysqli_fetch_assoc($query);

$descuento   = $row['descuento'];
$id_user     = $row['id_user'];
$id_comercio = $row['id_comercio'];


/* CONSULTAMOS SI LA PERSONA TIENE MONTO MAYOR AL SALDO */

$hoy = date('Y-m-d');

$query_monto_socio = mysqli_query($mysqli,"SELECT sum(monto) as monto FROM estado_de_cuenta_usuarios WHERE id_user = '$id_user' and fecha_vencimiento > '$hoy' ");

$contar2 = mysqli_num_rows($query_monto_socio);

if($contar2 == 0){

    $response = array('result'=>false,'message'=>'La persona no tiene estado de cuenta activo');
    exit($response);

}

$row1 = mysqli_fetch_assoc($query_monto_socio);

$monto_socio = $row1['monto'];

if($monto_socio < $descuento){

    $response = array('result'=>false,'message'=>'La persona no tiene vidapesos suficientes');
    exit($response);

}

//* debitamos el monto del estado de cuenta

$query_debito_socio = mysqli_query($mysqli,"SELECT id_estado_de_cuenta_usuarios, monto FROM estado_de_cuenta_usuarios
WHERE id_user = '$id_user' and fecha_vencimiento > '$hoy' ORDER BY fecha_vencimiento DESC ");

$monto_a_debitar = $descuento;

while($rowDebito = mysqli_fetch_array($query_debito_socio)){

$id_estado_de_cuenta_usuarios = $rowDebito['id_estado_de_cuenta_usuarios'];
$monto = $rowDebito['monto'];

if($monto >= $monto_a_debitar){

    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
    SET monto = monto - '$monto_a_debitar'
    WHERE id_estado_de_cuenta_usuarios = '$id_estado_de_cuenta_usuarios' ");
    $monto_a_debitar = 0;
    break;
}else{
    $monto_a_debitar = $monto_a_debitar - $monto;
    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
    SET monto = 0
    WHERE id_estado_de_cuenta_usuarios = '$id_estado_de_cuenta_usuarios'
    ");

}

}

//* CALCULAMOS LA FECHA DE VENCIMIENTO PARA EL COMERCIO


$fecha = new DateTime('now');
$fecha_hoy = $fecha->format('Y-m-d');

$dia_de_hoy = $fecha->format('d');
$dias_de_este_mes = date("t", strtotime($fecha_hoy ));

$dias_restantes_para_fin_de_mes = $dias_de_este_mes - $dia_de_hoy  ;

$ultimo_dia_mes = date("Y-m-d", strtotime($fecha_hoy . "+ $dias_restantes_para_fin_de_mes day"));

$primer_dia_mes_siguiente = date("Y-m-d", strtotime($ultimo_dia_mes . "+ 1 day"));

$dias_del_mes_siguiente = date("t", strtotime($primer_dia_mes_siguiente ));

$ultimo_dia_mes_siguiente = date("Y-m-d", strtotime($ultimo_dia_mes . "+ $dias_del_mes_siguiente day"));

    //* COMPROBAMOS QUE EL COMERCIO TENGA ESTADO DE CUENTA CON ESA FECHA DE VENCIMIENTO

    $buscar_estado_de_cuenta_comercio = mysqli_query($mysqli,"SELECT * FROM estado_de_cuenta_comercios
     WHERE id_comercio = '$id_comercio' and fecha_vencimiento = '$ultimo_dia_mes_siguiente' ");

    $contar2 = mysqli_num_rows($buscar_estado_de_cuenta_comercio);

    //* CARGAMOS LA PLATITA AL COMERCIO

    if($contar2 == 1){
      $acreditar_comercio_update = mysqli_query($mysqli,"UPDATE estado_de_cuenta_comercios
      SET monto = monto + '$descuento'
      WHERE id_comercio = '$id_comercio' and fecha_vencimiento = '$ultimo_dia_mes_siguiente' ");
    }else{

    $acreditar_comercio_insert = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_comercios (id_comercio, monto, fecha_vencimiento)
    VALUES ('$id_comercio', '$descuento', '$ultimo_dia_mes_siguiente' )");

    }



//* Registramos la transacción

$insert_transaccion = mysqli_query($mysqli,"INSERT INTO transacciones (fecha, monto, id_user, id_comercio, id_cupon)
VALUES ('$fecha_hoy', '$descuento', '$id_user', '$id_comercio', '$id_cupon'  )");

if(!$insert_transaccion){
    $response = json_encode(array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde')) ;
    exit($response);
}

if($insert_transaccion){
    $response = json_encode(array('result'=>True,'message'=>'Transacción realizada correctamente')) ;
    exit($response);
}


}
