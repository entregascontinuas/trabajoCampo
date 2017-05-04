<header class="content__header">
    <h1 class="header__title">Usuarios</h1>
    <h3 class="page__description">Editar usuario del sistema</h3>
</header>
<!-- Page Heading End-->

<?php $this->renderPartial('_form', array(
			'model'=>$model,
			
			'rols'=>$rols,
			'permissions'=>$permissions,

			'rolsList'=>$rolsList,
			)); ?>