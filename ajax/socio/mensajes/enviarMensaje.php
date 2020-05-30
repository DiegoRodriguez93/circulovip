<?php 

require '../../_conexion.php';

$id_emisor      = $_POST['id_emisor'];
$id_receptor    = $_POST['id_receptor'];

$mensaje        = mysqli_real_escape_string($mysqli,$_POST['mensaje']);
$mensaje        = htmlentities($mensaje);
        
$fecha          = date('Y-m-d H:i:s');

$insert = mysqli_query($mysqli,"INSERT INTO mensajes (id_emisor, id_receptor, mensaje, fecha, leido)
VALUES ('$id_emisor', '$id_receptor', '$mensaje', '$fecha', '1') ;");

if($insert){

    echo json_encode(array('result'=>'true'));

    $select = mysqli_query($mysqli,"SELECT id FROM mensajes 
    WHERE id_emisor = '$id_emisor' AND id_receptor = '$id_receptor' ");

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
        WHERE m.id_emisor = '$id_emisor' 
        AND m.id_receptor = '$id_receptor' 
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

    echo json_encode(array('result'=>'false'));

}

mysqli_close($mysqli);

?>