$(document).ready(function(){
	add.pageLoad();
	add.events();
});

add = {
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
					// Remove disabled button and add in cancel button
					$(document).find('#displayImagesTable tbody tr .cancel').addClass('hide');
					$(document).find('#displayImagesTable tbody tr .remove').removeClass('hide');
					add.reindex();
				}
			}
		});
	},
	events: function() {
		// Removes images directly from folder
		$(document).on('click', "#displayImagesTable tbody tr .remove", function () {
			var src = $(this).attr('imgSrc');
			var type = 'new_image';
			element = $(this).parents('tr:first');
			requests.remove_image(null, src, element, type);
			// remove input element from #imageDiv
			$("#imageDiv input").each(function(){
				if($(this).val() == src) {
					$(this).remove();
				}
			});
		});
	},
	reindex: function() {

		// next reindex the new incoming images
		$("#imageDiv input").each(function(e) {
			var image_src = $(this).val();
			$(this).attr('index',e).attr('name','files['+e+'][path]');
			$(document).find('#displayImagesTable tbody tr').eq(e).find('.remove').attr('imgSrc',image_src);
		});

	}

};

requests = {
	remove_image: function(task_id, src, element, type) {
		$.post("/admins/tasks/remove",
		{
			'id' : task_id,
			'src' : src,
			'type': type
		}, function(e){
			if(e.success == true) {
				element.remove();
				edit.reindex();
			} 
		});
	}

}

// Create input
function create_input(path) {
	var count = $(document).find('.images').length;
	return '<input class="images" name="files['+count+'][path]" type="hidden" value="'+path+'"/>';
}