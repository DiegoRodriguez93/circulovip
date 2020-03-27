<?php 

require '../../_conexion.php';

$id_emisor = mysqli_real_escape_string($mysqli, $_POST['id_emisor']);
$id_receptor = mysqli_real_escape_string($mysqli, $_POST['id_receptor']);
$zona_horaria_emisor = mysqli_real_escape_string($mysqli, $_POST['zona_horaria_emisor']);
$dia_seleccionado = mysqli_real_escape_string($mysqli, $_POST['dia_seleccionado']);
$dia_seleccionado_text = mysqli_real_escape_string($mysqli, $_POST['dia_seleccionado_text']);

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

    // CHEQUEMOS QUE NO ESTE SOLICITADA LA FECHA

    $d = strtotime($dia_seleccionado_text);
    $horaFormat2 = date("Y-m-d", $d);

    $fecha_a_chequear = $horaFormat2 . ' ' . $horaFormat . ':00';

    $select3 = mysqli_query($mysqli,"SELECT dia_hora, id_receptor, estado 
    FROM citas WHERE (id_receptor = '$id_receptor' OR id_emisor = '$id_receptor')
     AND dia_hora = '$fecha_a_chequear' AND (estado = 2 OR estado = 1) ");

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

    $fecha_a_chequear2 = $horaFormat2 . ' ' . $hora_mia . ':00';

    $select4 = mysqli_query($mysqli,"SELECT dia_hora, id_receptor, estado 
    FROM citas WHERE (id_receptor = '$id_emisor' OR id_emisor = '$id_emisor')
     AND dia_hora = '$fecha_a_chequear2' AND (estado = 2 OR estado = 1)");

    if(mysqli_num_rows($select3) > 0 OR mysqli_num_rows($select4) > 0){
        // CITA YA SOLICITADA EN ESE HORARIO
        $estado = 1;
    }else{  $estado = 0;
    
    }


    $res[] = array(
        'hora'=>$horaFormat,
        'zona_horaria'=>'GMT'.$zona_horaria_receptor,
        'hora_mia'=>$hora_mia,
        'zona_horaria_mia'=>'GMT'.$zona_horaria_emisor,
        'estado'=>$estado
    );

    
}
}

echo json_encode($res);
mysqli_close($mysqli);
