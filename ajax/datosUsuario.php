<?php
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_user = $_POST['id_user'];

$query = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE id_user = $id_user ;");

while($row = mysqli_fetch_array($query)){
    $usuario = $row['usuario'];
    $email = $row['email'];
    $name = $row['name'];

    $res = array('usuario'=>$usuario,'email'=>$email,'name'=>$name,'result'=>true);
}
if(!$query){
    $res = array('message'=>'No se puede conectar en este momento','result'=>false);
}
echo json_encode($res);
mysqli_close($mysqli);

?>