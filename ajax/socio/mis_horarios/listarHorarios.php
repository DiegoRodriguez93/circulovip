<?php 

require '../../_conexion.php';

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);

$select = mysqli_query($mysqli,"SELECT * FROM horarios WHERE id_user = '$id_user' ");

 if(mysqli_num_rows($select) == 0){ 
    /* SI TIENE CERO ES UN USUARIO NUEVO Y HAY QUE INSERTARLE TODOS LOS HORARIOS DISPONIBLES DE L A V DE 9 A 18 HS */

    $horas = array('09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00',
    '12:00:00','12:30:00','13:00:00','13:30:00','14:00:00','14:30:00',
    '15:00:00','15:30:00','16:00:00','16:30:00','17:00:00','17:30:00','18:00:00');

    if(is_array($horas)){

        $DataArr = array();

        foreach($horas as $row){

            $fieldVal1 = '12345'; /* 12345 es de L a V 6 y 7 Sabados y domingo respectivamente */
            $fieldVal2 = $row;
            $fieldVal3 = $id_user;
    
            $DataArr[] = "('$fieldVal1', '$fieldVal2', '$fieldVal3')";
        }
    
        $sql = "INSERT INTO horarios (id_dia, hora, id_user) values ";
        $sql .= implode(',', $DataArr);
    
       mysqli_query($mysqli,$sql);

    }

    $select2 = mysqli_query($mysqli,"SELECT * FROM horarios WHERE id_user = '$id_user' ");

    while($row2 = mysqli_fetch_array($select2)){

        $id_horario = $row2['id'];
        $dias     = $row2['id_dia'];
        $hora       = $row2['hora'];

        $diasConLetra = '';

        if (strpos($dias, '1') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(1,'.$id_horario.')">LU</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(1,'.$id_horario.')">LU</span>';
        }

        if (strpos($dias, '2') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(2,'.$id_horario.')">MA</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(2,'.$id_horario.')">MA</span>';
        }

        if (strpos($dias, '3') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(3,'.$id_horario.')">MI</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(3,'.$id_horario.')">MI</span>';
        }

        if (strpos($dias, '4') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(4,'.$id_horario.')">JU</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(4,'.$id_horario.')">JU</span>';
        }

        if (strpos($dias, '5') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(5,'.$id_horario.')">VI</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(5,'.$id_horario.')">VI</span>';
        }

        if (strpos($dias, '6') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(6,'.$id_horario.')">SA</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(6,'.$id_horario.')">SA</span>';
        }

        if (strpos($dias, '7') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(7,'.$id_horario.')">DO</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(7,'.$id_horario.')">DO</span>';
        }


        $date = DateTime::createFromFormat( 'H:i:s', $hora);
        $horaFormat = $date->format( 'H:i');

        $result[] = array('id_horario'=>$id_horario, 'diasConLetra'=>$diasConLetra, 'hora'=>$horaFormat);
    }
    
    echo json_encode($result);

}else{ 

    $select2 = mysqli_query($mysqli,"SELECT * FROM horarios WHERE id_user = '$id_user' ORDER BY hora ASC ");

    while($row2 = mysqli_fetch_array($select2)){

        $id_horario = $row2['id'];
        $dias       = $row2['id_dia'];
        $hora       = $row2['hora'];

        $diasConLetra = '';

        if (strpos($dias, '1') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(1,'.$id_horario.')">LU</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(1,'.$id_horario.')">LU</span>';
        }

        if (strpos($dias, '2') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(2,'.$id_horario.')">MA</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(2,'.$id_horario.')">MA</span>';
        }

        if (strpos($dias, '3') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(3,'.$id_horario.')">MI</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(3,'.$id_horario.')">MI</span>';
        }

        if (strpos($dias, '4') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(4,'.$id_horario.')">JU</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(4,'.$id_horario.')">JU</span>';
        }

        if (strpos($dias, '5') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(5,'.$id_horario.')">VI</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(5,'.$id_horario.')">VI</span>';
        }

        if (strpos($dias, '6') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(6,'.$id_horario.')">SA</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(6,'.$id_horario.')">SA</span>';
        }

        if (strpos($dias, '7') !== false) {
            $diasConLetra .= ' <span onclick="quitarDia(7,'.$id_horario.')">DO</span>';
        }else{
            $diasConLetra .= ' <span style="color: #dbd9d9" onclick="agregarDia(7,'.$id_horario.')">DO</span>';
        }

        $date = DateTime::createFromFormat( 'H:i:s', $hora);
        $horaFormat = $date->format( 'H:i');

        $result[] = array('id_horario'=>$id_horario, 'diasConLetra'=>$diasConLetra, 'hora'=>$horaFormat);
    }
    
    echo json_encode($result);

} 

?>