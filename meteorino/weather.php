<?php
require('conexion.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum.scale=1.0 minimum.scale=1.0 ">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MeteorinoPi | Datos</title>
    <link rel="shortcut icon" type="image/png" href="imgs/suncloud.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="weather-icons-master/css/weather-icons.min.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/traeWeather.js"></script>
    <script src="code/highcharts.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/export-data.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script>
    function initMap() {
    <?php
            $consulta = "SELECT * from `gps` ORDER BY `id` DESC LIMIT 1";
            $registro = mysqli_query($con,$consulta);
            while($row = mysqli_fetch_array($registro)){
    ?>
        var ema = {lat: <?php echo ($row['latitud']); ?> , lng: <?php echo ($row['longitud']); } ?> };
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 16, center: ema});
        var marker = new google.maps.Marker({position: ema, map: map, title: 'MeteorinoPi'});
    }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtnsXZX14K211LO5ir10jlcSelL581QDw&callback=initMap">
    </script>
    <!--//////////////////////////////////////////-->

    <style>
      #map {
        height: 430px;
        width: 540px;
      }
     html, body {
          height: 100%;
      }
    </style>

    <style> 
    #carga {
        width: 100%;
        height: 10px;
        background: transparent;
        -webkit-transition: height 4s;
        transition: height 4s;
    }

    #carga:hover {
        height: 100px;
    }
    </style>
    <!--//////////////////////////////////////////-->
</head>
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

<body">

    <?php include("html/modal_registro.php");?>
    <?php include("html/modal_login.php");?>

    <?php 
    include("graficos/humedad1.php");
    include("graficos/humedad8.php");
    include("graficos/humedad12.php");

    include("graficos/temperatura1.php");
    include("graficos/temperatura8.php");
    include("graficos/temperatura12.php");

    include("graficos/presion1.php");
    include("graficos/presion8.php");
    include("graficos/presion12.php");

    include("graficos/lluvia1.php");
    include("graficos/lluvia8.php");
    include("graficos/lluvia12.php");

    include("graficos/luz1.php");
    include("graficos/luz8.php");
    include("graficos/luz12.php");

    include("graficos/co2_1.php");
    include("graficos/co2_8.php");
    include("graficos/co2_12.php");

    include("graficos/polvo1.php");
    include("graficos/polvo8.php");
    include("graficos/polvo12.php");

    include("graficos/uv1.php");
    include("graficos/uv8.php");
    include("graficos/uv12.php");

    include("graficos/velocidad1.php");
    include("graficos/velocidad8.php");
    include("graficos/velocidad12.php");

    include("graficos/liquidos1.php");
    include("graficos/liquidos8.php");
    include("graficos/liquidos12.php");

    include("graficos/direccion1.php");
    include("graficos/direccion8.php");
    include("graficos/direccion12.php");

    include("graficos/gps.php");
    ?>

<div class="container" style="padding-top:80px; margin-bottom:30px;">

    <h2>Datos meteorológicos y medioambientales</h2>
    <p">Los datos desplegados están representados por los siguientes indicadores y unidades: Humedad relativa (%), Temperatura exterior (°C), Presión barométrica (milibar), Dirección hacia donde se dirige el viento, Velocidad del viento (km/h), Precipitación (mm), Luminosidad (detectado mediante el voltaje recibido por el sensor y su variación), Dióxido de carbono en el aire (ppm), Radiación ultravioleta (mW/cm²), Partículas de polvo en el aire (µg/m³), Temperatura (°C) opcional para masas de agua. </p>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tablas">Tablas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#graficos">Gráficos</a>
        </li>

        <?php
        //////////////// SEGURIDAD (?) ///////////////////
        if(isset($_SESSION['mi_nivel'])){
            if(($_SESSION['mi_nivel'])==1 OR ($_SESSION['mi_nivel']) == 2 OR ($_SESSION['mi_nivel']) == 3){
                ?><li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#historico">Histórico</a>
                </li><?php
            }else{
            }
        }
        /////////////////////////////////////////////////
        ?>

    </ul>

      <!-- Tab panes -->
    <div class="tab-content">
        <div id="tablas" class="container tab-pane active"><br>
        </div>

        <div id="graficos" class="container tab-pane fade"><br>
            <h3>Gráficos</h3>
            <p>Registros meteorológicos y medioambientales desplegados por rangos de horas.</p>
                <div class="card-columns">
                    <div class="card" style="background-image: url('imgs/graficos/humedad.jpg'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Humedad relativa</h5>
                                <i class="fas fa-tint" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#humedad1" class="btn btn-primary">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#humedad8" class="btn btn-primary">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#humedad12" class="btn btn-primary">12 hrs</button>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/lluvia.jpg'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Precipitación</h5>
                                <i class="fas fa-umbrella" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#lluvia1" class="btn btn-secondary">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#lluvia8" class="btn btn-secondary">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#lluvia12" class="btn btn-secondary">12 hrs</button>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/co2.png'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Dióxido de carbono</h5>
                                <i class="fa fa-smog" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#co2_1" class="btn">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#co2_8" class="btn">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#co2_12" class="btn">12 hrs</button>
                        </div>    
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/polvo.jpg'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Partículas de polvo en el aire</h5>
                                <i class="fa fa-cloud-meatball" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#polvo1" class="btn btn-warning">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#polvo8" class="btn btn-warning">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#polvo12" class="btn btn-warning">12 hrs</button>
                        </div>  
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/temperatura.jpg'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Temperatura exterior</h5>
                                <i class="fas fa-temperature-high" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#temperatura1" class="btn btn-dark">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#temperatura8" class="btn btn-dark">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#temperatura12" class="btn btn-dark">12 hrs</button>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/velocidad.jpg'); background-repeat: no-repeat;
    background-size: 150%;">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Velocidad del viento</h5>
                                <i class="fas fa-wind" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#velocidad1" class="btn btn-primary">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#velocidad8" class="btn btn-primary">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#velocidad12" class="btn btn-primary">12 hrs</button>
                        </div>    
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/uv.jpeg'); background-repeat: no-repeat;
    background-size: 170%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Radiación ultravioleta</h5>
                                <i class="fas fa-sun" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#uv1" class="btn btn-warning">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#uv8" class="btn btn-warning">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#uv12" class="btn btn-warning">12 hrs</button>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/luz.jpg'); background-repeat: no-repeat;
    background-size: 130%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Luminosidad diaria</h5>
                                <i class="fas fa-lightbulb" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#luz1" class="btn btn-primary">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#luz8" class="btn btn-primary">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#luz12" class="btn btn-primary">12 hrs</button>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/presion.png'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Presión barométrica</h5>
                                <i class="fas fa-tachometer-alt" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#presion1" class="btn btn-secondary">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#presion8" class="btn btn-secondary">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#presion12" class="btn btn-secondary">12 hrs</button>
                        </div>  
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/direccion.jpg'); background-repeat: no-repeat;
    background-size: 110%;">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Dirección del viento</h5>
                                <i class="far fa-compass" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#direccion1" class="btn btn-danger">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#direccion8" class="btn btn-danger">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#direccion12" class="btn btn-danger">12 hrs</button>
                        </div>      
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/agua.jpg'); background-repeat: no-repeat;
    background-size: 150%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Temperatura en líquidos</h5>
                                <i class="fas fa-temperature-high" style="font-size: 50px; color: white;"></i> <i class="fas fa-water" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#liquidos1" class="btn btn-info">1 hr</button>
                                <button type="button" data-toggle="modal" data-target="#liquidos8" class="btn btn-info">8 hrs</button>
                                <button type="button" data-toggle="modal" data-target="#liquidos12" class="btn btn-info">12 hrs</button>
                        </div>  
                    </div>
                    <div class="card" style="background-image: url('imgs/graficos/gps.jpg'); background-repeat: no-repeat;
    background-size: 120%;">    
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: white;">Ubicación actual</h5>
                                <i class="fas fa-map-marked-alt" style="font-size: 50px; color: white;"></i></br></br>
                                <button type="button" data-toggle="modal" data-target="#gps" class="btn btn-success">Ver ubicación</button>
                        </div>
                    </div>
                </div>
        </div>

        <div id="historico" class="container tab-pane fade"><br>
            <h3>Histórico</h3>
            <p>Accede a todos los registros meteorológicos y medioambientales almacenados.</p>

                    <div class="table-responsive">
                        <br />
                        <div class="row">
                            <div class="input-daterange">
                                <div class="col">
                                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Fecha inicial" />
                                </div>
                                <div class="col">
                                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Fecha final" />
                                </div>      
                            </div>
                            <div class="col">
                                <input type="button" name="search" id="search" value="Buscar" class="btn btn-primary" />
                            </div>
                        </div>
                        <br />
                        <table id="order_data" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hum.</th>
                            <th>Temp.</th>
                            <th>Presión</th>               
                            <th>D.Viento</th>
                            <th>V.Viento</th>
                            <th>P.Diaria</th>
                            <th>Luz</th>
                            <th>CO2</th>
                            <th>UV</th>
                            <th>Polvo</th>
                            <th>Temp.Liq.</th>
                        </tr>
                        </thead>      
                        </table>        
                    </div>
        </div> 
    </div>
    
    </div>
</div>
</br></br></br></br></br>
<?php require("footer.php"); ?>


<script type="text/javascript">
$(function worker(){
   $.ajaxSetup ({
        cache: false,
        complete: function() {
            setTimeout(worker, 10000);
        }
    });
    var loadUrl = "tablas.php";
    $("#tablas").load(loadUrl);
});
</script>

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
  var dataTable = $('#order_data').DataTable({
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
            url:"fetch.php",
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
                '<option value="500">500</option>'+
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
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Se necesitan ambas fechas.");
  }
 }); 
 
});
</script>

</body>
</html>