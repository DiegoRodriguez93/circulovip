<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$query = mysqli_query($mysqli,"SELECT *
FROM comercios
;");

while($row = mysqli_fetch_array($query)){

    $id = $row['id_comercio'];
    $name = $row['name'];
    $address = $row['address'];
    $phone = $row['phone'];
    $email = $row['email'];
    $activo = $row['activo'];
    if($activo == 1){
        $activo = 'si';
    }else{
        $activo = 'no';
    }

    $response[] = array($id, $name, $address, $phone, $email, $activo);
}

echo '{"data":'. json_encode($response) . '}';

mysqli_close($mysqli);


?>