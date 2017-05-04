<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vehiculos-form',
	'action'=>($model->isNewRecord)?$this->createUrl('vehiculos/create__ajax'):$this->createUrl('vehiculos/update__ajax/'.$model->id),
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
					<h2>Datos Propietario</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Identificación:</label>
								<?php echo $form->textField($modelUser,'cedula',array('maxlength'=>155,'class'=>'form__input input__number','required'=>true,'data-ajax__link'=>$this->createUrl('clientes/get_cliente'))); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Nombre:</label>
								<?php echo $form->textField($modelUser,'nombres',array('maxlength'=>155,'class'=>'form__input vehiculos__user__disabled','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Apellido(s):</label>
								<?php echo $form->textField($modelUser,'apellidos',array('maxlength'=>155,'class'=>'form__input vehiculos__user__disabled','required'=>true)); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form__section">
								<label class="form__label">Departamento:</label>
								<select name="Clientes[departamento]" id="Clientes_departamento" class="form__input vehiculos__user__disabled" data-select__load="<?php echo $this->createUrl('lugares/get_list') ?>">
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
								<?php echo $form->dropDownList($modelClient,'ciudad', (isset($ciudades)?$ciudades:(array(''=>'-- Seleccione una opción --'))), array('class'=>' select__depend form__input vehiculos__user__disabled','required'=>true,'data-select__depend'=>'#Clientes_departamento','data-select__option'=>($modelClient->ciudad != '')?$modelClient->ciudad0->depende:'')); ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Dirección:</label>
								<?php echo $form->telField($modelClient,'direccion',array('maxlength'=>155,'class'=>'form__input vehiculos__user__disabled')); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Correo electrónico:</label>
								<?php echo $form->emailField($modelUser,'email',array('maxlength'=>255,'class'=>'form__input vehiculos__user__disabled')); ?>
						  	</div>
						</div>
					</div>
					<input type="hidden" id="Clientes_new" name="Clientes[id]" value="<?php echo ($model->isNewRecord)?'0':$modelClient->id; ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Datos Vehículo</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Tipo:</label>
								<?php echo $form->dropDownList($model,'tipo', $tipos, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Marca:</label>
								<?php echo $form->dropDownList($model,'marca', $marcas, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-5">
							<div class="form__section">
								<label class="form__label">Referencia:</label>
								<?php echo $form->textField($model,'referencia',array('maxlength'=>155,'class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-7">
							<div class="form__section">
								<label class="form__label">Descripción:</label>
								<?php echo $form->textField($model,'descripcion',array('maxlength'=>255,'class'=>'form__input')); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form__section">
								<label class="form__label">Modelo:</label>
								<?php echo $form->textField($model,'modelo',array('maxlength'=>4,'class'=>'form__input input__number','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-4">
							<div class="form__section">
								<label class="form__label">Placas:</label>
								<?php echo $form->textField($model,'placas',array('maxlength'=>10,'class'=>'form__input input__mask','required'=>true,'data-mask'=>'aaa-999')); ?>
						  	</div>
						</div>
						<div class="col-sm-5">
							<div class="form__section">
								<label class="form__label">Tipo combustible:</label>
								<?php echo $form->dropDownList($model,'tipo_combustible', $combustibles, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form__section">
								<label class="form__label">Numero motor:</label>
								<?php echo $form->textField($model,'numero_motor',array('maxlength'=>65,'class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-4">
							<div class="form__section">
								<label class="form__label">Numero chasis:</label>
								<?php echo $form->textField($model,'numero_chasis',array('maxlength'=>65,'class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-sm-4">
							<div class="form__section">
								<label class="form__label">Color:</label>
								<?php echo $form->textField($model,'color',array('maxlength'=>45,'class'=>'form__input','required'=>true)); ?>
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
							<?php echo $form->textArea($model,'observaciones',array('class'=>'form__input','placeholder'=>'Ninguna','rows'=>6)); ?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<div class="form__section">
								<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn')); ?>
				                <a href="<?php echo $this->createUrl('vehiculos/admin'); ?>" class="btn btn-danger">Cancelar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>