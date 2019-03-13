<?php
require("conexion.php");
require 'phpmailer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];
$clave = $_POST["clave"];
      
$resultado = mysqli_query($con, "SELECT * FROM login WHERE email = '$email'");
$contador = mysqli_num_rows($resultado);
$clave_encrip = password_hash($clave, PASSWORD_DEFAULT);

if($contador != 1){
        echo "<script type='text/javascript'>alert('El correo que ingresaste no está registrado. Por favor vuelve e inténtalo de nuevo.');history.go(-1);</script>";
}else{

		$query = "UPDATE login SET clave='$clave_encrip' WHERE email='$email' ";
		$subir = mysqli_query($con, $query);
		$datos = mysqli_query($con, "SELECT * FROM login WHERE email = '$email' ");			
		
		////////// ENVÍO DEL CORREO CON DATOS ///////////
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				$mail->isSMTP();                                 
				$mail->Host = 'smtp.gmail.com'; 
				$mail->SMTPAuth = true;                            
				$mail->Username = 'meteorinopi@gmail.com';        
				$mail->Password = 'meteorinopi2018';                   
				$mail->SMTPSecure = 'tls';                       
				$mail->Port = 587;  
				$mail->CharSet = 'utf-8';

			    $mail->setFrom('meteorinopi@gmail.com', 'MeteorinoPi');
			    $mail->addAddress($email);
			    $mail->Subject = 'Has solicitado un cambio de clave en MeteorinoPi';
			    $mail->Body    = '¡Hola!, tu nueva clave es '.$clave.', te recomendamos guardar este correo. Disfruta de MeteorinoPi!.';
			    $mail->send();
		/////////////// FIN CORREO //////////////////////
	
	if($sql = mysqli_fetch_array($datos)){
		$mi_usuario = $sql['usuario'];
		$mi_email = $sql['email'];
		$mi_clave = "'".$sql['clave']."'";
		$nivel_sql = $sql['nivel'];
		$_SESSION['mi_usuario'] = $mi_usuario;
		$_SESSION['mi_nivel'] = $nivel_sql;

		echo "<script>alert('La clave se ha actualizado exitosamente!'); window.location = './index.php';</script>";
	}
}

mysqli_close($con);

?>