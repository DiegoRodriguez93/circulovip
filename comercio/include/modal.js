         let modal = `        <!--Modal Form Login -->
                <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                  <!--Content-->
                  <div class="modal-content">

                    <!--Body-->
                    <div class="modal-body text-center mb-1">

                      <h3 class="mt-1 mb-2">Iniciar sesión Comercio</h3>
                      <hr>

                      <div class="md-form">
                      <i class="fas fa-envelope prefix violet-text active" style="float: left!important;left:0;"></i>
                      <input type="email" id="email" class="violet-text form-control">
                      <label for="email" class="active">Tú Email</label>
                    </div>

                    <div class="md-form">
                      <i class="fas fa-lock prefix violet-text active" style="float: left!important;left:0;"></i>
                      <input type="password" id="password" class="violet-text form-control">
                      <label for="pass">Tú contraseña</label>
                    </div>


                      <div class="text-center mt-4">
                        <button onclick="loginComercio()" class="btn btn-indigo">Ingresar
                          <i class="fas fa-sign-in-alt ml-1"></i>
                        </button>
                      </div>
                      <a href="../">Salir</a>
                    </div>

                  </div>
                  <!--/.Content-->
                </div>
              </div>
              <!--Modal Form Login-->
`;