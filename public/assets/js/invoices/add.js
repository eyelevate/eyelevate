$(document).ready(function(){
	invoices.pageLoad();
	invoices.events();
});

invoices = {
	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {
		$("#addInvoiceItem").click(function(){
			requests.makeInvoiceItem();
		});
		$('body').on('click','.removeRow',function(){
			$(this).parents('tr:first').remove();
			invoices.sumInvoiceItems();

		});
	},
	sumInvoiceItems: function() {
		// create total variables
		total_subtotal = 0;
		total_tax = 0;
		total_due = 0;

		// Loop through tbody to find inputs and rename to current index
		$(document).find("#invoiceItemTableTbody tr").each(function(e){
			total_subtotal += parseFloat($(this).find('.invoiceItem-subtotal').val());
			total_tax += parseFloat($(this).find('.invoiceItem-tax').val());
			total_due += parseFloat($(this).find('.invoiceItem-due').val());

			$(this).find('.invoiceItem-title').attr('name','invoice_item.'+e+'.title');
			$(this).find('.invoiceItem-description').attr('name','invoice_item.'+e+'.description');
			$(this).find('.invoiceItem-quantity').attr('name','invoice_item.'+e+'.quantity');
			$(this).find('.invoiceItem-subtotal').attr('name','invoice_item.'+e+'.subtotal');
			$(this).find('.invoiceItem-tax').attr('name','invoice_item.'+e+'.tax');
			$(this).find('.invoiceItem-taxId').attr('name','invoice_item.'+e+'.taxId');
			$(this).find('.invoiceItem-due').attr('name','invoice_item.'+e+'.due');
		});

		// format to currency type

		// fill out correct totals
		$("#totalSubtotal").html(total_subtotal);
		$("#totalTax").html(total_tax);
		$("#totalDue").html(total_due);
	}

};

requests = {
	makeInvoiceItem: function(){
		var title = $('#invoiceItemTitle').val() ? $('#invoiceItemTitle').val() : null;
		var description = $('#invoiceItemDescription').val() ? $('#invoiceItemDescription').val() : null;
		var quantity = $('#invoiceItemQuantity').val() ? $('#invoiceItemQuantity').val() : null;
		var subtotal = $('#invoiceItemSubtotal').val() ? $('#invoiceItemSubtotal').val() : null;
		var tax_id = $('#invoiceItemTax option:selected').val() ? $('#invoiceItemTax option:selected').val() : null;

		$.post("/admins/invoice-items/make-invoice-item",
		{
			'title' : title,
			'description' : description,
			'quantity': quantity,
			'subtotal': subtotal,
			'tax_id': tax_id
		}, function(e){
			if(e.status == 200) {
				$("#invoiceItemTableTbody").append(e.row);
				invoices.sumInvoiceItems();
				// reset invoice form
				$("#invoiceItem-div").find('input').val('');
				$("#invoiceItem-div").find('select option[value=""]').attr('selected','selected');

			}
		});
	}
};