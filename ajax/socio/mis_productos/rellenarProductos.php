<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli,$_GET['id_user']);

$select = mysqli_query($mysqli,"SELECT id_empresa FROM datos_empresa WHERE id_user = '$id_user' ");

if(mysqli_num_rows($select) == 0){

    
    $insert = mysqli_query($mysqli,"INSERT INTO datos_empresa (id_user) VALUES ('$id_user')");
    $select2 = mysqli_query($mysqli,"SELECT id_empresa FROM datos_empresa WHERE id_user = '$id_user' ");

    $de = mysqli_fetch_assoc($select2);
    $id_empresa = $de['id_empresa'];

}else{

    $de = mysqli_fetch_assoc($select);
    $id_empresa = $de['id_empresa'];

}

$select3 = mysqli_query($mysqli,"SELECT * FROM productos WHERE id_empresa = '$id_empresa' ");

if(mysqli_num_rows($select3) > 0){

    while($row = mysqli_fetch_assoc($select3)){

        $id_producto    = $row['id_producto'];
        $nombre         = $row['nombre'];
        $descripcion    = $row['descripcion'];
        $img_url        = $row['img_url'];

        $res[] = array(
        'id_producto'   =>$id_producto,
        'nombre'        =>$nombre,
        'descripcion'   =>$descripcion,
        'img_url'       =>$img_url); 

    }

}else{

    $res = array();

}

echo json_encode($res);
mysqli_close($mysqli);



?>