<header class="content__header">
    <h1 class="header__title">Registro de Ingresos</h1>
    <h3 class="page__description">Listado de ingresos de vehículos</h3>
</header>
<!-- Page Heading End-->

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Lista Ingresos</h2>
			</div>
			<div class="widget__body padding">
				<br>
				<div>
					<table class="table table__datatable table-striped" cellspacing="0" width="100%">
						<thead>
				            <tr>
				            	<th>No.</th>
				                <th>Propietario</th>
				                <th>Identificación</th>
				                <th>Vehiculo</th>
				                <th>Marca</th>
				                <th>Tipo</th>
				                <th>Fecha</th>
				                <th>Estado</th>
				                <th></th>
				                <th>Opciones</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				            	<th>No.</th>
				                <th>Propietario</th>
				                <th>Identificación</th>
				                <th>Vehiculo</th>
				                <th>Marca</th>
				                <th>Tipo</th>
				                <th>Fecha</th>
				                <th>Estado</th>
				                <th></th>
				                <th>Opciones</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	<?php foreach ($ingresos as $key => $ingreso) {
				        		$itemID = 'ingresos_tr_'.$key;
				        		$vehiculo = $ingreso->vehiculo0;
				        		$propietario = $vehiculo->propietario0;
				        	?>
				        		<tr id="<?php echo $itemID; ?>">
				        			<td><?php echo $key+1; ?></td>
				        			<td><?php echo $propietario->usuario0->nombres; ?> <?php echo $propietario->usuario0->apellidos; ?></td>
				        			<td><?php echo $propietario->usuario0->cedula; ?></td>
				        			<td><?php echo $vehiculo->placas; ?></td>
				        			<td><?php echo $vehiculo->marca0->nombre; ?></td>
				        			<td><?php echo $ingreso->tipo0->nombre; ?></td>
				        			<td><?php echo $ingreso->fecha; ?></td>
				        			<td class="tag__status">
				        				<?php if($ingreso->estado == 1){ ?>
				            				<span class="label label-primary">Entregado</span>
				            			<?php } elseif($ingreso->estado == 3){ ?>
				            				<span class="label label-warning">En revisión</span>
				            			<?php } elseif($ingreso->estado == 4){ ?>
				            				<span class="label label-success">Listo</span>
				            			<?php } else{ ?>
				            				<span class="label label-danger">En espera</span>
				            			<?php } ?>
				        			</td>
				        			<td>
				        				<div class="btn-group btn-group-xs">
				        					<div class="btn-group btn-group-xs" role="group">
												<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Cambiar
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<?php if(Tools::hasPermission(4)){ ?>
														<li><a class="link__ajax" href="<?php echo $this->createUrl('ingresos/change_estado/'.$ingreso->id.'?estado=0'); ?>" data-callback="$changeStatus">En espera</a></li>
													<?php } ?>
													<li><a class="link__ajax" href="<?php echo $this->createUrl('ingresos/change_estado/'.$ingreso->id.'?estado=3'); ?>" data-callback="$changeStatus">En revisión</a></li>
													<li><a class="link__ajax" href="<?php echo $this->createUrl('ingresos/change_estado/'.$ingreso->id.'?estado=4'); ?>" data-callback="$changeStatus">Listo</a></li>
													<?php if(Tools::hasPermission(4)){ ?>
														<li><a class="link__ajax" href="<?php echo $this->createUrl('ingresos/change_estado/'.$ingreso->id.'?estado=1'); ?>" data-callback="$changeStatus">Entregado</a></li>
													<?php } ?>
												</ul>
											</div>
										</div>
				        			</td>
				        			<td width="110">
				        				<div class="btn-group btn-group-xs">
				        					<a href="<?php echo $this->createUrl('ingresos/'.$ingreso->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
				        					<?php if(Tools::hasPermission(4)){ ?>
				        						<a href="<?php echo $this->createUrl('ingresos/print/'.$ingreso->id) ?>" data-toggle="tooltip" title="Comprobante" class="btn btn-primary"><i class="fa fa-print"></i></a>
			        						<?php } ?>
				        					
				        					<?php if(Yii::app()->user->getState('_rolUser') == 1){ ?>
												<a href="<?php echo $this->createUrl('ingresos/update/'.$ingreso->id); ?>" data-toggle="tooltip" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<?php } ?>

											<a style="<?php echo ($ingreso->estado != 3)?'display:none':''; ?>" href="<?php echo $this->createUrl('ingresos/mantenimientos/'.$ingreso->id); ?>" data-toggle="tooltip" title="Mantenimientos" class="status__active btn btn-primary" data-status__active="3"><i class="fa fa-wrench"></i></a>

											<?php if(Yii::app()->user->getState('_rolUser') == 1){ ?>
												<a href="<?php echo $this->createUrl('ingresos/delete_ingreso/'.$ingreso->id); ?>" data-toggle="tooltip" title="Eliminar" class="btn btn-primary link__confirm" data-cofirm__text="El registro de ingreso del vehiculo <?php echo $vehiculo->placas ?> sera eliminado del sistema, una vez realizado el proceso no podra revertir los cambios. Desea continuar con el proceso?" data-confirm__class="link__item-table__delete"><i class="fa fa-power-off"></i></a>
											<?php } ?>
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