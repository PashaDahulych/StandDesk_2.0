<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('uk', 'phpmailer/language/');
	$mail->IsHTML(true);

	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'standdesk.com.ua@gmail.com';                     //SMTP username
	$mail->Password   = 'wzrq pqmr qmga ptda';                               //SMTP password
	$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
	$mail->Port       = '587';                 
	
    

	//Від кого лист
	$mail->setFrom('standdesk.com.ua@gmail.com', 'StandDesk форма замовлення'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('standdesk.com.ua@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'StandDesk форма замовлення';

	//Тіло листа
	$body = '<h1>Лист для StandDesk</h1>';

	if(trim(!empty($_POST['firstname']))){
		$body.= '<p><>Імʼя: <strong>' . $_POST['firstname'].'</strong></p>' ;
	}	
	if(trim(!empty($_POST['firstnamesec']))){
		$body.= '<p><>Імʼя: <strong>' . $_POST['firstnamesec'].'</strong></p>' ;
	}
	if(trim(!empty($_POST['tel']))){
		$body.= '<p><>Номер телефону: <strong>' . $_POST['tel'].'</strong></p>' ;
	}
	if(trim(!empty($_POST['telsec']))){
		$body.= '<p><>Номер телефону: <strong>' . $_POST['telsec'].'</strong></p>' ;
	}
	if(trim(!empty($_POST['color']))){
		$body.= '<p><>Колір: <strong>' . $_POST['color'].'</strong></p>' ;
	}	
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>