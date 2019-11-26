<?php
header("Access-Control-Allow-Origin: *");
    //CONFIGURACIÓN DEL SERVIDOR
	$emailHost      = 'mail.vida.com.uy';			//HOST DESDE EL CUAL SE ENVÍA EL CORREO
	$emailPort      = '26';							//PUERTO DESDE EL CUAL SE ENVÍA EL CORREO
	$emailUser      = 'afiliacionweb@vida.com.uy';	//USUARIO HABILITADO PARA HACER USO DEL HOST
	$emailPass      = '2k8.vida'; 					//CONTRASEÑA DEL HOST

	//CONFIGURACIÓN VISIBLE PARA EL USUARIO (LA VARIABLE email SE SETEA EN EL ARCHIVO QUE INCLUYE A ÉSTE)
	$emailFrom		= 'afiliacionweb@vida.com.uy';	//MAIL DESDE EL QUE SE ENVÍA EL CORREO
	$emailFromName	= 'VIDA';								//NOMBRE QUE SE LE MUESTRA AL USUARIO
	$emailSubject	= 'Recuperar contraseña';				//ASUNTO DEL CORREO

	$emailBody		= utf8_decode('
		<!DOCTYPE html>
		<html lang="es">
			<body style="background: rgba(235,235,235, 0.3);font-size:18px; ">Hola '.$name.',<br><br>

       			Has solicitado un cambio de clave!<br><br>

        		Por favor ingrese al siguiente enlace para cambiar la clave:<br><br>'.$url.'<br><br>
      
			</body>
		</html>'
	);

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->isHTML(true);
	$mail->Mailer = "SMTP";
	$mail->Host = $emailHost;
	$mail->Port = $emailPort;

	$mail->SMTPAuth = true;
	$mail->Username = $emailUser;
	$mail->Password = $emailPass;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->From     = $emailFrom;
	$mail->FromName = utf8_decode($emailFromName);
	/* Mail de Guamatour */
	//$mail->AddAddress('d.rodriguez@vida.com.uy');
 	$mail->AddAddress($email); 	
	$mail->Subject  = utf8_decode($emailSubject);
	$mail->Body     = $emailBody;
	$mail->WordWrap = 50;
	$mail->send();