jQuery(document).ready(function($) {
	$(document).on('click', '#change__password', function(event) {
		event.preventDefault();
		$('.hidden__change').css('display', 'none');
		$('#change__form').css('display', 'block');
	});

	$(document).on('submit', '#form__change', function(event) {
		event.preventDefault();

		$form = $(this);
		$passCurrent = $.trim($('#pass__current').val());
		$passNew = $.trim($('#pass__new').val());
		$pass2 = $.trim($('#pass__new2').val());

		if($passCurrent == '' || $passNew == '' || $pass2 != '')
			$.showNotify('Error', 'Debe completar todos los campos.', 'error');
		else if($passNew != $pass2)
			$.showNotify('Error', 'Las contraseñas no coinciden!!!', 'error');
		else{
			$callback = function($data){
				if($data.status == 'success'){
					if($form.hasClass('success__clear-form'))
						$.clearForm($form);
					$.reloadChangePass();
				}
				$.showNotify($data.title, $data.message, $data.status);
			}

			$.sendFormAjax($form, $callback);
		}
	});
});

$.reloadChangePass = function(){
	$('.hidden__change').css('display', 'block');
	$('#change__form').css('display', 'none');
}