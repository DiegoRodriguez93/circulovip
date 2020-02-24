   let sidebar = `
   <!-- Sidebar -->
    <div id="sidebar" class="sidebar-fixed position-fixed">

        <a class="pl-3 py-3 waves-effect">
          <img src="../images/logo.png" class="img-fluid" alt=""><span style="font-size:1.5em;"></span>
        </a>
  
        <div class="list-group list-group-flush">
          <a href="index.html" id="indexSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-chart-pie mr-3"></i>Inicio
          </a>

          <div class="list-group list-group-flush">
          <a href="mi_perfil.html" id="perfilSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-user mr-3"></i>Mi Perfil
          </a>

          <div class="list-group list-group-flush">
          <a href="ver_empresas.html" id="empresasSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-building mr-3"></i>Ver Empresas
          </a>

          <div class="list-group list-group-flush">
          <a href="mis_horarios.html" id="horariosSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-user-clock mr-3"></i>Mis horarios
          </a>

          
          <div class="list-group list-group-flush">
          <a href="mis_productos.html" id="productosSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-store-alt mr-3"></i>Mis Productos
          </a>

          <div class="list-group list-group-flush">
          <a href="mensajes.html" id="mensajesSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-envelope mr-3"></i>Mensajes
          </a>

          <div class="list-group list-group-flush">
          <a href="sala_de_espera.html" id="salaDeEspera" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-users mr-3"></i>Sala de espera
          </a>

          <!--
           <div class="list-group list-group-flush">
          <a href="webinar.html" id="webinarSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-video mr-3"></i>Webinars
          </a> 

          <div class="list-group list-group-flush">
          <a href="ronda.html" id="rondaSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-video mr-3"></i>videotest
          </a> 

            <a href="lista_comercios.html" id="listaSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-store-alt mr-3"></i>Lista de comercios
          </a> -->
<!--   
          <a href="preferencias.php" id="preferenciasSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-cogs mr-3"></i>Preferencias</a> -->
  
          <button onclick="cerrarSession()" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-sign-out-alt mr-3"></i>Cerrar sesión</a>
        </div>
  
      </div>
      <!-- Sidebar -->`;

      function checkLogIn(){
        if(localStorage.getItem('id_user') == null || localStorage.getItem('token') == null){
          Swal.fire('Inicia sesión',
          'Primero debés iniciar sesión',
          'error');
          setTimeout(() => {location.replace('../index.html')},3000);
        }
        setInterval(() => {
          $.ajax({
            type: "POST",
            url: "../ajax/socio/security/checkExpiration.php",
            data: {id_user:localStorage.getItem('id_user'), token: localStorage.getItem('token')},
            dataType: "JSON",
            success: function (res) {
              if(res.result){
                console.log(res.message);
              }else{
                Swal.fire('Error!',res.message,'error');
                localStorage.clear();
                setTimeout(()=>{location.replace('../index.html')},3000);
              }
            }
          });
        }, 30000);

      }