<?php
	$date = new DateTime();
?>

<div class="page__print">
	<table class="print__head">
		<tr>
			<td class="print__logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo__tma.png" alt="Siadcar"></td>
			<td class="print__info__company">
				<p><strong> TECNO MECÁNICA AUTOMOTRIZ </strong></p>
				<p><strong> Transversal 29 No. 16 - 19 </strong></p>
				<p><strong> Duitama - Boyacá </strong></p>
				<p><strong> (57) (8) 760 4010 </strong></p>
				
			</td>
			<td class="print__title">
				<h1 class="title">HOJA DE VIDA DE VEHÍCULO</h1>
				<p class="print__number"><strong>PLACAS: <?php echo Tools::strToUpper($vehiculo->placas); ?></strong></p>
				<p><strong>Fecha: </strong><?php echo $date->format('d \d\e F Y'); ?></p>
			</td>
		</tr>
	</table>
	<div class="print__zone">
		<div class="zone__header">
			<h2>PROPIETARIO</h2>
		</div>
		<div class="zone__body">
			<table>
				<tr>
					<td>
						<p><strong>Nombres y apellidos</strong></p>
						<p><input type="text" value="<?php echo $propietario->usuario0->nombres; ?> <?php echo $propietario->usuario0->apellidos; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Identificación</strong></p>
						<p><input type="text" value="<?php echo $propietario->usuario0->cedula; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Correo electrónico</strong></p>
						<p><input type="text" value="<?php echo $propietario->usuario0->email; ?>" readonly></p>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<p><strong>Ciudad</strong></p>
						<p><input type="text" value="<?php echo $propietario->ciudad0->nombre; ?> <?php echo $propietario->ciudad0->depende0->nombre; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Dirección</strong></p>
						<p><input type="text" value="<?php echo $propietario->direccion; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Teléfono</strong></p>
						<p><input type="text" value="<?php echo $propietario->usuario0->telefono; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Celular</strong></p>
						<p><input type="text" value="<?php echo $propietario->celular; ?>" readonly></p>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="print__zone">
		<div class="zone__header">
			<h2>DATOS DEL VEHÍCULO</h2>
		</div>
		<div class="zone__body">
			<table>
				<tr>
					<td>
						<p><strong>Tipo</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->tipo0->nombre; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Tipo</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->marca0->nombre; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Tipo</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->referencia; ?>" readonly></p>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<p><strong>Descripción</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->descripcion; ?>" readonly></p>
					</td>
					<td width="20%">
						<p><strong>Modelo</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->modelo; ?>" readonly></p>
					</td>
					<td width="20%">
						<p><strong>Placas</strong></p>
						<p><input type="text" value="<?php echo Tools::strToUpper($vehiculo->placas); ?>" readonly></p>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="40%">
						<p><strong>Combustible</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->tipoCombustible->nombre; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Numero motor</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->numero_motor; ?>" readonly></p>
					</td>
					<td>
						<p><strong>Numero chasis</strong></p>
						<p><input type="text" value="<?php echo $vehiculo->numero_chasis; ?>" readonly></p>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="print__zone">
		<div class="zone__header">
			<h2>REGISTROS DE INGRESO</h2>
		</div>
		<div class="zone__body">
			<?php if(count($ingresos) > 0){ ?>
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tipo ingreso</th>
							<th>Fecha</th>
							<th>Observaciones cliente</th>
							<th>Observaciones</th>
							<th>Estado<th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($ingresos as $key => $ingreso) {
							$fechaIngreso = new DateTime($ingreso->fecha);
						?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $ingreso->tipo0->nombre; ?></td>
								<td><?php echo $fechaIngreso->format('d \d\e F Y H:i:s'); ?></td>
								<td><?php echo $ingreso->observaciones_cliente; ?></td>
								<td><?php echo $ingreso->observaciones; ?></td>
								<td><p>
										<?php if($ingreso->estado == 1){ echo "Entregado"; }
										elseif($ingreso->estado == 3){ echo "En revisión"; }
										elseif($ingreso->estado == 4){ echo "Listo"; }
										else{ echo "En espera"; } ?>
			            			</p>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php }
			else{ ?>
				<p><strong>No existe ningun registro de ingreso.</strong></p>
			<?php } ?>
		</div>
	</div>

	<table class="print__footer">
		<tr>
			<td>
				<p><small>Comprobante impreso por el software SIADCAR</small></p>
			</td>
			<td class="page__firma">
				<hr>
				<p><small>Firma representante legal</small></p>
			</td>
		</tr>
	</table>
</div>
<br><br>
<div class="row end-xs">
	<div class="col-xs-12">
		<a href="#" class="run__print__page btn">
			<i class="fa fa-print" aria-hidden="true"></i>
			Imprimir
		</a>
	</div>
</div>