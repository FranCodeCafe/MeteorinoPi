    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="login" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-sign-in-alt"></i> Iniciar Sesión</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="POST" class="needs-validation" action="checklogin.php" novalidate>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="usuario"> Usuario</label>
                                <input type="usuario" name="usuario" class="form-control" id="usuario" placeholder="Ingresa tu usuario" required>
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa tu usuario.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="clave"> Clave</label>
                                <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingresa tu clave" maxlength="50" required>
                                <!--
                                <input type="checkbox" onclick="mostrarClave()"> Mostrar clave
                                -->
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa tu clave.
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Entrar</button>
                                <button type="reset" class="btn btn-info">Limpiar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->