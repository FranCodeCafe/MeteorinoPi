<?php
	
	include ("conexion.php");

	$consulta = "SELECT * FROM weather ORDER BY id DESC";
	$registro = mysqli_query($con,$consulta);
	
	$tabla = "";
	
	while($row = mysqli_fetch_array($registro)){	

		$tabla.='{
				  "fecha2":"'.$row['fecha2'].'",
				  "humedad":"'.$row['humedad'].'",
				  "temperatura":"'.$row['temperatura'].'",
				  "presion":"'.$row['presion'].'",
				  "vientodir":"'.$row['vientodir'].'",
				  "vientovel":"'.$row['vientovel'].'",
				  "lluvia":"'.$row['lluvia'].'",
				  "luz":"'.$row['luz'].'",
				  "co2":"'.$row['co2'].'",
				  "uv":"'.$row['uv'].'",
				  "polvo":"'.$row['polvo'].'",
				  "temperatura2":"'.$row['temperatura2'].'"
				},';		
	}	

	//eliminamos la coma que sobra
	$tabla = substr($tabla,0, strlen($tabla) - 1);

	echo '{"data":['.$tabla.']}';	

?>