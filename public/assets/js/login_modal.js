$(document).ready(function(){
	login_modal.pageLoad();
	login_modal.events();

});
login_modal = {
	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {
		$(document).find('.login-btn').click(function(){
			$('#login-form').submit();
		});
	}
}
request = {

};

