<?php
$para      = 'latinoajedrez@gmail.com';
$titulo    = 'El título';
$mensaje   = 'Hola';
$cabeceras = '';

$mail = mail($para, $titulo, $mensaje, $cabeceras);

if($mail){

    echo 'Email enviado correctamente';

}else{

    echo 'error al enviar mail';

}
?>