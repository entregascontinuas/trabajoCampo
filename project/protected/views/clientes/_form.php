<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clientes-form',
	'action'=>($modelUser->isNewRecord)?$this->createUrl('clientes/create__ajax'):$this->createUrl('clientes/update__ajax/'.$modelClient->id),
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form '.(($modelUser->isNewRecord)?'success__clear-form':''),
		'role'=>'form',
		'method'=>'post',
	),
)); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Datos Cliente</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Identificación:</label>
								<?php echo $form->textField($modelUser,'cedula',array('maxlength'=>155,'class'=>'form__input input__number','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Nombre:</label>
								<?php echo $form->textField($modelUser,'nombres',array('maxlength'=>155,'class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Apellido(s):</label>
								<?php echo $form->textField($modelUser,'apellidos',array('maxlength'=>155,'class'=>'form__input','required'=>true)); ?>
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
					<h2>Datos de Contacto</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form__section">
								<label class="form__label">Departamento:</label>
								<select name="Clientes[departamento]" id="Clientes_departamento" class="form__input" data-select__load="<?php echo $this->createUrl('lugares/get_list') ?>">
									<option value="">-- Seleccione una opción --</option>
									<?php foreach ($departamentos as $key => $departamento) { ?>
										<option value="<?php echo $departamento->id; ?>"><?php echo $departamento->nombre; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form__section">
								<label class="form__label">Ciudad:</label>
								<?php echo $form->dropDownList($modelClient,'ciudad', (isset($ciudades)?$ciudades:(array(''=>'-- Seleccione una opción --'))), array('class'=>' select__depend form__input','required'=>true,'data-select__depend'=>'#Clientes_departamento','data-select__option'=>($modelClient->ciudad != '')?$modelClient->ciudad0->depende:'')); ?>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Dirección:</label>
								<?php echo $form->telField($modelClient,'direccion',array('maxlength'=>155,'class'=>'form__input')); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Teléfono:</label>
								<?php echo $form->telField($modelUser,'telefono',array('maxlength'=>65,'class'=>'form__input')); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Celular:</label>
								<?php echo $form->telField($modelClient,'celular',array('maxlength'=>15,'class'=>'form__input input__number')); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form__section">
								<label class="form__label">Correo electronico:</label>
								<?php echo $form->emailField($modelUser,'email',array('maxlength'=>255,'class'=>'form__input')); ?>
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
					<h2>Observaciones</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-xs-12">
							<?php echo $form->textArea($modelClient,'observaciones',array('class'=>'form__input','placeholder'=>'Ninguna','rows'=>6)); ?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<div class="form__section">
								<?php echo CHtml::submitButton($modelUser->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn')); ?>
				                <a href="<?php echo $this->createUrl('clientes/admin'); ?>" class="btn btn-danger">Cancelar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>