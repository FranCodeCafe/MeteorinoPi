$(document).ready(function() {			   
	$("#example").DataTable( {
		"ajax": {
			"url": "traeUsuarios.php",
        	"type": "POST"
		},					
		"columns": [
			{ "data": "id" },
			{ "data": "nivel" },
			{ "data": "usuario" },
			{ "data": "email" },
			{ "data": "actualizar" },
			{ "data": "eliminar" }
			],
		"oLanguage": {
            "sProcessing":     "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="25">25</option>'+
		        '<option value="50">50</option>'+
		        '<option value="100">100</option>'+
		        '<option value="500">500</option>'+
		        '<option value="-1">Todos</option>'+
		        '</select>  registros',    
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Por favor espere - cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },

		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }

        }
	});
});