<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <!-- Basic Styles -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/normalize.css" rel="stylesheet"/>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/flexboxgrid.min.css" rel="stylesheet"/>
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"/>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet"/>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/datatable/css/jquery.dataTables.min.css" rel="stylesheet"/>
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/notify/notify-metro.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/sweetalert/sweetalert.css" rel="stylesheet"/>

    
    <!-- Styles SiadCar -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet"/>
    
  </head>
  <body>
    <div id="wrapper">
      <?php $this->renderPartial('//layouts/_top-bar'); ?>
      <?php $this->renderPartial('//layouts/_side-menu'); ?>
      
      <section class="content__app">
        <div class="content">
          <?php echo $content; ?>
        </div>
      </section>
    </div>

    <div class="popup popup__loading">
      <div class="icon__loading"></div>
    </div>

    <!-- Basic Scripts -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-ui/jquery-ui.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/datatable/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/notify/notify.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/notify/notify-metro.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/ckeditor/config.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/chart/Chart.min.js"></script>
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery.maskedinput-1.2.2.js"></script>

    
    <!-- Scripts SiadCar -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/apps.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
  </body>
</html>