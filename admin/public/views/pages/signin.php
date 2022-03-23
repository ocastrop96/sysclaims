<div class="login-page">
    <div class="login-box">
        <div class="card card-outline card-gray">
            <div class="login-logo">
                <img src="public/views/resources/img/qs-logo.png" class="img-responsive" style="padding:10px 50px 0px 50px">
            </div>
            <div class="card-body">
                <p class="login-box-msg font-weight-bold h5 text-secondary">Sistema de Atención al Usuario Virtual - HNSEB <br><span class="font-italic h6">v.2021.08.01</span></p>
                <form action="" method="post" id="frmLoginQS">
                    <div id="mensajeLogQS" class="d-none">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> ¡ATENCIÓN!</h5>
                            El usuario ingresado no existe.
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-user-lock"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Ingrese usuario" id="usuarioLogQS" name="usuarioLogQS" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Ingrese contraseña" id="usuarioPassQS" name="usuarioPassQS" required autocomplete="off" minlength="8" maxlength="8">
                    </div>
                    <div class="row">
                        <div class="col-8 ml-5">
                            <button type="submit" class="btn btn-secondary btn-block btn-flat rounded" id="btnLoginQS"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                        </div>
                    </div>
                    <?php
                    $login = new UsuariosControlador();
                    $login->ctrLoginUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>