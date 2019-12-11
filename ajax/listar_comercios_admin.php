<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$query = mysqli_query($mysqli,"SELECT *
FROM estado_de_cuenta_comercios_view
;");

while($row = mysqli_fetch_array($query)){

    $id      = $row['id_comercio'];
    $name    = $row['name'];
    $email   = $row['email'];
    $address = $row['address'];
    $phone   = $row['phone'];
    $rubro   = $row['rubro'];
    $logo_url   = $row['logo_url'];
    $activo     = $row['activo'];
    $disponible = $row['disponible'];

    if($activo == 1){
        $activo = 'si';
    }else{
        $activo = 'no';
    }

    $image = '<img src"'.$logo_url.'" heigth="35" width="35" />';

    $response[] = array($id, $name, $email, $address, $phone, $rubro, $activo, $disponible, $image);
}

echo '{"data":'. json_encode($response) . '}';

mysqli_close($mysqli);


?>