$(document).ready(function(){
	results.pageLoad();
	results.events();
	results.cat_selector();
	results.prefrences_frame();
});
results = {
	cat_selector:function(){
		$('.cat-items').click(function(){
			var is_select = is_cat_select($(this));
			var this_val = cat_toggle($(this),is_select);
			search_selected_group();
		});
	},
	prefrences_frame:function(){
		$('.op').click(function(){
			var this_pre = $(this).attr('this-pre');
			$('.op').removeClass('active-li');
			$(this).addClass('active-li');
			search_selected_group();
		});

	},
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

		$( ".custom-dropdown__select" ).change(function() {
			var this_val = $(this).find('option:selected').val();
			var this_text = $(this).find('option:selected').text();
			add_new_category(this_val,this_text);

		});

		$('.ask_q_btn').click(function(){
			request.user_auth();
		});

		$(document).find('.remove-label').click(function(){
			$(this).parents('.label:first').remove();
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

		$('#qst-submit').click(function(){
			$('#question_add').submit();
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
					$('#ask_modal').modal('show');
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
	search_cat: function(data,pre) {
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/categories/search-cat',
		{
			"_token": token,
			"data":data,
			"pre":pre
		},
		function(result){
			var status = result.status;
			var html = result.prepared_cat_html;
			switch(status) {
				case 200: // Approved
					$('#thread-group').html(html);
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
function add_new_category(val , text){
	$('#duplicate-error').addClass('hide');

	var total = $('.category-tag').length;
	var is_set = false;

	//CHECK IF IT EXISTS
	if (total > 0) {
		$( ".category-tag" ).each(function() {
		  var current_val = $( this ).attr('this-val');
		  if (current_val == val) {
		  	is_set = true;
		  	//SHOW ERROR
		  	$('#duplicate-error').removeClass('hide');
		  };
		});
	};
	//THERE WAS NO DUPLICATE
	if (is_set == false) {
		var html =  '<span class="tag label label-primary category-tag" this-val="'+val+'">'+
	                '<span>'+text+'</span>'+
	                '<a><i class="remove-label glyphicon glyphicon-remove-sign glyphicon-white"></i></a>'+
	                '<input name="categories['+total+']" type="hidden" value="'+val+'" text="'+text+'">'+
	                '</span>';
	    $('#h3-wrapper').append(html);
	    $(document).find('.remove-label').click(function(){
			$(this).parents('.label:first').remove();
	});
	};
}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);

function is_cat_select(_this){
	var return_data = false;
	if (_this.hasClass('act')) {
		return_data = true;
	};
	return return_data;
}
function cat_toggle(_this,is_select){
	if (is_select == true) { 
		_this.removeClass('act');
	} else {
		_this.addClass('act');
	}
}
function search_selected_group(){
	var data = new Array();
		$( ".cat-items" ).each(function() {
			if ($(this).hasClass('act')) {
				data.push($(this).attr('cat-id'));
			};
		});
		//CHECK THE PREFERENCE
		var preference = $('.active-li').attr('this-pre');
		request.search_cat(data,preference);
}


