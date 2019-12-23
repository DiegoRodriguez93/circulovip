<?php
header("Access-Control-Allow-Origin: *");

registerUser(); //trigger function

function registerUser(){

    require '../_conexion.php';
    
    $email = $mysqli->escape_string($_POST['email']);

    $query = mysqli_query($mysqli,"SELECT email from usuarios WHERE email = '$email' ");

    $contar = mysqli_num_rows($query);

    if($contar > 0){

        $res = array('result'=>false,'message'=>'Ya hay un usuario registrado con ese correo electronico');
        die(json_encode($res));
    
    }

$fecha_registro = Date('Y/m/d H:i:s');
$hash           = $mysqli->escape_string( md5( rand(0,1000) ) );
$token          = $mysqli->escape_string( md5( rand(0,1000) ) );      
$pass           = $mysqli->escape_string(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      

    $insert = mysqli_query($mysqli,"INSERT INTO usuarios ( email,  hash,  pass, activo, token, fecha_registro) 
    VALUES ( '$email', '$hash',  '$pass', '1', '$token', '$fecha_registro')");



        $res = array('result'=>true,'message'=>'El usuario se ha creado satifactoriamente');
        die(json_encode($res));

        mysqli_close($mysqli);

}




?>