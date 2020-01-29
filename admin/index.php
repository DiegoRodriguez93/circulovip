<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador Citas</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

              <?php include 'include/navbar.php'; ?>
<!-- 
              <div class="d-inline"> 
                <h4 class="d-inline">Total de citas:
                <div class="d-inline" id="totalTransacciones">0</div></h4>   
              </div>
             <div class="mb-3"></div>

              <div class="mb-5">
                <b>Desde</b> <input id="startDate" type="date"><b>  Hasta</b> <input id="endDate" type="date"><button class="btn btn-primary btn-lg ml-4" onclick="filtrar()">Filtrar</button>
                <button class="btn btn-warning btn-lg ml-4" onclick="reset()">Reset</button>
              </div>

   -->
     <div class="text-center">
     <h3>Listado de citas</h3>
     </div> 
            <table id="TableCitas" class="display table" style="width: 100%">
        <thead>
            <tr>
        <th>Id_cita</th>
        <th>Fecha Cita</th>
        <th>Solicitante</th>
        <th>Solicitado</th>
        <th>Estado</th>
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



function eliminarFecha($id){

Swal.fire({
title: '¿Estas seguro que deseas eliminar la fecha?',
text: "Decisión irreversible!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Si!'
}).then((result) => {
if (result.value) {

$.ajax({
  url: "../ajax/admin/eliminar_fecha.php",
  method: "POST",
  dataType: "JSON",
  data:{id:$id},
  beforeSend: function(){ 
  $('.loading').css('display','block');},
  success: function(res){
    if(res.result){
      startTable();
      $('.loading').css('display','none');
      Swal.fire(
        'Eliminado!',
        'La fecha ha sido eliminado correctamente.',
        'success'
      )
    }else{

      alert(res.message);
    }
  },complete: function () {
    $('.loading').css('display','none');
  }
})



}
})


}

function ingresarFecha(){

$fecha = $('#fecha').val();

if($fecha == ''){
  alert('Fencha de vencimiento');
  $('#fecha').addClass('is-invalid');
  return false
}else{
  $('#fecha').addClass('is-valid');
}

$.ajax({
  url: "../ajax/admin/ingresar_fecha.php",
  method: "POST",
  data: {fecha: $fecha},
  dataType: "JSON",
  beforeSend: function(){ 
  $('.loading').css('display','block');},
  success: function(res){
    if(res.result){
      $('.loading').css('display','none');
      alert(res.message);
      $("#fecha").val('');
      $("#fecha").attr('class', 'form-control');
      startTable();
    }else{
      alert(res.message);
    }
  },complete: function () { 
    $('.loading').css('display','none');
   }
})

}

function startTable(){

if ( ! $.fn.DataTable.isDataTable( '#TableCitas' ) ) {
          //cargamos la tabla
           table = $('#TableCitas').DataTable({
              ajax : '../ajax/admin/listar_citas.php',   
              lengthChange: false,
              order: [0,'desc'],
              oLanguage: {
                  "sUrl": "../json/traducciontabla.json"
              }
});
}else{
  //ajax reload

  table.ajax.reload();
    
}

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

startTable();

}else{
    alert('Contraseña incorrecta');
    logIn();
}

}
})
}

$(document).ready( function () {

$('#inicio').addClass('active');

let admin = localStorage.getItem('admin');

if(admin == 'asdasd'){

startTable();

}else{
logIn(); // disparamos el logIn
}




} );
</script>
</body>
</html>