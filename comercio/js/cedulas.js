   // Animations initialization
   new WOW().init();

   function transferir($cedula,$nombre){
     $('#nombre_transferido').html('Nombre: '+$nombre);
     $('#cedula_transferido').html('Cédula: '+$cedula);
     $('#cedula_hidden').val($cedula);
    $('#mdlTransferir').modal('show');
   }

   function eliminar($id){

     var r = confirm("¿Esta seguro que desea eliminar el acceso directo a la transferencia?");
     if (r == true) {

       $.ajax({
       type: "POST",
       url: "https://vida-apps.com/vidapesos/ajax/eliminar_cedula.php",
       data: {id_cedula: $id},
       dataType: "JSON",
       success: function (res) {
         if(res.result){
             alert(res.message);
             location.reload();
         }else{
             alert(res.message);
         }
       },error: function () {
         alert('Ha ocurrido un error, intenté más tarde');
         }
     });


     }else{
       return false;
     } 

   }



 function ingresarCedula(){

  $cedula = $('#cedula').val();
  $name = $('#name').val();

  if(!comprobarCI($cedula)){
    alert('Cedula inválida');
    return false;
  }

  $.ajax({
    type: "POST",
    url: "https://vida-apps.com/vidapesos/ajax/ingresar_cedula.php",
    data: {id_comercio: $id_comercio, name: $name, cedula:$cedula},
    dataType: "JSON",
    success: function (res) {
      if(res.result){
         alert(res.message);
         location.reload();
      }else{
         alert(res.message);
      }
    },error: function () {
      alert('Ha ocurrido un error, intenté más tarde');
      }
  });



 }

 function estadoDeCuenta(){
  $.ajax({
    type: "GET",
    url: "https://vida-apps.com/vidapesos/ajax/rellenar_estado_de_cuenta_comercios.php?id_comercio="+$id_comercio,
    dataType: "JSON",
    success: function (res) {
      if(res.result){
      
        $('#estado_de_cuenta').html('$'+res.monto);

      }else{
        alert(res.message);
      }
    }
  });

 }

   $(document).ready(function(){

       /* INCLUDES */

       $('#sidebar_aqui').html(sidebar);      
       $('#modal_aqui').html(modal);      

               /* NAVBUTTON */

               $('#menuToggle').on('click',function(){

               $( "#sidebar" ).toggle("normal"); 


               } );

     $('#cedulaSidebar').addClass('active');

     $id_comercio = $.session.get('id_comercio');

     if($id_comercio != null ){
       console.log('Comercio logeado!');
     }else{

       $('#modalLogin').modal('show');
       $("#sidebar").css({"opacity": "0.6"});
     }

     //* TRANSFERIR BUTTON
   $('#transferirBtn').on('click',function () {  

     $id_comercio = $.session.get('id_comercio');
     $monto  = $('#monto').val();
     $cedula = $('#cedula_hidden').val();

     if($cedula == '' ){
       alert('Ha ocurrido un error, intenté más tarde!');
       return false;
     }

     if($monto == '' ){
       alert('Debes ingresar un monto a transferir');
       return false;
     }

     if($monto < 1 ){
       alert('El monto debe ser de un mínimo de 1 peso');
       return false;
     }


     $.ajax({
       type: "POST",
       url: "https://vida-apps.com/vidapesos/ajax/transferir_comercio.php",
       data: {cedula:$cedula,
       monto:$monto,
       id_comercio:$id_comercio},
       dataType: "JSON",
       beforeSend:function () {
        $('.loading').css('display','block');
       },
       success: function (res) {
         if(res.result){
          $('.loading').css('display','none');
          estadoDeCuenta();
           alert(res.message);
           $('#monto').val('');
           $('#mdlTransferir').modal('hide');

         }else{
          $('.loading').css('display','none');
           alert(res.message);
         }
       }
     });


   });


           $('#TablaC').DataTable({lengthMenu: [10],
           ajax: 'https://vida-apps.com/vidapesos/ajax/listar_cedulas.php?id_comercio='+$id_comercio,
           lengthChange: false,
           order: [1,'desc'],
           oLanguage: {
               "sUrl": "../json/traducciontabla.json"
           },responsive: true, colReorder: true, info: false }); 

           $('#TablaT_next').css('color','#79153a!important');


           estadoDeCuenta(); // disparo función
  
   });
