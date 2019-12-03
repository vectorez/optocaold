<?php
	session_start();
	require_once '../controladores/historias.controlador.php';
	require_once '../modelos/historias.modelo.php';
	require_once '../modelos/dao.modelo.php';

	/**
	* Clase para utilizar con Ajax MVC
	*/
	class AjaxHistorias
	{
		public $id_historia;
		public $validaPaciente;
		public $tipoDato;

		public function ajaxEditarHistorias(){
			$item = 'historias_id_i';
			$valor = $this->id_historia;
			$respuesta = ControladorHistorias::ctrMostrarHistorias($item, $valor);
			echo json_encode($respuesta);
		}

		public function ajaxGetAuxiliaresHistorias(){
			$item = 'auxiliares_historia_id_i';
			$valor = $this->id_historia;
			$valor2 = $this->tipoDato;
			$respuesta = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);
			echo json_encode($respuesta);
		}

		private function getEdad($fecha){
			$cumpleanos = new DateTime($fecha);
		    $hoy = new DateTime();
		    $annos = $hoy->diff($cumpleanos);
		    return $annos->y;
		}

		public function ajaxGetHistorias(){
			$campos = "historias_id_i, CONCAT(pacientes_nombres_v,' ',pacientes_apellidos_v) as nombre, pacientes_documento_v, pacientes_telefono_v, TIMESTAMPDIFF(YEAR,pacientes_fecha_nacimiento_d,CURDATE()) as fecha_nacimiento, DATE_FORMAT(historias_fecha_d, '%Y-%m-%d') as fecha, historias_numero_v, usuarios_nombres_v, historias_id_i";
			$tabla = "op_historias LEFT JOIN op_pacientes ON pacientes_id_i = historias_paciente_id_i LEFT JOIN sys_usuarios ON historias_optometra_v = usuarios_id_i";
			$condicion = "1=1";
			$respuesta = ModeloDAO::mdlMostrar($campos, $tabla, $condicion);
			echo json_encode($respuesta);
		}


	}

	if(isset($_GET['damehistorias'])){
		$editar = new AjaxHistorias();
		$editar->ajaxGetHistorias();
	}

	if(isset($_POST['EditarHistoriasId'])){
		if($_POST['EditarHistoriasId'] != ''){
			$editar = new AjaxHistorias();
			$editar->id_historia = $_POST['EditarHistoriasId'];
			$editar->ajaxEditarHistorias();
		}	
	}


	if(isset($_POST['getDatosByHistoriasId'])){
		if($_POST['getDatosByHistoriasId'] != ''){
			$getDatosBy = new AjaxHistorias();
			$getDatosBy->id_historia = $_POST['getDatosByHistoriasId'];
			$getDatosBy->tipoDato	 = $_POST['tipoDato'];
			$getDatosBy->ajaxGetAuxiliaresHistorias();
		}	
	}


	if(isset($_POST['ingresarNota'])){
		$campos = "nota_historia_historias_id_i, nota_historia_nota, nota_historia_usuario_id, nota_historia_acompanante_nombre, nota_historia_acompanante_parentesco, nota_historia_acompanante_telefono";
		$valore = "'".$_POST['ingresarNota']."' , '".$_POST['txtNota']."', '".$_SESSION['id']."', '".$_POST['txtNombreResponsable']."', '".$_POST['txtParentescoResponsable']."', '".$_POST['txtTelefonoResponsable']."' ";
		$respuesta = ModeloDAO::mdlCrear('op_nota_historia', $campos, $valore);
		if($respuesta != 'error'){
			echo '1';
		}else{
			echo '0';
		}
	}

	if(isset($_POST['AntecedentesHistoria'])){
		$campos = "*";
		$tabla = "op_historias_antecedentes";
		$condicion = "antecedentes_historia_id_i = ".$_POST['AntecedentesHistoria'];
		$antecedentes = ModeloDAO::mdlMostrar($campos, $tabla, $condicion);
		echo json_encode($antecedentes);
	}