/* validar los tipos de imagenes y/o archivos */
$(".NuevaFotos").change(function(){
    var imax = $(this).attr('valor');
    var imagen = this.files[0];
    //console.log(imagen);
    /* Validar el tipo de imagen */
    if(imagen['type'] != 'image/jpeg' && imagen['type'] != 'image/png'  ){
        $(".NuevaFoto").val('');
        swal({
            title : "Error al subir el archivo",
            text  : "El archivo debe estar en formato PNG , JPG",
            type  : "error",
            confirmButtonText : "Cerrar"
        });
    }else if(imagen['size'] > 2000000 ) {
        $(".NuevaFoto").val('');
        swal({
            title : "Error al subir el archivo",
            text  : "El archivo no debe pesar mas de 2MB",
            type  : "error",
            confirmButtonText : "Cerrar"
        });
    }else{
        if(imagen['type'] == 'image/jpeg' || imagen['type'] == 'image/png'){
            var datosImagen = new FileReader();
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on("load", function(event){
                var rutaimagen = event.target.result;
                $(".previsualizar").attr('src', rutaimagen);
            }); 
        }
        
    }   
});

/*===============================================
=               DATATABLES                      =
================================================*/
$('#tablaUsuarios').DataTable({
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

$('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
});


$('#tablaUsuarios tbody').on("click", ".btnEditarUsuarios" , function(){
    var x = $(this).attr('idUsuario');
    var datas = new FormData();
    datas.append('EditarUsuarioId', x);
    $.ajax({
        url   : 'ajax/usuarios.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(data){
            $("#EditarNombre").val(data.usuarios_nombres_v); 
            $("#EditarCorreo").val(data.usuarios_email_v);  
            $("#EditarPerfil").val(data.usuarios_perfil_id_i);        
            $("#EditarPerfil").val(data.usuarios_perfil_id_i).change();
            $("#passwordActual").val(data.usuarios_contrasena_v);
            $("#EditarUserID").val(data.usuarios_id_i);

            if(data.usuarios_foto != '' && data.usuarios_foto != null ){
                $(".previsualizar").attr('src', data.usuarios_foto);
                $("#fotoActual").val(data.usuarios_foto);
            }else{
                $(".previsualizar").attr('src', 'vistas/img/usuarios/default/anonymous.png');
            }
       }

    });
});


$('#tablaUsuarios tbody').on("click", ".btnEditarOptometra" , function(){
    var x = $(this).attr('idUsuario');
    var datas = new FormData();
    datas.append('EditarUsuarioId', x);
    $.ajax({
        url   : 'ajax/usuarios.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'json',
        success     : function(data){
            $("#EditarNombre").val(data.usuarios_nombres_v); 
            $("#EditarCorreo").val(data.usuarios_email_v);  
            $("#EditarCedula").val(data.usuarios_cedula_v);        
            $("#EditarTelefono").val(data.usuarios_telefono_v);
            $("#EditarTarjetaProfesional").val(data.usuarios_tarjeta_v);
            $("#EditarUserID").val(data.usuarios_id_i);

            if(data.usuarios_firma_v != '' && data.usuarios_firma_v != null ){
                $(".previsualizar").attr('src', data.usuarios_firma_v);
                $("#FotoActual").val(data.usuarios_firma_v);
            }else{
                $(".previsualizar").attr('src', 'vistas/img/usuarios/default/anonymous.png');
            }
       }

    });
});


/* Eliminar usuarios */
$('#tablaUsuarios tbody').on("click", ".btnEiminarUsuarios", function(){
    var x = $(this).attr('idUsuario');
    swal({
        title: '¿Está seguro de borrar el usuario?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d73925',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    },function(isConfirm) {
        if (isConfirm) {
            window.location = "index.php?ruta=usuarios&id_Usuario="+x ;
        }
    })
});


/* Activar usuarios */
$('#tablaUsuarios tbody').on("click", ".btnActivar", function(){
    var idUsuario = $(this).attr('idUsuario');
    var estado = $(this).attr('estado');
    var datos = new FormData();
    datos.append("ActivarId", idUsuario);
    datos.append("estado", estado);
    $.ajax({
        url  : 'ajax/usuarios.ajax.php',
        type : 'post',
        data : datos,
        cache: false,
        contentType:false,
        processData : false,
        success: function(data){
            
        }
    });

    if(estado == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estado', 1);
    }else{
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activado');
        $(this).attr('estado', 0);
    }
});