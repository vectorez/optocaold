<?php
	require_once "conexion.php";
	/**
	* Manipular los usuarios del sistema
	*/
	class ModeloPacientes
	{

		static public function mdlMostrarPacientes($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pacientes_estado_i = 1");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlIngresarPacientes($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (pacientes_tipo_doc_v, pacientes_documento_v, pacientes_nombres_v, pacientes_apellidos_v, pacientes_estado_civil_v, pacientes_fecha_nacimiento_d, pacientes_sexo_v, pacientes_ocupacion_v, pacientes_lugar_recidencia_v, pacientes_direccion_v, pacientes_telefono_v) VALUES(:pacientes_tipo_doc_v, :pacientes_documento_v, :pacientes_nombres_v, :pacientes_apellidos_v, :pacientes_estado_civil_v, :pacientes_fecha_nacimiento_d, :pacientes_sexo_v, :pacientes_ocupacion_v, :pacientes_lugar_recidencia_v, :pacientes_direccion_v, :pacientes_telefono_v)");
			$stmt->bindParam(":pacientes_tipo_doc_v", 			$datos['pacientes_tipo_doc_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_documento_v", 			$datos['pacientes_documento_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_nombres_v", 			$datos['pacientes_nombres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_apellidos_v", 			$datos['pacientes_apellidos_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_estado_civil_v", 		$datos['pacientes_estado_civil_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_fecha_nacimiento_d", 	$datos['pacientes_fecha_nacimiento_d'], 	PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_sexo_v", 				$datos['pacientes_sexo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_ocupacion_v", 			$datos['pacientes_ocupacion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_lugar_recidencia_v", 	$datos['pacientes_lugar_recidencia_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_direccion_v", 			$datos['pacientes_direccion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_telefono_v", 			$datos['pacientes_telefono_v'], PDO::PARAM_STR);

			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlEditarPacientes($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pacientes_tipo_doc_v = :pacientes_tipo_doc_v, pacientes_documento_v = :pacientes_documento_v, pacientes_nombres_v = :pacientes_nombres_v, pacientes_apellidos_v = :pacientes_apellidos_v, pacientes_estado_civil_v = :pacientes_estado_civil_v, pacientes_fecha_nacimiento_d = :pacientes_fecha_nacimiento_d, pacientes_sexo_v = :pacientes_sexo_v, pacientes_ocupacion_v = :pacientes_ocupacion_v, pacientes_lugar_recidencia_v = :pacientes_lugar_recidencia_v, pacientes_direccion_v = :pacientes_direccion_v, pacientes_telefono_v = :pacientes_telefono_v WHERE pacientes_id_i = :pacientes_id_i ");
			
			$stmt->bindParam(":pacientes_tipo_doc_v", 			$datos['pacientes_tipo_doc_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_documento_v", 			$datos['pacientes_documento_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_nombres_v", 			$datos['pacientes_nombres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_apellidos_v", 			$datos['pacientes_apellidos_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_estado_civil_v", 		$datos['pacientes_estado_civil_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_fecha_nacimiento_d", 	$datos['pacientes_fecha_nacimiento_d'], 	PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_sexo_v", 				$datos['pacientes_sexo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_ocupacion_v", 			$datos['pacientes_ocupacion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_lugar_recidencia_v", 	$datos['pacientes_lugar_recidencia_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_direccion_v", 			$datos['pacientes_direccion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_telefono_v", 			$datos['pacientes_telefono_v'], PDO::PARAM_STR);
			$stmt->bindParam(":pacientes_id_i", 				$datos['pacientes_id_i'], PDO::PARAM_INT);

			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}

		/* Actualizar usuario */
		
		static public function mdlActualizarPacientes($tabla, $item1, $valor1, $item2, $valor2){
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

		static public function mdlBorrarPacientes($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pacientes_estado_i = 0 WHERE pacientes_id_i = :pacientes_id_i");
			$stmt -> bindParam(":pacientes_id_i", $datos, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

	}