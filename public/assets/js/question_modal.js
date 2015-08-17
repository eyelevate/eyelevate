$(document).ready(function(){
question_modal.pageLoad();
question_modal.events();
question_modal.modal_stepy();

});
question_modal = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	modal_stepy: function(){
		$(document).on('click','.next-btn',function(){
			var _this = $(this).parents('.modal:first').find('.step[state="active"]');
			var current_step = parseInt(_this.attr('step'));
			if (current_step < 4) {
				if (current_step == 1) {
					var search_text = $('#comment_text').val();
					//CHECK IF THE SEARCH AREA WAS NOT EMPTY
					if (!$.isBlank(search_text)) {
						//SEND SEARCH REQUEST TO PHP 
						request_a.search_query(search_text, _this, current_step,$(this));
					} else {
						$('#comment_text').focus();
					}
				} else if(current_step == 3) {
					var description_text = $('#question-description').val();
					var title_text = $('#question-title').val();
					
					if (!$.isBlank(description_text) && !$.isBlank(title_text)) {
						$('#nxt-btn').addClass('hide');
						$('#qst-submit').removeClass('hide');
						var next_step = current_step + 1;
						//DEACTIVE THE PREVIOUS STATE AND HIDE IT
						_this.attr('state',null);
						_this.addClass('hide');
						//SHOW AND ACTIVE THE NEXT STEP
						$('.step-'+next_step).removeClass('hide').attr('state','active');
						manage_modal_btns($(this),next_step);
					} else {	
						if ($.isBlank(description_text)) {
							$('#question-description').focus();
						} else {
							$('#question-title').focus();
						}
					}
				} else {
					$('#nxt-btn').removeClass('hide');
					$('#qst-submit').addClass('hide');
					var next_step = current_step + 1;
					if (next_step == 3) {
						var search_text = $('#comment_text').val();
						$('#question-title').html(search_text);
					}
					//DEACTIVE THE PREVIOUS STATE AND HIDE IT
					_this.attr('state',null);
					_this.addClass('hide');
					//SHOW AND ACTIVE THE NEXT STEP
					$('.step-'+next_step).removeClass('hide').attr('state','active');
					manage_modal_btns($(this),next_step);
				}
			}
		});
		$(document).on('click','.back-btn',function(){
			var _this = $(this).parents('.modal:first').find('.step[state="active"]');
			var current_step = parseInt(_this.attr('step'));
			if (current_step > 1) {
				//THIS IS THE FINAL STEP SHOW SUBMIT BTN
				if (current_step == 4) {
					$('#nxt-btn').removeClass('hide');
					$('#qst-submit').addClass('hide');
				} else if (current_step == 2) {

				}
				if (current_step == 3) {
					if ($('#not_unique').val() == "false") {
						var next_step = current_step - 1;
					} else {
						var next_step = current_step - 2;
					}
				} else {
					var next_step = current_step - 1;
				}
				//BACK TO STEP 1
				if (next_step == 1) { 
					$(this).addClass('hide');
					$('.next-btn').css('width','29%');
				 };
				//DEACTIVE THE PREVIOUS STATE AND HIDE IT
				_this.attr('state',null);
				_this.addClass('hide');
				//SHOW AND ACTIVE THE NEXT STEP
				$('.step-'+next_step).removeClass('hide').attr('state','active');
			}
		});
	},
	events: function() {
		$('#ask_modal').on('hide.bs.modal', function (e) {
			reset_ask_modal();
		});
		$(document).on('click','#qst-submit',function(){
			var count = $('#h3-wrapper .category-tag').length;
			if (count != 0) {
				$('#question_add').submit();
			} else {
				$('.custom-dropdown__select--white').focus();
			}
		});
	}
}
request_a = {
	search_query: function(search_text, _this, c_step, this_elem) {
	$('.existing-query').html('');
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/threads/search-query',
		{
			"_token": token,
			"search_text":search_text
		},
		function(result){
			$('#not_unique').remove();
			var status = result.status;
			var search_results = result.search_results;
			//INCREASE THE WIDTH OF NEXT BTN
			$('.next-btn').css('width','47%');
			switch(status) {
				case 200: // Approved

				var next_step = c_step + 1;
				//DEACTIVE THE PREVIOUS STATE AND HIDE IT
				_this.attr('state',null);
				_this.addClass('hide');
				//SHOW AND ACTIVE THE NEXT STEP
				$('.step-'+next_step).removeClass('hide').attr('state','active');
				var search_text = $('#comment_text').val();
				$('#you-asked').html(search_text);
				manage_modal_btns(this_elem,next_step);
				var html = '';
				var array_l = Object.keys(search_results).length;
				var counter = 0;
				$.each(search_results, function( key, value ) {
					if (counter == array_l-1) {
						html += '<div class="search-single">'+
				                '<a class="search-single-a" thread-id="'+value["id"]+'"> <span>'+value["title"]+'</span></br>'+
				                '<span class="search-reply">'+value["reply"]+' reply</h5></a>'+
				   		'</div>';
					} else {
						html += '<div  class="search-single search-single-first">'+
				                '<a  class="search-single-a" thread-id="'+value["id"]+'"> <span>'+value["title"]+'</span></br>'+
				                '<span class="search-reply">'+value["reply"]+' reply</h5></a>'+
				   		'</div>';
					}
					counter++;
				});    
				$('.existing-query').html(html); 
				$('.search-single-a').click(function(){
					var id = $(this).attr('thread-id');
					window.open('/threads/view/'+id);
					e.preventDefault();
				});
				var hidden_form = '<input type="hidden" id="not_unique" value="false">';
				$('body').append(hidden_form);
				break;				
				case 400: // Approved
					var next_step = c_step + 2;
					//DEACTIVE THE PREVIOUS STATE AND HIDE IT
					_this.attr('state',null);
					_this.addClass('hide');
					//SHOW AND ACTIVE THE NEXT STEP
					$('.step-'+next_step).removeClass('hide').attr('state','active');
					var search_text = $('#comment_text').val();
					$('#question-title').html(search_text);
					var hidden_form = '<input type="hidden" id="not_unique" value="true">';
					$('body').append(hidden_form);
					manage_modal_btns(this_elem,next_step);
				break;

				default:
				break;
			}
		}
		);
	}
};
function reset_ask_modal(){
	$('.step-1').removeClass('hide');
	$('.step-2').addClass('hide');
	$('.step-3').addClass('hide');
	$('.step-4').addClass('hide');

	$('.step').attr('state','');
	$('.step-1').attr('state','active');
}
function manage_modal_btns(this_elem, next_step){
				//SETTING THE HEADER TITLE
			switch(next_step){
				case 1:
					this_elem.parents('.modal:first').find('.modal-title').html('<h4>Your Question</h4>');
					$('.back-btn').addClass('hide');
				break;
				case 2:
					this_elem.parents('.modal:first').find('.modal-title').html('<h4>Is your question unique?</h4>');
					$('.back-btn').removeClass('hide');
				break;
				case 3:
					this_elem.parents('.modal:first').find('.modal-title').html('<h4>Add question details</h4>');
					$('.back-btn').removeClass('hide');
				break;
				case 4:
					this_elem.parents('.modal:first').find('.modal-title').html('<h4>Pick Categories</h4>');
				break;
			}
}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);