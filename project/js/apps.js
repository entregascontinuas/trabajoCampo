jQuery(document).ready(function($) {
    $('.input__mask').each(function(index, el) {
        $mask = $(this).attr('data-mask');
        $(this).mask($mask);
    });

    $('.table__datatable').each(function(index, el) {
        $(this).DataTable({
            "language":{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '.notifyjs-metro-base .notify__hidden', function() {
        $(this).trigger('notify-hide');
    });
});


$.reload = function(){
    $('html, body').animate({
        scrollTop: 0
    }, 500);
    setTimeout(function(){
        window.location.reload();
    }, 500);
}


$.showNotify = function($title, $text, $style, $position) {
    if($style == "error"){
        $icon = "fa fa-exclamation";
    }else if($style == "warning"){
        $icon = "fa fa-warning";
    }else if($style == "success"){
        $icon = "fa fa-check";
    }else if($style == "info"){
        $icon = "fa fa-question";
    }else{
        $icon = "fa fa-circle-o";
    }
    $.notify({
        title: $title,
        text: $text,
        image: "<i class='"+$icon+"'></i>"
    }, {
        style: 'metro',
        className: $style,
        globalPosition:$position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 8000,
        autoHide: true,
        clickToHide: true
    });
}
$.showConfirm = function($text, $link, $link__class, $style){
    $style || ( $style = 'warning' );

    if($style == "error"){
        $icon = "fa fa-exclamation";
    }else if($style == "warning"){
        $icon = "fa fa-warning";
    }else if($style == "success"){
        $icon = "fa fa-check";
    }else if($style == "info"){
        $icon = "fa fa-question";
    }else{
        $icon = "fa fa-circle-o";
    }

    $.notify({
        title: 'Esta seguro?',
        text: $text+'<div class="clearfix"></div><br><a href="'+$link+'" class="btn btn-sm btn-primary notify__hidden '+$link__class+'">Si</a> <a class="btn btn-sm btn-danger notify__hidden">No</a>',
        image: "<i class='"+$icon+"'></i>"
    }, {
        style: 'metro',
        className: $style,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 15000,
        autoHide: true,
        clickToHide: false
    });
}


$.showLoading = function(){
    $('body').css('overflow','hidden');
    $('.popup__loading').addClass('active');
}
$.hiddenLoading = function(){
    $('body').css('overflow','auto');
    $('.popup__loading').removeClass('active');
}


$.modalMessage = function($title, $text, $type, $html){
    swal({
        title: $title,
        text: $text,
        type: $type,
        html: $html
    });
}
$.modalConfirm = function($title, $text, $type, $action){
    swal({
        title: $title,
        text: $text,
        type: $type,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Estoy seguro!",
        closeOnConfirm: true
    }, $action);
}


$.isset = function($data){
    if(typeof $data == "undefined" || $data == null)
        return false
    else
        return true
}