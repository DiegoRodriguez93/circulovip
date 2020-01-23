<?php 

require '../../_conexion.php';

$id_dia     = mysqli_real_escape_string($mysqli, $_POST['id_dia']);
$id_horario = mysqli_real_escape_string($mysqli, $_POST['id_horario']);

$select = mysqli_query($mysqli, "SELECT id_dia FROM horarios WHERE id = '$id_horario' ");

if(mysqli_num_rows($select) == 0){

    die(json_encode(array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde!')));

}

$row = mysqli_fetch_assoc($select);

if (strpos($row['id_dia'], $id_dia) !== false) {

    die(json_encode(array('result'=>false,'message'=>'El día ya se encuentra agregado!')));
}

$update = mysqli_query($mysqli,"UPDATE horarios
SET id_dia = CONCAT(id_dia, '$id_dia')
WHERE id = '$id_horario' ;");

if($update){

    die(json_encode(array('result'=>true,'message'=>'El día se ha agreado correctamente')));

}else{

    die(json_encode(array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde!')));

}

mysqli_close($mysqli);

?>