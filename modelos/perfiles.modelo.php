<?php
	require_once "conexion.php";
	/**
	* Manipular los usuarios del sistema
	*/
	class ModeloPerfiles
	{
		
		static public function mdlMostrarPerfiles($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlMostrarListaPerfiles($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlMostrarMenusPermisos($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item GROUP BY perfiles_permisos_menu_id_i");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlMostrarMenus($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY menus_nombre_v ASC");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY menus_nombre_v ASC");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlMostrarOpciones($tabla, $item, $valor){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND opciones_padre_id_i <= 0 ORDER BY opciones_nombre_v ASC");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE opciones_padre_id_i <= 0 ORDER BY opciones_nombre_v ASC");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			
			$stmt->close();
			$stmt = null;

		}



		/* eliminar Perfiles */
		
		static public function mdlBorrarPerfil($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE perfiles_id_i = :perfiles_id_i");
			$stmt -> bindParam(":perfiles_id_i", $datos, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		/* activar o desactivar y por si acaso */
		
		static public function mdlActualizarPerfiles($tabla, $item1, $valor1, $item2, $valor2){
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


		static public function mdlIngresarPerfiles($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (perfiles_proyectos_id_i, perfiles_descripcion_v, perfilies_estado_i) VALUES(:perfiles_proyectos_id_i, :perfiles_descripcion_v, :perfilies_estado_i)");
			$stmt->bindParam(":perfiles_proyectos_id_i", $datos['perfiles_proyectos_id_i'], PDO::PARAM_STR);
			$stmt->bindParam(":perfiles_descripcion_v", $datos['perfiles_descripcion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":perfilies_estado_i", 	$datos['perfilies_estado_i'], PDO::PARAM_STR);
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlEditarPerfiles($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET perfiles_proyectos_id_i = :perfiles_proyectos_id_i, perfiles_descripcion_v = :perfiles_descripcion_v, perfilies_estado_i = :perfilies_estado_i WHERE perfiles_id_i = :perfiles_id_i ");

			$stmt->bindParam(":perfiles_proyectos_id_i", $datos['perfiles_proyectos_id_i'], PDO::PARAM_STR);
			$stmt->bindParam(":perfiles_descripcion_v", $datos['perfiles_descripcion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":perfilies_estado_i", 	$datos['perfilies_estado_i'], PDO::PARAM_STR);
			$stmt->bindParam(":perfiles_id_i", 			$datos['perfiles_id_i'], PDO::PARAM_STR);
			
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}


		/* ingrease nuevos menus */
		static public function mdlIngresarMenu($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (perfiles_permisos_perfil_id_i, perfiles_permisos_menu_id_i,perfiles_permisos_opciones_id_i) VALUES(:perfiles_permisos_perfil_id_i, :perfiles_permisos_menu_id_i,:perfiles_permisos_opciones_id_i)");
			$stmt->bindParam(":perfiles_permisos_perfil_id_i",  $datos['perfiles_permisos_perfil_id_i'], PDO::PARAM_INT);
			$stmt->bindParam(":perfiles_permisos_menu_id_i",	$datos['perfiles_permisos_menu_id_i'], PDO::PARAM_INT);
			$stmt->bindParam(":perfiles_permisos_opciones_id_i",	$datos['perfiles_permisos_opciones_id_i'], PDO::PARAM_INT);
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'Error';
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlBorrarPermisos($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE perfiles_permisos_perfil_id_i = :perfiles_permisos_perfil_id_i");
			$stmt -> bindParam(":perfiles_permisos_perfil_id_i", $datos, PDO::PARAM_INT);		
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		

	}