<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>
    <link rel="stylesheet" href="css/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <!-- MODAL CAMBIAR PASSWORD START -->
<div class="modal" id="mdlPassword" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_user_pass">
        <label for="pass_modal">Nueva contraseña</label>
        <input type="password" class="form-control" id="pass_modal">
        <label for="pass2_modal">Repetir nueva contraseña</label>
        <input type="password" class="form-control" id="pass2_modal">

      </div>
      <div class="modal-footer">
        <button type="button" onclick="cambiarPassOk()" class="btn btn-primary">Guardar cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
 <!-- MODAL CAMBIAR PASSWORD END -->

   <!-- MODAL CAMBIAR FECHA START -->
<div class="modal" id="mdlVencimiento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar fecha de vencimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_user_date">
        <label for="vencimiento_modal">Nueva fecha de vencimiento</label>
        <input type="date" class="form-control" id="vencimiento_modal">

      </div>
      <div class="modal-footer">
        <button type="button" onclick="editarVencimientoOk()" class="btn btn-primary">Guardar cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
 <!-- MODAL CAMBIAR FECHA END -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div style="display:none" class="loading"></div>

              <?php include 'include/navbar.php'; ?>
              <div class="row">
              <div class="col-6">
                Sponsor 1 ↑
              </div>
              
              <div class="col-6">
                Sponsor 2 ↑
              </div>

              </div>


            </div>


        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../lib/helper.js"></script>

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

    if ( ! $.fn.DataTable.isDataTable( '#TableFechas' ) ) {
              //cargamos la tabla
               table = $('#TableFechas').DataTable({
                  ajax : '../ajax/admin/listar_fechas_ronda.php',   
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

  $('#banners').addClass('active');

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