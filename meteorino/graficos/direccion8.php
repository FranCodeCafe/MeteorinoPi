    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="direccion8" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-tint"></i> Dirección del viento en la última hora</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="height: 400px; width: 100%; overflow-y: auto;">
                    <div class="table-responsive">
                        <table id="viento8" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Fecha</th>          
                            <th>D.Viento</th>
                        </tr>
                        </thead>      
                        </table>        
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#viento8').DataTable({
        "processing" : true,
        "serverSide" : true,
        "bDeferRender": true,           
        dom: 'Blrtip',
        "buttons": [
            {
                extend:    'copyHtml5',
                text:      'Copiar',
                titleAttr: 'Copiar al portapapeles'
            },
            {
                extend:    'csvHtml5',
                text:      'CVS',
                titleAttr: 'Exportar CSV'
            },
            {
                extend:    'excelHtml5',
                text:      'Excel',
                titleAttr: 'Exportar Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      'PDF',
                titleAttr: 'Descargar PDF'
            },
            {
                extend:    'print',
                text:      'Imprimir',
                titleAttr: 'Imprimir'
            }

        ],
        "order" : [],
        "ajax" : {
            url:"graficos/dir8_fetch.php",
            type:"POST",
            data:{
                is_date_search:is_date_search, start_date:start_date, end_date:end_date
            }
        },
        "oLanguage": {
            sProcessing:     "Procesando...",
            sLengthMenu: 'Mostrar <select>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '<option value="200">200</option>'+
                '<option value="-1">Todos</option>'+
                '</select>  registros',
        "sZeroRecords":    "No se encontraron resultados",
            sEmptyTable:     "Ningún dato disponible en esta tabla",
            sInfo:           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
            sInfoEmpty:      "Mostrando del 0 al 0 de un total de 0 registros",
            sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix:    "",
            sUrl:            "",
            sInfoThousands:  ",",
            sLoadingRecords: "Por favor espere - cargando...",
        "oPaginate": {
            sFirst:    "Primero",
            sLast:     "Último",
            sNext:     "Siguiente",
            sPrevious: "Anterior"
            },
        "oAria": {
            sSortAscending:  ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
            }    
        }
  });
 }

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#viento8').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Se necesitan ambas fechas.");
  }
 }); 
 
});
</script>
<!--//////////////////////////////////////////////////////-->