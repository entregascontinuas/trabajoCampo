<div class="page__error">
	<div class="row center-xs">
		<div class="col-sm-8 col-xs-12">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/crash__page.png" alt="Error">
		</div>
		<div class="col-sm-8 col-xs-12">
			<h1>Error <?php echo $code; ?></h1>
		</div>
		<div class="col-sm-8 col-xs-12">
			<p>
				<?php if($code == 403){
					echo "No tiene autorización para realizar esta accion, es posible que te hayan cancelado los permisos.";
				} else{
					echo "No fue posible encontrar la página solicitada, es posible que haya sido eliminada o que el enlace este fallando.";
				}?>
			</p>
		</div>
		<br>
		<div class="col-sm-8 col-xs-12">
			<p>Puedes volver al <a href="<?php echo Yii::app()->homeUrl; ?>">Inicio</a></p>
		</div>
	</div>
</div>