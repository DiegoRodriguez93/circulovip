<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli,$_POST['id_user']);
$zona_horaria = mysqli_real_escape_string($mysqli,$_POST['zonaHoraria']);

$select = mysqli_query($mysqli,"SELECT id_cita FROM citas
 WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') AND dia_hora >= now() ");

if(mysqli_num_rows($select) > 0){
// todo ignorar si la cita esta cancelada 
    $res = array('result'=>false,'message'=>'Para poder cambiar la zona horaria, no debe tener citas pendientes');

}else{ 

    if($zona_horaria == 0){
        $zona_horaria == null;
    }

$update = mysqli_query($mysqli,"UPDATE usuarios
SET zona_horaria = '$zona_horaria'
WHERE id = '$id_user';");

    if($update){
        $res = array('result'=>true,'message'=>'Zona horaria actualizada correcamtente');
    }else{
        $res = array('result'=>false,'message'=>'Ha ocurrido un error intente más tarde');
    }

}

mysqli_close($mysqli);
echo json_encode($res);


?>