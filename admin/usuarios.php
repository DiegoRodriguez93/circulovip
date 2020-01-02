<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador Transacciones</title>
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

            <table id="TableTransacciones" class="display table text-center" style="width: 100%">
        <thead>
            <tr>
        <th>Id_Usuario</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Contraseña</th>
        <th>Activo</th>
        <th>Fecha Vencimiento</th>
        <th>Eliminar</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
            </div>
            <div class="col-lg-4 sm-0"></div>
            
          <div class="col-lg-4 sm-12">
          <div class="text-center my-5">
            <h3>Formulario de ingreso de usuario</h3>
          </div>

          <label for="">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre">
  
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" id="email">

          <label for="">Fencha vencimiento</label>
          <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento">

          <label for="">Contraseña</label>
          <input type="password" class="form-control" name="pass" id="pass">

          <label for="">Repetir Contraseña</label>
          <input type="password" class="form-control" name="pass2" id="pass2">

          <br>

          <div class="text-center my-3">
              <input type="submit" onclick="registrarUsuario()" class="btn btn-success btn-lg" value="Registrar Usuario">
          </div>

          </div>
          <div class="col-lg-4 sm-0"></div>


        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../lib/helper.js"></script>

<script>
    function editarVencimiento($id){

$('#id_user_date').val($id);
$('#mdlVencimiento').modal('show');

}

function editarVencimientoOk(){

$iduser         = $('#id_user_date').val();
$vencimiento    = $('#vencimiento_modal').val();

if($vencimiento == ''){
alert('Ingrese una fecha de vencimiento válida');
return false;
}

$.ajax({
url: "../ajax/admin/cambiar_vencimiento_usuario_admin.php",
method: "POST",
dataType: "JSON",
data:{id:$iduser,fecha_vencimiento:$vencimiento},
beforeSend: function(){ 
$('#mdlVencimiento').modal('hide');  
$('.loading').css('display','block');},
success: function(res){
  if(res.result){
    startTable();
    $('.loading').css('display','none');
    Swal.fire(
      'Correcto!',
      'La fecha de vencimiento ha sido actualizada correctamente.',
      'success'
    )
  }else{
    $('.loading').css('display','none');
    alert(res.message);
  }
}
})

}

  function cambiarPass($id){

    $('#id_user_pass').val($id);
    $('#mdlPassword').modal('show');

  }

  function cambiarPassOk(){

  $iduser = $('#id_user_pass').val();
  $pass   = $('#pass_modal').val();
  $pass2   = $('#pass2_modal').val();

  if($pass.length < 6){
    alert('Contraseña demasiado corta, minimo 6 caracteres');
    return false;
  }

  if($pass != $pass2){
    alert('Las contraseñas no coinciden');
    return false;
  }

    $.ajax({
    url: "../ajax/admin/cambiar_pass_usuario_admin.php",
    method: "POST",
    dataType: "JSON",
    data:{id:$iduser,pass:$pass2},
    beforeSend: function(){ 
    $('#mdlPassword').modal('hide');  
    $('.loading').css('display','block');},
    success: function(res){
      if(res.result){
        $('.loading').css('display','none');
        Swal.fire(
          'Correcto!',
          'La contraseña ha sido cambiada correctamente.',
          'success'
        )
      }else{
        $('.loading').css('display','none');
        alert(res.message);
      }
    }
  })

}

function cambiarActivoUsuario($id,$activo){

Swal.fire({
title: '¿Estas seguro que deseas cambiar el estado al usuario?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Si!'
}).then((result) => {
if (result.value) {

$.ajax({
  url: "../ajax/admin/cambiar_activo_usuario_admin.php",
  method: "POST",
  dataType: "JSON",
  data:{id:$id,activo:$activo},
  beforeSend: function(){ 
  $('.loading').css('display','block');},
  success: function(res){
    if(res.result){
      startTable();
      $('.loading').css('display','none');
      Swal.fire(
        'Correcto!',
        'El estado ha sido cambiado correctamente.',
        'success'
      )
    }else{
      $('.loading').css('display','none');
      alert(res.message);
    }
  }
})



}
})


}

  function eliminarUsuario($id){

    Swal.fire({
  title: '¿Estas seguro que deseas eliminar al usuario?',
  text: "Decisión irreversible!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si!'
}).then((result) => {
  if (result.value) {

    $.ajax({
      url: "../ajax/admin/eliminar_usuario_admin.php",
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
            'El usuario ha sido eliminado correctamente.',
            'success'
          )
        }else{
          $('.loading').css('display','none');
          alert(res.message);
        }
      }
    })


    
  }
})


  }

  function registrarUsuario(){

    $email = $('#email').val();
    $pass = $('#pass').val();
    $pass2 = $('#pass2').val();
    $nombre = $('#nombre').val();
    $fecha_vencimiento = $('#fecha_vencimiento').val();

    if(!validateEmail($email)){

      $('#email').addClass('is-invalid');
      alert('Contraseña inválida!');
      return false;

    }else{
      $('#email').removeClass('is-invalid');
      $('#email').addClass('is-valid');
    }

    if($pass.length < 6){
      alert('La contraseña debe tener al menos 6 caracteres');
      $('#pass').addClass('is-invalid');
      $('#pass2').addClass('is-invalid');
      return false;
    }

    if($pass != $pass2){

      alert('Las contraseñas no coinciden');
      $('#pass').addClass('is-invalid');
      $('#pass2').addClass('is-invalid');
      return false;
    }else{
      $('#pass').removeClass('is-invalid');
      $('#pass2').removeClass('is-invalid');
      $('#pass').addClass('is-valid');
      $('#pass2').addClass('is-valid');
    }

    if($fecha_vencimiento == ''){
      alert('Fencha de vencimiento');
      $('#fecha_vencimiento').addClass('is-invalid');
      return false
    }else{
      $('#fecha_vencimiento').addClass('is-valid');
    }

    $.ajax({
      url: "../ajax/admin/register_user.php",
      method: "POST",
      data: { email: $email,
              pass: $pass2,
              nombre: $nombre,
              fecha_vencimiento: $fecha_vencimiento},
      dataType: "JSON",
      beforeSend: function(){ 
      $('.loading').css('display','block');},
      success: function(res){
        if(res.result){
          $('.loading').css('display','none');
          alert(res.message);
          $("#email").val('');
          $("#pass").val('');
          $("#pass2").val('');
          $("#nombre").val('');
          $("#fecha_vencimiento").val('');
          $("#email").attr('class', 'form-control');
          $("#pass").attr('class', 'form-control');
          $("#pass2").attr('class', 'form-control');
          $("#nombre").attr('class', 'form-control');
          $("#fecha_vencimiento").attr('class', 'form-control');
          startTable();
        }else{
          if(res.emailerror){
            $('#email').addClass('is-invalid');
          }
          if(res.vencidoerror){
            $('#fecha_vencimiento').addClass('is-invalid');
          }
          $('.loading').css('display','none');
          alert(res.message);
        }
      }
    })


  }

  function startTable(){

    if ( ! $.fn.DataTable.isDataTable( '#TableTransacciones' ) ) {
              //cargamos la tabla
               table = $('#TableTransacciones').DataTable({
                  ajax : '../ajax/admin/listar_usuarios_admin.php',   
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

  $('#usuarios').addClass('active');

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