<?php
session_start();
require("conexion.php");

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$datos = $con->query("SELECT * FROM login WHERE usuario = '$usuario' ");


	if($sql = mysqli_fetch_array($datos)){
		$mi_clave = $sql['clave'];

		if ($clave == $mi_clave){

			$mi_usuario = $sql['usuario'];
			$nivel_sql = $sql['nivel'];
			$_SESSION['mi_usuario'] = $mi_usuario;
			$_SESSION['mi_nivel'] = $nivel_sql;
			header("Location: index.php");
		}else{			
			echo "<script type='text/javascript'>alert('Las claves no coinciden, por favor regrese e inténtelo de nuevo.')</script>";
		}

	}else{
		header("Location: index.php");
	}

?>