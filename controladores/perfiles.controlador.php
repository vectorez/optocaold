<?php
	/**
	* 
	*/
	class ControladorPerfiles
	{
		
		function ctrPerfiles(){
			include "vistas/plantilla.php";
		}

		/* Mostrar Usuarios */
		static public function ctrMostrarPerfiles($item, $valor){
			$tabla = 'sys_perfiles';
			$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarListaPerfiles(){
			$tabla = 'sys_perfiles';
            $item = 'perfiles_proyectos_id_i';
            $valor = $_SESSION['proyecto'];
			$respuesta = ModeloPerfiles::mdlMostrarListaPerfiles($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarMenusPermisos($item, $valor){
			$tabla 	= 'sys_perfiles_permisos LEFT JOIN sys_menus ON perfiles_permisos_menu_id_i = menus_id_i';
			$campos = 'perfiles_permisos_menu_id_i, menus_html_href_v,menus_html_icon_v,menus_nombre_v,menus_treeview_i';
			$where	= $item.' = '.$valor.' GROUP BY perfiles_permisos_menu_id_i ORDER BY menus_order_i ASC';
			$respuesta = ModeloDAO::mdlMostrar($campos, $tabla, $where);
			return $respuesta;
		}

		static public function ctrMostrarOpcionesPermisos($item, $valor){
			$tabla 	= 'sys_perfiles_permisos LEFT JOIN sys_opciones ON sys_opciones.opciones_id_i = perfiles_permisos_opciones_id_i';
			$campos = 'perfiles_permisos_menu_id_i,perfiles_permisos_opciones_id_i,opciones_html_href_v,opciones_html_icon_v,opciones_nombre_v';
			$where	= $item.' = '.$valor.' ORDER BY opciones_nombre_v ASC';
			$respuesta = ModeloDAO::mdlMostrar($campos, $tabla, $where);
			return $respuesta;
		}

		static public function ctrMostrarOpcionesMenu($item, $valor, $id_perfil){
			$tabla 	= 'sys_perfiles_permisos LEFT JOIN sys_opciones ON sys_opciones.opciones_id_i = perfiles_permisos_opciones_id_i';
			$campos = 'perfiles_permisos_menu_id_i,perfiles_permisos_opciones_id_i,opciones_html_href_v,opciones_html_icon_v,opciones_nombre_v, opciones_padre_id_i';
			$where	= $item.' = '.$valor.' AND perfiles_permisos_perfil_id_i = '.$id_perfil.' AND opciones_padre_id_i <= 0 ORDER BY opciones_nombre_v ASC';
			$respuesta = ModeloDAO::mdlMostrar($campos, $tabla, $where);
			return $respuesta;
		}

		static public function ctrMostrarSubOpcionesMenu($item, $valor){
			$tabla 	= 'sys_opciones';
			$campos = 'opciones_id_i,opciones_html_href_v,opciones_html_icon_v,opciones_nombre_v, opciones_padre_id_i';
			$where	= $item.' = '.$valor.' ORDER BY opciones_nombre_v ASC';
			$respuesta = ModeloDAO::mdlMostrar($campos, $tabla, $where);
			return $respuesta;
		}

		static public function ctrMostrarMenus($item, $valor){
			$tabla = 'sys_menus';
			$respuesta = ModeloPerfiles::mdlMostrarMenus($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarOpciones($item, $valor){
			$tabla = 'sys_opciones';
			$respuesta = ModeloPerfiles::mdlMostrarOpciones($tabla, $item, $valor);
			return $respuesta;
		}


		static public function ctrCrearPerfil(){
			if(isset($_POST['NuevoNombre'])){
				if($_POST['NuevoNombre'] != '' && !empty($_POST['NuevoNombre'])){
					$tabla = 'sys_perfiles';
					$datos = array(	'perfiles_proyectos_id_i' => $_POST['NuevoCliente'] , 
									'perfiles_descripcion_v' => $_POST['NuevoNombre'],
									'perfilies_estado_i'	 => 1
								);
					$respuesta = ModeloPerfiles::mdlIngresarPerfiles($tabla, $datos);
					if($respuesta == "ok"){
						/* ahora tneenemos que meter los permisos ahora */
						if(isset($_POST['NuevoOpciones'])){
							/* traigo el id del perfil */
							$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, 'perfiles_descripcion_v', $_POST['NuevoNombre']);
							$id_perfil = $respuesta['perfiles_id_i'];
							foreach ($_POST['NuevoOpciones'] as $key) {
								$tabla = "sys_perfiles_permisos";
								$datos = array ( 
									'perfiles_permisos_perfil_id_i' => $id_perfil,
									'perfiles_permisos_menu_id_i' 	=> $key['menu'],
									'perfiles_permisos_opciones_id_i' 	=> $key['opcion']
								);
								$respuesta = ModeloPerfiles::mdlIngresarMenu($tabla, $datos);
							}
						}

						echo'<script>
						swal({
							  	type: "success",
							  	title: "El Perfil ha sido creado correctamente",
							  	showConfirmButton: true,
							  	confirmButtonText: "Cerrar",
							  	closeOnConfirm: false
						  	},
						  	function(result){	
								window.location = "perfiles"
							});
						</script>';
					}

				}else{
					echo "<script>
						swal({
							title  : 'El nombre del perfil no puede ir vacio o llevar caracteres especiales!',
							type   : 'error',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"perfiles\"
						});
					</script>
					";
				}
			}
		}

		static public function ctrEditarPerfil(){
			if(isset($_POST['EditarNombre'])){
				if($_POST['EditarNombre'] != '' && !empty($_POST['EditarNombre'])){
					$tabla = 'sys_perfiles';
					$datos = array(	'perfiles_proyectos_id_i' => $_POST['EditarCliente'] , 
									'perfiles_descripcion_v' => $_POST['EditarNombre'],
									'perfiles_id_i'	 		 => $_POST['EditarPerfil']
								);
					$respuesta = ModeloPerfiles::mdlEditarPerfiles($tabla, $datos);
					if($respuesta == "ok"){

						if(isset($_POST['EditarOpciones'])){
							$id_perfil = $_POST['EditarPerfil'];
							/* borro los perfiles */
							
							$other = ModeloPerfiles::mdlBorrarPermisos('sys_perfiles_permisos', $id_perfil);
							/* traigo el id del perfil */
							
							foreach ($_POST['EditarOpciones'] as $key) {
								if(!is_null($key['menu']) && !is_null($key['opcion'])){
									$tabla = "sys_perfiles_permisos";
									$datos = array ( 
										'perfiles_permisos_perfil_id_i' => $id_perfil,
										'perfiles_permisos_menu_id_i' 	=> $key['menu'],
										'perfiles_permisos_opciones_id_i' 	=> $key['opcion']
									);
									$respuesta = ModeloPerfiles::mdlIngresarMenu($tabla, $datos);
								}
							}
						}

						echo'<script>
						swal({
							  	type: "success",
							  	title: "El Perfil ha sido editado correctamente",
							  	showConfirmButton: true,
							  	confirmButtonText: "Cerrar",
							  	closeOnConfirm: false
						  	},
						  	function(result){	
								window.location = "perfiles"
							});
						</script>';
					}

				}else{
					echo "<script>
						swal({
							title  : 'El nombre del perfil no puede ir vacio o llevar caracteres especiales!',
							type   : 'error',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"perfiles\"
						});
					</script>
					";
				}
			}
		}

		static public function ctrBorrarPerfil(){
			if(isset($_GET["id_perfiles"])){
				$tabla ="sys_perfiles";
				$datos = $_GET["id_perfiles"];
				$respuesta = ModeloPerfiles::mdlBorrarPerfil($tabla, $datos);
				$tabla ="sys_perfiles_permisos";
				$datos = $_GET["id_perfiles"];
				$respuesta = ModeloPerfiles::mdlBorrarPermisos($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
					swal({
						  	type: "success",
						  	title: "El Perfil ha sido borrado correctamente",
						  	showConfirmButton: true,
						  	confirmButtonText: "Cerrar",
						  	closeOnConfirm: false
					  	},
					  	function(result){	
							window.location = "perfiles"
						});
					</script>';
				}
			}	
		}

	}