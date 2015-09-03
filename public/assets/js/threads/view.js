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
            body_id: "editor-body-2",
            elementpath: false,
            max_height: 500,
            height : 125,
            toolbar: ["undo redo | bold italic | bullist | numlist"],
            menubar: false,
            statusbar: false,
            resize: false,
            mode: "textareas",
   			preview_styles: false,
		    setup: function(editor) {
		        editor.on('focus', function(e) {
		        	$(".inner").animate({ scrollTop: $('#panel-data')[0].scrollHeight}, 1000);
		        });
		    }
   			
        });
	
		ajax_call = 0;

		var alert_count = $('.alert-message').length;
		if (alert_count > 0) {
			setTimeout(function(){ $('.alert-message').remove() }, 3000);			
		};

        
	},
	events: function() {
		//WANT TO REPLY
		$(document).on('click','.show-quote',function(){
			// //DELETE ALL OTHER REPLY BOXES
			// $(document).find('.reply-media').remove();
			var state = parseInt($('#new-left-box').attr('state'));
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
			var state = parseInt($('#new-left-box').attr('state'));
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
			// var notify_me_condition = null;
			// var this_thread = $('#post-answer').attr('this-thread');
			// if (document.getElementById("notify_me_checkbox").checked) { 
			// 	notify_me_condition = 1;

			// } else {
			// 	notify_me_condition = 0;
			// }

			// request.thread_setting(notify_me_condition,this_thread);
		});


		//Reply FLAG CLICKED
		$(document).on('click','.reply-btn',function(){
		
		});

		//EYE LIKE
		$(document).on('click','.eye-like',function(){
			if (ajax_call == 0) {
				ajax_call = 1;
				var this_reply = $(this).parents('.panel-parent:first').attr('this_reply');
				var this_thread = $(this).parents('.panel-parent:first').attr('this_thread');
				request.submit_like(this_reply,this_thread,$(this));
			};

		});
		//DONT LIKE
		$(document).on('click','.dont-like',function(){
			if (ajax_call == 0) {
				ajax_call = 1;
				var this_reply = $(this).parents('.panel-parent:first').attr('this_reply');
				var this_thread = $(this).parents('.panel-parent:first').attr('this_thread');
				request.submit_dislike(this_reply,this_thread,$(this));
			}
		});
		//FLAG IT
		$(document).on('click','.flag-it',function(){
			if (ajax_call == 0) {
				ajax_call = 1;
				var this_quote = false;
				var this_reply = $(this).parents('.panel-parent:first').attr('this_reply');
				var this_thread = $(this).parents('.panel-parent:first').attr('this_thread');
				$('#modal_thread_id').val(this_thread);
				$('#modal_reply_id').val(this_reply);
				$('#modal_quote_id').val(this_quote);
				$(this).addClass(this_thread+'-'+this_reply+'-flag');
				request.check_flag(this_thread,this_reply,this_quote);
			}
		});
		$(document).on('click','.quote-flags',function(){
			if (ajax_call == 0) {
				ajax_call = 1;
				var this_reply = -999;
				var this_thread = -999;
				var this_quote = $(this).parents('.ind-quotes:first').attr('this_quote');
				$('#modal_thread_id').val(this_thread);
				$('#modal_reply_id').val(this_reply);
				$('#modal_quote_id').val(this_quote);
				$(this).addClass(this_quote+'-flag');
				request.check_flag(this_thread,this_reply,this_quote);
			}
		});


		$(document).on('click','#modal-flag-it',function(){
			if (ajax_call == 0) {
				ajax_call = 1;
				var this_reply = $('#modal_reply_id').val();
				var this_thread = $('#modal_thread_id').val();
				var this_quote = $('#modal_quote_id').val();
				var reason = $('input[name=optionsRadios]:checked').val();
				var details = $('#modal-flag-reason').val();
				request.submit_flag(this_reply,this_thread,this_quote,reason,details);
			}
		});

		$(document).on('click','#modal-flag-rmv-it',function(){
			if (ajax_call == 0) {
			ajax_call = 1;
				var this_reply = $('#modal_rmv_reply_id').val();
				var this_thread = $('#modal_rmv_thread_id').val();
				var this_quote = $('#modal_rmv_quote_id').val();
				request.remove_flag(this_thread,this_reply,this_quote);	
			}
		});




		//POST A REPLY
		$(document).on('click','#post-answer',function(){
			var this_text = tinyMCE.get('answer_text').getContent();
			var this_thread = $(this).attr('this-thread');
			if (!$.isBlank(this_text)) {
				$('#answer-empty').addClass('hide');
				request.post_answer(this_text,this_thread);
				$(this).parents('#add-answer').find('.mce-panel:first').removeClass('danger-border');
			} else {
				$('#answer-empty').removeClass('hide');
				$(this).parents('#add-answer').find('.mce-panel:first').addClass('danger-border');
			}
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

		//CANCEL IT
		$(document).on('click','#btn-preview',function(){
			//GET TEXT
			var this_text = tinyMCE.get('quote_text').getContent();
			if (!$.isBlank(this_text)) {
				request.prepare_preview(this_text);
				$('#quote-empty').addClass('hide');
				$(this).parents('#panel-footer-sidebar').find('.mce-panel:first').removeClass('danger-border');
			} else {
				$(this).parents('#panel-footer-sidebar').find('.mce-panel:first').addClass('danger-border');
			}

		});

		$(document).on('click','#preview-btn-thread',function(){
			//GET TEXT
			var this_text = tinyMCE.get('answer_text').getContent();
			if (!$.isBlank(this_text)) {
				request.prepare_preview(this_text);
				$('#answer-empty').addClass('hide');
				$(this).parents('#add-answer').find('.mce-panel:first').removeClass('danger-border');
			} else {
				$('#answer-empty').removeClass('hide');
				$(this).parents('#add-answer').find('.mce-panel:first').addClass('danger-border');
			}

		});
		
		//Send it
		$(document).on('click','#btn-send',function(){

			//GET TEXT
			var this_text = tinyMCE.get('quote_text').getContent();
			//GET QUOTE
			var this_reply = $(this).parents('.inner').attr('this-reply');
			// GET THREAD
			var this_thread = $(this).parents('.inner').attr('this-thread'); 
			if (!$.isBlank(this_text)) {
				$(this).parents('#panel-footer-sidebar').find('.mce-panel:first').removeClass('danger-border');
				request.post_quote(this_text,this_reply,this_thread);
			} else {
				$(this).parents('#panel-footer-sidebar').find('.mce-panel:first').addClass('danger-border');
			}

		});

		$(document).on('click','#quote-title-btn',function(){
			right_box_open();
		});


		/*==================================================
		=                   MOBILE SWIPE                   =
		==================================================*/
		// $(function() {
		// 	$("html").swipe( {
		// 		swipeStatus:function(event, phase, direction, distance, duration, fingers, fingerData) {
 	// 		  	switch(direction){
		// 	  		case "left":
		// 	  			if (distance > 50) {
		// 	  				$('#swipe-icone').fadeOut();
		// 	  				right_box_open();
		// 	  			};
		// 	  		break;
		// 	  		case "right":
		// 	  			// if (distance > 50) {right_box_close()};
		// 	  		break;
		// 	  	}
		// 	  },
		// 	  allowPageScroll:"vertical",
		// 	  threshold:0,
		// 	  fingers:1
		// 	});
		// });


		//FLAG WAS CLICKED
		$('#quote-image-wrapper').click(function(){
			right_box_open();
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
	prepare_preview: function(this_text) {
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/threads/preview-message',
		{
			"_token": token,
			"this_text":this_text
		},
		function(result){
			var status = result.status;
			var preview_html = result.preview_html;
			switch(status) {
				case 200: // Approved
					$('#preview-modal-body').html(preview_html);
					$('#preview_modal').modal('show');
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
						$(document).find('.reply-bg-'+this_reply+ ' .show-quote .inner-val').text(total_quote);
						$(document).find('.reply-sm-'+this_reply+ ' .show-quote .inner-val').text(total_quote);
						$('#quote-container').append(answer);
						tinyMCE.get('quote_text').setContent('');
						$("#panel-data").animate({ scrollTop: $('#panel-data')[0].scrollHeight}, 1000);
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
	remove_flag: function(this_thread,this_reply,this_quote) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/remove-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread,
				'this_quote':this_quote
			},
			function(result){
				$('#flag_remove_modal').modal('toggle');
				var status = result.status;
				ajax_call = 0;
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
	check_flag: function(this_thread,this_reply,this_quote) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/check-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread,
				"this_quote":this_quote
			},
			function(result){
				var status = result.status;
				ajax_call = 0;
				switch(status) {
					case 200: // LEGIT SHOW FLAG MODAL
						$('#flag_modal').modal('toggle');
					break;				
					case 401: //FLAG EXIST SHOW DELETE FLAG MODAL
						$('#modal_rmv_thread_id').val(this_thread);
						$('#modal_rmv_reply_id').val(this_reply);
						$('#modal_rmv_quote_id').val(this_quote);
						$('#flag_remove_modal').modal('toggle');
					break;
					case 402: //USER NOT LOGGED IN
						$('#myModal').modal('toggle');
					break;
					default:
					break;
				}
			}
			);
	},
		submit_flag: function(this_reply , this_thread , this_quote,reason,details) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/threads/submit-flag',
			{
				"_token": token,
				"this_reply":this_reply,
				"this_thread":this_thread,
				"this_quote" :this_quote,
				"reason" : reason,
				"details" : details
			}
			,
			function(result){
				$('#flag_modal').modal('toggle');
				reset_flag_modal();
				var status = result.status;
				ajax_call = 0;
				switch(status) {
					case 200: // Approved
						var total_flag_count = result.total_flag_count;
						if (this_quote == 'false') {
							$('.'+this_thread+'-'+this_reply+'-flag').find('.inner-val:first').text(total_flag_count);
						} else {
							$('.'+this_quote+'-flag').addClass('flag-checked');
						}
						
					break;				
					case 401: // Approved
						// $('#flag_remove_modal').modal('toggle');
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
				ajax_call = 0;
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
				ajax_call = 0;
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
	$('#swipe-icone').fadeIn();
	request.retrieve_quotes(_this_reply);
	$('#new-left-box').attr('state','1');
	$('#zoom').attr('target','true');
	$('#new-left-box').addClass('right-box-expand');
	$('.inner').attr('this-reply',_this_reply);
} 
function right_box_renew(_this_reply){
	request.retrieve_quotes(_this_reply);
	$('.inner').attr('this-reply',_this_reply);
} 
function right_box_compress(){
	// $('#swipe-icone').fadeOut();
	$('#new-left-box').attr('state','0');
	$('#zoom').attr('target','false');
	$('#new-left-box').removeClass('right-box-expand');
}

//SIMILAR TO EXPENDE AND COMPRESS BUT NO AJAX JUST OPEN AND CLOSE
function right_box_close(_this_reply){

	$('#new-left-box').attr('state','1');
	$('#zoom').attr('target','true');
	$('#new-left-box').addClass('right-box-expand');
} 

function right_box_open(){

	$('#new-left-box').attr('state','0');
	$('#zoom').attr('target','false');
	$('#new-left-box').removeClass('right-box-expand');
}


function toogle_this(_this){
	var this_state = parseInt(_this.attr('state'));
	switch(this_state){
		case 0:
			$('.quote-btnn').attr('state',1);
			$('#quote-textarea').removeClass('hide');
			$('#btn-group-quote').removeClass('hide');
			$('.quote-btnn').addClass('hide');
			tinymce.execCommand('mceFocus',false,'quote_text');
		break;
		case 1:
			// $('.quote-btnn').attr('state',0);
			// $('#quote-textarea').removeClass('textarea-expande');
		break;
	}
}

function left_box_state_0(){
	$('#btn-group-quote').addClass('hide');
	$('.quote-btnn').removeClass('hide');
	$('.quote-btnn').attr('state',0);
	$('#quote-textarea').addClass('hide');
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