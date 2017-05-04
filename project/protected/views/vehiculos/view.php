<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Datos Propietario</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-6">
						<strong>Nombre completo:</strong>
						<p><?php echo $user->nombres; ?> <?php echo $user->apellidos; ?></p>
					</div>
					<div class="col-sm-6">
						<strong>Identificacion:</strong>
						<p>CC: <?php echo $user->cedula; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<strong>Ciudad:</strong>
						<p><?php echo $vehiculo->propietario0->ciudad0->nombre; ?> - <?php echo $vehiculo->propietario0->ciudad0->depende0->nombre; ?></p>
					</div>
					<div class="col-sm-6">
						<strong>Dirección:</strong>
						<p><?php echo $vehiculo->propietario0->direccion; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<strong>Teléfono:</strong>
						<p><?php echo $user->telefono; ?></p>
					</div>
					<div class="col-sm-6">
						<strong>Celular:</strong>
						<p><?php echo $vehiculo->propietario0->celular; ?></p>
					</div>
					<div class="col-sm-6">
						<strong>Correo electrónico:</strong>
						<p><a href="<?php echo ($user->email != '')?('mailto:'.$user->email):'#'; ?>"><?php echo ($user->email != '')?$user->email:'<small>No registra</small>'; ?></a></p>
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
				<h2>Datos Vehículo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-4">
						<strong>Tipo:</strong>
						<p><?php echo $vehiculo->tipo0->nombre; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Marca:</strong>
						<p><?php echo $vehiculo->marca0->nombre; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Referencia:</strong>
						<p><?php echo $vehiculo->referencia; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<strong>Descripción:</strong>
						<p><?php echo ($vehiculo->descripcion != '')?$vehiculo->descripcion:'Ninguna...'; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Modelo:</strong>
						<p><?php echo $vehiculo->modelo; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Placas:</strong>
						<p><?php echo $vehiculo->placas; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<strong>Combustible:</strong>
						<p><?php echo $vehiculo->tipoCombustible->nombre; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Numero motor:</strong>
						<p><?php echo $vehiculo->numero_motor; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Numero chasis:</strong>
						<p><?php echo $vehiculo->numero_chasis; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Color:</strong>
						<p><?php echo $vehiculo->color; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<strong>Observaciones:</strong>
						<p><?php echo ($vehiculo->observaciones != '')?$vehiculo->observaciones:'Ninguna...'; ?></p>
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
				<h2>Registros de Ingreso</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-xs-12">
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
										<th></th>
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
											<td>
												<div class="btn-group btn-group-xs">
					        						<a href="<?php echo $this->createUrl('ingresos/'.$vehiculo->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
					        					</div>
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
			</div>
		</div>
	</div>
</div>

<div class="row end-xs">
	<div class="col-xs-12">
		<a href="<?php echo $this->createUrl('vehiculos/print/'.$vehiculo->id) ?>" class="btn">
			<i class="fa fa-print" aria-hidden="true"></i>
			Generar vista impresión
		</a>
	</div>
</div>