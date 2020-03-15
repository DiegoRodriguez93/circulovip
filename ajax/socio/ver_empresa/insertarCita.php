<?php 

require '../../_conexion.php';

$id_emisor      = mysqli_real_escape_string($mysqli, $_POST['id_emisor']);
$id_receptor    = mysqli_real_escape_string($mysqli, $_POST['id_receptor']);
$dia            = mysqli_real_escape_string($mysqli, $_POST['dia']);
$hora           = mysqli_real_escape_string($mysqli, $_POST['hora']);
$zona_horaria   = mysqli_real_escape_string($mysqli, $_POST['zona_horaria']);

$hora = substr($hora, 0, 5); 

$s = $dia.' '.$hora.':00';
$d = strtotime($s);

/* $dateTime = DateTime::createFromFormat( 'd/m/Y H:i:s', $s );  */

$date = date("Y-m-d H:i:s", $d);

    // COMPROBAMOS SI NO TIENE UNA CITA PENDIENTE EN ESE HORARIO
    $select = mysqli_query($mysqli,"SELECT dia_hora, id_receptor, estado 
    FROM citas WHERE id_receptor = '$id_receptor' AND dia_hora = '$date' AND (estado = 2 OR estado = 1) ");

    if(mysqli_num_rows($select) > 0){
      
        $res = array('result'=>false,
        'message'=>'El usuario ya ha progrado una cita en ese horario, pruebe en otro horario');

    }else{
        // CREAMOS LA SALA
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
}

mysqli_close($mysqli);
echo json_encode($res);

?>