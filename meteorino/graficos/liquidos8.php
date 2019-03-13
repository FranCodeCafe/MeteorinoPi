    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="liquidos8" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-tint"></i> Temperatura en líquidos en las últimas 8 horas</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <?php 
                require('conexion.php');
                    $sql = "SELECT * from `weather` ORDER BY `id` DESC LIMIT 540";
                    $reg = mysqli_query($con,$sql);
                    if ($reg->num_rows > 0) {
                        while($row = mysqli_fetch_array($reg)){
                                $liquidos = $row['temperatura2'];
                                $fecha = strtotime($row['fecha2'])*1000;
                                $liq8[] = "[$fecha,$liquidos]";
                        }
                    }
                            
                ?>

                    <div id="cont-liq-8" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    <script src="code/highcharts.js"></script>
                    <script src="code/modules/exporting.js"></script>
                    <script src="code/modules/export-data.js"></script>
                    <script type="text/javascript">
                        Highcharts.chart('cont-liq-8', {
                            chart: {
                                type: 'area'
                            },
                            title: {
                                text: 'Temperatura en líquidos en las últimas 8 horas'
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
                                data: [<?php echo join($liq8, ','); ?>],
                                name: 'Temperatura en líquidos',
                                color: '#0097A7'
                            }]
                        });
                    </script>     
                </div>
            </div>
        </div>
    </div>
    <!--//////////////////////////////////////////////////////-->