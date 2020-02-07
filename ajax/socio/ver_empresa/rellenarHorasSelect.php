<?php 

require '../../_conexion.php';

$id_emisor = mysqli_real_escape_string($mysqli, $_POST['id_emisor']);
$id_receptor = mysqli_real_escape_string($mysqli, $_POST['id_receptor']);
$zona_horaria_emisor = mysqli_real_escape_string($mysqli, $_POST['zona_horaria_emisor']);
$dia_seleccionado = mysqli_real_escape_string($mysqli, $_POST['dia_seleccionado']);

// EXTRAEMOS LA ZONA HORARIA RECEPTOR
$select = mysqli_query($mysqli, "SELECT zona_horaria FROM usuarios WHERE id = '$id_receptor' ");

$row = mysqli_fetch_assoc($select);
$zona_horaria_receptor = $row['zona_horaria'];

$select2 = mysqli_query($mysqli, "SELECT * FROM horarios 
WHERE id_user = '$id_receptor'
AND id_dia REGEXP '$dia_seleccionado' ORDER BY hora ASC ");

while($row2 = mysqli_fetch_array($select2)){

if($row2['id'] == null){

    $res[] = array('hora'=>'El usuario no tiene horarios disponibles ese día',
    'zona_horaria'=>'',
    'hora_mia'=>'',
    'zona_horaria_mia'=>'');

}else{

    $date = DateTime::createFromFormat( 'H:i:s', $row2['hora'] );
    $horaFormat = $date->format( 'H:i');

   /*  if(intval($zona_horaria_receptor) >= 0){ */

    if( intval($zona_horaria_receptor) == intval($zona_horaria_emisor)){
        $hora_mia =  $horaFormat;
    }else{

     $diferencia_de_horas =   count(range(intval($zona_horaria_receptor),intval($zona_horaria_emisor))) ;

     $hora = $date->format('H');
     $minutos = $date->format('i');

     if(intval($zona_horaria_receptor) > intval($zona_horaria_emisor)){

        $hora_final = $hora - $diferencia_de_horas + 1;

     }else{

        $hora_final = $hora + $diferencia_de_horas - 1;

     }

     $hora_mia = $hora_final.':'.$minutos;

    }


    $res[] = array(
        'hora'=>$horaFormat,
        'zona_horaria'=>'GMT'.$zona_horaria_receptor,
        'hora_mia'=>$hora_mia,
        'zona_horaria_mia'=>'GMT'.$zona_horaria_emisor
    );

}
}

mysqli_close($mysqli);
echo json_encode($res);


?>