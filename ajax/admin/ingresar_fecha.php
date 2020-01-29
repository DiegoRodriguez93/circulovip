<?php 

require '../_conexion.php';

$fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);

$select = mysqli_query($mysqli, "SELECT fecha FROM fechas_ronda WHERE fecha = '$fecha' ");

if(mysqli_num_rows($select) > 0 ){

    $res = array('result'=>false,'message'=>'La fecha ya se encuentra ingresada');

}else{

    $insert = mysqli_query($mysqli, "INSERT INTO fechas_ronda (fecha) VALUES ('$fecha') ");

    if($insert){

        $res = array('result'=>true,'message'=>'La fecha se ha ingresado correctamente');  

    }else{

        $res = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde');

    }

}

echo json_encode($res);
mysqli_close($mysqli);

?>