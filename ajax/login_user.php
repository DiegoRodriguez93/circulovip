<?php
header("Access-Control-Allow-Origin: *");
require '_conexion.php';
require '_conexion250.php';

// Escape cedula to protect SQL injections

$usuario = $mysqli->escape_string($_POST['usuario']);


     // Chequeamos que la cuenta este creada

        $result = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE usuario='$usuario'");
        
        $contar = mysqli_num_rows($result);
        
        if ( $contar != 1 ){ // User doesn't exist
            
          $res = array('result'=>false,'message'=>'El usuario con esta cedula no existe');
        
        }else { // User exists

            $user = $result->fetch_assoc();

            if($user['activo'] == 1){
                       
            if ( password_verify($_POST['pass'], $user['pass']) ) {
        
                $nombre    = $user['name'];
                $userid    = $user['id_user'];
                $activo    = $user['activo'];
        
                        $res = array('result'=>true,'message'=>'Bienvenido '. $nombre ,'id_user'=>$userid, 'activo'=>$activo);
                     
            }else {
                $res = array('result'=>false,'message'=>'La contraseña es incorrecta, intenté de nuevo');
            }

            }elseif($user['activo'] == 2){

                if ( $_POST['pass'] == $user['hash'] ) {

                    $nombre    = $user['name'];
                    $userid    = $user['id_user'];
                    $activo    = $user['activo'];

                    $res = array('result'=>true,'message'=>'Bienvenido '. $nombre ,'id_user'=>$userid,'activo'=>$activo);

                }else{
                    $res = array('result'=>false,'message'=>'La contraseña temporal es incorrecta, intenté de nuevo');
                }

            }else{

                $res = array('result'=>false,'message'=>'Su cuenta ha sido de deshabilitada por un administrador');
            }

        }

        



echo json_encode($res);
 mysqli_close($mysqli);
mysqli_close($mysqli250); 

?>