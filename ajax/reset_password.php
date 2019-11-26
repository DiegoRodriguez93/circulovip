<?php
header("Access-Control-Allow-Origin: *");
/* Password reset process, updates database with new user password */
require '_conexion.php';

    // Make sure the two passwords match
    if ( $_POST['newpass'] == $_POST['newpass2'] ) { 

        $new_pass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);
        
        $sql = "UPDATE usuarios SET pass='$new_pass', hash='$hash' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

        $res = array('result'=>true,'message'=>"Tu contraseña ha sido restablacida satifactoriamente!");

        }

    }
    else {
        $res = array('result'=>false,'message'=>"Las dos contraseñas ingresadas no coinciden!");
    }

    echo json_encode($res);
    mysqli_close($mysqli);


?>
