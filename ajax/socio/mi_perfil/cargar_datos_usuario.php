<?php 

require '../../_conexion.php';

$id_user = $_POST['id_user'];

$query = mysqli_query($mysqli,"SELECT nombres, apellidos, cargo, acerca_de_mi FROM datos_user WHERE '$id_user' ");

$contar = mysqli_num_rows($query);

if($contar > 0){
    while($row = mysqli_fetch_array($query)){

        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $cargo = $row['cargo'];
        $acerca_de_mi = $row['acerca_de_mi'];

        $res = array(
        'result'=>true, 
        'nombres'=>$nombres,
        'apellidos'=>$apellidos,
        'cargo'=>$cargo,
        'acerca_de_mi'=>$acerca_de_mi,  
    );

    }
}else{

    $res = array();

}

echo json_encode($res);
mysqli_close($mysqli);




?>