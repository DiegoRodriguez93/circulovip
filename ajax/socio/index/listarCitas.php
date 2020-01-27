<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$zona_horaria = mysqli_real_escape_string($mysqli, $_POST['zona_horaria']);

$select = mysqli_query($mysqli, "SELECT * FROM citas WHERE id_emisor = '$id_user' OR id_receptor = '$id_user' ");

if(mysqli_num_rows($select) > 0){

    while($row = mysqli_fetch_array($select)){

      $id_cita      = $row['id_cita'];
      $id_emisor    = $row['id_emisor'];
      $id_receptor  = $row['id_receptor'];
      $estado       = $row['estado'];

      if($estado == 0){
        $estado = 'rechazada';
      }elseif($estado == 1){
        $estado = 'pendiente';
      }else{
        $estado = 'aceptada';
      }

      if($id_emisor == $id_user){
          $select2 = mysqli_query($mysqli, "SELECT u.nombre, d.url_avatar FROM usuarios as u 
          LEFT JOIN datos_user as d ON u.id = d.id_user WHERE u.id = '$id_receptor' ");

          $row2 = mysqli_fetch_assoc($select2);

         $nombre = $row['nombre'];
         $avatar = $row['url_avatar'];

         $tipo = 'Cita solicitada';
      }

      
      if($id_receptor == $id_user){
        $select2 = mysqli_query($mysqli, "SELECT u.nombre, d.url_avatar FROM usuarios as u 
        LEFT JOIN datos_user as d ON u.id = d.id_user WHERE u.id = '$id_emisor' ");

        $row2 = mysqli_fetch_assoc($select2);

       $nombre = $row['nombre'];
       $avatar = $row['url_avatar'];

       $tipo = 'Cita recibida';
    }

    $fecha = strtotime($row['dia_hora']);
    $fecha_formateada = date("d/m H:i", $fecha);

    $button = '';

    $res[] = array('avatar'=>$avatar,
    'nombre'=>$nombre,
    'tipo'=>$tipo,
    'estado'=>$estado,
    'button'=>$button);

    }



}else{

    $res = array();

}

echo json_encode($res);
mysqli_close($mysqli);

?>