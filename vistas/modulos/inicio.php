
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Estadísticas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
                                $tabla = 'sys_usuarios';
                                $campos = 'count(*) as total';
                                $condic = '';
                                $respuesta = ModeloDAO::mdlMostrarUnitario($campos, $tabla, $condic);
                                echo $respuesta['total'];
                            ?>
                        </h3>

                        <p>Usuarios del sistema</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
                <!-- small box -->
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
                                $tabla = 'op_pacientes';
                                $campos = 'count(*) as total';
                                $condic = 'pacientes_estado_i = 1';
                                $respuesta = ModeloDAO::mdlMostrarUnitario($campos, $tabla, $condic);
                                echo $respuesta['total'];
                            ?>
                        </h3>

                        <p>Pacientes Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-happy-outline"></i>
                    </div>
                </div>
                <!-- small box -->
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
                                $tabla = 'op_historias';
                                $campos = 'count(*) as total';
                                $condic = '';
                                $respuesta = ModeloDAO::mdlMostrarUnitario($campos, $tabla, $condic);
                                echo $respuesta['total'];
                            ?>
                        </h3>

                        <p>Historias registradas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                </div>
                <!-- small box -->
            </div>

        </div>
        
        <div class="row">
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Estadística por genero</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- Content Wrapper. Contains page content -->
<?php 
    $tabla = 'op_pacientes';
    $campos = 'count(*) as total';
    $condic = "pacientes_sexo_v = 'Femenino' AND pacientes_estado_i = 1";
    $respuestaF = ModeloDAO::mdlMostrarUnitario($campos, $tabla, $condic);

    $tabla = 'op_pacientes';
    $campos = 'count(*) as total';
    $condic = "pacientes_sexo_v = 'Masculino' AND pacientes_estado_i = 1";
    $respuestaM  = ModeloDAO::mdlMostrarUnitario($campos, $tabla, $condic);
    
?>

<script type="text/javaScript">
    $(function () {
        "use strict";
        //DONUT CHART
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: ["#3c8dbc", "#f56954"],
            data: [

                {label: "Femenino", value: <?php echo $respuestaF['total'];?>},
                {label: "Masculino", value: <?php echo $respuestaM['total'];?>}
            ],
            hideHover: 'auto'
        });
    });
</script>