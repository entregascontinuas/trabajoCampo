<header class="content__header">
    <h1 class="header__title">Ingresos de Vehículos</h1>
    <h3 class="page__description">Registrar el ingreso de un vehículo</h3>
</header>
<!-- Page Heading End-->

<?php $this->renderPartial('_form', array(
			'model'=>$model,

			'tipos'=>$tipos,
			'elementos'=>$elementos
		)); ?>