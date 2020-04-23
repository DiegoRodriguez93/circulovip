<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_GET['id_user']);
$zona_horaria = mysqli_real_escape_string($mysqli, $_GET['zona_horaria']);

$select = mysqli_query($mysqli, "SELECT * FROM citas 
WHERE (id_emisor = '$id_user' OR id_receptor = '$id_user') AND dia_hora >= current_date() ORDER BY id_cita DESC ");

if(mysqli_num_rows($select) > 0){

    while($row = mysqli_fetch_array($select)){

      $id_cita      = $row['id_cita'];
      $id_emisor    = $row['id_emisor'];
      $id_receptor  = $row['id_receptor'];
      $estado       = $row['estado'];
      $sala         = $row['sala'];

      if($id_emisor == $id_user){
        $id_destinatario = $id_receptor;
      }else{
        $id_destinatario = $id_emisor;
      }

      if($id_emisor == $id_user){
          $select2 = mysqli_query($mysqli, "SELECT u.nombre AS nombre, d.url_avatar AS url_avatar FROM usuarios as u 
          LEFT JOIN datos_user as d ON u.id = d.id_user WHERE u.id = '$id_receptor' ");

         $row2 = mysqli_fetch_assoc($select2);

         $nombre = $row2['nombre'];
         $avatar = $row2['url_avatar'];

         
         
         $fecha = strtotime($row['dia_hora']);
         $fecha_formateada = date("d/m/y H:i", $fecha);
         
         $tipo = 'Cita solicitada<br><b>'.$fecha_formateada.'</b>' . '<br>GMT' . $zona_horaria;

         if($estado == 0){
          $estado = '<b><p class="text-danger"><i class="fas fa-times"></i> Rechazada<p></b>';
          $opciones = '<button onclick="abrirModalMensaje(`'.$id_destinatario.'`,`'.$nombre.'`)" class="btn btn-indigo btn-sm"><i class="fas fa-envelope fa-2x"></i></button>';
        }elseif($estado == 2){
          $estado = '<b><p class="deep-purple-text"><i class="fas fa-exclamation"></i> Pendiente<p></b>';
          $opciones = '<button onclick="abrirModalMensaje(`'.$id_destinatario.'`,`'.$nombre.'`)" class="btn btn-indigo btn-sm"><i class="fas fa-envelope fa-2x"></i></button>';
        }else{
          $estado = '<b><p class="text-success"><i class="fas fa-check"></i> Aceptada<p></b>';
          $opciones = '<button onclick="abrirModalMensaje(`'.$id_destinatario.'`,`'.$nombre.'`)" class="btn btn-indigo btn-sm"><i class="fas fa-envelope fa-2x"></i></button>
          <button onclick="IngresarASala(`'.$sala.'`)" class="btn btn-deep-purple btn-sm"><i class="fas fa-sign-in-alt fa-2x"></i></button>';
        }
    
      }

      
      if($id_receptor == $id_user){
        $select2 = mysqli_query($mysqli, "SELECT u.nombre, u.zona_horaria, d.url_avatar FROM usuarios as u 
        LEFT JOIN datos_user as d ON u.id = d.id_user WHERE u.id = '$id_emisor' ");

        $row2 = mysqli_fetch_assoc($select2);

       $nombre = $row2['nombre'];
       $avatar = $row2['url_avatar'];
       $zona_horaria_emisor = $row2['zona_horaria'];

       $fecha = strtotime($row['dia_hora']);
     
       $hora_formateada = date("H:i", $fecha);

       
    if( intval($zona_horaria) == intval($zona_horaria_emisor)){
      $hora_mia =  $hora_formateada;
  }else{

   $diferencia_de_horas =   count(range(intval($zona_horaria),intval($zona_horaria_emisor))) ;
   $date = DateTime::createFromFormat( 'Y-m-d H:i:s', $row['dia_hora'] );
   $hora = $date->format('H');
   $minutos = $date->format('i');

   if(intval($zona_horaria) > intval($zona_horaria_emisor)){

      $hora_final = $hora - $diferencia_de_horas + 1;

   }else{

      $hora_final = $hora + $diferencia_de_horas - 1;

   }

   $hora_mia = $hora_final.':'.$minutos;

  }
  $dia = date("d/m/y", $fecha);
  $tipo = 'Cita recibida<br><b>' . $dia . ' ' . $hora_mia . '</b><br>GMT' . $zona_horaria ;

       if($estado == 0){
        $estado = '<b><p class="text-danger"><i class="fas fa-times"></i> Rechazada<p></b>';
        $opciones = '<button onclick="abrirModalMensaje(`'.$id_destinatario.'`,`'.$nombre.'`)" class="btn btn-indigo btn-sm"><i class="fas fa-envelope fa-2x"></i></button>';
      }elseif($estado == 2){
        $estado = '<b><p class="deep-purple-text"><i class="fas fa-exclamation"></i> Pendiente<p></b>';
        $opciones = '<button onclick="aceptarCita(`'.$id_cita.'`)" class="btn btn-success btn-sm"><i class="fas fa-check fa-2x"></i></button>
        <button onclick="cancelarCita(`'.$id_cita.'`)" class="btn btn-danger btn-sm"><i class="fas fa-times fa-2x"></i></button>
        <button onclick="abrirModalMensaje(`'.$id_destinatario.'`,`'.$nombre.'`)" class="btn btn-indigo btn-sm"><i class="fas fa-envelope fa-2x"></i></button>';
      }else{
        $estado = '<b><p class="text-success"><i class="fas fa-check"></i> Aceptada<p></b>';
        $opciones = '<button onclick="abrirModalMensaje(`'.$id_destinatario.'`,`'.$nombre.'`)" class="btn btn-indigo btn-sm"><i class="fas fa-envelope fa-2x"></i></button>
        <button onclick="IngresarASala(`'.$sala.'`)" class="btn btn-deep-purple btn-sm"><i class="fas fa-sign-in-alt fa-2x"></i></button>';
      }
  
    }

    /* AVATAR START */
    if($avatar == null){
      $img_avatar = "<img
      class='img-fluild
      rounded-circle pointer'
      width='40'
      height='40'
      onclick='mostrarDatosUsuario(`".$id_destinatario."`)'
      src='https://renoca.ml/work/circulovip/images/profile.jpg' >"; 
    }else{
      $img_avatar = "<img
      class='img-fluild
      rounded-circle pointer'
      width='40'
      height='40'
      onclick='mostrarDatosUsuario(`".$id_destinatario."`)'
      src='".$avatar."' >"; 
    }
    /* AVATAR END */


    
    $newName = "<p style='cursor:pointerw' onclick='mostrarDatosUsuario(`".$id_destinatario."`)'>".$nombre."</p>";
    

    $res[] = array($img_avatar, $newName, $tipo, $opciones, $estado);

    }



}else{

    $res = array();

}

echo '{ "data": ' . json_encode($res) . ' }';
mysqli_close($mysqli);

?>