<?php
	
	include ("conexion.php");

	$consulta = "SELECT * FROM login WHERE nivel = 3";
    $registro = mysqli_query($con,$consulta); 

	$tabla = "";

    while($row = mysqli_fetch_array($registro)){	

    	$tabla.='{
				  "id":"'.$row['id'].'",
				  "nivel":"'.$row['nivel'].'",
				  "usuario":"'.$row['usuario'].'",
				  "email":"'.$row['email'].'",
				  "actualizar":"<center><button href=#update class=btn btn-info data-toggle=modal data-id='.$row['id'].'>Actualizar</button></center>",
				  "eliminar":"<center><button href=#delete class=btn btn-danger data-toggle=modal data-id='.$row['id'].'>Eliminar</button></center>"
				  },';
	}
	
	//elimina data-toggle=modal
	$tabla = substr($tabla,0, strlen($tabla) - 1);

	echo '{"data":['.$tabla.']}';

?>