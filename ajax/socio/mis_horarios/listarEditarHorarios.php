<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$fechaCitas = mysqli_real_escape_string($mysqli, $_POST['fechaCitas']);

$fechaCitas = date('Y-m-d',strtotime($fechaCitas));
$diaEnNumero = date('w',strtotime($fechaCitas));

// IN PHP SUNDAY IS 0 IN MY SYSTEM IS 7 (PORQUE SE ME CANTO EL ORTO)
if($diaEnNumero == 0){
    $diaEnNumero = 7;
}

// TIPO 0 ES BLOQUEADO , TIPO 1 ES AGREGADO
$select = mysqli_query($mysqli,"SELECT h.id_dia, h.hora, hp.horario, hp.tipo
FROM horarios as h 
LEFT JOIN horarios_personalizados as hp ON (hp.id_user = h.id_user AND h.hora = hp.horario)
WHERE ( h.id_dia REGEXP '$diaEnNumero' OR hp.dia_de_cita = '$fechaCitas') 
AND  h.id_user = '$id_user' GROUP BY h.hora ORDER BY h.hora ASC");

if(mysqli_num_rows($select) > 0){

    $arrDeHorarios = '(';

    while( $row = mysqli_fetch_assoc($select) ){

        $horario = $row['horario'];
        $tipo    = $row['tipo'];

        if($horario == null){
            $horario = $row['hora'];
        }

        $arrDeHorarios .=  "'".$horario . "',";

        $horario = date('H:i',strtotime($horario));

        $res[] = array('horario'=>$horario,'tipo'=>$tipo);

    }

    $arrDeHorarios = substr($arrDeHorarios, 0, -1); // delete last comma

    $arrDeHorarios .= ')'; 

    $select2 = mysqli_query($mysqli,"SELECT horario, tipo FROM horarios_personalizados 
    WHERE id_user = '$id_user' 
    AND dia_de_cita = '$fechaCitas'
    AND horario NOT IN $arrDeHorarios ");

    if(mysqli_num_rows($select2) > 0){

        while($row2 = mysqli_fetch_array($select2)){

            $horario2 = $row2['horario'];
            $tipo2 = $row2['tipo'];
    
            $horario2 = date('H:i',strtotime($horario2));
    
            $res[] = array('horario'=>$horario2,'tipo'=>$tipo2);
    
        }

    }

}else{

$res = array();

}

mysqli_close($mysqli);
echo json_encode(array('horarios'=>$res));


?>