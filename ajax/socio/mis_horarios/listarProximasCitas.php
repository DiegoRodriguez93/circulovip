<?php 

require '../../_conexion.php';

$select = mysqli_query($mysqli,'SELECT fecha FROM fechas_ronda 
WHERE fecha >= CURRENT_DATE() ORDER BY fecha desc');

if(mysqli_num_rows($select) > 0){

    while($row = mysqli_fetch_array($select)){

        $fecha = $row['fecha'];

        $fechaFormat = date('d-m-Y',strtotime($fecha));

        $arr[] = array('fecha'=>$fechaFormat);

    }

}else{

    $arr = array();

}

mysqli_close($mysqli);
echo json_encode(array('arrfechas'=>$arr));


?>