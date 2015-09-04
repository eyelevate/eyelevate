$(document).ready(function(){
	edit.pageLoad();
	edit.events();
});

edit = {
	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
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
					edit.reindex(); // reindex images
					// hide cancel button
				}
			}
		});
	},
	events: function() {
		$(".removeImage").click(function(){
			var task_id = $('#task_id').val();
			var src = $(this).parents('.thumbnail:first').find('img').attr('src');
			element = $(this).parents('.existingImagesDiv:first');
			requests.remove_image(task_id, src, element);
		});
	},
	reindex: function() {
		// first reindex preexisting images that are saved in the db
		var old_length = $('.existingImagesDiv .oldImages').length;
		if(old_length > 0){
			// first reindex the old images
			$(".existingImagesDiv .oldImages").each(function(e){
				$(this).attr('index',e).attr('name','files['+e+'][path]');
			});
		}
		// next reindex the new incoming images
		$("#imageDiv input").each(function(e) {
			var new_count = old_length + e;
			$(this).attr('index',new_count).attr('name','files['+new_count+'][path]');
		});

	}
};

requests = {
	remove_image: function(task_id, src, element) {
		$.post("/admins/tasks/remove",
		{
			'id' : task_id,
			'src' : src
		}, function(e){
			if(e.success == true) {
				element.remove();
				edit.reindex();
			} 
		});
	}
};

// Create input
function create_input(path) {
	return '<input class="images" name="" type="hidden" index="" value="'+path+'"/>';
}