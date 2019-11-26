<?php 
header("Access-Control-Allow-Origin: *");
require '_conexion.php';

if(isset($_GET['search_word']) AND $_GET['search_word'] != '' ){

    $search_word = trim($_GET['search_word']);

    $query = mysqli_query($mysqli,"SELECT id_comercio, name, address, phone, rubro, logo_url FROM comercios WHERE activo = 1 
    AND name LIKE '%$search_word%' OR address LIKE '%$search_word%' OR rubro LIKE '%$search_word%'  ");

}else{

    $query = mysqli_query($mysqli,"SELECT id_comercio, name, address, phone, rubro, logo_url FROM comercios WHERE activo = 1 ");

}



$contar = mysqli_num_rows($query);

if($contar > 0){

    while ($row = mysqli_fetch_array($query)){

        $id_comercio    = $row['id_comercio'];
        $name           = $row['name'];
        $address        = $row['address'];
        $phone          = $row['phone'];
        $rubro          = $row['rubro'];
        $logo_url       = $row['logo_url'];

        $response[] = array(
        'id_comercio'=>$id_comercio,
        'name'=>$name,
        'address'=>$address,
        'phone'=>$phone,
        'rubro'=>$rubro,
        'logo_url'=>$logo_url);
    
    }
    echo  json_encode($response);

}else{

    echo '{ [] }';

}

mysqli_close($mysqli);

?>