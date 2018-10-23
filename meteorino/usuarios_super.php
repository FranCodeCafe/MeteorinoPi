<?php
require('conexion.php');
@session_start();

//////////////// SEGURIDAD (?) ///////////////////
if(isset($_SESSION['mi_nivel'])){
	if(($_SESSION['mi_nivel'])==1){
		echo (" ");
	}else{
		if (!defined('BASEPATH'))
	    header("Location: index.php");
	}
}
/////////////////////////////////////////////////


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum.scale=1.0 minimum.scale=1.0 ">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MeteorinoPi | Usuarios</title>
    <link rel="shortcut icon" type="image/png" href="imgs/suncloud.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="font-awesome/css/all.css" rel="stylesheet" type="text/css">
    <link href="weather-icons-master\css\weather-icons.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="js/funciones.js"></script>
</head>

<body>

    <?php
    //////////////////////// CHECKLOGIN PASO 2 ////////////////////////
    if(isset($_SESSION['mi_nivel'])){
        if ($_SESSION['mi_nivel'] == 1){ require("super.php"); }
        if ($_SESSION['mi_nivel'] == 2){ require("admin.php"); }
        if ($_SESSION['mi_nivel'] == 3){ require("online.php"); }
    }else{
        require("offline.php");
    }
    ////////////////////////////////////////////////////////////
    ?>

<div class="container" style="padding-top:80px; margin-bottom:30px;">

<h2>Control de usuarios</h2>
<p></p>

    <div class="table-responsive">    
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nivel</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
                <?php
                    $consulta = "SELECT * FROM login";
                    $registro = mysqli_query($con,$consulta);                    
                    while($row = mysqli_fetch_array($registro)){	
                ?>
                
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nivel']; ?></td>
                    <td><?php echo $row['usuario']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><button href="actualizar.php?id=<?php echo $row['id']; ?>" class="btn btn-info" data-toggle="modal" data-target="#update"><i class="far fa-edit"></i></button></td>
                    <td><button href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="far fa-trash-alt"></i></button> <?php } ?></td>
                </tr>
                
            <tbody>
                
            </tbody>
            <tfoot>
                <tr>
                    <th>N°</th>
                    <th>Nivel</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </tfoot>
        </table>        
    </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0;"></div>

    <?php include("html/modal_actualizar_super.php");?>
    <?php include("html/modal_eliminar.php");?>

</body>
</html>