<header class="content__header">
    <h1 class="header__title">Clientes</h1>
    <h3 class="page__description">Agregar un nuevo cliente al sistema</h3>
</header>
<!-- Page Heading End-->

<?php $this->renderPartial('_form', array(
			'modelUser'=>$modelUser,
			'modelClient'=>$modelClient,

			'departamentos'=>$departamentos,
		)); ?>