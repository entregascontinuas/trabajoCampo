$arrayColors = [ '#186999', '#8EFFEC', '#FFD4CD', 'rgba(67, 89, 102, 1)', '#CC5D60', '#477F76', '#B29F5A', '#3A9943', '#186999',
    '#8EFFEC', '#FFD4CD', 'rgba(67, 89, 102, 1)', '#CC5D60', '#477F76', '#B29F5A', '#3A9943'
];

jQuery(document).ready(function($) {
	var dateFormat = "dd/mm/yy",
	from = $( "#date_from" )
        .datepicker({
        	maxDate: "-1M",
        	dateFormat: dateFormat
        })
        .on( "change", function() {
        	to.datepicker( "option", "minDate", getDate( this ) );
        }),
	to = $( "#date_until" ).datepicker({
			dateFormat: dateFormat
		})
      	.on( "change", function() {
        	from.datepicker( "option", "maxDate", getDate( this ) );
	});
 
    function getDate( element ) {
		var date;
		try {
        	date = $.datepicker.parseDate( dateFormat, element.value );
		} catch( error ) {
        	date = null;
      	}
 
      	return date;
    }


    $('#generar').on('click', function(event) {
    	event.preventDefault();

    	$from = $( "#date_from" ).val();
    	$to = $( "#date_until" ).val();
    	if($from != '' && $to != ''){
    		$.showLoading();
	    	$container = $('#reports__results');
	    	$containerResult = $('#reports__results > .row');
	    	$containerResult.html('');
	    	$container.css('display', 'block');

	    	$.ajax({
	    		url: $container.attr('data-load__result'),
	    		type: 'GET',
	    		dataType: 'json',
	    		data: {
	    			from: $from,
	    			to: $to
	    		},
	    	})
	    	.done(function($data) {
	    		console.log($data);
	    		if($data.error == 'success'){
	    			if($data.report.ingresos > 0){
	    				$containerResult.html($data.report.ingresos_dias.template);
	    				$chartDias = document.getElementById("chart__dias");
	    				$.drawChartBar($chartDias, $.dataChart($data.report.ingresos_dias.dias));

	    				$containerResult.append($data.report.propietario_ciudad.template);
	    				$chartCiudades = document.getElementById("chart__ciudades");
	    				$.drawChartPie($chartCiudades, $.dataChart($data.report.propietario_ciudad.ciudades));

	    				$containerResult.append($data.report.tipo.template);
	    				$chartTipos = document.getElementById("chart__tipos");
	    				$.drawChartPie($chartTipos, $.dataChart($data.report.tipo.tipos));

	    				$containerResult.append($data.report.vehiculos_combustible.template);
	    				$chartCombustibles = document.getElementById("chart__combustibles");
	    				$.drawChartPie($chartCombustibles, $.dataChart($data.report.vehiculos_combustible.tipos));

	    				$containerResult.append($data.report.vehiculos_tipo.template);
	    				$chartVehiculos = document.getElementById("chart__vehiculos");
	    				$.drawChartBar($chartVehiculos, $.dataChart($data.report.vehiculos_tipo.tipos));

	    				$containerResult.append($data.report.vehiculos_marca.template);
	    				$chartMarcas = document.getElementById("chart__marcas");
	    				$.drawChartBar($chartMarcas, $.dataChart($data.report.vehiculos_marca.marcas));

	    				$container.css('display', 'block');
	    			}
	    			else
	    				$containerResult.append($('<p>', {text: 'No se realizaron ingresos en este rango de tiempo.'}));
	    		}
	    	})
			.fail(function() {
				$.showNotify('Error', 'Ocurrio un error durante la conexión con el servidor. Intente mas tarde!!!', 'error');
			})
			.always(function() {
				$.hiddenLoading();
			});
    	}
    });
});

$.dataChart = function($object){
	$labels = [];
	$data = [];

	$.each($object, function(index, val) {
		$labels.push(val.nombre);
		$data.push(val.total);
	});

	return [$labels,$data];
}

$.drawChartBar = function($canvas, $data){
	var myChart = new Chart($canvas, {
	    type: 'bar',
	    data: {
	        labels: $data[0],
	        datasets: [{
	            label: '# de Ingresos',
	            data: $data[1],
	            backgroundColor: $arrayColors,
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
}
$.drawChartPie = function($canvas, $data){
	var myPieChart = new Chart($canvas, {
	    type: 'pie',
	    data: {
		    labels: $data[0],
		    datasets: [
		        {
		            data: $data[1],
		            backgroundColor: $arrayColors
		        }
		    ]
		}
	});
}