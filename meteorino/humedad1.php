    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="humedad1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-tint"></i> Humedad en la última hora</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <?php 
                    require('conexion.php');
                        $sql = "SELECT * from `weather` ORDER BY `id` ASC LIMIT 15";
                        $reg = mysqli_query($con,$sql);
                        if ($reg->num_rows > 0) {
                            while($row = mysqli_fetch_array($reg)){
                                    $humedad1 = $row['humedad'];
                                    $temperatura1 = $row['temperatura'];
                                    $fecha = strtotime($row['fecha2'])*1000;
                                    $hum1[] = "[$fecha,$humedad1]";
                            }
                        }
                                
                    ?>
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                                <script type="text/javascript">
                                    Highcharts.chart('container', {
                                        chart: {
                                            type: 'line'
                                        },
                                        title: {
                                            text: 'Humedad en la última hora'
                                        },
                                        subtitle: {
                                            text: 'MeteorinoPi'
                                        },
                                        xAxis: {
                                            type: 'datetime',
                                            labels: {
                                                format: '{value:%Y-%b-%e %H:%M:%S}'
                                            }
                                        },
                                        yAxis: {
                                            title: {
                                                text: '%'
                                            }
                                        },
                                        plotOptions: {
                                            line: {
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                enableMouseTracking: false
                                            }
                                        },
                                        series: [{
                                            data: [<?php echo join($hum1, ','); ?>],
                                            name: 'Humedad relativa',
                                            color: '#678E9C'
                                        }]
                                    });
                                </script>     
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->