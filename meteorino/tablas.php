                <?php
                require('conexion.php');
                @session_start();
                    $query_weather = "SELECT * from `weather` ORDER BY `id` DESC LIMIT 1";
                    $registro_weather = mysqli_query($con,$query_weather);
                    while($row = mysqli_fetch_array($registro_weather)){
                        $humedad = $row['humedad'];
                        $temperatura = $row['temperatura'];
                        $temperatura2 = $row['temperatura2'];
                        $presion = $row['presion'];
                        $vientodir = $row['vientodir'];
                        $vientovel = $row['vientovel'];
                        $lluvia = $row['lluvia'];
                        $co2 = $row['co2'];
                        $uv = $row['uv'];
                        $polvo = $row['polvo'];
                    }
                ?>
                </br>
                <h3>Tablas</h3>
                <p>Registros meteorológicos y medioambientales actualizados cada cinco minutos.</p>

                <div class="card-columns" id="cargar_tablas">
                    <div class="card" style="background-image: url('imgs/tablas/humedad.jpg'); background-repeat: no-repeat;
    background-size: 120%; height: 200px;">
                        <div class="card-body text-center table-responsive-lg">
                                <h5 class="card-title" style="color: white;">Temperatura y humedad <i class="fa fa-thermometer-three-quarters"></i></h5>
                               <table class="table table-borderless table-sm" style="text-align: left; color:#fff; border-collapse: separate; border-spacing: 5px;">
                                    <tbody>
                                        <tr class="bg-secondary">
                                            <td>Temperatura exterior</td>
                                            <td><?php echo $temperatura; ?> °C</td>
                                        </tr>
                                        <tr class="bg-secondary">
                                            <td>Temperatura en líquidos</td>
                                            <td><?php echo $temperatura2; ?> °C</td>
                                        </tr>
                                        <tr class="bg-secondary">
                                            <td>Humedad relativa</td>
                                            <td><?php echo $humedad; ?> %</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/tablas/uv.jpg'); background-repeat: no-repeat;
    background-size: 100%; height: 195px;">
                        <div class="card-body text-center table-responsive-lg">
                            <h5 class="card-title" style="color: white;">Radiación Ultravioleta <i class="fas fa-sun"></i></h5>
                            <table class="table table-borderless" style="text-align: left; color:#fff; border-style: none; border-collapse: separate; border-spacing: 5px;">
                                    <tbody>
                                        <tr class="bg-danger">
                                            <td>Radiación UV</td>
                                            <td><?php echo $uv; ?> mW/cm2</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/tablas/lluvia.jpg'); background-repeat: no-repeat;
    background-size: 110%;">
                        <div class="card-body text-center table-responsive-lg">
                            <h5 class="card-title" style="color: white;">Presión y precipitación <i class="fa fa-umbrella"></i></h5>
                            <table class="table table-borderless" style="text-align: left; color:#fff; border-style: none; border-collapse: separate; border-spacing: 5px;">
                                    <tbody>
                                        <tr class="bg-dark">
                                            <td>Presión barométrica</td>
                                            <td><?php echo $presion; ?> mb</td>
                                        </tr>
                                        <tr class="bg-dark">
                                            <td>Precipitación actual</td>
                                            <td><?php echo $lluvia; ?> mm</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('imgs/tablas/vientos2.jpg'); background-repeat: no-repeat;
    background-size: 170%;">
                        <div class="card-body text-center table-responsive-lg">
                            <h5 class="card-title" style="color: white;">Vientos <i class="fa fa-wind"></i></h5>
                            <table class="table table-borderless" style="text-align: left; color:#fff; border-style: none; border-collapse: separate; border-spacing: 5px;">
                                    <tbody>
                                        <tr class="bg-primary">
                                            <td>Velocidad del viento</td>
                                            <td><?php echo $vientovel; ?> km/h</td>
                                        </tr>
                                        <tr class="bg-primary">
                                            <td>Dirección del viento</td>
                                            <td><?php echo $vientodir; ?></td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                        </div>
                    </div>

                    <div class="card" style="background-image: url('imgs/tablas/polvo.png'); background-repeat: no-repeat;
    background-size: 120%;">
                        <div class="card-body text-center table-responsive-lg">
                            <h5 class="card-title" style="color: white;">Calidad del aire <i class="fa fa-cloud-meatball"></i></h5>
                            <table class="table table-borderless" style="text-align: left; color:#000; border-style: none; border-collapse: separate; border-spacing: 5px;">
                                    <tbody>
                                        <tr class="bg-warning">
                                            <td>Dióxido de carbono</td>
                                            <td><?php echo $co2; ?> ppm</td>
                                        </tr>
                                        <tr class="bg-warning">
                                            <td>Partículas de polvo</td>
                                            <td><?php echo $polvo; ?> μg/m3</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>