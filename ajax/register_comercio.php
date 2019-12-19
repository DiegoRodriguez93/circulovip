<?php
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

// Escape all $_POST variables to protect SQL injections
$name    = $mysqli->escape_string($_POST['name']);
$address = $mysqli->escape_string($_POST['address']);
$email   = $mysqli->escape_string($_POST['email']);
$phone   = $mysqli->escape_string($_POST['phone']);
$hash    = $mysqli->escape_string( md5( rand(0,1000) ) );
 
$pass    = $mysqli->escape_string(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      
// Check if commerce with that email already exists
$result   = $mysqli->query("SELECT * FROM comercios WHERE email='$email'") or die(mysqli_errno($mysqli));

if ( $result->num_rows > 0 ) {
    
   $res = array('result'=>false,'message'=>'El comercio con este mail ya esta registrado');
    
}else { 

    $sql = "INSERT INTO comercios (name, address, phone, email,  hash, pass, activo) 
         VALUES ('$name', '$address', '$phone', '$email', '$hash', '$pass', '1')";

    if ( $mysqli->query($sql) ){

        $res = array('result'=>true,'message'=>'El comercio se ha registrado correctamente');

    } else {
       
        $res = array('result'=>false,'message'=>'No se ha podido registrar el comercio en este momento, intenté más tarde');

    }

}

echo json_encode($res);

mysqli_close($mysqli);


?>