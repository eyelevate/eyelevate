$(document).ready(function(){
    tasks_view.pageLoad();
    tasks_view.events();

});
tasks_view = {

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
                    $("#imageDiv").append(new_input);
                    // Remove disabled button and add in cancel button
                    $(document).find('#displayImagesTable tbody tr .cancel').addClass('hide');
                    $(document).find('#displayImagesTable tbody tr .remove').removeClass('hide');
                    // add.reindex();
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

        $(document).on('click','#task-completed',function(){
            $('.competed-form').submit();
        });
        $(document).on('click','#task-in-process',function(){
            $('.in-process-form').submit();
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
request = {

};

// Create input
function create_input(path) {
    var count = $(document).find('.images').length;
    return '<input class="images" name="files['+count+'][path]" type="hidden" value="'+path+'"/>';
}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);