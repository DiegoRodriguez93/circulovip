<?php 

$mysqli = new mysqli('localhost', 'root', 'sist.2k8', 'vidapesos');

$query = mysqli_query($mysqli,"SELECT * FROM usuarios_melo");

while($row = mysqli_fetch_array($query)){

    $cedula = $row['cedula'];

    $res[] = array('cedula'=>$cedula);

}

echo json_encode($res);

?>
