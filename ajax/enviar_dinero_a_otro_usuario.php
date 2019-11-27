<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$cedula          = $mysqli->escape_string($_POST['cedula']);
$monto           = $mysqli->escape_string($_POST['monto']);
$id_user         = $mysqli->escape_string($_POST['id_user']);

$query1 = mysqli_query($mysqli,"SELECT id_estado_de_cuenta_usuarios, id_user, monto FROM estado_de_cuenta_usuarios
WHERE id_user = '$id_user' ");

$contar1 = mysqli_num_rows($query1);

if($contar1 > 0){

    $row = mysqli_fetch_assoc($query1);

    if($row['monto'] > $monto){

        $query2 = mysqli_query($mysqli,"SELECT id_user, usuario, activo, tipo FROM usuarios WHERE usuario = '$cedula' ");

        $contar2 = mysqli_num_rows($query2);

        if($contar2 > 0){

            /* EXTRAEMOS EL ID_USER DEL USUARIO A RECIBIR PLATA */

            $row2 = mysqli_fetch_assoc($query2);

            $id_user_a_recibir = $row2['id_user'];
            $tipo_user_a_recibir = $row2['tipo'];

            /* VEMOS SI EL USUARIO TIENE ESTADO DE CUENTA CREADO con mismo vencimiento */

            $hoy = date('Y-m-d');

            $query3 = mysqli_query($mysqli,"SELECT id_user FROM estado_de_cuenta_usuarios
            WHERE id_user = '$id_user_a_recibir' and fecha_vencimiento = '$hoy' ");

            $contar3 = mysqli_num_rows($query3);

            if($contar3 > 0){

            /* INSERTAMOS LA PLATITA */

            $update1 = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
            SET monto = monto + '$monto'
            WHERE id_user = '$id_user_a_recibir' ;");

            /* DESCONTAMOS LA PLATA */
            if($update1) {
               $update2 = mysqli_query($mysqli,"UPDATE estado_de_cuenta_usuarios
                SET monto = monto - '$monto'
                WHERE id_user = '$id_user' ;");

                $res = array('result'=>true,'message'=>'Transacción realizada correctamente'); 

            }else{

                $res = array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde');        
    
            }



            }else{

                // insertamos la plata

            $hoy_mas_30_dias = date("Y-m-d", strtotime($hoy . "+ 30 day"));

            $insert1 = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_usuarios (id_user, tipo_user, monto, fecha_vencimiento)
            VALUES ('$id_user_a_recibir', '$tipo_user_a_recibir', '$monto', '$hoy_mas_30_dias');");    
            //* debitamos el monto del estado de cuenta

            $query_debito_socio = mysqli_query($mysqli,"SELECT id_estado_de_cuenta_usuarios, monto FROM estado_de_cuenta_usuarios
            WHERE id_user = '$id_user' and fecha_vencimiento >= '$hoy' ORDER BY fecha_vencimiento ASC ");

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

            } } }
        

        }else{


            $res = array('result'=>false,'message'=>'No se ha encontrado un usuario con esa cédula en el sistema');

        }

    }else{

        $res = array('result'=>false,'message'=>'No tienes monto disponible suficiente para 
    realizar esta transferencia ');

    }

}else{

    $res = array('result'=>false,'message'=>'No tienes monto disponible suficiente para 
    realizar esta transferencia ');

}



echo json_encode($res);
mysqli_close($mysqli);

?>