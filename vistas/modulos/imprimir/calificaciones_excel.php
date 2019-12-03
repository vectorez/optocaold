<?php
	session_start();
	ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    ini_set('memory_limit','254M');
	require_once '../../../../modelos/dao.modelo.php';
	require_once '../../../../extenciones/Excel.php';

	$objPHPExcel = new PHPExcel();

    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getProperties()->setCreator("CARACTERZICACION APARTADO")
                             ->setLastModifiedBy("".$_SESSION['nombres'])
                             ->setTitle("RESUMEN DE Calificaciones")
                             ->setSubject("Calificaciones HISTORICO")
                             ->setDescription("Descarga del historico de Calificaciones, registrado en el sistema")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Calificaciones");


    $objPHPExcel->getActiveSheet()
    ->getStyle('A1:G1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold( true );
   
    $objPHPExcel->getActiveSheet()->setTitle('Calificaciones');

    $objPHPExcel->getActiveSheet()->setCellValue("A1", "#"); 
    $objPHPExcel->getActiveSheet()->setCellValue("B1", "Funcionario"); 
    $objPHPExcel->getActiveSheet()->setCellValue("C1", "Ciudadano"); 
    $objPHPExcel->getActiveSheet()->setCellValue("D1", "Cédula"); 
    $objPHPExcel->getActiveSheet()->setCellValue("E1", "Edad"); 
    $objPHPExcel->getActiveSheet()->setCellValue("F1", "Fecha"); 
    $objPHPExcel->getActiveSheet()->setCellValue("G1", "Calificación"); 
    $objPHPExcel->getActiveSheet()->setCellValue("H1", "Medio Calificación"); 

    $campos = "date_format(cal_fecha,('%Y-%m-%d')) as cal_fecha, CONCAT(ciu_nombres, ' ', ciu_apellidos) as ciudadano, ciu_cedula,ciu_fecha_nac, ciu_sexo,  ciu_rh, TIMESTAMPDIFF(YEAR, ciu_fecha_nac, CURDATE()) as edad_Promedio, cal_calificacion, cal_observacion, CONCAT(fun_nombres, ' ', fun_apellidos) as funcionario, cal_id, med_descripcion";
    $tabla = "vc_calificacion JOIN vc_ciudadano ON ciu_id = cal_ciu_id JOIN vc_funcionarios ON fun_id = cal_fun_id JOIN vc_medios ON med_id = cal_med_id ";
    $condiciones = '1 = 1';

    if(isset($_POST['fecha1']) && $_POST['fecha1'] != '' && isset($_POST['fecha2']) && $_POST['fecha2'] != '' ){
        $condiciones .= " AND cal_fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."'";
    }
    $order = " ORDER BY cal_fecha  ASC";
    //echo "SELECT ".$campos." FROM ".$tabla." WHERE ".$condiciones.$order.$limit;
    $query = ModeloDAO::mdlMostrarGroupAndOrder($campos, $tabla, $condiciones, '', $order, '');
    $i = 2;
    foreach ($query as $key => $row) {
        $objPHPExcel->getActiveSheet()->setCellValue("A".$i, ($key+1)); 
        $objPHPExcel->getActiveSheet()->setCellValue("B".$i, $row["funcionario"]); 
        $objPHPExcel->getActiveSheet()->setCellValue("C".$i, $row["ciudadano"]);
        $objPHPExcel->getActiveSheet()->setCellValue("D".$i, $row["ciu_cedula"]); 
        $objPHPExcel->getActiveSheet()->setCellValue("E".$i, $row["edad_Promedio"]); 
        $objPHPExcel->getActiveSheet()->setCellValue("F".$i, $row["cal_fecha"]); 
        $objPHPExcel->getActiveSheet()->setCellValue("G".$i, mb_strtolower($row["cal_calificacion"])); 
        $objPHPExcel->getActiveSheet()->setCellValue("H".$i, mb_strtolower($row["med_descripcion"])); 
    }

    ob_start();
    $writer->save("php://output");
    $xlsData = ob_get_contents();
    ob_end_clean(); 

    $response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
    );

    echo json_encode($response);