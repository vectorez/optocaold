<?php
	/**
	* 
	*/
	class ControladorPacientes
	{
		
		function ctrPacientes(){
			include "vistas/plantilla.php";
		}

		/* Mostrar Pacientes */
		static public function ctrMostrarPacientes($item, $valor){
			$tabla = 'op_pacientes';
			$respuesta = ModeloPacientes::mdlMostrarPacientes($tabla, $item, $valor);
			return $respuesta;
		}

		/* REGISTRO DE PACIENTES */
		static public function ctrCrearPacientes(){
			if(isset($_POST['NuevoNombre'])){
				$tabla = "op_pacientes";
				$datos = array(
							'pacientes_tipo_doc_v' 			=> $_POST['NuevoTipoDoc'], 
							'pacientes_documento_v' 		=> $_POST['NuevoDocumento'],
							'pacientes_nombres_v'  			=> $_POST['NuevoNombre'],
							'pacientes_apellidos_v'			=> $_POST['NuevoApellido'],
							'pacientes_estado_civil_v'		=> $_POST['NuevoEstadoCivil'],
							'pacientes_fecha_nacimiento_d'	=> $_POST['NuevoFechaNac'],
							'pacientes_sexo_v'				=> $_POST['NuevoGenero'],
							'pacientes_ocupacion_v'			=> $_POST['NuevoOcupacion'],
							'pacientes_lugar_recidencia_v'	=> $_POST['NuevoLugarResidencia'],
							'pacientes_direccion_v'			=> $_POST['NuevoDireccion'],
							'pacientes_telefono_v'			=> $_POST['NuevoTelefono']
						);

				
				$respuesta = ModeloPacientes::mdlIngresarPacientes($tabla, $datos);
				if($respuesta == 'ok'){
					echo "<script>
						swal({
							title  : 'Paciente Ingresado con éxito!',
							type   : 'success',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"pacientes\"
						});
					</script>
					";
				}else{
					echo "no";
				}
			}
		}

		/* Editar los pacientes */
		static public function ctrEditarPacientes(){
			if(isset($_POST['EditarNombre'])){
				$tabla = "op_pacientes";
				$datos = array(
							'pacientes_tipo_doc_v' 			=> $_POST['EditarTipoDoc'], 
							'pacientes_documento_v' 		=> $_POST['EditarDocumento'],
							'pacientes_nombres_v'  			=> $_POST['EditarNombre'],
							'pacientes_apellidos_v'			=> $_POST['EditarApellido'],
							'pacientes_estado_civil_v'		=> $_POST['EditarEstadoCivil'],
							'pacientes_fecha_nacimiento_d'	=> $_POST['EditarFechaNac'],
							'pacientes_sexo_v'				=> $_POST['EditarGenero'],
							'pacientes_ocupacion_v'			=> $_POST['EditarOcupacion'],
							'pacientes_lugar_recidencia_v'	=> $_POST['EditarLugarResidencia'],
							'pacientes_direccion_v'			=> $_POST['EditarDireccion'],
							'pacientes_telefono_v'			=> $_POST['EditarTelefono'],
							'pacientes_id_i'				=> $_POST['EditarPacientes_id_i']
						);

				
				$respuesta = ModeloPacientes::mdlEditarPacientes($tabla, $datos);
				if($respuesta == 'ok'){
					echo "<script>
						swal({
							title  : 'Paciente Editado con éxito!',
							type   : 'success',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"pacientes\"
						});
					</script>
					";
				}else{
					echo "no";
				}
			}
		}

		/* Eliminar pacientes */
		static public function ctrBorrarPacientes(){

			if(isset($_GET["id_Paciente"])){
				$tabla ="op_pacientes";
				$datos = $_GET["id_Paciente"];

				$respuesta = ModeloPacientes::mdlBorrarPacientes($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
					swal({
						  	type: "success",
						  	title: "El paciente ha sido borrado correctamente",
						  	showConfirmButton: true,
						  	confirmButtonText: "Cerrar",
						  	closeOnConfirm: false
					  	},
					  	function(result){	
							window.location = "pacientes"
						});
					</script>';
				}		
			}
		}	


	}