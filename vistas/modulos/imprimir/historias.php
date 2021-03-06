<?php 
	date_default_timezone_set('America/Bogota');
	require_once 'modelos/dao.modelo.php';
	$item = 'historias_id_i';
	$valor = $_GET['id_historia'];
	$respuesta = ControladorHistorias::ctrMostrarHistorias($item, $valor);

	$item = 'auxiliares_historia_id_i';
	$valor = $respuesta['historias_id_i'];
	$valor2 = 'Lensometria';
	$Lensometria = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

	$valor2 = 'Retinoscopia';
	$Retinoscopia = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

	$valor2 = 'Formula';
	$Formula = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

	$campos = "*";
	$tabla = "op_historias_antecedentes";
	$condicion = "antecedentes_historia_id_i = ".$_GET['id_historia'];
	$antecedentes = ModeloDAO::mdlMostrar($campos, $tabla, $condicion);

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

?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			
		</style>
	</head>
	<body>
		<table style="width: 100%;">
			<tr>
				<td width="25%">
					<img src="vistas/img/plantilla/logo_login_new.png" style="width: 100%;">
				</td>
				<td width="25%"></td>
				<td width="20%"></td>
				<td width="30%">
					<table width="100%" border="0" style="text-align: justify;">
						<tr>
							<td width="40%">NIT</td>
							<td><?php echo $configuracion['configuracion_nit_v']; ?></td>
						</tr>
						<tr>
							<td>Dirección</td>
							<td><?php echo $configuracion['configuracion_direccion_v']; ?></td>
						</tr>
						<tr>
							<td>Teléfono</td>
							<td><?php echo $configuracion['configuracion_telefono_v']; ?></td>
						</tr>
						<tr>
							<td>Fecha Impresion</td>
							<td><?php echo date('Y-m-d H:i:s'); ?></td>
						</tr>
						<tr>
							<td>Fecha de Generacion</td>
							<td><?php echo $respuesta['historias_fecha_d']; ?></td>
						</tr>
						<tr>
							<th>N° Historia</th>
							<th><?php echo $respuesta['historias_numero_v']; ?></th>
						</tr>
					</table>
				</td>
			</tr>
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
								<td  colspan="2"><?php echo $respuesta['pacientes_documento_v']; ?></td>
								<th style="width: 15%;">Tipo Documento</th>
								<td  colspan="2"><?php echo $respuesta['pacientes_tipo_doc_v']; ?></td>
							</tr>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Nombres</th>
								<td style="width: 20%;"><?php echo $respuesta['pacientes_nombres_v']; ?></td>
								<th style="width: 15%;">Apellidos</th>
								<td><?php echo $respuesta['pacientes_apellidos_v']; ?></td>
								<th style="width: 15%;">Ocupación</th>
								<td><?php echo $respuesta['pacientes_ocupacion_v']; ?></td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Teléfono</th>
								<td><?php echo $respuesta['pacientes_telefono_v']; ?></td>
								<th>Lugar de Residencia</th>
								<td><?php echo $respuesta['pacientes_lugar_recidencia_v']; ?></td>
								<th>Dirección</th>
								<td><?php echo $respuesta['pacientes_direccion_v']; ?></td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Genero</th>
								<td><?php echo $respuesta['pacientes_sexo_v']; ?></td>
								<th>Fecha de Nacimiento</th>
								<td><?php echo $respuesta['pacientes_fecha_nacimiento_d']."  Edad ".getEdad($respuesta['pacientes_fecha_nacimiento_d'])." Años"; ?></td>
								<th>Estado Civil</th>
								<td><?php echo $respuesta['pacientes_estado_civil_v']; ?></td>
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
								<td style="width: 20%;"><?php echo $respuesta['historias_acudiente_v']; ?></td>
								<th style="width: 15%;">Teléfono Acompañante</th>
								<td><?php echo $respuesta['historias_telefono_acudiente_v']; ?></td>
								<th style="width: 15%;">Parentesco</th>
								<td><?php echo $respuesta['historia_prentesco_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th style="width: 15%;">Responsable</th>
								<td style="width: 20%;"><?php echo $respuesta['historias_acudiente_responsable_v']; ?></td>
								<th style="width: 15%;">Teléfono Responsable</th>
								<td><?php echo $respuesta['historias_telefono_acudiente_responsable_v']; ?></td>
								<th style="width: 15%;">Parentesco Responsable</th>
								<td><?php echo $respuesta['historia_prentesco_responsable_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Aseguradora</th>
								<td><?php echo $respuesta['historias_aseguradora_v']; ?></td>
								<th>Tipo de Afiliación</th>
								<td><?php echo $respuesta['historias_tipo_afiliacion_v']; ?></td>
								<th>Semanas Cotizadas</th>
								<td><?php echo $respuesta['historias_semanas_cotizadas']; ?></td>
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
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%; border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="12" style="text-align: justify;">ANTECEDENTES PATOLOGICOS GENERALES PERSONALES - FAMILIARES</th>
							</tr>
						</thead>
						<tbody>
							<?php
								echo '<tr style="text-align: justify;">
										<th style="width: 15%;"></th>
										<td style="width: 5%;">Personal</td>
										<td style="width: 5%;">Familiar</td>
										<th style="width: 15%;"></th>
										<td style="width: 5%;">Personal</td>
										<td style="width: 5%;">Familiar</td>
										<th style="width: 15%;"></th>
										<td style="width: 5%;">Personal</td>
										<td style="width: 5%;">Familiar</td>
										<th style="width: 15%;"></th>
										<td style="width: 5%;">Personal</td>
										<td style="width: 5%;">Familiar</td>
									  </tr>';
								$contador = 0;
								foreach ($antecedentes as $key => $value) {
									if($value['antecedentes_tipo_v'] == 'Gen'){
										$contador++;
										if($contador == 1){
											echo '<tr  style="text-align: justify;">';
										}
										$src_per = '';
										$src_fam = '';
										if($value['antecedentes_personal_i'] == 1){
											$src_per = "vistas/img/plantilla/check-mark.png";
										}
										if($value['antecedentes_familiar_i'] == 1){
											$src_fam = "vistas/img/plantilla/check-mark.png";
										}
									 	echo '	<th>'.$value['antecedentes_nombre_cat_v'].'</th>
												<td style="text-align: center;"><img src="'.$src_per.'" style="height: 12px; wight: 12px;"></td>
												<td style="text-align: center;"><img src="'.$src_fam.'" style="height: 12px; wight: 12px;"></td>';
										if($contador == 4){
											echo '</tr>';
											$contador = 0;
										}
									}
								 } 
							?>
							<tr  style="text-align: justify;">
								<th>Antecedentes Personales</th>
								<td colspan="11"><?php echo $respuesta['historia_antecedentes_personales_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Antecedentes Familiares</th>
								<td colspan="11"><?php echo $respuesta['historias_antecedentes_familiares']; ?></td>
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
			<tr>
				<td colspan="4">
					<table  border="1" style="width: 100%; border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="8" style="text-align: justify;">ANTECEDENTES PATOLOGICOS PERSONALES - OCULARES Y VISUALES</th>
							</tr>
						</thead>
						<tbody>
							<?php
								echo '<tr style="text-align: justify;">
										<th style="width: 20%;"></th>
										<td style="width: 5%;">Personal</td>
										<th style="width: 20%;"></th>
										<td style="width: 5%;">Personal</td>
										<th style="width: 20%;"></th>
										<td style="width: 5%;">Personal</td>
										<th style="width: 20%;"></th>
										<td style="width: 5%;">Personal</td>
									  </tr>';
								$contador = 0;
								foreach ($antecedentes as $key => $value) {
									if($value['antecedentes_tipo_v'] == 'Ocu'){
										$contador++;
										if($contador == 1){
											echo '<tr  style="text-align: justify;">';
										}
										$src_per = '';
										if($value['antecedentes_personal_i'] == 1){
											$src_per = "vistas/img/plantilla/check-mark.png";
										}
									 	echo '	<th>'.$value['antecedentes_nombre_cat_v'].'</th>
												<td style="text-align: center;"><img src="'.$src_per.'" style="height: 12px; wight: 12px;"></td>';
										if($contador == 4){
											echo '</tr>';
											$contador = 0;
										}
									}
								 } 
							?>
							<tr  style="text-align: justify;">
								<th colspan="3">Ampliacion de antecedentes patologicos oculares y visuales</th>
								<td colspan="5"><?php echo $respuesta['historias_antecedentes_oculares_v']; ?></td>
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
								<td colspan="5"><?php echo $respuesta['historia_tipo_lente_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Oftalmoscopia</th>
								<td colspan="5"><?php echo $respuesta['historias_oftalmoscopia_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Excavación OD</th>
								<td colspan="5"><?php echo $respuesta['historias_excavacion_od_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Excavación OI</th>
								<td colspan="5"><?php echo $respuesta['historia_excavacion_oi_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Reflejos pupilares</th>
								<td colspan="5"><?php echo $respuesta['historias_reflejos_pulpilres_v']; ?></td>
							</tr>
							
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Motilidad Ocular</th>
								<td style="width: 20%;"><?php echo $respuesta['historias_motilidad_ocular_v']; ?></td>
								<th>VL</th>
								<td><?php echo $respuesta['historias_ortoforia_vl_v']; ?></td>
								<th>VP</th>
								<td><?php echo $respuesta['historias_ortoforia_vp_v']; ?></td>
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
			<tr>
				<td colspan="2">
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th style="text-align: justify;">LENSOMETRIA</th>
							</tr>
						</thead>
						<tbody>
							<tr  style="text-align: justify;">
								<td>
									<table border='1' style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th></th>
		                                        <th width="20%">Esfera</th>
		                                        <th width="20%">Cilindro</th>
		                                        <th width="20%">Eje</th>
		                                        <th width="20%">Add</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <?php 
		                                		if($Lensometria){
		                                			$i = 0;
		                                			foreach ($Lensometria as $key => $value) {
		                                				if($i == 0){
		                                					echo '<tr>
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
		                                					echo '<tr>
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
		                                			echo '<tr>
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
				                                    echo '<tr>
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
		                                	?>
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
							<tr  style="text-align: justify;">
								<td>
									<table border='1' style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th width="20%"></th>
		                                        <th width="20%">Sin Corrección Vl</th>
		                                        <th width="20%">VP</th>
		                                        <th width="20%">Con Corrección Vl</th>
		                                        <th width="20%">VP</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <tr>
		                                        <td style="text-align: center;">OD</td>
		                                        <td>
		                                           <?php echo $respuesta['historias_sin_correcion_od_v'];?> 
		                                        </td>
		                                        <td>
		                                            <?php echo $respuesta['historias_sin_vp_od_i'];?> 
		                                        </td>
		                                        <td>
		                                            <?php echo $respuesta['historias_con_correcion_od_v'];?> 
		                                        </td>
		                                        <td>
		                                            <?php echo $respuesta['historias_con_vp_od_i'];?> 
		                                        </td>
		                                    </tr>
		                                     <tr>
		                                        <td style="text-align: center;">ID</td>
		                                        <td>
		                                            <?php echo $respuesta['historias_sin_correcion_id_v'];?> 
		                                        </td>
		                                        <td>
		                                            <?php echo $respuesta['historias_sin_vp_id_i'];?> 
		                                        </td>
		                                        <td>
		                                            <?php echo $respuesta['historias_sin_correcion_id_v'];?> 
		                                        </td>
		                                        <td>
		                                            <?php echo $respuesta['historias_con_vp_id_i'];?> 
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
									<table border='1' style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th></th>
		                                        <th width="15%">Esfera</th>
		                                        <th width="15%">Cilindro</th>
		                                        <th width="15%">Eje</th>
		                                        <th width="15%">Avvl</th>
		                                        <th width="15%">Add</th>
		                                        <th width="15%">Avvp</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php 
		                                		if($Retinoscopia){
		                                			$i = 0;
		                                			foreach ($Retinoscopia as $key => $value) {
		                                				if($i == 0){
		                                					echo '<tr>
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
							                                            '.$value['auxiliares_avvl_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_add_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_avvp_v'].'
							                                        </td>
							                                    </tr>';
		                                				}else{
		                                					echo '<tr>
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
							                                            '.$value['auxiliares_avvl_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_add_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_avvp_v'].'
							                                        </td>
							                                    </tr>';
		                                				}
		                                				$i++;
		                                			}
		                                		}else{
		                                			echo '<tr>
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
				                                    echo '<tr>
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
		                                	?>
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
									<table border='1' style="width: 100%;border: solid 1px black; border-collapse: collapse;">
		                                <thead>
		                                    <tr>
		                                        <th></th>
		                                        <th width="11%">Esfera</th>
		                                        <th width="11%">Cilindro</th>
		                                        <th width="11%">Eje</th>
		                                        <th width="11%">Avvl</th>
		                                        <th width="11%">Add</th>
		                                        <th width="11%">Avvp</th>	
		                                        <th width="11%">DP</th>
		                                        <th width="11%">Altura Foral</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php 
		                                		if($Formula){
		                                			$i = 0;
		                                			foreach ($Formula as $key => $value) {
		                                				if($i == 0){
		                                					echo '<tr>
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
							                                            '.$value['auxiliares_avvl_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_add_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_avvp_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_dp_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_altura_foral_v'].'
							                                        </td>
							                                    </tr>';
		                                				}else{
		                                					echo '<tr>
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
							                                            '.$value['auxiliares_avvl_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_add_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_avvp_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_dp_v'].'
							                                        </td>
							                                        <td>
							                                            '.$value['auxiliares_altura_foral_v'].'
							                                        </td>
							                                    </tr>';
		                                				}
		                                				$i++;
		                                			}
		                                		}else{
		                                			echo '<tr>
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
					                                        <td>
					                                            
					                                        </td>
					                                        <td>
					                                            
					                                        </td>
					                                    </tr>';
				                                    echo '<tr>
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
				                                        <td>
					                                            
					                                    </td>
					                                   	<td>
					                                            
					                                    </td>
				                                    </tr>';
		                                		}
		                                	?>
		                                </tbody>
		                            </table>
								</td>
							</tr>
							<tr  style="text-align: justify;">
								<th style="width: 15%;">Biomocrospia</th>
								<td colspan="5"><?php echo $respuesta['historias_biomocrospia_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Exámenes complementarios</th>
								<td colspan="5"><?php echo $respuesta['historias_examenes_complementarios_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Querataometría OD</th>
								<td colspan="2"><?php echo $respuesta['historias_queratometria_od_v']; ?></td>
								<th>Querataometría ID</th>
								<td colspan="2"><?php echo $respuesta['historias_queratometria_id_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Tonometría OD</th>
								<td><?php echo $respuesta['historias_tonometria_od_v']; ?></td>
								<th>Tonometría ID</th>
								<td><?php echo $respuesta['historias_tonometria_oi_v']; ?></td>
								<th>Tipo de tonometro</th>
								<td><?php echo $respuesta['historias_tipo_tonometro_v']; ?></td>
							</tr>
							<tr  style="text-align: justify;">
								<th>Test Color Derecho</th>
								<td><?php echo $respuesta['historias_test_color_derecho_v']; ?></td>
								<th>Test Color Izquierdo</th>
								<td><?php echo $respuesta['historias_test_color_izquierdo_v']; ?></td>
								<th>Test Estereópsis</th>
								<td><?php echo $respuesta['historias_test_estereopsis_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Descripción</th>
								<td colspan="5"><?php echo $respuesta['historias_descripcion_v']; ?></td>
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
								<th style="width: 15%;">Diagnóstico Primario</th>
								<td><?php echo $respuesta['historias_diagnostico_principal_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Diagnóstico Secundario</th>
								<td><?php echo $respuesta['historias_diagnostico_segundario_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Conducta</th>
								<td><?php echo $respuesta['historias_conducta_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Remisión y Justificación</th>
								<td><?php echo $respuesta['historias_remision_justi_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Optómetra</th>
								<td><?php echo $respuesta['usuarios_nombres_v']; ?></td>
							</tr>

							<tr  style="text-align: justify;">
								<th>Observaciones</th>
								<td><?php echo $respuesta['historias_observaciones_v']; ?></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>

		<script type="text/javascript">
			window.print();
		</script>
	</body>
</html>
