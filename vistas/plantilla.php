<?php
    session_start();
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);

    if(isset($_GET['exportar'])){
        if($_GET['exportar'] == 'pacientes'){
            include "modulos/exportar/exportar_pacientes.php";
        }else if($_GET['exportar'] == 'historiasImpresion'){
            include "modulos/imprimir/historias.php";
        }else if($_GET['exportar'] == 'FormulaImpresion'){
            include "modulos/imprimir/formulas.php";
        }
    }else{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Optica visión 421</title>
        <!-- Tell the browser to be responsive to screen width -->
        <link rel="shortcut icon" href="vistas/img/plantilla/icono.png">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">

        <!-- DataTables -->
        <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

        <!-- DatePicker -->
        <link rel="stylesheet" type="text/css" href="vistas/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">

        <!-- TimePicket -->
        <link rel="stylesheet" type="text/css" href="vistas/bower_components/bootstrap-timepicker/css/timepicker.less">

        <!-- Taginput -->
        <link rel="stylesheet" type="text/css" href="vistas/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

        <!-- SweetAlert -->
        <link rel="stylesheet" type="text/css" href="vistas/plugins/sweetalert/sweetalert.css">

        <!-- iCheck -->
        <link rel="stylesheet" href="vistas/plugins/iCheck/square/blue.css">

        <!-- parts-selector -->
        <link rel="stylesheet" href="vistas/plugins/parts-selector/parts-selector.css">


        <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">


        <!-- jQuery 3 -->
        <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>  

        <!-- Select2 -->
        <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">
        
        <!-- DataTables -->
        <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
        <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

        <!-- DatePicker -->
        <script type="text/javascript" src="vistas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

        <!-- TimePicker -->
        <script type="text/javascript" src="vistas/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

        <!-- Taginput -->
        <script type="text/javascript" src="vistas/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
      
        <!-- Select2 -->
        <script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>

        <!-- SweetAlert -->
        <script src="vistas/plugins/sweetalert/sweetalert.min.js"></script>

        <!-- AdminLTE App -->
        <script src="vistas/dist/js/adminlte.min.js"></script>

        <!-- jQuery Knob Chart -->
        <script src="vistas/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

        <!-- iCheck -->
        <script src="vistas/plugins/iCheck/icheck.min.js"></script>

        <!-- parts-selector -->
        <script src="vistas/plugins/parts-selector/parts-selector.js"></script>

        <!-- Numerics -->
        <script src="vistas/plugins/numeric/numeric.js"></script>

        <!-- Morris.js charts -->
        <script src="vistas/bower_components/raphael/raphael.min.js"></script>
        <script src="vistas/bower_components/morris.js/morris.min.js"></script>

        <!-- Blokear pr ajax -->
        <script src="vistas/plugins/blockui/blockUi.js"></script>

        <style type="text/css">
            [class^='select2'] {
                border-radius: 0px !important;
                height: 30px;
            }

        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini login-page">
        <?php
            if(isset($_SESSION['iniciarSession']) && $_SESSION['iniciarSession'] == 'ok'){
                echo '<!-- Site wrapper -->
                        <div class="wrapper">';
            /* Header */
            include "modulos/cabezote.php";
            /* vlidar perfil */
            /* Menu */
            include "modulos/menu.php";
             /* Contenido */
            if(isset($_GET['ruta'])){
                switch ($_GET['ruta']) {
                    case 'inicio':
                        include "modulos/inicio.php";
                        echo "<script>$('#menu_inicio').addClass('active');</script>";
                        break;

                    case 'pacientes':
                        include "modulos/pacientes.php";
                        echo "<script>$('#menu_pacientes').addClass('active');</script>";
                        break;

                    case 'historias':
                        include "modulos/historias.php";
                        echo "<script>$('#menu_historias').addClass('active');</script>";
                        break;

                    case 'usuarios':
                        include "modulos/usuarios.php";
                        echo "<script>$('#menu_usuarios').addClass('active');</script>";
                        break;

                    case 'optometra':
                        include "modulos/optometras.php";
                        echo "<script>$('#menu_optometra').addClass('active');</script>";
                        break;

                    case 'salir':
                        include "modulos/salir.php";
                        break;

                    default:
                        include "modulos/404.php";
                        break;
                }
            }else{
                include "modulos/inicio.php";
                echo "<script>$('#menu_inicio').addClass('active');</script>";
            }
            /* Footer */
            include "modulos/footer.php";

            echo "</div>";
        }else{
            if(isset($_GET['ruta'])){
                if($_GET['ruta'] == 'ingreso-pacientes'){
                    include 'modulos/login-pacientes.php';
                }else{
                    include 'modulos/login.php';    
                }
            }else{
                include 'modulos/login.php';
            }
           
            
        }
        ?>
        
        <!-- ./wrapper -->
        <!-- Audios -->

        <script type="text/javascript" src="vistas/js/plantilla.js"></script>
        <script type="text/javascript" src="vistas/js/pacientes.js"></script>
        <script type="text/javascript" src="vistas/js/historias.js"></script>
        <script type="text/javascript" src="vistas/js/usuarios.js"></script>
    </body>
</html>
<?php
    }
?>