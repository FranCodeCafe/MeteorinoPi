<?php
require("conexion.php");
session_start();

$nivel = "3";
$email = $_POST["email"];
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
      
$resultado = mysqli_query($con, "SELECT * FROM login WHERE email = '$email'");
$contador = mysqli_num_rows($resultado);

if($contador == 1){
		echo "<script type='text/javascript'>alert('El correo ya ha sido ingresado anteriormente.')</script>";
	}else{
		$query = "INSERT INTO login(nivel,usuario,email,clave) VALUES('$nivel','$usuario','$email','$clave')";
		$subir = mysqli_query($con, $query);
		
		$datos = mysqli_query($con, "SELECT * FROM login WHERE usuario = '$usuario' ");			
		
	
	if($sql = mysqli_fetch_array($datos)){
		$mi_usuario = $sql['usuario'];
		$mi_email = $sql['email'];
		$mi_clave = "'".$sql['clave']."'";
		$nivel_sql = $sql['nivel'];
		$_SESSION['mi_usuario'] = $mi_usuario;
		$_SESSION['mi_nivel'] = $nivel_sql;

		//$asunto = "Te damos la bienvenida a MeteorinoPi!";
		//$mensaje = "Hola! Te recordamos que tu usuario es ".$mi_usuario.";
		//mail('"'.$mi_email.'"',$asunto,$mensaje,"MeteorinoPi");

	}
	
	

	if ($nivel_sql == 3) { 
		header("Location: index.php"); 
	}else{
		header("Location: index.php");
	}
}




mysqli_close($con);

?>