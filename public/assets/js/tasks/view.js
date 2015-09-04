$(document).ready(function(){
    tasks_view.pageLoad();
    tasks_view.events();
});

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});

		tinymce.init({
            selector: "#comment_textarea",
            body_id: "editor-body",
            elementpath: false,
            max_height: 500,
            height : 125,
            toolbar: ["undo redo | bold italic | bullist | numlist"],
            menubar: false,
            statusbar: false,
            resize: false,
            mode: "textareas",
            preview_styles: false,
            
        });
    },
    events: function() {

    }
};

