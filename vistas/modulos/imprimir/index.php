
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Historico 
            <small>Calificaciones registradas en el sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="inicio"><i class="fa fa-file-pdf-o"></i> Reportes</a></li>
            <li class="active">Historico calificaciones</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Filtros</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar-o"></i>
                                </span>
                                
                                <input class="form-control fecha" type="text" name="NuevoFechaInicio" id="NuevoFechaInicio2" placeholder="Ingresar Fecha Inicio" required="true">
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar-o"></i>
                                </span>
                                <input class="form-control fecha" type="text" name="NuevoFechaInicio" id="NuevoFechaInicio3" placeholder="Ingresar Fecha Final" required="true">
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="button" id="btnBuscarRangos_general"><i class="fa fa-search"></i>&nbsp;Buscar</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="button" id="btnExportarRangos_general"><i class="fa fa-file-o"></i>&nbsp;Exportar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h3 class="box-title">RESULTADO CALIFICACIONES REGISTRADAS</h3>
                    </div>
                    <div class="box-body" id="resultados">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function(){
        registrarCalificaciones();

        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-mm-dd", 
            weekStart: 0
        };

        $("#NuevoFechaInicio2").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#NuevoFechaInicio3').datepicker('setStartDate', minDate);
        });


        $("#NuevoFechaInicio3").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });



        $("#btnBuscarRangos_general").click(function(){
            var fechaInicio = $("#NuevoFechaInicio2").val();
            var fechaFinal = $("#NuevoFechaInicio3").val();
            var paso = 0;
            if(fechaInicio.length < 0){
                paso = 1;
                swal({
                    title : "Error al buscar",
                    text  : "La fecha inicial es necesaria",
                    type  : "error",
                    confirmButtonText : "Cerrar"
                });

            }   

            if(fechaFinal.length < 0){
                paso = 1;
                swal({
                    title : "Error al buscar",
                    text  : "La fecha final es necesaria",
                    type  : "error",
                    confirmButtonText : "Cerrar"
                });

            }  

            if(paso == 0){
                registrarCalificaciones();
            }
        });

        $("#btnExportarRangos_general").click(function(){
            exportarDatosGerencial();
        });

    });

    function registrarCalificaciones(){
        var fechaInicio = $("#NuevoFechaInicio2").val();
        var fechaFinal = $("#NuevoFechaInicio3").val();
        $.ajax({
            url    : 'vistas/modulos/Reportes/calificaciones/calificaciones_filtrado.php',
            type   : 'post',
            data   :{
                fecha1    : fechaInicio,
                fecha2   : fechaFinal
            },
            dataType : 'html',
            beforeSend:function(){
                $.blockUI({ 
                    message : "<h3>Un momento por favor...</h3>",
                    baseZ: 2000,
                    css: { 
                        border: 'none', 
                        padding: '1px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff'
                    } 
                }); 
            },
            complete:function(){
                $.unblockUI();
            },
            success : function(data){
                $("#resultados").html(data);
                
            }
        })
    }

    function exportarDatosGerencial(){
        var fechaInicio = $("#NuevoFechaInicio2").val();
        var fechaFinal = $("#NuevoFechaInicio3").val();
        var paso = 0;
        if(fechaInicio.length < 0){
            paso = 1;
            swal({
                title : "Error al buscar",
                text  : "La fecha inicial es necesaria",
                type  : "error",
                confirmButtonText : "Cerrar"
            });

        }   

        if(fechaFinal.length < 0){
            paso = 1;
            swal({
                title : "Error al buscar",
                text  : "La fecha final es necesaria",
                type  : "error",
                confirmButtonText : "Cerrar"
            });

        } 

        if(paso == 0){
            $.ajax({
                url    : 'vistas/modulos/Reportes/calificaciones/calificaciones_excel.php',
                type   : 'post',
                data   :{
                    fecha1   : fechaInicio,
                    fecha2   : fechaFinal
                },
                cache : false,
                contentType : false,
                processData : false,
                dataType    : 'json',
                beforeSend:function(){
                    $.blockUI({ 
                        message : "<h3>Un momento por favor...</h3>",
                        baseZ: 2000,
                        css: { 
                            border: 'none', 
                            padding: '1px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff'
                        } 
                    }); 
                },
                complete:function(){
                    $.unblockUI();
                },
                success : function(data){
                   var currentdate = new Date();
                    var fecha_hora = currentdate.getFullYear() + rellenar((currentdate.getMonth()+1), 2) +  rellenar(currentdate.getDate(), 2) + "_" + rellenar(currentdate.getHours(), 2) +  rellenar(currentdate.getMinutes(), 2) + rellenar(currentdate.getSeconds(), 2);
                    var $a = $("<a>");
                    $a.attr("href",data.file);
                    $("body").append($a);
                    $a.attr("download","Calificaciones_historico"+fecha_hora+".xlsx");
                    $a[0].click();
                    $a.remove();
                }
            })
        }

    } 

    function rellenar (str, max) {
        str = str.toString();
        return str.length < max ? rellenar("0" + str, max) : str;
    }
    
</script>
