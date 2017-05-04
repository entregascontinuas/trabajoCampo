jQuery(document).ready(function($) {
    $('.show__collapse').hover(function() {
        $($(this).attr('data-collapse')).addClass('active');
    }, function() {
        $($(this).attr('data-collapse')).removeClass('active');
    });
    $('.show__collapse').on('click', function(event) {
        $(this).hover();
    });

    $('.has__submenu .item').on('click', function(event) {
        event.preventDefault();

        $menuItem = $(this).parent();
        if($menuItem.hasClass('submenuact')){
            $menuItem.removeClass('submenuact');
            $menuItem.find('.submenu').slideUp('slow');
        }
        else{
            $('.has__submenu.submenuact')
                .removeClass('submenuact')
                .find('.submenu').slideUp('slow');

            $menuItem.addClass('submenuact');
            $menuItem.find('.submenu').slideDown('slow');
        }
    });

    $(document).on('keypress', '.input__number', function(event){
        if(!((event.which <= 57 && event.which >= 48) || event.which == 8))
            event.preventDefault();
    });

    $('.select__depend').each(function(index, el) {
        $selectDepend = $(this);
        $select = $($selectDepend.attr('data-select__depend'));

        $select.on('change', function(event) {
            event.preventDefault();
            $.loadSelectAjax($select, $selectDepend);
        });

        if($selectDepend.val() != '')
            $select.find('option[value='+$selectDepend.attr('data-select__option')+']').prop('selected', 'true');
    });

    $(document).on('click', '.run__print__page', function(event) {
        event.preventDefault();
        $.printPage();
    });



    $(document).on('click', '*[data-modal]', function(event) {
        event.preventDefault();
        $link = $(this);
        if($(this).attr('data-modal') == 'logout-modal'){
            $.modalConfirm(
                '¿Cerrar Sesión?',
                '¿Seguro que desea cerrar la sesión de su sistema SIADCAR?',
                'warning',
                function(){
                    window.location = $link.attr('href');
                }
            );
        }
    });

    $(document).on('click', '.link__ajax', function(event) {
        event.preventDefault();
        $link = $(this);
        $callback = ($link.is('[data-callback]'))?(window[$link.attr('data-callback')]):(function(){});
        $.goLinkAjax($link, $callback);
    });

    $(document).on('click', '.link__confirm', function(event) {
        event.preventDefault();
        $('.notifyjs-metro-base .notify__hidden').each(function(index, el) {
            $(this).trigger('notify-hide');
        });

        $link = $(this);
        $('.notify__link__active').removeClass('notify__link__active');
        $link.addClass('notify__link__active');

        $.showConfirm($link.attr('data-cofirm__text'), $link.attr('href'), (($link.is('[data-confirm__class]'))?$link.attr('data-confirm__class'):''));
    });

    $(document).on('click', '.link__item-table__delete', function(event) {
        event.preventDefault();
        $link = $(this);
        $callback = function($data){
            if($data.status == 'success'){
                $linkInit = $('.notify__link__active');
                $dataTable = $linkInit.parents('table');

                $linkInit.parents('tr').addClass('item__remove');
                $dataTable.DataTable().row('.item__remove').remove().draw(false);
            }

            $.showNotify($data.title, $data.message, $data.status);
        }
        $.goLinkAjax($link, $callback);
    });
});



$.sendFormAjax = function($form, $callback){
    $.showLoading();

    $form.find('.form-ajax__control__disable').prop("disabled", false);

    $formHasImage = ($form.is('[enctype]') && $form.attr('enctype') == 'multipart/form-data');
    $data = ($formHasImage)?(new FormData($form[0])):$form.serialize();
    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        dataType: 'json',
        data: $data,
        processData: ($formHasImage)?false:true,
        contentType: ($formHasImage)?false:'application/x-www-form-urlencoded; charset=UTF-8',
    })
    .done($callback)
    .fail(function() {
        $.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
    })
    .always(function() {
        $form.find('.form-ajax__control__disable').prop("disabled", true);
        $.hiddenLoading();
    });
}
$.clearForm = function($form){
    $form[0].reset();
    $form.find('select').each(function(index, el) {
        $option = $(this).find('option:first-child').val();
        $(this).val($option);
        $(this).change();
    });

    $form.find('.ckeditor').each(function(index, el) {
        CKEDITOR.instances[$(this).attr('id')].setData('');
    });
}

$.goLinkAjax = function($link, $callback){
    $.showLoading();

    $.ajax({
        url: $link.attr('href'),
        type: 'GET',
        dataType: 'json',
        data: {},
    })
    .done($callback)
    .fail(function() {
        $.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
    })
    .always(function() {
        $.hiddenLoading();
    });
    
}

$.loadSelectAjax = function($select, $selectDepend){
    if($select.val() != ''){
        $.showLoading();

        $.ajax({
            url: $select.attr('data-select__load'),
            type: 'GET',
            dataType: 'json',
            data: {id: $select.val()},
        })
        .done(function($data) {
            if($data.status){
                $selectDepend.html($data.items);
                $selectDepend.prop('disabled', false);
            }
        })
        .fail(function() {
            $.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
        })
        .always(function() {
            $.hiddenLoading();
        });
    }
    else{
        $selectDepend.html('<option value="">-- Seleccione una opción --</option>');
        $selectDepend.prop('disabled', true);
    }    
}

$.printPage = function(){
    window.print();
}