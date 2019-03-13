<?php
require('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum.scale=1.0 minimum.scale=1.0 ">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MeteorinoPi | Reestablecer clave</title>
    <link rel="shortcut icon" type="image/png" href="imgs/suncloud.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="weather-icons-master/css/weather-icons.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
</head>

<body>

<?php
require("offline.php");
?>

<div class="container" style="padding-top:80px; margin-bottom:30px;">

<h2>Reestablecer clave</h2>
<p>Si olvidaste tu clave ingresa tu correo y una nueva clave. Te enviaremos un correo con los cambios realizados.</p>

                <div class="modal-body">
                    <form method="POST" id="registro" name="registro" class="needs-validation" action="cambiar_clave.php" novalidate>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email"> Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu email" maxlength="100" required>
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa un correo válido.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="clave"> Clave nueva</label>
                                <input type="password" class="form-control" id="clave" name="clave" onchange="validarClave()" placeholder="Ingresa una clave nueva" maxlength="50" required>
                                <input type="checkbox" onclick="mostrarClave()"> Mostrar clave
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa una clave nueva.
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="submit" name="enviar" class="btn btn-info">Enviar</button>
                                <button type="reset" class="btn btn-info">Limpiar</button>
                        </div>
                    </form>
                </div>
</div>
<?php require("footer.php"); ?>

</body>
</html>