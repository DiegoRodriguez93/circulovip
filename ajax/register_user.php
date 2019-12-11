<?php
header("Access-Control-Allow-Origin: *");

require '_conexion.php';
require '_conexion250.php';

$usuario = $mysqli->escape_string($_POST['usuario']);

$query = mysqli_query($mysqli250,"SELECT cedula, nombre FROM abmmod.padron_datos_socio WHERE cedula = '$usuario' ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    $tipo = 1; // 1 es socio de vida recibe 500 pesos por mes

}else{

    $tipo = 2; //  no es socio de vida
}

// Escape all $_POST variables to protect SQL injections

                    // STRING RANDOM DE 8 CARACTERES
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 8 ; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
$fecha_registro = Date('Y/m/d H:i:s');
$email = $mysqli->escape_string($_POST['email']);
$phone = $mysqli->escape_string($_POST['phone']);
$hash = $randomString;
$name_post = $mysqli->escape_string($_POST['name']); 
$namewithoutformat = strtolower($name_post);
$name = ucwords($namewithoutformat);
$pass = $mysqli->escape_string(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      
// Check if user with that email or ci already exists
$result = $mysqli->query("SELECT * FROM usuarios WHERE email='$email'") or die(mysqli_error($mysqli));
$result2 = $mysqli->query("SELECT * FROM usuarios WHERE usuario='$usuario'") or die(mysqli_error($mysqli));

// We know user email or user ci exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
   $res = array('result'=>false,'message'=>'El usuario con este mail ya esta registrado');
    
}elseif ($result2->num_rows > 0) {

    $res = array('result'=>false,'message'=>'El usuario con esta cedula ya esta registrado');
}
else { 

    $sql = "INSERT INTO usuarios (usuario, email, phone, hash, name, pass, activo, tipo, fecha_registro) 
         VALUES ('$usuario', '$email', '$phone', '$hash', '$name', '$pass', '1', '$tipo', '$fecha_registro')";


    if ( $mysqli->query($sql) ){

        $query2 = mysqli_query($mysqli,"SELECT id_user, usuario FROM usuarios WHERE usuario = '$usuario' ");

        $user = $query2->fetch_assoc();

        $userid = $user['id_user'];

        // si el usuario es tipo uno ya crear el estado de cuenta con los 500 pe
        if($tipo == 1 OR $tipo == 2){

        $fecha = new DateTime('now');
        $fecha_hoy = $fecha->format('Y-m-d');

        $dia_de_hoy = $fecha->format('d');
        $dias_de_este_mes = date("t", strtotime($fecha_hoy ));

        $dias_restantes_para_fin_de_mes = $dias_de_este_mes - $dia_de_hoy  ;

        $ultimo_dia_mes = date("Y-m-d", strtotime($fecha_hoy . "+ $dias_restantes_para_fin_de_mes day"));

        $query3 = mysqli_query($mysqli,"INSERT INTO estado_de_cuenta_usuarios (id_user, tipo_user, monto, fecha_vencimiento)
        VALUES ('$userid', '$tipo', '1000', '$ultimo_dia_mes'); ");    

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