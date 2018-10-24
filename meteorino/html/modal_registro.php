    <!-- /////////////////// REGISTRO FORM ///////////////////// -->
<div class="modal fade" id="registro" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-user-plus"></i>  Regístrate</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="POST" id="registro" name="registro" class="needs-validation" action="registrar.php" novalidate>
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
                                <label for="usuario"> Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario" maxlength="20" required>
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa un nombre de usuario.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="clave"> Clave</label>
                                <input type="password" class="form-control" id="clave" name="clave" onchange="validarClave()" placeholder="Ingresa tu clave" maxlength="50" required>
                                <input type="checkbox" onclick="mostrarClave()"> Mostrar clave
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa una clave.
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="form-row">
                            <div class="form-group">
                                <label for="repiteclave"> Confirma tu clave</label>
                                <input type="password" class="form-control" id="repiteclave" onkeyup="validarClave()" placeholder="Repite tu clave" required>
                                <div class="invalid-feedback">
                                    Por favor ingresa una clave.
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="modal-footer">
                                <button type="submit" name="enviar" class="btn btn-info">Registrar</button>
                                <button type="reset" class="btn btn-info">Limpiar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->