<?php 

require '../../_conexion.php';

$id_user        = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$cargo          = mysqli_real_escape_string($mysqli, $_POST['cargo']);
$acerca_de_mi   = mysqli_real_escape_string($mysqli, $_POST['acerca_de_mi']);

$query = mysqli_query($mysqli,"SELECT * FROM datos_user WHERE id_user = '$id_user' ");

$contar = mysqli_num_rows($query);

if($contar > 0){

    $update = mysqli_query($mysqli,"UPDATE datos_user 
    SET cargo = '$cargo', acerca_de_mi = '$acerca_de_mi'
    WHERE id_user = '$id_user' ");

        $res = array('result'=>true,
        'message'=>'Datos actualizados correctamente',
        'cargo'=>$cargo,
        'acerca_de_mi'=>$acerca_de_mi);
        die(json_encode($res));

}else{

    $insert = mysqli_query($mysqli,"INSERT INTO datos_user (id_user, cargo, acerca_de_mi) VALUES 
    ('$id_user', '$cargo', '$acerca_de_mi')");

    $res = array('result'=>true,
    'message'=>'Datos actualizados correctamente',
    'cargo'=>$cargo,
    'acerca_de_mi'=>$acerca_de_mi);
    die(json_encode($res));

}

mysqli_close($mysqli);


?>