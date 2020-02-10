
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
                        <input type="hidden" value="<?php echo $_SESSION['edita']; ?>" id="editar"> 
                        <input type="hidden" value="<?php echo $_SESSION['elimina']; ?>" id="elimina">
                </h3>
                <div class="box-tools pull-right">
                    <button data-toggle="modal" data-target="#modalAgregarMasivo" class="btn btn-success btnAgregarMasivo" title ="Agregar pacientes mediante excel">
                        <i class="fa fa-save"></i>
                    </button>
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
                <table style="width:100%;" id="tablaPacientes" class="table table-bordered table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Tipo Doc.</th>
                            <th>Numero de Documento</th>
                            <th style="width: 15%;">Teléfono</th>
                            <th>Ocupación</th>
                            <th>Edad</th>
                            <th style="width: 62px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Tipo Doc.</th>
                            <th>Numero Documento</th>
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
                                <label>Numero Documento</label>
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
                                <label>Numero Documento</label>
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
<!-- Modal agregar opciones masivo -->
<div id="modalAgregarMasivo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" id="formCarguePacientes">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar opciones por excel</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                              <label for="CargueExcel">Archivo excel a cargar</label>
                              <input type="file" name="CargueExcelPacientes" id="CargueExcelPacientes">
                              <p class="help-block">Peso maximo del archivo 100 MB</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <label>Observaciones:</label><br>
                    * Las columnas en el excel deben estar organizadas de la siguiente manera (Tipo documento, Documento, Nombres, Apellidos,Estado Civil,Fecha Nacimiento,Sexo,Ocupacion,Residencia,Direccion,Telefono). 
                    <br>
                    * Opciones para tipo de documento (C.C, C.E, R.C, T.I, OTRO).
                    <br>
                    * Opciones para genero (Femenino y Masculino).
                    <br>
                    * Opciones para estado civil (Soltero, Casado, UnionLibre, Separado, Viudo, Otro).
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <a type="button" class="btn btn-success" id="BtnCarguePacientes" href="Modelo_cargar_pacientes_optica.xlsx">Descargar Plantilla</a>
                    <button type="button" class="btn btn-primary" id="BtnCarguePacientes">Cargar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->

<?php 
    $crearPaciente = new ControladorPacientes();
    $crearPaciente->ctrBorrarPacientes();
?>