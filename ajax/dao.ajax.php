<?php
	session_start();
	require_once '../modelos/dao.modelo.php';

	/**
	* Clase para utilizar con Ajax MVC
	*/
	require_once '../modelos/dao.modelo.php';
	
	class AjaxDao
	{

		public function ajaxGuardarConfiguracion($nit, $direccion, $telefono){
			$tabla = 'op_configuracion';
			$campos = 'configuracion_nit_v = \''.$nit.'\', configuracion_direccion_v = \''.$direccion.'\', configuracion_telefono_v = \''.$telefono.'\'';
			$condicion = "1=1";
			$respuesta = ModeloDao::mdlEditar($tabla, $campos, $condicion);
			echo 'ok';
		}

	}

	if(isset($_POST['GuardarConfiguracion'])){
		$editar = new AjaxDao();
		$editar->ajaxGuardarConfiguracion($_POST['GuardarConfiguracion'],$_POST['direccion'],$_POST['telefono']);
	}