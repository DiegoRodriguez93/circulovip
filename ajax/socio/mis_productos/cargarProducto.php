<?php

require '../../_conexion.php';

$target_dir = "../../../uploads/";
$fileName =  time() . rand(11, 99) . basename( $_FILES['imagenProducto']['name']);
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["imagenProducto"]["tmp_name"]);

if($check !== false) {
    // El archivo es una imagen
    $uploadOk = 1;
} else {

    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'El archivo no es una imagen'); 
    mysqli_close($mysqli);
    die(json_encode($response));
}

if (file_exists($target_file)) {
    // El archivo ya existe
    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'El archivo ya existe'); 
    mysqli_close($mysqli);
    die(json_encode($response));
}

if ($_FILES["imagenProducto"]["size"] > 614400) {
    // el arcivo es muy pesado
    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'El archivo es muy pesado'); 
    mysqli_close($mysqli);
    die(json_encode($response));
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "webp") {
    //Formatos de imagen permitidos
    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'Formato de imagén no permitido'); 
    mysqli_close($mysqli);
    die(json_encode($response));
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk != 0) {

    if (move_uploaded_file($_FILES["imagenProducto"]["tmp_name"], $target_file)) {
        $ok = "The file ". basename( $_FILES["imagenProducto"]["name"]). " has been uploaded.";
        /* $imagePath = basename( $_FILES["enterprisePicture"]["name"]); */
        $imagePath = $target_file;
    } else {
        $response = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde'); 
        mysqli_close($mysqli);
        die(json_encode($response));
    }

} else {

    $response = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde'); 
    mysqli_close($mysqli);
    die(json_encode($response));

}
$id_user  = mysqli_real_escape_string($mysqli,$_POST['id_user']);
$nombre  = mysqli_real_escape_string($mysqli,$_POST['nombreProducto']);
$descripcion  = mysqli_real_escape_string($mysqli,$_POST['descripcionProducto']);
$logo_url = $_SERVER['SERVER_NAME'].$imagePath;

/* OBTENEMOS EL ID EMPRESA  */

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

$insert2 = mysqli_query($mysqli,"INSERT INTO productos (id_empresa, nombre, descripcion, img_url) VALUES
('$id_empresa', '$nombre', '$descripcion', '$logo_url') ");

        $response = array('result'=>true,'message'=>'Producto añadido correctamente'); 
        mysqli_close($mysqli);
        die(json_encode($response));

?>