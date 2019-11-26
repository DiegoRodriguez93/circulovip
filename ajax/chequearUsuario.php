<?php
header("Access-Control-Allow-Origin: *");
/* require '_conexion250.php';
require '_conexion.php';

$usuario = $mysqli250->escape_string($_POST['usuario']);

$query = mysqli_query($mysqli250,"SELECT cedula FROM abmmod.padron_datos_socio WHERE cedula = '$usuario' ");

$contar = mysqli_num_rows($query) ;

if($contar > 0){
    $res = array('result'=>true,'message'=>'Cedula correcta');
}else {

    $query2 = mysqli_query($mysqli,"SELECT cedula FROM cedulas_agregadas WHERE cedula = '$usuario'");

    $contar2 = mysqli_num_rows($query2) ;

    if($contar2 > 0){

        $res = array('result'=>true,'message'=>'Cedula correcta');
        
    }else {

    $res = array('result'=>false,'message'=>'El usuario con esa cédula no se encuentra registrado');}
}
 */
$res = array('result'=>true,'message'=>'Cedula correcta');

echo json_encode($res);
/* mysqli_close($mysqli250); */


?>