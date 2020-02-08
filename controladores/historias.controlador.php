<?php
	/**
	* 
	*/
	class ControladorHistorias
	{
		
		function ctrHistorias(){
			include "vistas/plantilla.php";
		}

		/* Mostrar Historias */
		static public function ctrMostrarHistorias($item, $valor){
			$tabla = 'op_historias';
			$respuesta = ModeloHistorias::mdlMostrarHistorias($tabla, $item, $valor);
			return $respuesta;
		}

		static public function ctrMostrarAuxiliaresHistorias($item, $valor, $valor2){
			$tabla = 'op_auxiliares';
			$respuesta = ModeloHistorias::mdlMostrarAuxiliaresHistorias($tabla, $item, $valor, $valor2);
			return $respuesta;
		}

		/* REGISTRO DE Historias */
		static public function ctrCrearHistorias(){
			if(isset($_POST['NuevoDocumento']) && $_POST['NuevoDocumento'] != '' ){
				$numero_Paciente = 0;
				$error_Paciente = 0;
				if($_POST['DocumentoExiste'] != 0){
					/* Ese paciente si existia en la base de datos */
					$numero_Paciente = $_POST['DocumentoExiste'];
				}else{
				   	/* El paciente no exite y toca crearlo */
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
						$respuestaP  = ModeloPacientes::mdlMostrarPacientes('op_pacientes','pacientes_documento_v', $_POST['NuevoDocumento']);
						$numero_Paciente = $respuestaP['pacientes_id_i'];
					}else{
						$error_Paciente = 1;
					}
				}

				if($error_Paciente == 0){
					/* Si guardo el paciente y podemos guardar todo */
					$tabla = 'op_historias';
					$datos = array(
						'historias_numero_v' 						=> ControladorHistorias::ctrNumeroHistorico(),
						'historias_paciente_id_i' 					=> $numero_Paciente,
						'historias_acudiente_v'						=> $_POST['NuevoAcompanante'],
						'historias_telefono_acudiente_v'			=> $_POST['NuevoTelefonoAconpanante'], 
						'historias_acudiente_responsable_v'			=> $_POST['NuevoAcompananteResponsable'],
						'historias_telefono_acudiente_responsable_v' => $_POST['NuevoTelefonoAconpananteResponsable'],
						'historia_prentesco_responsable_v'			=> $_POST['NuevoParentescoResponsable'],
						'historias_aseguradora_v'					=> $_POST['NuevoAseguradora'],
						'historias_tipo_afiliacion_v'				=> $_POST['NuevoTipoAfiliacion'],
						'historias_semanas_cotizadas'				=> $_POST['NuevoSemanasCotizadas'],
						'historia_prentesco_v'						=> $_POST['NuevoParentesco'],
						'historias_antecedentes_familiares'			=> $_POST['NuevoAntecedetesFamiliares'],
						'historia_antecedentes_personales_v'		=> $_POST['NuevoAntecedentesPersonales'],
						'historias_oftalmoscopia_v'					=> $_POST['NuevoOftalmoscopia'],
						'historias_excavacion_od_v'					=> $_POST['NuevoExcavacionOD'],
						'historias_reflejos_pulpilres_v'			=> $_POST['NuevoReflejosPulpiresOD'],
						'historias_motilidad_ocular_v'				=> $_POST['NuevoMotilidadOcular'],
						'historias_ortoforia_vl_v'					=> $_POST['NuevoVlOrtoforia'],
						'historias_ortoforia_vp_v'					=> $_POST['NuevoVpOrtoforia'],
						'historias_examenes_complementarios_v'		=> $_POST['NuevoExamenesComplementarios'],
						'historias_queratometria_od_v'				=> $_POST['NuevoQueratometriaOD'],
						'historias_queratometria_id_v'				=> $_POST['NuevoQueratometriaID'],
						'historias_tonometria_od_v'					=> $_POST['NuevoTonometriaOD'],
						'historias_tonometria_oi_v'					=> $_POST['NuevoTonometriaID'],
						'historias_tipo_tonometro_v'				=> $_POST['NuevoTipoTonometro'],
						'historias_test_acomodativo_v'				=> $_POST['NuevoTestAcomodativo'],
						'historias_resultado_v'						=> $_POST['NuevoResultadoTestAcomo'],
						'historias_test_amsier_v'					=> $_POST['NuevoTestAmsier'],
						'historias_test_color_derecho_v'			=> $_POST['NuevoTestColorD'],
						'historias_test_color_izquierdo_v'			=> $_POST['NuevoTestColorI'],
						'historias_test_estereopsis_v'				=> $_POST['NuevoTestEstereopsis'],
						'historias_descripcion_v'					=> $_POST['NuevoDescripcionX'],
						'historias_diagnostico_principal_v'			=> $_POST['NuevoDiagnosticoPrincipal'],
						'historias_diagnostico_segundario_v'		=> $_POST['NuevoDiagnosticoSecundario'],
						'historias_otros_diagnosticos_v'			=> $_POST['NuevoDiagnosticoOtros'],
						'historias_conducta_v'						=> $_POST['NuevoConducta'],
						'historias_remision_justi_v'				=> $_POST['NuevoRemision'],
						'historias_optometra_v'						=> $_POST['NuevoOptometra'],
						'historias_sin_correcion_od_v'				=> $_POST['NuevoSinCorreccionOD'],
						'historias_sin_correcion_id_v'				=> $_POST['NuevoSinCorreccionID'],
						'historias_con_correcion_od_v'				=> $_POST['NuevoConCorreccionOD'],
						'historias_con_correcion_id_v'				=> $_POST['NuevoConCorreccionID'],
						'historias_biomocrospia_v'					=> $_POST['NuevoBiomocrospia'],
						'historia_tipo_lente_v'						=> $_POST['NuevoTipoLenteEnUso'],
						'historia_excavacion_oi_v'					=> $_POST['NuevoExcavacionOI'],
						'historias_observaciones_v'					=> $_POST['NuevoObservaciones'],
						'historias_antecedentes_oculares_v'			=> $_POST['NuevoAntecedentesOculares'],
						'historias_con_vp_od_i'						=> $_POST['NuevoConVPOD'],
						'historias_sin_vp_od_i'						=> $_POST['NuevoSinVPOD'],
						'historias_con_vp_id_i'						=> $_POST['NuevoConVPID'],
						'historias_sin_vp_id_i'						=> $_POST['NuevoSinVPID']
					);

					$historia = ModeloHistorias::mdlIngresarHistorias($tabla , $datos);
					if($historia != 'Error'){
						/* Podemos hacer lo siguiente */
						$tablaNew = 'op_auxiliares';
						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaOD'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroOD'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeOD'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddOD'],
							'auxiliares_av_v' 			=> '0',
							'auxiliares_dp_v' 			=> '0',
							'auxiliares_tipo_pregunta_v' 	=> 'Lensometria',
							'auxiliares_od_id_v'		=> 'OD'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,	
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaID'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroID'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeID'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddID'],
							'auxiliares_av_v' 			=> '0',
							'auxiliares_dp_v' 			=> '0',
							'auxiliares_tipo_pregunta_v' 	=> 'Lensometria',
							'auxiliares_od_id_v'		=> 'ID'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						/* Retinoscopia */

						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaRetinosOD'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroRetinosOD'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeRetinosOD'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddRetinosOD'],
							'auxiliares_avvl_v' 		=> $_POST['NuevoAVVLRetinosOD'],
							'auxiliares_avvp_v' 		=> $_POST['NuevoAVVPRetinosOD'],
							'auxiliares_tipo_pregunta_v' 	=> 'Retinoscopia',
							'auxiliares_od_id_v'		=> 'OD'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,	
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaRetinosID'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroRetinosID'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeRetinosID'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddRetinosID'],
							'auxiliares_avvl_v' 		=> $_POST['NuevoAVVLRetinosID'],
							'auxiliares_avvp_v' 		=> $_POST['NuevoAVVPRetinosID'],
							'auxiliares_tipo_pregunta_v' 	=> 'Retinoscopia',
							'auxiliares_od_id_v'		=> 'ID'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						//SubJetivo
						/*$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaRXOD'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroRXOD'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeRXOD'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddRXOD'],
							'auxiliares_av_v' 			=> $_POST['NuevoAvRXOD'],
							'auxiliares_dp_v' 			=> '0',
							'auxiliares_tipo_pregunta_v' 	=> 'SubJetivo',
							'auxiliares_od_id_v'		=> 'OD'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,	
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaRXID'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroRXID'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeRXID'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddRXID'],
							'auxiliares_av_v' 			=> $_POST['NuevoAvRXID'],
							'auxiliares_dp_v' 			=> '0',
							'auxiliares_tipo_pregunta_v' 	=> 'SubJetivo',
							'auxiliares_od_id_v'		=> 'ID'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);*/


						//Formula Final
						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaFormulaFinalOD'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroFormulaFinalOD'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeFormulaFinalOD'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddFormulaFinalOD'],
							'auxiliares_avvl_v' 		=> $_POST['NuevoAVVLFormulaFinalOD'],
							'auxiliares_avvp_v' 		=> $_POST['NuevoAVVPFormulaFinalOD'],
							'auxiliares_altura_foral_v' => $_POST['NuevoAlturaForalFormulaFinalOD'],
							'auxiliares_dp_v' 			=> $_POST['NuevoDpFormulaFinalOD'],
							'auxiliares_tipo_pregunta_v' 	=> 'Formula',
							'auxiliares_od_id_v'		=> 'OD'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						$dataNewx = array(
							'auxiliares_historia_id_i' 	=> $historia,	
							'auxiliares_esfera_v' 		=> $_POST['NuevoEsferaFormulaFinalID'],
							'auxiliares_cilindro_v' 	=> $_POST['NuevoCilindroFormulaFinalID'],
							'auxiliares_eje_v' 			=> $_POST['NuevoEjeFormulaFinalID'],
							'auxiliares_add_v' 			=> $_POST['NuevoAddFormulaFinalID'],
							'auxiliares_avvl_v' 		=> $_POST['NuevoAVVLFormulaFinalID'],
							'auxiliares_avvp_v' 		=> $_POST['NuevoAVVPFormulaFinalID'],
							'auxiliares_altura_foral_v' => $_POST['NuevoAlturaForalFormulaFinalID'],
							'auxiliares_dp_v' 			=> $_POST['NuevoDpFormulaFinalID'],
							'auxiliares_tipo_pregunta_v' 	=> 'Formula',
							'auxiliares_od_id_v'		=> 'ID'
						);

						$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

						$AntecedentesGenerales = $_POST['NuevoAntGenerales'];

						foreach ($AntecedentesGenerales as $key => $value) {
							if(isset($value['per'])){
								$activa_per = 1;
							}else{
								$activa_per = 0;
							}
							if(isset($value['fam'])){
								$activa_fam = 1;
							}else{
								$activa_fam = 0;
							}
							$tabla = 'op_historias_antecedentes';
							$campos = 'antecedentes_historia_id_i, antecedentes_tipo_v, antecedentes_categoria_v, antecedentes_personal_i, antecedentes_familiar_i, antecedentes_nombre_cat_v';
							$valores = $historia.",'".$value['tipo']."','".$value['cat']."',".$activa_per.",".$activa_fam.",'".$value['nombre_cat']."'";
							ModeloDao::mdlCrear($tabla, $campos, $valores);
						}

						$AntecedentesOculares = $_POST['NuevoAntOculares'];

						foreach ($AntecedentesOculares as $key => $value) {
							if(isset($value['per'])){
								$activa_per = 1;
							}else{
								$activa_per = 0;
							}
							$tabla = 'op_historias_antecedentes';
							$campos = 'antecedentes_historia_id_i, antecedentes_tipo_v, antecedentes_categoria_v, antecedentes_personal_i, antecedentes_nombre_cat_v';
							$valores = $historia.",'".$value['tipo']."','".$value['cat']."',".$activa_per.",'".$value['nombre_cat']."'";
							ModeloDao::mdlCrear($tabla, $campos, $valores);
						}

						echo "<script>
							swal({
								title  : 'Historia guardada!',
								type   : 'success',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							},function(){
								window.location = \"historias\"
							});
						</script>
						";

					}else{
						echo "<script>
							swal({
								title  : 'No se pudo guardar , no pudimos guardar la historia!',
								type   : 'error',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							},function(){
								window.location = \"historias\"
							});
						</script>
						";	
					}
				}else{
					/* No guardo nada */
					echo "<script>
						swal({
							title  : 'No se pudo guardar , no pudimos guardar al paciente!',
							type   : 'error',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"historias\"
						});
					</script>
					";
				}
			}
		}

		/* Editar los Historias */
		static public function ctrEditarHistorias(){
			if(isset($_POST['EditarPacientes_id_i']) && $_POST['EditarPacientes_id_i'] != '' ){
				$numero_Paciente = $_POST['EditarPacientes_id_i'];
				/* Si guardo el paciente y podemos guardar todo */
				$tabla = 'op_historias';
				$datos = array(
					'historias_paciente_id_i' 					=> $numero_Paciente,
					'historias_acudiente_v'						=> $_POST['EditarAcompanante'],
					'historias_telefono_acudiente_v'			=> $_POST['EditarTelefonoAconpanante'], 
					'historias_acudiente_responsable_v'			=> $_POST['EditarAcompananteResponsable'],
					'historias_telefono_acudiente_responsable_v' => $_POST['EditarTelefonoAconpananteResponsable'],
					'historia_prentesco_responsable_v'			=> $_POST['EditarParentescoResponsable'],
					'historias_aseguradora_v'					=> $_POST['EditarAseguradora'],
					'historias_tipo_afiliacion_v'				=> $_POST['EditarTipoAfiliacion'],
					'historias_semanas_cotizadas'				=> $_POST['EditarSemanasCotizadas'],
					'historia_prentesco_v'						=> $_POST['EditarParentesco'],
					'historias_antecedentes_familiares'			=> $_POST['EditarAntecedetesFamiliares'],
					'historia_antecedentes_personales_v'		=> $_POST['EditarAntecedentesPersonales'],
					'historias_oftalmoscopia_v'					=> $_POST['EditarOftalmoscopia'],
					'historias_excavacion_od_v'					=> $_POST['EditarExcavacionOD'],
					'historias_reflejos_pulpilres_v'			=> $_POST['EditarReflejosPulpiresOD'],
					'historias_motilidad_ocular_v'				=> $_POST['EditarMotilidadOcular'],
					'historias_ortoforia_vl_v'					=> $_POST['EditarVlOrtoforia'],
					'historias_ortoforia_vp_v'					=> $_POST['EditarVpOrtoforia'],
					'historias_examenes_complementarios_v'		=> $_POST['EditarExamenesComplementarios'],
					'historias_queratometria_od_v'				=> $_POST['EditarQueratometriaOD'],
					'historias_queratometria_id_v'				=> $_POST['EditarQueratometriaID'],
					'historias_tonometria_od_v'					=> $_POST['EditarTonometriaOD'],
					'historias_tonometria_oi_v'					=> $_POST['EditarTonometriaID'],
					'historias_tipo_tonometro_v'				=> $_POST['EditarTipoTonometro'],
					'historias_test_acomodativo_v'				=> $_POST['EditarTestAcomodativo'],
					'historias_resultado_v'						=> $_POST['EditarResultadoTestAcomo'],
					'historias_test_amsier_v'					=> $_POST['EditarTestAmsier'],
					'historias_test_color_derecho_v'			=> $_POST['EditarTestColorD'],
					'historias_test_color_izquierdo_v'			=> $_POST['EditarTestColorI'],
					'historias_test_estereopsis_v'				=> $_POST['EditarTestEstereopsis'],
					'historias_descripcion_v'					=> $_POST['EditarDescripcionX'],
					'historias_diagnostico_principal_v'			=> $_POST['EditarDiagnosticoPrincipal'],
					'historias_diagnostico_segundario_v'		=> $_POST['EditarDiagnosticoSecundario'],
					'historias_otros_diagnosticos_v'			=> $_POST['EditarDiagnosticoOtros'],
					'historias_conducta_v'						=> $_POST['EditarConducta'],
					'historias_remision_justi_v'				=> $_POST['EditarRemision'],
					'historias_optometra_v'						=> $_POST['EditarOptometra'],
					'historias_sin_correcion_od_v'				=> $_POST['EditarSinCorreccionOD'],
					'historias_sin_correcion_id_v'				=> $_POST['EditarSinCorreccionID'],
					'historias_con_correcion_od_v'				=> $_POST['EditarConCorreccionOD'],
					'historias_con_correcion_id_v'				=> $_POST['EditarConCorreccionID'],
					'historias_biomocrospia_v'					=> $_POST['EditarBiomocrospia'],
					'historia_tipo_lente_v'						=> $_POST['EditarTipoLenteEnUso'],
					'historias_id_i'							=> $_POST['historias_id_i'],
					'historia_excavacion_oi_v'					=> $_POST['EditarExcavacionOI'],
					'historias_observaciones_v'					=> $_POST['EditarObservaciones'],
					'historias_antecedentes_oculares_v'			=> $_POST['EditarAntecedentesOculares'],
					'historias_con_vp_od_i'						=> $_POST['EditarConVPOD'],
					'historias_sin_vp_od_i'						=> $_POST['EditarSinVPOD'],
					'historias_con_vp_id_i'						=> $_POST['EditarConVPID'],
					'historias_sin_vp_id_i'						=> $_POST['EditarSinVPID']
				);

				$historia = ModeloHistorias::mdlEditarHistorias($tabla , $datos);
				//"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ' = 'No tiene' , historias_con_correcion_od_v = 'No tiene', historias_con_correci' at line 1"
				if($historia == 'ok'){
					$historia = $_POST['historias_id_i'];
					/* Podemos hacer lo siguiente */
					$tablaNew = 'op_auxiliares';
					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaOD'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroOD'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeOD'],
						'auxiliares_add_v' 			=> $_POST['EditarAddOD'],
						'auxiliares_id_i' 			=> $_POST['EditarODId'],
						'auxiliares_av_v' 			=> '0',
						'auxiliares_dp_v' 			=> '0',
						'auxiliares_tipo_pregunta_v' 	=> 'Lensometria',
						'auxiliares_od_id_v'		=> 'OD'
					);

					$nreRespuesta = ModeloHistorias::mdlActualizaDatosExtrasHistorias($tablaNew, $dataNewx);

					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,	
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaID'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroID'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeID'],
						'auxiliares_add_v' 			=> $_POST['EditarAddID'],
						'auxiliares_id_i' 			=> $_POST['EditarIDId'],
						'auxiliares_avvl_v' 		=> $_POST['EditarAVVLRetinosID'],
						'auxiliares_avvp_v' 		=> $_POST['EditarAVVPRetinosID'],
						'auxiliares_tipo_pregunta_v' 	=> 'Lensometria',
						'auxiliares_od_id_v'		=> 'ID'
					);

					$nreRespuesta = ModeloHistorias::mdlActualizaDatosExtrasHistorias($tablaNew, $dataNewx);

					/* Retinoscopia */

					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaRetinosOD'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroRetinosOD'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeRetinosOD'],
						'auxiliares_add_v' 			=> $_POST['EditarAddRetinosOD'],
						'auxiliares_id_i' 			=> $_POST['EditarRetinosODId'],
						'auxiliares_avvl_v' 		=> $_POST['EditarAVVLRetinosOD'],
						'auxiliares_avvp_v' 		=> $_POST['EditarAVVPRetinosOD'],
						'auxiliares_tipo_pregunta_v' 	=> 'Retinoscopia',
						'auxiliares_od_id_v'		=> 'OD'
					);

					$nreRespuesta = ModeloHistorias::mdlActualizaDatosExtrasHistorias($tablaNew, $dataNewx);

					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,	
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaRetinosID'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroRetinosID'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeRetinosID'],
						'auxiliares_add_v' 			=> $_POST['EditarAddRetinosID'],
						'auxiliares_id_i' 			=> $_POST['EditarRetinosIDId'],
						'auxiliares_av_v' 			=> '0',
						'auxiliares_dp_v' 			=> '0',
						'auxiliares_tipo_pregunta_v' 	=> 'Retinoscopia',
						'auxiliares_od_id_v'		=> 'ID'
					);

					$nreRespuesta = ModeloHistorias::mdlActualizaDatosExtrasHistorias($tablaNew, $dataNewx);

					//SubJetivo
					/*$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaRXOD'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroRXOD'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeRXOD'],
						'auxiliares_add_v' 			=> $_POST['EditarAddRXOD'],
						'auxiliares_av_v' 			=> $_POST['EditarAvRXOD'],
						'auxiliares_dp_v' 			=> '0',
						'auxiliares_tipo_pregunta_v' 	=> 'SubJetivo',
						'auxiliares_od_id_v'		=> 'OD'
					);

					$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);

					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,	
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaRXID'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroRXID'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeRXID'],
						'auxiliares_add_v' 			=> $_POST['EditarAddRXID'],
						'auxiliares_av_v' 			=> $_POST['EditarAvRXID'],
						'auxiliares_dp_v' 			=> '0',
						'auxiliares_tipo_pregunta_v' 	=> 'SubJetivo',
						'auxiliares_od_id_v'		=> 'ID'
					);

					$nreRespuesta = ModeloHistorias::mdlIngresarDatosExtrasHistorias($tablaNew, $dataNewx);*/


					//Formula Final
					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaFormulaFinalOD'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroFormulaFinalOD'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeFormulaFinalOD'],
						'auxiliares_add_v' 			=> $_POST['EditarAddFormulaFinalOD'],
						'auxiliares_avvl_v' 		=> $_POST['EditarAVVLFormulaFinalOD'],
						'auxiliares_avvp_v' 		=> $_POST['EditarAVVPFormulaFinalOD'],
						'auxiliares_altura_foral_v' => $_POST['EditarAlturaForalFormulaFinalOD'],
						'auxiliares_dp_v' 			=> $_POST['EditarDpFormulaFinalOD'],
						'auxiliares_id_i' 			=> $_POST['EditarFormulaFinalODId'],
						'auxiliares_tipo_pregunta_v' 	=> 'Formula',
						'auxiliares_od_id_v'		=> 'OD'
					);

					$nreRespuesta = ModeloHistorias::mdlActualizaDatosExtrasHistorias($tablaNew, $dataNewx);

					$dataNewx = array(
						'auxiliares_historia_id_i' 	=> $historia,	
						'auxiliares_esfera_v' 		=> $_POST['EditarEsferaFormulaFinalID'],
						'auxiliares_cilindro_v' 	=> $_POST['EditarCilindroFormulaFinalID'],
						'auxiliares_eje_v' 			=> $_POST['EditarEjeFormulaFinalID'],
						'auxiliares_add_v' 			=> $_POST['EditarAddFormulaFinalID'],
						'auxiliares_avvl_v' 		=> $_POST['EditarAVVLFormulaFinalID'],
						'auxiliares_avvp_v' 		=> $_POST['EditarAVVPFormulaFinalID'],
						'auxiliares_altura_foral_v' => $_POST['EditarAlturaForalFormulaFinalID'],
						'auxiliares_dp_v' 			=> $_POST['EditarDpFormulaFinalID'],
						'auxiliares_id_i' 			=> $_POST['EditarFormulaFinalIDId'],
						'auxiliares_tipo_pregunta_v' 	=> 'Formula',
						'auxiliares_od_id_v'		=> 'ID'
					);

					$nreRespuesta = ModeloHistorias::mdlActualizaDatosExtrasHistorias($tablaNew, $dataNewx);

					$AntecedentesGenerales = $_POST['EditarAntGenerales'];

					foreach ($AntecedentesGenerales as $key => $value) {
						if(isset($value['per'])){
							$activa_per = 1;
						}else{
							$activa_per = 0;
						}
						if(isset($value['fam'])){
							$activa_fam = 1;
						}else{
							$activa_fam = 0;
						}
						$campos = 'antecedentes_id_i';
						$tabla = 'op_historias_antecedentes';
						$condiciones = "antecedentes_id_i = ".$value['id_antecedente'];
						$resultado = ModeloDao::mdlMostrarUnitario($campos, $tabla, $condiciones);
						if($resultado){
							$tabla = 'op_historias_antecedentes';
							$valores = "antecedentes_tipo_v = '".$value['tipo']."', antecedentes_categoria_v = '".$value['cat']."', antecedentes_personal_i = ".$activa_per.", antecedentes_familiar_i = ".$activa_fam.", antecedentes_nombre_cat_v = '".$value['nombre_cat']."'";
							$condiciones = "antecedentes_id_i = ".$value['id_antecedente'];
							ModeloDao::mdlEditar($tabla, $valores, $condiciones);
						}else{
							$tabla = 'op_historias_antecedentes';
							$campos = 'antecedentes_historia_id_i, antecedentes_tipo_v, antecedentes_categoria_v, antecedentes_personal_i, antecedentes_familiar_i, antecedentes_nombre_cat_v';
							$valores = $historia.",'".$value['tipo']."','".$value['cat']."',".$activa_per.",".$activa_fam.",'".$value['nombre_cat']."'";
							$resultado = ModeloDao::mdlCrear($tabla, $campos, $valores);
						}						
					}

					$AntecedentesOculares = $_POST['EditarAntOculares'];

					foreach ($AntecedentesOculares as $key => $value) {
						if(isset($value['per'])){
							$activa_per = 1;
						}else{
							$activa_per = 0;
						}
						$campos = 'antecedentes_id_i';
						$tabla = 'op_historias_antecedentes';
						$condiciones = "antecedentes_id_i = ".$value['id_antecedente'];
						$resultado = ModeloDao::mdlMostrarUnitario($tabla, $valores, $condiciones);
						if($resultado){
							$tabla = 'op_historias_antecedentes';
							$valores = "antecedentes_tipo_v = '".$value['tipo']."', antecedentes_categoria_v = '".$value['cat']."', antecedentes_personal_i = ".$activa_per.", antecedentes_nombre_cat_v = '".$value['nombre_cat']."'";
							$condiciones = "antecedentes_id_i = ".$value['id_antecedente'];
							ModeloDao::mdlEditar($tabla, $valores, $condiciones);
						}else{
							$tabla = 'op_historias_antecedentes';
							$campos = 'antecedentes_historia_id_i, antecedentes_tipo_v, antecedentes_categoria_v, antecedentes_personal_i, antecedentes_nombre_cat_v';
							$valores = $historia.",'".$value['tipo']."','".$value['cat']."',".$activa_per.",'".$value['nombre_cat']."'";
							ModeloDao::mdlCrear($tabla, $campos, $valores);
						}
					}

					echo "<script>
						swal({
							title  : 'Historia guardada!',
							type   : 'success',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"historias\"
						});
					</script>
					";
				}else{
					echo "<script>
						swal({
							title  : 'No se pudo guardar , no pudimos editar la historia!',
							type   : 'error',
							configButtonText : \"Cerrar\",
							closeOnConfirm: false
						},function(){
							window.location = \"historias\"
						});
					</script>
					";	
				}
			}
		}

		/* Eliminar Historias */
		static public function ctrBorrarHistorias(){

			if(isset($_GET["id_historia"])){
				$tabla ="op_historias";
				$datos = $_GET["id_historia"];

				$table = 'op_auxiliares';
				$campo = 'auxiliares_historia_id_i = '.$datos;
				//"Unknown column 'auxiliares_historia_id_i' in 'where clause'"
				$respuesta = ModeloDAO::mdlBorrar($table , $campo);

				$table = 'op_historias_antecedentes';
				$campo = 'antecedentes_historia_id_i = '.$datos;
				//"Unknown column 'auxiliares_historia_id_i' in 'where clause'"
				$respuesta = ModeloDAO::mdlBorrar($table , $campo);
				if($respuesta == 'ok'){

					$respuesta = ModeloHistorias::mdlBorrarHistorias($tabla, $datos);
					if($respuesta == "ok"){
						echo'<script>
						swal({
								type: "success",
								title: "Historia ha sido borrada correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							},
							function(result){	
								window.location = "historias"
							});
						</script>';
					}
				}else{
					echo "<script>
							swal({
								title  : 'No se pudo guardar , no pudimos Borrar las tablas auxiliares!',
								type   : 'error',
								configButtonText : \"Cerrar\",
								closeOnConfirm: false
							});
						</script>
						";	
				}		
			}
		}	

		static public function ctrNumeroHistorico(){
			$tabla = 'op_auxiliar_historia_numerico';
			$datos = 1;
			$respuesta = ModeloHistorias::mdlInsertarNumeroHistoria($tabla, $datos);
			$respuesta = date("y").str_pad($respuesta, 6, "0", STR_PAD_LEFT);
			return $respuesta;
		}


	}