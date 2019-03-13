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
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="weather-icons-master/css/weather-icons.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="code/highcharts.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/export-data.js"></script>
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
            <tbody>

                <?php 
                    $sql = "SELECT * FROM `login` WHERE `nivel` != 1";
                    $registro =  $con->query($sql);
                    if ($registro->num_rows > 0) {
                        while($row = $registro->fetch_assoc()) {
                            $id = $row['id'];
                            $nivel = $row['nivel'];
                            $usuario = $row['usuario'];
                            $email = $row['email'];                      
                ?>

                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $nivel; ?></td>
                    <td><?php echo $usuario; ?></td>
                    <td><?php echo $email; ?></td>
                    <td>
                        <a href="#actualizar<?php echo $id;?>" data-toggle="modal">
                            <button type='button' class='btn btn-info'><i class="far fa-edit"></i></button>
                        </a>
                    </td>
                    <td>
                        <a href="#eliminar<?php echo $id;?>" data-toggle="modal">
                            <button type='button' class='btn btn-danger'><i class="far fa-trash-alt"></i></button>
                        </a>
                    </td>

                    <!-- Modal Actualizar -->
                    <div id="actualizar<?php echo $id; ?>" class="modal fade" role="dialog">
                        <form method="POST">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fas fa-edit"></i> Actualizar Datos</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="actualizar_id" value="<?php echo $id; ?>">
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="nivel"> Nivel</label>
                                                    <input type="text" class="form-control" id="nivel" name="nivel" value="<?php echo $nivel; ?>" placeholder="Nivel" required autofocus style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="usuario"> Usuario</label>
                                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>" placeholder="Usuario" required autofocus style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="email"> Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required autofocus style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="actualizar" class="btn btn-info">Guardar</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Eliminar -->
                    <div id="eliminar<?php echo $id; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fas fa-trash-alt"></i></i> Eliminar Usuario</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="eliminar_id" value="<?php echo $id; ?>">
                                        <div class="form-group">
                                            <h5 style="text-align: center;">¿Realmente deseas eliminar a <?php echo $usuario; ?>?</h5>
                                            <div class="alert alert-danger">
                                                <p style="font-size: 14px; text-align: center;"><i class="fa fa-exclamation-triangle" style="font-size: 14px; "></i> Esta acción no se podrá deshacer</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="eliminar" class="btn btn-info">Aceptar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
                <?php 
                        }
                    }

                    // ACTUALIZAR USUARIO //
                        if(isset($_POST['actualizar'])){
                            $actualizar_id = $_POST['actualizar_id'];
                            $user_nivel = $_POST['nivel'];
                            $user_usuario = $_POST['usuario'];
                            $user_email = $_POST['email'];
                            $sql = "UPDATE login SET nivel='$user_nivel', usuario='$user_usuario', email='$user_email' WHERE id='$actualizar_id' ";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="usuarios_super.php"</script>';
                            } else {
                                echo "Error al actualizar el registro: " . $con->error;
                            }
                        }

                    // ELIMINAR USUARIO //
                        if(isset($_POST['eliminar'])){
                            $eliminar_id = $_POST['eliminar_id'];
                            $sql = "DELETE FROM login WHERE id='$eliminar_id' ";
                            if ($con->query($sql) === TRUE) {
                                echo '<script>window.location.href="usuarios_super.php"</script>';
                            } else {
                                echo "Error al borrar el registro: " . $con->error;
                            }
                        }
                ?>

            </tbody>
        </table>        
    </div>
</div>
<?php require("footer.php"); ?>

</body>
</html>