<?php 
/* ini_set('max_execution_time', 300); //300 seconds = 5 minutes
set_time_limit(300); */
require '../../_conexion.php';

$emisor = mysqli_real_escape_string($mysqli,$_GET['emisor']);
$receptor = mysqli_real_escape_string($mysqli,$_GET['receptor']);
$zona_horaria_emisor = mysqli_real_escape_string($mysqli,$_GET['zona_horaria']);

$select = mysqli_query($mysqli, "SELECT fecha FROM fechas_ronda WHERE fecha >= current_date()");

if(mysqli_num_rows($select) == 0){

    $res = array('result'=>false,'message'=>'No hay fechas de rondas disponible para solicitar una cita');

}else{

    while($row = mysqli_fetch_array($select)){

         $fechas_ronda = $row['fecha'];

        $time = strtotime($fechas_ronda);
        $fecha_formateada = date("d/m/Y", $time);

        $timestamp = strtotime($fechas_ronda);

        $day = date('w', $timestamp);

        if($day == 0){
            $day = 7; // EN PHP ES CERO EN MI CODIGO EL DOMINGO ES 7
        } 
        
        
        $horarios = '<div class="row" style="background-color: #999">';


        // EXTRAEMOS LA ZONA HORARIA RECEPTOR
       $select2 = mysqli_query($mysqli, "SELECT zona_horaria FROM usuarios WHERE id = '$receptor' ");

        $row3 = mysqli_fetch_assoc($select2);
        $zona_horaria_receptor = $row3['zona_horaria'];

        $select3 = mysqli_query($mysqli, "SELECT * FROM horarios 
        WHERE id_user = '$receptor'
        AND id_dia REGEXP '$day' ORDER BY hora ASC ");
        if(mysqli_num_rows($select3) == 0 ){
            $horarios = 'El usuario no tiene citas disponibles este día';
        }else{

   

        while($row2 = mysqli_fetch_array($select3)){

            if($row2['id'] == null){

            $horarios[] = array('hora'=>'El usuario no tiene horarios disponibles ese día',
            'zona_horaria'=>'',
            'hora_mia'=>'',
            'zona_horaria_mia'=>'');

        
        }else{


 
            $date = DateTime::createFromFormat( 'H:i:s', $row2['hora'] );
            $horaFormat = $date->format( 'H:i'); 
        
            // CHEQUEMOS QUE NO ESTE SOLICITADA LA FECHA
        
            $horaFormat2 = $row['fecha']; 

            $fecha_a_chequear = $horaFormat2 . ' ' . $horaFormat . ':00';
        
            $select4 = mysqli_query($mysqli,"SELECT dia_hora, id_receptor, estado 
            FROM citas WHERE (id_receptor = '$receptor' OR id_emisor = '$receptor')
             AND dia_hora = '$fecha_a_chequear' AND (estado = 2 OR estado = 1) ");
        
             /* if(intval($zona_horaria_receptor) >= 0){} */
        
            if( intval($zona_horaria_receptor) == intval($zona_horaria_emisor)){
                $hora_mia =  $horaFormat;
            }else{
        
             $diferencia_de_horas =   count(range(intval($zona_horaria_receptor),intval($zona_horaria_emisor))) ;
        
             $hora = $date->format('H');
             $minutos = $date->format('i');
        
             if(intval($zona_horaria_receptor) > intval($zona_horaria_emisor)){
        
                $hora_final = $hora - $diferencia_de_horas + 1;
        
             }else{
        
                $hora_final = $hora + $diferencia_de_horas - 1;
        
             }
        
             $hora_mia = $hora_final.':'.$minutos;
        
            }
        
            $fecha_a_chequear2 = $horaFormat2 . ' ' . $hora_mia . ':00';
        
            $select5 = mysqli_query($mysqli,"SELECT dia_hora, id_receptor, estado 
            FROM citas WHERE (id_receptor = '$emisor' OR id_emisor = '$emisor')
             AND dia_hora = '$fecha_a_chequear2' AND (estado = 2 OR estado = 1)");
        
            if(mysqli_num_rows($select4) > 0 OR mysqli_num_rows($select5) > 0){
                // CITA YA SOLICITADA EN ESE HORARIO
                $estado = 1;
            }else{  $estado = 0;
            
            }


        
/*         
         $horarios[] = array(
                'hora'=>$horaFormat,
                'zona_horaria'=>'GMT'.$zona_horaria_receptor,
                'hora_mia'=>$hora_mia,
                'zona_horaria_mia'=>'GMT'.$zona_horaria_emisor,
                'estado'=>$estado
            ); 
         */

         $horarios .= '<div class="col-4 text-center" style="background-color: #fff"><b>
         '.$horaFormat.' hs<br></b>
         <small>Mi horario '.$hora_mia.'</small>
         <button class="btn btn-sm btn-success" 
         onclick="insertarRonda(`'.$fechas_ronda.'`,`'.$receptor.'`,`'.$hora_mia.'`)">Solicitar</button>
         </div>' ;
            
      
    
    }
    
}

}

$horarios .= '</div>';

       /*  $res[] = array('fecha'=>$fecha_formateada,'dia'=>$day); */

        $res[] = array("date"=>$row['fecha'],
        "badge"=>false,
        "title"=>"Día de Ronda".$row['fecha'],
        "body"=>$horarios,
        "footer"=>"Circulo Vip Empresarial",
        "classname"=>"badgeZabuto");

    }

}

mysqli_close($mysqli);
echo json_encode($res);
 


?>