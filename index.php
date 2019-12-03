<?php
	require_once 'controladores/plantilla.controlador.php';
	require_once 'controladores/usuarios.controlador.php';
	require_once 'controladores/perfiles.controlador.php';
	require_once 'controladores/pacientes.controlador.php';
	require_once 'controladores/historias.controlador.php';
	
	require_once 'modelos/usuarios.modelo.php';
	require_once 'modelos/perfiles.modelo.php';
	require_once 'modelos/dao.modelo.php';
	require_once 'modelos/pacientes.modelo.php';
	require_once 'modelos/historias.modelo.php';

	$plantilla = new ControladorPlantilla();
	$plantilla->ctrPlantilla();