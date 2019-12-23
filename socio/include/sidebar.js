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

          <!--    <a href="lista_comercios.html" id="listaSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-store-alt mr-3"></i>Lista de comercios
          </a> -->
<!--   
          <a href="preferencias.php" id="preferenciasSidebar" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-cogs mr-3"></i>Preferencias</a> -->
  
          <button onclick="cerrarSession()" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-sign-out-alt mr-3"></i>Cerrar sesión</a>
        </div>
  
      </div>
      <!-- Sidebar -->`