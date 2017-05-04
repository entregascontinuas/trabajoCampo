<header class="content__header">
    <h1 class="header__title">Vehículos</h1>
    <h3 class="page__description">Listado de vehículos registrados</h3>
</header>
<!-- Page Heading End-->

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Lista Vehículos</h2>
			</div>
			<div class="widget__body padding">
				<br>
				<div class="table-responsive">
					<table class="table table__datatable table-striped" cellspacing="0" width="100%">
						<thead>
				            <tr>
				            	<th>No.</th>
				                <th>Propietario</th>
				                <th>Tipo</th>
				                <th>Marca</th>
				                <th>Referencia</th>
				                <th>Placas</th>
				                <th>Fecha Creación</th>
				                <th>Estado</th>
				                <th width="80">Opciones</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				            	<th>No.</th>
				                <th>Propietario</th>
				                <th>Tipo</th>
				                <th>Marca</th>
				                <th>Referencia</th>
				                <th>Placas</th>
				                <th>Fecha Creación</th>
				                <th>Estado</th>
				                <th>Opciones</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	<?php foreach ($vehiculos as $key => $vehiculo) {
				        		$itemID = 'vehiculos_tr_'.$key;
				        		$user = $vehiculo->propietario0->usuario0;
				        	?>
				        		<tr id="<?php echo $itemID; ?>">
				        			<td><?php echo $key+1; ?></td>
				        			<td><?php echo $user->nombres; ?> <?php echo $user->apellidos; ?></td>
				        			<td><?php echo $vehiculo->tipo0->nombre; ?></td>
				        			<td><?php echo $vehiculo->marca0->nombre; ?></td>
				        			<td><?php echo $vehiculo->referencia; ?></td>
				        			<td><?php echo $vehiculo->placas; ?></td>
				        			<td><?php echo $vehiculo->fecha_creacion; ?></td>
				        			<td>
				        				<?php if($vehiculo->estado == 1){ ?>
				            				<span class="label label-success">Activo</span>
				            			<?php } else{ ?>
				            				<span class="label label-danger">Suspendido</span>
				            			<?php } ?>
				        			</td>
				        			<td>
				        				<div class="btn-group btn-group-xs">
				        					<a href="<?php echo $this->createUrl('vehiculos/'.$vehiculo->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
				        					<a href="<?php echo $this->createUrl('vehiculos/print/'.$vehiculo->id) ?>" data-toggle="tooltip" title="Hoja de vida" class="btn btn-primary"><i class="fa fa-print"></i></a>
											<a href="<?php echo $this->createUrl('vehiculos/update/'.$vehiculo->id); ?>" data-toggle="tooltip" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?php echo $this->createUrl('vehiculos/delete_vehiculo/'.$vehiculo->id); ?>" data-toggle="tooltip" title="Eliminar" class="btn btn-primary link__confirm" data-cofirm__text="El vehiculo de placas <?php echo $vehiculo->placas; ?> sera eliminado del sistema, una vez realizado el proceso no podra revertir los cambios. Desea continuar con el proceso?" data-confirm__class="link__item-table__delete"><i class="fa fa-power-off"></i></a>
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
</div>