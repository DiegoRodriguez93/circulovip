<?php 

require '../../_conexion.php';

$id_user_emisor     = mysqli_real_escape_string($mysqli, $_POST['id_user_emisor']);
$id_user_receptor   = mysqli_real_escape_string($mysqli, $_POST['id_user_receptor']);
$mensaje            = mysqli_real_escape_string($mysqli, $_POST['mensaje']);

$fecha = date('Y-m-d H:i:s');

$insert = mysqli_query($mysqli, "INSERT INTO mensajes (id_emisor, id_receptor, mensaje, fecha, leido) VALUES
('$id_user_emisor', '$id_user_receptor', '$mensaje', '$fecha', 1) ");

if($insert){

    $res = array('result'=>true,'message'=>'Mensaje enviado correctamente');

    $select = mysqli_query($mysqli,"SELECT id FROM mensajes 
    WHERE id_emisor = '$id_user_emisor' AND id_receptor = '$id_user_receptor' ");

    if(mysqli_num_rows($select) == 1){

        /* enviar mail de Nuevo mensaje a receptor */

        $select2 = mysqli_query($mysqli,"SELECT ue.email as mailEmisor,
        ue.nombre as nombreEmisor,
        ur.email as mailReceptor,
        ur.nombre as nombreRecepto,
        m.fecha as fechaDelMensaje
        FROM mensajes as m
        LEFT JOIN usuarios as ue ON m.id_emisor = ue.id
        LEFT JOIN usuarios as ur ON m.id_receptor = ur.id
        WHERE m.id_emisor = '$id_user_emisor' 
        AND m.id_receptor = '$id_user_receptor' 
        LIMIT 1");

        if(mysqli_num_rows($select2) == 1){

            $row = mysqli_fetch_assoc($select2);

            $date               = new DateTime($row['fechaDelMensaje']);
            $diaDelMensaje      = $date->format('d/m/y');
            $horaDelMensaje     = $date->format('H:i');

            $mailEmisor         = $row['mailEmisor'];
            $mailReceptor       = $row['mailReceptor'];

            $nombreEmisor       = $row['nombreEmisor'];
            $nombreReceptor     = $row['nombreReceptor'];
            
            include '../../mail/body/nuevoMensajeMail.php';
            include '../../mail/sendMail.php';

                sendMail('',$mailReceptor,$body,$subject); # envio el mail al receptor del mensaje nuevo

        }
    }

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde!');

}

mysqli_close($mysqli);
echo json_encode($res);



?>