jQuery(document).ready(function($) {
	$('#login-form').on('submit', function(event) {
		event.preventDefault();
		$.showLoading();

		$form = $(this);

		$.ajax({
			url: $form.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: $form.serialize(),
		})
		.done(function($data) {
			$.showNotify($data.title, $data.message, $data.status);
			if($data.status == 'success')
				$.reload();
		})
		.fail(function() {
			$.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
		})
		.always(function() {
			$.hiddenLoading();
		});
	});
});