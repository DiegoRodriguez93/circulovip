<?php

require '../_conexion.php';

$target_dir = "../../uploads/";
$fileName =  time() . rand(11, 99) . basename( $_FILES['imagenSponsor']['name']);
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["imagenSponsor"]["tmp_name"]);

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

if ($_FILES["imagenSponsor"]["size"] > 614400) {
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

    if (move_uploaded_file($_FILES["imagenSponsor"]["tmp_name"], $target_file)) {
        $ok = "The file ". basename( $_FILES["imagenSponsor"]["name"]). " has been uploaded.";
        /* $imagePath = basename( $_FILES["imagenSponsor"]["name"]); */
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

$href  = mysqli_real_escape_string($mysqli,$_POST['href']);
$tipo  = mysqli_real_escape_string($mysqli,$_POST['tipo']);
$logo_url = $_SERVER['SERVER_NAME'].$imagePath;

// i check if the image with this type has been uploaded before

$select = mysqli_query($mysqli, "SELECT tipo FROM sponsors WHERE tipo = '$tipo' ");

if(mysqli_num_rows($select) > 0){

    $res = array('result'=>false,'message'=>'El sponsor tipo '. $tipo . '
     ya ha sido cargado, eliminé el anterior y vuelva a intantarlo');
     mysqli_close($mysqli);
     die(json_encode($res));

}else{

    $insert = mysqli_query($mysqli, "INSERT INTO sponsors (url_image, href, tipo) 
    VALUES ('$logo_url', '$href', '$tipo') ");

    if($insert){

        $res = array('result'=>true,'message'=>'El sponsor se ha cargado correctamente');
        mysqli_close($mysqli);
        die(json_encode($res));

    }else{

        $res = array('result'=>false,'message'=>'Ha ocurrido un error intente más tarde');
        mysqli_close($mysqli);
        die(json_encode($res));

    }

}

mysqli_close($mysqli);

?>