<?php 

require '../../_conexion.php';

$select = mysqli_query($mysqli,"SELECT * FROM datos_empresa");

if(mysqli_num_rows($select) > 0){


    while($row = mysqli_fetch_array($select)){

       $id_empresa  = $row['id_empresa'];
       $id_user     = $row['id_user'];
       $nombre      = $row['nombre'];
       $pais        = $row['pais'];
       $descripcion = $row['descripcion'];
       $url_image   = $row['url_image'];

       $res[] = array(
       'id_empresa' =>$id_empresa,
       'id_user'    =>$id_user,
       'nombre'     =>$nombre,
       'pais'       =>$pais,
       'descripcion'=>$descripcion,
       'url_image'  =>$url_image);

    }


}else{

    $res = array();

}


echo json_encode($res);
mysqli_close($mysqli);

?>