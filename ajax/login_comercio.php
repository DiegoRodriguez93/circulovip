<?php
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

// Escape cedula to protect SQL injections

$email = $mysqli->escape_string($_POST['email']);

$result = $mysqli->query("SELECT * FROM comercios WHERE email='$email' ");

if ( $result->num_rows == 0 ){ // Email doesn't exist
    
  $res = array('result'=>false,'message'=>'El usuario con esta email no existe');

}else { // Email exists
    $email = $result->fetch_assoc();

    if ( password_verify($_POST['pass'], $email['pass']) ) {

        $emailid    = $email['id_comercio'];
        $emailactivo = $email['activo'];

                $res = array('result'=>true,'id_comercio'=>$emailid, 'activo_comercio'=>$emailactivo);
             
    }
    else {
        $res = array('result'=>false,'message'=>'La contraseña es incorrecta, intenté de nuevo');
    }
}


echo json_encode($res);
mysqli_close($mysqli);

?>