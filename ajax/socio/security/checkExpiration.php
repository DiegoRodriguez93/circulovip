<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$token = mysqli_real_escape_string($mysqli, $_POST['token']);

$select = mysqli_query($mysqli, "SELECT id, token, fecha_vencimiento 
FROM usuarios 
WHERE id = '$id_user' 
AND token = '$token' 
AND activo = 1 ");

if(mysqli_num_rows($select) < 1){

    $res = array('result'=>false,'message'=>'Cuenta inválida vuelva a iniciar sesión');

}else{
    $dt = new DateTime();
    $fecha_hoy = $dt->format('Y-m-d');

    $row = mysqli_fetch_assoc($select);
    $fecha_vencimiento = $row['fecha_vencimiento'];

    if($fecha_hoy > $fecha_vencimiento){

        $res = array('result'=>false,'message'=>'El tiempo de suscripción ha expirado');

    }else{

        $res = array('result'=>true,'message'=>'Cuenta correcta');

        // SI TIENE UNA CITA EN MENOS DE 5 MIN, IR A LA SALA DE ESPERA,
        // SINO PREGUNTAR SI QUIERE ENTRAR A LA SALA

    }

}

mysqli_close($mysqli);
echo json_encode($res);


?>