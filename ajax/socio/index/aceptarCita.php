<?php 

require '../../_conexion.php';

/* SELECT ue.email, ue.nombre, ur.email, ur.nombre FROM citas as c 
LEFT JOIN usuarios as ue ON c.id_emisor = ue.id
LEFT JOIN usuarios as ur ON c.id_receptor = ue.id
 WHERE c.id_emisor = 10 AND c.id_receptor = 12 */

$id_cita = mysqli_real_escape_string($mysqli, $_POST['id_cita']);

$update = mysqli_query($mysqli, "UPDATE `citas` SET `estado`='1' WHERE `id_cita` = '$id_cita' ");

if($update){
    
    $res = array('result'=>true, 'message'=>'Se ha aceptado la cita correctamente!');

    /* ENVIAR MAIL AL EMISOR Y AL RECEPTOR */

    $select = mysqli_query($mysqli,"SELECT ue.email as mailEmisor,
    ue.nombre as nombreEmisor,
    ur.email as mailReceptor,
    ur.nombre as nombreReceptor,
    c.dia_hora as fechaDeCita
    FROM citas as c 
    LEFT JOIN usuarios as ue ON c.id_emisor = ue.id
    LEFT JOIN usuarios as ur ON c.id_receptor = ur.id
    WHERE c.id_cita = '$id_cita' ");

        if(mysqli_num_rows($select) == 1){

            $row = mysqli_fetch_assoc($select);

            $date           = new DateTime($row['fechaDeCita']);
            $fechaDeCita    = $date->format('d/m/y H:i');

            $mailEmisor     = $row['mailEmisor'];
            $mailReceptor   = $row['mailReceptor'];

            $nombreEmisor   = $row['nombreEmisor'];
            $nombreReceptor = $row['nombreReceptor'];
            
            include '../../mail/body/aceptarCitaMailEmisor.php';
            include '../../mail/sendMail.php';

            if(sendMail('',$mailEmisor,$body,$subject)){ # envio el mail del emisor

                include '../../mail/body/aceptarCitaMailReceptor.php';
                include '../../mail/sendMail.php';

                sendMail('',$mailReceptor,$body,$subject); # envio el mail del receptor

            }

        }

}else{

    $res = array('result'=>false, 'message'=>'No se ha podido aceptar la cita, intenté más tarde!');

}

mysqli_close($mysqli);
echo json_encode($res);

?>