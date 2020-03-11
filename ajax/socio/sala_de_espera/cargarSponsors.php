<?php 
require '../../_conexion.php';


$select3 = mysqli_query($mysqli, "SELECT url_image, href, tipo FROM sponsors");

if(mysqli_num_rows($select3) > 0){
    while($row3 = mysqli_fetch_array($select3)){

       $url_image = $row3['url_image'];
       $href = $row3['href'];
       $tipo = $row3['tipo'];

       $res[] = array('url_image'=>$url_image,
       'href'=>$href,
       'tipo'=>$tipo );

    }
}else{


  $res = array();

}

echo json_encode($res);
mysqli_close($mysqli);

?>