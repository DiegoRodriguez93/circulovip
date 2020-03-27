<?php 

require '../../_conexion.php';


$select = mysqli_query($mysqli, "SELECT fecha FROM fechas_ronda");

if(mysqli_num_rows($select) == 0){

    $res = array('result'=>false,'message'=>'No hay fechas de rondas disponible para solicitar una cita');

}else{

    while($row = mysqli_fetch_array($select)){

        $fechas_ronda = $row['fecha'];
/* 
        $time = strtotime($fechas_ronda);
        $fecha_formateada = date("d/m/Y", $time);

        $timestamp = strtotime($fechas_ronda);

        $day = date('w', $timestamp);

        if($day == 0){
            $day = 7; // EN PHP ES CERO EN MI CODIGO EL DOMINGO ES 7
        } */

       /*  $res[] = array('fecha'=>$fecha_formateada,'dia'=>$day); */

        $res[] = array("date"=>$row['fecha'],
        "badge"=>false,
        "title"=>"Día de Ronda",
        "body"=>"<p class=\"lead\">Día de Ronda.<\/p>",
        "footer"=>"Circulo Vip",
        "classname"=>"badgeZabuto");

    }

}

mysqli_close($mysqli);
echo json_encode($res);



?>