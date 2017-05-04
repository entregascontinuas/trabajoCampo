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
				<h1 class="title">COMPROBANTE DE INGRESO A TALLER</h1>
				<p class="print__number"><strong>N. <?php echo str_pad($model->id, 4, "0", STR_PAD_LEFT); ?></strong></p>
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
			<h2>INGRESO DEL VEHICULO</h2>
		</div>
		<div class="zone__body">
			<table>
				<tr>
					<td>
						<p><strong>Tipo de mantenimiento</strong></p>
						<p><input type="text" value="<?php echo $model->tipo0->nombre; ?>" readonly></p>
					</td>
					<td>
						<?php $fechaIngreso = new DateTime($model->fecha); ?>
						<p><strong>Fecha de ingreso</strong></p>
						<p><input type="text" value="<?php echo $fechaIngreso->format('d \d\e F Y H:i:s'); ?>" readonly></p>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<p><strong>Observaciones del cliente</strong></p>
						<p>
							<div class="area__text"><?php echo $model->observaciones_cliente; ?></div>
						</p>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="print__zone">
		<div class="zone__header">
			<h2>ESTADO DEL VEHICULO</h2>
		</div>
		<div class="zone__body">
			<table>
				<tr>
					<td>
						<p><strong>Kilometraje</strong></p>
						<p><input type="text" value="<?php echo $model->kilmetraje; ?>" readonly></p>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<p><strong>Desperfectos</strong></p>
						<p>
							<div class="area__text"><?php echo $model->desperfectos; ?></div>
						</p>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<p><strong>Elementos en el auto</strong></p>
						<p>
							<?php $elementos = CJSON::decode($model->elementos); ?>
							<ul class="row">
								<?php
									foreach ($elementos as $key => $elemento) {
										$elemento = ElementosVehiculo::model()->findByPk($elemento);
									?>
										<li class="col-sm-4 col-xs-12"><?php echo $elemento->nombre; ?></li>
									<?php }
								?>
							</ul>
							<?php echo (count($elementos) == 0)?'Ninguno':''; ?>
						</p>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php if(count($mantenimientos) > 0){ ?>
		<div class="print__zone">
			<div class="zone__header">
				<h2>MANTENIMIENTOS</h2>
			</div>
			<div class="zone__body">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tipo</th>
							<th>Mecanico</th>
							<th>Cambios</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($mantenimientos as $key => $mantenimiento) {
							$fecha = new DateTime($mantenimiento->fecha);
						?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $mantenimiento->tipo0->nombre; ?></td>
								<td><?php echo $mantenimiento->mecanico0->nombres; ?> <?php echo $mantenimiento->mecanico0->apellidos; ?></td>
								<td><?php echo $mantenimiento->cambios; ?></td>
								<td><?php echo $fecha->format('d \d\e F Y H:i:s'); ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php } ?>
	<div class="print__zone">
		<div class="zone__header">
			<h2>OBSERVACIONES</h2>
		</div>
		<div class="zone__body">
			<table>
				<tr>
					<td>
						<p>
							<div class="area__text"><?php echo $model->observaciones; ?></div>
						</p>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<table class="print__footer">
		<tr>
			<td>
				<p><small>Comprobante impreso por SIADCAR</small></p>
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