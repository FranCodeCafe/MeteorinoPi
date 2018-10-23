<?php 
    require('conexion.php');
    session_start();
    header("Refresh:300; url='index.php'");
   //////////////////  CONFIG FECHA ///////////////////////

    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d");
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum.scale=1.0 minimum.scale=1.0 ">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MeteorinoPi | Inicio</title>
    <link rel="shortcut icon" type="image/png" href="imgs/suncloud.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="weather-icons-master/css/weather-icons.min.css">
    <link href="css/estacion.css" rel="stylesheet" type="text/css">

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="js/funciones.js"></script>

    <script>
    // Initialize and add the map
    function initMap() {
      // The location of EMA
    <?php
            $consulta = "SELECT * from `gps` ORDER BY `id` DESC LIMIT 1";
            $registro = mysqli_query($con,$consulta);
            while($row = mysqli_fetch_array($registro)){
    ?>

      var ema = {lat: <?php echo ($row['latitud']); ?> , lng: <?php echo ($row['longitud']); } ?> };
      // The map, centered at EMA
      var map = new google.maps.Map(
          document.getElementById('map'), {zoom: 16, center: ema});
      // The marker, positioned at EMA
      var marker = new google.maps.Marker({position: ema, map: map, title: 'MeteorinoPi'});
    }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtnsXZX14K211LO5ir10jlcSelL581QDw&callback=initMap">
    </script>
    <!--//////////////////////////////////////////-->

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        width: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html, body {
          height: 100%;
      }

    </style>

</head>

<body style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('images/rain.jpg'); padding-left: 2%; padding-right: 2%">

    <?php include("html/modal_registro.php");?>
    <?php include("html/modal_login.php");?>

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

    <!-- HEADER -->
        <div class="row">
            <div class="col-md-dark rounded" style="width:100%; background-color:#0f0f0f; margin-top: 50px; padding: 20px;">
               <h1 class="display-4" style="color:white;">MeteorinoPi</h1>
               <h5 class="card-text font-weight-light" style="color:white;">Estación Meteorológica y Medioambiental</h5>
            </div>
        </div>
    <!-- FIN HEADER -->
    
    <div class="container" style="padding-top:20px; margin-bottom:30px;" >
        <!-- HEADER -->
        <div class="row">
            <div class="col-md">
                <div class="card bg-dark" style="opacity: 0.6; margin-bottom: 20px;">    
                    <div class="card-body" >
                        <h3 class="font-weight-light float-left" style="color:white">Clima actual</h3>
                        <h3 class="font-weight-light float-right" style="color:white">
                            <?php
                                setlocale (LC_TIME,"Spanish_Chile");;
                                echo strftime("%B %d, %Y  %Rhrs");
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN HEADER -->

        <?php
            $query_weather = "SELECT * from `weather` ORDER BY `id` DESC LIMIT 1";
            $registro_weather = mysqli_query($con,$query_weather);
            while($row = mysqli_fetch_array($registro_weather)){
                $humedad = $row['humedad'];
                $temperatura = $row['temperatura'];
                $presion = $row['presion'];
                $vientodir = $row['vientodir'];
                $vientovel = $row['vientovel'];
                $lluvia = $row['lluvia'];
                $co2 = $row['co2'];
                $uv = $row['uv'];
                $polvo = $row['polvo'];
            }
        ?>

        <!-- ROW TEMP -->
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Temperatura</h4>
                        <h1 class="card-text display-2 float-right" style="color:white">
                            <?php 
                                echo sprintf("%.0f°C", $temperatura);

                            ?>
                        </h1>
                    </br></br></br></br></br>
                    </div>  
                </div>
            </div>

            <div class="col-md-2">
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Humedad</h4>
                        <p class="card-text" style="font-size:20px; color:white; text-align:right;">
                            <?php 
                                echo sprintf("%.1f ", $humedad);
                                echo ("%");
                            ?>
                        </p>
                    </div>
                </div>
            <br>

                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Precipitación</h4>
                        <p class="card-text" style="font-size:20px; color:white; text-align:right;">
                            <?php 
                                echo sprintf("%.1f mm", $lluvia);
                            ?>                  
                        </p>
                    </div>  
                </div>
            </div>      
        
            <div class="col-md-2">
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Presión</h4>
                        <p class="card-text" style="font-size:20px; color:white; text-align:right;">
                            <?php
                                echo sprintf("%.1f mb", $presion);
                            ?>                  
                        </p>
                    </div>
                </div>
            <br>

                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">CO2</h4>
                        <p class="card-text" style="font-size:20px; color:white; text-align:right;">
                            <?php 
                                if ($co2 == "-1"){
                                    echo "<400 "." ppm";
                                }else
                                    echo ($co2." ppm");
                            ?>                 
                        </p>
                    </div>  
                </div>
            </div>

            <div class="col-md-2">

                <div class="card bg-dark">    
                    <div class="card-body">
                    <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Viento</h4>
                    <p class="card-text" style="font-size:20px; color:white; text-align:right;">
                            <?php 
                                echo $vientodir; 
                                echo (" ");
                                echo sprintf("%.1f", $vientovel);
                                echo (" km/h");
                            ?>                
                    </p>
                    </div>
                </div>
            <br>
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Polvo</h4>
                        <p class="card-text" style="font-size:20px; color:white; text-align:right;">
                            <?php 
                                echo sprintf("%.1f μg/m3", $polvo);
                            ?>                  
                        </p>
                    </div>
                </div>
            </div>
        </div> <!-- FIN ROW TEMP-->

        <?php
            $query_amanecer = "SELECT `hora` FROM `weather` WHERE `luz` < '0.05' AND `luz` > '0.00' AND `fecha` = '$fecha' ORDER BY `hora` ASC LIMIT 1";
                $registro_amanecer = mysqli_query($con,$query_amanecer);
                while($row = mysqli_fetch_array($registro_amanecer)){ 
                    $amanecer = $row['hora']; 
                }
                
            $query_ocaso = "SELECT `hora` FROM `weather` WHERE `luz` < '0.05' AND `luz` > '0.00' AND `fecha` = '$fecha' AND `hora` > '12:00:00' ORDER BY `hora` DESC LIMIT 1";
                $registro_ocaso = mysqli_query($con,$query_ocaso);
                while($row = mysqli_fetch_array($registro_ocaso)){ 
                    $ocaso = $row['hora']; 
                 }
            
            $resta = $ocaso - $amanecer;
        ?>
		
		<!--ROW SOL/LUNA-->
        <div class="row">
            <div class="col-md-4">  
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white">Radiación UV</h4>
                            <div class="row">
                                <div class="col">
                                    <p style="font-size:16px; color:white; text-align:center;">
                                        <?php 
                                            echo sprintf("%.1f W/m2", $uv);                                     
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p style="font-size:16px; color:white; text-align:center;">
                                        <img src="imgs/uv/verde.png" width="100%" class="float-center">
                                    </p>
                                </div>
                            </div>
                    </div>
                </div>
                <br>        
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px; color:white;">Salida y puesta del Sol</h4>
                            <div class="row" style="margin-top:20px;">
                                <div class="col"><img src="icons/dawn2.png" width="60%" class="float-left" style="margin-left:20px;">
                            </div>
                                <div class="col"></div>
                                <div class="col"><img src="icons/sunset2.png" width="60%" class="float-right" style="margin-right:20px;">           
                            </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p style="font-size:16px; color:white; text-align:center;">
                                        <?php if (empty($amanecer)){
                                            echo "Esperando hora del amanecer";
                                            }else{
                                                echo $amanecer." hrs";
                                            }
                                        ?>
                                    </p>
                                </div>

                                <div class="col">
                                    <p style="font-size:16px; color:white; text-align:center;">
                                        <?php if (empty($ocaso)){
                                            echo " ";

                                            }else{
                                                echo $resta." horas de luz";
                                            }
                                        ?>
                                    </p>
                                </div>
                                
                                <div class="col">
                                    <p style="font-size:16px; color:white; text-align:center;">
                                        <?php if (empty($ocaso)){
                                            echo "Esperando hora del atardecer";
                                            }else{
                                                echo $ocaso." hrs";
                                            }   
                                        ?>
                                    </p>
                                </div>
                            </div>                                          

                    </div>
                </div>
            </div>  

            <div class="col-md-2">
                        <div class="card bg-dark">    
                                <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px;color:white">Consejos</h4>
                                            <p class="card-text font-weight-light" style="font-size:20px; color:white"><br><br><br></p>
                    </div>  
                        </div>
                <br>
                <div class="card bg-dark">    
                    <div class="card-body">
                        <h4 class="card-title font-weight-light" style="font-size:16px;color:white">Luna</h4>
                                            <div id="contain_moon" style="font-size:20px; color:white; text-align:center;"><div></div><div></div></div> 
                            <p class="card-text font-weight-light" style="font-size:20px; color:white"></p>
                    </div>  
                </div>
            </div>

            <!-- GPS-->
            <div class="col-md-6" style="padding-top:20px;">
                <div class="card bg" style="height:100%; ">    
                    <div id="map"></div>
                </div>
            </div>
          <!-- FIN GPS-->

        </div> <!--FIN ROW SOL/LUNA-->
		
    </div> <!--FIN CONTAINER-->

<?php require("footer.php"); ?>

<script type="text/javascript">
    (function()
    {
    var d=new Date().getDate();
    var m=document.querySelectorAll("#contain_moon div");
    var a=new XMLHttpRequest();var url="http://www.icalendar37.net/lunar/api/?lang=es&month="+(new Date().getMonth()+1)+"&year="+(new Date().getFullYear())+"&size=60&lightColor=rgb(255,220,79)&shadeColor=rgb(46,67,105)&LDZ="+new Date(new Date().getFullYear(),new Date().getMonth(),1)/1000+"";

    a.onreadystatechange=function(){if(a.readyState==4&&a.status==200){var b=JSON.parse(a.responseText);m[0].innerHTML=b.phase[d].svg;
    if(typeof moon_widget_loaded=="function")moon_widget_loaded(b);
    m[1].innerHTML=b.phase[d].npWidget}};
    a.open("GET",url,true);
    a.send()
    })()
</script>

</body>
</html>