<div class="col-xs-12">
	<div class="widget">
		<div class="widget__header">
			<h2>Reporte Ingresos Por Dias</h2>
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
							<?php foreach ($dias['dias'] as $key => $dia) { ?>
								<tr>
									<td><?php echo $dia['nombre']; ?></td>
									<td><?php echo $dia['total']; ?></td>
									<td><?php echo number_format((100*$dia['total']/$ingresos),2); ?>%</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6">
					<canvas id="chart__dias" width="400" height="250"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>