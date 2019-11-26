<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_cupon = $_POST['id_cupon'];

//* extraemos los datos del cupón para rellenar la transacción

$query = mysqli_query($mysqli,"SELECT id_cupon, descuento, id_user, id_comercio FROM cupones_generados WHERE id_cupon = '$id_cupon' ");

$contar = mysqli_num_rows($query);

if($contar > 0){

   $row = mysqli_fetch_assoc($query);

   $descuento   = $row['descuento'];
   $id_user     = $row['id_user'];
   $id_comercio = $row['id_comercio'];


   //* Creamos la fecha
   date_default_timezone_set('America/Montevideo');
   $fecha = new DateTime('now');
   $fecha_hoy = $fecha->format('Y-m-d H:i:s');

  //* Registramos la transacción

  $insert_transaccion = mysqli_query($mysqli,"INSERT INTO transacciones (fecha, monto, id_user, id_comercio, id_cupon)
  VALUES ('$fecha_hoy', '$descuento', '$id_user', '$id_comercio', '$id_cupon'  )");

  if($insert_transaccion){

    

    //* debitamos el monto del estado de cuenta
    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
    SET monto = monto - '$descuento'
    WHERE id_user = '$id_user' ");

    //* COMPROBAMOS QUE EL COMERCIO TENGA ESTADO DE CUENTA

    $buscar_estado_de_cuenta_comercio = mysqli_query($mysqli,"SELECT * FROM estado_de_cuenta_comercios WHERE id_comercio = '$id_comercio' ");

    $contar2 = mysqli_num_rows($buscar_estado_de_cuenta_comercio);

    //* CARGAMOS LA PLATITA AL COMERCIO

    if($contar2 == 1){
      $acreditar_comercio = mysqli_query($mysqli,"UPDATE estado_de_cuenta_comercios
      SET monto = monto + '$descuento'
      WHERE id_comercio = '$id_comercio' ");
    }else{

    $insert_transaccion = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_comercios (id_comercio, monto)
    VALUES ('$id_comercio', '$descuento' )");

    }

    

    if($debito AND $acreditar_comercio ){

      //* ACTUALIZAMOS EL CUPÓN A NO DISPONIBLE

      $update_cupon_to_nodisponible = mysqli_query($mysqli,"UPDATE cupones_generados
      SET disponible = 0
      WHERE id_cupon = '$id_cupon'");

      //* GENERAMOS LA ALERTA PARA EL COMERCIO

      $alerta_comercio = mysqli_query($mysqli,"INSERT INTO alerta_comercio (id_comercio, alertado)
      VALUES ('$id_comercio', '0') ");

        $response = array('result'=>true,'message'=>'Transacción realizado con exito');

    }else{

      $response = array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde');

    }


    

  }else{

    $response = array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde');

  }

}else{

  $response = array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde');

}

echo json_encode($response);
mysqli_close($mysqli);


?>