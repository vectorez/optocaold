var edicion = '';
if($("#editar").val() == '1'){
    edicion = '<button class="btn btn-warning btnEditarhistoria" title="Editar Historia" id_historia data-toggle="modal" data-target="#modalEditarHistoria"><i class="fa fa-pencil"></i></button>';
}

var eliminacion = '';
if($("#elimina").val() == '1'){
    eliminacion = '<button class="btn btn-danger btnEliminarHistoria" title="Eliminar Historia" id_historia codigo imagen><i class="fa fa-times"></i></button>';
}
//
var tableY = $('#tablaHistorias').DataTable({
    "ajax": 'ajax/historias.ajax.php?damehistorias=true',
    "columnDefs": [
        {
            "targets": -1,
            "data": null,
            "defaultContent": edicion+'&nbsp;'+ eliminacion +'&nbsp;<button class="btn btn-primary btnImprimirHistoria" title="Imprimir Historia" id_historia><i class="fa fa-print"></i></button>&nbsp;<button class="btn btn-info btnImprimirSoloFormula" title="Imprimir Solo FOrmula" id_historia><i class="fa fa-print"></i></button>'
        }
    ],
    "language" : {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    } 
});


$('#tablaHistorias tbody').on( 'click', 'button', function () {
    var dataY = tableY.row( $(this).parents('tr') ).data();
    $(this).attr("id_historia", dataY[8]);
});

/* Editar Empleados */
$('#tablaHistorias tbody').on("click", ".btnEditarhistoria", function(){
    var x = $(this).attr('id_historia');
    var datas = new FormData();
    datas.append('EditarHistoriasId', x);
    $.ajax({
        url   : 'ajax/historias.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(data){

            $("#EditarTipoDoc").val(data.pacientes_tipo_doc_v);
            $("#EditarTipoDoc").val(data.pacientes_tipo_doc_v).change();
            $("#EditarDocumento").val(data.pacientes_documento_v);
            $("#EditarNombre").val(data.pacientes_nombres_v);
            $("#EditarApellido").val(data.pacientes_apellidos_v);
            $("#EditarLugarResidencia").val(data.pacientes_lugar_recidencia_v);
            $("#EditarDireccion").val(data.pacientes_direccion_v);
            $("#EditarTelefono").val(data.pacientes_telefono_v);
            $("#EditarOcupacion").val(data.pacientes_ocupacion_v);
            $("#EditarGenero").val(data.pacientes_sexo_v);
            $("#EditarGenero").val(data.pacientes_sexo_v).change();
            $("#EditarFechaNac").val(data.pacientes_fecha_nacimiento_d);
            $("#EditarEstadoCivil").val(data.pacientes_estado_civil_v);
            $("#EditarEstadoCivil").val(data.pacientes_estado_civil_v).change();
            $("#EditarPacientes_id_i").val(data.pacientes_id_i);
            $("#historias_id_i").val(data.historias_id_i);

            /* Dtaos adicionales */
            $("#EditarAcompanante").val(data.historias_acudiente_v);
            $("#EditarTelefonoAconpanante").val(data.historias_telefono_acudiente_v);
            $("#EditarParentesco").val(data.historia_prentesco_v);
            $("#EditarAseguradora").val(data.historias_aseguradora_v);
            $("#EditarTipoAfiliacion").val(data.historias_tipo_afiliacion_v);
            $("#EditarTipoAfiliacion").val(data.historias_tipo_afiliacion_v).change();
            $("#EditarSemanasCotizadas").val(data.historias_semanas_cotizadas);
        
            /* Antecedentes */
            $("#EditarAnamnesis").val(data.historias_anamnesis_v);
            $("#EditarAntecedentesOftalmologicos").val(data.historias_antecedentes_oftalmologicos_v);
            $("#EditarAntecedentesPersonales").val(data.historia_antecedentes_personales_v);
            $("#EditarAntecedetesFamiliares").val(data.historias_antecedentes_familiares);

            /* Información de lentes  */
            $("#EditarTipoLenteEnUso").val(data.historia_tipo_lente_v);

            /*Agudesa Visual */
            $("#EditarSinCorreccionOD").val(data.historias_sin_correcion_od_v);
            $("#EditarConCorreccionOD").val(data.historias_con_correcion_od_v);
            $("#EditarConEstenopeicoOD").val(data.historias_con_estenopeico_od_v);
            $("#EditarSinCorreccionID").val(data.historias_sin_correcion_id_v);
            $("#EditarConCorreccionID").val(data.historias_con_correcion_id_v);
            $("#EditarConEstenopeicoID").val(data.historias_con_estenopeico_id_v);

            $("#EditarOftalmoscopia").val(data.historias_oftalmoscopia_v);
            $("#EditarExcavacionOD").val(data.historias_excavacion_od_v);
            $("#EditarReflejosPulpiresOD").val(data.historias_reflejos_pulpilres_v);
            $("#EditarMotilidadOcular").val(data.historias_motilidad_ocular_v);
            $("#EditarVlOrtoforia").val(data.historias_ortoforia_vl_v);
            $("#EditarVpOrtoforia").val(data.historias_ortoforia_vp_v);


            /* Formula Final */
            $("#EditarBiomocrospia").val(data.historias_biomocrospia_v);
            $("#EditarExamenesComplementarios").val(data.historias_examenes_complementarios_v);
            $("#EditarQueratometriaOD").val(data.historias_queratometria_od_v);
            $("#EditarQueratometriaID").val(data.historias_queratometria_id_v);
            $("#EditarTonometriaOD").val(data.historias_tonometria_od_v);
            $("#EditarTonometriaID").val(data.historias_tonometria_oi_v);
            $("#EditarTipoTonometro").val(data.historias_tipo_tonometro_v);
            $("#EditarTestAcomodativo").val(data.historias_test_acomodativo_v);
            $("#EditarResultadoTestAcomo").val(data.historias_resultado_v);
            $("#EditarTestAmsier").val(data.historias_test_amsier_v);
            $("#EditarTestColor").val(data.historias_test_color_v);
            $("#EditarTestEstereopsis").val(data.historias_test_estereopsis_v);
            $("#EditarDescripcionX").val(data.historias_descripcion_v);

            /* Diagnosticos */
            $("#EditarDiagnosticoPrincipal").val(data.historias_diagnostico_principal_v);
            $("#EditarDiagnosticoSecundario").val(data.historias_diagnostico_segundario_v);
            $("#EditarDiagnosticoOtros").val(data.historias_otros_diagnosticos_v);
            $("#EditarConducta").val(data.historias_conducta_v);
            $("#EditarRemision").val(data.historias_remision_justi_v);
            $("#EditarOptometra").val(data.historias_optometra_v);
            $("#EditarOptometra").val(data.historias_optometra_v).change();
        }
    });

    var datas = new FormData();
    datas.append('getDatosByHistoriasId', x);
    datas.append('tipoDato', 'Lensometria');
    $.ajax({
        url   : 'ajax/historias.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(data){
            $.each(data, function (i, item) { 
                if(item.auxiliares_od_id_v == 'OD'){
                    $("#EditarEsferaOD").val(item.auxiliares_esfera_v);
                    $("#EditarCilindroOD").val(item.auxiliares_cilindro_v);
                    $("#EditarEjeOD").val(item.auxiliares_eje_v);
                    $("#EditarAddOD").val(item.auxiliares_add_v);
                }else{
                    $("#EditarEsferaID").val(item.auxiliares_esfera_v);
                    $("#EditarCilindroID").val(item.auxiliares_cilindro_v);
                    $("#EditarEjeID").val(item.auxiliares_eje_v);
                    $("#EditarAddID").val(item.auxiliares_add_v);
                }
            });
        }
    });


    var datas = new FormData();
    datas.append('getDatosByHistoriasId', x);
    datas.append('tipoDato', 'Retinoscopia');
    $.ajax({
        url   : 'ajax/historias.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(data){
            $.each(data, function (i, item) { 
                if(item.auxiliares_od_id_v == 'OD'){
                    $("#EditarEsferaRetinosOD").val(item.auxiliares_esfera_v);
                    $("#EditarCilindroRetinosOD").val(item.auxiliares_cilindro_v);
                    $("#EditarEjeRetinosOD").val(item.auxiliares_eje_v);
                    $("#EditarAddRetinosOD").val(item.auxiliares_add_v);
                }else{
                    $("#EditarEsferaRetinosID").val(item.auxiliares_esfera_v);
                    $("#EditarCilindroRetinosID").val(item.auxiliares_cilindro_v);
                    $("#EditarEjeRetinosID").val(item.auxiliares_eje_v);
                    $("#EditarAddRetinosID").val(item.auxiliares_add_v);
                }
            });
        }
    });


    var datas = new FormData();
    datas.append('getDatosByHistoriasId', x);
    datas.append('tipoDato', 'Formula');
    $.ajax({
        url   : 'ajax/historias.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(data){
            $.each(data, function (i, item) { 
                if(item.auxiliares_od_id_v == 'OD'){
                    $("#EditarEsferaFormulaFinalOD").val(item.auxiliares_esfera_v);
                    $("#EditarCilindroFormulaFinalOD").val(item.auxiliares_cilindro_v);
                    $("#EditarEjeFormulaFinalOD").val(item.auxiliares_eje_v);
                    $("#EditarAddFormulaFinalOD").val(item.auxiliares_add_v);
                    $("#EditarAvFormulaFinalOD").val(item.auxiliares_av_v);
                    $("#EditarDpFormulaFinalOD").val(item.auxiliares_dp_v);
                }else{
                    $("#EditarEsferaFormulaFinalID").val(item.auxiliares_esfera_v);
                    $("#EditarCilindroFormulaFinalID").val(item.auxiliares_cilindro_v);
                    $("#EditarEjeFormulaFinalID").val(item.auxiliares_eje_v);
                    $("#EditarAddFormulaFinalID").val(item.auxiliares_add_v);
                    $("#EditarAvFormulaFinalID").val(item.auxiliares_av_v);
                    $("#EditarDpFormulaFinalID").val(item.auxiliares_dp_v);
                }
            });
        }
    });

});


/* Eliminar Empleados */
$('#tablaHistorias tbody').on("click", ".btnEliminarHistoria", function(){
    var x = $(this).attr('id_historia');
    swal({
        title: '¿Está seguro de borrar esta historia?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar historia!'
    },function(isConfirm) {
        if (isConfirm) {
            window.location = "index.php?ruta=historias&id_historia="+x;
        }
    })
});




/* Imprimir */
$('#tablaHistorias tbody').on("click", ".btnImprimirHistoria", function(){
    //console.log('Si haces click');
    var idUsuario = $(this).attr('id_historia'); 
    window.open('index.php?exportar=historiasImpresion&id_historia='+idUsuario, '_blank');
});


/* Imprimir */
$('#tablaHistorias tbody').on("click", ".btnImprimirSoloFormula", function(){
    //console.log('Si haces click');
    var idUsuario = $(this).attr('id_historia'); 
    window.open('index.php?exportar=FormulaImpresion&id_historia='+idUsuario, '_blank');
});



$.fn.datepicker.dates['es'] = {
    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Today",
    clear: "Clear",
    format: "yyyy-mm-dd", 
    weekStart: 0
};

$("#NuevoFechaNac").datepicker({
    language: "es",
    autoclose: true,
    todayHighlight: true
});

$("#EditarFechaNac").datepicker({
    language: "es",
    autoclose: true,
    todayHighlight: true
});

$("#NuevoDocumentoH").change(function(){
    var usuario = $(this).val();
    var datos = new FormData();
    datos.append('validarCC', usuario);
    $.ajax({
        url   : 'ajax/pacientes.ajax.php',
        method: 'post',
        data  : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(respuesta){
            if(respuesta != false){
                $("#NuevoTipoDoc").val(respuesta.pacientes_tipo_doc_v);
                $("#NuevoTipoDoc").val(respuesta.pacientes_tipo_doc_v).change();
                $("#NuevoNombre").val(respuesta.pacientes_nombres_v);
                $("#NuevoApellido").val(respuesta.pacientes_apellidos_v);
                $("#NuevoOcupacion").val(respuesta.pacientes_ocupacion_v);
                $("#NuevoTelefono").val(respuesta.pacientes_telefono_v);
                $("#NuevoLugarResidencia").val(respuesta.pacientes_lugar_recidencia_v);
                $("#NuevoDireccion").val(respuesta.pacientes_direccion_v);
                $("#NuevoGenero").val(respuesta.pacientes_sexo_v);
                $("#NuevoGenero").val(respuesta.pacientes_sexo_v).change();
                $("#NuevoFechaNac").val(respuesta.pacientes_fecha_nacimiento_d);
                $("#NuevoEstadoCivil").val(respuesta.pacientes_estado_civil_v);
                $("#NuevoEstadoCivil").val(respuesta.pacientes_estado_civil_v).change();
                $("#DocumentoExiste").val(respuesta.pacientes_id_i);

                $("#NuevoTipoDoc").attr('disabled', true);
                $("#NuevoNombre").attr('disabled', true);
                $("#NuevoApellido").attr('disabled', true);
                $("#NuevoOcupacion").attr('disabled', true);
                $("#NuevoTelefono").attr('disabled', true);
                $("#NuevoLugarResidencia").attr('disabled', true);
                $("#NuevoDireccion").attr('disabled', true);
                $("#NuevoGenero").attr('disabled', true);
                $("#NuevoFechaNac").attr('disabled', true);
                $("#NuevoEstadoCivil").attr('disabled', true);
        
            }else{

                $("#NuevoTipoDoc").attr('disabled', false);
                $("#NuevoNombre").attr('disabled', false);
                $("#NuevoApellido").attr('disabled', false);
                $("#NuevoOcupacion").attr('disabled', false);
                $("#NuevoTelefono").attr('disabled', false);
                $("#NuevoLugarResidencia").attr('disabled', false);
                $("#NuevoDireccion").attr('disabled', false);
                $("#NuevoGenero").attr('disabled', false);
                $("#NuevoFechaNac").attr('disabled', false);
                $("#NuevoEstadoCivil").attr('disabled', false);

            }
        }

    })
});