<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingresos-form',
	'action'=>($model->isNewRecord)?$this->createUrl('ingresos/create__ajax'):$this->createUrl('ingresos/update__ajax/'.$model->id),
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
					<h2>Datos Vehiculo</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form__section">
								<label class="form__label">Placas:</label>
								<input type="text" name="Vehiculos[placas]" id="Vehiculos__placas" data-load__info="<?php echo $this->createUrl('vehiculos/get_info') ?>" class="form__input input__mask" required <?php echo (isset($vehiculo))?'readonly disabled':''; ?> value="<?php echo (isset($vehiculo))?$model->vehiculo0->placas:''; ?>" data-mask='aaa-999'>
								<?php echo $form->hiddenField($model,'vehiculo',array('required'=>true)); ?>
						  	</div>
						  	<div id="ingresos__go__add" style="<?php echo (isset($vehiculo))?'display:none;':''; ?>">
					  			<a class="btn" href="<?php echo $this->createUrl('vehiculos/create'); ?>">Agregar vehículo</a>
						  	</div>
						</div>
					</div>
					<div id="Vehiculos__info">
						<?php echo (isset($vehiculo))?$vehiculo:''; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Ingreso Vehiculo</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Tipo:</label>
								<?php echo $form->dropDownList($model,'tipo', $tipos, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Observaciones del cliente:</label>
								<?php echo $form->textArea($model,'observaciones_cliente',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6, 'required'=>true)); ?>
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
					<h2>Estado Vehiculo</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Kilometraje:</label>
								<?php echo $form->textField($model,'kilmetraje',array('class'=>'form__input input__number','required'=>true)); ?>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Desperfectos:</label>
								<?php echo $form->textArea($model,'desperfectos',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6)); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<label class="form__label">Elementos en el auto:</label>
							<div class="row">
								<?php
						  		$elementosModel = CJSON::decode($model->elementos);
								foreach ($elementos as $key => $elemento) { ?>
						  			<div class="col-sm-4 col-xs-12">
							  			<div class="form__section">
								  			<label><input
								  				type="checkbox"
								  				name="RegistrosIngreso[elementos][]"
								  				value="<?php echo $elemento->id; ?>"
								  				<?php echo (in_array($elemento->id,$elementosModel,false))?'checked="checked"':''; ?>> 
								  					<?php echo $elemento->nombre; ?>
								  			</label>
								  		</div>
						  			</div>
						  		<?php } ?>
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
					<?php echo $form->textArea($model,'observaciones',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6)); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="col-xs-12">
			<div class="form__section">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn')); ?>
                <a href="<?php echo $this->createUrl('ingresos/admin'); ?>" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>