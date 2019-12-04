<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_cedula = $_POST['id_cedula'];

$query = mysqli_query($mysqli,"DELETE FROM cedulas_agregadas WHERE id_cedula = '$id_cedula' ");

if($query){

    $response = array('result'=>true,'message'=>'Se ha eliminado el acceso correctamente') ;
    
    echo json_encode($response);

}else{

    $response = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde') ;
    
    echo json_encode($response);
}

mysqli_close($mysqli);

?>