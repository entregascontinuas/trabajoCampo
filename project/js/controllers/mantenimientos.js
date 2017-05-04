jQuery(document).ready(function($) {
	$(document).on('submit', '#mantenimientos-form', function(event) {
		event.preventDefault();

		$form = $(this);

		$callback = function($data){
			if($data.status == 'success'){
				if($form.hasClass('success__clear-form')){
					$.clearForm($form);
				}
			}

			$.showNotify($data.title, $data.message, $data.status);
		}

		$.sendFormAjax($form, $callback);
	});
});