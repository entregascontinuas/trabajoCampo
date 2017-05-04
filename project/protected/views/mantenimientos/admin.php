<header class="content__header">
    <h1 class="header__title">Registros de Mantenimientos [<?php echo $ingreso->vehiculo0->placas; ?>]</h1>
    <h3 class="page__description">Listado de mantenimientos a un vehículo</h3>
</header>
<!-- Page Heading End-->

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Lista Mantenimientos</h2>
			</div>
			<div class="widget__body padding">
				<br>
				<div class="table-responsive">
					<table class="table table__datatable table-striped" cellspacing="0" width="100%">
						<thead>
				            <tr>
				            	<th>No.</th>
				                <th>Tipo</th>
				                <th>Cambios</th>
				                <th>Mecanico</th>
				                <th>Fecha</th>
				                <th>Opciones</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				            	<th>No.</th>
				                <th>Tipo</th>
				                <th>Cambios</th>
				                <th>Mecanico</th>
				                <th>Fecha</th>
				                <th>Opciones</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	<?php foreach ($mantenimientos as $key => $mantenimiento) {
				        		$itemID = 'mantenimientos_tr_'.$key;
				        		$mecanico = $mantenimiento->mecanico0;
				        		$fecha = new DateTime($mantenimiento->fecha);
				        	?>
				        		<tr id="<?php echo $itemID ?>">
				        			<td><?php echo $key+1; ?></td>
				        			<td><?php echo $mantenimiento->tipo0->nombre ?></td>
				        			<td><?php echo $mantenimiento->cambios; ?></td>
				        			<td><?php echo $mecanico->nombres; ?> <?php echo $mecanico->apellidos; ?></td>
				        			<td><?php echo $fecha->format('d \d\e F Y H:i:s'); ?></td>
				        			<td>
				        				<div class="btn-group btn-group-xs">
				        					<a href="<?php echo $this->createUrl('ingresos/mantenimientos_view/'.$mantenimiento->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
				        					<?php if($mantenimiento->usuario_registro == Yii::app()->user->getState('_idUser')){ ?>
				        						<a href="<?php echo $this->createUrl('ingresos/mantenimientos_update/'.$mantenimiento->id); ?>" data-toggle="tooltip" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
			        						<?php } ?>
				        					<?php if(Yii::app()->user->getState('_rolUser') == 1){ ?>
												<a href="<?php echo $this->createUrl('ingresos/mantenimientos_delete/'.$mantenimiento->id); ?>" data-toggle="tooltip" title="Eliminar" class="btn btn-primary link__confirm" data-cofirm__text="El registro de mantenimiento sera eliminado del sistema, una vez realizado el proceso no podra revertir los cambios. Desea continuar con el proceso?" data-confirm__class="link__item-table__delete"><i class="fa fa-power-off"></i></a>
											<?php } ?>
				        				</div>
				        			</td>
				        		</tr>
				        	<?php } ?>
				        </tbody>
					</table>
				</div>
				<br>
				<div class="row end-xs">
					<div class="col-xs-12">
						<a href="<?php echo $this->createUrl('ingresos/mantenimientos_create/'.$ingreso->id); ?>" class="btn">Agregar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>