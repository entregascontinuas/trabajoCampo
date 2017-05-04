<div class="row">
	<div class="col-sm-6">
		<div class="row">
			<div class="col-xs-12">
				<h2>Vehiculo</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<p><strong>Tipo: </strong><?php echo $vehiculo->tipo0->nombre; ?></p>
			</div>
			<div class="col-sm-6">
				<p><strong>Marca: </strong><?php echo $vehiculo->marca0->nombre; ?></p>
			</div>
			<div class="col-sm-6">
				<p><strong>Referncia: </strong><?php echo $vehiculo->referencia; ?></p>
			</div>
			<div class="col-sm-6">
				<p><strong>Modelo: </strong><?php echo $vehiculo->modelo; ?></p>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="row">
			<div class="col-xs-12">
				<h2>Propietario</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<p><strong>Nombres: </strong><?php echo $vehiculo->propietario0->usuario0->nombres; ?></p>
			</div>
			<div class="col-sm-6">
				<p><strong>Apellidos: </strong><?php echo $vehiculo->propietario0->usuario0->apellidos; ?></p>
			</div>
			<div class="col-sm-6">
				<p><strong>Identificación: </strong><?php echo $vehiculo->propietario0->usuario0->cedula; ?></p>
			</div>
		</div>
	</div>
</div>