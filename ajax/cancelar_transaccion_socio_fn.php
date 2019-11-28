<?php

$id_cupon = $_POST['id_cupon'];

cancelarTransaccion($id_cupon); //disparar

function cancelarTransaccion($id_cupon){

    require '_conexion.php';

        //* ACTUALIZAMOS EL CUPÓN A NO DISPONIBLE

        $update_cupon_to_nodisponible = mysqli_query($mysqli,"UPDATE cupones_generados
        SET disponible = 0
        WHERE id_cupon = '$id_cupon'");

        //* extraemos los datos del cupón para rellenar la transacción

            $query = mysqli_query($mysqli,"SELECT id_comercio FROM cupones_generados WHERE id_cupon = '$id_cupon' ");

            $contar = mysqli_num_rows($query);

            if($contar == 0){

                $response = json_encode(array('result'=>false,'message'=>'Ha ocurrido un error, intenté más tarde')) ;
                exit($response);

            }

            $row = mysqli_fetch_assoc($query);
            
            $id_comercio = $row['id_comercio'];
    
        //* GENERAMOS LA ALERTA PARA EL COMERCIO
    
        $alerta_comercio = mysqli_query($mysqli,"INSERT INTO alerta_comercio (id_comercio, alertado, tipo_alerta)
        VALUES ('$id_comercio', '0', '2') ");
    



}

