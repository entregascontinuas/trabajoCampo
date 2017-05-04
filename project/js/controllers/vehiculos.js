jQuery(document).ready(function($) {
	if($('#Clientes_new').val() != 0){
		$('.vehiculos__user__disabled').prop('disabled', true);
	}

	$(document).on('blur', '#Usuarios_cedula', function(event) {
		event.preventDefault();

		$cedula = $(this);

		if($cedula.val() != ''){
			$.showLoading();
			$.ajax({
				url: $cedula.attr('data-ajax__link'),
				type: 'GET',
				dataType: 'json',
				data: {cedula: $cedula.val()},
			})
			.done(function($data) {
				if($data.status == 'success'){
					$('#Usuarios_nombres').val($data.client.nombres);
					$('#Usuarios_apellidos').val($data.client.apellidos);
					$('#Clientes_direccion').val($data.client.direccion);
					$('#Usuarios_email').val($data.client.email);

					$('#Clientes_departamento').find('option[value="'+$data.client.ciudad.departamento.id+'"]').prop('selected', true);
					$('#Clientes_ciudad').html('<option value="'+$data.client.ciudad.id+'">'+$data.client.ciudad.nombre+'</option>');

					$('#Clientes_new').val($data.client.id);

					$('.vehiculos__user__disabled').prop('disabled', true);
				}
				else
					$.clearFormClient();
			})
			.fail(function() {
				$.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
			})
			.always(function() {
				$.hiddenLoading();
			});
			
		}
		else
			$.clearFormClient();
	});

	$(document).on('submit', '#vehiculos-form', function(event) {
		event.preventDefault();

		$form = $(this);

		$callback = function($data){
			if($data.status == 'success'){
				$.modalMessage($data.title, $data.message, $data.status, true);
				if($form.hasClass('success__clear-form')){
					$.clearFormClient();
					$.clearForm($form);
				}
			}
			else
				$.showNotify($data.title, $data.message, $data.status);
		}

		$.sendFormAjax($form, $callback);
	});
});

$.clearFormClient = function(){
	$('.vehiculos__user__disabled').val('');
	$('#Clientes_departamento').find('option[value=""]').prop('selected', true);
	$('#Clientes_departamento').change();

	$('#Clientes_new').val(0);

	$('.vehiculos__user__disabled').prop('disabled', false);
}