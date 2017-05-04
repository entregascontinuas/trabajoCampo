<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Datos Propietario</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-4">
						<strong>Nombre y apellidos:</strong>
						<p><?php echo $propietario->usuario0->nombres; ?> <?php echo $propietario->usuario0->apellidos; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Identificacion:</strong>
						<p>CC: <?php echo $propietario->usuario0->cedula; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Correo electrónico:</strong>
						<p><?php echo $propietario->usuario0->email; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<strong>Ciduad:</strong>
						<p><?php echo $propietario->ciudad0->nombre; ?> - <?php echo $propietario->ciudad0->depende0->nombre; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Direcion:</strong>
						<p><?php echo $propietario->direccion; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Telefono:</strong>
						<p><?php echo $propietario->usuario0->telefono; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Celular:</strong>
						<p><?php echo $propietario->celular; ?></p>
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
				<h2>Ingreso del Vehiculo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-6">
						<strong>Tipo de mantenimiento:</strong>
						<p><?php echo $ingreso->tipo0->nombre; ?></p>
					</div>
					<div class="col-sm-6">
						<?php $fechaIngreso = new DateTime($ingreso->fecha); ?>
						<strong>Fecha de ingreso:</strong>
						<p><?php echo $fechaIngreso->format('d \d\e F Y H:i:s'); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Observaciones del cliente:</strong>
						<p><?php echo $ingreso->observaciones_cliente; ?></p>
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
				<h2>Estado del Vehiculo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-12">
						<strong>Kilometraje:</strong>
						<p><?php echo $ingreso->kilmetraje; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Desperfetos:</strong>
						<p><?php echo $ingreso->desperfectos; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Elementos en el auto:</strong>
						<p>
							<?php $elementos = CJSON::decode($ingreso->elementos); ?>
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
					<div class="col-xs-12">
						<?php if(count($mantenimientos) > 0){ ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tipo</th>
										<th>Mecanico</th>
										<th>Cambios</th>
										<th>Fecha</th>
										<th></th>
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
											<td>
												<div class="btn-group btn-group-xs">
					        						<a href="<?php echo $this->createUrl('ingresos/mantenimientos_view/'.$mantenimiento->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
					        					</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php }
						else { ?>
							<p><strong>Ningun mantenimiento realizado.</strong></p>
						<?php }?>
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
						<p><?php echo $ingreso->observaciones; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if(Tools::hasPermission(4)){ ?>
	<div class="row end-xs">
		<div class="col-xs-12">
			<a href="<?php echo $this->createUrl('ingresos/print/'.$ingreso->id) ?>" class="btn">
				<i class="fa fa-print" aria-hidden="true"></i>
				Comprobante
			</a>
		</div>
	</div>
<?php } ?> 