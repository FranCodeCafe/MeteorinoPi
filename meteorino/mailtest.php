<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
		$mail->isSMTP();                                 
		$mail->Host = 'smtp.gmail.com'; 
		$mail->SMTPAuth = true;                            
		$mail->Username = 'meteorinopi@gmail.com';        
		$mail->Password = 'meteorinopi2018';                   
		$mail->SMTPSecure = 'tls';                       
		$mail->Port = 587;  

	    $mail->setFrom('meteorinopi@gmail.com', 'MeteorinoPi');
	    $mail->addAddress('franciscasalinascastillo@gmail.com');
	    $mail->Subject = '¡Te damos la bienvenida a MeteorinoPi!';
	    $mail->Body    = '¡Hola! Te recordamos que tu usuario es y tu clave es. Esperamos que disfrutes de MeteorinoPi.';
	    $mail->send();
    echo 'Message has been sent';
}