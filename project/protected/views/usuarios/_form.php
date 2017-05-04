<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	'action'=>($model->isNewRecord)?$this->createUrl('usuarios/create__ajax'):$this->createUrl('usuarios/update__ajax/'.$model->id),
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form '.(($model->isNewRecord)?'success__clear-form':''),
		'role'=>'form',
		'method'=>'post',
	),
)); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Datos Usuario</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Nombre:</label>
								<?php echo $form->textField($model,'nombres',array('maxlength'=>155,'class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Apellido(s):</label>
								<?php echo $form->textField($model,'apellidos',array('maxlength'=>155,'class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Identificación:</label>
								<?php echo $form->textField($model,'cedula',array('maxlength'=>155,'class'=>'form__input input__number','required'=>true)); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Teléfono:</label>
								<?php echo $form->telField($model,'telefono',array('maxlength'=>65,'class'=>'form__input input__number','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Correo electronico:</label>
								<?php echo $form->emailField($model,'email',array('maxlength'=>255,'class'=>'form__input')); ?>
						  	</div>
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
					<h2>Permisos Usuario</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Rol de usuario</label>
								<?php echo $form->dropDownList($model,'rol', $rolsList, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						  	<div class="form__section check__permissions" data-get-permissions="<?php echo $this->createUrl('rolsusuario/permissions'); ?>">
						  		<label class="form__label">Permisos</label>
						  		<?php
						  		$permissionsModel = CJSON::decode($model->permisos);
						  		$permissionsRol = CJSON::decode($model->rol0->permisos);
						  		foreach ($permissions as $key => $permission) { ?>
						  			<div class="checkbox">
							  			<label><input
							  				type="checkbox"
							  				<?php echo (in_array($permission->id,$permissionsRol,false))?'disabled="disabled"':''; ?>
							  				name="Usuarios[permissions][]"
							  				value="<?php echo $permission->id; ?>"
							  				<?php echo (in_array($permission->id,$permissionsModel,false))?'checked="checked"':''; ?>> 
							  					<?php echo $permission->nombre; ?>
							  			</label>
							  		</div>
						  		<?php } ?>
						  	</div>
						</div>
						<div class="col-sm-12">
							<div class="form__section">
								<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn')); ?>
				                <a href="<?php echo $this->createUrl('usuarios/admin'); ?>" class="btn btn-danger">Cancelar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>