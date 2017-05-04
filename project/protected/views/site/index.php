<div class="dashboard">
	<div class="row dashboard__widgets">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="widget">
				<div class="widget__icon">
					<i class="fa fa-users" aria-hidden="true"></i>
				</div>
				<div class="widget__text">
					<p>CLIENTES <strong>ACTIVOS</strong></p>
					<h2><?php echo $clientes; ?></h2>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="widget">
				<div class="widget__icon">
					<i class="fa fa-car" aria-hidden="true"></i>
				</div>
				<div class="widget__text">
					<!--<p>VEHÍCULOS <strong>REGISTRADOS</strong></p>
					<h2><?php echo $vehiculos; ?></h2>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="widget">
				<div class="widget__icon">
					<i class="fa fa-wrench" aria-hidden="true"></i>
				</div>
				<div class="widget__text">
					<p>VEHÍCULOS <strong>MANTENIMIENTO</strong></p>
					<h2><?php echo count($mantenimientos); ?></h2>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="widget">
				<div class="widget__icon">
					<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
				</div>
				<div class="widget__text">
					<p>VEHÍCULOS <strong>ESPERA</strong></p>
					<h2><?php echo $espera; ?></h2>
				</div>
			</div>
		</div>
	</div>

	<h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Vehiculos en Mantenimiento</h2>
				</div>
				<div class="widget__body padding">
					<br>
					<div>
						<table class="table table__datatable table-striped" cellspacing="0" width="100%">
							<thead>
					            <tr>
					            	<th>No.</th>
					                <th>Propietario</th>
					                <th>Vehiculo</th>
					                <th>Marca</th>
					                <th>Tipo</th>
					                <th>Mantenimiento</th>
					                <th>Opciones</th>
					            </tr>
					        </thead>
					        <tfoot>
					            <tr>
					            	<th>No.</th>
					                <th>Propietario</th>
					                <th>Vehiculo</th>
					                <th>Marca</th>
					                <th>Tipo</th>
					                <th>Mantenimiento</th>
					                <th>Opciones</th>
					            </tr>
					        </tfoot>
					        <tbody>
					        	<?php foreach ($mantenimientos as $key => $mantenimiento) {
					        		$itemID = 'mantenimientos_tr_'.$key;
					        		$vehiculo = $mantenimiento->vehiculo0;
					        		$propietario = $vehiculo->propietario0;
					        	?>
					        		<tr id="<?php echo $itemID; ?>">
					        			<td><?php echo $key+1; ?></td>
					        			<td><?php echo $propietario->usuario0->nombres; ?> <?php echo $propietario->usuario0->apellidos; ?></td>
					        			<td><?php echo $vehiculo->placas; ?></td>
					        			<td><?php echo $vehiculo->marca0->nombre; ?></td>
					        			<td><?php echo $vehiculo->tipo0->nombre; ?></td>
					        			<td><?php echo $mantenimiento->tipo0->nombre; ?></td>
					        			<td width="110">
					        				<div class="btn-group btn-group-xs">
					        					<a href="<?php echo $this->createUrl('ingresos/'.$mantenimiento->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary">Ver más <i class="fa fa-external-link"></i></a>
					        				</div>
					        			</td>
					        		</tr>
					        	<?php } ?>
					        </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>-->
</div>
