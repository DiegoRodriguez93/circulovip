<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

$target_dir = "../admin/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

if($check !== false) {
    // El archivo es una imagen
    $uploadOk = 1;
} else {

    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'El archivo no es una image');
    die(json_encode($response));
}

if (file_exists($target_file)) {
    // El archivo ya existe
    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'El archivo ya existe');
    die(json_encode($response));
}

if ($_FILES["fileToUpload"]["size"] > 614400) {
    // el arcivo es muy pesado
    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'El archivo es muy pesado');
    die(json_encode($response));
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "webp") {
    //Formatos de imagen permitidos
    $uploadOk = 0;
    $response = array('result'=>false,'message'=>'Formato de imagén no permitido');
    die(json_encode($response));
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk != 0) {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $ok = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $imagePath = basename( $_FILES["fileToUpload"]["name"]);
    } else {
        $response = array('result'=>false,'message'=>'Ha ocurrido un error intenté más tarde');
        die(json_encode($response));
    }

} else {

    $response = array('result'=>false,'message'=>'Haa ocurrido un error intenté más tarde');
    die(json_encode($response));

}

$email = $_POST['email'];
$pass    = $mysqli->escape_string(password_hash($_POST['pass'], PASSWORD_BCRYPT));
$name       = $_POST['nombre'];
$address    = $_POST['address'];
$phone       = $_POST['phone'];
$rubro       = $_POST['rubro'];
$hash    = $mysqli->escape_string( md5( rand(0,1000) ) );
$logo_url = "https://vida-apps.com/vidapesos/admin/uploads/".$imagePath;

// Check if commerce with that email already exists
$result   = $mysqli->query("SELECT * FROM comercios WHERE email='$email'") or die(mysqli_errno($mysqli));

if ( $result->num_rows > 0 ) {
    
   $res = array('result'=>false,'message'=>'El comercio con este mail ya esta registrado');
   die(json_encode($res));
}else { 


    $sql = "INSERT INTO comercios (name, address, phone, email,  hash, pass, activo, rubro, logo_url) 
         VALUES ('$name', '$address', '$phone', '$email', '$hash', '$pass', '1','$rubro', '$logo_url')";

    if ( $mysqli->query($sql) ){

        $res = array('result'=>true,'message'=>'El comercio se ha registrado correctamente');
        die(json_encode($res));
    } else {
       
        $res = array('result'=>false,'message'=>'No se ha podido registrar el comercio en este momento, intenté más tarde');
        die(json_encode($res));

    }

}



mysqli_close($mysqli);

?>