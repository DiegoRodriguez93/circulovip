<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_usuario']);

$select = mysqli_query($mysqli,"SELECT u.id, u.nombre, du.cargo, du.acerca_de_mi, du.url_avatar, de.nombre as nombreEmpresa, de.pais, de.descripcion, de.url_image
FROM usuarios AS u
LEFT JOIN datos_user AS du ON du.id_user = u.id
LEFT JOIN datos_empresa AS de ON de.id_user = u.id WHERE u.id = '$id_user' ");

if(mysqli_num_rows($select) > 0){

    while($row = mysqli_fetch_array($select)){

        $id = $row['id'];
        $nombre = $row['nombre'];
        $cargo = $row['cargo'];
        $acerca_de_mi = $row['acerca_de_mi'];
        $url_avatar = $row['url_avatar'];
        $nombreEmpresa = $row['nombreEmpresa'];
        $pais = $row['pais'];
        $descripcion = $row['descripcion'];
        $url_image = $row['url_image'];

        if($url_image == null OR $url_image == ''){
            $url_image = 'https://renoca.ml/work/circulovip/images/greyenterprice.jpg';
        }

        
        if($url_avatar == null OR $url_avatar == ''){
            $url_avatar = 'https://renoca.ml/work/circulovip/images/profile.jpg';
        }

        $res = array('id'=>$id,
        'nombre'=>$nombre,
        'cargo'=>$cargo,
        'acerca_de_mi'=>$acerca_de_mi,
        'url_avatar'=>$url_avatar,
        'nombreEmpresa'=>$nombreEmpresa,
        'pais'=>$pais,
        'descripcion'=>$descripcion,
        'url_image'=>$url_image);

   }

}else{

    $res= array();

}

mysqli_close($mysqli);
echo json_encode($res);

?>