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
    }
}
request = {

};

