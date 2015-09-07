$(document).ready(function(){
	tasks.pageLoad();
	tasks.events();
});

tasks = {
	pageLoad: function() {
		$(window).resize(setClass);

	},
	events: function(){
		
		$("#nav-tasks a").click(function(e){ // Navigation inside panel group for tasks
			// set variables
			var href = $(this).attr('href');
			
			// set classes to change
			$("#nav-tasks li").removeClass('active');
			$(this).parents('li:first').addClass('active');

			// set subsequent div with correct # to show and hide the rest
			$('.tasks-item').addClass('hide');
			$(href).removeClass('hide');

			e.preventDefault(); // Disable default A tag functions
		});
	},
	requests: function() {

	}
};

var setClass = function() {
    if($(window).width() > 600) {
        $("#nav-tasks").removeClass('nav-pills').removeClass('nav-stacked');
    } else {
        $("#nav-tasks").addClass('nav-pills').addClass('nav-stacked');
    }
}