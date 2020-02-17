<?php 

require '../../_conexion.php';

$id_emisor      = mysqli_real_escape_string($mysqli, $_POST['id_emisor']);
$id_receptor    = mysqli_real_escape_string($mysqli, $_POST['id_receptor']);
$dia            = mysqli_real_escape_string($mysqli, $_POST['dia']);
$hora           = mysqli_real_escape_string($mysqli, $_POST['hora']);
$zona_horaria   = mysqli_real_escape_string($mysqli, $_POST['zona_horaria']);

$s = $dia.' '.$hora.':00';
/* $s = strtotime($s); */
$dateTime = DateTime::createFromFormat( 'd/m/Y H:i:s', $s ); 

$date = $dateTime ->format('Y-m-d H:i:s');


    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $nombre_sala = 'Circulo_Vip_' . $randomString;



$insert = mysqli_query($mysqli, "INSERT INTO citas (id_emisor, id_receptor, dia_hora, estado, zona_horaria_emisor, sala)
VALUES ('$id_emisor', '$id_receptor', '$date' , '2', '$zona_horaria', '$nombre_sala') ;");

if($insert){

    $res = array('result'=>true,'message'=>'Se ha solicitado la cita correctamente!');

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde!');

}

mysqli_close($mysqli);
echo json_encode($res);

?>