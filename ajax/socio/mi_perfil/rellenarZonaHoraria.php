<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli,$_POST['id_user']);

$select = mysqli_query($mysqli,"SELECT zona_horaria FROM usuarios WHERE id = '$id_user' ");

$zonasHoraria = '';

for($i = -9;$i < 10;$i++){

    $zonasHoraria .= $i.',';

}

$zonasHoraria = substr($zonasHoraria, 0, -1); // delete last comma

$zonas = explode(",", $zonasHoraria);

if(mysqli_num_rows($select) == 1){

   $row = mysqli_fetch_assoc($select);

   $zonasHorariaAcutal = $row['zona_horaria'];

   if ($zonasHorariaAcutal == null){
       $zonasHorariaAcutal = 0;}

   $res = array('result'=>false,'zonaHorariaActual'=>$zonasHorariaAcutal);

}else{ 

    $res = array('result'=>false);

}

mysqli_close($mysqli);
echo json_encode(array('result'=>$res,'zonas'=>$zonas));


?>