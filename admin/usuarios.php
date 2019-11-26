<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</head>
<body>
 
<table id="TablaUsuarios" class="display table" style="width: 100%">
<thead>
    <tr>
        <th>Id</th>
        <th>Cedula</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Tipo</th>
    </tr>
</thead>
<tbody></tbody>
</table>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#TablaUsuarios').DataTable({
        ajax : '../ajax/listar_usuarios_admin.php'
    });
} );
</script>
</body>
</html>