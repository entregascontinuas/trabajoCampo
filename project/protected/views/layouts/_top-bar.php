      <div id="top-bar">
        <div class="row between-xs middle-xs">
          <div class="top-bar__left container-content"><a href="<?php echo Yii::app()->homeUrl; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo__horizontal.png" alt="siadcar"/></a></div>
          <div class="top-bar__right container-content">
            <ul class="row middle-xs">
              <li data-collapse="#collapse__go__profile" class="user__info show__collapse">
                <div class="row middle-xs"><span style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/users/<?php echo Yii::app()->user->getState('_imageUser'); ?>)" alt="<?php echo Yii::app()->user->getState('_nameUser'); ?>" class="user__image circle__image"></span>
                  <p class="user__name"><?php echo Yii::app()->user->getState('_nameUser'); ?> <?php echo Yii::app()->user->getState('_lastNameUser'); ?></p>
                </div>
                <ul id="collapse__go__profile" class="collapse">
                  <div class="user__zone"><span style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/users/<?php echo Yii::app()->user->getState('_imageUser'); ?>)" alt="profile" class="user__image circle__image"></span>
                    <p class="user__name"><?php echo Yii::app()->user->getState('_nameUser'); ?> <?php echo Yii::app()->user->getState('_lastNameUser'); ?></p>
                    <?php $userCurrent = Usuarios::model()->findByPk(Yii::app()->user->getState('_idUser')); ?>
                    <?php $date = new DateTime($userCurrent->fecha_ultima_sesion); ?>
                    <p class="user__date__add"><?php echo date_format($date, 'd F Y'); ?></p>
                  </div>
                  <div class="links row middle-xs around-xs">
                    <a href="<?php echo Yii::app()->createUrl('profile/view') ?>" class="btn">Perfil</a>
                    <a href="<?php echo Yii::app()->createUrl('logout/') ?>" class="btn" data-modal="logout-modal">Salir</a>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>