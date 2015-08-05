$(document).ready(function(){
	categories.pageLoad();
	categories.events();

});
categories = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {

		$( ".custom-dropdown__select" ).change(function() {
			var this_val = $(this).find('option:selected').val();
			var this_text = $(this).find('option:selected').text();
			add_new_category(this_val,this_text);

		});

		$(document).find('.remove-label').click(function(){
			$(this).parents('.label:first').remove();
		});
	}
}
request = {

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
	                '<span>'+text +'&nbsp</span>'+
	                '<a><i class="remove-label glyphicon glyphicon-remove-sign glyphicon-white"></i></a>'+
	                '<input name="categories['+total+']" type="hidden" value="'+text+'" text="'+text+'">'+
	                '</span>';
	    $('.cat-wrapper').append(html);
	    $(document).find('.remove-label').click(function(){
			$(this).parents('.label:first').remove();
	});
	};
}