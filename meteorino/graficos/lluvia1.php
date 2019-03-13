    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="lluvia1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-tint"></i> Precipitación en la última hora</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <?php 
                require('conexion.php');
                    $sql = "SELECT * from `weather` ORDER BY `id` DESC LIMIT 70";
                    $reg = mysqli_query($con,$sql);
                    if ($reg->num_rows > 0) {
                        while($row = mysqli_fetch_array($reg)){
                                $lluvia = $row['lluvia'];
                                $fecha = strtotime($row['fecha2'])*1000;
                                $llu1[] = "[$fecha,$lluvia]";
                        }
                    }
                            
                ?>

                    <div id="cont-llu-1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    <script src="code/highcharts.js"></script>
                    <script src="code/modules/exporting.js"></script>
                    <script src="code/modules/export-data.js"></script>
                    <script type="text/javascript">
                        Highcharts.chart('cont-llu-1', {
                            chart: {
                                type: 'area'
                            },
                            title: {
                                text: 'Precipitación en la última hora'
                            },
                            subtitle: {
                                text: 'MeteorinoPi'
                            },
                            xAxis: {
                                type: 'datetime',
                                labels: {
                                    format: '{value:%e-%m-%Y %H:%M}',
                                    rotation: -60
                                }
                            },
                            yAxis: {
                                title: {
                                    text: '%'
                                }
                            },
                            plotOptions: {
                                area: {
                                    dataLabels: {
                                        enabled: true
                                    },
                                    enableMouseTracking: true
                                }
                            },
                            series: [{
                                data: [<?php echo join($llu1, ','); ?>],
                                name: 'Precipitación horaria',
                                color: '#5D6D7E'
                            }]
                        });
                    </script>     
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->