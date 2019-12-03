<?php
	require_once "conexion.php";
	/**
	* Manipular los usuarios del sistema
	*/
	class ModeloHistorias
	{

		static public function mdlMostrarHistorias($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla JOIN op_pacientes ON pacientes_id_i = historias_paciente_id_i LEFT JOIN sys_usuarios ON historias_optometra_v = usuarios_id_i WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla JOIN op_pacientes ON pacientes_id_i = historias_paciente_id_i LEFT JOIN sys_usuarios ON historias_optometra_v = usuarios_id_i");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlMostrarAuxiliaresHistorias($tabla, $item, $valor, $valor2){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND auxiliares_tipo_pregunta_v = :auxiliares_tipo_pregunta_v");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->bindParam(":auxiliares_tipo_pregunta_v" , $valor2,  PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE auxiliares_tipo_pregunta_v = :auxiliares_tipo_pregunta_v");
				$stmt->bindParam(":auxiliares_tipo_pregunta_v" , $valor2,  PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll();
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlIngresarHistorias($tabla, $datos){
			$pdo = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO $tabla (historias_paciente_id_i, historias_acudiente_v, historias_telefono_acudiente_v, historias_aseguradora_v, historias_tipo_afiliacion_v, historias_semanas_cotizadas, historias_antecedentes_familiares, historias_oftalmoscopia_v, historias_excavacion_od_v, historias_reflejos_pulpilres_v, historias_motilidad_ocular_v, historias_ortoforia_vl_v, historias_ortoforia_vp_v, historias_examenes_complementarios_v, historias_queratometria_od_v, historias_queratometria_id_v, historias_tonometria_od_v, historias_tonometria_oi_v, historias_tipo_tonometro_v, historias_test_acomodativo_v, historias_resultado_v, historias_test_amsier_v, historias_test_color_derecho_v, historias_test_estereopsis_v, historias_descripcion_v, historias_diagnostico_principal_v, historias_diagnostico_segundario_v, historias_otros_diagnosticos_v, historias_conducta_v, historias_remision_justi_v, historias_optometra_v, historias_sin_correcion_od_v, historias_sin_correcion_id_v, historias_con_correcion_od_v, historias_con_correcion_id_v, historias_con_estenopeico_od_v, historias_con_estenopeico_id_v , historias_numero_v, historia_prentesco_v, historia_antecedentes_personales_v, historias_biomocrospia_v, historia_tipo_lente_v, historia_excavacion_oi_v, historias_acudiente_responsable_v, historias_telefono_acudiente_responsable_v, historia_prentesco_responsable_v, historias_test_color_izquierdo_v, historias_observaciones_v, historias_antecedentes_oculares_v, historias_uv_id_v, historias_uv_od_v) VALUES (:historias_paciente_id_i, :historias_acudiente_v, :historias_telefono_acudiente_v, :historias_aseguradora_v, :historias_tipo_afiliacion_v, :historias_semanas_cotizadas, :historias_antecedentes_familiares, :historias_oftalmoscopia_v, :historias_excavacion_od_v, :historias_reflejos_pulpilres_v, 				:historias_motilidad_ocular_v, :historias_ortoforia_vl_v, :historias_ortoforia_vp_v, :historias_examenes_complementarios_v, :historias_queratometria_od_v, :historias_queratometria_id_v, :historias_tonometria_od_v, :historias_tonometria_oi_v, :historias_tipo_tonometro_v, :historias_test_acomodativo_v, :historias_resultado_v, :historias_test_amsier_v, :historias_test_color_derecho_v, :historias_test_estereopsis_v, :historias_descripcion_v, :historias_diagnostico_principal_v, :historias_diagnostico_segundario_v, :historias_otros_diagnosticos_v, :historias_conducta_v, :historias_remision_justi_v, :historias_optometra_v, :historias_sin_correcion_od_v, :historias_sin_correcion_id_v, :historias_con_correcion_od_v, :historias_con_correcion_id_v, :historias_con_estenopeico_od_v, :historias_con_estenopeico_id_v, :historias_numero_v, :historia_prentesco_v, :historia_antecedentes_personales_v, :historias_biomocrospia_v, :historia_tipo_lente_v, :historia_excavacion_oi_v,  :historias_acudiente_responsable_v, :historias_telefono_acudiente_responsable_v, :historia_prentesco_responsable_v, :historias_test_color_izquierdo_v, :historias_observaciones_v, :historias_antecedentes_oculares_v, :historias_uv_id_v, :historias_uv_od_v)");

			$stmt->bindParam(":historias_paciente_id_i", 					$datos['historias_paciente_id_i'], PDO::PARAM_INT);
			$stmt->bindParam(":historias_acudiente_v", 						$datos['historias_acudiente_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_telefono_acudiente_v", 			$datos['historias_telefono_acudiente_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_aseguradora_v", 					$datos['historias_aseguradora_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tipo_afiliacion_v", 				$datos['historias_tipo_afiliacion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_semanas_cotizadas", 				$datos['historias_semanas_cotizadas'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_antecedentes_familiares", 			$datos['historias_antecedentes_familiares'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_oftalmoscopia_v", 					$datos['historias_oftalmoscopia_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_excavacion_od_v", 					$datos['historias_excavacion_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_reflejos_pulpilres_v", 			$datos['historias_reflejos_pulpilres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_motilidad_ocular_v", 				$datos['historias_motilidad_ocular_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_ortoforia_vl_v", 					$datos['historias_ortoforia_vl_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_ortoforia_vp_v", 					$datos['historias_ortoforia_vp_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_examenes_complementarios_v", 		$datos['historias_examenes_complementarios_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_queratometria_od_v", 				$datos['historias_queratometria_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_queratometria_id_v", 				$datos['historias_queratometria_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tonometria_od_v", 					$datos['historias_tonometria_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tonometria_oi_v", 					$datos['historias_tonometria_oi_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tipo_tonometro_v", 				$datos['historias_tipo_tonometro_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_acomodativo_v", 				$datos['historias_test_acomodativo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_resultado_v", 						$datos['historias_resultado_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_amsier_v", 					$datos['historias_test_amsier_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_color_derecho_v", 			$datos['historias_test_color_derecho_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_color_izquierdo_v", 			$datos['historias_test_color_izquierdo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_estereopsis_v", 				$datos['historias_test_estereopsis_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_descripcion_v", 					$datos['historias_descripcion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_diagnostico_principal_v", 			$datos['historias_diagnostico_principal_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_diagnostico_segundario_v", 		$datos['historias_diagnostico_segundario_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_otros_diagnosticos_v", 			$datos['historias_otros_diagnosticos_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_conducta_v", 						$datos['historias_conducta_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_remision_justi_v", 				$datos['historias_remision_justi_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_optometra_v", 						$datos['historias_optometra_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_sin_correcion_od_v", 				$datos['historias_sin_correcion_od_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_sin_correcion_id_v", 				$datos['historias_sin_correcion_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_correcion_od_v", 				$datos['historias_con_correcion_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_correcion_id_v", 				$datos['historias_con_correcion_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_estenopeico_od_v", 			$datos['historias_con_estenopeico_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_estenopeico_id_v", 			$datos['historias_con_estenopeico_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_numero_v", 						$datos['historias_numero_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_prentesco_v", 						$datos['historia_prentesco_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_antecedentes_personales_v", 		$datos['historia_antecedentes_personales_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_biomocrospia_v", 					$datos['historias_biomocrospia_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_tipo_lente_v", 						$datos['historia_tipo_lente_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_excavacion_oi_v", 					$datos['historia_excavacion_oi_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_acudiente_responsable_v", 			$datos['historias_acudiente_responsable_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_telefono_acudiente_responsable_v", $datos['historias_telefono_acudiente_responsable_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_prentesco_responsable_v", 			$datos['historia_prentesco_responsable_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_observaciones_v", 					$datos['historias_observaciones_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_antecedentes_oculares_v", 			$datos['historias_antecedentes_oculares_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_uv_id_v", 							$datos['historias_uv_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_uv_od_v", 							$datos['historias_uv_od_v'], PDO::PARAM_STR);

			if($stmt->execute()){
				return $pdo->lastInsertId();
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlEditarHistorias($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET historias_acudiente_v = :historias_acudiente_v, historias_telefono_acudiente_v = :historias_telefono_acudiente_v, historias_aseguradora_v = :historias_aseguradora_v, historias_tipo_afiliacion_v = :historias_tipo_afiliacion_v, historias_semanas_cotizadas = :historias_semanas_cotizadas, historias_antecedentes_familiares = :historias_antecedentes_familiares, historias_oftalmoscopia_v = :historias_oftalmoscopia_v, historias_excavacion_od_v = :historias_excavacion_od_v, historias_reflejos_pulpilres_v = :historias_reflejos_pulpilres_v, historias_motilidad_ocular_v = :historias_motilidad_ocular_v, historias_ortoforia_vl_v = :historias_ortoforia_vl_v, historias_ortoforia_vp_v = :historias_ortoforia_vp_v, historias_examenes_complementarios_v = :historias_examenes_complementarios_v, historias_queratometria_od_v = :historias_queratometria_od_v, historias_queratometria_id_v = :historias_queratometria_id_v, historias_tonometria_od_v = :historias_tonometria_od_v, historias_tonometria_oi_v = :historias_tonometria_oi_v, historias_tipo_tonometro_v = :historias_tipo_tonometro_v , historias_test_acomodativo_v = :historias_test_acomodativo_v, historias_resultado_v = :historias_resultado_v, historias_test_amsier_v = :historias_test_amsier_v, historias_test_color_derecho_v = :historias_test_color_derecho_v,  historias_test_estereopsis_v = :historias_test_estereopsis_v, historias_descripcion_v = :historias_descripcion_v, historias_diagnostico_principal_v = :historias_diagnostico_principal_v, historias_diagnostico_segundario_v = :historias_diagnostico_segundario_v, historias_otros_diagnosticos_v = :historias_otros_diagnosticos_v, historias_conducta_v = :historias_conducta_v, historias_remision_justi_v = :historias_remision_justi_v, historias_optometra_v = :historias_optometra_v , historias_sin_correcion_od_v = :historias_sin_correcion_od_v, historias_sin_correcion_id_v = :historias_sin_correcion_id_v , historias_con_correcion_od_v = :historias_con_correcion_od_v, historias_con_correcion_id_v = :historias_con_correcion_id_v, historias_con_estenopeico_od_v = :historias_con_estenopeico_od_v, historias_con_estenopeico_id_v = :historias_con_estenopeico_id_v, historia_antecedentes_personales_v = :historia_antecedentes_personales_v , historia_prentesco_v = :historia_prentesco_v , historias_biomocrospia_v = :historias_biomocrospia_v, historia_tipo_lente_v = :historia_tipo_lente_v, historia_excavacion_oi_v = :historia_excavacion_oi_v , historias_acudiente_responsable_v =:historias_acudiente_responsable_v, historias_telefono_acudiente_responsable_v = :historias_telefono_acudiente_responsable_v, historia_prentesco_responsable_v = :historia_prentesco_responsable_v, historias_test_color_izquierdo_v = :historias_test_color_izquierdo_v, historias_observaciones_v = :historias_observaciones_v, historias_antecedentes_oculares_v = :historias_antecedentes_oculares_v, historias_uv_id_v = :historias_uv_id_v, historias_uv_od_v = :historias_uv_od_v WHERE historias_id_i = :historias_id_i ");
			
			$stmt->bindParam(":historias_acudiente_v", 						$datos['historias_acudiente_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_telefono_acudiente_v", 			$datos['historias_telefono_acudiente_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_aseguradora_v", 					$datos['historias_aseguradora_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tipo_afiliacion_v", 				$datos['historias_tipo_afiliacion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_semanas_cotizadas", 				$datos['historias_semanas_cotizadas'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_antecedentes_familiares", 			$datos['historias_antecedentes_familiares'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_oftalmoscopia_v", 					$datos['historias_oftalmoscopia_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_excavacion_od_v", 					$datos['historias_excavacion_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_reflejos_pulpilres_v", 			$datos['historias_reflejos_pulpilres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_motilidad_ocular_v", 				$datos['historias_motilidad_ocular_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_ortoforia_vl_v", 					$datos['historias_ortoforia_vl_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_ortoforia_vp_v", 					$datos['historias_ortoforia_vp_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_examenes_complementarios_v", 		$datos['historias_examenes_complementarios_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_queratometria_od_v", 				$datos['historias_queratometria_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_queratometria_id_v", 				$datos['historias_queratometria_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tonometria_od_v", 					$datos['historias_tonometria_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tonometria_oi_v", 					$datos['historias_tonometria_oi_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_tipo_tonometro_v", 				$datos['historias_tipo_tonometro_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_acomodativo_v", 				$datos['historias_test_acomodativo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_resultado_v", 						$datos['historias_resultado_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_amsier_v", 					$datos['historias_test_amsier_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_color_derecho_v", 			$datos['historias_test_color_derecho_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_estereopsis_v", 				$datos['historias_test_estereopsis_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_descripcion_v", 					$datos['historias_descripcion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_diagnostico_principal_v", 			$datos['historias_diagnostico_principal_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_diagnostico_segundario_v", 		$datos['historias_diagnostico_segundario_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_otros_diagnosticos_v", 			$datos['historias_otros_diagnosticos_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_conducta_v", 						$datos['historias_conducta_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_remision_justi_v", 				$datos['historias_remision_justi_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_optometra_v", 						$datos['historias_optometra_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_sin_correcion_od_v", 				$datos['historias_sin_correcion_od_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":historias_sin_correcion_id_v", 				$datos['historias_sin_correcion_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_correcion_od_v", 				$datos['historias_con_correcion_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_correcion_id_v", 				$datos['historias_con_correcion_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_estenopeico_od_v", 			$datos['historias_con_estenopeico_od_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_con_estenopeico_id_v", 			$datos['historias_con_estenopeico_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_id_i", 							$datos['historias_id_i'], PDO::PARAM_INT);
			$stmt->bindParam(":historia_prentesco_v", 						$datos['historia_prentesco_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_antecedentes_personales_v", 		$datos['historia_antecedentes_personales_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_biomocrospia_v", 					$datos['historias_biomocrospia_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_tipo_lente_v", 						$datos['historia_tipo_lente_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_excavacion_oi_v", 					$datos['historia_excavacion_oi_v'], PDO::PARAM_STR);

			$stmt->bindParam(":historias_acudiente_responsable_v", 			$datos['historias_acudiente_responsable_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_telefono_acudiente_responsable_v", $datos['historias_telefono_acudiente_responsable_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historia_prentesco_responsable_v", 			$datos['historia_prentesco_responsable_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_test_color_izquierdo_v", 			$datos['historias_test_color_izquierdo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_observaciones_v", 					$datos['historias_observaciones_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_antecedentes_oculares_v", 			$datos['historias_antecedentes_oculares_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_uv_id_v", 							$datos['historias_uv_id_v'], PDO::PARAM_STR);
			$stmt->bindParam(":historias_uv_od_v", 							$datos['historias_uv_od_v'], PDO::PARAM_STR);

			if($stmt->execute()){
				return 'ok';
			}else{
				return $stmt->ErrorInfo();
			}
			$stmt->close();
			$stmt = null;
		}

		/* Actualizar usuario */
		
		static public function mdlActualizarHistorias($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  $item1 = :$item1 WHERE $item2 = :$item2");
			$stmt->bindParam(":".$item1, 	$valor1, 	PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, 	$valor2, 	PDO::PARAM_STR);
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlBorrarHistorias($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE historias_id_i = :historias_id_i");
			$stmt -> bindParam(":historias_id_i", $datos, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlInsertarNumeroHistoria($tabla, $datos){
			$pdo = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO $tabla (auxiliar_numero_i) VALUES (:auxiliar_numero_i)");
			$stmt -> bindParam(":auxiliar_numero_i", $datos, PDO::PARAM_INT);
			if($stmt -> execute()){
				return $pdo->lastInsertId();
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlIngresarDatosExtrasHistorias($tabla , $datos){
			$pdo = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO $tabla (auxiliares_historia_id_i, auxiliares_esfera_v, auxiliares_cilindro_v, auxiliares_eje_v, auxiliares_add_v, auxiliares_av_v, auxiliares_dp_v, auxiliares_tipo_pregunta_v, auxiliares_od_id_v, auxiliares_auv_v ) VALUES (:auxiliares_historia_id_i, :auxiliares_esfera_v, :auxiliares_cilindro_v, :auxiliares_eje_v, :auxiliares_add_v, :auxiliares_av_v, :auxiliares_dp_v, :auxiliares_tipo_pregunta_v, :auxiliares_od_id_v, :auxiliares_auv_v)");
			
			$stmt -> bindParam(":auxiliares_historia_id_i", 	$datos['auxiliares_historia_id_i'], 	PDO::PARAM_INT);
			$stmt -> bindParam(":auxiliares_esfera_v", 			$datos['auxiliares_esfera_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_cilindro_v", 		$datos['auxiliares_cilindro_v'], 		PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_eje_v", 			$datos['auxiliares_eje_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_add_v", 			$datos['auxiliares_add_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_av_v", 				$datos['auxiliares_av_v'], 				PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_auv_v", 			$datos['auxiliares_auv_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_dp_v", 				$datos['auxiliares_dp_v'], 				PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_tipo_pregunta_v", 	$datos['auxiliares_tipo_pregunta_v'], 	PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_od_id_v", 			$datos['auxiliares_od_id_v'], 			PDO::PARAM_STR);
			
			if($stmt -> execute()){
				return $pdo->lastInsertId();
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlActualizaDatosExtrasHistorias($tabla , $datos){
			$pdo = Conexion::conectar();
			$stmt = $pdo->prepare("UPDATE $tabla SET auxiliares_esfera_v = :auxiliares_esfera_v, auxiliares_cilindro_v = :auxiliares_cilindro_v, auxiliares_eje_v = :auxiliares_eje_v, auxiliares_add_v = :auxiliares_add_v, auxiliares_av_v = :auxiliares_av_v, auxiliares_dp_v = :auxiliares_dp_v, auxiliares_tipo_pregunta_v = :auxiliares_tipo_pregunta_v, auxiliares_od_id_v = :auxiliares_od_id_v, auxiliares_auv_v = :auxiliares_auv_v WHERE auxiliares_historia_id_i = :auxiliares_historia_id_i AND auxiliares_id_i = :auxiliares_id_i");
			
			$stmt -> bindParam(":auxiliares_historia_id_i", 	$datos['auxiliares_historia_id_i'], 	PDO::PARAM_INT);
			$stmt -> bindParam(":auxiliares_id_i", 				$datos['auxiliares_id_i'], 				PDO::PARAM_INT);
			$stmt -> bindParam(":auxiliares_esfera_v", 			$datos['auxiliares_esfera_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_cilindro_v", 		$datos['auxiliares_cilindro_v'], 		PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_eje_v", 			$datos['auxiliares_eje_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_add_v", 			$datos['auxiliares_add_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_av_v", 				$datos['auxiliares_av_v'], 				PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_auv_v", 			$datos['auxiliares_auv_v'], 			PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_dp_v", 				$datos['auxiliares_dp_v'], 				PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_tipo_pregunta_v", 	$datos['auxiliares_tipo_pregunta_v'], 	PDO::PARAM_STR);
			$stmt -> bindParam(":auxiliares_od_id_v", 			$datos['auxiliares_od_id_v'], 			PDO::PARAM_STR);
			
			if($stmt -> execute()){
				return $pdo->lastInsertId();
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

	}