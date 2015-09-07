$(document).ready(function(){
	edit.pageLoad();
	edit.events();
});

edit = {
	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
			tinymce.init({
	            selector: "textarea",
	            theme: "modern",
	            plugins: [
	                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	                "searchreplace wordcount visualblocks visualchars code fullscreen",
	                "insertdatetime media nonbreaking save table contextmenu directionality",
	                "emoticons template paste textcolor colorpicker textpattern imagetools"
	            ],
	            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	            toolbar2: "print preview media | forecolor backcolor emoticons",
	            image_advtab: true,
	            templates: [
	                {title: 'Test template 1', content: 'Test 1'},
	                {title: 'Test template 2', content: 'Test 2'}
	            ]
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

					// Remove disabled button and add in cancel button
					$(document).find('#displayImagesTable tbody tr .cancel').addClass('hide');
					$(document).find('#displayImagesTable tbody tr .remove').removeClass('hide');

					$("#imageDiv").append(new_input);
					edit.reindex(); // reindex images
				}
			}
		});
	},
	events: function() {


        $(document).on('click','.view-image',function(){
         var image_url = $(this).parents('.thumbnail:first').find('.image-url').attr('src');
         $('#modal-image').attr('src',image_url);
         $('#task_image').modal('show');
        });

        $(document).on('click','.delete-image',function(){
        	$(this).parents('.existingImagesDiv').remove();
        });

		// Removes images directly from folder
		$(document).on('click', "#displayImagesTable tbody tr .remove", function () {
			var src = $(this).attr('imgSrc');
			var task_id = $("#task_id").val();
			var type = 'new_image';
			element = $(this).parents('tr:first');
			requests.remove_image(task_id, src, element, type);
			// remove input element from #imageDiv
			$("#imageDiv input").each(function(){
				if($(this).val() == src) {
					$(this).remove();
				}
			});
		});
		// Removes image from the saved database div
		$(".removeImage").click(function(){
			var task_id = $('#task_id').val();
			var src = $(this).parents('.thumbnail:first').find('img').attr('src');
			var type = 'old_image';
			element = $(this).parents('.existingImagesDiv:first');
			requests.remove_image(task_id, src, element, type);
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
			var image_src = $(this).val();
			$(this).attr('index',new_count).attr('name','files['+new_count+'][path]');
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
};

// Create input
function create_input(path) {
	return '<input class="images" name="" type="hidden" index="" value="'+path+'"/>';
}