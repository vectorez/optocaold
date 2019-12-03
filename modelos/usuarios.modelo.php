<?php
	require_once "conexion.php";
	/**
	* Manipular los usuarios del sistema
	*/
	class ModeloUsuarios
	{
		
		static public function mdlMostrarUsuarios($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN sys_perfiles ON perfiles_id_i = usuarios_perfil_id_i WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN sys_perfiles ON perfiles_id_i = usuarios_perfil_id_i WHERE usuarios_borrado_i = 0 AND usuarios_perfil_id_i != 7");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlMostrarUsuariosOptometra($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN sys_perfiles ON perfiles_id_i = usuarios_perfil_id_i WHERE $item = :$item AND usuarios_perfil_id_i = 7");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN sys_perfiles ON perfiles_id_i = usuarios_perfil_id_i WHERE usuarios_borrado_i = 0 AND usuarios_perfil_id_i = 7");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlIngresarUsuario($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuarios_nombres_v, usuarios_email_v, usuarios_contrasena_v, usuarios_perfil_id_i, usuarios_foto, usuarios_estado_i) VALUES(:usuarios_nombres_v, :usuarios_email_v, :usuarios_contrasena_v, :usuarios_perfil_id_i, :usuarios_foto, :usuarios_estado_i)");
			$stmt->bindParam(":usuarios_nombres_v", 	$datos['usuarios_nombres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_email_v", 		$datos['usuarios_email_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_contrasena_v", 	$datos['usuarios_contrasena_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_perfil_id_i", 	$datos['usuarios_perfil_id_i'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_foto", 			$datos['usuarios_foto'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_estado_i", 		$datos['usuarios_estado_i'], PDO::PARAM_STR);

			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlEditarUsuario($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuarios_nombres_v = :usuarios_nombres_v, usuarios_email_v = :usuarios_email_v, usuarios_contrasena_v =  :usuarios_contrasena_v, usuarios_perfil_id_i = :usuarios_perfil_id_i, usuarios_foto = :usuarios_foto, usuarios_estado_i =  :usuarios_estado_i WHERE usuarios_id_i = :usuarios_id_i ");
			$stmt->bindParam(":usuarios_nombres_v", 	$datos['usuarios_nombres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_email_v", 		$datos['usuarios_email_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_contrasena_v", 	$datos['usuarios_contrasena_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_perfil_id_i", 	$datos['usuarios_perfil_id_i'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_foto", 			$datos['usuarios_foto'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_estado_i", 		$datos['usuarios_estado_i'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_id_i", 			$datos['usuarios_id_i'], PDO::PARAM_INT);
			
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}

		/* Actualizar usuario */
		
		static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
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

		static public function mdlBorrarUsuario($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuarios_borrado_i = 1 WHERE usuarios_id_i = :usuarios_id_i");
			$stmt -> bindParam(":usuarios_id_i", $datos, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlIngresarOptometra($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuarios_nombres_v, usuarios_email_v, usuarios_telefono_v, usuarios_perfil_id_i, usuarios_firma_v, usuarios_estado_i, usuarios_cedula_v, usuarios_tarjeta_v, usuarios_contrasena_v) VALUES(:usuarios_nombres_v, :usuarios_email_v, :usuarios_telefono_v, :usuarios_perfil_id_i, :usuarios_firma_v, :usuarios_estado_i, :usuarios_cedula_v, :usuarios_tarjeta_v, :usuarios_contrasena_v)");
			
			$stmt->bindParam(":usuarios_nombres_v", 	$datos['usuarios_nombres_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_email_v", 		$datos['usuarios_email_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_telefono_v", 	$datos['usuarios_telefono_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_perfil_id_i", 	$datos['usuarios_perfil_id_i'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_firma_v", 		$datos['usuarios_firma_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_estado_i", 		$datos['usuarios_estado_i'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_cedula_v", 		$datos['usuarios_cedula_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_tarjeta_v", 	$datos['usuarios_tarjeta_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_contrasena_v", 	$datos['usuarios_contrasena_v'], 	PDO::PARAM_STR);

			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlEditarOptometra($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuarios_nombres_v = :usuarios_nombres_v, usuarios_email_v = :usuarios_email_v, usuarios_telefono_v =  :usuarios_telefono_v, usuarios_perfil_id_i = :usuarios_perfil_id_i,  usuarios_firma_v = :usuarios_firma_v, usuarios_estado_i =  :usuarios_estado_i, usuarios_cedula_v = :usuarios_cedula_v , usuarios_tarjeta_v = :usuarios_tarjeta_v, usuarios_contrasena_v = :usuarios_contrasena_v WHERE usuarios_id_i = :usuarios_id_i ");
			$stmt->bindParam(":usuarios_nombres_v", 	$datos['usuarios_nombres_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_email_v", 		$datos['usuarios_email_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_telefono_v", 	$datos['usuarios_telefono_v'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_perfil_id_i", 	$datos['usuarios_perfil_id_i'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_firma_v", 		$datos['usuarios_firma_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_estado_i", 		$datos['usuarios_estado_i'], PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_id_i", 			$datos['usuarios_id_i'], PDO::PARAM_INT);
			$stmt->bindParam(":usuarios_cedula_v", 		$datos['usuarios_cedula_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_tarjeta_v", 	$datos['usuarios_tarjeta_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":usuarios_contrasena_v", 	$datos['usuarios_contrasena_v'], 	PDO::PARAM_STR);
			
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}
	}