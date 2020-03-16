<?php 

require '../../_conexion.php';

$id_empresa = mysqli_real_escape_string($mysqli, $_POST['id_empresa']);

$select = mysqli_query($mysqli,"SELECT * FROM datos_empresa WHERE id_empresa = '$id_empresa' ");

if(mysqli_num_rows($select) > 0){

    while($row = mysqli_fetch_array($select)){

      $nombre_empresa       =  $row['nombre'];
      $pais         =  $row['pais'];
      $descripcion  =  $row['descripcion'];
      $url_image    =  $row['url_image'];
      $id_user      =  $row['id_user'];

      $select2 = mysqli_query($mysqli, "SELECT u.nombre, d.cargo, d.acerca_de_mi, d.url_avatar FROM usuarios AS u
       LEFT JOIN datos_user AS d ON u.id = d.id_user  WHERE u.id = '$id_user' ");
            
            $row2 = mysqli_fetch_assoc($select2);

            $nombre       = $row2['nombre'];
            $cargo        = $row2['cargo'];
            $acerca_de_mi = $row2['acerca_de_mi'];
            $url_avatar   = $row2['url_avatar'];

            if($url_image == null){
                $url_image = '../images/greyenterprice.jpg';
            }

            if($url_avatar == null){
                $url_avatar = '../images/profile.jpg';
            }

            if($descripcion == null){
                $descripcion = '';
            }

            if($acerca_de_mi == null){
                $acerca_de_mi = '';
            }

            if($cargo == null){
                $cargo = '';
            }

            $array_empresa = array('nombre_empresa'=>$nombre_empresa,
            'pais'=>$pais,
            'descripcion'=>$descripcion,
            'url_image'=>$url_image,
            'id_user'=>$id_user,
            'nombre'=>$nombre,
            'cargo'=>$cargo,
            'acerca_de_mi'=>$acerca_de_mi,
            'url_avatar'=>$url_avatar
        );
    
    }

    $select3 = mysqli_query($mysqli,"SELECT `nombre`,`descripcion`,`img_url` 
    FROM `productos` WHERE `id_empresa` = '$id_empresa'");

    if(mysqli_num_rows($select3)>0){

        while($row3 = mysqli_fetch_array($select3)){

            $array_producto = array('nombre'=>$row3['nombre'],
            'descripcion'=>$row3['descripcion'],
            'img_url'=>$row3['img_url']);

        }

    }else{

        $array_producto = array();
        
    }

    $res[] = array(array('empresa'=>$array_empresa),array('productos'=>$array_producto));

}else{

    $res = array();

}

mysqli_close($mysqli);
echo json_encode($res);

?>