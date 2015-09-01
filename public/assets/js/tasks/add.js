$(document).ready(function(){
	add.events();
});

add = {

	events: function() {
		$('#fileupload').fileupload({
			// Uncomment the following to send cross-domain cookies:
			//xhrFields: {withCredentials: true},
			url: '/admins/tasks/upload'
		});
	}
};