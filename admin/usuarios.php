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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div style="display:none" class="loading"></div>

              <?php include 'include/navbar.php'; ?>

            <table id="TableTransacciones" class="display table text-center" style="width: 100%">
        <thead>
            <tr>
        <th>Id_Usuario</th>
        <th>Fecha de registro</th>
        <th>Email</th>
        <th>Contraseña</th>
        <th>Activo</th>
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

  
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" id="email">

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

    $.ajax({
      url: "../ajax/admin/register_user.php",
      method: "POST",
      data: {email: $email, pass: $pass2},
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
          $("#email").attr('class', 'form-control');
          $("#pass").attr('class', 'form-control');
          $("#pass2").attr('class', 'form-control');
          startTable();
        }else{
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
                  order: [1,'desc'],
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