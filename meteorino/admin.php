<?php
require('conexion.php');
@session_start();

//////////////// SEGURIDAD (?) ///////////////////
if(isset($_SESSION['mi_nivel'])){
	if(($_SESSION['mi_nivel'])==2){
		echo (" ");
	}else{
		if (!defined('BASEPATH'))
	    header("Location: index.php");
	}
}
/////////////////////////////////////////////////


?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="index.php">MeteorinoPi</a>
    </a>
    <a class="nav-link" style="color:white"><?php echo "Bienvenido/a ".$_SESSION['mi_usuario']."!"; ?></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
        
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="weather.php"><i class="fa fa-chart-line"></i> Datos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="usuarios.php"><i class="fa fa-users"></i> Control de Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logoff.php"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
            </li>
        </ul> 
    </div>  
</nav>