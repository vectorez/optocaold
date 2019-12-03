<?php
	require_once '../controladores/usuarios.controlador.php';
	require_once '../modelos/usuarios.modelo.php';

	/**
	* Clase para utilizar con Ajax MVC
	*/
	class AjaxUsuarios
	{
		public $id_usuario;
		public $activarId;
		public $ActivarUsuario;
		public $validaCliente;
		
		public function ajaxEditarUsuario(){
			$item = 'usuarios_id_i';
			$valor = $this->id_usuario;
			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
			echo json_encode($respuesta);
		}

		/* Activar cliente */
		public function ajaxActivarUsuario(){
			$tabla = 'sys_usuarios';
			$item1 = 'usuarios_estado_i';
			$valor1 = $this->ActivarUsuario;
			$item2 = 'usuarios_id_i';
			$valor2 = $this->activarId;
			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
			echo $respuesta;
		}

		/* validar que el usuairo no este repetido */
		/*public function ajaxValidarCliente(){
			$item = 'emp_nit';
			$valor = $this->validaCliente;
			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
			echo json_encode($respuesta);
		}*/

	}
	
	
	if(isset($_POST['EditarUsuarioId'])){
		if($_POST['EditarUsuarioId'] != ''){
			$editar = new AjaxUsuarios();
			$editar->id_usuario = $_POST['EditarUsuarioId'];
			$editar->ajaxEditarUsuario();
		}	
	}

	if(isset($_POST['ActivarId'])){
		$activarUsuarios = new AjaxUsuarios();
		$activarUsuarios->activarId = $_POST['ActivarId'];
		$activarUsuarios->ActivarUsuario = $_POST['estado'];
		$activarUsuarios->ajaxActivarUsuario();
	}


	/*if(isset($_POST['validarNit'])){
		$activarUsuarios = new AjaxUsuarios();
		$activarUsuarios->validaCliente = $_POST['validarNit'];
		$activarUsuarios->ajaxValidarCliente();
	}*/
	