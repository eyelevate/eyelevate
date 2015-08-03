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

	},
	events: function() {

		//WANT TO REPLY
		$('.show-quote').click(function(){
			//DELETE ALL OTHER REPLY BOXES
			$(document).find('.reply-media').remove();
			
			var state = parseInt($('#left-top-container').attr('state'));

			if (state == 0) {//CLOSE
				var _this_reply = parseInt($(this).attr('this_reply'));
				right_box_expende(_this_reply);
			} else {
				right_box_compress();
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
			toogle_this($('#quote-btn'));
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
		//POST A REPLY
		$(document).on('click','#post-answer',function(){
			var this_text = $('#answer_text').val();
			var this_thread = $(this).attr('this-thread');
			request.post_answer(this_text,this_thread);
		});

		//quote-quote
		$(document).on('click','#quote-reply-btn',function(){
			var this_text = $('#quote_text').val();
			var this_quote = $(this).attr('this-reply');
			var this_thread = $(this).attr('this-thread'); 

			request.post_quote(this_text,this_quote,this_thread);
		});

		//MORE CLICKED
		$('.more').click(function(){
			
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

	// $('a #left-top-container').click(function(e)
	// {
	// 	alert();
	//     // e.preventDefault();
	// });
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

	$('#quote-reply-btn').attr('this-reply',_this_reply);
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

	
					$('.show-quote[this_reply='+this_reply+']').html('Quoted '+total_quote+' times');

					$('#quote-container').append(answer);
					toogle_this($('#quote-btn'));
					break;				
					case 400: // Approved
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
} 

function right_box_compress(){
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