<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador Transacciones</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

              <?php include 'include/navbar.php'; ?>

            <table id="TableTransacciones" class="display table" style="width: 100%">
        <thead>
            <tr>
        <th>Id_Comercio</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Dirección</th>
        <th>Phone</th>
        <th>Rubro</th>
        <th>Activo</th>
        <th>Disponible</th>
        <th>Logo</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
            </div>
            <div class="col-lg-4 sm-0"></div>
            
          <div class="col-lg-4 sm-12">
          <div class="text-center my-5">
            <h3>Formulario de ingreso de comercio</h3>
          </div>
          <form enctype="multipart/form-data" id="form_comercio">
  
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" id="email">

          <label for="">Contraseña</label>
          <input type="password" class="form-control" name="pass" id="pass">

          <label for="">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre">

          <label for="">Dirección</label>
          <input type="text" class="form-control" name="address" id="address">

          <label for="">Teléfono</label>
          <input type="text" class="form-control" name="phone" id="phone">

          <label for="">Rubro</label>
          <input type="text" class="form-control" name="rubro" id="rubro">


          <br>
          <label for="">Cargar imagen .jpg .png .gif</label>
          <input type="hidden" name="max_file_size" value="200000" />
          <input name="fileToUpload" id='fileToUpload'  type="file" /><br><br>

          <div class="text-center my-3">
              <input type="submit" class="btn btn-success btn-lg" value="Ingresar Comercio">
          </div>

          </form>
          </div>
          <div class="col-lg-4 sm-0"></div>


        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/comercios.js"></script>

<script>

function logIn(){
    Swal.mixin({

  input: 'password',
  confirmButtonText: 'Ingresar &rarr;',
  backdrop: false,
  background: '#fff',
}).queue([
  {
    title: 'Ingrese la contraseña de administrador'
  }
]).then((result) => {
  if (result.value) {
    const answers = JSON.stringify(result.value)

    if(result.value == 1980){
        Swal.fire({
      title: 'Bienvienido!',
     icon: 'success',
      confirmButtonText: 'Ok'
    })

    localStorage.setItem('admin','asdasd');

    //cargamos la tabla
    $('#TableTransacciones').DataTable({
        ajax : '../ajax/listar_comercios_admin.php',   
                  lengthChange: false,
                  order: [0,'desc'],
                  oLanguage: {
                      "sUrl": "../json/traducciontabla.json"
                  }
    });

    }else{
        alert('Contraseña incorrecta');
        logIn();
    }
 
  }
})
}

$(document).ready( function () {

  $('#comercios').addClass('active');

  let admin = localStorage.getItem('admin');

  if(admin == 'asdasd'){
        //cargamos la tabla
        $('#TableTransacciones').DataTable({
        ajax : '../ajax/listar_comercios_admin.php',   
                  lengthChange: false,
                  order: [0,'desc'],
                  oLanguage: {
                      "sUrl": "../json/traducciontabla.json"
                  }
    });
  }else{
    logIn(); // disparamos el logIn
  }



 
} );
</script>
</body>
</html>