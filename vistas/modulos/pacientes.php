
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pacientes
            <small>Listado de pacientes registrados en el sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Pacientes</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    
                </h3>
                <div class="box-tools pull-right">
                    <?php if($_SESSION['adiciona'] == 1){ ?>
                    <button class="btn btn-primary" id="btnNuevoPaciente" data-toggle="modal" title="Ingresar Paciente" data-target="#modalAgregarPaciente">
                        <i class="fa fa-plus"></i>
                    </button>
                    <!--<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAgregarPacientes">
                        Agregar Pacientes Masivamente
                    </button>-->
                    <?php } ?>
                    <a class="btn btn-primary" href="index.php?exportar=pacientes" title="Exportar datos a Excel">
                        <i class="fa fa-file-excel-o"></i>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table style="width:100%;" id="tablaPacientes" class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th style="width: 15%;">Teléfono</th>
                            <th>Ocupación</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $campos = "pacientes_id_i, CONCAT(pacientes_nombres_v,' ',pacientes_apellidos_v) as nombre,pacientes_tipo_doc_v, pacientes_documento_v, pacientes_telefono_v, TIMESTAMPDIFF(YEAR,pacientes_fecha_nacimiento_d,CURDATE()) as fecha_nacimiento, pacientes_documento_v, pacientes_ocupacion_v";
                            $tablas = 'op_historias LEFT JOIN op_pacientes ON pacientes_id_i = historias_paciente_id_i LEFT JOIN sys_usuarios ON historias_optometra_v = usuarios_id_i';
                            $condiciones = '1 = 1';
                            $historias = ModeloDao::mdlMostrar($campos, $tablas, $condiciones);
                            foreach ($historias as $key => $value) {
                                echo '  <tr>
                                            <td>
                                                '.$value['pacientes_id_i'].'
                                            </td>
                                            <td>
                                                '.$value['nombre'].'
                                            </td>';
                                    switch ($value['pacientes_tipo_doc_v']) {
                                        case "C.C":
                                            echo '
                                                <td>
                                                    Cédula de ciudadania
                                                </td>';
                                        break;

                                        case 'C.E':
                                            echo '
                                                <td>
                                                    Cédula de extranjería
                                                </td>';
                                        break;

                                        case 'R.C':
                                            echo '
                                                <td>
                                                    Registro civil
                                                </td>';
                                        break;

                                        case 'T.I':
                                            echo '
                                                <td>
                                                    Tarjeta de identidad
                                                </td>';
                                        break;

                                        case 'OTRO':
                                            echo '
                                                <td>
                                                    Otro
                                                </td>';
                                        break;

                                        default:
                                            echo '
                                                <td>
                                                    No definido
                                                </td>';
                                    }
                                    echo '  <tr>
                                            <td>
                                                '.$value['pacientes_documento_v'].'
                                            </td>
                                            <td>
                                                '.$value['pacientes_telefono_v'].'
                                            </td>
                                            <td>
                                                '.$value['pacientes_ocupacion_v'].'
                                            </td>
                                            <td>
                                                '.$value['fecha_nacimiento'].'
                                            </td>';
                                    echo '   <td>
                                                <button class="btn btn-warning btnEditarPaciente" title="Editar Paciente" id_Paciente="'.$value['pacientes_id_i'].'" data-toggle="modal" data-target="#modalEditarPaciente">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btnEliminarPaciente" title="Eliminar Paciente" id_Paciente="'.$value['pacientes_id_i'].'" codigo imagen>
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>';
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th style="width: 15%;">Teléfono</th>
                            <th>Ocupación</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>     
            </div>
        </div>
    </section>
</div>

<!-- Modal agregar usuario -->
<div id="modalAgregarPaciente" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Paciente</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Documento</label>
                                <select class="form-control" name="NuevoTipoDoc">
                                    <option value="C.C">Cédula de ciudadanía</option>
                                    <option value="C.E">Cédula de extranjería</option>
                                    <option value="R.C">Registro civil</option>
                                    <option value="T.I">Tarjeta de identidad</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Documento</label>
                                <input class="form-control" maxlength="15" name="NuevoDocumento" id="NuevoDocumento"  required="" placeholder="Documento">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input class="form-control" name="NuevoNombre" required placeholder="Nombres">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" name="NuevoApellido" required placeholder="Apellidos">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lugar de residencia</label>
                                <input class="form-control" name="NuevoLugarResidencia" placeholder="Lugar de residencia">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input class="form-control" name="NuevoDireccion" placeholder="Dirección">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input class="form-control" name="NuevoTelefono" required placeholder="Teléfono">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ocupación</label>
                                <input class="form-control" name="NuevoOcupacion" placeholder="Ocupación">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Genero</label>
                                <select class="form-control" name="NuevoGenero" placeholder="Genero">
                                    <option value="0">Seleccione</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha Nacimiento</label>
                                <input class="form-control" name="NuevoFechaNac" id="NuevoFechaNac"  required placeholder="YYYY-MM-DD">
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <select class="form-control" name="NuevoEstadoCivil" placeholder="Estado Civil">
                                    <option value="0">Seleccione</option>
                                    <option value="Soltero">Soltero(a)</option>
                                    <option value="Casado">Casado(a)</option>
                                    <option value="UnionLibre">Unión Libre</option>
                                    <option value="Separado">Separado(a)</option>
                                    <option value="Viudo">Viudo(a)</option>
                                    <option value="Otro">Otro(a)</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
                </div>
                <?php
                    $crearUsuario = new ControladorPacientes();
                    $crearUsuario->ctrCrearPacientes();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->

<!-- Modal Editar usuario -->
<div id="modalEditarPaciente" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Paciente</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Documento</label>
                                <select class="form-control" name="EditarTipoDoc" id="EditarTipoDoc">
                                    <option value="C.C">Cédula de ciudadanía</option>
                                    <option value="C.E">Cédula de extranjería</option>
                                    <option value="R.C">Registro civil</option>
                                    <option value="T.I">Tarjeta de identidad</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Documento</label>
                                <input class="form-control" maxlength="15" name="EditarDocumento"  required id="EditarDocumento" placeholder="Documento">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input class="form-control" name="EditarNombre" id="EditarNombre" required placeholder="Nombres">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" name="EditarApellido"  id="EditarApellido" required placeholder="Apellidos">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lugar de residencia</label>
                                <input class="form-control" name="EditarLugarResidencia" id="EditarLugarResidencia" placeholder="Lugar de residencia">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input class="form-control" name="EditarDireccion" id="EditarDireccion" placeholder="Dirección">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input class="form-control" name="EditarTelefono" required id="EditarTelefono" placeholder="Teléfono">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ocupación</label>
                                <input class="form-control" name="EditarOcupacion" id="EditarOcupacion" placeholder="Ocupación">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Genero</label>
                                <select class="form-control" name="EditarGenero" id="EditarGenero" placeholder="Genero">
                                    <option value="0">Seleccione</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha Nacimiento</label>
                                <input class="form-control" name="EditarFechaNac" required id="EditarFechaNac"  placeholder="YYYY-MM-DD">
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <select class="form-control" name="EditarEstadoCivil" id="EditarEstadoCivil" placeholder="Estado Civil">
                                    <option value="0">Seleccione</option>
                                    <option value="Soltero">Soltero(a)</option>
                                    <option value="Casado">Casado(a)</option>
                                    <option value="UnionLibre">Unión Libre</option>
                                    <option value="Separado">Separado(a)</option>
                                    <option value="Viudo">Viudo(a)</option>
                                    <option value="Otro">Otro(a)</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="EditarPacientes_id_i" id="EditarPacientes_id_i" value=""> 
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
                </div>
                <?php
                    $crearUsuario = new ControladorPacientes();
                    $crearUsuario->ctrEditarPacientes();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->

<?php 
    $crearPaciente = new ControladorPacientes();
    $crearPaciente->ctrBorrarPacientes();
?>