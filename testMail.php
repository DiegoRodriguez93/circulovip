<?php
$para      = 'diegorodriguez93@hotmail.com';
$titulo    = 'El título';
$mensaje   = 'Hola';
$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$mail = mail($para, $titulo, $mensaje, $cabeceras);

if($mail){

    echo 'Email enviado correctamente';

}else{

    echo 'error al enviar mail';

}
?>