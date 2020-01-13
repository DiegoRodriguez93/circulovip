<?php 

require '../../_conexion.php';

$id_producto = $_GET['id_producto'];

$select = mysqli_query($mysqli,"SELECT id_producto, nombre, descripcion FROM productos WHERE id_producto = '$id_producto'");

$row = mysqli_fetch_assoc($select);

$res = array(   'id'            =>$row['id_producto'], 
                'nombre'        =>$row['nombre'],
                'descripcion'   =>$row['descripcion']       );

echo json_encode($res);

mysqli_close($mysqli);


?>