<?php
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=Pacientes.xls");

	echo "<table>";
		echo "<thead>
				<tr>
					<th>#</th>
					<th>Tipo Documento</th>
					<th>Documento</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Lugar de residencia</th>
					<th>Direcci&oacute;n</th>
					<th>Tel&eacute;fono</th>
					<th>Ocupaci&oacute;n</th>
					<th>Genero</th>
					<th>Fecha Nacimiento</th>
					<th>Edad</th>
					<th>Estado Civil</th>
				</tr>
			</thead>
			<tbody>";
	$item = NULL;
	$valor = NULL;
	$i = 0;
	$respuesta = controladorPacientes::ctrMostrarPacientes($item, $valor);
	foreach ($respuesta as $key => $value) {
		echo "<tr>";
			echo "<td>".($key+1)."</td>";
			echo "<td>".sanear_string($value["pacientes_tipo_doc_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_documento_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_nombres_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_apellidos_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_lugar_recidencia_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_direccion_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_telefono_v"])."</td>";
			echo "<td>".sanear_string($value["pacientes_ocupacion_v"])."</td>";
			echo "<td>".$value["pacientes_sexo_v"]."</td>";
			echo "<td>".$value["pacientes_fecha_nacimiento_d"]."</td>";
			echo "<td>".getEdad($value["pacientes_fecha_nacimiento_d"])."</td>";
			echo "<td>".sanear_string($value["pacientes_estado_civil_v"])."</td>";
		echo "</tr>";
	}	

	echo "</tbody>
	</table>";

	function getEdad($fecha){
		$cumpleanos = new DateTime($fecha);
	    $hoy = new DateTime();
	    $annos = $hoy->diff($cumpleanos);
	    return $annos->y;
	}

	function sanear_string($string) { 
	    $string = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string );
	    $string = str_replace( array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string ); 
	    $string = str_replace( array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string ); 
	    $string = str_replace( array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string ); 
	    $string = str_replace( array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string ); 
	    $string = str_replace( array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string ); 
	    //Esta parte se encarga de eliminar cualquier caracter extraño 
	    //$string = str_replace( array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">“, “< ", ";", ",", ":", "."), '', $string ); 
	    return $string; 
	}
?>