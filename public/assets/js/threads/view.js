$(document).ready(function(){
	results.pageLoad();
	results.events();

});
results = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});


		/*==================================================
		=                   MOBILE JQUERY                  =
		==================================================*/
		$(document).ready(function(){
		    $("a").each(function(){
		          $(this).attr("rel","external");
		    });
		}); 
		// (or presumably as submitted by @Pnct)
		$.mobile.loading().remove();
		/*==================================================
		=                   MOBILE JQUERY                  =
		==================================================*/


	var popupTemplate='<li class="spam-popup">Report as spam</li>';
	$('.popbutton').popover({
	    animation:true, 
	    content:popupTemplate, 
	    html:true
	});

	},
	events: function() {

		//WANT TO REPLY
		$('.show-quote').click(function(){
			// //DELETE ALL OTHER REPLY BOXES
			// $(document).find('.reply-media').remove();
			var state = parseInt($('#left-top-container').attr('state'));
			if (state == 0) {//CLOSE
				var quoted_username = $(this).parents('.thread-single').find('.quoter-username').text();
				$('#replace-quoter-name').text(' '+quoted_username);
				var _this_reply = parseInt($(this).parents('.panel-parent').attr('this_reply'));
				right_box_expende(_this_reply);
			} else {
				// right_box_compress();
				// close_quote_textarea();
			}
		});

		//HIDE RIGHT BOX
		$('#top-left-side').click(function(){
			var state = parseInt($('#left-top-container').attr('state'));
			if (state == 1) {//OPEN
				right_box_compress();
			}
		});

		$('.quote-btnn').click(function(){
			toogle_this($(this));
		});
		$('.quote-cancel').click(function(){
			toogle_this($('.quote-btnn'));
		});
		//REPLY CANCEL BTN WAS CLICKED
		$(document).on('click','.left-btn',function(){
				right_box_compress();
				$(this).parents('.dialogbox-container:first').find('.reply-media:first').remove();
		});

		//FLAG UP CLICKED
		$(document).on('click','.thumb-up',function(){

		});
		//FLAG DOWN CLICKED
		$(document).on('click','.thumb-down',function(){

		});
		//SPAM FLAG CLICKED
		$(document).on('click','.spam-popup',function(){

		});
		//Reply FLAG CLICKED
		$(document).on('click','.reply-btn',function(){
		
		});

		//EYE LIKE
		$(document).on('click','.eye-like',function(){
			var this_reply = $(this).parents('.panel-parent:first').attr('this_reply');
			var this_thread = $(this).parents('.panel-parent:first').attr('this_thread');
			request.submit_like(this_reply,this_thread,$(this));
		});
		//DONT LIKE
		$(document).on('click','.dont-like',function(){
			var this_reply = $(this).parents('.panel-parent:first').attr('this_reply');
			var this_thread = $(this).parents('.panel-parent:first').attr('this_thread');
			request.submit_dislike(this_reply,this_thread,$(this));
		});
		//FLAG IT
		$(document).on('click','.flag-it',function(){
			var this_reply = $(this).parents('.panel-parent:first').attr('this_reply');
			var this_thread = $(this).parents('.panel-parent:first').attr('this_thread');
			request.submit_flag(this_reply,this_thread,$(this));
		});
		//POST A REPLY
		$(document).on('click','#post-answer',function(){
			var this_text = $('#answer_text').val();
			var this_thread = $(this).attr('this-thread');
			request.post_answer(this_text,this_thread);
		});

		//quote-quote
		$(document).on('click','#quote-reply-btn',function(){
			//GET TEXT
			var this_text = $('#quote_text').val();
			//GET QUOTE
			var this_reply = $(this).parents('.inner').attr('this-reply');
			// GET THREAD
			var this_thread = $(this).parents('.inner').attr('this-thread'); 
			if (true) {

			};
			if (!$.isBlank(this_text)) {
				request.post_quote(this_text,this_reply,this_thread);
			}
		});

		//MORE CLICKED
		$(document).on('click','.more',function(){
			var current_height = parseInt($(this).parents('.right-data:first').css('height'));
			var expended = parseInt($(this).parents('.right-data:first').attr('expended'));
			// EXPENDED 0 = CLOSE, 1 = OPEN
			if (expended == 0) {

				//CHANGE THE EXPENDED TO OPEN
				$(this).parents('.right-data:first').attr('expended','1');
				$(this).parents('.right-data:first').css('height','100%');
				// CHANGE THE ARROW 
				$(this).removeClass('glyphicon-chevron-down')
						.addClass('glyphicon-chevron-up');

				//BRING THE GLYPHICON TO BOTTOM
				$(this).removeClass('icon-top').addClass('icon-bottom');
			} else {

				// CHANGE THE EXPENDED TO CLOSE
				$(this).parents('.right-data:first').attr('expended','0');
				$(this).parents('.right-data:first').css('height','105px');
				// CHANGE THE ARROW
				$(this).removeClass('glyphicon-chevron-up')
						.addClass('glyphicon-chevron-down');

				//BRING THE GLYPHICON TO top	
				$(this).removeClass('icon-bottom').addClass('icon-top');
			}
		});

		/*==================================================
		=                   MOBILE SWIPE                   =
		==================================================*/
		$(document).on('swipeleft','.swipeable-both',function(){
			right_box_open();
			// close_quote_textarea();
		});
		$(document).on('swiperight','.swipeable-both',function(){
			right_box_close();
		});


		//FLAG WAS CLICKED
		$('.flags').click(function(){
			//MOUSE OVER POPUP MESSAGE
		    $(document).find( ".popover" ).mouseout(function() {
		    	var i = false;
		    	//MOUSE CAME BACK OVER MESSAGE 
 			$(document).find( ".popover" ).mouseover(function() {
 				//IF TRUE DONT HIDE PUPUP
 				over = true;
 				i = true;
 			});
			  setTimeout(function(){ 
			  	if (i == false) {//IF MOUSE DIDNT COME BACK HIDE
			  		$('.popbutton').popover('hide') ;
			  	};
			  }, 1000);
			});
			//IF MOUSE DID NOT ENTER CLOSE AFTER FEW SECONDS
			var over = false;
			$(document).find( ".popover" ).mouseover(function() {
 				over = true;
 			});
			setTimeout(function(){ 
			  	if (over == false) {//IF MOUSE DIDNT COME BACK HIDE
			  		$('.popbutton').popover('hide') ;
			  	};
			}, 3000);

		});

	}
}
request = {
	retrive_quotes: function(_this_reply) {
	var token = $('meta[name=csrf-token]').attr('content');
	$('#loading-icons-1').removeClass('hide');
	$('#quote-container').html('');
	$.post(
		'/threads/retrive-quotes',
		{
			"_token": token,
			"this_reply":_this_reply
		},
		function(result){
			var status = result.status;
			var html = result.quotes_html;
			$('#loading-icons-1').addClass('hide');

			switch(status) {
				case 200: // Approved
					$('#quote-container').append(html);
				break;				
				case 400: // Approved
				break;
				default:
				break;
			}
		}
		);
	},
	post_answer: function(this_answer,this_thread) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/post-answer',
			{
				"_token": token,
				"this_answer":this_answer,
				"this_thread":this_thread
			},
			function(result){
				var status = result.status;
				var answer = result.answer_html;
				switch(status) {
					case 200: // Approved
					$('#thread-group').append(answer);
					//CLEAROUT TEXTAREA
					$('textarea#answer_text').val('');

					break;				
					case 400: // Approved
					$('#myModal').modal('toggle');
					break;
					default:
					break;
				}
			}
			);
	},
		post_quote: function(this_answer,this_reply,this_thread) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/post-quote',
			{
				"_token": token,
				"this_answer":this_answer,
				"this_quote":this_reply,
				"this_thread":this_thread
			},
			function(result){
				var status = result.status;
				var answer = result.quote_html;
				var total_quote = result.quote_count;
				close_quote_textarea();
				switch(status) {
					case 200: // Approved
						$('.show-quote[this_reply='+this_reply+']').html('Quoted '+total_quote+' times');
						$('#quote-container').append(answer);
						toogle_this($('#quote-btn'));
						//EMPTY THE TESTAREA
						$('textarea#quote_text').val('');
					break;				
					case 400: // Approved
					break;
					default:
					break;
				}
			}
			);
	},
		submit_flag: function(this_reply,this_thread,_this) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/submit-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread
			},
			function(result){
				var status = result.status;
				switch(status) {
					case 200: // Approved
						var total_flag_count = result.total_flag_count;
						_this.find('.inner-val:first').text(total_flag_count);
					break;				
					case 400: // Approved
						$('#myModal').modal('toggle');
					break;
					default:
					break;
				}
			}
			);
	},
		submit_like: function(this_reply,this_thread,_this) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/submit-like',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread
			},
			function(result){
				var status = result.status;

				switch(status) {
					case 200: // Approved
						var total_like_count = result.total_like_count;
						var prev_dislike = result.prev_dislike;
						_this.find('.inner-val').text(total_like_count);
						_this.parents('.btn-group').find('.dont-like .inner-val:first').text(prev_dislike);
					break;				
					case 400: // Approved
						$('#myModal').modal('toggle');				
					break;
					default:
					break;
				}
			}
			);
	},
		submit_dislike: function(this_reply,this_thread,_this) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/submit-dislike',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread
			},
			function(result){
				var status = result.status;


				switch(status) {
					case 200: // Approved
						var total_dislike_count = result.total_dislike_count;
						var prev_like = result.prev_like;
						_this.find('.inner-val').text(total_dislike_count);
						_this.parents('.btn-group').find('.eye-like .inner-val:first').text(prev_like);
					break;				
					case 400: // Approved
						$('#myModal').modal('toggle');
					break;
					default:
					break;
				}
			}
			);
	}
};
function right_box_expende(_this_reply){
	request.retrive_quotes(_this_reply);
	$('#left-top-container').attr('state','1');
	$('#zoom').attr('target','true');
	$('#new-left-box').addClass('right-box-expand');

	$('.inner').attr('this-reply',_this_reply);
} 

function right_box_compress(){
	$('#left-top-container').attr('state','0');
	$('#zoom').attr('target','false');
	$('#new-left-box').removeClass('right-box-expand');
}

//SIMILAR TO EXPENDE AND COMPRESS BUT NO AJAX JUST OPEN AND CLOSE
function right_box_close(_this_reply){
	$('#left-top-container').attr('state','1');
	$('#zoom').attr('target','true');
	$('#new-left-box').addClass('right-box-expand');
} 

function right_box_open(){
	$('#left-top-container').attr('state','0');
	$('#zoom').attr('target','false');
	$('#new-left-box').removeClass('right-box-expand');
}


function toogle_this(_this){
	var this_state = parseInt(_this.attr('state'));
	switch(this_state){
		case 0:
			$('#quote-textarea').removeClass('hide');
			$('.quote-btnn').attr('state',1);
		break;
		case 1:
			$('#quote-textarea').addClass('hide');
			$('.quote-btnn').attr('state',0);
		break;
	}
}

function close_quote_textarea(){
	$('#quote-textarea').addClass('hide');
	$('.quote-btnn').attr('state',0);
} 
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);