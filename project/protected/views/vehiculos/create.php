<header class="content__header">
    <h1 class="header__title">Vehículos</h1>
    <h3 class="page__description">Agregar un nuevo vehículo al sistema</h3>
</header>
<!-- Page Heading End-->

<?php $this->renderPartial('_form', array(
			'model'=>$model,

			'modelUser'=>$modelUser,
			'modelClient'=>$modelClient,

			'tipos'=>$tipos,
			'marcas'=>$marcas,
			'combustibles'=>$combustibles,

			'departamentos'=>$departamentos,
		)); ?>