<div class="modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash-alt"></i></i> Eliminar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="POST" id="update" action="#">
                        <div class="form-row">
                            <div class="form-group">
                                <h5 style="text-align: center;">¿Realmente deseas eliminar a este usuario?</h5>
                                <input type="text" name="id" value=""/>
                                <div class="alert alert-danger">
                                    <p style="font-size: 14px;"><i class="fa fa-exclamation-triangle" style="font-size: 14px;"></i> Esta acción no se podrá deshacer</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Aceptar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->
<script type="text/javascript">
    $('#delete').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    $(e.currentTarget).find('input[name="id"]').val(id);
});
</script>