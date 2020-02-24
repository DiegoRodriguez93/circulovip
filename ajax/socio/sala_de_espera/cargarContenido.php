<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$zona_horaria = mysqli_real_escape_string($mysqli, $_POST['zona_horaria']);

$fecha = date_create("now");

$fecha = date_format($fecha,"Y/m/d H:i:s");

$select = mysqli_query($mysqli, "SELECT * FROM citas 
WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') AND dia_hora >= '$fecha' AND estado = 1 limit 1 ");

if(mysqli_num_rows($select) > 0){

    $row = mysqli_fetch_assoc($select);
/* TODO : CONVERT TO GMT BEFORE PRINT ON SCREEN */
   /*  $fecha = date_create($row['dia_hora']);
 */
    $id_emisor = $row['id_emisor'];

    if($id_user == $id_emisor ){

        $fecha = date_create($row['dia_hora']);
        $fecha = date_format($fecha,'Y-m-d H:i:s');
        $fecha_format = date_format($fecha,'d/m/Y H:i');

        $id_receptor = $row['id_receptor'];

        $select2 = mysqli_query($mysqli,"SELECT nombre, zona_horaria
        FROM usuarios WHERE id = '$id_receptor' ");

        $row2 = mysqli_fetch_assoc($select2);

        $nombre = $row2['nombre'];
        $zona_horaria_otro = $row2['zona_horaria'];

    }else{

        $select2 = mysqli_query($mysqli,"SELECT nombre, zona_horaria
        FROM usuarios WHERE id = '$id_emisor' ");

        $row2 = mysqli_fetch_assoc($select2);

        $nombre = $row2['nombre'];
        $zona_horaria_otro = $row2['zona_horaria'];

        $zona_horaria_emisor = $row['zona_horaria_emisor'];

        if( intval($zona_horaria) == intval($zona_horaria_emisor)){
            $fecha = date_create($row['dia_hora']);
            $fecha = date_format($fecha,'Y-m-d H:i:s');
            $fecha_format = date_format($fecha,'d/m/Y H:i');
        }else{
    
         $diferencia_de_horas =   count(range(intval($zona_horaria),intval($zona_horaria_emisor))) ;

         $date = DateTime::createFromFormat( 'Y-m-d H:i:s', $row['dia_hora'] );
    
         $dia = $date->format('d/m/Y');
         $dia_format = $date->format('Y-m-d');
         $hora = $date->format('H');
         $minutos = $date->format('i');
         $segundos = $date->format('s');
    
         if(intval($zona_horaria) > intval($zona_horaria_emisor)){
    
            $hora_final = $hora - $diferencia_de_horas + 1;
    
         }else{
    
            $hora_final = $hora + $diferencia_de_horas - 1;
    
         }
         $fecha = $dia_format . ' ' . $hora_final . ':' . $minutos . ':' . $segundos;
         $fecha_format = $dia . ' ' . $hora_final.':'.$minutos;
    
        }
    }
    
    $res[] = array('fecha'=>$fecha,
    'fecha_format'=>$fecha_format,
    'sala'=>$row['sala'],
    'nombre'=>$nombre,
    'zona_horaria_otro'=>$zona_horaria_otro);

}else{

    $res = array();

}

mysqli_close($mysqli);
echo json_encode($res);


?>