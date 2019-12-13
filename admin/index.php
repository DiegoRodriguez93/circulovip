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

              <div class="d-inline"> 
                <h4 class="d-inline">Total de transacciones:
                <div class="d-inline" id="totalTransacciones">0</div></h4>   
              </div>
             <div class="mb-3"></div>

              <div class="mb-5">
                <b>Desde</b> <input id="startDate" type="date"><b>  Hasta</b> <input id="endDate" type="date"><button class="btn btn-primary btn-lg ml-4" onclick="filtrar()">Filtrar</button>
                <button class="btn btn-warning btn-lg ml-4" onclick="reset()">Reset</button>
              </div>


            <table id="TableTransacciones" class="display table" style="width: 100%">
        <thead>
            <tr>
        <th>Id_transaccion</th>
        <th>Envia</th>
        <th>Fecha transacción</th>
        <th>Monto</th>
        <th>Código cupón</th>
        <th>Recibe</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
            </div>
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

  function filtrar(){

   $startDate = $('#startDate').val();
   $endDate   = $('#endDate').val();

   if($startDate == '' || $endDate == '' ){
    Swal.fire({
      title: 'Ingrese las dos fechas para filtrar',
      icon: 'error',
      confirmButtonText: 'Ok'
    })

    return false;

   }

   if($startDate ==  $endDate ){
    Swal.fire({
      title: 'Ingrese las dos fechas con al menos un día de diferencia para filtrar',
      icon: 'error',
      confirmButtonText: 'Ok'
    })

    return false;

   }
   localStorage.setItem('startDate', $startDate);
   localStorage.setItem('endDate', $endDate);
   location.reload();

  }

  function reset(){
    localStorage.setItem('startDate', '');
   localStorage.setItem('endDate', '');
   location.reload();
  }



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
    var table = $('#TableTransacciones').DataTable({
        ajax : '../ajax/listar_transacciones_admin.php?startDate=&endDate=',   
                  lengthChange: false,
                  order: [0,'desc'],
                  oLanguage: {
                      "sUrl": "../json/traducciontabla.json"
                  }

                  
    });
     $.ajax({
      method:"GET",
      url: '../ajax/listar_transacciones_admin.php', 
      dataType: "JSON",
      success: function(res){
        $('#totalTransacciones').html(res.data[0][6]);
      }
    }) 
    }else{
        alert('Contraseña incorrecta');
        logIn();
    }
 
  }
})
}

$(document).ready( function () {

  $('#transacciones').addClass('active');

  let admin = localStorage.getItem('admin');
  let startDate = localStorage.getItem('startDate');
  let endDate = localStorage.getItem('endDate');

  $('#startDate').val(startDate);
  $('#endDate').val(endDate);


  if(admin == 'asdasd'){
        //cargamos la tabla
        var table =  $('#TableTransacciones').DataTable({
        ajax : '../ajax/listar_transacciones_admin.php?startDate='+startDate+'&endDate='+endDate,   
                  lengthChange: false,
                  order: [0,'desc'],
                  oLanguage: {
                      "sUrl": "../json/traducciontabla.json"
                  }
    });

     $.ajax({
      method:"GET",
      url: '../ajax/listar_transacciones_admin.php?startDate='+startDate+'&endDate='+endDate, 
      dataType: "JSON",
      success: function(res){
        $('#totalTransacciones').html(res.data[0][6]);
      }
    })

  }else{
    logIn(); // disparamos el logIn
  }



 
} );
</script>
</body>
</html>