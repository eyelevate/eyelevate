$(document).ready(function(){
	home.pageLoad();
	home.events();

});
home = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});

		$(window).bind("load", function() {  
			load_background_video();
			/**
		   * Video element
		   * @type {HTMLElement}
		   */
		  var video = document.getElementById("video-bg");
		  var img = $('#video-wrap');
		  // *
		  //  * Check if video can play, and play it
		  video.addEventListener( "canplay", function() {
		    //     img.animate({opacity: 0}, 1000, 'linear', function() {
		    //     img.css({visibility: 'hidden'});
		        video.play();
		    // });
		  });
		}); 
	},
	events: function() {


	}
}
request = {

};

function load_background_video()
{
	var html ='<video  class="la_video" preload="auto" loop="true" id="video-bg" muted>'+
				// '<source src="assets/main-background/video/ElectricBulb.webm" type="video/webm">'+
				'<source src="assets/main-background/video/ElectricBulb-fade.mp4" type="video/mp4">'+
				'</video>';

     $('#video-wrap').append(html);
 
}
