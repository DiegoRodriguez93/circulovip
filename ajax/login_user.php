<?php
header("Access-Control-Allow-Origin: *");

loginUser();    //disparamos la función

function loginUser(){
    
    require '_conexion.php';
    $email = $mysqli->escape_string($_POST['email']);

     // Chequeamos que la cuenta este creada

        $result = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE email='$email'");
        
        $contar = mysqli_num_rows($result);
        
        if ( $contar != 1 ){ // User doesn't exist

        $res = array('result'=>false,'message'=>'El usuario con ese correo electrónico no esta registrado!');
        die(json_encode($res));
}

            // User exists

            $user = $result->fetch_assoc();

            // comprobamos vencimiento

            $fecha_hoy = Date('Y-m-d H:i:s');

            if($fecha_hoy >= $user['fecha_vencimiento'] ){

                $res = array('result'=>false,'message'=>'Su suscripción ha caducado');
                die(json_encode($res));

            }

            if($user['activo'] == 1){
                       
            if ( password_verify($_POST['pass'], $user['pass']) ) {
        
                $token     = $user['token'];
                $id_user   = $user['id'];
        
                        $res = array('result'=>true, 'token'=>$token, 'id_user'=>$id_user);
                        die(json_encode($res));
                     
            }else {
                $res = array('result'=>false,'message'=>'La contraseña es incorrecta, intenté de nuevo');
                die(json_encode($res));
            }

            }else{

                $res = array('result'=>false,'message'=>'Su cuenta ha sido de deshabilitada por un administrador');
                die(json_encode($res));
            }

            mysqli_close($mysqli);
        }




?>