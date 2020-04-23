<?php 

require '../../_conexion.php';

$dia        = mysqli_real_escape_string($mysqli, $_POST['dia']);
$horario    = mysqli_real_escape_string($mysqli, $_POST['horario']);
$id_user    = mysqli_real_escape_string($mysqli, $_POST['id_user']);

$horario    = $horario . ':00'; // convert to time again
$dia        = date('Y-m-d',strtotime($dia)); // convert to date de yankis come mielda again

// TIPO DE HORARIO 0 ES BLOQUEADO O QUITADO PARA ESE DIA DE CITA

$select = mysqli_query($mysqli,"SELECT id FROM horarios_personalizados 
WHERE horario = '$horario' AND id_user = '$id_user' AND dia_de_cita = '$dia' ");

if(mysqli_num_rows($select) > 0){

    $row = mysqli_fetch_assoc($select);

    $id = $row['id'];

    $update = mysqli_query($mysqli,"UPDATE horarios_personalizados SET tipo = 0 WHERE id = '$id' ");

    if($update){
        $res = array('result'=>true,'message'=>'Horario quitado correctamente');
    }else{
        $res = array('result'=>false,'message'=>'Oh no! ha ocurrido un error, intente más tarde!');
    }

}else{

    $insert = mysqli_query($mysqli,"INSERT INTO horarios_personalizados (horario, dia_de_cita, id_user, tipo) 
    VALUES ('$horario', '$dia', '$id_user', 0) ");

    
    if($insert){
        $res = array('result'=>true,'message'=>'Horario quitado correctamente');
    }else{
        $res = array('result'=>false,'message'=>'Oh no! ha ocurrido un error, intente más tarde!');
    }

}

mysqli_close($mysqli);
// VIVA MEJICO CABRONES
echo json_encode($res);

?>