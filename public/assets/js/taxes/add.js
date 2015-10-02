$(document).ready(function(){
	tadd.pageLoad();
	tadd.events();

});
tadd = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {
		$("#rate").priceFormat({
			'prefix':'',
			'thousandsSeparator':',',
			'centsLimit': 4,
			'allowNegative':true,
			'limit': 5
		}).keyup(function(){
			var rate = parseFloat($(this).val());
			if(rate > 1) {
				$(this).val('1.0000');
				$("#rateSpan").html('100');
			} else {
				$("#rateSpan").html((Math.round(rate * 10000) / 100));
			}
		});

	}
};


