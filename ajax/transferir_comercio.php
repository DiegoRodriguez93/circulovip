<?php 
header("Access-Control-Allow-Origin: *");
$monto = $_POST['monto'];
$id_comercio = $_POST['id_comercio'];
$cedula = $_POST['cedula']; 

transferir_comercio_usuario($monto, $id_comercio, $cedula);//disparamos

function transferir_comercio_usuario($monto, $id_comercio, $cedula){

    require '_conexion.php';

    $hoy = date('Y-m-d');

//* CHEQUEAMOS SI EL COMERCIO TIENE EL MONTO PARA HACER ESTO

$query_monto_comercio = mysqli_query($mysqli,"SELECT sum(monto) as monto FROM estado_de_cuenta_comercios 
WHERE id_comercio = '$id_comercio' and fecha_vencimiento >= '$hoy' ");

$row = mysqli_fetch_assoc($query_monto_comercio);

$monto_comercio = $row['monto'];

if($monto > $monto_comercio){

    $response = json_encode(array('result'=>false,
    'message'=>'No tiene monto suficiente para realizar esta transferencia, su monto actual son '.$monto_comercio));

    exit($response);

}

//* COMPROBAMOS SI LA PERSONA CON ESA CEDULA SE CREO LA CUENTA

$query = mysqli_query($mysqli,"SELECT id_user, usuario, activo, tipo FROM usuarios WHERE activo = 1 AND usuario = '$cedula' ");

$contar = mysqli_num_rows($query);

if($contar != 1){

    $response = json_encode(array('result'=>false,
    'message'=>'La persona con esa cedula no tiene cuenta asociada en el sistema'));

exit($response);   }


    //* EXTRAEMOS EL ID DE USARIO y EL TIPO
    $row_user = mysqli_fetch_assoc($query);
    $id_user = $row_user['id_user'];
    $tipo    = $row_user['tipo'];

    //* COMPROBAMOS SI TIENE ESTADO DE CUENTA YA GENERADO CON ESA FECHA

    $hoy_mas_30_dias = date("Y-m-d", strtotime($hoy . "+ 30 day"));

        //* CREAMOS EL ESTADO DE CUENTA Y ACREDITAMOS AL SOCIO
        $insert_estado_de_cuenta_socio = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_usuarios (id_user, tipo_user, monto, fecha_vencimiento)
        VALUES ('$id_user', '$tipo', '$monto', '$hoy_mas_30_dias') ");

                //* DESCONTAMOS EL DINERO AL COMERCIO
                $query_debito_comercio = mysqli_query($mysqli,"SELECT id_estado_de_cuenta_comercios, monto FROM estado_de_cuenta_comercios
                WHERE id_comercio = '$id_comercio' and fecha_vencimiento >= '$hoy' ORDER BY fecha_vencimiento ASC ");
    
                $monto_a_debitar = $monto;
    
                while($rowDebito = mysqli_fetch_array($query_debito_comercio)){
    
                $id_estado_de_cuenta_comercios = $rowDebito['id_estado_de_cuenta_comercios'];
                $monto_2 = $rowDebito['monto'];
    
                if($monto_2 >= $monto_a_debitar){
    
                    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_comercios
                    SET monto = monto - '$monto_a_debitar'
                    WHERE id_estado_de_cuenta_comercios = '$id_estado_de_cuenta_comercios' ");
                    $monto_a_debitar = 0;
                    break;
                }else{
                    $monto_a_debitar = $monto_a_debitar - $monto_2;
                    $debito = mysqli_query($mysqli,"UPDATE estado_de_cuenta_comercios
                    SET monto = 0
                    WHERE id_estado_de_cuenta_comercios = '$id_estado_de_cuenta_comercios'
                    ");
    
                }   }

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
                        VALUES ('$fecha_format', '$monto', '$id_user', '$id_comercio', '$randomString', '0', '0' );");
            
                        $select_cupon = mysqli_query($mysqli,"SELECT MAX(id_cupon) as id_cupon FROM cupones_generados");
            
                        $cupon = mysqli_fetch_assoc($select_cupon);
            
                        $id_cupon = $cupon['id_cupon'];
            
                        $insert1 = mysqli_query($mysqli,"INSERT INTO transacciones (fecha, id_user, id_comercio, id_cupon, monto, id_user_2)
                        VALUES ('$fecha_format', '0', '$id_comercio', '$id_cupon', '$monto', '$id_user' );");  

                        $crear_alerta = mysqli_query($mysqli,"INSERT INTO alerta_usuario ( id_usuario, alertado, tipo_alerta )
                        VALUES ('$id_user', '0', '1' );");

                            mysqli_close($mysqli);

                            $response = json_encode(array('result'=>true,
                            'message'=>'Transacción realizada correctamente'));
            
                            exit($response); 

}

?>