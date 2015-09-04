$(document).ready(function(){
	edit.pageLoad();
	edit.events();
});

edit = {
	pageLoad: function() {
		$('#fileupload').fileupload({
			// Uncomment the following to send cross-domain cookies:
			//xhrFields: {withCredentials: true},
			url: '/admins/tasks/upload',
			dataType:'json',
			autoUpload: true,

			done: function(e, data){
				r = data.result;
				if(r.success === true) {
					var path = r.path;
					var new_input = create_input(path);
					$("#imageDiv").append(new_input);
					// hide cancel button
				}
			}
		});
	},
	events: function() {
	}
};

// Create input
function create_input(path) {
	var count = $(document).find('.images').length;
	return '<input class="images" name="files['+count+'][path]" type="hidden" value="'+path+'"/>';
}