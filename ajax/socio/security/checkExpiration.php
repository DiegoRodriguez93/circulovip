<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$token = mysqli_real_escape_string($mysqli, $_POST['token']);

$select = mysqli_query($mysqli, "SELECT id, token, fecha_vencimiento FROM usuarios WHERE id = '$id_user' AND token = '$token' ");

if(mysqli_num_rows($select) < 1){

    $res = array('result'=>false,'message'=>'Cuenta inválida vuelva a iniciar sesión');

}else{

    $fecha = Date('now');
    $fecha = date_create($fecha);
    $fecha_hoy = date_format($fecha, 'Y-m-d');

    $row = mysqli_fetch_assoc($select);
    $fecha_vencimiento = $row['fecha_vencimiento'];

    if($fecha_hoy > $fecha_vencimiento){

        $res = array('result'=>false,'message'=>'El tiempo de suscripción ha expirado');

    }else{

        $res = array('result'=>true,'message'=>'Cuenta correcta');

    }

}

mysqli_close($mysqli);
echo json_encode($res);


?>