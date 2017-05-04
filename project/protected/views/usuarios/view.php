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
						<li class="list-group-item">
							<h4 class="list-group-item-heading">Ultimo acceso:</h4>
    						<?php $dateLastSesion = new DateTime($user->fecha_ultima_sesion); ?>
    						<p class="list-group-item-text"><?php echo date_format($dateLastSesion, 'd F Y - H:m:s'); ?>
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
						<h2>Datos Usuario</h2>
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
								<strong>Teléfono:</strong>
								<p><?php echo $user->telefono; ?></p>
							</div>
							<div class="col-sm-6">
								<strong>Correo electrónico:</strong>
								<p><a href="<?php echo ($user->email != '')?('mailto:'.$user->email):'#'; ?>"><?php echo ($user->email != '')?$user->email:'<small>No registra</small>'; ?></a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<strong>Permisos:</strong>
								<ul>
									<?php
										$permissions = CJSON::decode($user->permisos);
										foreach ($permissions as $key => $permission) {
											$permission = Permisos::model()->findByPk($permission);
										?>
											<li><?php echo $permission->nombre; ?></li>
										<?php }
									?>
								</ul>
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
						<h2>Datos Acceso</h2>
					</div>
					<div class="widget__body padding">
						<div class="row">
							<div class="col-sm-6">
								<strong>Usuario:</strong>
								<p><?php echo $user->cedula; ?></p>
							</div>
							<div class="col-sm-6">
								<strong>Contraseña:</strong>
								<p>**********</p>
							</div>
						</div>
						<div id="change__form" style="display: none;">
							<div class="row">
								<form id="form__change" method="POST" action="<?php echo $this->createUrl('profile/change_pass'); ?>" class="form success__clear-form col-xs-12">
									<div class="row">
										<div class="col-sm-6">
											<div class="form__section">
												<label class="form__label">Contraseña nueva:</label>
												<input type="password" name="Password[new]" id="pass__new" class="form__input">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form__section">
												<label class="form__label">Repetir contraseña:</label>
												<input type="password" id="pass__new2" class="form__input">
											</div>
										</div>
									</div>
									<div class="row bottom-xs">
										<div class="col-sm-6">
											<div class="form__section">
												<label class="form__label">Contraseña actual:</label>
												<input type="password" name="Password[current]" id="pass__current" class="form__input">
											</div>
										</div>
										<div class="col-sm-6 end-xs">
											<div class="form__section">
												<button type="submit" class="btn">Cambiar</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<?php if($user->id == Yii::app()->user->getState('_idUser')){ ?>
							<div class="row hidden__change">
								<div class="col-xs-12">
									<a href="#" id="change__password" class="btn">Modificar</a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>