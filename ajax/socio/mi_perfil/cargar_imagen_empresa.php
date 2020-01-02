<?php 

require '../../_conexion.php';

$target_dir = "../../../uploads/";
$fileName =  time() . rand(11, 99) . basename( $_FILES['enterprisePicture']['name']);
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["enterprisePicture"]["tmp_name"]);

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

if ($_FILES["enterprisePicture"]["size"] > 614400) {
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

    if (move_uploaded_file($_FILES["enterprisePicture"]["tmp_name"], $target_file)) {
        $ok = "The file ". basename( $_FILES["enterprisePicture"]["name"]). " has been uploaded.";
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
$logo_url = $_SERVER['SERVER_NAME'].$imagePath;

// Check if enterprise with that id_user already exists
$result   = $mysqli->query("SELECT id_user FROM datos_empresa WHERE id_user = '$id_user'") or die(mysqli_errno($mysqli));

if ( $result->num_rows == 0 ) {

   $insert = mysqli_query($mysqli,"INSERT INTO datos_empresa (url_image, id_user)
   VALUES ('$logo_url', '$id_user');");
    
   $res = array('result'=>true,'message'=>'Imagen de empresa actualizada correctamente');
   mysqli_close($mysqli);
   die(json_encode($res));

}else { 


    $sql = "UPDATE datos_empresa
    SET url_image = '$logo_url'
    WHERE id_user = '$id_user' ;";

    if ( $mysqli->query($sql) ){

        $res = array('result'=>true,'message'=>'Imagen de empresa actualizada correctamente');
        mysqli_close($mysqli);
        die(json_encode($res));
    } else {
       
        $res = array('result'=>false,'message'=>'No se ha podido actualizar su imagen de perfil en este momento, intenté más tarde');
        mysqli_close($mysqli);
        die(json_encode($res));

    }

}



mysqli_close($mysqli);

?>