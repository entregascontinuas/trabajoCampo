<header class="content__header">
    <h1 class="header__title">Usuarios</h1>
    <h3 class="page__description">Listado de usuarios registrados</h3>
</header>
<!-- Page Heading End-->

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Lista Usuarios</h2>
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
				                <th>Rol</th>
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
				                <th>Rol</th>
				                <th>Email</th>
				                <th>Fecha Creación</th>
				                <th>Estado</th>
				                <th>Opciones</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	<?php foreach ($users as $key => $user) {
				        		$itemID = 'users_tr_'.$key;
				        	?>
				        		<tr id="<?php echo $itemID; ?>">
				        			<td><?php echo $key+1; ?></td>
				        			<td><?php echo $user->nombres; ?></td>
				        			<td><?php echo $user->apellidos; ?></td>
				        			<td><?php echo $user->rol0->nombre; ?></td>
				        			<td><?php echo $user->email; ?></td>
				        			<td><?php echo $user->fecha_creacion; ?></td>
				        			<td>
				        				<?php if($user->estado == 1){ ?>
				            				<span class="label label-success">Activo</span>
				            			<?php } else{ ?>
				            				<span class="label label-danger">Suspendido</span>
				            			<?php } ?>
				        			</td>
				        			<td>
				        				<div class="btn-group btn-group-xs">
				        					<a href="<?php echo $this->createUrl('usuarios/'.$user->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
				        					<a href="<?php echo $this->createUrl('usuarios/reset_password/'.$user->id) ?>" data-toggle="tooltip" title="Reset password" class="btn btn-primary link__confirm" data-cofirm__text="Se generara una nueva contraseña para el usuario <?php echo $user->nombres; ?>. Desea continuar con el proceso?" data-confirm__class="link__reset__pass"><i class="fa fa-refresh"></i></a>
				        					<?php if($user->rol != 1 || Yii::app()->user->getState('_rolUser') == 1){ ?>
												<a href="<?php echo $this->createUrl('usuarios/update/'.$user->id); ?>" data-toggle="tooltip" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
												<a href="<?php echo $this->createUrl('usuarios/delete_user/'.$user->id); ?>" data-toggle="tooltip" title="Eliminar" class="btn btn-primary link__confirm" data-cofirm__text="El usuario <?php echo $user->nombres; ?> sera eliminado del sistema, una vez realizado el proceso no podra revertir los cambios. Desea continuar con el proceso?" data-confirm__class="link__item-table__delete"><i class="fa fa-power-off"></i></a>
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