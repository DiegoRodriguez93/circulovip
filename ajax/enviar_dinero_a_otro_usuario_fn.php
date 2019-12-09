<?php

header("Access-Control-Allow-Origin: *");

require '_conexion.php';

$cedula          = $mysqli->escape_string($_POST['cedula']);
$monto           = $mysqli->escape_string($_POST['monto']);
$id_user         = $mysqli->escape_string($_POST['id_user']);

enviarDinero($cedula, $monto, $id_user); //disparamos


function enviarDinero($cedula, $monto, $id_user){

    require '_conexion.php';

   /* CONSULTAMOS SI LA PERSONA TIENE MONTO MAYOR AL SALDO */

    $hoy = date('Y-m-d');

    $query_monto_socio = mysqli_query($mysqli,"SELECT sum(monto) as monto FROM estado_de_cuenta_usuarios WHERE id_user = '$id_user' and fecha_vencimiento >= '$hoy' ");

    $contar2 = mysqli_num_rows($query_monto_socio);

    if($contar2 == 0){

        $response = json_encode(array('result'=>false,'message'=>'No tienes vida pesos suficientes'));
        exit($response);

    }

    $row1 = mysqli_fetch_assoc($query_monto_socio);

    $monto_socio = $row1['monto'];

    if($monto_socio < $monto || $monto_socio == null ){

        $response = json_encode(array('result'=>false,'message'=>'No tienes vida pesos suficientes'));
        exit($response);

}


    $query2 = mysqli_query($mysqli,"SELECT id_user, usuario, activo, tipo FROM usuarios WHERE usuario = '$cedula' ");

    $contar3 = mysqli_num_rows($query2);

    if($contar3 == 0){

        $response = json_encode(array('result'=>false,'message'=>'Esa cédula no tiene cuenta activa en vida pesos'));
        exit($response);

    }
         /* EXTRAEMOS EL ID_USER DEL USUARIO A RECIBIR PLATA */

         $row2 = mysqli_fetch_assoc($query2);

         $id_user_a_recibir = $row2['id_user'];
         $tipo_user_a_recibir = $row2['tipo'];

         
                // insertamos la plata

                $hoy_mas_30_dias = date("Y-m-d", strtotime($hoy . "+ 30 day"));

                $insert1 = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_usuarios (id_user, tipo_user, monto, fecha_vencimiento)
                VALUES ('$id_user_a_recibir', '$tipo_user_a_recibir', '$monto', '$hoy_mas_30_dias');");    

                //* debitamos el monto del estado de cuenta

                    
                $query_debito_socio = mysqli_query($mysqli,"SELECT id_estado_de_cuenta_usuarios, monto FROM estado_de_cuenta_usuarios
                WHERE id_user = '$id_user' and fecha_vencimiento >= '$hoy' ORDER BY fecha_vencimiento ASC ");

                $monto_a_debitar = $monto;

                while($rowDebito = mysqli_fetch_array($query_debito_socio)){

                $id_estado_de_cuenta_usuarios = $rowDebito['id_estado_de_cuenta_usuarios'];
                $monto_2 = $rowDebito['monto'];

                if($monto_2 >= $monto_a_debitar){

                    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
                    SET monto = monto - '$monto_a_debitar'
                    WHERE id_estado_de_cuenta_usuarios = '$id_estado_de_cuenta_usuarios' ");
                    $monto_a_debitar = 0;
                    break;
                }else{
                    $monto_a_debitar = $monto_a_debitar - $monto_2;
                    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
                    SET monto = 0
                    WHERE id_estado_de_cuenta_usuarios = '$id_estado_de_cuenta_usuarios'
                    ");

                    }}
                    // fecha
                    $fecha = new DateTime('now');
                    $fecha_format = $fecha->format('Y-m-d H:i:s');

                        
                    // STRING RANDOM DE 8 CARACTERES
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 8 ; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }

            //* Registrar Transferencia de envio
            $crear_cupon = mysqli_query($mysqli,"INSERT INTO cupones_generados (fecha_vencimiento, descuento, id_user, id_comercio, codigo, disponible, id_user_2)
            VALUES ('$fecha_format', '$monto', '$id_user', '0', '$randomString', '0', '$id_user_a_recibir' );");

            $select_cupon = mysqli_query($mysqli,"SELECT MAX(id_cupon) as id_cupon FROM cupones_generados");

            $cupon = mysqli_fetch_assoc($select_cupon);

            $id_cupon = $cupon['id_cupon'];

            $insert1 = mysqli_query($mysqli,"INSERT INTO transacciones (fecha, id_user, id_comercio, id_cupon, monto, id_user_2)
            VALUES ('$fecha_format', '$id_user', '0', '$id_cupon', '$monto', '$id_user_a_recibir' );");  

            $crear_alerta = mysqli_query($mysqli,"INSERT INTO alerta_usuario ( id_usuario, alertado, tipo_alerta )
            VALUES ('$id_user_a_recibir', '0', '2' );");
                        
            $response = json_encode(array('result'=>true,'message'=>'Envio correcto!'));
            exit($response);



}