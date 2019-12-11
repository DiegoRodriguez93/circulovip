<?php
header("Access-Control-Allow-Origin: *");
/* Password reset process, updates database with new user password */
require '_conexion.php';

    // Make sure the two passwords match
    if ( $_POST['pass1'] == $_POST['pass2'] ) { 

        $new_pass = password_hash($_POST['pass1'], PASSWORD_BCRYPT);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form

        $hash = $mysqli->escape_string($_POST['hash']);
        $id_user = $mysqli->escape_string($_POST['id_user']);
        
        $sql = "UPDATE usuarios SET pass='$new_pass', activo = 1 WHERE id_user='$id_user' and hash='$hash' ";

        if ( $mysqli->query($sql) ) {

        $res = array('result'=>true,'message'=>"Tu contraseña ha sido restablacida satifactoriamente!");

        }else{
            $res = array('result'=>false,'message'=>"Ha ocurrido un error, intenté más tarde");
        }

    }else {
        $res = array('result'=>false,'message'=>"Las dos contraseñas ingresadas no coinciden!");
    }

    echo json_encode($res);
    mysqli_close($mysqli);


?>
