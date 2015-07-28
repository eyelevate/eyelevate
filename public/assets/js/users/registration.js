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
		$('#submit-btn').click(function(){
			var reg_form = $('#reg-form').serialize();
			request.form_validate(reg_form);
		});
	}
}
request = {
	form_validate: function(reg_form) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/users/validate',
			{
				"_token": token,
				"reg_form":reg_form
			},
			function(result){
				var status = result.status;
				var call_back = result.validation_callback;
				reset_errors();


				view_errors(call_back);
				switch(status) {
					case 200: // Approved
					break;

					default:
					break;
				}
			}
			);
	}
};
function reset_errors()
{
	$('.error').addClass('hide');
}
function view_errors(data)
{
	var error_status = false;
	$.each(data, function (i, j) {
		var message = null;
 		switch(i){
 			case "first_name":
 			if (j['status'] == 400) {
 				error_status = true;
 				 message = j['message'];
 				 $('.error-first_name').removeClass('hide').html(message);
 				}
 			break;
 			case "last_name":
 			if (j['status'] == 400) {
 				error_status = true;
 				 message = j['message'];
 				 $('.error-last_name').removeClass('hide').html(message);
 				}
 			break;
 			case "age":
	 			if (j['status'] == 400) {
	 				error_status = true;
	 				message = j['message'];
	 				$('.error-age').removeClass('hide').html(message);
	 			};
 			break;
 			case "email":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.error-email').removeClass('hide').html(message);
 			}
 			break;
 			case "username":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.error-username').removeClass('hide').html(message);
 			}
 			break;
 			case "password":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.error-password').removeClass('hide').html(message);
 			}
 			break;
 			case "password_again":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.error-password-again').removeClass('hide').html(message);
 			}
 			break;
 		}

	});
 		//IF THERE WAS NO ERRORS SUBMIT THE FORM
 		if (error_status == false) {
 			$('#reg-form').submit()
 		};

}