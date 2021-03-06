<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar usuarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <?php if($_SESSION['adiciona'] == 1){ ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar Usuario
                </button>
                <?php } ?>
            </div>
            <div class="box-body">
                <table style="width: 100%;" id="tablaUsuarios" class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           
                            
                            $item = null;
                            $valor = null;
                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                            

                            foreach ($usuarios as $key => $value) {
                                echo ' 
                                <tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$value['usuarios_nombres_v'].'</td>
                                    <td>'.$value['usuarios_email_v'].'</td>';

                               if($value['usuarios_foto'] != ''){
                                    echo '
                                    <td>
                                        <img src="'.$value['usuarios_foto'].'" class="img-thumbail img-circle" width="40px">
                                    </td>';
                                }else{
                                    echo '
                                    <td>
                                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbail" width="40px">
                                    </td>';
                                }

                                echo' </td>
                                    <td>'.$value['perfiles_descripcion_v'].'</td>';

                                if($value['usuarios_estado_i'] == 1){
                                    echo '<td>
                                            <button class="btn btn-success btn-xs btnActivar " idUsuario="'.$value['usuarios_id_i'].'" estado="0">
                                                Activado
                                            </button>
                                        </td>';
                                }else{
                                    echo '<td>
                                            <button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value['usuarios_id_i'].'" estado="1">
                                                Desactivado
                                            </button>
                                        </td>';
                                }

                                echo '<td>
                                        '.$value['usuarios_ultimo_login'].'   
                                    </td>';
                                    echo '
                                    <td style="text-align:center;">';

                                    if($_SESSION['edita'] == 1){
                                        echo '<button data-toggle="modal" data-target="#modalEditarUsuarios" class="btn btn-warning btn-sm btnEditarUsuarios" title ="Editar Usuarios" idUsuario ="'.$value['usuarios_id_i'].'">
                                                    <i class="fa fa-edit"></i>
                                                </button>';
                                    }

                                    if($_SESSION['elimina'] == 1){
                                        echo '&nbsp;<button title="Eliminar Usuarios" class="btn btn-danger btn-sm btnEiminarUsuarios" idUsuario ="'.$value['usuarios_id_i'].'">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>';
                                    }

                                echo '  
                                    </td>
                                </tr>'; 
                
                            }

                        ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>      
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal agregar usuario -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input class="form-control input-lg" type="text" name="NuevoNombre" placeholder="Ingresar nombre" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input class="form-control input-lg" type="email" name="NuevoCorreo" placeholder="Ingresar Correo" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input class="form-control input-lg" type="password" name="NuevoPassword" placeholder="Ingresar contraseña" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <select class="form-control input-lg" name="NuevoPerfil">
                                    <?php
                                       $Perfils = ControladorPerfiles::ctrMostrarPerfiles(NULL, NULL);
                                        foreach ($Perfils as $key => $value) {
                                            echo "<option value='".$value['perfiles_id_i']."'>".$value['perfiles_descripcion_v']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="panel">
                                <input type="file" class="NuevaFotos" name="NuevaFoto">
                                <p class="help-block">
                                    Peso máximo de la foto 200 MB
                                </p>
                                <img src="vistas/img/usuarios/default/anonymous.png" width="100px" class="img-thumbnail previsualizar pull-right">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
                <?php
                    $crearUsuario = new ControladorUsuarios();
                    $crearUsuario->ctrCrearUsuario();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->


<!-- Modal agregar usuario -->
<div id="modalEditarUsuarios" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input class="form-control input-lg" type="text" name="EditarNombre"  id="EditarNombre" placeholder="Ingresar nombre" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input class="form-control input-lg" type="email" name="EditarCorreo" id="EditarCorreo" placeholder="Ingresar Correo" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input class="form-control input-lg" type="password" name="EditarPassword"  id="EditarPassword" placeholder="Ingresar contraseña" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <select class="form-control input-lg" name="EditarPerfil" id="EditarPerfil">
                                    <?php
                                        $Perfils = ControladorPerfiles::ctrMostrarPerfiles(NULL, NULL);
                                        foreach ($Perfils as $key => $value) {
                                            echo "<option value='".$value['perfiles_id_i']."'>".$value['perfiles_descripcion_v']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="panel">
                                <input type="file"  name="EditarFoto" class="NuevaFotos">
                                <p class="help-block">
                                    Peso máximo de la foto 200 MB
                                </p>
                                <img src="vistas/img/usuarios/default/anonymous.png" width="100px" class="img-thumbnail previsualizar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <input type="hidden" name="passwordActual" id="passwordActual">
                    <input type="hidden" name="fotoActual" id="fotoActual">
                    <input type="hidden" name="EditarUserID" id="EditarUserID">
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
                <?php
                    $crearUsuario = new ControladorUsuarios();
                    $crearUsuario->ctrEditarUsuario();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->

<?php
    $crearUsuario = new ControladorUsuarios();
    $crearUsuario->ctrBorrarUsuario();
?>