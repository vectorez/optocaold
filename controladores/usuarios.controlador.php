<?php
	/**
	* 
	*/
	class ControladorUsuarios
	{
		
		function ctrUsuarios(){
			include "vistas/plantilla.php";
		}

		/* CONTROL DE ACCESO */
		static public function ctrIngresoUsuario(){
			if(isset($_POST['ingUsuario']) && isset($_POST['ingPassword'])){
				if(filter_var( $_POST['ingUsuario'], FILTER_VALIDATE_EMAIL) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])){
					$tabla 	= "sys_usuarios";
					$item 	= "usuarios_email_v";
					$valor	= $_POST['ingUsuario'];
					$contrasenha = crypt($_POST['ingPassword'], '$2a$07$usesomesillystringforsalt$');
					//echo $contrasenha;
					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
					//var_dump($respuesta);
					if($respuesta['usuarios_email_v'] == $_POST['ingUsuario'] && $respuesta['usuarios_contrasena_v'] == $contrasenha && $respuesta['usuarios_borrado_i'] == 0){

						if($respuesta['usuarios_estado_i'] == '1'){
							$_SESSION['iniciarSession'] 	= 'ok';
							$_SESSION['id'] 				= $respuesta['usuarios_id_i'];
							$_SESSION['nombre'] 			= $respuesta['usuarios_nombres_v'];
							$_SESSION['email'] 				= $respuesta['usuarios_email_v'];
							$_SESSION['foto'] 				= $respuesta['usuarios_foto'];
							$_SESSION['perfil'] 			= $respuesta['usuarios_perfil_id_i'];
							$_SESSION['cliente']			= $respuesta['usuarios_clientes_id_i'];
							$_SESSION['tipo']				= $respuesta['usuarios_agente_i'];
							$_SESSION['adiciona'] 			= $respuesta['perfiles_adiciona_i'];
							$_SESSION['edita']				= $respuesta['perfiles_edita_i'];
							$_SESSION['elimina']			= $respuesta['perfiles_elimina_i'];
							$_SESSION['notas']				= $respuesta['perfiles_notas_i'];

							/*=============================================
								REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
							=============================================*/
							date_default_timezone_set('America/Bogota');
							$fecha = date('Y-m-d');
							$hora = date('H:i:s');
							$fechaActual = $fecha.' '.$hora;
							$item1 = "usuarios_ultimo_login";
							$valor1 = $fechaActual;
							$item2 = "usuarios_id_i";
							$valor2 = $respuesta["usuarios_id_i"];
							$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
							if($ultimoLogin == "ok"){
								echo '<script>
									window.location = "inicio";
								</script>';
							}	
						}else{
							echo "<br>";
							echo "<div class='alert alert-danger'>El usuario no esta activado!</div>";
						}
						
						/**/
					}else{
						echo "<br>";
						echo "<div class='alert alert-danger'>Error al ingresar, Vuelve a Intentarlo</div>";
					}
				}
			}
		}


		/* REGISTRO DE USUARIOS */
		static public function ctrCrearUsuario(){
			if(isset($_POST['NuevoNombre'])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["NuevoNombre"]) &&
				   filter_var( $_POST['NuevoCorreo'], FILTER_VALIDATE_EMAIL) &&
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST["NuevoPassword"]))
				{	
					$ruta =  "";
					if(isset($_FILES['NuevaFoto']['tmp_name'])  && !empty($_FILES['NuevaFoto']['tmp_name']) ){
						list($ancho, $alto) = getimagesize($_FILES['NuevaFoto']['tmp_name']);
						$nuevoAncho = 500;
						$nuevoAlto 	= 500;

						/* Creamos el directorio */
						$directorio = "vistas/img/usuarios/".$_POST['NuevoCorreo'];
						mkdir($directorio, 0755);

						/* De acuerdo al tipo de imagen se le aplican funciones de php */
						if($_FILES["NuevaFoto"]["type"] == "image/jpeg"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['NuevoCorreo']."/".$aleatorio.".jpg";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefromjpeg($_FILES['NuevaFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							//cortamos esta imagen
							/* imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}elseif($_FILES["NuevaFoto"]["type"] == "image/png"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['NuevoCorreo']."/".$aleatorio.".png";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefrompng($_FILES['NuevaFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							/* 	
								Cortamos esta imagen
								imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);
						}
						
					}

					$tabla = "sys_usuarios";
					$contrasenha = crypt($_POST['NuevoPassword'], '$2a$07$usesomesillystringforsalt$');
					$datos = array(
								'usuarios_nombres_v' 		=> $_POST['NuevoNombre'], 
								'usuarios_email_v' 			=> $_POST['NuevoCorreo'],
								'usuarios_contrasena_v'  	=> $contrasenha,
								'usuarios_perfil_id_i'		=> $_POST['NuevoPerfil'],
								'usuarios_foto'				=> $ruta,
								'usuarios_estado_i'			=> 1
							);

					
					$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
					if($respuesta == 'ok'){
						echo "<script>
							swal({
								title  : 'Usuario creado con éxito!',
								type   : 'success',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							},function(){
								window.location = \"usuarios\"
							});
						</script>
						";
					}else{
						echo "no";
					}

				}else{
					echo "<script>
						swal({
							title  : 'El usuario no puede ir vació!',
							type   : 'error',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"usuarios\"
						});
					</script>
					";
				}
			}
		}

		/* Editar usuarios */
		static public function ctrEditarUsuario(){
			if(isset($_POST['EditarNombre'])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombre"]) &&
				   filter_var( $_POST['EditarCorreo'], FILTER_VALIDATE_EMAIL))
				{
					/* Validar imagen */
					$ruta =  $_POST['fotoActual'];
					if(isset($_FILES['EditarFoto']['tmp_name']) && !empty($_FILES['EditarFoto']['tmp_name'])){
						list($ancho, $alto) = getimagesize($_FILES['EditarFoto']['tmp_name']);
						$nuevoAncho = 500;
						$nuevoAlto 	= 500;

						/* Creamos el directorio */
						$directorio = "vistas/img/usuarios/".$_POST['EditarCorreo'];	
						/* Primero preguntamos su existe una imagen en la base de datos */
						if(!empty($_POST['fotoActual'])){
							unlink($_POST['fotoActual']);
						}else{
							mkdir($directorio, 0755);	
						}
												

						/* De acuerdo al tipo de imagen se le aplican funciones de php */
						if($_FILES["EditarFoto"]["type"] == "image/jpeg"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['EditarCorreo']."/".$aleatorio.".jpg";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefromjpeg($_FILES['EditarFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							//cortamos esta imagen
							/* imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}elseif($_FILES["EditarFoto"]["type"] == "image/png"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['EditarCorreo']."/".$aleatorio.".png";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefrompng($_FILES['EditarFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							/* 	
								Cortamos esta imagen
								imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);
						}
						
					}

					$tabla = "sys_usuarios";
					if($_POST['EditarPassword'] != ''){
						if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditarPassword"])){
							$contrasenha = crypt($_POST['EditarPassword'], '$2a$07$usesomesillystringforsalt$');
						}else{
							echo "<script>
								swal({
									title  : 'El password no puede ir vacio o llevar caracteres especiales!',
									type   : 'error',
									configButtonText : \"Cerrar\",
									closeOnConfirm: false
								},function(){
									window.location = \"usuarios\"
								});
							</script>
							";
						}
					}else{
						$contrasenha = $_POST['passwordActual'];
					}

					$datos = array(
							'usuarios_nombres_v' 		=> $_POST['EditarNombre'], 
							'usuarios_email_v' 			=> $_POST['EditarCorreo'],
							'usuarios_contrasena_v'  	=> $contrasenha,
							'usuarios_perfil_id_i'		=> $_POST['EditarPerfil'],
							'usuarios_foto'				=> $ruta,
							'usuarios_estado_i'			=> 1,
							'usuarios_id_i'				=> $_POST['EditarUserID']
						);
					$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
					if($respuesta == 'ok'){
						echo "<script>
							swal({
								title  : 'Usuario editado con éxito!',
								type   : 'success',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							}, function(){
								window.location = \"usuarios\"
							});
						</script>
						";
					}else{
						echo "no";
					}

					
				}else{
					echo "<script>
								swal({
									title  : 'El nombre no puede ir vació!',
									type   : 'error',
									configButtonText : \"Cerrar\",
									closeOnConfirm: false
								}, function(){
									window.location = \"usuarios\"
								});
							</script>
							";
				}
			}
		}


		/* Eliminar cliente */
		static public function ctrBorrarUsuario(){

			if(isset($_GET["id_Usuario"])){
				$tabla ="sys_usuarios";
				$datos = $_GET["id_Usuario"];

				$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
					swal({
						  	type: "success",
						  	title: "El Usuario ha sido borrado correctamente",
						  	showConfirmButton: true,
						  	confirmButtonText: "Cerrar",
						  	closeOnConfirm: false
					  	},
					  	function(result){	
							window.location = "usuarios"
						});
					</script>';
				}		
			}
		}	

		/* Mostrar Usuarios */
		static public function ctrMostrarUsuarios($item, $valor){
			$tabla = 'sys_usuarios';
			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarOptometras($item, $valor){
			$tabla = 'sys_usuarios';
			$respuesta = ModeloUsuarios::mdlMostrarUsuariosOptometra($tabla, $item, $valor);
			return $respuesta;
		}

		/* REGISTRO DE USUARIOS */
		static public function ctrCrearOptometra(){
			if(isset($_POST['NuevoNombre'])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["NuevoNombre"]) &&
				   filter_var( $_POST['NuevoCorreo'], FILTER_VALIDATE_EMAIL) )
				{	
					$ruta =  "";
					if(isset($_FILES['NuevaFoto']['tmp_name'])  && !empty($_FILES['NuevaFoto']['tmp_name']) ){
						list($ancho, $alto) = getimagesize($_FILES['NuevaFoto']['tmp_name']);
						$nuevoAncho = 250;
						$nuevoAlto 	= 150;

						/* Creamos el directorio */
						$directorio = "vistas/img/usuarios/".$_POST['NuevoCorreo'];
						if(!file_exists($directorio))
							mkdir($directorio, 0755);

						/* De acuerdo al tipo de imagen se le aplican funciones de php */
						if($_FILES["NuevaFoto"]["type"] == "image/jpeg"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['NuevoCorreo']."/".$aleatorio.".jpg";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefromjpeg($_FILES['NuevaFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							//cortamos esta imagen
							/* imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}elseif($_FILES["NuevaFoto"]["type"] == "image/png"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['NuevoCorreo']."/".$aleatorio.".png";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefrompng($_FILES['NuevaFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							/* 	
								Cortamos esta imagen
								imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);
						}
						
					}

					$tabla = "sys_usuarios";
					$contrasenha = crypt('optometra421', '$2a$07$usesomesillystringforsalt$');
					$datos = array(
								'usuarios_nombres_v' 		=> $_POST['NuevoNombre'], 
								'usuarios_email_v' 			=> $_POST['NuevoCorreo'],
								'usuarios_telefono_v'  		=> $_POST['NuevoTelefono'],
								'usuarios_perfil_id_i'		=> 7,
								'usuarios_firma_v'			=> $ruta,
								'usuarios_cedula_v'			=> $_POST['NuevoCedula'],
								'usuarios_estado_i'			=> 1,
								'usuarios_tarjeta_v'		=> $_POST['NuevoTarjetaProfesional'],
								'usuarios_contrasena_v'		=> $contrasenha
							);

					
					$respuesta = ModeloUsuarios::mdlIngresarOptometra($tabla, $datos);
					if($respuesta == 'ok'){
						echo "<script>
							swal({
								title  : 'OPtometra creado con éxito!',
								type   : 'success',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							},function(){
								window.location = \"optometra\"
							});
						</script>
						";
					}else{
						echo "no";
					}

				}else{
					echo "<script>
						swal({
							title  : 'El nombre no puede ir vacio!',
							type   : 'error',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"optometra\"
						});
					</script>
					";
				}
			}
		}

		/* Editar usuarios */
		static public function ctrEditarOptometra(){
			if(isset($_POST['EditarNombre'])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombre"]) &&
				   filter_var( $_POST['EditarCorreo'], FILTER_VALIDATE_EMAIL))
				{
					/* Validar imagen */
					$ruta =  $_POST['fotoActual'];
					if(isset($_FILES['EditarFoto']['tmp_name']) && !empty($_FILES['EditarFoto']['tmp_name'])){
						list($ancho, $alto) = getimagesize($_FILES['EditarFoto']['tmp_name']);
						$nuevoAncho = 250;
						$nuevoAlto 	= 150;

						/* Creamos el directorio */
						$directorio = "vistas/img/usuarios/".$_POST['EditarCorreo'];	
						/* Primero preguntamos su existe una imagen en la base de datos */
						if(!empty($_POST['fotoActual'])){
							unlink($_POST['fotoActual']);
						}else{
							mkdir($directorio, 0755);	
						}
												

						/* De acuerdo al tipo de imagen se le aplican funciones de php */
						if($_FILES["EditarFoto"]["type"] == "image/jpeg"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['EditarCorreo']."/".$aleatorio.".jpg";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefromjpeg($_FILES['EditarFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							//cortamos esta imagen
							/* imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}elseif($_FILES["EditarFoto"]["type"] == "image/png"){
							//creamos un numero aleatorio
							$aleatorio = mt_rand(100, 999);
							//creamos la ruta donde se va a guardar la imagen
							$ruta =  "vistas/img/usuarios/".$_POST['EditarCorreo']."/".$aleatorio.".png";
							//obtenemos el origen osea el FILE
							$origen  = imagecreatefrompng($_FILES['EditarFoto']['tmp_name']);
							//le decimos que vamos acrear una imagen en el destino con esos ancho y alto
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							/* 	
								Cortamos esta imagen
								imagecopyresized();
								1- destino
								2- Origen
								3- donde se inicia el corte en el EjeX destino
								4- donde se inicia el corte en el ejeY destino
								5- donde se inicia el corte en el ejeX Origen
								6- donde se inicia el corte en el ejeY Origen
								7- nuevo ancho
								8- nuebp alto
								9- ancho original
								10- alto original
							*/
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);
						}
						
					}

					$tabla = "sys_usuarios";
					$contrasenha = crypt('optometra421', '$2a$07$usesomesillystringforsalt$');

					$datos = array(
								'usuarios_nombres_v' 		=> $_POST['EditarNombre'], 
								'usuarios_email_v' 			=> $_POST['EditarCorreo'],
								'usuarios_telefono_v'  		=> $_POST['EditarTelefono'],
								'usuarios_perfil_id_i'		=> 7,
								'usuarios_firma_v'			=> $ruta,
								'usuarios_cedula_v'			=> $_POST['EditarCedula'],
								'usuarios_estado_i'			=> 1,
								'usuarios_id_i'				=> $_POST['EditarUserID'],
								'usuarios_tarjeta_v'		=> $_POST['EditarTarjetaProfesional'],
								'usuarios_contrasena_v'		=> $contrasenha
						);
					$respuesta = ModeloUsuarios::mdlEditarOptometra($tabla, $datos);
					if($respuesta == 'ok'){
						echo "<script>
							swal({
								title  : 'Optometra editado con éxito!',
								type   : 'success',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							}, function(){
								window.location = \"optometra\"
							});
						</script>
						";
					}else{
						echo "no";
					}

					
				}else{
					echo "<script>
								swal({
									title  : 'El nombre no puede ir vació!',
									type   : 'error',
									configButtonText : \"Cerrar\",
									closeOnConfirm: false
								}, function(){
									window.location = \"optometra\"
								});
							</script>
							";
				}
			}
		}

	}