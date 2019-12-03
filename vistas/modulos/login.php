<div id="back"></div>
<div class="login-box">
    <div class="login-logo">
       <span class="texto">&nbsp;</span>
       <img src="vistas/img/plantilla/Logo_de_aviso.png"  style="width: 100%;" />
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Ingreso al sistema</p>
        <form method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" required="true" name="ingUsuario" placeholder="Correo">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="ingPassword" required="true"  placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 pull-right">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <!--<a href="ingreso-pacientes" class="text-success">Olvidaste la clave?</a>-->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php 
                        $login = new ControladorUsuarios();
                        $login->ctrIngresoUsuario();
                    ?>
                </div>
            </div>

        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
