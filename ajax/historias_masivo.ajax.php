<?php 
	date_default_timezone_set('America/Bogota');
	set_time_limit(0);
	require_once '../modelos/historias.modelo.php';
	require_once '../controladores/historias.controlador.php';
	require_once '../modelos/dao.modelo.php';
	require_once '../vistas/plugins/dompdf/autoload.inc.php';

	$campos = '*';
	$tabla = 'op_historias JOIN op_pacientes ON pacientes_id_i = historias_paciente_id_i LEFT JOIN sys_usuarios ON historias_optometra_v = usuarios_id_i';
	$condicion = "historias_fecha_d >= '".$_POST['fecha_inicio']." 00:00:00' AND historias_fecha_d <= '".$_POST['fecha_final']." 23:59:59'";
	$respuesta = ModeloDao::mdlMostrar($campos, $tabla, $condicion);

	if(count($respuesta) == 0){
		echo 'Nohay';
		exit;
	}

	$campos = "*";
	$tabla = "op_configuracion";
	$condicion = "configuracion_id_i=1";
	$configuracion = ModeloDAO::mdlMostrarUnitario($campos, $tabla, $condicion);

	function getEdad($fecha){
		$cumpleanos = new DateTime($fecha);
	    $hoy = new DateTime();
	    $annos = $hoy->diff($cumpleanos);
	    return $annos->y;
	}

	use Dompdf\Dompdf;
	$nombre_archivo = "tmp/Historias_".date('Ymd')."_".date('His').".zip";
	// Creamos un instancia de la clase ZipArchive
	$zip = new ZipArchive();
	// Creamos y abrimos un archivo zip temporal
	$zip->open("../".$nombre_archivo,ZipArchive::CREATE);

	foreach ($respuesta as $key => $historia_foreach) {

		$dompdf = new DOMPDF();
		$dompdf->set_option('enable_html5_parser', TRUE);
		$dompdf->setPaper("A4", "landscape");


		$item = 'auxiliares_historia_id_i';
		$valor = $historia_foreach['historias_id_i'];
		$valor2 = 'Lensometria';
		$Lensometria = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

		$valor2 = 'Retinoscopia';
		$Retinoscopia = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

		$valor2 = 'Formula';
		$Formula = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

		$campos = "*";
		$tabla = "op_historias_antecedentes";
		$condicion = "antecedentes_historia_id_i = ".$historia_foreach['historias_id_i'];
		$antecedentes = ModeloDAO::mdlMostrar($campos, $tabla, $condicion);

		$contador = 0;
		$html_antecedentes_gen = '';
		foreach ($antecedentes as $key => $value) {
			if($value['antecedentes_tipo_v'] == 'Gen'){
				$contador++;
				if($contador == 1){
					$html_antecedentes_gen.= '<tr style="text-align: justify;">';
				}
				$src_per = '';
				$src_fam = '';
				if($value['antecedentes_personal_i'] == 1){
					$src_per = "../vistas/img/plantilla/check-mark.png";
					$src_per = '<img src="'.$src_per.'" style="height: 10px; wight: 10px;">';
				}
				if($value['antecedentes_familiar_i'] == 1){
					$src_fam = "../vistas/img/plantilla/check-mark.png";
					$src_fam = '<img src="'.$src_fam.'" style="height: 10px; wight: 10px;">';
				}
			 	$html_antecedentes_gen.= '	<th>'.$value['antecedentes_nombre_cat_v'].'</th>
						<td style="text-align: center;">'.$src_per.'</td>
						<td style="text-align: center;">'.$src_fam.'</td>';
				if($contador == 4){
					$html_antecedentes_gen.= '</tr>';
					$contador = 0;
				}
			}
		 }
		$html_antecedentes_ocu = '';
		$contador = 0;
		foreach ($antecedentes as $key => $value) {
			if($value['antecedentes_tipo_v'] == 'Ocu'){
				$contador++;
				if($contador == 1){
					$html_antecedentes_ocu.= '<tr  style="text-align: justify;">';
				}
				$src_per = '';
				if($value['antecedentes_personal_i'] == 1){
					$src_per = "../vistas/img/plantilla/check-mark.png";
					$src_per ='<img src="'.$src_per.'" style="height: 10px; wight: 10px;">';
				}
			 	$html_antecedentes_ocu .= '  <th>'.$value['antecedentes_nombre_cat_v'].'</th>
						<td style="text-align: center;">'.$src_per.'</td>';
				if($contador == 4){
					$html_antecedentes_ocu .= '</tr>';
					$contador = 0;
				}
			}
		}
		$html_Lensometria = '';
		if($Lensometria){
			$i = 0;
			foreach ($Lensometria as $key => $value) {
				if($i == 0){
					$html_Lensometria .= '<tr>
                            <td style="text-align: center;">OD</td>
                            <td>
                                '.$value['auxiliares_esfera_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_cilindro_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_eje_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_add_v'].'
                            </td>
                        </tr>';
				}else{
					$html_Lensometria .= '<tr>
                            <td style="text-align: center;">ID</td>
                            <td>
                                '.$value['auxiliares_esfera_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_cilindro_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_eje_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_add_v'].'
                            </td>
                        </tr>';
				}
				$i++;
			}
		}else{
			$html_Lensometria .= '<tr>
                    <td style="text-align: center;">OD</td>
                    <td>
                       
                    </td>
                    <td>
                        
                    </td>
                    <td>
                       
                    </td>
                    <td>
                        
                    </td>
                </tr>';
            $html_Lensometria .= '<tr>
                <td style="text-align: center;">OD</td>
                <td>
                    
                </td>
                <td>
                    
                </td>
                <td>
                   
                </td>
                <td>
                    
                </td>
            </tr>';
		}
		$html_Retinoscopia = '';
		if($Retinoscopia){
			$i = 0;
			foreach ($Retinoscopia as $key => $value) {
				if($i == 0){
					$html_Retinoscopia .= '<tr>
	                        <td style="text-align: center;">OD</td>
	                        <td>
	                            '.$value['auxiliares_esfera_v'].'
	                        </td>
	                        <td>
	                            '.$value['auxiliares_cilindro_v'].'
	                        </td>
	                        <td>
	                            '.$value['auxiliares_eje_v'].'
	                        </td>
	                        <td>
	                            '.$value['auxiliares_add_v'].'
	                        </td>
	                    </tr>';
				}else{
					$html_Retinoscopia .= '<tr>
	                        <td style="text-align: center;">ID</td>
	                        <td>
	                            '.$value['auxiliares_esfera_v'].'
	                        </td>
	                        <td>
	                            '.$value['auxiliares_cilindro_v'].'
	                        </td>
	                        <td>
	                            '.$value['auxiliares_eje_v'].'
	                        </td>
	                        <td>
	                            '.$value['auxiliares_add_v'].'
	                        </td>
	                    </tr>';
				}
				$i++;
			}
		}else{
			$html_Retinoscopia .= '<tr>
	                <td style="text-align: center;">OD</td>
	                <td>
	                   
	                </td>
	                <td>
	                    
	                </td>
	                <td>
	                   
	                </td>
	                <td>
	                    
	                </td>
	            </tr>';
	        $html_Retinoscopia .= '<tr>
	            <td style="text-align: center;">OD</td>
	            <td>
	                
	            </td>
	            <td>
	                
	            </td>
	            <td>
	               
	            </td>
	            <td>
	                
	            </td>
	        </tr>';
		}
		$html_Formula = '';
		if($Formula){
			$i = 0;
			foreach ($Formula as $key => $value) {
				if($i == 0){
					$html_Formula .= '<tr>
                            <td style="text-align: center;">OD</td>
                            <td>
                                '.$value['auxiliares_esfera_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_cilindro_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_eje_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_add_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_av_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_auv_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_dp_v'].'
                            </td>
                        </tr>';
				}else{
					$html_Formula .= '<tr>
                            <td style="text-align: center;">ID</td>
                            <td>
                                '.$value['auxiliares_esfera_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_cilindro_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_eje_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_add_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_av_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_auv_v'].'
                            </td>
                            <td>
                                '.$value['auxiliares_dp_v'].'
                            </td>
                        </tr>';
				}
				$i++;
			}
		}else{
			$html_Formula .= '<tr>
                    <td style="text-align: center;">OD</td>
                    <td>
                       
                    </td>
                    <td>
                        
                    </td>
                    <td>
                       
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>';
            $html_Formula .= '<tr>
                <td style="text-align: center;">OD</td>
                <td>
                    
                </td>
                <td>
                    
                </td>
                <td>
                   
                </td>
                <td>
                    
                </td>
                <td>
                    
                </td>
                <td>
                   
                </td>
            </tr>';
		}

$contenido = '
<!DOCTYPE html>
<style>
html, body {
	display: block;
}
</style>
<html>
	<body>
		<table style="width: 100%;">
			<tr>
				<td width="60%">
					<img src="../vistas/img/plantilla/logo_excel_new.png" style="width: 400px;">
				</td>
				<td width="40%">
					<table width="100%" border="0" style="text-align: justify;">
						<tr>
							<td width="40%">NIT</td>
							<td>'.$configuracion['configuracion_nit_v'].'</td>
						</tr>
						<tr>
							<td>Dirección</td>
							<td>'.$configuracion['configuracion_direccion_v'].'</td>
						</tr>
						<tr>
							<td>Teléfono</td>
							<td>'.$configuracion['configuracion_telefono_v'].'</td>
						</tr>
						<tr>
							<td>Fecha Impresion</td>
							<td>'.date('Y-m-d H:i:s').'</td>
						</tr>
						<tr>
							<td>Fecha de Generacion</td>
							<td>'.$historia_foreach['historias_fecha_d'].'</td>
						</tr>
						<tr>
							<th>N° Historia</th>
							<th>'.$historia_foreach['historias_numero_v'].'</th>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table border="1" style="width: 100%; border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="6" style="text-align: justify;">DATOS DEL PACIENTE</th>
							</tr>
						</thead>
						<tbody>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Identificación</th>
								<td  colspan="2">'.$historia_foreach['pacientes_documento_v'].'</td>
								<th style="width: 15%;">Tipo Documento</th>
								<td  colspan="2">'.$historia_foreach['pacientes_tipo_doc_v'].'</td>
							</tr>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Nombres</th>
								<td style="width: 20%;">'.$historia_foreach['pacientes_nombres_v'].'</td>
								<th style="width: 15%;">Apellidos</th>
								<td>'.$historia_foreach['pacientes_apellidos_v'].'</td>
								<th style="width: 15%;">Ocupación</th>
								<td>'.$historia_foreach['pacientes_ocupacion_v'].'</td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Teléfono</th>
								<td>'.$historia_foreach['pacientes_telefono_v'].'</td>
								<th>Lugar de Residencia</th>
								<td>'.$historia_foreach['pacientes_lugar_recidencia_v'].'</td>
								<th>Dirección</th>
								<td>'.$historia_foreach['pacientes_direccion_v'].'</td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Genero</th>
								<td>'.$historia_foreach['pacientes_sexo_v'].'</td>
								<th>Fecha de Nacimiento</th>
								<td>'.$historia_foreach['pacientes_fecha_nacimiento_d'].'  Edad '.getEdad($historia_foreach['pacientes_fecha_nacimiento_d']).' Años</td>
								<th>Estado Civil</th>
								<td>'.$historia_foreach['pacientes_estado_civil_v'].'</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%; border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="6" style="text-align: justify;">DATOS ADICIONALES</th>
							</tr>
						</thead>
						<tbody>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Acompañante</th>
								<td style="width: 20%;">'.$historia_foreach['historias_acudiente_v'].'</td>
								<th style="width: 15%;">Teléfono Acompañante</th>
								<td>'.$historia_foreach['historias_telefono_acudiente_v'].'</td>
								<th style="width: 15%;">Parentesco</th>
								<td>'.$historia_foreach['historia_prentesco_v'].'</td>
							</tr>
							<tr style="text-align: justify;">
								<th style="width: 15%;">Responsable</th>
								<td style="width: 20%;">'.$historia_foreach['historias_acudiente_responsable_v'].'</td>
								<th style="width: 15%;">Teléfono Responsable</th>
								<td>'.$historia_foreach['historias_telefono_acudiente_responsable_v'].'</td>
								<th style="width: 15%;">Parentesco Responsable</th>
								<td>'.$historia_foreach['historia_prentesco_responsable_v'].'</td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Aseguradora</th>
								<td>'.$historia_foreach['historias_aseguradora_v'].'</td>
								<th>Tipo de Afiliación</th>
								<td>'.$historia_foreach['historias_tipo_afiliacion_v'].'</td>
								<th>Semanas Cotizadas</th>
								<td>'.$historia_foreach['historias_semanas_cotizadas'].'</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%; border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="12" style="text-align: justify;">ANTECEDENTES PATOLOGICOS GENERALES PERSONALES - FAMILIARES</th>
							</tr>
						</thead>
						<tbody>
							<tr style="text-align: justify;">
								<th style="width: 12%;"></th>
								<td style="width: 5%;">Personal</td>
								<td style="width: 5%;">Familiar</td>
								<th style="width: 12%;"></th>
								<td style="width: 5%;">Personal</td>
								<td style="width: 5%;">Familiar</td>
								<th style="width: 12%;"></th>
								<td style="width: 5%;">Personal</td>
								<td style="width: 5%;">Familiar</td>
								<th style="width: 12%;"></th>
								<td style="width: 5%;">Personal</td>
								<td style="width: 5%;">Familiar</td>
							</tr> 
							'.$html_antecedentes_gen.'
							<tr style="text-align: justify;">
								<th>Antecedentes Personales</th>
								<td colspan="11">'.$historia_foreach['historia_antecedentes_personales_v'].'</td>
							</tr>

							<tr style="text-align: justify;">
								<th>Antecedentes Familiares</th>
								<td colspan="11">'.$historia_foreach['historias_antecedentes_familiares'].'</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%; border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="8" style="text-align: justify;">ANTECEDENTES PATOLOGICOS PERSONALES - OCULARES Y VISUALES</th>
							</tr>
						</thead>
						<tbody>
								<tr style="text-align: justify;">
									<th style="width: 8%;"></th>
									<td style="width: 3%;">Personal</td>
									<th style="width: 10%;"></th>
									<td style="width: 3%;">Personal</td>
									<th style="width: 10%;"></th>
									<td style="width: 3%;">Personal</td>
									<th style="width: 10%;"></th>
									<td style="width: 3%;">Personal</td>
								</tr>
								'.$html_antecedentes_ocu.'
							<tr  style="text-align: justify;">
								<th colspan="3">Ampliacion de antecedentes patologicos oculares y visuales</th>
								<td colspan="5">'.$historia_foreach['historias_antecedentes_oculares_v'].'</td>
							</tr>
							
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="6" style="text-align: justify;">INFORMACIÓN DE LENTES</th>
							</tr>
						</thead>
						<tbody>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Tipo de Lente en uso</th>
								<td colspan="5">'.$historia_foreach['historia_tipo_lente_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Oftalmoscopia</th>
								<td colspan="5">'.$historia_foreach['historias_oftalmoscopia_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Excavación OD</th>
								<td colspan="5">'.$historia_foreach['historias_excavacion_od_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Excavación OI</th>
								<td colspan="5">'.$historia_foreach['historia_excavacion_oi_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Reflejos pupilares</th>
								<td colspan="5">'.$historia_foreach['historias_reflejos_pulpilres_v'].'</td>
							</tr>
							
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Motilidad Ocular</th>
								<td style="width: 20%;">'.$historia_foreach['historias_motilidad_ocular_v'].'</td>
								<th>VL</th>
								<td>'.$historia_foreach['historias_ortoforia_vl_v'].'</td>
								<th>VP</th>
								<td>'.$historia_foreach['historias_ortoforia_vp_v'].'</td>
							</tr>

						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="2">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;">
						<thead>
							<tr>
								<th style="text-align: justify;">LENSOMETRIA</th>
							</tr>
						</thead>
						<tbody>
							<tr style="text-align: justify;">
								<td>
									<table border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th width="20%"></th>
		                                        <th width="20%">Esfera</th>
		                                        <th width="20%">Cilindro</th>
		                                        <th width="20%">Eje</th>
		                                        <th width="20%">Add</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    '.$html_Lensometria.'
		                                </tbody>
		                            </table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td colspan="2">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th style="text-align: justify;">AGUDEZA VISUAL</th>
							</tr>
						</thead>
						<tbody>
							<tr style="text-align: justify;">
								<td>
									<table border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th width="8%"></th>
		                                        <th width="18%">Sin Corrección</th>
		                                        <th width="18%">Con Corrección</th>
		                                        <th width="18%">Con Estenopeico</th>
		                                        <th width="18%">UV</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <tr>
		                                        <td style="text-align: center;">OD</td>
		                                        <td>
		                                            '.$historia_foreach['historias_sin_correcion_od_v'].'
		                                        </td>
		                                        <td>
		                                            '.$historia_foreach['historias_con_correcion_od_v'].' 
		                                        </td>
		                                        <td>
		                                            '.$historia_foreach['historias_con_estenopeico_od_v'].' 
		                                        </td>
		                                        <td>
		                                            '.$historia_foreach['historias_uv_od_v'].' 
		                                        </td>
		                                    </tr>
		                                     <tr>
		                                        <td style="text-align: center;">ID</td>
		                                        <td>
		                                            '.$historia_foreach['historias_sin_correcion_id_v'].' 
		                                        </td>
		                                        <td>
		                                            '.$historia_foreach['historias_sin_correcion_id_v'].' 
		                                        </td>
		                                        <td>
		                                            '.$historia_foreach['historias_sin_correcion_id_v'].' 
		                                        </td>
		                                        <td>
		                                            '.$historia_foreach['historias_uv_id_v'].' 
		                                        </td>
		                                    </tr>
		                                </tbody>
		                            </table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th style="text-align: justify;">RETINOSCOPIA</th>
							</tr>
						</thead>
						<tbody>
							<tr  style="text-align: justify;">
								<td>
									<table border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th></th>
		                                        <th width="20%">Esfera</th>
		                                        <th width="20%">Cilindro</th>
		                                        <th width="20%">Eje</th>
		                                        <th width="20%">AUV</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	'.$html_Retinoscopia.'
		                                </tbody>
		                            </table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="6" style="text-align: justify;">FORMULA FINAL</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="6">
									<table border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th></th>
		                                        <th width="13%">Esfera</th>
		                                        <th width="13%">Cilindro</th>
		                                        <th width="13%">Eje</th>
		                                        <th width="13%">Add</th>
		                                        <th width="13%">Av</th>
		                                        <th width="13%">AUV</th>	
		                                        <th width="13%">DP</th>	
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	'.$html_Formula.'
		                                </tbody>
		                            </table>
								</td>
							</tr>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Biomocrospia</th>
								<td colspan="5">'.$historia_foreach['historias_biomocrospia_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Exámenes complementarios</th>
								<td colspan="5">'.$historia_foreach['historias_examenes_complementarios_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Querataometría OD</th>
								<td colspan="2">'.$historia_foreach['historias_queratometria_od_v'].'</td>
								<th>Querataometría ID</th>
								<td colspan="2">'.$historia_foreach['historias_queratometria_id_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Tonometría OD</th>
								<td>'.$historia_foreach['historias_tonometria_od_v'].'</td>
								<th>Tonometría ID</th>
								<td>'.$historia_foreach['historias_tonometria_oi_v'].'</td>
								<th>Tipo de tonometro</th>
								<td>'.$historia_foreach['historias_tipo_tonometro_v'].'</td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Test Color Derecho</th>
								<td>'.$historia_foreach['historias_test_color_derecho_v'].'</td>
								<th>Test Color Izquierdo</th>
								<td>'.$historia_foreach['historias_test_color_izquierdo_v'].'</td>
								<th>Test Estereópsis</th>
								<td>'.$historia_foreach['historias_test_estereopsis_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Descripción</th>
								<td colspan="5">'.$historia_foreach['historias_descripcion_v'].'</td>
							</tr>

						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					&nbsp;
				</td>
			</tr>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="2" style="text-align: justify;">ANTECEDENTES</th>
							</tr>
						</thead>
						<tbody>

							<tr  style="text-align: justify;">
								<th style="width: 15%;">Diagnóstico Principal</th>
								<td>'.$historia_foreach['historias_diagnostico_principal_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Diagnóstico Secundario</th>
								<td>'.$historia_foreach['historias_diagnostico_segundario_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Optómetra</th>
								<td>'.$historia_foreach['usuarios_nombres_v'].'</td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Observaciones</th>
								<td>'.$historia_foreach['historias_observaciones_v'].'</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>';

	$dompdf->load_html($contenido);
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = date('Ymd_His', strtotime($historia_foreach['historias_fecha_d']))."_".$historia_foreach['pacientes_documento_v'].".pdf";
	file_put_contents("../tmp/".$filename, $pdf);
	// Añadimos un archivo en la raid del zip.
	if(file_exists("../tmp/".$filename) && is_file("../tmp/".$filename)){
 		$zip->addFile("../tmp/".$filename,$filename);
 	}

 	unset($dompdf); 
	
	}

	// Una vez añadido los archivos deseados cerramos el zip.
	$zip->close();

	echo $nombre_archivo;