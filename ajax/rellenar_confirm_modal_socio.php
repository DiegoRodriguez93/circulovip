<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$id_cupon = $_POST['id_cupon'];

$query= mysqli_query($mysqli,"SELECT c.name, c.address, c.phone, cg.id_cupon, cg.fecha_vencimiento, cg.descuento, cg.id_user, cg.codigo
FROM cupones_generados AS cg
INNER JOIN comercios AS c
ON cg.id_comercio = c.id_comercio
WHERE cg.id_cupon = '$id_cupon' 
AND cg.disponible = 1 
");

while( $row = mysqli_fetch_array($query) ){

    $commerce_name = $row['name'];
    $commerce_address = $row['address'];
    $commerce_phone = $row['phone'];
    $fecha_vencimiento = $row['fecha_vencimiento'];
    $descuento = $row['descuento'];
    $codigo = $row['codigo'];
    $id_cupon = $row['id_cupon'];

    $response = array(
        'commerce_name'=>$commerce_name,
        'commerce_address'=>$commerce_address,
        'commerce_phone'=>$commerce_phone,
        'fecha_vencimiento'=>$fecha_vencimiento,
        'descuento'=>$descuento,
        'codigo'=>$codigo,
        'id_cupon'=>$id_cupon
    );

}

echo json_encode($response);
mysqli_close($mysqli);

?>