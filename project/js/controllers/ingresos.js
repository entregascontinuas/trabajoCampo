jQuery(document).ready(function($) {
	$(document).on('blur', '#Vehiculos__placas', function(event) {
		event.preventDefault();
		$container = $('#Vehiculos__info');
		$placa = $(this);

		if($placa.val() != ''){
			$.showLoading();
			$.ajax({
				url: $placa.attr('data-load__info'),
				type: 'GET',
				dataType: 'json',
				data: {
					placa: $placa.val(),
					template: '//ingresos/_propietario_info',
				},
			})
			.done(function($data) {
				if($data.status == 'success'){
					$container.html($data.render);
					$('#RegistrosIngreso_vehiculo').val($data.vehiculo.id);
					$('#ingresos__go__add').css('display', 'none');
				}
				else
					$.clearAreaVehiculo();
			})
			.fail(function() {
				$.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
				$.clearAreaVehiculo();
			})
			.always(function() {
				$.hiddenLoading();
			});
		}
		else
			$.clearAreaVehiculo();
	});

	$(document).on('submit', '#ingresos-form', function(event) {
		event.preventDefault();

		$form = $(this);

		$vehiculo = $('#RegistrosIngreso_vehiculo').val();
		if($vehiculo == '')
			$.showNotify('Error', 'Se debe agregar las placas de un vehiculo registrado en el sistema.', 'error');
		else{
			$callback = function($data){
				if($data.status == 'success'){
					//$.modalMessage($data.title, $data.message, $data.status, true);
					$.showConfirm($data.message, $data.print, '', 'success');
					if($form.hasClass('success__clear-form')){
						$.clearAreaVehiculo();
						$.clearForm($form);
					}
				}
				else{
					$.showNotify($data.title, $data.message, $data.status);
				}
			}

			$.sendFormAjax($form, $callback);
		}
	});
});

$.clearAreaVehiculo = function(){
	$container.html('');
	$('#RegistrosIngreso_vehiculo').val('');
	$('#ingresos__go__add').css('display', 'block');
}

$changeStatus = function($data){
	$link.blur();
	if($data.status != 'error'){
		$tr = $link.parents('tr');
		$tr.find('.tag__status').html($data.tag);

		$tr.find('.status__active').each(function(index, el) {
			if($data.new == $(this).attr('data-status__active'))
				$(this).css('display', 'block');
			else
				$(this).css('display', 'none');
		});
	}
}