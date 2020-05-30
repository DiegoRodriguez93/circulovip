<?php


/* $nombre = 'Diego Rodriguez';
$mail2 = 'latinoajedrez@gmail.com'; */
/* $body2  = 'asd';
$subject2 = 'Prueba'; */

//include 'body/registerUserMail.php';

//sendMail($nombre, $mail2, $body, $subject);

function sendMail($name, $mail, $body, $subject){

    $email = $mail;
    //$first_name = $name;
    $LE = "\r\n";
    // Send registration confirmation link (verify.php)
    $to = $email;
    $headers = "From: Circulo Vip <noresponder@plataformacirculovip.com>$LE";

    $headers .= "Reply-To: info@plataformacirculovip.com$LE";

    $headers .= 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

   // $subject = $first_name . '! Bienvenido a Circulo Vip!';

    $params = '-f"noresponder@plataformacirculovip.com"';

    $message_body = $body;

    $result = mail($to, $subject, $message_body, $headers, $params);

    if ($result) {

        return true;
    } else {

        return false;
    }

}
