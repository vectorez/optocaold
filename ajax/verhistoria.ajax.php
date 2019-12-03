<?php 

	require_once '../controladores/historias.controlador.php';
	require_once '../modelos/historias.modelo.php';
	require_once '../modelos/dao.modelo.php';

	$item = 'historias_id_i';
	$valor = $_POST['id_historia'];
	$respuesta = ControladorHistorias::ctrMostrarHistorias($item, $valor);

	$item = 'auxiliares_historia_id_i';
	$valor = $respuesta['historias_id_i'];
	$valor2 = 'Lensometria';
	$Lensometria = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

	$valor2 = 'Retinoscopia';
	$Retinoscopia = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);

	$valor2 = 'Formula';
	$Formula = ControladorHistorias::ctrMostrarAuxiliaresHistorias($item, $valor, $valor2);


	function getEdad($fecha){
		$cumpleanos = new DateTime($fecha);
	    $hoy = new DateTime();
	    $annos = $hoy->diff($cumpleanos);
	    return $annos->y;
	}

?>

<div class="box box-default box-solid">
	<div class="box-header">
		<h3 class="box-title">NOTAS</h3>
		<div class="box-tools">
		 	<button type="button" class="btn btn-box-tool" title="Agregar nota" onclick=limpiarCampos('<?php $_POST['id_historia']; ?>');" data-toggle="modal" data-target="#modalAgregarNotas">
		 		<i class="fa fa-plus"></i>
            </button>
		</div>
	</div>
	<div class="box-body">

		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 15%;">Fecha</th>
					<th style="width: 20%;">Optometra</th>
					<th style="width: 20%;">Responsable</th>
					<th>Nota</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="NotasHistorico">
				<?php
					$campos = "nota_historia_id, nota_historia_fecha, nota_historia_nota, usuarios_nombres_v, nota_historia_acompanante_nombre";
					$tablas = "op_nota_historia JOIN sys_usuarios ON usuarios_id_i = nota_historia_usuario_id";
					$where_ = "nota_historia_historias_id_i = ".$_POST['id_historia'];

					$respuestaX = ModeloDAO::mdlMostrar($campos, $tablas, $where_);

					foreach ($respuestaX as $keyX => $valueX) {
						echo "<tr>";
							echo "<td>".explode(' ', $valueX['nota_historia_fecha'])[0]."</td>";
							echo "<td>".$valueX['usuarios_nombres_v']."</td>";
							echo "<td>".$valueX['nota_historia_acompanante_nombre']."</td>";
							echo "<td>".$valueX['nota_historia_nota']."</td>";
							echo "<td><button class='btn btn-sm btn-danger destructordeNotas' type='button' idButton='".$valueX['nota_historia_id']."'><i class='fa fa-trash-o'></i></button></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="box box-default box-solid">
	<div class="box-header">
		<h3 class="box-title">HISTORIA</h3>
	</div>
	<div class="box-body">
		<table border="1" class="table table-hover table-bordered" >
			<thead>
				<tr>
					<th colspan="4" style="text-align: justify;">DATOS DEL PACIENTE</th>
					<th>N° Historia</th>
					<th><?php echo $respuesta['historias_numero_v']; ?></th>
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

		<table  border="1" class="table table-hover table-bordered" >
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

		<table  border="1" class="table table-hover table-bordered" >
			<thead>
				<tr>
					<th colspan="2" style="text-align: justify;">ANTECEDENTES</th>
				</tr>
			</thead>
			<tbody>

				<tr  style="text-align: justify;">
					<th style="width: 15%;">Anamnesis</th>
					<td><?php echo $respuesta['historias_anamnesis_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Antecedentes Oftalmológicos</th>
					<td><?php echo $respuesta['historias_antecedentes_oftalmologicos_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Antecedentes Personales</th>
					<td><?php echo $respuesta['historia_antecedentes_personales_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Antecedentes Familiares</th>
					<td><?php echo $respuesta['historias_antecedentes_familiares']; ?></td>
				</tr>
				
			</tbody>
		</table>

		<table  border="1" class="table table-hover table-bordered" >
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

		<table  border="1" class="table table-hover table-bordered">
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

		<table  border="1" class="table table-hover table-bordered" >
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
	                                <th width="25%"></th>
	                                <th width="25%">Sin Corrección</th>
	                                <th width="25%">Con Corrección</th>
	                                <th width="25%">Con Estenopeico</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <td style="text-align: center;">OD</td>
	                                <td>
	                                   <?php echo $respuesta['historias_sin_correcion_od_v'];?> 
	                                </td>
	                                <td>
	                                    <?php echo $respuesta['historias_con_correcion_od_v'];?> 
	                                </td>
	                                <td>
	                                    <?php echo $respuesta['historias_con_estenopeico_od_v'];?> 
	                                </td>
	                            </tr>
	                             <tr>
	                                <td style="text-align: center;">ID</td>
	                                <td>
	                                    <?php echo $respuesta['historias_sin_correcion_id_v'];?> 
	                                </td>
	                                <td>
	                                    <?php echo $respuesta['historias_sin_correcion_id_v'];?> 
	                                </td>
	                                <td>
	                                    <?php echo $respuesta['historias_sin_correcion_id_v'];?> 
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
					</td>
				</tr>
			</tbody>
		</table>

		<table  border="1" class="table table-hover table-bordered" >
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
	                                <th width="20%">Esfera</th>
	                                <th width="20%">Cilindro</th>
	                                <th width="20%">Eje</th>
	                                <th width="20%">Add</th>
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

		<table  border="1" class="table table-hover table-bordered" >
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
	                                <th width="15%">Esfera</th>
	                                <th width="15%">Cilindro</th>
	                                <th width="15%">Eje</th>
	                                <th width="15%">Add</th>
	                                <th width="15%">Av</th>	
	                                <th width="15%">DP</th>	
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
					<th>Test Acomodativo</th>
					<td colspan="2"><?php echo $respuesta['historias_test_acomodativo_v']; ?></td>
					<th>Resultado</th>
					<td colspan="2"><?php echo $respuesta['historias_resultado_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Test Amsier</th>
					<td><?php echo $respuesta['historias_test_amsier_v']; ?></td>
					<th>Test Color</th>
					<td><?php echo $respuesta['historias_test_color_v']; ?></td>
					<th>Test Estereópsis</th>
					<td><?php echo $respuesta['historias_test_estereopsis_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Descripción</th>
					<td colspan="5"><?php echo $respuesta['historias_descripcion_v']; ?></td>
				</tr>

			</tbody>
		</table>

		<table  border="1" class="table table-hover table-bordered" >
			<thead>
				<tr>
					<th colspan="2" style="text-align: justify;">ANTECEDENTES</th>
				</tr>
			</thead>
			<tbody>

				<tr  style="text-align: justify;">
					<th style="width: 15%;">Diagnóstico Principal</th>
					<td><?php echo $respuesta['historias_diagnostico_principal_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Diagnóstico Secundario</th>
					<td><?php echo $respuesta['historias_diagnostico_segundario_v']; ?></td>
				</tr>

				<tr  style="text-align: justify;">
					<th>Otros Diagnósticos</th>
					<td><?php echo $respuesta['historias_otros_diagnosticos_v']; ?></td>
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
			</tbody>
		</table>
	</div>
</div>
