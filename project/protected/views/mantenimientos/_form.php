<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mantenimientos-form',
	'action'=>($model->isNewRecord)?$this->createUrl('ingresos/mantenimientos_create__ajax/'.$ingreso->id):$this->createUrl('ingresos/mantenimientos_update__ajax/'.$model->id),
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
					<h2>Cambios Realizados</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form__section">
								<label class="form__label">Tipo:</label>
								<?php echo $form->dropDownList($model,'tipo', $tipos, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<?php if(Yii::app()->user->getState("_rolUser") != 3){ ?>
							<div class="col-sm-6 col-xs-12">
								<div class="form__section">
									<label class="form__label">Mecanico:</label>
									<?php echo $form->dropDownList($model,'mecanico', $mecanicos, array('class'=>'form__input','required'=>true)); ?>
							  	</div>
							</div>
						<?php } ?>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<label class="form__label">Cambios:</label>
							<?php echo $form->textArea($model,'cambios',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6)); ?>
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
							<?php echo $form->textArea($model,'observaciones',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6)); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="col-xs-12">
			<div class="form__section">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn')); ?>
                <a href="<?php echo $this->createUrl('ingresos/mantenimientos/'.$ingreso->id); ?>" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>