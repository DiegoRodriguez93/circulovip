<?php
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

// TRAIGO EL NOMBRE DE LA PERSONA --------------------------------------------------------------------------------
require '_conexion250.php';

$usuario = $mysqli->escape_string($_POST['usuario']);

$query = mysqli_query($mysqli250,"SELECT cedula, nombre FROM abmmod.padron_datos_socio WHERE cedula = '$usuario' ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while($row = mysqli_fetch_array($query)){
        $namewithoutformat = strtolower($row['nombre']);
        $name = ucwords($namewithoutformat);
    }
    $tipo = 1; // 1 es socio de vida recibe 1000 pesos por mes
}else{

    $consulta = mysqli_query($mysqli,"SELECT cedula , name FROM cedulas_agregadas WHERE cedula = '$usuario' ");

    while($row = mysqli_fetch_array($consulta)){
        $namewithoutformat = strtolower($row['name']);
        $name = ucwords($namewithoutformat);
    }
    $tipo = 2; // 2 agregado por el comercio, no recibe la mensualidad de mil pesos, el comercio que lo creo le puede hacer transaferencias
}



// TRAIGO EL NOMBRE DE LA PERSONA FIN -----------------------------------------------------------------------------

// Escape all $_POST variables to protect SQL injections

$email = $mysqli->escape_string($_POST['email']);
$phone = $mysqli->escape_string($_POST['phone']);
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
////$name = $mysqli->escape_string($_POST['name']); 
$pass = $mysqli->escape_string(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      
// Check if user with that email or ci already exists
$result = $mysqli->query("SELECT * FROM usuarios WHERE email='$email'") or die($mysqli->error());
$result2 = $mysqli->query("SELECT * FROM usuarios WHERE usuario='$usuario'") or die($mysqli->error());

// We know user email or user ci exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
   $res = array('result'=>false,'message'=>'El usuario con este mail ya esta registrado');
    
}elseif ($result2->num_rows > 0) {

    $res = array('result'=>false,'message'=>'El usuario con esta cedula ya esta registrado');
}
else { 

    $sql = "INSERT INTO usuarios (usuario, email, phone, hash, name, pass, activo, tipo) 
         VALUES ('$usuario', '$email', '$phone', '$hash', '$name', '$pass', '1', '$tipo')";


    if ( $mysqli->query($sql) ){

        $query2 = mysqli_query($mysqli,"SELECT id_user, usuario FROM usuarios WHERE usuario = '$usuario' ");

        $user = $query2->fetch_assoc();

        $userid = $user['id_user'];

        // si el usuario es tipo uno ya crear el estado de cuenta con los mil pesos
        if($tipo == 1){

        $query3 = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_usuarios (id_user, tipo_user, monto)
        VALUES ('$userid', '$tipo', '1000'); ");    

        }

        $res = array('result'=>true,'message'=>'El usuario se ha creado satifactoriamente','id_user'=>$userid);

    } else {
       
        $res = array('result'=>false,'message'=>'No se ha podido crear el usuario en este momento, intenté más tarde');

    }

}

echo json_encode($res);

mysqli_close($mysqli);
mysqli_close($mysqli250);

?>