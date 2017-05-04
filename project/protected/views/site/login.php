      <div class="row center-xs">
        <div class="col-xs-12"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="SiadCar" class="logo"/></div>
      </div>
      <div class="limiter__content">
        <h1 class="title__section">INICIAR SESIÓN</h1>
        <div class="row">
          <div class="col-xs-12">
            <?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'login-form',
              'enableClientValidation'=>false,
              'clientOptions'=>array(
                'validateOnSubmit'=>false,
              ),
              'htmlOptions'=>array(
                'method'=>"POST",
                'class'=>'form',
                'data-form__success'=>'$.reload()'
              )
            )); ?>
              <div class="form__section">
                <?php echo $form->textField($model,'username', array("class"=>'form__input', "placeholder"=>'Usuario', "required"=>true, "autocomplete"=>'off')); ?>
              </div>
              <div class="form__section">
                <?php echo $form->passwordField($model,'password', array("class"=>'form__input', "placeholder"=>'Contraseña', "required"=>true)); ?>
              </div>
              <div class="form__section">
                <label class="form__label">
                  <?php echo $form->checkBox($model,'rememberMe', array('class'=>'form__check')); ?>Recordar mis datos
                </label>
              </div>
              <div class="form__section">
                <button type="submit" class="btn btn__long">Ingresar</button>
              </div>
            <?php $this->endWidget(); ?>
          </div>
        </div>
      </div>