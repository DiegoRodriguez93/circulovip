<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_user = $_POST['id_user'];

$query = mysqli_query($mysqli,"SELECT * FROM alerta_usuario WHERE id_usuario = '$id_user' and alertado = 0 ");

$contar = mysqli_num_rows($query);

if($contar > 0 ){

    $row = mysqli_fetch_assoc($query);

    $id     = $row['id'];
    $tipo   = $row['tipo_alerta'];
    
    $update = mysqli_query($mysqli,"UPDATE alerta_usuario
    SET alertado = '1'
    WHERE id = '$id' ");
    
    $response = array('result'=>true,'tipo'=>$tipo);

}else{

    $response = array('result'=>false,'message'=>'No hay transacciones activas en este momento');

}

echo json_encode($response);
mysqli_close($mysqli);



?>