$(document).ready(function(){
	results.pageLoad();
	results.modal_stepy();
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
	modal_stepy: function(){
		$('.next-btn').click(function(){

			var _this = $(this).parents('.modal:first').find('.step[state="active"]');

			
			var current_step = parseInt(_this.attr('step'));
			if (current_step < 3) {
				var next_step = current_step + 1;
				//DEACTIVE THE PREVIOUS STATE AND HIDE IT
				_this.attr('state',null);
				_this.addClass('hide');
				//SHOW AND ACTIVE THE NEXT STEP
				$('.step-'+next_step).removeClass('hide').attr('state','active');
			}

			//SETTING THE HEADER TITLE
			switch(next_step){
				case 1:
					$(this).parents('.modal:first').find('.modal-header').html('Your Question');
				break;
				case 2:
					$(this).parents('.modal:first').find('.modal-header').html('<h4>Is your question unique?</h4>');
				break;
				case 3:
					$(this).parents('.modal:first').find('.modal-header').html('<h4>Add question details</h4>');
				break;
			}
		});
		$('.back-btn').click(function(){
			var _this = $(this).parents('.modal:first').find('.step[state="active"]');
			var current_step = parseInt(_this.attr('step'));
			if (current_step > 1) {
				var next_step = current_step - 1;
				//DEACTIVE THE PREVIOUS STATE AND HIDE IT
				_this.attr('state',null);
				_this.addClass('hide');
				//SHOW AND ACTIVE THE NEXT STEP
				$('.step-'+next_step).removeClass('hide').attr('state','active');
			}
			//SETTING THE HEADER TITLE
			switch(next_step){
				case 1:
					$(this).parents('.modal:first').find('.modal-header').html('<h4>Your Question</h4>');
				break;
				case 2:
					$(this).parents('.modal:first').find('.modal-header').html('<h4>Is your question unique?</h4>');
				break;
				case 3:
					$(this).parents('.modal:first').find('.modal-header').html('<h4>Add question details</h4>');
				break;
			}
		});


	},
	events: function() {

		$('#ask_q_btn').click(function(){
			$('#ask_modal').modal('show');
		});

		//WANT TO REPLY
		$('.reply-text').click(function(){

			//DELETE ALL OTHER REPLY BOXES
			$(document).find('.reply-media').remove();
			
			var state = parseInt($('#right-arr').attr('state'));
		    // CREATE REPLY BOX
		    var reply_html = '<div class="media reply-media">'+
								'<div class="media-left">'+
								'<a href="#">'+
								'<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">'+
								'</a>'+
								'</div>'+
								'<div class="media-body">'+
								' <div class="form-group reply-form">'+
								'<label for="comment">Reply:</label>'+
								'<textarea class="form-control" rows="5" id="comment" placeholder="type somthing..."></textarea>'+
								'</div>'+
								'<div class="reply-btns pull-right">'+
								'<a class="btn btn-default left-btn">Cancel</a>'+
								'<a class="btn btn-primary reply-btn">Reply</a>'+
								'</div>'+
								'</div>'+
							'</div>';

			$(this).parents('.dialogbox-container:first').find('.reply-box:first').append(reply_html); 

		});

		//HIDE RIGHT BOX
		$('#right-arr').click(function(){
			var state = parseInt($('#right-arr').attr('state'));
		});
		//REPLY CANCEL BTN WAS CLICKED
		$(document).on('click','.left-btn',function(){
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
		
		$('#login').click(function(){
			$('#myModal').modal('toggle');
		});
		$(document).find('.login-btn').click(function(){
			$('#login-form').submit();
		});
		$('#forgot').click(function(){
			window.location = '/password-reset';
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
		


	// $('a #right-arr').click(function(e)
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

};

