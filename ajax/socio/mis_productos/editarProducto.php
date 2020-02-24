<?php

require '../../_conexion.php';

if(!isset($_POST['imagenProducto'])){



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

$logo_url = $_SERVER['SERVER_NAME'].$imagePath;

}else{

    $logo_url = '';

}

$id_user  = mysqli_real_escape_string($mysqli,$_POST['id_user']);
$id_producto  = mysqli_real_escape_string($mysqli,$_POST['id_producto']);
$nombre  = mysqli_real_escape_string($mysqli,$_POST['nombreProducto']);
$descripcion  = mysqli_real_escape_string($mysqli,$_POST['descripcionProducto']);


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
    /* COMPROBAMOS SI SE ACTUALIZO LA IMAGEN */
    if($logo_url != ''){
        $statement = ", img_url = '$logo_url' ";
    }else{
        $statement = '';
    }

/* UPDATE */
$update = mysqli_query($mysqli,"UPDATE productos
SET nombre = '$nombre',
 descripcion = '$descripcion' $statement
WHERE id_producto = '$id_producto' ; ");

        $response = array('result'=>true,'message'=>'Producto editado correctamente'); 
        mysqli_close($mysqli);
        die(json_encode($response));

?>