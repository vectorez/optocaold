<?php
	/**
	* 
	*/

	class Conexion 
	{
		
		static public function conectar()
		{	
			//conexion PDO
			$link = new PDO("mysql:host=127.0.0.1;dbname=optica421", "root", "");
			//seteamos los caracteres latinos
			$link->exec("set names utf8");
			return $link;
		}
	}