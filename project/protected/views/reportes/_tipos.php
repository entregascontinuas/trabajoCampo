<div class="col-sm-6">
	<div class="widget">
		<div class="widget__header">
			<h2>Reporte Tipos de Ingresos</h2>
		</div>
		<div class="widget__body padding">
			<div class="row center-xs">
				<div class="col-xs-12">
					<canvas id="chart__tipos" width="400" height="250"></canvas>
				</div>
				<div class="col-xs-12">
					<table class="table">
						<thead>
							<th>Nombre</th>
							<th>Total</th>
							<th>Porcentaje</th>
						</thead>
						<tbody>
							<?php foreach ($tipos as $key => $tipo) { ?>
								<tr>
									<td><?php echo $tipo['nombre']; ?></td>
									<td><?php echo $tipo['total']; ?></td>
									<td><?php echo number_format((100*$tipo['total']/$ingresos),2); ?>%</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>