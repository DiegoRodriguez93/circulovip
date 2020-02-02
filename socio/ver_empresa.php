<?php 

/* $id_empresa = $_GET['id_empresa'];

if(!isset($id_empresa) OR $id_empresa == null OR $id_empresa == ''){
  header('Location: ver_empresas.html');
} */

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>Circulo Vip</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/loader.css">
  <link href="../css/estilosmenu.css" rel="stylesheet">
</head><body>

<!-- MODAL CONTACT-->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="static" data-keyboard="false">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog  modal-top" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="contactModalTitle">Enviar mensaje</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <input type="hidden" id="id_user_receptor" >

        <label for="mensajeContactModal">Mensaje</label>
        <textarea id="mensajeContactModal" maxlength="250" class="form-control"></textarea>
    

      <div class="modal-footer text-center mx-auto">
        <button type="button" onclick="enviarMensaje()" class="btn btn-indigo">Enviar mensaje </button>
        <button type="button" class="btn btn-blue-grey" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- MODAL CONTACT-->

<!-- MODAL CONFIRM TRANSACCIÓN-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="static" data-keyboard="false">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog  modal-top" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="modalTitle"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="hidden_id_cupon">
        <h3>Datos del comercio:</h3>
        <h4 id="commerce_name"></h4>
        <h4 id="commerce_address"></h4>
        <h4 id="commerce_phone"></h4>
        <hr>
        <h4 id="fecha_vencimiento"></h4>
        <h4 id="descuento"></h4>
      </div>
      <div class="modal-footer text-center mx-auto">
        <button type="button" id="confirmarTransaccionBtn" class="btn btn-indigo">Confirmar</button>
        <button type="button" id="cancelarTransaccionBtn" class="btn btn-blue-grey" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL CONFIRM TRANSACCIÓN-->

<!-- MODAL CONFIRM DESCUENTOS-->
<div class="modal fade" id="mdlVencimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="static" data-keyboard="false">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog  modal-top" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">Vencimientos del saldo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6"><b>Fecha</b></div>
          <div class="col-6"><b>Monto</b></div>
        </div>
          <div id="vencimientos"></div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-blue-grey" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL CONFIRM DESCUENTOS-->


<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->

      <div class="container-fluid">

        <!-- Brand -->


        <div id="menuToggle" >

          <input type="checkbox">
          <span></span>
          <span></span>
          <span></span>
        </div>

      </div>
 
    <!-- Navbar -->

    <!-- SIDEBAR AQUI -->

<div id="sidebar_aqui"></div>


  </header>
  <!--Main Navigation-->

  <div style="background-image: url('../images/back1.jpg');position:fixed;height: 250px;width: 100%;display: none;"></div>
  <!--Main layout-->
  <main class="pt-3 mx-lg-5">
    <div class="container-fluid mt-5" style="min-height: 480px">

    
      <div class="row wow fadeIn">

        <div style="display:none" class="loading"></div>

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

              <h4 id="nombreEmpresa" class="card-header">
              </h4>

              </div>

              
          </div>        

   <!--        <div class="card my-3"> -->

    <div class="col-md-12 mb-4">

            <div id="empresaContainer" class="row wow fadeIn my-3">

              <div style="display:none" class="loading"></div>
              
    
        </div>
   <!--      </div> -->
      



          <!--/.Card-->
          <div class="mb-5"></div>

        <!--Grid column-->

        
      </div>
      </div>
      <!--Grid row-->


    </div>
    <div class="mb-5"></div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small deep-purple darken-1 mt-4 wow fadeIn" style="
bottom: 0;position: fixed;width: 100%;
">

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2020 Copyright
      <a href="https://circulovip.com" target="_blank"> Circulo Vip Empresarial </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <div id="modal_aqui"></div>

  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../lib/helper.js"></script>
  <script src="js/cerrar_session.js"></script>
  <script src="include/sidebar.js"></script>


  <script>
    function abrirModalMensaje($id_user_receptor, $nombre, $pais){

      $('#id_user_receptor').val($id_user_receptor);

      $('#contactModalTitle').html('Enviar mensaje a '+$nombre+'('+$pais+')');

      $('#contactModal').modal('show');


    }

    function enviarMensaje(){

      $mensaje = $('#mensajeContactModal').val();
      $id_user_receptor = $('#id_user_receptor').val();

      $.ajax({
        type: "POST",
        url: "../ajax/socio/ver_empresa/enviarMensaje.php",
        data: {id_user_emisor: localStorage.getItem('id_user'),
        id_user_receptor: $id_user_receptor,
        mensaje: $mensaje},
        dataType: "JSON",
        success: function (res) {
          if(res.result){
            $('#contactModal').modal('hide');
          $('#id_user_receptor').val('');
          $('#mensajeContactModal').val('');
          Swal.fire(
            'Correcto!',
            'Mensaje enviado correctamente!',
            'success'
          );
          }else{
            Swal.fire(
            'Error!',
            res.message,
            'error'
          );
          }

        }
      });

    }

    function listarEmpresa(){

       $id_empresa = <?= $_GET['id_empresa']; ?>;

      $.ajax({
        type: "POST",
        url: "../ajax/socio/ver_empresa/listarEmpresa.php",
        data: {id_empresa : $id_empresa},
        dataType: "JSON "
        ,beforeSend: function(){
          $('.loading').css('display','block');
        },
        success: function (data) {
          var html = '',
      el = document.getElementById("empresaContainer");
      $.each(data, function (key, val) {

        html += `
              <div class="col-lg-4 sm-12 my-1">
                <div class="card">
                <div class="row">

                  <div class="col-12 pt-2 text-center">
                    <img 
                    src="`+val.url_avatar+`"
                     class="img-fluid rounded-circle" 
                     style="max-height: 140px;"
                     alt="">
                  </div>
                  <div class="col-12 text-center my-auto">
                    <b style="font-size: 1.3em;">`+val.nombre+`</b>(`+val.pais+`)
                    <p>`+val.cargo+`</p>
                  </div>
                  <div class="col-12 text-center">
                    <button onclick="abrirModalMensaje('`+val.id_user+`','`+val.nombre+`','`+val.pais+`')" class="btn btn-indigo btn-sm">Enviar Mensaje</button>
                    <button onclick="solicitarRonda('`+val.id_user+`')" class="btn btn-danger btn-sm">Solicitar Ronda</button>
                  </div>
                </div>
              </div></div>
              `;


      });

      el.innerHTML = html;
        },complete: function () {
          $('.loading').css('display','none');
        }
      });


    }

    $(document).ready(function(){

            /* INCLUDES */

  $('#sidebar_aqui').html(sidebar);

  /* NAVBUTTON */

  $('#menuToggle').on('click',function(){

  $( "#sidebar" ).toggle("normal"); 


  });

    // Animations initialization
    new WOW().init();

     listarEmpresa(); 

 /*    if($nombre != null && $nombre.length > 1 && $id_user != null && $id_user.length > 0 &&
    $token != null && $token.length == 32){
      location.replace('socio/index.html');
    }else{
      console.log('usuario no logeado');
    } */
    });

  
  </script>

</body>

</html>