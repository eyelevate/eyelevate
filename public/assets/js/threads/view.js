$(document).ready(function(){
	results.pageLoad();
	results.events();

});
results = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	var popupTemplate='<li class="spam-popup">Report as spam</li>';
	$('.popbutton').popover({
	    animation:true, 
	    content:popupTemplate, 
	    html:true
	});
		tinymce.init({
            selector: "#answer_text",
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
		tinymce.init({
            selector: "#quote_text",
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

		//WANT TO REPLY
		$(document).on('click','.show-quote',function(){
			// //DELETE ALL OTHER REPLY BOXES
			// $(document).find('.reply-media').remove();
			var state = parseInt($('#left-top-container').attr('state'));
			var _this_reply = parseInt($(this).parents('.panel-parent').attr('this_reply'));
			if (state == 0) {//CLOSE
				right_box_expende(_this_reply);
			} else {
				//SIDE BAR IS ALREAEDY OPEN FILLED THE NEW DATA
				var _this_reply = parseInt($(this).parents('.panel-parent').attr('this_reply'));
				right_box_renew(_this_reply);
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

		//like CLICKED
		$(document).on('click','.thumb-up',function(){

		});

		//DISLIKE CLICKED
		$(document).on('click','.thumb-down',function(){

		});

		//SPAM FLAG CLICKED
		$(document).on('click','.spam-popup',function(){

		});

		//THREAD ICON CLICKED
		$(document).on('click','.setting-icon',function(){
			request.user_auth();
		});

		//THREAD ICON CLICKED
		$(document).on('click','#notify_me_checkbox',function(){
			var notify_me_condition = null;
			var this_thread = $('#post-answer').attr('this-thread');
			if (document.getElementById("notify_me_checkbox").checked) { 
				notify_me_condition = 1;

			} else {
				notify_me_condition = 0;
			}

			request.thread_setting(notify_me_condition,this_thread);
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
			$('#modal_thread_id').val(this_thread);
			$('#modal_reply_id').val(this_reply);
			$(this).addClass(this_thread+'-'+this_reply+'-flag');

			request.check_flag(this_thread,this_reply);

		});
		$(document).on('click','#modal-flag-it',function(){
			var this_reply = $('#modal_reply_id').val();
			var this_thread = $('#modal_thread_id').val();
			var reason = $('input[name=optionsRadios]:checked').val();
			var details = $('#modal-flag-reason').val();
			request.submit_flag(this_reply,this_thread,reason,details);
		});

		$(document).on('click','#modal-flag-rmv-it',function(){
			var this_reply = $('#modal_rmv_reply_id').val();
			var this_thread = $('#modal_rmv_thread_id').val();
			request.remove_flag(this_thread,this_reply);	
		});




		//POST A REPLY
		$(document).on('click','#post-answer',function(){
			var this_text = tinyMCE.get('answer_text').getContent();
			var this_thread = $(this).attr('this-thread');
			request.post_answer(this_text,this_thread);
		});

		//quote-quote
		$(document).on('click','#quote-reply-btn',function(){
			//GET TEXT
			var this_text = tinyMCE.get('quote_text').getContent();
			//GET QUOTE
			var this_reply = $(this).parents('.inner').attr('this-reply');
			// GET THREAD
			var this_thread = $(this).parents('.inner').attr('this-thread'); 
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
		$(function() {
			$("html").swipe( {
				swipeStatus:function(event, phase, direction, distance, duration, fingers, fingerData) {
 			  	switch(direction){
			  		case "left":
			  			if (distance > 50) {right_box_open()};
			  		break;
			  		case "right":
			  			if (distance > 50) {right_box_close()};
			  		break;
			  	}
			  },
			  allowPageScroll:"vertical",
			  threshold:0,
			  fingers:1
			});
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
	user_auth: function() {
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/users/user-auth',
		{
			"_token": token
		},
		function(result){
			var status = result.status;
			switch(status) {
				case 200: // Approved
					$('#thread_setting').modal('show');
				break;				
				case 400: // Approved
					
				break;
				default:
				break;
			}
		}
		);
	},
	thread_setting: function(notify_me_condition,this_thread) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/set-setting',
			{
				"_token": token,
				"notify_me_condition":notify_me_condition,
				"this_thread":this_thread
			},
			function(result){
				switch(status) {
					case 200: // Approved
					break;				
					case 400: // Approved
					break;
					default:
					break;
				}
			}
			);
	},
	retrieve_quotes: function(_this_reply) {
	var token = $('meta[name=csrf-token]').attr('content');
	$('#loading-icons-1').removeClass('hide');
	$('#quote-container').html('');
	$.post(
		'/threads/retrieve-quotes',
		{
			"_token": token,
			"this_reply":_this_reply
		},
		function(result){
			var status = result.status;
			var html = result.quotes_html;
			var reply_username = result.reply_username;
			var isself = result.isself;
			$('#loading-icons-1').addClass('hide');

			if (isself == true) {
				$('#quote-text').text('Respond');
				$('#replace-quoter-name').text('');		
			} else {
				$('#quote-text').text('Quote');
				$('#replace-quoter-name').text(' '+reply_username);
			}

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
						$(answer).insertBefore( "#add-answer" )
						//CLEAROUT TEXTAREA
						tinyMCE.get('answer_text').setContent('');

						var notify_me = result.notify_me;
						if (notify_me['notify_me'] == 1) {
							request.answer_notification(notify_me['user_id'],this_thread);
						};
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
		answer_notification: function(user_id,this_thread) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/answer-notification',
			{
				"_token": token,
				"user_id":user_id,
				"thread_id":this_thread
			},
			function(result){
				var status = result.status;
				switch(status) {
					case 200: // Approved
					break;				
					case 400: // Approved
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

				switch(status) {
					case 200: // Approved
						close_quote_textarea();
						$(document).find('.reply-bg-'+this_reply+ ' .show-quote .inner-val').text(total_quote);
						$(document).find('.reply-sm-'+this_reply+ ' .show-quote .inner-val').text(total_quote);
						$('#quote-container').append(answer);
						toogle_this($('#quote-btn'));
						//EMPTY THE TESTAREA
						tinyMCE.get('textarea#quote_text').setContent('');
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
	remove_flag: function(this_thread,this_reply) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/remove-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread
			},
			function(result){
				$('#flag_remove_modal').modal('toggle');
				var status = result.status;
				switch(status) {
					case 200: // Approved
					var total_flag_count = result.total_flag_count;
					$('.'+this_thread+'-'+this_reply+'-flag').find('.inner-val:first').text(total_flag_count);
					break;				
					default:
					break;
				}
			}
			);
	},
	check_flag: function(this_thread,this_reply) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/check-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread
			},
			function(result){
				var status = result.status;
				switch(status) {
					case 200: // Approved
						$('#flag_modal').modal('toggle');
					break;				
					case 401: // Approved
						$('#modal_rmv_thread_id').val(this_thread);
						$('#modal_rmv_reply_id').val(this_reply);
						$('#flag_remove_modal').modal('toggle');
					break;
					case 402: // Approved
						$('#myModal').modal('toggle');
					break;
					default:
					break;
				}
			}
			);
	},
		submit_flag: function(this_reply , this_thread ,reason,details) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/submit-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread,
				"reason" : reason,
				"details" : details
			}
			,
			function(result){
				$('#flag_modal').modal('toggle');
				reset_flag_modal();
				var status = result.status;
				switch(status) {
					case 200: // Approved
						var total_flag_count = result.total_flag_count;
						$('.'+this_thread+'-'+this_reply+'-flag').find('.inner-val:first').text(total_flag_count);
					break;				
					case 401: // Approved
						$('#flag_remove_modal').modal('toggle');
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
						var total_dislike_count = result.total_dislike_count;
						_this.find('.inner-val').text(total_like_count);
						_this.parents('.btn-group').find('.dont-like .inner-val:first').text(total_dislike_count);
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
						var total_like_count = result.total_like_count;
						_this.find('.inner-val').text(total_dislike_count);
						_this.parents('.btn-group').find('.eye-like .inner-val:first').text(total_like_count);
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
	request.retrieve_quotes(_this_reply);
	$('#left-top-container').attr('state','1');
	$('#zoom').attr('target','true');
	$('#new-left-box').addClass('right-box-expand');
	$('.inner').attr('this-reply',_this_reply);
} 
function right_box_renew(_this_reply){
	request.retrieve_quotes(_this_reply);
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
function reset_flag_modal(){
	$('#modal_thread_id').val('');
	$('#modal_reply_id').val('');
	$('.flag-radio').removeAttr('checked');
	$('#modal-flag-reason').val('');
} 
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);