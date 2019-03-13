    <!-- //////////////////// LOGIN FORM /////////////////////////// -->
    <div class="modal fade" id="gps" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-map-marked-alt"></i> Ubicación actual</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="map" style="width: 100%;"></div>
                        <table class="table table-borderless" style="text-align: left; color:#fff; border-style: none; border-collapse: separate; border-spacing: 5px;">
                            <tbody>

                            <?php
                                $consulta = "SELECT * from `gps` ORDER BY `id` DESC LIMIT 1";
                                $registro = mysqli_query($con,$consulta);
                                while($row = mysqli_fetch_array($registro)){
                                    $latitud = $row['latitud'];
                                    $longitud = $row['longitud'];
                                    $altitud = $row['altitud'];
                                }
                                
                            ?>
                            </br>
                                <tr class="bg-success">
                                    <td>Latitud</td>
                                    <td>Longitud</td>
                                    <td>Altitud</td>
                                </tr>
                                <tr class="bg-success">
                                    <td><?php echo $latitud; ?></td>
                                    <td><?php echo $longitud; ?></td>
                                    <td><?php echo $altitud; ?> m</td>
                                </tr>
                            </tbody>
                        </table>            
                </div>
            </div>
        </div>
    </div>

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
    <!--//////////////////////////////////////////////////////-->