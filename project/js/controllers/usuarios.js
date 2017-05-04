jQuery(document).ready(function($) {
	$(document).on('change', '#Usuarios_rol', function(event) {
		event.preventDefault();
		
		$value = $(this).val();
		$('.check__permissions').find('input[type="checkbox"]').prop("checked", "");

		if($value != ''){
			$.showLoading();
			$.ajax({
				url: $('.check__permissions').attr('data-get-permissions'),
				type: 'get',
				dataType: 'json',
				data: {rol: $value},
			})
			.done(function($data) {
				$('.check__permissions').find('input[type="checkbox"]').each(function(index, el) {
					if($data.indexOf(parseInt($(this).val())) >= 0)
						$(this).prop({
							'checked':"checked",
							'disabled':'disabled'
						});
					else
						$(this).prop({
							'disabled':''
						});
				});
			})
			.fail(function() {
				$.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
			})
			.always(function() {
				$.hiddenLoading();
			});
		}
		else
			$('.check__permissions').find('input[type="checkbox"]').prop("disabled", "disabled");
	});


	$(document).on('submit', '#usuarios-form', function(event) {
		event.preventDefault();

		$form = $(this);

		$callback = function($data){
			if($data.status == 'success'){
				$.modalMessage($data.title, $data.message, $data.status, true);
				if($form.hasClass('success__clear-form'))
					$.clearForm($form);
			}
			else{
				$.showNotify($data.title, $data.message, $data.status);
			}
		}

		$.sendFormAjax($form, $callback);
	});

	$(document).on('click', '.link__reset__pass', function(event) {
		event.preventDefault();
		$link = $(this);
		$callback = function($data){
			if($data.status == 'success'){
				$.modalMessage($data.title, $data.message, $data.status, true);
			}
			else{
				$.showNotify($data.title, $data.message, $data.status);
			}
		}
		$.goLinkAjax($link, $callback);
	});
});