<?php 

require '../../_conexion.php';

$id_user        = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$nombre         = mysqli_real_escape_string($mysqli, $_POST['nombre']);
$descripcion    = mysqli_real_escape_string($mysqli, $_POST['descripcion']);
$pais           = mysqli_real_escape_string($mysqli, $_POST['pais']);

$query = mysqli_query($mysqli,"SELECT * FROM datos_empresa WHERE id_user = '$id_user' ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    $update = mysqli_query($mysqli,"UPDATE datos_empresa 
    SET nombre = '$nombre', descripcion = '$descripcion', pais = '$pais'
    WHERE id_user = '$id_user' ");

        $res = array('result'=>true,
        'message'=>'Datos actualizados correctamente',
        'nombre'=>$nombre,
        'descripcion'=>$descripcion,
        'pais'=>$pais);
        die(json_encode($res));

}else{

    $insert = mysqli_query($mysqli,"INSERT INTO datos_empresa (id_user, nombre, pais, descripcion) VALUES 
    ('$id_user', '$nombre', '$pais', '$descripcion')");

        $res = array('result'=>true,
        'message'=>'Datos actualizados correctamente',
        'nombre'=>$nombre,
        'descripcion'=>$descripcion,
        'pais'=>$pais);
        die(json_encode($res));

}

mysqli_close($mysqli);


?>