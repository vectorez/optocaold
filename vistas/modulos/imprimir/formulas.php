<?php 
	$item = 'historias_id_i';
	$valor = $_GET['id_historia'];
	$respuesta = ControladorHistorias::ctrMostrarHistorias($item, $valor);

	$item = 'auxiliares_historia_id_i';
	$valor = $respuesta['historias_id_i'];

	$valor2 = 'Formula';
	$Formula = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

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
				<td width="30%">
					&nbsp;
				</td>
				<td width="30%">
					<img src="vistas/img/plantilla/Logo_de_aviso.png" style="width: 100%;">
				</td>
				<td width="10%">
					&nbsp;
				</td>
				<td width="30%">
					<table width="100%" border="0" style="text-align: justify;">
						<tr>
							<td width="30%">NIT</td>
							<td>900653374-6</td>
						</tr>
						<tr>
							<td>Dirección</td>
							<td>Calle 98 # 100 - 58 Apartado</td>
						</tr>
						<tr>
							<td>Teléfono</td>
							<td>8287325</td>
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
								<td><?php echo $respuesta['pacientes_fecha_nacimiento_d']; ?></td>
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
					<table  border="1" style="width: 100%;border: solid 1px black; border-collapse: collapse;" >
						<thead>
							<tr>
								<th colspan="6" style="text-align: justify;">FORMULA</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="6">
									<table border='1' style="width: 100%;border: solid 1px black; border-collapse: collapse;">
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
					<table style="width: 100%;" >
						<tbody>
							<tr  style="text-align: justify;">
								<th width="15%;">DP</th>
								<td colspan="5" style=" border-bottom: solid 1px black; border-collapse: collapse;"></td>
							</tr>
							<tr  style="text-align: justify; border-bottom: solid 1px black; border-collapse: collapse;">
								<th width="15%;">Próxima Cita de Control</th>
								<td colspan="5" style=" border-bottom: solid 1px black; border-collapse: collapse;"></td>
							</tr>
							<tr  style="text-align: justify;border-bottom: solid 1px black; border-collapse: collapse;">
								<th width="15%;">Observaciones</th>
								<td colspan="5" style=" border-bottom: solid 1px black; border-collapse: collapse;"><?php echo $respuesta['historias_descripcion_v']; ?></td>
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
				<td style="width:10%">
					<?php
						if($respuesta['usuarios_firma_v'] != Null &&  $respuesta['usuarios_firma_v'] != ''){
							echo '<img src="'.$respuesta['usuarios_firma_v'].'" style="width:200px;height:150px;">';
						}

						echo "<br/><b>".mb_strtoupper($respuesta['usuarios_nombres_v'].' - Optómetra').'</b>';
					?>

				</td>
				<td colspan="3">

				</td>
			</tr>
		</table>

		<script type="text/javascript">
			window.print();
		</script>
	</body>
</html>
