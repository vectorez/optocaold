<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-hover" id="tableHistoricoC">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Funcionario</th>
                            <th>Ciudadano</th>
                            <th>Cédula</th>
                            <th>Edad</th>
                            <th>Fecha</th>
                            <th>Calificación</th>
                            <th>Medio Calificación</th>
                        </tr>   
                    </thead>
                    <tbody>
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Funcionario</th>
                            <th>Ciudadano</th>
                            <th>Cédula</th>
                            <th>Edad</th>
                            <th>Fecha</th>
                            <th>Calificación</th>
                            <th>Medio Calificación</th>
                        </tr>   
                    </tfoot>
                </table>    
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
	$("#tableHistoricoC").dataTable({
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": "ajax/reportes.ajax.php?getDataCalificaciones=true",
            "type": "POST",
            "data":{
                fecha1   : '<?php echo $_POST['fecha1'];?>',
                fecha2   : '<?php echo $_POST['fecha2'];?>',
            }
        },
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
</script>