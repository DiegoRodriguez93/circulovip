<?php 

require '../../_conexion.php';

 $id_user = $_POST['id_user']; 
/* $id_user = 12; */

/* $query = mysqli_query($mysqli,"SELECT u.nombre as nombre_completo, u.email as email, u.fecha_vencimiento as fecha_vencimiento,
 d.cargo, d.acerca_de_mi, d.url_avatar, de.url_image as url_empresa,
  de.nombre as nombre_empresa, de.pais as pais_empresa, de.descripcion as descripcion_empresa
 FROM datos_user as d
LEFT JOIN usuarios as u on d.id_user = u.id
LEFT JOIN datos_empresa as de ON de.id_user = d.id_user
 WHERE d.id_user = '$id_user' "); */

 $query = mysqli_query($mysqli,"SELECT u.nombre as nombre_completo, u.email as email, u.fecha_vencimiento as fecha_vencimiento,
 d.cargo, d.acerca_de_mi, d.url_avatar, de.url_image as url_empresa,
 de.nombre as nombre_empresa, de.pais as pais_empresa, de.descripcion as descripcion_empresa
 FROM usuarios as u 
 LEFT JOIN datos_user as d on d.id_user = u.id 
 LEFT JOIN datos_empresa as de ON de.id_user = u.id
 WHERE u.id = '$id_user'
 ");

$contar = mysqli_num_rows($query);

if($contar > 0){
    while($row = mysqli_fetch_array($query)){

        $nombre_completo = $row['nombre_completo'];
        $cargo = $row['cargo'];
        $acerca_de_mi = $row['acerca_de_mi'];
        $url_avatar = $row['url_avatar'];
        $url_empresa = $row['url_empresa'];

        $res = array(
        'result'                =>true, 
        'nombre_completo'       =>$nombre_completo,
        'cargo'                 =>$cargo,
        'acerca_de_mi'          =>$acerca_de_mi,
        'url_avatar'            =>$url_avatar,
        'url_empresa'           =>$url_empresa,
        'nombre_empresa'        =>$row['nombre_empresa'],
        'pais_empresa'          =>$row['pais_empresa'],  
        'descripcion_empresa'   =>$row['descripcion_empresa'],
        'emailPersona'          =>$row['email'],
        'vencimientoPersona'    => date_format (new DateTime($row['fecha_vencimiento']), 'd-m-Y')
    );

    }
}else{

    $res = array();

}

echo json_encode($res);
mysqli_close($mysqli);




?>