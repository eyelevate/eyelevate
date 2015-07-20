$(document).ready(function(){
	registration.pageLoad();
	registration.events();

});
registration = {
	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {




	}
}
request = {

};

