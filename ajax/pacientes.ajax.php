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