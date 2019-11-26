<?php
header("Access-Control-Allow-Origin: *");
/* Reset your password form, sends reset.php password link */
require '_conexion.php';
  
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email' ");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $res = array('result'=>false,'message'=>'La dirección de correo no tiene usuario registrado');
    }
    else {

        $user = $result->fetch_assoc(); 
        
        $email = $user['email'];
        $hash = $user['hash'];
        $name = $user['name'];

        $url =  "<a style='color:blue;' href='http://localhost/login/reset.php?email=".$email."&hash=".$hash."'>ENLACE AQUÍ</a>";  

        include('../lib/PHPMailerAutoload.php');
        include('enviarMail.php');

        $res = array('result'=>true,'message'=>'El correo para restablecer la contraseña esta en camino, revise su bandeja de spam');
  }

  echo json_encode($res);
  mysqli_close($mysqli);

?>