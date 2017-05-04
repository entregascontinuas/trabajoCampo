<header class="content__header">
    <h1 class="header__title">Registros de Mantenimientos [<?php echo $ingreso->vehiculo0->placas; ?>]</h1>
    <h3 class="page__description">Modificar registro de mantenimiento de un vehículo</h3>
</header>
<!-- Page Heading End-->

<?php $this->renderPartial('//mantenimientos/_form', array(
			'ingreso'=>$ingreso,
			'model'=>$model,

			'tipos'=>$tipos,
			'mecanicos'=>$mecanicos,
		)); ?>