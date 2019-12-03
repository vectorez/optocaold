
/* Editar Empleados */
$('#tablaPacientes tbody').on("click", ".btnEditarPaciente", function(){
    var x = $(this).attr('id_Paciente');
    var datas = new FormData();
    datas.append('EditarPacienteId', x);
    $.ajax({
        url   : 'ajax/pacientes.ajax.php',
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
        }
    });
});


/* Eliminar Empleados */
$('#tablaPacientes tbody').on("click", ".btnEliminarPaciente", function(){
    var x = $(this).attr('id_Paciente');
    swal({
        title: '¿Está seguro de borrar este paciente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar paciente!'
    },function(isConfirm) {
        if (isConfirm) {
            window.location = "index.php?ruta=pacientes&id_Paciente="+x;
        }
    })
});

$("#btnNuevoPaciente").click(function(){
    $(".alert").remove();
});

/* validar que el Nit no esta repetido */
$("#NuevoDocumento").change(function(){
    $(".alert").remove();
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
                $("#NuevoDocumento").parent().after('<div class="alert alert-danger">Esta identificación ya existe</div>');
                $("#NuevoDocumento").val('');
            }
        }

    })
});


/* Activar Empleados */
/*$('#tablaPacientes tbody').on("click", ".btnDocumentosEmpleado", function(){
    var idUsuario = $(this).attr('id_Paciente');
    var datos = new FormData();
    datos.append("EditarEmpleadoId", idUsuario);
    $.ajax({
        url  : 'ajax/empleados.ajax.php',
        type : 'post',
        data : datos,
        cache: false,
        contentType:false,
        dataType : 'json',
        processData : false,
        success: function(data){

            if(data.emd_ruta_cedula != null && data.emd_ruta_cedula != ''){
                tipoArchivo  =  data.emd_ruta_cedula.split('.')[1];
                if(tipoArchivo == 'pdf'){
                    $("#cedula").attr('href' , data.emd_ruta_cedula);
                    $(".previsualizar_M").attr('src', 'vistas/img/plantilla/pdf.png');
                }else{
                    $("#cedula").attr('href' , data.emd_ruta_cedula);
                    $(".previsualizar_M").attr('src', data.emd_ruta_cedula);
                }
            }

            if(data.emd_ruta_otro != null && data.emd_ruta_otro != ''){
                tipoArchivo  = data.emd_ruta_otro.split('.')[1];
                if(tipoArchivo == 'pdf'){
                    $("#cedula").attr('href' , data.emd_ruta_otro);
                    $(".previsualizar_M").attr('src', 'vistas/img/plantilla/pdf.png');
                }else{
                    $("#cedula").attr('href' , data.emd_ruta_cedula);
                    $(".previsualizar_2_M").attr('src', data.emd_ruta_otro);
                }
            }
        }
    });
});*/




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
