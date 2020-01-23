<?php 

require '../../_conexion.php';

$select = mysqli_query($mysqli,"SELECT DISTINCT pais FROM datos_empresa WHERE pais IS NOT NULL");

if(mysqli_num_rows($select) > 0 ){

    while($row = mysqli_fetch_array($select)){

        $res[] = array('pais'=>$row['pais']);

    }

}else{

    $res = array('pais'=>'No hay empresas disponibles');

}

mysqli_close($mysqli);
echo json_encode($res);


?>