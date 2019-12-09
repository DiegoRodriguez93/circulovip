 // Animations init
 new WOW().init();

 $(document).ready(function(){

   $id_user = localStorage.getItem("id_user");

   if ($id_user != null) {
     location.replace('socio/index.html');
     console.log('Usuario logeado!');
   } else {
     console.log('Necesita usar sesión!');
}

 });

 
async function iniciarSesion() {
     
     $cedula = $('#cedula').val();
     $pass = $('#pass').val();

     $cedulaOk = false;

     if($cedula.length < 8){
       Swal.fire({
             icon: 'error',
             title: 'Oops...',
             text: 'Cédula inválida',
           })
       return false;
     }

     if(!comprobarCI($cedula)){
       Swal.fire({
             icon: 'error',
             title: 'Oops...',
             text: 'Cédula incorrecta',
           })
       return false;
     }

     if($pass.length < 6){
       Swal.fire({
             icon: 'error',
             title: 'Oops...',
             text: 'Contraseña inválida',
           })
       return false;
     }

    await $.ajax({
       type: "POST",
       url: "https://vida-apps.com/vidapesos/ajax/chequearUsuario.php",
       data: {usuario:$cedula},
       dataType: "JSON",
       success: await function (res) {
         if(res.result){
           $cedulaOk = true;
         }else{
           alert(res.message);
           $cedulaOk = false;
         }
       }
     });

     if($cedulaOk){

       $.ajax({
       type: "POST",
       url: "https://vida-apps.com/vidapesos/ajax/login_user.php",
       data: {usuario:$cedula, pass:$pass},
       dataType: "JSON",
       success: function (res) {

         if(res.result){

           localStorage.setItem("id_user", res.id_user);
           /*$.session.set('id_user', res.id_user);*/
           location.replace('socio/index.html')
         }else{
           Swal.fire({
             icon: 'error',
             title: 'Oops...',
             text: res.message,
             footer: '<a href="password_recover.html">¿Olvidaste la contraseña?</a>'
           })
         }

       }
       
     });
     
     }



   }
