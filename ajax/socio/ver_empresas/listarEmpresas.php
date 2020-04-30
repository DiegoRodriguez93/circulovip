<?php 

require '../../_conexion.php';

if(isset($_GET['pais']) AND $_GET['pais'] != null AND $_GET['pais'] != '' 
AND $_GET['pais'] != 'undefined' AND $_GET['pais'] != 'Todos'){

    $pais = " AND pais = " . "'" . $_GET['pais'] . "'";

}else{

    $pais = '';

}

if(isset($_GET['nombre']) AND $_GET['nombre'] != null 
AND $_GET['nombre'] != '' AND $_GET['nombre'] != 'undefined' AND $_GET['nombre'] != 'Todos'){

    $nombre = " AND nombre LIKE " . "'%" . $_GET['nombre'] . "%'";

}else{

    $nombre = '';

}

$select = mysqli_query($mysqli,"SELECT * FROM datos_empresa 
WHERE nombre IS NOT NULL AND pais IS NOT NULL 
AND id_user NOT IN 
(SELECT id FROM usuarios 
WHERE activo = 2 OR activo = 0 )
 $pais $nombre ");

if(mysqli_num_rows($select) > 0){


    while($row = mysqli_fetch_array($select)){

       $id_empresa  = $row['id_empresa'];
       $id_user     = $row['id_user'];
       $nombre      = $row['nombre'];
       $pais        = $row['pais'];
       $descripcion = $row['descripcion'];
       $url_image   = $row['url_image'];

       if($descripcion == null){
           $descripcion = '';
       }

       if($url_image == null){
           $url_image = 'https://renoca.ml/work/circulovip/images/greyenterprice.jpg';
       }

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