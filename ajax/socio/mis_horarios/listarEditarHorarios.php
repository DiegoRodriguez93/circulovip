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

    while( $row = mysqli_fetch_assoc($select) ){

        $horario = $row['horario'];
        $tipo    = $row['tipo'];

        if($horario == null){
            $horario = $row['hora'];
        }

        $horario = date('H:i',strtotime($horario));

        $res[] = array('horario'=>$horario,'tipo'=>$tipo);

    }

}else{

$res = array();

}

mysqli_close($mysqli);
echo json_encode(array('horarios'=>$res));


?>