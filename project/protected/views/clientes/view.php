<div class="row">
	<div class="col-sm-4">
		<div class="widget widget__transparent">
			<div class="widget__body padding">
				<div class="user__profile">
		            <div style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/users/<?php echo $user->image; ?>)" class="user__image circle__image"></div>
		            <h1><?php echo $user->nombres; ?></h1>
		            <h3><?php echo $user->rol0->nombre; ?></h3>
		        </div>
		        <div class="user__profile">
		        	<ul class="list-group">
						<li class="list-group-item">
							<h4 class="list-group-item-heading">Fecha creacion:</h4>
							<?php $dateAdd = new DateTime($user->fecha_creacion); ?>
    						<p class="list-group-item-text"><?php echo date_format($dateAdd, 'd F Y - H:m:s'); ?></p>
						</li>
					</ul>
		        </div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="row">
			<div class="col-xs-12">
				<div class="widget">
					<div class="widget__header">
						<h2>Datos Cliente</h2>
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
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="widget">
					<div class="widget__header">
						<h2>Datos Contacto</h2>
					</div>
					<div class="widget__body padding">
						<div class="row">
							<div class="col-sm-6">
								<strong>Ciudad:</strong>
								<p><?php echo $client->ciudad0->nombre; ?> - <?php echo $client->ciudad0->depende0->nombre; ?></p>
							</div>
							<div class="col-sm-6">
								<strong>Dirección:</strong>
								<p><?php echo $client->direccion; ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<strong>Teléfono:</strong>
								<p><?php echo $user->telefono; ?></p>
							</div>
							<div class="col-sm-6">
								<strong>Celular:</strong>
								<p><?php echo $client->celular; ?></p>
							</div>
							<div class="col-sm-12">
								<strong>Correo electrónico:</strong>
								<p><a href="<?php echo ($user->email != '')?('mailto:'.$user->email):'#'; ?>"><?php echo ($user->email != '')?$user->email:'<small>No registra</small>'; ?></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12">
				<div class="widget">
					<div class="widget__header">
						<h2>Vehiculos</h2>
					</div>
					<div class="widget__body padding">
						<div class="row">
							<div class="col-xs-12">
								<?php if(count($vehiculos) > 0){ ?>
									<table class="table table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>Tipo</th>
												<th>Marca</th>
												<th>Referencia</th>
												<th>Modelo</th>
												<th>Placas</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($vehiculos as $key => $vehiculo) { ?>
												<tr>
													<td><?php echo $key+1; ?></td>
													<td><?php echo $vehiculo->tipo0->nombre; ?></td>
													<td><?php echo $vehiculo->marca0->nombre; ?></td>
													<td><?php echo $vehiculo->referencia; ?></td>
													<td><?php echo $vehiculo->modelo; ?></td>
													<td><?php echo $vehiculo->placas; ?></td>
													<td>
														<div class="btn-group btn-group-xs">
							        						<a href="<?php echo $this->createUrl('vehiculos/'.$vehiculo->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
							        					</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php }
								else { ?>
									<p><strong>Ningun vehiculo registrado.</strong></p>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12">
				<div class="widget">
					<div class="widget__header">
						<h2>Observaciones</h2>
					</div>
					<div class="widget__body padding">
						<div class="row">
							<div class="col-sm-12">
								<p><?php echo $client->observaciones; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>