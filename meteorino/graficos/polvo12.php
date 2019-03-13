    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="polvo12" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-tint"></i> Polvo en el aire en las últimas 12 horas</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <?php 
                require('conexion.php');
                    $sql = "SELECT * from `weather` ORDER BY `id` DESC LIMIT 780";
                    $reg = mysqli_query($con,$sql);
                    if ($reg->num_rows > 0) {
                        while($row = mysqli_fetch_array($reg)){
                                $polvo = $row['polvo'];
                                $fecha = strtotime($row['fecha2'])*1000;
                                $pol12[] = "[$fecha,$polvo]";
                        }
                    }
                            
                ?>

                    <div id="cont-pol-12" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    <script src="code/highcharts.js"></script>
                    <script src="code/modules/exporting.js"></script>
                    <script src="code/modules/export-data.js"></script>
                    <script type="text/javascript">
                        Highcharts.chart('cont-pol-12', {
                            chart: {
                                type: 'area'
                            },
                            title: {
                                text: 'Polvo en el aire en las últimas 12 horas'
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
                                data: [<?php echo join($pol12, ','); ?>],
                                name: 'Partículas de polvo en el aire',
                                color: '#E65100'
                            }]
                        });
                    </script>     
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->