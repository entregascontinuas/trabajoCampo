<div class="col-xs-12">
	<div class="widget">
		<div class="widget__header">
			<h2>Reporte Marcas de Vehiculos</h2>
		</div>
		<div class="widget__body padding">
			<div class="row center-xs">
				<div class="col-sm-6">
					<table class="table">
						<thead>
							<th>Nombre</th>
							<th>Total</th>
							<th>Porcentaje</th>
						</thead>
						<tbody>
							<?php foreach ($marcas as $key => $marca) { ?>
								<tr>
									<td><?php echo $marca['nombre']; ?></td>
									<td><?php echo $marca['total']; ?></td>
									<td><?php echo number_format((100*$marca['total']/$ingresos),2); ?>%</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6">
					<canvas id="chart__marcas" width="400" height="300"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>