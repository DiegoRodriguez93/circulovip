    // Animations initialization
    new WOW().init();

        

        function changePassword(){
          $pass1 = $('#pass1').val();
          $pass2 = $('#pass2').val();
          $hash = localStorage.getItem("hash");
          $id_user = localStorage.getItem("id_user");

          if($pass1.length < 6){
            Swal.fire({
              icon: 'error',
              title: 'Oops!',
              text: 'Las contraseña debe tener al menos 6 caracteres',
            });
            return false;
          }

          if($pass1 != $pass2){
            Swal.fire({
              icon: 'error',
              title: 'Oops!',
              text: 'Las contraseñas no coinciden',
            });
            return false;
          }

          if($hash.length < 8){
            Swal.fire({
              icon: 'error',
              title: 'Oops!',
              text: 'Error de seguridad, intenté más tarde',
            });
            return false;
          }

          $.ajax({
            type: "POST",
            url: "https://vida-apps.com/vidapesos/ajax/reset_password.php",
            data: { pass1: $pass1, pass2: $pass2, hash: $hash, id_user: $id_user },
            dataType: "JSON",
            success: function(res){
              if(res.result){
                localStorage.setItem('activo',1);
                $('#changePassword').modal('hide');
                Swal.fire({
                  icon: 'success',
                  title: 'Felicidades!',
                  text: res.message,
                });

              }else{
                alert(res.message);
              }
            }

          })

        }

        //* FUNCIÓN PARA TREAR LA CONFIRMACIÓN DEL DESCUENTO

function confirmacionDeDescuento() {  

setInterval(function(){

$id_user = localStorage.getItem("id_user");

$.ajax({
  type: "POST",
  url: "https://vida-apps.com/vidapesos/ajax/chequear_transaccion_socio.php",
  data: { id_user: $id_user },
  dataType: "JSON",
  success: function (res) {
    if(res.result){
      //abrir modal
      displayConfirm(res.id_cupon);
    }else{

      console.log(res.message);

    }
  }
});

}, 10000  ); //cada 10 segundos

}

/* TRANSACCIÓN  SOCIO A SOCIO */

function chequear_transaccion_socio_socio() {  

  $.ajax({
    type: "POST",
    url: "https://vida-apps.com/vidapesos/ajax/chequear_transaccion_socio_socio.php",
    data: { id_user: $id_user },
    dataType: "JSON",
    success: function (res) {
      if(res.result){
        //abrir modal
        if(res.tipo == 1){
          Swal.fire({
              icon: 'success',
              title: 'Felicidades!',
              text: 'Has recibido una nueva transferencia de un comercio!',
            })
        }else{
          Swal.fire({
              icon: 'success',
              title: 'Felicidades!',
              text: 'Has recibido una nueva transferencia de otro socio!',
            })
        }
       /*  setTimeout(function(){ location.reload(); }, 3500); */
        
      }else{
  
        console.log(res.message);
  
      }
    }
  });

setInterval(function(){

$id_user = localStorage.getItem("id_user");

$.ajax({
  type: "POST",
  url: "https://vida-apps.com/vidapesos/ajax/chequear_transaccion_socio_socio.php",
  data: { id_user: $id_user },
  dataType: "JSON",
  success: function (res) {
    if(res.result){
      //abrir modal
      if(res.tipo == 1){
        Swal.fire({
            icon: 'success',
            title: 'Felicidades!',
            text: 'Has recibido una nueva transferencia de un comercio!',
          })
      }else{
        Swal.fire({
            icon: 'success',
            title: 'Felicidades!',
            text: 'Has recibido una nueva transferencia de otro socio!',
          })
      }
      setTimeout(function(){ location.reload(); }, 3500);
      
    }else{

      console.log(res.message);

    }
  }
});

}, 10000  ); //cada 10 segundos

}

function displayConfirm($id_cupon){
// primero armo el modal con los datos del cupón a confirmar
$.ajax({
  type: "POST",
  url: "https://vida-apps.com/vidapesos/ajax/rellenar_confirm_modal_socio.php",
  data: {id_cupon:$id_cupon},
  dataType: "JSON",
  success: function (res) {
    $('#modalTitle').html('Cupón '+res.codigo);
    $('#hidden_id_cupon').val(res.id_cupon);
    $('#commerce_name').html('<i class="fas fa-store"></i> '+res.commerce_name);
    $('#commerce_address').html('<i class="fas fa-map-marker-alt"></i> '+res.commerce_address);
    $('#commerce_phone').html('<i class="fas fa-phone"></i> '+res.commerce_phone);
    $('#fecha_vencimiento').html('<i class="fas fa-clock"></i> '+res.fecha_vencimiento);
    $('#descuento').html('<i class="fas fa-money-bill-wave"></i> Total a pagar = $'+res.descuento);
    
    // abro el modal
    $('#confirmModal').modal('show');
  }
});
}

  //* EVIAMOS DINERO A OTRO USUARIO
  function enviarDinero(){

$id_user = localStorage.getItem("id_user");
$cedula = $('#cedula').val();
$monto  = $('#monto').val();

if(!comprobarCI($cedula)){
  Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Cédula inválida',
            })
return false;
}

if($monto < 1){
  Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Transferencia mínima 1 vida peso',
            })
return false;
}

$.ajax({
type: "POST",
url: "https://vida-apps.com/vidapesos/ajax/enviar_dinero_a_otro_usuario_fn.php",
data: {id_user: $id_user, cedula : $cedula, monto: $monto},
dataType: "JSON",
beforeSend: function(){ 
$('.loading').css('display','block');},
success: function (res) {
  if(res.result){
    $('.loading').css('display','none');
    alert(res.message);
    $('#cedula').val('');
    $('#monto').val('');
    location.reload();
  }else{
    $('.loading').css('display','none');
    Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: res.message,
            })
  }
}
});

}




    $(document).ready(function() {

            /* INCLUDES */

            $('#sidebar_aqui').html(sidebar);

        /* NAVBUTTON */

        $('#menuToggle').on('click',function(){

$( "#sidebar" ).toggle("normal"); 


} );

      //* función para confirmar transacción
      $('#confirmarTransaccionBtn').on('click',function(){

        $id_cupon = $('#hidden_id_cupon').val();
        
         $.ajax({
           type: "POST",
           url: "https://vida-apps.com/vidapesos/ajax/confirmar_transaccion_socio_fn.php",
           data: {id_cupon : $id_cupon},
           dataType: "JSON",
           success: function (res) {
            $('#confirmModal').modal('hide');
    
            alert(res.message);
            location.reload();
           }
         });
      });

          //* función para cancelar transacción
          $('#cancelarTransaccionBtn').on('click',function(){

            $id_cupon = $('#hidden_id_cupon').val();

            $.ajax({
              type: "POST",
              url: "https://vida-apps.com/vidapesos/ajax/cancelar_transaccion_socio_fn.php",
              data: {id_cupon : $id_cupon},
              dataType: "JSON",
              success: function (res) {
                $('#confirmModal').modal('hide');

                alert(res.message);
                location.reload();
              }
            });
            });

            /* Login */

      $id_user = localStorage.getItem("id_user");
      $activo = localStorage.getItem("activo");


      if($activo == 2){
        $('#changePassword').modal('show');
      }

      if ($id_user != null) {
        console.log('Usuario logeado!');
      } else {

        location.replace('../index.html');

      }
       //* RELLENAMOS VENCIMIENTOS DE SALDO
/* 
      var url = "https://vida-apps.com/vidapesos/ajax/listar_vencimientos_socio.php?id_user="+$id_user;

      $.getJSON(url, function(vencimientos) {
        $.each(vencimientos, function(i, vencimiento) {

          var vencimientos_monto = vencimiento.monto;
        
          var vencimientos_fecha = vencimiento.fecha_vencimiento; 

          $(vencimientos_monto).appendTo("#vencimiento_monto");
           $(vencimientos_fecha).appendTo("#vencimiento_fecha"); 

        });
      });   */

  
      var url = "https://vida-apps.com/vidapesos/ajax/listar_vencimientos_socio.php?id_user="+$id_user;

      $.getJSON(url, function(vencimientos) {
      $.each(vencimientos, function(i, vencimientos) {
        var lista_de_vencimientos = `
        <div class="row">
          <div class="col-6">
           `+vencimientos.fecha_vencimiento+`
          </div>
          <div class="col-6">
              $`+vencimientos.monto+`
            </div>`;

        $(lista_de_vencimientos).appendTo("#vencimientos");
      });
      });

             //* RELLENAMOS COMERCIOS

      var url = "https://vida-apps.com/vidapesos/ajax/listar_comercios_socio.php";

      $.getJSON(url, function(comercios) {
        $.each(comercios, function(i, comercios) {
          var lista_de_comercios = `
        <p>` + comercios.name + `
      ` + comercios.address + `
      ` + comercios.phone + `</p>
      <hr>
        `;

          $(lista_de_comercios).appendTo("#comercios");
        });
      }); 

      


      //* RELLENAMOS ESTADO DE CUENTA

      $.ajax({
        type: "POST",
        url: "https://vida-apps.com/vidapesos/ajax/rellenar_estado_de_cuenta_usuarios.php?id_user=" + $id_user,
        data: {
          id_user: $id_user
        },
        dataType: "JSON",
        success: function(res) {
          if (res.result) {
            $('#dinero').html('$' + res.monto);
          } else {
            $('#dinero').html('No se pudo cargar');
          }


        }
      });

      $id_user = localStorage.getItem("id_user");

      $.ajax({
        type: "POST",
        url: "https://vida-apps.com/vidapesos/ajax/chequear_transaccion_socio.php",
        data: { id_user: $id_user },
        dataType: "JSON",
        success: function (res) {
          if(res.result){
            //abrir modal
            displayConfirm(res.id_cupon);
          }else{

            console.log(res.message);

          }
        }
      });

      confirmacionDeDescuento();//disparar función
      chequear_transaccion_socio_socio(); //disparar función

      $('#indexSidebar').addClass('active');
       
            $url = 'https://vida-apps.com/vidapesos/ajax/listar_transacciones_socio.php?id_user='+$id_user;
       
             $('#TablaT').DataTable({lengthMenu: [10],
                  ajax: $url ,
                  lengthChange: false,
                  order: [0,'desc'],
                  oLanguage: {
                      "sUrl": "../json/traducciontabla.json"
                  },responsive: true,    
                  columnDefs: [
                  { responsivePriority: 1, targets: 0 },
                  { responsivePriority: 2, targets: -1 }],
                  colReorder: true,
                  info: false });

                  $('#TablaT_next').css('color','#79153a!important');
       
    });