<?php
	require_once "conexion.php";
	
	class ModeloDAO
	{
		static public function mdlMostrar($campo,$tabla,$condicion){
			if($condicion==""){
				//si no tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				//si tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlMostrarGroupAndOrder($campo,$tabla,$condicion, $groupBy = null, $orderBy = null){
			if($condicion==""){
				//si no tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla $groupBy $orderBy");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				//si tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion $groupBy $orderBy");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			
			$stmt->close();
			$stmt = null;

		}


		static public function mdlMostrarUnitario($campo,$tabla,$condicion){
			if($condicion==""){
				//si no tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
				$stmt->execute();
				return $stmt->fetch();
			}else{
				//si tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
				$stmt->execute();
				return $stmt->fetch();
			}
			
			$stmt->close();
			$stmt = null;

		}

		static public function mdlCrear($tabla, $campos, $valores){
			$pdo  = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO $tabla ($campos) VALUES($valores)");
			if($stmt->execute()){
				return $pdo->lastInsertId();
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}


		static public function mdlEditar($tabla, $datos, $condicion){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $datos WHERE $condicion");
			if($stmt->execute()){
				return 'ok';
			}else{
				return $stmt->errorInfo();
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlBorrar($tabla, $condicion){
			if($condicion==""){
				$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");
			}else{
				$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $condicion");
			}
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlAlter($tabla,$opciones){

			//si no tiene condicion
			$stmt = Conexion::conectar()->prepare("ALTER TABLE $tabla $opciones");
			if($stmt -> execute()){
				return 'ok';
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;

		}

	}