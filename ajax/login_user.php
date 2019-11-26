<?php
header("Access-Control-Allow-Origin: *");
require '_conexion.php';
require '_conexion250.php';

// Escape cedula to protect SQL injections

$usuario = $mysqli->escape_string($_POST['usuario']);

$query250 = mysqli_query($mysqli250,"SELECT cedula FROM abmmod.padron_datos_socio WHERE cedula = '$usuario' ");

if ( $query250->num_rows == 0 ){ // NO ES SOCIO DE VIDA, TAL VEZ LO AGREGO EL COMERCIO
    
    $consulta = mysqli_query($mysqli,"SELECT cedula from cedulas_agregadas WHERE cedula = '$usuario' ");

    if ( $consulta->num_rows == 1 ){

     // Chequeamos que la cuenta este creada

        $result = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE usuario='$usuario'");
        
        $contar = mysqli_num_rows($result);
        
        if ( $contar != 1 ){ // User doesn't exist
            
          $res = array('result'=>false,'message'=>'El usuario con esta cedula no existe');
        
        }else { // User exists
            $user = $result->fetch_assoc();
        
            if ( password_verify($_POST['pass'], $user['pass']) ) {
        
                $nombre    = $user['name'];
                $userid    = $user['id_user'];
        
                        $res = array('result'=>true,'message'=>'Bienvenido '. $nombre ,'id_user'=>$userid);
                     
            }
            else {
                $res = array('result'=>false,'message'=>'La contraseña es incorrecta, intenté de nuevo');
            }
        }
        }else{

        $res = array('result'=>false,'message'=>'Usuario o contraseña incorrectos');

    }
        
    }else{

        // esta en el padrón!, Chequeamos que la cuenta este creada

        $result = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE usuario='$usuario'");
        
        $contar = mysqli_num_rows($result);
        
        if ( $contar != 1 ){ // User doesn't exist
            
          $res = array('result'=>false,'message'=>'El usuario con esta cedula no existe');
        
        }else { // User exists
            $user = $result->fetch_assoc();
        
            if ( password_verify($_POST['pass'], $user['pass']) ) {
        
                $nombre    = $user['name'];
                $userid    = $user['id_user'];
        
                        $res = array('result'=>true,'message'=>'Bienvenido '. $nombre ,'id_user'=>$userid);
                     
            }
            else {
                $res = array('result'=>false,'message'=>'Usuario o contraseña incorrectos, intenté de nuevo');
            }
        }

       ////  $res = array('result'=>false,'message'=>'La cedula ingresada no es socio de vida'); 


    }



echo json_encode($res);
 mysqli_close($mysqli);
mysqli_close($mysqli250); 

?>