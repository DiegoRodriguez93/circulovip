<?php 

require '../../_conexion.php';

$id_horario = mysqli_real_escape_string($mysqli,$_POST['id_horario']);

$delete = mysqli_query($mysqli,"DELETE FROM horarios WHERE id = '$id_horario' ");

if($delete){

    $res = array('result'=>true);

}else{

    $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde');

}

echo json_encode($res);
mysqli_close($mysqli);

?>