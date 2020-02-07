/*===============================================
= 				SIDEBAR MENU 					=
================================================*/
	$('.sidebar-menu').tree()

/*===============================================
= 				DATATABLES	 					=
================================================*/
	$(".knob").knob();


/*===================================================
=			Ichcek									=
====================================================*/
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});

	$(".numeric").numeric();

$('.tablas').DataTable({
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
    },
    "autoWidth": false,
    "sScrollX": "100%",
    "scrollX" : true
});

$("#btnGuardarConfiguracion").click(function () {
    var nit = $("#ConfNIT").val();
    var direccion = $("#ConfDireccion").val();
    var telefono = $("#ConfTelefono").val();
    var datas = new FormData();
    datas.append('GuardarConfiguracion', nit);
    datas.append('direccion', direccion);
    datas.append('telefono', telefono);
    $.ajax({
        url   : 'ajax/dao.ajax.php',
        method: 'post',
        data  : datas,
        cache : false,
        contentType : false,
        processData : false,
        dataType    : 'text',
        success     : function(data){
            swal({
                    title  : 'Configuracion guardada con exito!',
                    type   : 'success',
                    configButtonText : "Cerrar",
                    closeOnConfirm: true
                }, function(){

                }
            )
        }
    });
});

	
