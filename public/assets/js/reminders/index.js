$(document).ready(function(){
	blank.pageLoad();
	blank.events();

});
blank = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});

	},
	events: function() {
		
		$('#reset-btn').click(function(){
			//RESET ERROR
			$('#email-error').addClass('hide');


			var email = $(".email").val();
			if (IsEmail(email) == true) {
				$('#reset-form').submit();
			} else {
				$('#email-error').removeClass('hide');
			}
		});
	}
}
request = {

};
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

