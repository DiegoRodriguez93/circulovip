<?php 

require '../../_conexion.php';

$id_receptor    = $_GET['id_receptor'];
$id_emisor      = $_GET['id_emisor'];
/* $url_avatar     = $_GET['url_avatar']; */
$nombre_emisor  = $_GET['nombre_emisor'];

$query = mysqli_query($mysqli,"SELECT * from mensajes 
WHERE id_emisor = '$id_emisor' and id_receptor = '$id_receptor' 
OR id_emisor = '$id_receptor' and id_receptor = '$id_emisor' 
ORDER BY id");

$contar = mysqli_num_rows($query);

if($contar > 0){

    while($row = mysqli_fetch_array($query)){

        if($row['id_emisor'] == $id_receptor ){
            $nombre_emisor_fn = 'Tú';
            $style = 'float:left';
        }else{
            $nombre_emisor_fn = $nombre_emisor;
            $style = 'float:right;padding: 8px;background-color: #6610f2; color: #fff';
        }
        
        $fecha = strtotime($row['fecha']);
        $fecha_formateada = date("d/m H:i", $fecha);

        $all = '<div style=" border-radius: 25px;'.$style.'" ><small><b>'.$fecha_formateada.'</b>
        </small> '.$nombre_emisor_fn.': '.$row['mensaje'].'</div>'; 

        $res[] = array($all);

/*         $res[] = array('nombre'=>$nombre_emisor,
        'mensaje'=>$row['mensaje'],
        'fecha'=>$fecha_formateada); */

        
    }


}else{

    echo array();

}

echo '{ "data": ' . json_encode($res) . ' }';

mysqli_close($mysqli);

?>