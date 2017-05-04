<header class="content__header">
    <h1 class="header__title">Clientes</h1>
    <h3 class="page__description">Listado de clientes registrados</h3>
</header>
<!-- Page Heading End-->

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Lista Clientes</h2>
			</div>
			<div class="widget__body padding">
				<br>
				<div class="table-responsive">
					<table class="table table__datatable table-striped" cellspacing="0" width="100%">
						<thead>
				            <tr>
				            	<th>No.</th>
				                <th>Nombre</th>
				                <th>Apellido</th>
				                <th>Cédula</th>
				                <th>Celular</th>
				                <th>Email</th>
				                <th>Fecha Creación</th>
				                <th>Estado</th>
				                <th>Opciones</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				            	<th>No.</th>
				                <th>Nombre</th>
				                <th>Apellido</th>
				                <th>Cédula</th>
				                <th>Celular</th>
				                <th>Email</th>
				                <th>Fecha Creación</th>
				                <th>Estado</th>
				                <th>Opciones</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	<?php foreach ($clients as $key => $client) {
				        		$itemID = 'clients_tr_'.$key;
				        		$user = $client->usuario0;
				        	?>
				        		<tr id="<?php echo $itemID; ?>">
				        			<td><?php echo $key+1; ?></td>
				        			<td><?php echo $user->nombres; ?></td>
				        			<td><?php echo $user->apellidos; ?></td>
				        			<td><?php echo $user->cedula; ?></td>
				        			<td><?php echo $client->celular; ?></td>
				        			<td><?php echo Tools::strBefore('@', $user->email); ?>@...</td>
				        			<td><?php echo $user->fecha_creacion; ?></td>
				        			<td>
				        				<?php if($client->estado == 1){ ?>
				            				<span class="label label-success">Activo</span>
				            			<?php } else{ ?>
				            				<span class="label label-danger">Suspendido</span>
				            			<?php } ?>
				        			</td>
				        			<td>
				        				<div class="btn-group btn-group-xs">
				        					<a href="<?php echo $this->createUrl('clientes/'.$client->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
											<a href="<?php echo $this->createUrl('clientes/update/'.$client->id); ?>" data-toggle="tooltip" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?php echo $this->createUrl('clientes/delete_client/'.$client->id); ?>" data-toggle="tooltip" title="Eliminar" class="btn btn-primary link__confirm" data-cofirm__text="El cliente <?php echo $user->nombres; ?> sera eliminado del sistema, una vez realizado el proceso no podra revertir los cambios. Desea continuar con el proceso?" data-confirm__class="link__item-table__delete"><i class="fa fa-power-off"></i></a>
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