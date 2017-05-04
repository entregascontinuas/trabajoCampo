<header class="content__header">
    <h1 class="header__title">Reportes</h1>
    <h3 class="page__description">Generar reporte</h3>
</header>
<!-- Page Heading End-->

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Rango de Tiempo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row center-xs">
					<div class="col-sm-4">
						<p><strong>Fecha desde:</strong></p>
						<p><input type="text" id="date_from" readonly></p>
					</div>
					<div class="col-sm-4">
						<p><strong>Fecha hasta:</strong></p>
						<p><input type="text" id="date_until" readonly></p>
					</div>
					<div class="col-xs-12">
						<button class="btn" id="generar">Generar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="display: none;" id="reports__results" data-load__result="<?php echo $this->createUrl('reportes/generar'); ?>">
	<div class="row"></div>
</div>