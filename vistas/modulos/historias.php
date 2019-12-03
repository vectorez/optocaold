
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Historial
            <small>historias clínicas de pacientes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Historias</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    
                </h3>
                <div class="box-tools pull-right">
                    <?php if($_SESSION['adiciona'] == 1){ ?>
                    <button class="btn btn-primary" id="btnNuevohistorico" data-toggle="modal" title="Ingresar Historia" data-target="#modalAgregarHistoria">
                        <i class="fa fa-plus"></i>
                    </button>
                    <!--<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAgregarPacientes">
                        Agregar Pacientes Masivamente
                    </button>-->
                    <?php } ?>
                    <a style="display: none;" class="btn btn-primary" href="" id="imprimirHistoria" title="Exportar datos a Excel">
                        <i class="fa fa-file-excel-o"></i>
                    </a>
                </div>
                
                <input type="hidden" id="editar" value="<?php echo $_SESSION['edita'];?>">
                <input type="hidden" id="elimina" value="<?php echo $_SESSION['elimina'];?>">
                <input type="hidden" id="notas" value="<?php echo $_SESSION['notas'];?>">
            </div>
            <div class="box-body">
                <table style="width:100%;" id="tablaHistorias" class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Paciente</th>
                            <th>Documento</th>
                            <th style="width: 15%;">Teléfono</th>
                            <th>Edad</th>
                            <th>Fecha</th>
                            <th>Historia #</th>
                            <th>Optómetra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Paciente</th>
                            <th>Documento</th>
                            <th style="width: 15%;">Teléfono</th>
                            <th>Edad</th>
                            <th>Fecha</th>
                            <th>Historia #</th>
                            <th>Optómetra</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>     
            </div>
        </div>
    </section>
</div>

<!-- Modal agregar usuario -->
<div id="modalAgregarHistoria" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Historia clínica</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="box box-solid box-primary">
                        <div class="box-header"> 
                            <h3 class="box-title">Datos del Paciente</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero de Documento</label>
                                        <input class="form-control input-sm" maxlength="15" required name="NuevoDocumento" id="NuevoDocumentoH"  required="" placeholder="Numero de Documento">
                                        <input type="hidden" required name="DocumentoExiste" id="DocumentoExiste" value='0'>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Documento</label>
                                        <select class="form-control input-sm" required name="NuevoTipoDoc" id="NuevoTipoDoc">
                                            <option value="C.C">Cédula de ciudadanía</option>
                                            <option value="C.E">Cédula de extranjería</option>
                                            <option value="R.C">Registro civil</option>
                                            <option value="T.I">Tarjeta de identidad</option>
                                            <option value="OTRO">Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombres</label>
                                        <input class="form-control input-sm" required name="NuevoNombre" id="NuevoNombre"  required placeholder="Nombres">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <input class="form-control input-sm" required name="NuevoApellido" id="NuevoApellido" required placeholder="Apellidos">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ocupación</label>
                                        <input class="form-control input-sm" required name="NuevoOcupacion" id="NuevoOcupacion" placeholder="Ocupación">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input class="form-control input-sm" required name="NuevoTelefono" id="NuevoTelefono" required placeholder="Teléfono">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lugar de residencia</label>
                                        <input class="form-control input-sm" required name="NuevoLugarResidencia" id="NuevoLugarResidencia" placeholder="Lugar de residencia">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input class="form-control input-sm" required name="NuevoDireccion" id="NuevoDireccion" placeholder="Dirección">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Genero</label>
                                        <select class="form-control input-sm" required name="NuevoGenero" id="NuevoGenero" placeholder="Genero">
                                            <option value="0">Genero</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha Nacimiento</label>
                                        <input class="form-control input-sm" required name="NuevoFechaNac" id="NuevoFechaNac"  required placeholder="YYYY-MM-DD">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <select class="form-control input-sm" required name="NuevoEstadoCivil" id="NuevoEstadoCivil" placeholder="Estado Civil">
                                            <option value="0">Estado Civil</option>
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
                    </div>
                    
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Datos adicionales</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre Acompañante</label>
                                        <input class="form-control input-sm"  required name="NuevoAcompanante" id="NuevoAcompanante"  required="" placeholder="Acompañante">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono Acompañante</label>
                                        <input class="form-control input-sm" maxlength="15" required name="NuevoTelefonoAconpanante" id="NuevoTelefonoAconpanante"  required="" placeholder="Teléfono Acompañante">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Parentesco</label>
                                        <input class="form-control input-sm"  required name="NuevoParentesco" id="NuevoParentesco"  
                                     placeholder="Parentesco">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Persona Responsable</label>
                                        <input class="form-control input-sm" name="NuevoAcompananteResponsable" id="NuevoAcompananteResponsable" placeholder="Persona Responsable">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono Persona Responsable</label>
                                        <input class="form-control input-sm" maxlength="15" name="NuevoTelefonoAconpananteResponsable" id="NuevoTelefonoAconpananteResponsable"   placeholder="Teléfono Persona Responsable">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Parentesco Persona Responsable</label>
                                        <input class="form-control input-sm" name="NuevoParentescoResponsable" id="NuevoParentescoResponsable"  
                                     placeholder="Parentesco Persona Responsable">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aseguradora</label>
                                        <input class="form-control input-sm"  required name="NuevoAseguradora" id="NuevoAseguradora"  required="" placeholder="Aseguradora">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo de Afiliación</label>
                                        <select class="form-control input-sm" required name="NuevoTipoAfiliacion" id="NuevoTipoAfiliacion"  required>
                                            <option value="0">Tipo de afiliación</option>
                                            <option value="C">C</option>
                                            <option value="B">B</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Semanas Cotizadas</label>
                                        <input class="form-control input-sm"  required name="NuevoSemanasCotizadas" id="NuevoSemanasCotizadas"  
                                     placeholder="Semanas Cotizadas">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Antecedentes Patologicos Generales Personales - Familiares</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                </tr>
                                <tr>
                                  <td>Congenitos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[1][per]" class="form-control" id="NuevoAntGenCongenitosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[1][fam]" class="form-control" id="NuevoAntGenCongenitosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[1][cat]" value="Congenitos">
                                    <input type="hidden" name="NuevoAntGenerales[1][nombre_cat]" value="Congenitos">
                                    <input type="hidden" name="NuevoAntGenerales[1][tipo]" value="Gen">
                                  </td>
                                  <td>Musculares</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[2][per]" class="form-control" id="NuevoAntGenMuscularesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[2][fam]" class="form-control" id="NuevoAntGenMuscularesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[2][cat]" value="Musculares">
                                    <input type="hidden" name="NuevoAntGenerales[2][nombre_cat]" value="Musculares">
                                    <input type="hidden" name="NuevoAntGenerales[2][tipo]" value="Gen">
                                  </td>
                                  <td>Autoinmunes</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[3][per]" class="form-control" id="NuevoAntGenAutoinmunesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[3][fam]" class="form-control" id="NuevoAntGenAutoinmunesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[3][cat]" value="Autoinmunes">
                                    <input type="hidden" name="NuevoAntGenerales[3][nombre_cat]" value="Autoinmunes">
                                    <input type="hidden" name="NuevoAntGenerales[3][tipo]" value="Gen">
                                  </td>
                                  <td>Cancer</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[4][per]" class="form-control" id="NuevoAntGenCancerPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[4][fam]" class="form-control" id="NuevoAntGenCancerFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[4][cat]" value="Cancer">
                                    <input type="hidden" name="NuevoAntGenerales[4][nombre_cat]" value="Cancer">
                                    <input type="hidden" name="NuevoAntGenerales[4][tipo]" value="Gen">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Quirurgicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[5][per]" class="form-control" id="NuevoAntGenQuirurgicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[5][fam]" class="form-control" id="NuevoAntGenQuirurgicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[5][cat]" value="Quirurgicos">
                                    <input type="hidden" name="NuevoAntGenerales[5][nombre_cat]" value="Quirurgicos">
                                    <input type="hidden" name="NuevoAntGenerales[5][tipo]" value="Gen">
                                  </td>
                                  <td>Toxicos o alergicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[6][per]" class="form-control" id="NuevoAntGenToxicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[6][fam]" class="form-control" id="NuevoAntGenToxicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[6][cat]" value="Toxicos">
                                    <input type="hidden" name="NuevoAntGenerales[6][nombre_cat]" value="Toxicos o alergicos">
                                    <input type="hidden" name="NuevoAntGenerales[6][tipo]" value="Gen">
                                  </td>
                                  <td>Cardiovarculares</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[7][per]" class="form-control" id="NuevoAntGenCardiovarcularesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[7][fam]" class="form-control" id="NuevoAntGenCardiovarcularesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[7][cat]" value="Cardiovarculares">
                                    <input type="hidden" name="NuevoAntGenerales[7][nombre_cat]" value="Cardiovarculares">
                                    <input type="hidden" name="NuevoAntGenerales[7][tipo]" value="Gen">
                                  </td>
                                  <td>Tiroides</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[8][per]" class="form-control" id="NuevoAntGenTiroidesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[8][fam]" class="form-control" id="NuevoAntGenTiroidesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[8][cat]" value="Tiroides">
                                    <input type="hidden" name="NuevoAntGenerales[8][nombre_cat]" value="Tiroides">
                                    <input type="hidden" name="NuevoAntGenerales[8][tipo]" value="Gen">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Traumaticos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[9][per]" class="form-control" id="NuevoAntGenTraumaticosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[9][fam]" class="form-control" id="NuevoAntGenTraumaticosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[9][cat]" value="Traumaticos">
                                    <input type="hidden" name="NuevoAntGenerales[9][nombre_cat]" value="Traumaticos">
                                    <input type="hidden" name="NuevoAntGenerales[9][tipo]" value="Gen">
                                  </td>
                                  <td>Dermatologicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[10][per]" class="form-control" id="NuevoAntGenDermatologicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[10][fam]" class="form-control" id="NuevoAntGenDermatologicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[10][cat]" value="Dermatologicos">
                                    <input type="hidden" name="NuevoAntGenerales[10][nombre_cat]" value="Dermatologicos">
                                    <input type="hidden" name="NuevoAntGenerales[10][tipo]" value="Gen">
                                  </td>
                                  <td>Metabolicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[11][per]" class="form-control" id="NuevoAntGenMetabolicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[11][fam]" class="form-control" id="NuevoAntGenMetabolicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[11][cat]" value="Metabolicos">
                                    <input type="hidden" name="NuevoAntGenerales[11][nombre_cat]" value="Metabolicos">
                                    <input type="hidden" name="NuevoAntGenerales[11][tipo]" value="Gen">
                                  </td>
                                  <td>Otros</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[12][per]" class="form-control" id="NuevoAntGenOtrosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="NuevoAntGenerales[12][fam]" class="form-control" id="NuevoAntGenOtrosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="NuevoAntGenerales[12][cat]" value="Otros">
                                    <input type="hidden" name="NuevoAntGenerales[12][nombre_cat]" value="Otros">
                                    <input type="hidden" name="NuevoAntGenerales[12][tipo]" value="Gen">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Antecedentes Personales</label>
                                        <textarea class="form-control input-sm"  required name="NuevoAntecedentesPersonales" id="NuevoAntecedentesPersonales"  required="" placeholder="Antecedentes Personales"></textarea>
                                    </div> 
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Antecedentes Familiares</label>
                                        <textarea class="form-control input-sm"  required name="NuevoAntecedetesFamiliares" id="NuevoAntecedetesFamiliares"  required="" placeholder="Antecedentes Familiares"></textarea>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Antecedentes Patologicos Personales - Oculares y Visuales</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                  <th></th>
                                  <th>Per.</th>
                                  <th></th>
                                  <th>Per.</th>
                                  <th></th>
                                  <th>Per.</th>
                                  <th></th>
                                  <th>Per.</th>
                                </tr>
                                <tr>
                                  <td>Congenitos</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[1][per]" class="form-control" id="NuevoAntOcuCongenitos">
                                    <input type="hidden" name="NuevoAntOculares[1][cat]" value="Congenitos">
                                    <input type="hidden" name="NuevoAntOculares[1][nombre_cat]" value="Congenitos">
                                    <input type="hidden" name="NuevoAntOculares[1][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias de los parpados</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[2][per]" class="form-control" id="NuevoAntOcuPatParpados">
                                    <input type="hidden" name="NuevoAntOculares[2][cat]" value="PatParpados">
                                    <input type="hidden" name="NuevoAntOculares[2][nombre_cat]" value="Patologias de los parpados">
                                    <input type="hidden" name="NuevoAntOculares[2][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias del iris</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[3][per]" class="form-control" id="NuevoAntOcuPatIris">
                                    <input type="hidden" name="NuevoAntOculares[3][cat]" value="PatIris">
                                    <input type="hidden" name="NuevoAntOculares[3][nombre_cat]" value="Patologias del iris">
                                    <input type="hidden" name="NuevoAntOculares[3][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias musculares</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[4][per]" class="form-control" id="NuevoAntOcuPatMusculares">
                                    <input type="hidden" name="NuevoAntOculares[4][cat]" value="PatMusculares">
                                    <input type="hidden" name="NuevoAntOculares[4][nombre_cat]" value="Patologias musculares">
                                    <input type="hidden" name="NuevoAntOculares[4][tipo]" value="Ocu">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Quirurgicos</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[5][per]" class="form-control" id="NuevoAntOcuQuirurgicos">
                                    <input type="hidden" name="NuevoAntOculares[5][cat]" value="Quirurgicos">
                                    <input type="hidden" name="NuevoAntOculares[5][nombre_cat]" value="Quirurgicos">
                                    <input type="hidden" name="NuevoAntOculares[5][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologia de la conjuntiva</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[6][per]" class="form-control" id="NuevoAntOcuPatConjuntiva">
                                    <input type="hidden" name="NuevoAntOculares[6][cat]" value="PatConjuntiva">
                                    <input type="hidden" name="NuevoAntOculares[6][nombre_cat]" value="Patologia de la conjuntiva">
                                    <input type="hidden" name="NuevoAntOculares[6][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias del cristalino</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[7][per]" class="form-control" id="NuevoAntOcuPatCristalino">
                                    <input type="hidden" name="NuevoAntOculares[7][cat]" value="PatCristalino">
                                    <input type="hidden" name="NuevoAntOculares[7][nombre_cat]" value="Patologias del cristalino">
                                    <input type="hidden" name="NuevoAntOculares[7][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias de la vision</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[8][per]" class="form-control" id="NuevoAntOcuPatVision">
                                    <input type="hidden" name="NuevoAntOculares[8][cat]" value="PatVision">
                                    <input type="hidden" name="NuevoAntOculares[8][nombre_cat]" value="Patologias de la vision">
                                    <input type="hidden" name="NuevoAntOculares[8][tipo]" value="Ocu">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Traumaticos</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[9][per]" class="form-control" id="NuevoAntOcuTraumaticos">
                                    <input type="hidden" name="NuevoAntOculares[9][cat]" value="Traumaticos">
                                    <input type="hidden" name="NuevoAntOculares[9][nombre_cat]" value="Traumaticos">
                                    <input type="hidden" name="NuevoAntOculares[9][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias de la cornea</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[10][per]" class="form-control" id="NuevoAntOcuPatCornea">
                                    <input type="hidden" name="NuevoAntOculares[10][cat]" value="PatCornea">
                                    <input type="hidden" name="NuevoAntOculares[10][nombre_cat]" value="Patologias de la cornea">
                                    <input type="hidden" name="NuevoAntOculares[10][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias de la retina</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[11][per]" class="form-control" id="NuevoAntOcuPatRetina">
                                    <input type="hidden" name="NuevoAntOculares[11][cat]" value="PatRetina">
                                    <input type="hidden" name="NuevoAntOculares[11][nombre_cat]" value="Patologias de la retina">
                                    <input type="hidden" name="NuevoAntOculares[11][tipo]" value="Ocu">
                                  </td>
                                  <td>Glaucoma</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[12][per]" class="form-control" id="NuevoAntOcuGlaucoma">
                                    <input type="hidden" name="NuevoAntOculares[12][cat]" value="Glaucoma">
                                    <input type="hidden" name="NuevoAntOculares[12][nombre_cat]" value="Glaucoma">
                                    <input type="hidden" name="NuevoAntOculares[12][tipo]" value="Ocu">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Infecciosas</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[13][per]" class="form-control" id="NuevoAntOcuInfecciosas">
                                    <input type="hidden" name="NuevoAntOculares[13][cat]" value="Infecciosas">
                                    <input type="hidden" name="NuevoAntOculares[13][nombre_cat]" value="Infecciosas">
                                    <input type="hidden" name="NuevoAntOculares[13][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias camara anterior</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[14][per]" class="form-control" id="NuevoAntOcuPatCamara">
                                    <input type="hidden" name="NuevoAntOculares[14][cat]" value="PatCamara">
                                    <input type="hidden" name="NuevoAntOculares[14][nombre_cat]" value="Patologias camara anterior">
                                    <input type="hidden" name="NuevoAntOculares[14][tipo]" value="Ocu">
                                  </td>
                                  <td>Patologias aparato lagrimal</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[15][per]" class="form-control" id="NuevoAntOcuPatLagrimal">
                                    <input type="hidden" name="NuevoAntOculares[15][cat]" value="PatLagrimal">
                                    <input type="hidden" name="NuevoAntOculares[15][nombre_cat]" value="Patologias aparato lagrimal">
                                    <input type="hidden" name="NuevoAntOculares[15][tipo]" value="Ocu">
                                  </td>
                                  <td>Otras patologias</td>
                                  <td>
                                    <input type="checkbox" name="NuevoAntOculares[16][per]" class="form-control" id="NuevoAntOcuOtras">
                                    <input type="hidden" name="NuevoAntOculares[16][cat]" value="PatOtras">
                                    <input type="hidden" name="NuevoAntOculares[16][nombre_cat]" value="Otras patologias">
                                    <input type="hidden" name="NuevoAntOculares[16][tipo]" value="Ocu">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ampliacion de antecedentes patologicos oculares y visuales</label>
                                        <textarea class="form-control input-sm"  required name="NuevoAntecedentesOculares" id="NuevoAntecedentesOculares"  required="" placeholder="Antecedentes Oculares y visuales"></textarea>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Información de lentes</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipo de lente en uso</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTipoLenteEnUso" id="NuevoTipoLenteEnUso" placeholder="Tipo de lente en uso">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box box-solid box-primary" style="padding-bottom: 20px;">
                                        <div class="box-header">
                                            <h3 class="box-title">Lensometria</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th width="20%">Esfera</th>
                                                        <th width="20%">Cilindro</th>
                                                        <th width="20%">Eje</th>
                                                        <th width="20%">Add</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEsferaOD" id="NuevoEsferaOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoCilindroOD" id="NuevoCilindroOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEjeOD" id="NuevoEjeOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAddOD" id="NuevoAddOD">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td style="text-align: center;">ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEsferaID" id="NuevoEsferaID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoCilindroID" id="NuevoCilindroID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEjeID" id="NuevoEjeID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAddID" id="NuevoAddID">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Agudeza Visual</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Sin Corrección</th>
                                                        <th>Con Corrección</th>
                                                        <th>con Estenopeico</th>
                                                        <th>UV</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoSinCorreccionOD" id="NuevoSinCorreccionOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoConCorreccionOD" id="NuevoConCorreccionOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoConEstenopeicoOD" id="NuevoConEstenopeicoOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoConUVOD" id="NuevoConUVOD">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td>ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoSinCorreccionID" id="NuevoSinCorreccionID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoConCorreccionID" id="NuevoConCorreccionID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoConEstenopeicoID" id="NuevoConEstenopeicoID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoConUVID" id="NuevoConUVID">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Oftalmoscopia</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoOftalmoscopia" id="NuevoOftalmoscopia" placeholder="Oftalmoscopia">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Excavación OD</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoExcavacionOD" id="NuevoExcavacionOD" placeholder="Excavacion OD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Excavación OI</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoExcavacionOI" id="NuevoExcavacionOI" placeholder="Excavacion OI">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reflejos Pupilares</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoReflejosPulpiresOD" id="NuevoReflejosPulpiresOD" placeholder="Reflejos Pupilares">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Motilidad Ocular</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoMotilidadOcular" id="NuevoMotilidadOcular" placeholder="Motilidad Ocular">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>VL</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoVlOrtoforia" id="NuevoVlOrtoforia" placeholder="VL">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>VP</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoVpOrtoforia" id="NuevoVpOrtoforia" placeholder="VP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Retinoscopia</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th width="20%">Esfera</th>
                                                        <th width="20%">Cilindro</th>
                                                        <th width="20%">Eje</th>
                                                        <th width="20%">AUV</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEsferaRetinosOD" id="NuevoEsferaRetinosOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoCilindroRetinosOD" id="NuevoCilindroRetinosOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEjeRetinosOD" id="NuevoEjeRetinosOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAddRetinosOD" id="NuevoAddRetinosOD">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEsferaRetinosID" id="NuevoEsferaRetinosID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoCilindroRetinosID" id="NuevoCilindroRetinosID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEjeRetinosID" id="NuevoEjeRetinosID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAddRetinosID" id="NuevoAddRetinosID">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">RX FINAL</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th width="20%">Esfera</th>
                                                        <th width="20%">Cilindro</th>
                                                        <th width="20%">Eje</th>
                                                        <th width="20%">Add</th>
                                                        <th width="20%">Av</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEsferaRXOD" id="NuevoEsferaRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoCilindroRXOD" id="NuevoCilindroRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEjeRXOD" id="NuevoEjeRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAddRXOD" id="NuevoAddRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAvRXOD" id="NuevoAvRXOD">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEsferaRXID" id="NuevoEsferaRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoCilindroRXID" id="NuevoCilindroRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoEjeRXID" id="NuevoEjeRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAddRXID" id="NuevoAddRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="NuevoAvRXID" id="NuevoAvRXID">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                    
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Formula final</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th width="14%">Esfera</th>
                                                <th width="14%">Cilindro</th>
                                                <th width="14%">Eje</th>
                                                <th width="14%">Add</th>
                                                <th width="14%">Av</th>
                                                <th width="14%">AUV</th>
                                                <th width="14%">Dp</th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;">OD</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoEsferaFormulaFinalOD" id="NuevoEsferaFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoCilindroFormulaFinalOD" id="NuevoCilindroFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoEjeFormulaFinalOD" id="NuevoEjeFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoAddFormulaFinalOD" id="NuevoAddFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoAvFormulaFinalOD" id="NuevoAvFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoAUVFormulaFinalOD" id="NuevoAUVFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoDpFormulaFinalOD" id="NuevoDpFormulaFinalOD">
                                                    </div>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td style="text-align: center;">ID</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoEsferaFormulaFinalID" id="NuevoEsferaFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoCilindroFormulaFinalID" id="NuevoCilindroFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoEjeFormulaFinalID" id="NuevoEjeFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoAddFormulaFinalID" id="NuevoAddFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoAvFormulaFinalID" id="NuevoAvFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoAUVFormulaFinalID" id="NuevoAUVFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="NuevoDpFormulaFinalID" id="NuevoDpFormulaFinalID">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Biomocrospia</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoBiomocrospia" id="NuevoBiomocrospia" placeholder="Biomocrospia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Exámenes Complementarios</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoExamenesComplementarios" id="NuevoExamenesComplementarios" placeholder="Examenes Complementarios">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Queratometría OD</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoQueratometriaOD" id="NuevoQueratometriaOD" placeholder="Queratometría OD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Queratometría ID</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoQueratometriaID" id="NuevoQueratometriaID" placeholder="Queratometría ID">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tonometría OD</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTonometriaOD" id="NuevoTonometriaOD" placeholder="Tonometría OD">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tonometría ID</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTonometriaID" id="NuevoTonometriaID" placeholder="Tonometría ID">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo de Tonometro</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTipoTonometro" id="NuevoTipoTonometro" placeholder="Tipo de Tonometro">
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Test Acomodativo</label>
                                        <input type="text" class="form-control input-sm" name="NuevoTestAcomodativo" id="NuevoTestAcomodativo" placeholder="Test Acomodativo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Resultado</label>
                                        <input type="text" class="form-control input-sm" name="NuevoResultadoTestAcomo" id="NuevoResultadoTestAcomo" placeholder="Resultado">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 hidden">
                                    <div class="form-group">
                                        <label>Test Amsier</label>
                                        <input type="text" class="form-control input-sm" name="NuevoTestAmsier" id="NuevoTestAmsier" placeholder="Test Amsier">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test Color Derecho</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTestColorD" id="NuevoTestColorDerecho" placeholder="Test Color Derecho">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test Color Izquierdo</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTestColorI" id="NuevoTestColorIzquierdo" placeholder="Test Color Izquierdo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test Estereópsis</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoTestEstereopsis" id="NuevoTestEstereopsis" placeholder="Test Estereópsis">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" class="form-control input-sm" required name="NuevoDescripcionX" id="NuevoDescripcionX" placeholder="Descripción">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Diagnósticos</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Diagnóstico Principal</label>
                                        <input type="text" placeholder="Diagnóstico Principal" required name="NuevoDiagnosticoPrincipal" id="NuevoDiagnosticoPrincipal" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Diagnóstico Secundario</label>
                                        <input type="text" placeholder="Diagnóstico Secundario" required name="NuevoDiagnosticoSecundario" id="NuevoDiagnosticoSecundario" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row hidden">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Otros Diagnósticos</label>
                                        <input type="text" placeholder="Otros Diagnósticos" name="NuevoDiagnosticoOtros" id="NuevoDiagnosticoOtros" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Conducta</label>
                                        <textarea placeholder="Conducta" name="NuevoConducta" id="NuevoConducta" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remisión y Justificación</label>
                                        <textarea placeholder="Remisión y Justificación" name="NuevoRemision" id="NuevoRemision" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Optómetra</label>
                                        <select placeholder="Optometra" required name="NuevoOptometra" id="NuevoOptometra" class="form-control input-sm">
                                            <option value="0">Seleccione</option>
                                            <?php 
                                                $item = null;
                                                $valor = null;
                                                $usuarios = ControladorUsuarios::ctrMostrarOptometras($item, $valor);

                                                foreach ($usuarios as $key => $value) {
                                                    echo "<option value='".$value['usuarios_id_i']."'>".$value['usuarios_nombres_v']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea placeholder="Observaciones" required name="NuevoObservaciones" id="NuevoObservaciones" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar historia</button>
                </div>
                <?php
                    $crearUsuario = new ControladorHistorias();
                    $crearUsuario->ctrCrearHistorias();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->


<!-- Modal agregar usuario -->
<div id="modalEditarHistoria" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Historia clínica</h4>
                </div>
                <div class="modal-body">
                    <div class="box box-solid box-primary">
                        <div class="box-header"> 
                            <h3 class="box-title">Datos del Paciente</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero de Documento</label>
                                        <input class="form-control input-sm" maxlength="15" required name="EditarDocumento" id="EditarDocumento"  required=""  disabled placeholder="Numero de Documento">
                                        <input type="hidden" required name="EditarPacientes_id_i" id="EditarPacientes_id_i" value='0'>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Documento</label>
                                        <select class="form-control input-sm" required name="EditarTipoDoc" id="EditarTipoDoc" disabled>
                                            <option value="C.C">Cédula de ciudadanía</option>
                                            <option value="C.E">Cédula de extranjería</option>
                                            <option value="R.C">Registro civil</option>
                                            <option value="T.I">Tarjeta de identidad</option>
                                            <option value="OTRO">Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombres</label>
                                        <input class="form-control input-sm" required name="EditarNombre"  id="EditarNombre" required placeholder="Nombres" disabled>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <input class="form-control input-sm" required name="EditarApellido" id="EditarApellido" required placeholder="Apellidos" disabled>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ocupación</label>
                                        <input class="form-control input-sm" required name="EditarOcupacion" id="EditarOcupacion" placeholder="Ocupación" disabled>
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input class="form-control input-sm" required name="EditarTelefono" id="EditarTelefono" required placeholder="Teléfono" disabled>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lugar de residencia</label>
                                        <input class="form-control input-sm" disabled required name="EditarLugarResidencia" id="EditarLugarResidencia" placeholder="Lugar de residencia">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input class="form-control input-sm" disabled required name="EditarDireccion" id="EditarDireccion" placeholder="Dirección">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Genero</label>
                                        <select class="form-control input-sm" disabled required name="EditarGenero" id="EditarGenero" placeholder="Genero">
                                            <option value="0">Genero</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha Nacimiento</label>
                                        <input class="form-control input-sm" disabled  required name="EditarFechaNac" id="EditarFechaNac"  required placeholder="YYYY-MM-DD">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <select class="form-control input-sm" disabled required name="EditarEstadoCivil" id="EditarEstadoCivil" placeholder="Estado Civil">
                                            <option value="0">Estado Civil</option>
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
                    </div>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Datos adicionales</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre Acompañante</label>
                                        <input class="form-control input-sm"  required name="EditarAcompanante" id="EditarAcompanante"  required="" placeholder="Acompañante">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono Acompañante</label>
                                        <input class="form-control input-sm" maxlength="15" required name="EditarTelefonoAconpanante" id="EditarTelefonoAconpanante"  required="" placeholder="Teléfono Acompañante">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Parentesco</label>
                                        <input class="form-control input-sm"  required name="EditarParentesco" id="EditarParentesco"  
                                     placeholder="Parentesco">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Persona Responsable</label>
                                        <input class="form-control input-sm"  name="EditarAcompananteResponsable" id="EditarAcompananteResponsable"   placeholder="Persona Responsable">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono Persona Responsable</label>
                                        <input class="form-control input-sm" maxlength="15" name="EditarTelefonoAconpananteResponsable" id="EditarTelefonoAconpananteResponsable"   placeholder="Teléfono Persona Responsable">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Parentesco Persona Responsable</label>
                                        <input class="form-control input-sm"  name="EditarParentescoResponsable" id="EditarParentescoResponsable"  
                                     placeholder="Parentesco Persona Responsable">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aseguradora</label>
                                        <input class="form-control input-sm"  required name="EditarAseguradora" id="EditarAseguradora"  required="" placeholder="Aseguradora">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo de afiliación</label>
                                        <select class="form-control input-sm" required name="EditarTipoAfiliacion" id="EditarTipoAfiliacion"  required>
                                            <option value="0">Tipo de afiliación</option>
                                            <option value="C">C</option>
                                            <option value="B">B</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Semanas Cotizadas</label>
                                        <input class="form-control input-sm"  required name="EditarSemanasCotizadas" id="EditarSemanasCotizadas"  
                                     placeholder="Semanas Cotizadas">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Antecedentes Patologicos Generales Personales - Familiares</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                  <th></th>
                                  <th><div class="row"><div class="col-md-6">Per.</div><div class="col-md-6">Fam.</div></div></th>
                                </tr>
                                <tr>
                                  <td>Congenitos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[1][per]" class="form-control" id="EditarAntGenCongenitosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[1][fam]" class="form-control" id="EditarAntGenCongenitosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[1][cat]" value="Congenitos">
                                    <input type="hidden" name="EditarAntGenerales[1][nombre_cat]" value="Congenitos">
                                    <input type="hidden" name="EditarAntGenerales[1][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[1][id_antecedente]" id="EditarAntGenCongenitosId">
                                  </td>
                                  <td>Musculares</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[2][per]" class="form-control" id="EditarAntGenMuscularesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[2][fam]" class="form-control" id="EditarAntGenMuscularesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[2][cat]" value="Musculares">
                                    <input type="hidden" name="EditarAntGenerales[2][nombre_cat]" value="Musculares">
                                    <input type="hidden" name="EditarAntGenerales[2][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[2][id_antecedente]" id="EditarAntGenMuscularesId">
                                  </td>
                                  <td>Autoinmunes</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[3][per]" class="form-control" id="EditarAntGenAutoinmunesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[3][fam]" class="form-control" id="EditarAntGenAutoinmunesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[3][cat]" value="Autoinmunes">
                                    <input type="hidden" name="EditarAntGenerales[3][nombre_cat]" value="Autoinmunes">
                                    <input type="hidden" name="EditarAntGenerales[3][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[3][id_antecedente]" id="EditarAntGenAutoinmunesId">
                                  </td>
                                  <td>Cancer</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[4][per]" class="form-control" id="EditarAntGenCancerPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[4][fam]" class="form-control" id="EditarAntGenCancerFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[4][cat]" value="Cancer">
                                    <input type="hidden" name="EditarAntGenerales[4][nombre_cat]" value="Cancer">
                                    <input type="hidden" name="EditarAntGenerales[4][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[4][id_antecedente]" id="EditarAntGenCancerId">
                                  </td>
                                </td>
                                </tr>
                                <tr>
                                  <td>Quirurgicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[5][per]" class="form-control" id="EditarAntGenQuirurgicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[5][fam]" class="form-control" id="EditarAntGenQuirurgicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[5][cat]" value="Quirurgicos">
                                    <input type="hidden" name="EditarAntGenerales[5][nombre_cat]" value="Quirurgicos">
                                    <input type="hidden" name="EditarAntGenerales[5][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[5][id_antecedente]" id="EditarAntGenQuirurgicosId">
                                  </td>
                                  <td>Toxicos o alergicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[6][per]" class="form-control" id="EditarAntGenToxicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[6][fam]" class="form-control" id="EditarAntGenToxicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[6][cat]" value="Toxicos">
                                    <input type="hidden" name="EditarAntGenerales[6][nombre_cat]" value="Toxicos o alergicos">
                                    <input type="hidden" name="EditarAntGenerales[6][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[6][id_antecedente]" id="EditarAntGenToxicosId">
                                  </td>
                                  <td>Cardiovarculares</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[7][per]" class="form-control" id="EditarAntGenCardiovarcularesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[7][fam]" class="form-control" id="EditarAntGenCardiovarcularesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[7][cat]" value="Cardiovarculares">
                                    <input type="hidden" name="EditarAntGenerales[7][nombre_cat]" value="Cardiovarculares">
                                    <input type="hidden" name="EditarAntGenerales[7][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[7][id_antecedente]" id="EditarAntGenCardiovarcularesId">
                                  </td>
                                  <td>Tiroides</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[8][per]" class="form-control" id="EditarAntGenTiroidesPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[8][fam]" class="form-control" id="EditarAntGenTiroidesFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[8][cat]" value="Tiroides">
                                    <input type="hidden" name="EditarAntGenerales[8][nombre_cat]" value="Tiroides">
                                    <input type="hidden" name="EditarAntGenerales[8][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[8][id_antecedente]" id="EditarAntGenTiroidesId">
                                </tr>
                                <tr>
                                  <td>Traumaticos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[9][per]" class="form-control" id="EditarAntGenTraumaticosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[9][fam]" class="form-control" id="EditarAntGenTraumaticosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[9][cat]" value="Traumaticos">
                                    <input type="hidden" name="EditarAntGenerales[9][nombre_cat]" value="Traumaticos">
                                    <input type="hidden" name="EditarAntGenerales[9][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[9][id_antecedente]" id="EditarAntGenTraumaticosId">
                                  </td>
                                  <td>Dermatologicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[10][per]" class="form-control" id="EditarAntGenDermatologicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[10][fam]" class="form-control" id="EditarAntGenDermatologicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[10][cat]" value="Dermatologicos">
                                    <input type="hidden" name="EditarAntGenerales[10][nombre_cat]" value="Dermatologicos">
                                    <input type="hidden" name="EditarAntGenerales[10][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[10][id_antecedente]" id="EditarAntGenDermatologicosId">
                                  </td>
                                  <td>Metabolicos</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[11][per]" class="form-control" id="EditarAntGenMetabolicosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[11][fam]" class="form-control" id="EditarAntGenMetabolicosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[11][cat]" value="Metabolicos">
                                    <input type="hidden" name="EditarAntGenerales[11][nombre_cat]" value="Metabolicos">
                                    <input type="hidden" name="EditarAntGenerales[11][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[11][id_antecedente]" id="EditarAntGenMetabolicosId">
                                </td>
                                  <td>Otros</td>
                                  <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[12][per]" class="form-control" id="EditarAntGenOtrosPer">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="EditarAntGenerales[12][fam]" class="form-control" id="EditarAntGenOtrosFam">
                                        </div>
                                    </div>
                                    <input type="hidden" name="EditarAntGenerales[12][cat]" value="Otros">
                                    <input type="hidden" name="EditarAntGenerales[12][nombre_cat]" value="Otros">
                                    <input type="hidden" name="EditarAntGenerales[12][tipo]" value="Gen">
                                    <input type="hidden" name="EditarAntGenerales[12][id_antecedente]" id="EditarAntGenOtrosId">
                                </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Antecedentes Personales</label>
                                        <textarea class="form-control input-sm"  required name="EditarAntecedentesPersonales" id="EditarAntecedentesPersonales"  required="" placeholder="Antecedentes Personales"></textarea>
                                    </div> 
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Antecedentes Familiares</label>
                                        <textarea class="form-control input-sm"  required name="EditarAntecedetesFamiliares" id="EditarAntecedetesFamiliares"  required="" placeholder="Antecedentes Familiares"></textarea>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Antecedentes Patologicos Personales - Oculares y Visuales</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                  <th></th>
                                  <th>Per.</th>
                                  <th></th>
                                  <th>Per.</th>
                                  <th></th>
                                  <th>Per.</th>
                                  <th></th>
                                  <th>Per.</th>
                                </tr>
                                <tr>
                                  <td>Congenitos</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[1][per]" class="form-control" id="EditarAntOcuCongenitos">
                                    <input type="hidden" name="EditarAntOculares[1][cat]" value="Congenitos">
                                    <input type="hidden" name="EditarAntOculares[1][nombre_cat]" value="Congenitos">
                                    <input type="hidden" name="EditarAntOculares[1][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[1][id_antecedente]" id="EditarAntOcuCongenitosId">
                                  </td>
                                  <td>Patologias de los parpados</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[2][per]" class="form-control" id="EditarAntOcuPatParpados">
                                    <input type="hidden" name="EditarAntOculares[2][cat]" value="PatParpados">
                                    <input type="hidden" name="EditarAntOculares[2][nombre_cat]" value="Patologias de los parpados">
                                    <input type="hidden" name="EditarAntOculares[2][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[2][id_antecedente]" id="EditarAntOcuPatParpadosId">
                                  </td>
                                  <td>Patologias del iris</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[3][per]" class="form-control" id="EditarAntOcuPatIris">
                                    <input type="hidden" name="EditarAntOculares[3][cat]" value="PatIris">
                                    <input type="hidden" name="EditarAntOculares[3][nombre_cat]" value="Patologias del iris">
                                    <input type="hidden" name="EditarAntOculares[3][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[3][id_antecedente]" id="EditarAntOcuPatIrisId">
                                  </td>
                                  <td>Patologias musculares</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[4][per]" class="form-control" id="EditarAntOcuPatMusculares">
                                    <input type="hidden" name="EditarAntOculares[4][cat]" value="PatMusculares">
                                    <input type="hidden" name="EditarAntOculares[4][nombre_cat]" value="Patologias musculares">
                                    <input type="hidden" name="EditarAntOculares[4][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[4][id_antecedente]" id="EditarAntOcuPatMuscularesId">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Quirurgicos</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[5][per]" class="form-control" id="EditarAntOcuQuirurgicos">
                                    <input type="hidden" name="EditarAntOculares[5][cat]" value="Quirurgicos">
                                    <input type="hidden" name="EditarAntOculares[5][nombre_cat]" value="Quirurgicos">
                                    <input type="hidden" name="EditarAntOculares[5][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[5][id_antecedente]" id="EditarAntOcuQuirurgicosId">
                                  </td>
                                  <td>Patologia de la conjuntiva</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[6][per]" class="form-control" id="EditarAntOcuPatConjuntiva">
                                    <input type="hidden" name="EditarAntOculares[6][cat]" value="PatConjuntiva">
                                    <input type="hidden" name="EditarAntOculares[6][nombre_cat]" value="Patologia de la conjuntiva">
                                    <input type="hidden" name="EditarAntOculares[6][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[6][id_antecedente]" id="EditarAntOcuPatConjuntivaId">
                                  </td>
                                  <td>Patologias del cristalino</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[7][per]" class="form-control" id="EditarAntOcuPatCristalino">
                                    <input type="hidden" name="EditarAntOculares[7][cat]" value="PatCristalino">
                                    <input type="hidden" name="EditarAntOculares[7][nombre_cat]" value="Patologias del cristalino">
                                    <input type="hidden" name="EditarAntOculares[7][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[7][id_antecedente]" id="EditarAntOcuPatCristalinoId">
                                  </td>
                                  <td>Patologias de la vision</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[8][per]" class="form-control" id="EditarAntOcuPatVision">
                                    <input type="hidden" name="EditarAntOculares[8][cat]" value="PatVision">
                                    <input type="hidden" name="EditarAntOculares[8][nombre_cat]" value="Patologias de la vision">
                                    <input type="hidden" name="EditarAntOculares[8][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[8][id_antecedente]" id="EditarAntOcuPatVisionId">
                                  </td>
                                </tr>
                                <tr>
                                  <td>Traumaticos</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[9][per]" class="form-control" id="EditarAntOcuTraumaticos">
                                    <input type="hidden" name="EditarAntOculares[9][cat]" value="Traumaticos">
                                    <input type="hidden" name="EditarAntOculares[9][nombre_cat]" value="Traumaticos">
                                    <input type="hidden" name="EditarAntOculares[9][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[9][id_antecedente]" id="EditarAntOcuTraumaticosId">
                                  </td>
                                  <td>Patologias de la cornea</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[10][per]" class="form-control" id="EditarAntOcuPatCornea">
                                    <input type="hidden" name="EditarAntOculares[10][cat]" value="PatCornea">
                                    <input type="hidden" name="EditarAntOculares[10][nombre_cat]" value="Patologias de la cornea">
                                    <input type="hidden" name="EditarAntOculares[10][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[10][id_antecedente]" id="EditarAntOcuPatCorneaId">
                                  </td>
                                  <td>Patologias de la retina</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[11][per]" class="form-control" id="EditarAntOcuPatRetina">
                                    <input type="hidden" name="EditarAntOculares[11][cat]" value="PatRetina">
                                    <input type="hidden" name="EditarAntOculares[11][nombre_cat]" value="Patologias de la retina">
                                    <input type="hidden" name="EditarAntOculares[11][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[11][id_antecedente]" id="EditarAntOcuPatRetinaId">
                                  </td>
                                  <td>Glaucoma</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[12][per]" class="form-control" id="EditarAntOcuGlaucoma">
                                    <input type="hidden" name="EditarAntOculares[12][cat]" value="Glaucoma">
                                    <input type="hidden" name="EditarAntOculares[12][nombre_cat]" value="Glaucoma">
                                    <input type="hidden" name="EditarAntOculares[12][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[12][id_antecedente]" id="EditarAntOcuGlaucomaId">
                                 </td>
                                </tr>
                                <tr>
                                  <td>Infecciosas</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[13][per]" class="form-control" id="EditarAntOcuInfecciosas">
                                    <input type="hidden" name="EditarAntOculares[13][cat]" value="Infecciosas">
                                    <input type="hidden" name="EditarAntOculares[13][nombre_cat]" value="Infecciosas">
                                    <input type="hidden" name="EditarAntOculares[13][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[13][id_antecedente]" id="EditarAntOcuInfecciosasId">
                                  </td>
                                  <td>Patologias camara anterior</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[14][per]" class="form-control" id="EditarAntOcuPatCamara">
                                    <input type="hidden" name="EditarAntOculares[14][cat]" value="PatCamara">
                                    <input type="hidden" name="EditarAntOculares[14][nombre_cat]" value="Patologias camara anterior">
                                    <input type="hidden" name="EditarAntOculares[14][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[14][id_antecedente]" id="EditarAntOcuPatCamaraId">
                                  </td>
                                  </td>
                                  <td>Patologias aparato lagrimal</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[15][per]" class="form-control" id="EditarAntOcuPatLagrimal">
                                    <input type="hidden" name="EditarAntOculares[15][cat]" value="PatLagrimal">
                                    <input type="hidden" name="EditarAntOculares[15][nombre_cat]" value="Patologias aparato lagrimal">
                                    <input type="hidden" name="EditarAntOculares[15][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[15][id_antecedente]" id="EditarAntOcuPatLagrimalId">
                                  </td>
                                  <td>Otras patologias</td>
                                  <td>
                                    <input type="checkbox" name="EditarAntOculares[16][per]" class="form-control" id="EditarAntOcuPatOtras">
                                    <input type="hidden" name="EditarAntOculares[16][cat]" value="PatOtras">
                                    <input type="hidden" name="EditarAntOculares[16][nombre_cat]" value="Otras patologias">
                                    <input type="hidden" name="EditarAntOculares[16][tipo]" value="Ocu">
                                    <input type="hidden" name="EditarAntOculares[16][id_antecedente]" id="EditarAntOcuPatOtrasId">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ampliacion de antecedentes patologicos oculares y visuales</label>
                                        <textarea class="form-control input-sm"  required name="EditarAntecedentesOculares" id="EditarAntecedentesOculares"  required="" placeholder="Antecedentes Oculares y visuales"></textarea>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Información de lentes</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipo de lente en uso</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTipoLenteEnUso" id="EditarTipoLenteEnUso" placeholder="Tipo de lente en uso">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box box-solid box-primary" style="padding-bottom: 20px">
                                        <div class="box-header">
                                            <h3 class="box-title">Lensometria</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th width="20%">Esfera</th>
                                                        <th width="20%">Cilindro</th>
                                                        <th width="20%">Eje</th>
                                                        <th width="20%">Add</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEsferaOD" id="EditarEsferaOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarCilindroOD" id="EditarCilindroOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEjeOD" id="EditarEjeOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAddOD" id="EditarAddOD">
                                                            </div>
                                                        </td>
                                                        <input type="hidden" name="EditarODId" id="EditarODId">
                                                    </tr>
                                                     <tr>
                                                        <td style="text-align: center;">ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEsferaID" id="EditarEsferaID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarCilindroID" id="EditarCilindroID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEjeID" id="EditarEjeID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAddID" id="EditarAddID">
                                                            </div>
                                                        </td>
                                                        <input type="hidden" name="EditarIDId" id="EditarIDId">
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Agudeza Visual</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Sin Corrección</th>
                                                        <th>Con Corrección</th>
                                                        <th>con Estenopeico</th>
                                                        <th>UV</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarSinCorreccionOD" id="EditarSinCorreccionOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarConCorreccionOD" id="EditarConCorreccionOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarConEstenopeicoOD" id="EditarConEstenopeicoOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarConUVOD" id="EditarConUVOD">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td>ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarSinCorreccionID" id="EditarSinCorreccionID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarConCorreccionID" id="EditarConCorreccionID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarConEstenopeicoID" id="EditarConEstenopeicoID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarConUVID" id="EditarConUVID">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Oftalmoscopia</label>
                                        <input type="text" class="form-control input-sm" required name="EditarOftalmoscopia" id="EditarOftalmoscopia" placeholder="Oftalmoscopia">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Excavación OD</label>
                                        <input type="text" class="form-control input-sm" required name="EditarExcavacionOD" id="EditarExcavacionOD" placeholder="Excavacion OD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Excavación OI</label>
                                        <input type="text" class="form-control input-sm" required name="EditarExcavacionOI" id="EditarExcavacionOI" placeholder="Excavacion OI">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reflejos Pupilares</label>
                                        <input type="text" class="form-control input-sm" required name="EditarReflejosPulpiresOD" id="EditarReflejosPulpiresOD" placeholder="Reflejos Pupilares">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Motilidad Ocular</label>
                                        <input type="text" class="form-control input-sm" required name="EditarMotilidadOcular" id="EditarMotilidadOcular" placeholder="Motilidad Ocular">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>VL</label>
                                        <input type="text" class="form-control input-sm" required name="EditarVlOrtoforia" id="EditarVlOrtoforia" placeholder="VL">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>VP</label>
                                        <input type="text" class="form-control input-sm" required name="EditarVpOrtoforia" id="EditarVpOrtoforia" placeholder="VP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Retinoscopia</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th width="20%">Esfera</th>
                                                        <th width="20%">Cilindro</th>
                                                        <th width="20%">Eje</th>
                                                        <th width="20%">AUV</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEsferaRetinosOD" id="EditarEsferaRetinosOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarCilindroRetinosOD" id="EditarCilindroRetinosOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEjeRetinosOD" id="EditarEjeRetinosOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAddRetinosOD" id="EditarAddRetinosOD">
                                                            </div>
                                                            <input type="hidden" name="EditarRetinosODId" id="EditarRetinosODId">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEsferaRetinosID" id="EditarEsferaRetinosID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarCilindroRetinosID" id="EditarCilindroRetinosID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEjeRetinosID" id="EditarEjeRetinosID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAddRetinosID" id="EditarAddRetinosID">
                                                            </div>
                                                        </td>
                                                        <input type="hidden" name="EditarRetinosIDId" id="EditarRetinosIDId">
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">RX FINAL</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th width="20%">Esfera</th>
                                                        <th width="20%">Cilindro</th>
                                                        <th width="20%">Eje</th>
                                                        <th width="20%">Add</th>
                                                        <th width="20%">Av</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">OD</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEsferaRXOD" id="EditarEsferaRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarCilindroRXOD" id="EditarCilindroRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEjeRXOD" id="EditarEjeRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAddRXOD" id="EditarAddRXOD">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAvRXOD" id="EditarAvRXOD">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">ID</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEsferaRXID" id="EditarEsferaRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarCilindroRXID" id="EditarCilindroRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarEjeRXID" id="EditarEjeRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAddRXID" id="EditarAddRXID">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" required name="EditarAvRXID" id="EditarAvRXID">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                    
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Formula final</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th width="14%">Esfera</th>
                                                <th width="14%">Cilindro</th>
                                                <th width="14%">Eje</th>
                                                <th width="14%">Add</th>
                                                <th width="14%">Av</th>
                                                <th width="14%">AUV</th>
                                                <th width="14%">Dp</th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;">OD</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarEsferaFormulaFinalOD" id="EditarEsferaFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarCilindroFormulaFinalOD" id="EditarCilindroFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarEjeFormulaFinalOD" id="EditarEjeFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarAddFormulaFinalOD" id="EditarAddFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarAvFormulaFinalOD" id="EditarAvFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarAUVFormulaFinalOD" id="EditarAUVFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarDpFormulaFinalOD" id="EditarDpFormulaFinalOD">
                                                    </div>
                                                </td>
                                                <input type="hidden" name="EditarFormulaFinalODId" id="EditarFormulaFinalODId">
                                            </tr>
                                                <tr>
                                                <td style="text-align: center;">ID</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarEsferaFormulaFinalID" id="EditarEsferaFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarCilindroFormulaFinalID" id="EditarCilindroFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarEjeFormulaFinalID" id="EditarEjeFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarAddFormulaFinalID" id="EditarAddFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarAvFormulaFinalID" id="EditarAvFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarAUVFormulaFinalID" id="EditarAUVFormulaFinalID">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" required name="EditarDpFormulaFinalID" id="EditarDpFormulaFinalID">
                                                    </div>
                                                </td>
                                                <input type="hidden" name="EditarFormulaFinalIDId" id="EditarFormulaFinalIDId">
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Biomocrospia</label>
                                        <input type="text" class="form-control input-sm" required name="EditarBiomocrospia" id="EditarBiomocrospia" placeholder="Biomocrospia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Exámenes Complementarios</label>
                                        <input type="text" class="form-control input-sm" required name="EditarExamenesComplementarios" id="EditarExamenesComplementarios" placeholder="Examenes Complementarios">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Queratometría OD</label>
                                        <input type="text" class="form-control input-sm" required name="EditarQueratometriaOD" id="EditarQueratometriaOD" placeholder="Queratometría OD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Queratometría ID</label>
                                        <input type="text" class="form-control input-sm" required name="EditarQueratometriaID" id="EditarQueratometriaID" placeholder="Queratometría ID">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tonometría OD</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTonometriaOD" id="EditarTonometriaOD" placeholder="Tonometría OD">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tonometría ID</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTonometriaID" id="EditarTonometriaID" placeholder="Tonometría ID">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo de Tonometro</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTipoTonometro" id="EditarTipoTonometro" placeholder="Tipo de Tonometro">
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Test Acomodativo</label>
                                        <input type="text" class="form-control input-sm" name="EditarTestAcomodativo" id="EditarTestAcomodativo" placeholder="Test Acomodativo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Resultado</label>
                                        <input type="text" class="form-control input-sm" name="EditarResultadoTestAcomo" id="EditarResultadoTestAcomo" placeholder="Resultado">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 hidden">
                                    <div class="form-group">
                                        <label>Test Amsier</label>
                                        <input type="text" class="form-control input-sm" name="EditarTestAmsier" id="EditarTestAmsier" placeholder="Test Amsier">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test color Derecho</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTestColorD" id="EditarTestColorD" placeholder="Test Color Derecho">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test color Izquierdo</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTestColorI" id="EditarTestColorI" placeholder="Test Color Izquierdo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Test Estereópsis</label>
                                        <input type="text" class="form-control input-sm" required name="EditarTestEstereopsis" id="EditarTestEstereopsis" placeholder="Test Estereópsis">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" class="form-control input-sm" required name="EditarDescripcionX" id="EditarDescripcionX" placeholder="Descripción">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Diagnósticos</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Diagnóstico Principal</label>
                                        <input type="text" placeholder="Diagnóstico Principal" required name="EditarDiagnosticoPrincipal" id="EditarDiagnosticoPrincipal" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Diagnóstico Secundario</label>
                                        <input type="text" placeholder="Diagnóstico Secundario" required name="EditarDiagnosticoSecundario" id="EditarDiagnosticoSecundario" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row hidden">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Otros Diagnósticos</label>
                                        <input type="text" placeholder="Otros Diagnósticos" name="EditarDiagnosticoOtros" id="EditarDiagnosticoOtros" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Conducta</label>
                                        <textarea placeholder="Conducta" name="EditarConducta" id="EditarConducta" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remisión y Justificación</label>
                                        <textarea placeholder="Remisión y Justificación" name="EditarRemision" id="EditarRemision" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Optómetra</label>
                                        <select placeholder="Optometra" required name="EditarOptometra" id="EditarOptometra" class="form-control input-sm">
                                            <option value="0">Seleccione</option>
                                            <?php 
                                                $item = null;
                                                $valor = null;
                                                $usuarios = ControladorUsuarios::ctrMostrarOptometras($item, $valor);

                                                foreach ($usuarios as $key => $value) {
                                                    echo "<option value='".$value['usuarios_id_i']."'>".$value['usuarios_nombres_v']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea placeholder="Observaciones" required name="EditarObservaciones" id="EditarObservaciones" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="historias_id_i" id="historias_id_i">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar historia</button>
                </div>
                <?php
                    $crearUsuario = new ControladorHistorias();
                    $crearUsuario->ctrEditarHistorias();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->

<!-- Modal agregar usuario -->
<div id="modalVerHistorias" class="modal fade" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">HISTORIA CLINICA</h4>
                </div>
                <div class="modal-body" id="DatosHistoria">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->


<!-- Modal agregar usuario -->
<div id="modalAgregarNotas" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc;color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">NOTAS</h4>
                </div>
                <div class="modal-body" id="DatosHistoria">
                    <form id="formularioNotas">
                        <div class="form-group">
                            <label>Nombre Responsable</label>
                            <input type="text" name="txtNombreResponsable" id="txtNombreResponsable" class="form-control" placeholder="Nombre Responsable">
                        </div>
                        <div class="form-group">
                            <label>Teléfono Responsable</label>
                            <input type="text" name="txtTelefonoResponsable" maxlength="10" id="txtTelefonoResponsable" class="form-control" placeholder="Teléfono Responsable">
                        </div>
                        <div class="form-group">
                            <label>Parentesco Responsable</label>
                            <input type="text" name="txtParentescoResponsable" id="txtParentescoResponsable" class="form-control" placeholder="Parentesco Responsable">
                        </div>
                        <div class="form-group">
                            <label>Nota</label>
                            <textarea name="txtNota" id="txtNota" class="form-control" placeholder="Nota"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidHistoria" id="hidHistoria" value="0">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="button" id="btnGuardarNota" class="btn btn-primary">Guardar Nota</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Modal -->



<?php 
    $crearPaciente = new ControladorHistorias();
    $crearPaciente->ctrBorrarHistorias();
?>