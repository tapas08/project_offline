// Global Variables for credit bills
// Without these the function won't calculate total correctly
var credit_total = 0;

window.detailsModal = function(id){
	var input = $('#'+id).val();
	//console.log(input.length);
	if (input.length == 3){
		$('#modal_input').val(input);
		$('#modal_input').focus();
		$('.modal-details').modal();
		// var path = $(location).attr('href');
		// path = path.split("/");
		// path = path[path.length - 1].split(".");
		// if (path[0] == "purchaseReturn"){

		// }else{

		// }
		list_modal_details();
	}
}

function list_modal_details(){
	var input = $('#modal_input').val();

	if(input.length >= 1){

		$.ajax({
			url: 'functions/otherFunctions.php',
			type: 'post',
			data: {
				input: input,
				option: 'product_details'
			},
			success: function(data){
				if (data == 0){
					$('.modal-details').modal('hide');
					getList('productName_'+(counter-1), 'drugList_'+(counter-1), true, true);
				}else{
					$('.details-table').html(data);
					$('#modal_input').focus();
				}
				
				//console.log(data);
			}
		});
	}
}


/**************************************************
******************<<Handle table>>*****************
****************************************************/

function highlight(tableIndex) {
	
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('.details-table table tbody tr').length ){
        tableIndex = 0;
    }
    
    // Element exists?
    if($('.details-table table tbody tr:eq('+tableIndex+')').length > 0)
    {
        // Remove other highlights
        $('.details-table table tbody tr').removeClass('focus');
        
        // Highlight your target
        $('.details-table table tbody tr:eq('+tableIndex+')').addClass('focus');
    
        // Check if the event is on purchase return page
        if ($('#return_bills').val() == 'return_invoice' || $('#credit_show').val() == 'true'){
        	show_return_products($('.details-table table tbody tr.focus').index());
        }
    }
    //console.log("table-index => "+tableIndex);
}

$('#goto_first').click(function() {
    highlight(0);
});

$('#goto_prev').click(function() {
    highlight($('.details-table table tbody tr.focus').index() - 1);
});

$('#goto_next').click(function() {
	var next = parseInt($('.details-table table tbody tr.focus').index()) + 1;
    highlight(next);
});

$('#goto_last').click(function() {
    highlight($('.details-table table tbody tr:last').index());
});

$(document).keydown(function (e) {
    switch(e.which) 
    {
        case 38:
            $('#goto_prev').trigger('click');
            break;
        case 40:
        	// var next = parseInt($('.details-table table tbody tr.focus').index());
        	// highlight(next);
            $('#goto_next').trigger('click');
            break;
        case 32:
        	selected($('.details-table table tbody tr.focus').index());
        	break;

        case 13:
        	if($('#credit_show').val() == 'true'){
        		add_credit_note();
        	}
        	break;

        //case 9:

    }

 });


/**********************************************************
**************Get Details of selected Bill*****************
***********************************************************/

function selected(row){
	var tuple = $('.details-table table tbody tr');
	var td = $(tuple[row].cells);

	var data = $(td[1]).html();
	var batch = $(td[2]).html();
	
	var path = $(location).attr('href');
	path = path.split("/");
	path = path[path.length - 1].split(".");
	if (path[0] == "purchaseReturn"){
		$('#product').val(data).focus();
		if($('#return_bills').val() == 'return_invoice'){
			
			$('#product').val(data).focus();
			var invoiceNo = $(td[0]).html();
			recreate_return_bill(invoiceNo);
			// console.log($(row[2]).html());
			// insertToTable($(row[2]).html());
			return false;
		}
		
		insertToTable(batch);
	}else if($('#credit_show').val() == "true"){
		
		$('#bill_checked_'+(row+1)).attr('checked', 'checked');
		
	}else{
		$('#productName_'+(counter-1)).val(data).focus();
		getData('_'+(counter-1), data, batch);	
	}
	
	$('.modal-details').modal('hide');
	//console.log(data);

	// $.ajax({
	// 	url: 'functions/searchBills.php',
	// 	type: 'post',
	// 	data: {
	// 		bill_no: data,
	// 		access: 'get_bill_details'
	// 	},
	// 	success: function(data){
	// 		$('#bill_details').html(data);
	// 	}
	// });

}


function show_return_products(row){
	if (row == -1){
		row = 0;
	}
	//console.log(row);
	var tuple = $('.details-table table tbody tr');
	//console.log(tuple[row].cells);
	var td = $(tuple[row].cells);
	
	var invoiceNo = $('#credit_show').val() == 'true' ? $(td[1]).html() : $(td[0]).html();

	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			invoiceNo: invoiceNo,
			credit_note: $('#credit_show').val() == 'true' ? 'true' : 'false',
			option: 'show_return_products'
		},
		success: function(data){
			$('#return_products_list').html("");
			$('#return_products_list').html(data);
			//console.log(data);
		}
	});
}

function recreate_return_bill(invoiceNo){
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		dataType: 'json',
		data: {
			invoiceNo: invoiceNo,
			option: 'recreate_return_bill'
		},
		success: function(data){
			// TODO
			// Place the bill to its correct position
			// Calculate the amount
			$('#product_details').html(data.list);
			$('#stockist_name').val(data.supplier);
			$('select option[value='+data.bType+']').attr('selected', 'selected');
			$('#invoiceLoss').val(data.loss);
			$('#invoiceNumber').val(data.invNo);
			$('#billDate').val(data.date);
			$('#Status option[value='+data.status+']').attr('selected', 'selected');
			$('#message').val(data.narration);
			$('#return_invoice').modal('hide');

			// Set the buttons to disabled
			$('#showItems, #Expiry, #Delete, #RePrn').attr('disabled', 'disabled');

			// Change the value and type of modify button
			$('#saveInvoice').attr({
				//'type': 'submit',
				'value': 'Update'
			});
			$('#saveInvoice').removeAttr('onclick');

			// And set the form action to update page
			$('#purchaseReturnForm').attr('action', 'update_purchase_return.php');

			//console.log(data);
		}
	});
}

function add_credit_note(){
	// TODO
	// Get return value of each products of each bill
	// Calculate the total amount 
	// Add that amount to net amount of the invoice
	var total_checked_bills = $('.credit-bills input[type="checkbox"]:checked').length;

	var bill_no = [], total = 0;

	$('#creditNote').val(total);

	$.each($('.credit-bills input[type="checkbox"]:checked'), function(){
		bill_no.push($(this).val());
	});
	var this_total = 0;
	for (var i = 0; i < total_checked_bills; i++){
		$.ajax({
			url: 'functions/otherFunctions.php',
			type: 'post',
			data: {
				invoiceNo: bill_no[i],
				option: 'get_return_bill_amount'
			},
			success: function(data){
				credit_total += parseInt(data);
				$('#creditNote').val(credit_total);
				this_total = credit_total;
				console.log("TOTAL in loop "+this_total);
			}
		});
		total = this_total;
	}

	$.each($('#return_products_list input[type="checkbox"]:checked'), function(){
		credit_total += parseInt($(this).val());
		console.log(credit_total);
	});
	$('#creditNote').val((credit_total + parseInt(credit_total)));

	// Get the products selected and calculate the final total amount 
	console.log("total -> "+credit_total);
	getTotal(counter);
	$('#creditModal').modal('hide');
	
}