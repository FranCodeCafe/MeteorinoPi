<?php
//////////////////////////// ROSA DE LOS VIENTOS ////////////////////////////

require('conexion.php');


    $consulta = "SELECT * from `weather`";
    $registro = mysqli_query($con,$consulta);

    while($row = mysqli_fetch_array($registro)){

        if ($row['vientodir'] >= 570 && $row['vientodir'] <= 568 ){ echo 0; }
        if ($row['vientodir'] >= 807 && $row['vientodir'] <= 815 ){ echo 45;}
        if ($row['vientodir'] >= 976 && $row['vientodir'] <= 989 ){ echo 90; }
        if ($row['vientodir'] >= 949 && $row['vientodir'] <= 961 ){ echo 135;}
        if ($row['vientodir'] >= 896 && $row['vientodir'] <= 909 ){ echo 180; }
        if ($row['vientodir'] >= 696 && $row['vientodir'] <= 703 ){ echo 225;}
        if ($row['vientodir'] >= 396 && $row['vientodir'] <= 399 ){ echo 270; }
        if ($row['vientodir'] >= 428 && $row['vientodir'] <= 487 ){ echo 315;}
    }


?>