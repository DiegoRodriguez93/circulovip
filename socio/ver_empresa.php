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


<!-- MODAL CONFIRM DESCUENTOS-->
<div class="modal fade" id="rondaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="static" data-keyboard="false">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog  modal-top" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">Solicitar Ronda</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row p-2">

        <input type="hidden" id="idUserHidden">
        <label for="diasRondasSelect">Días de ronda:</label>
        <select class="form-control" name="diasRondasSelect" id="diasRondasSelect"></select>
        <label for="diasRondasSelect">Horario disponible:</label>
        <select class="form-control" name="horasRodasSelect" id="horasRodasSelect"></select>

        </div>

      </div>
      <div class="modal-footer text-center">
      <button type="button" onclick="insertarRonda()" id="solicitarRondaBtn" class="btn btn-indigo">Solicitar Ronda</button>
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

      function insertarRonda(){
        $id_emisor = localStorage.getItem('id_user');
        $id_receptor = $('#idUserHidden').val();
        $dia = $("#diasRondasSelect option:selected" ).text();
        $hora = $("#horasRodasSelect option:selected" ).val();
        $zona_horaria = localStorage.getItem('zona_horaria');

        $.ajax({
        type: "POST",
        data: {
          id_emisor : $id_emisor,
          id_receptor: $id_receptor,
          dia: $dia,
          hora: $hora,
          zona_horaria : $zona_horaria
        },
        url: "../ajax/socio/ver_empresa/insertarCita.php",
        dataType: "JSON",
        beforeSend: function (){
          $('#solicitarRondaBtn').addClass('disabled');
        },  
        success: function (res) {
          if(res.result){
            Swal.fire(
            'Correcto!',
            res.message,
            'success'
          );
          $('#rondaModal').modal('hide');
          }else{

            Swal.fire(
            'Error!',
            res.message,
            'error'
          );

          }

        },complete: function (){
          $('#solicitarRondaBtn').removeClass('disabled');
        }   });


      }

    function solicitarRonda($id_user){

      $.ajax({
        type: "GET",
        url: "../ajax/socio/ver_empresa/rellenarSelectRondas.php",
        dataType: "JSON",
        success: function (data) {
          var html = '';

          el = document.getElementById("diasRondasSelect");
          $.each(data, function (key, val) {

        html += `<option value="`+val.dia+`" >`+val.fecha+`</option>`;

      });

      el.innerHTML = html;

      /* DESPUÈS QUE CARGA EL DÌA YA RELLENA CON LOS HORARIOS DEL DÍA MÁS ARRIBA */

      $diaSeleccionado = $("#diasRondasSelect option:selected" ).val();

$.ajax({
  type: "POST",
  url: "../ajax/socio/ver_empresa/rellenarHorasSelect.php",
  data: {id_emisor: localStorage.getItem('id_user'),
  id_receptor: $('#idUserHidden').val(),
  zona_horaria_emisor:localStorage.getItem('zona_horaria'),
  dia_seleccionado : $diaSeleccionado
  },
  dataType: "JSON",
  success: function (data) {
    var html = '';
    
  $.each(data, function (key, val) {

    el = document.getElementById("horasRodasSelect");
    html += `<option value="`+val.hora+`">`+val.hora+` (`+val.zona_horaria+`) ⇒ Mi horario `+val.hora_mia+` (`+val.zona_horaria_mia+`)</option>`;
  
    el.innerHTML = html;
    
  });

  }

});

$('#horasRodasSelect').removeClass('disabled');

        }
      });

      $('#idUserHidden').val($id_user);



      $('#rondaModal').modal('show');

    }

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

     $('#horasRodasSelect').addClass('disabled');

     $('#diasRondasSelect').change(function () { 

      $diaSeleccionado = $("#diasRondasSelect option:selected" ).val();

       $.ajax({
         type: "POST",
         url: "../ajax/socio/ver_empresa/rellenarHorasSelect.php",
         data: {id_emisor: localStorage.getItem('id_user'),
         id_receptor: $('#idUserHidden').val(),
         zona_horaria_emisor:localStorage.getItem('zona_horaria'),
         dia_seleccionado : $diaSeleccionado
         },
         dataType: "JSON",
         success: function (data) {
            var html = '';
           
          $.each(data, function (key, val) {

           el = document.getElementById("horasRodasSelect");
           html += `<option val="`+val.hora+`">`+val.hora+` (`+val.zona_horaria+`) ⇒ Mi horario `+val.hora_mia+` (`+val.zona_horaria_mia+`)</option>`;
          
            el.innerHTML = html;
            
          });

          }
        
       });

      $('#horasRodasSelect').removeClass('disabled');


      });

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