      <div class="side-menu">
        <div class="container-content">
          <div class="user__zone">
            <div style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/users/<?php echo Yii::app()->user->getState('_imageUser'); ?>)" class="user__image circle__image"></div>
            <p class="user__name"><?php echo Yii::app()->user->getState('_nameUser'); ?> <?php echo Yii::app()->user->getState('_lastNameUser'); ?></p>
            <?php $rolUser = RolsUsuario::model()->findByPk(Yii::app()->user->getState('_rolUser')); ?>
            <p class="user__rol"><?php echo $rolUser->nombre; ?></p>
          </div>
        </div>
        <?php $this->renderPartial('//layouts/__menu'); ?>
      </div>