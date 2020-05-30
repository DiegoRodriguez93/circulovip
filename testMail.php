<?php

// ip-172-26-7-156.ec2.internal_ username admin pass 1rsOVyI72r
  $email = 'diegorodriguez93@hotmail.com';
  $first_name = 'Diego Rodriguez';
  $LE  = "\r\n";
  // Send registration confirmation link (verify.php)
  $to      = $email;
  $headers  = "From: Ajedrez Latino <ajedrezlatino@ajedrezlatino.com>$LE";
  $headers .= "Reply-To: entrenamientos@ajedrezlatino.com$LE";
  $headers .= 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $subject = $first_name . '! Nuevo Entrenamiento Intensivo! Inglesa, Francesa, Kasparov y mucho más!';
  #$params = '-f"ajedrezlatino@ajedrezlatino.com"';
  $message_body = '<!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
  </head>
  
  <body>
      <table align="center" border="0" cellpadding="0" cellspacing="0"
          style="max-width: 600px; width: 90%; background-color: #fff; background-image: none;
           background-repeat: repeat; background-position: left top; background-attachment: scroll;
            font-size: 13px; line-height: 15px; font-family: Helvetica Neue, Helvetica, Arial, Geneva, sans-serif;
             padding-bottom: 20px; color: #09F"
          width="100%">
          <tbody>
              <tr></tr>     
              <tr>
              <td align="center"><span style="font-size: 12px; line-height: 15px; text-align: center; color: #000">Si
                      no quieres recibir más este tipo de correo, haz clic <a
                          href="https://ajedrezlatino.com/blacklist/blacklist.php?correo='.$email.'" style="color: #333"
                          title="Abrir en un navegador" target="_blank" rel="noreferrer">AQUÍ</a></span></td>
              </tr>
              <tr>
                  <td align="center">
                      <table border="0" width="600">
                          <tbody>
                              <tr>
                                  <td>
                                      <div align="center">
                                          <p><br><a href="https://ajedrezlatino.com"
                                                  target="_blank" rel="noreferrer"><img alt="Ajedrez Latino Logo" height="33"
                                                      src="https://ajedrezlatino.com/images/almin.png"
                                                      width="90"></a></p>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <div align="center">&nbsp;
                                          <table align="center" border="0" cellpadding="0" cellspacing="0"
                                              style="border-collapse: collapse; font-size: 22px; line-height: 25px; color: #333">
                                              <tbody>
                                                  <tr>
                                                      <td class="center"
                                                          style="font-size: 16px; color: #000000; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px">
                                                          <div style="padding: 0; margin: 0; max-width: 600px"><a
                                                                  href="https://youtube.com/ajedrezlatino"
                                                                  style="color: #00a3ec; text-decoration: none"
                                                                  title="Cargar" target="_blank" rel="noreferrer">Youtube /
                                                              </a><a
                                                                  href="https://Facebook.com/ajedrezlatino"
                                                                  style="color: #00a3ec; text-decoration: none"
                                                                  title="Ingresar" target="_blank"
                                                                  rel="noreferrer">Facebook / </a><a
                                                                  href="https://instagram.com/ajedrezlatino"
                                                                  style="color: #00a3ec; text-decoration: none"
                                                                  title="Beneficios" target="_blank"
                                                                  rel="noreferrer">Instagram / </a><a
                                                                  href="https://ajedrezlatino.com"
                                                                  style="color: #00a3ec; text-decoration: none"
                                                                  title="Solicitar" target="_blank"
                                                                  rel="noreferrer">Web</a></div>
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
  
                                      <hr color="e0e0e0" size="1" width="590">
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                      <table align="center" border="0" cellpadding="0" cellspacing="0" class="deviceWidth"
                          style="border-collapse: collapse; font-size: 13px; line-height: normal; color: #000"
                          width="600">
                          <tbody>
                              <tr>
                                  <td bgcolor="#e8e8e7" class="center" width="100%"><!-- width="600" height="372" -->
                                      <div align="center">
                                      <a
                                      href="mailto:entrenamientos@ajedrezlatino.com"
                                              target="_blank" rel="noreferrer"><img
                                                  src="https://ajedrezlatino.com/images/curso2.jpg" height="600" width="422"
                                                  ></a>
                                                  <a href="mailto:entrenamientos@ajedrezlatino.com" target="_blank"><h3> Consultar via mail </h3></a>
                                                     
                                                  <br>
                                              </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </td>
              </tr>
              <tr></tr>
              <tr>
                  <td align="center" style="font-size: 12px; text-align: center; color: #000000; background-color: #fff">
                      <div align="center">&nbsp;</div>
  
                      <div align="center">
                          <table align="center" border="0" cellpadding="0" cellspacing="0"
                              style="border-collapse: collapse; font-size: 21px; line-height: 25px; color: #333">
                              <tbody>
                                  <tr>
                                      <td class="center"
                                          style="font-size: 16px; color: #000000; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px">
                                          <div style="padding: 0; margin: 0; max-width: 600px"><a
                                                  href="https://youtube.com/ajedrezlatino"
                                                  style="color: #00a3ec; text-decoration: none"
                                                  title="Cargar" target="_blank" rel="noreferrer">Youtube /
                                              </a><a
                                                  href="https://Facebook.com/latinoajedrez"
                                                  style="color: #00a3ec; text-decoration: none"
                                                  title="Ingresar" target="_blank"
                                                  rel="noreferrer">Facebook / </a><a
                                                  href="https://instagram.com/ajedrezlatino"
                                                  style="color: #00a3ec; text-decoration: none"
                                                  title="Beneficios" target="_blank"
                                                  rel="noreferrer">Instagram / </a><a
                                                  href="https://ajedrezlatino.com"
                                                  style="color: #00a3ec; text-decoration: none"
                                                  title="Solicitar" target="_blank"
                                                  rel="noreferrer">Web</a></div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
  
                      <p><span class="center"><a href="https://ajedrezlatino.com"
                          target="_blank" rel="noreferrer"><img alt="Ajedrez Latino Logo" height="33"
                              src="https://ajedrezlatino.com/images/almin.png"
                              width="90"></a></span>
                      </p>
  
                      <p>Copyright © 2020&nbsp;- Ajedrez Latino<br></p>
                  </td>
              </tr>
          </tbody>
      </table>
  
  </body>
  
  </html>
  ';

  /* mail($to, $subject, $message_body, null, $params); */

  $result = mail($to, $subject, $message_body, $headers, $params);

  if($result) {   
      $res = array('result'=>true,'email'=>$email,'name'=>$first_name);
  } else {
    $res = array('result'=>false);
  }

  sleep(3);

echo json_encode($res);
?>