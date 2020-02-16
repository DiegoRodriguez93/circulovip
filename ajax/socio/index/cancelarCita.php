<?php 

require '../../_conexion.php';

$id_cita = mysqli_real_escape_string($mysqli, $_POST['id_cita']);

$update = mysqli_query($mysqli, "UPDATE `citas` SET `estado`='0' WHERE `id_cita` = '$id_cita' ");

if($update){

    $res = array('result'=>true, 'message'=>'Se ha rechazado la cita correctamente!');

}else{

    $res = array('result'=>false, 'message'=>'No se ha podido rechazar la cita, intenté más tarde!');

}

mysqli_close($mysqli);
echo json_encode($res);

?>