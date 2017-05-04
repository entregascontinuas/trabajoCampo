<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Datos Vehículo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-6">
						<strong>Propietario:</strong>
						<p><?php echo $propietario->usuario0->nombres; ?> <?php echo $propietario->usuario0->apellidos; ?></p>
					</div>
					<div class="col-sm-6">
						<strong>Identificacion:</strong>
						<p>CC: <?php echo $propietario->usuario0->cedula; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<strong>Tipo:</strong>
						<p><?php echo $vehiculo->tipo0->nombre; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Marca:</strong>
						<p><?php echo $vehiculo->marca0->nombre; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Referencia:</strong>
						<p><?php echo $vehiculo->referencia; ?></p>
					</div>
					<div class="col-sm-3">
						<?php $fechaIngreso = new DateTime($ingreso->fecha); ?>
						<strong>Fecha de ingreso:</strong>
						<p><?php echo $fechaIngreso->format('d \d\e F Y H:i:s'); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Registro Mantenimiento</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-6">
						<strong>Mecanico:</strong>
						<p><?php echo $mantenimiento->mecanico0->nombres; ?> <?php echo $mantenimiento->mecanico0->apellidos; ?></p>
					</div>
					<div class="col-sm-6">
						<strong>Celular:</strong>
						<p><?php echo $mantenimiento->mecanico0->telefono; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<strong>Tipo:</strong>
						<p><?php echo $mantenimiento->tipo0->nombre; ?></p>
					</div>
					<div class="col-sm-6">
						<?php $fecha = new DateTime($mantenimiento->fecha); ?>
						<strong>Fecha:</strong>
						<p><?php echo $fecha->format('d \d\e F Y H:i:s'); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Cambios:</strong>
						<div><?php echo $mantenimiento->cambios; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Observaciones</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-xs-12">
						<div><?php echo $mantenimiento->observaciones; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p><strong>Registro realizado por: </strong><?php echo $mantenimiento->usuarioRegistro->nombres; ?> <?php echo $mantenimiento->usuarioRegistro->apellidos; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row end-xs">
	<div class="col-xs-12">
		<a href="<?php echo $this->createUrl('ingresos/mantenimientos/'.$ingreso->id); ?>" class="btn">Atras</a>
	</div>
</div>