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
    <script src="js/traeWeather.js"></script>
    <script src="js/filtro_fecha.js"></script>
    <script src="code/highcharts.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/export-data.js"></script>

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

<div class="container" style="padding-top:80px; margin-bottom:30px;">

    <h2>Datos meteorológicos y medioambientales</h2>
    <p">Los datos desplegados están representados por los siguientes indicadores y unidades: Humedad relativa (%), Temperatura exterior (°C), Presión barométrica (milibar), Dirección hacia donde se dirige el viento, Velocidad del viento (km/h), Precipitación (mm), Luminosidad (detectado mediante el voltaje recibido por el sensor y su variación), Dióxido de carbono en el aire (ppm), Radiación ultraivoleta (W/m²), Partículas de polvo en el aire (µg/m³), Temperatura (°C) opcional para masas de agua. </p>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tablas">Tablas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#graficos">Gráficos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#historico">Histórico</a>
        </li>
    </ul>

      <!-- Tab panes -->
    <div class="tab-content">
        <div id="tablas" class="container tab-pane active"><br>
            <h3>Tablas</h3>
            <p>Registros meteorológicos y medioambientales actualizados cada cinco minutos.</p>

                <div class="card-columns">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Temperatura y humedad <i class="fa fa-thermometer-three-quarters"></i></h5>
                                <table class="table table-bordered table-sm" style="text-align: left; color:#fff;">
                                    <tbody>
                                        <tr class="bg-primary">
                                            <td>Temperatura exterior</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-primary">
                                            <td>Temperatura en líquidos</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-primary">
                                            <td>Humedad relativa</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Presión y precipitación <i class="fa fa-umbrella"></i></h5>
                            <table class="table table-bordered table-sm" style="text-align: left; color:#fff;">
                                    <tbody>
                                        <tr class="bg-info">
                                            <td>Presión barométrica</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-info">
                                            <td>Precipitación actual</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Calidad del aire y vientos <i class="fa fa-wind"></i></h5>
                            <table class="table table-bordered table-sm" style="text-align: left; color:#fff; border-radius: 30px;">
                                    <tbody>
                                        <tr class="bg-success">
                                            <td>Dióxido de carbono</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>Partículas de polvo</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>Velocidad del viento</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>Dirección del viento</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>Radiación Ultravioleta</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>

        </div>
        <div id="graficos" class="container tab-pane fade"><br>
            <h3>Gráficos</h3>
            <p>Registros meteorológicos y medioambientales desplegados por rangos de horas.</p>
                <!-- Nav pills -->
                  <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#humedad" style="width:100px;">Humedad</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="pill" href="#temperatura" style="width:100px;"">Temperatura</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="pill" href="#presion" style="width:100px;"">Presión</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="pill" href="#precipitacion" style="width:100px;"">Precipitación</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="pill" href="#co2" style="width:100px;"">CO2</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="pill" href="#polvo" style="width:100px;"">Polvo</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="pill" href="#uv" style="width:100px;"">UV</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="pill" href="#termometro" style="width:100px;"">T. Líquidos</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#anemometro" style="width:100px;"">Anemómetro</button>
                    </li>
                    <li class="nav-item" style="padding-left:5px;">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="pill" href="#veleta" style="width:100px;"">Veleta</button>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="humedad" class="container tab-pane active"><br>
                            <h4>Humedad relativa</h4>
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#humedad1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#humedad8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#humedad12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                              <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="humedad1" class="container tab-pane active"><br>
                                        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                                            
                                    </div>

                                    <div id="humedad8" class="container tab-pane fade"><br>
                                        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                                            
                                    </div>
                                    <div id="humedad12" class="container tab-pane fade"><br>
                                        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                                          
                                    </div>
                                </div>
                        </div>      

                        <div id="temperatura" class="container tab-pane fade"><br>
                          <h4>Temperatura exterior</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#temperatura1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#temperatura8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#temperatura12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="temperatura1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="temperatura8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="temperatura12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="presion" class="container tab-pane fade"><br>
                          <h4>Presión barométrica</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#presion1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#presion8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#presion12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="presion1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="presion8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="presion12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="precipitacion" class="container tab-pane fade"><br>
                          <h4>Precipitación</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#precipitacion1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#precipitacion8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#precipitacion12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="precipitacion1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="precipitacion8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="precipitacion12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="co2" class="container tab-pane fade"><br>
                          <h4>Dióxido de carbono</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#co21" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#co28" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#co212" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="co21" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="co28" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="co212" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="polvo" class="container tab-pane fade"><br>
                          <h4>Partículas de polvo en el aire</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#polvo1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#polvo8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#polvo12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="polvo1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="polvo8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="polvo12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="uv" class="container tab-pane fade"><br>
                          <h4>Radiación ultravioleta</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#uv1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#uv8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#uv12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="uv1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="uv8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="uv12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="termometro" class="container tab-pane fade"><br>
                          <h4>Temperatura para líquidos</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#termometro1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#termometro8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#termometro12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="termometro1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="termometro8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="termometro12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="anemometro" class="container tab-pane fade"><br>
                          <h4>Velocidad del viento</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#anemometro1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#anemometro8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#anemometro12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="anemometro1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="anemometro8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="anemometro12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>

                        <div id="veleta" class="container tab-pane fade"><br>
                          <h4>Dirección del viento</h4>
                          <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#veleta1" style="width:120px;">Última hora</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#veleta8" style="width:120px;">Últimas 8 horas</button>
                                </li>
                                <li class="nav-item" style="padding-left:5px;">
                                    <button type="button" class="btn btn-basic btn-sm" data-toggle="pill" href="#veleta12" style="width:120px;">Últimas 12 horas</button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="veleta1" class="container tab-pane active"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="veleta8" class="container tab-pane fade"><br>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="veleta12" class="container tab-pane fade"><br>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    

        
        </div>
        <div id="historico" class="container tab-pane fade"><br>
            <h3>Histórico</h3>
            <p>Accede a todos los registros meteorológicos y medioambientales almacenados.</p>

            <div class="table-responsive">    
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                        <tbody>
                        

                        </tbody>
                        <tfoot>
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
                        </tfoot>               
                    </table>        
                </div>
        </div>
    </div>

    
    </div>
</div>

<?php require("footer.php"); ?>


</body>
</html>