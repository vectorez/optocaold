<?php
	require_once '../controladores/pacientes.controlador.php';
	require_once '../modelos/pacientes.modelo.php';
	require_once '../modelos/dao.modelo.php';

	/**
	* Clase para utilizar con Ajax MVC
	*/
	class AjaxPacientes
	{
		public $id_paciente;
		public $validaPaciente;

		public function ajaxEditarPaciente(){
			$item = 'pacientes_id_i';
			$valor = $this->id_paciente;
			$respuesta = controladorPacientes::ctrMostrarPacientes($item, $valor);
			echo json_encode($respuesta);
		}

		private function getEdad($fecha){
			$cumpleanos = new DateTime($fecha);
		    $hoy = new DateTime();
		    $annos = $hoy->diff($cumpleanos);
		    return $annos->y;
		}

		public function ajaxGetPacientes(){
			$item = NULL;
			$valor = NULL;
			$i = 0;
echo '{
  	"data" : [';
			$respuesta = controladorPacientes::ctrMostrarPacientes($item, $valor);
			foreach ($respuesta as $key => $value) {
            	if($i != 0){
            		echo ",";
            	}
	echo '[';
	echo '"'.($key+1).'",';
	echo '"'.($value["pacientes_nombres_v"].' '.$value["pacientes_apellidos_v"]).'",';
	
	if($value["pacientes_tipo_doc_v"] == 'C.C'){
		echo '"Cédula de ciudadania",';
	}else if($value["pacientes_tipo_doc_v"] == 'C.E'){
		echo '"Cédula de extranjería",';
	}else if($value["pacientes_tipo_doc_v"] == 'R.C'){
		echo '"Registro civil",';
	}else if($value["pacientes_tipo_doc_v"] == 'T.I'){
		echo '"Tarjeta de identidad",';
	}else if($value["pacientes_tipo_doc_v"] == 'OTRO'){
		echo '"Otro",';
	}
	
	echo '"'.($value["pacientes_documento_v"]).'",';
	echo '"'.$value["pacientes_telefono_v"].'",';   
	echo '"'.$value["pacientes_ocupacion_v"].'",'; 
	echo '"'.$this->getEdad($value["pacientes_fecha_nacimiento_d"]).'",';
	echo '"'.$value["pacientes_id_i"].'"'; 
	echo ']';
				$i++;

        	}	
echo ']
}';
		}

		/* validar que el paciente no este repetido */
		public function ajaxValidarPaciente(){
			$item = 'pacientes_documento_v';
			$valor = $this->validaPaciente;
			$respuesta = controladorPacientes::ctrMostrarPacientes($item, $valor);
			echo json_encode($respuesta);
		}

	}

	if(isset($_GET['damepacientes'])){
		$editar = new AjaxPacientes();
		$editar->ajaxGetPacientes();
	}

	if(isset($_POST['EditarPacienteId'])){
		if($_POST['EditarPacienteId'] != ''){
			$editar = new AjaxPacientes();
			$editar->id_paciente = $_POST['EditarPacienteId'];
			$editar->ajaxEditarPaciente();
		}	
	}

	if(isset($_POST['validarCC'])){
		$editar = new AjaxPacientes();
		$editar->validaPaciente = $_POST['validarCC'];
		$editar->ajaxValidarPaciente();
	}

	if(isset($_FILES['CargueExcelPacientes'])){
		$ruta = $_FILES['CargueExcelPacientes']['tmp_name'];
		$archivo = $ruta;
		//se abre el archivo excel
		require_once '../vistas/plugins/PHPExcel-1.8/Classes/PHPExcel.php';
		$inputFileType = PHPExcel_IOFactory::identify($archivo);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($archivo);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$count_insert = 0;
		$tabla = 'op_pacientes';
		for ($row = 1; $row <= $highestRow; $row++){
			//seteamos variables
			$tipo_doc = "A".$row;
			$documento= "B".$row;
			$nombres = "C".$row;
			$apellidos = "D".$row;
			$estado_civil = "E".$row;
			$fecha_naciemiento = "F".$row;
			$sexo = "G".$row;
			$ocupacion = "H".$row;
			$lugar_residencia = "I".$row;
			$direccion = "J".$row;
			$telefono = "K".$row;
			$tipo_doc = $sheet->getCell($tipo_doc)->getValue();
			$documento = $sheet->getCell($documento)->getValue();
			$nombres = $sheet->getCell($nombres)->getValue();
			$apellidos = $sheet->getCell($apellidos)->getValue();
			$estado_civil = $sheet->getCell($estado_civil)->getValue();
			if(PHPExcel_Shared_Date::isDateTime($sheet->getCell($fecha_naciemiento))) {
                $fecha_naciemiento = $sheet->getCell($fecha_naciemiento)->getFormattedValue();
            }else{
                $fecha_naciemiento = $sheet->getCell($fecha_naciemiento)->getValue();
            }
			$sexo = $sheet->getCell($sexo)->getValue();
			$ocupacion = $sheet->getCell($ocupacion)->getValue();
			$lugar_residencia = $sheet->getCell($lugar_residencia)->getValue();
			$direccion = $sheet->getCell($direccion)->getValue();
			$telefono = $sheet->getCell($telefono)->getValue();
			$campos = 'pacientes_tipo_doc_v, pacientes_documento_v, pacientes_nombres_v, pacientes_apellidos_v,pacientes_estado_civil_v,pacientes_fecha_nacimiento_d,pacientes_sexo_v,pacientes_ocupacion_v,pacientes_lugar_recidencia_v,pacientes_direccion_v,pacientes_telefono_v,pacientes_estado_i';
			$valores = "'".$tipo_doc."','".$documento."','".$nombres."','".$apellidos."','".$estado_civil."','".$fecha_naciemiento."','".$sexo."','".$ocupacion."','".$lugar_residencia."','".$direccion."','".$telefono."',1";
			$resultado = ModeloDAO::mdlCrear($tabla, $campos, $valores);
			$count_insert++;
		}
		echo 'Insertados: '.$count_insert;
	}else if(!isset($_FILES['CargueExcelPacientes']) && isset($_POST['CargarPacientes'])){
		echo 'error';
	}