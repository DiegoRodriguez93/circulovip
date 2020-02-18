<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$zona_horaria = mysqli_real_escape_string($mysqli, $_POST['zona_horaria']);

$fecha = date_create("now");

$fecha = date_format($fecha,"Y/m/d H:i:s");

$select = mysqli_query($mysqli, "SELECT * FROM citas 
WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') AND dia_hora >= '$fecha' AND estado = 1 limit 1 ");

if(mysqli_num_rows($select) > 0){

    $row = mysqli_fetch_assoc($select);
/* TODO : CONVERT TO GMT BEFORE PRINT ON SCREEN */
    $fecha = date_create($row['dia_hora']);

    $fecha = date_format($fecha,'Y/m/d H:i:s');

    $res[] = array('fecha'=>$fecha,'sala'=>$row['sala']);

}else{

    $res = array();

}

mysqli_close($mysqli);
echo json_encode($res);


?>