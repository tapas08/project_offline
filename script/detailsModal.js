// Global Variables for credit bills
// Without these the function won't calculate total correctly
var credit_total = 0, i = 1, return_bill = [], return_amount = [];

// function get_new_data(source){
// 	console.log(source);
// 	var id = $(source).attr('id');
// 	//alert(id);
// 	if (source.which == 13){
// 		id = id.split('_');
// 		console.log("ENTER HIT");
// 		getData('_'+id[1], '', '', 'new');
// 		return;
// 	}
// }

/*$('#productName_1').keydown('.product_names', function(e){
	console.log(e);
	if (e.which == 13){
		console.log("Enter pressed");
	}
});*/

// $("input[name^='productName_']").keydown('.product_names', function(e){
// 	console.log("here");
// 	var id = $(this).attr('id');
// 	console.log($(this).attr('class'));
// 	console.log("productname_"+i);
// 	if (e.which == 13){
// 		console.log(id);
// 		id = id.split('_');
// 		console.log("ENTER HIT");
// 		getData('_'+id[1], '', '', 'new');
// 		i++;
// 		return;
// 	}
// });

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
		// var flag = list_modal_details();
		// if (flag == false){
		// 	console.log("row => "+flag);
		// 	getList('productName_'+(counter-1), 'drugList_'+(counter-1), true, true);
		// 	//$('#productName_'+(counter-1)).attr('onkeydown',"get_new_data(this)");
		// }
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
				console.log("data "+data);
				if (data == 0){
					$('.modal-details').modal('hide');
					getList('productName_'+(counter-1), 'drugList_'+(counter-1), true, true);
					return false;
				}else{
					$('.product-list').html(data);
					$('#modal_input').focus();
					return true;
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
	var tuple = $('.details-table table tbody tr.focus');
	var td = $(tuple.cells);

	var data = $(td[1]).html();
	console.log("Table lenght => "+$('.credit-bills-div table tbody tr').length);
	console.log("Table Index => "+ tableIndex)
	
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('.details-table table tbody tr').length ){
        tableIndex = 0;
    }

    if ($('#credit_show').val() == 'true'){
		if( (tableIndex+1) > $('.credit-bills-div table tbody tr').length ){
        	tableIndex = 0;
    	}
    }
    
    // Element exists?
    if($('.details-table table tbody tr:eq('+tableIndex+')').length > 0)
    {
    	//console.log("herehraok");
        // Remove other highlights
        if ($('#credit_show').val() == 'true'){
        	console.log("Removing CLass");
        	$('.credit-bills-div table tbody tr').removeClass('focus');	
        }else if ($('#return_bills').val() == 'return_invoice'){
			$('.details-table table tbody tr').removeClass('focus');
		}else{
        	$('.details-table.product-list table tbody tr').removeClass('focus');
        }
        
        // Highlight your target
        if ($('#credit_show').val() == 'true'){
        	$('.credit-bills-div table tbody tr:eq('+tableIndex+')').addClass('focus');
        }else if ($('#return_bills').val() == 'return_invoice'){
			$('.details-table table tbody tr:eq('+tableIndex+')').addClass('focus');
		}else{
        	$('.details-table.product-list table tbody tr:eq('+tableIndex+')').addClass('focus');
        	
        	// Get details of product's purchase history
        	getProductPurchaseDetails(tableIndex);
        }
    
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
	if($('#credit_show').val() == 'true'){
		var next = parseInt($('.credit-bills-div table tbody tr.focus').index()) - 1;
    	highlight(next);
	}else if ($('#return_bills').val() == 'return_invoice'){
		highlight($('.details-table table tbody tr.focus').index() - 1);	
	}else{
		highlight($('.details-table.product-list table tbody tr.focus').index() - 1);	
	}
    
});

$('#goto_next').click(function() {
	if($('#credit_show').val() == 'true'){
		console.log("Current Index => "+$('credit-bills-div table tbody tr.focus').index());
		var next = parseInt($('.credit-bills-div table tbody tr.focus').index()) + 1;
    	console.log("NExt => "+next);
    	highlight(next);
	}else if ($('#return_bills').val() == 'return_invoice'){
		highlight($('.details-table table tbody tr.focus').index() + 1);	
	}else{
		// console.log('here');
		// console.log(parseInt($('product-list table tbody tr.focus').index()));
		var next = parseInt($('.product-list table tbody tr.focus').index()) + 1;
    	highlight(next);
    }
});

$('#goto_last').click(function() {
	if($('#credit_show').val() == 'true'){
		highlight($('.credit-bills-div table tbody tr:last').index());
	}else if ($('#return_bills').val() == 'return_invoice'){
		highlight($('.details-table table tbody tr.focus').index());	
	}else{
    	highlight($('.details-table table tbody tr:last').index());
    }
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
	console.log(path);
	if (path[0] == "purchaseReturn"){
		$('#product').val(data).focus();
		if($('#return_bills').val() == 'return_invoice'){
			console.log("REturn bill");
			$('#product').val(data).focus();
			var invoiceNo = $(td[0]).html();
			recreate_return_bill(invoiceNo);
			// console.log($(row[2]).html());
			// insertToTable($(row[2]).html());
			return false;
		}
		insertToTable(batch);
	}else if($('#credit_show').val() == "true"){
		if ($('#bill_checked_'+(row+1)).prop('checked') == false){
			$('#bill_checked_'+(row+1)).attr('checked', 'checked');	
			return_bill.push(data);
		}else{
			$('#bill_checked_'+(row+1)).removeAttr('checked');
			var removeItem = data;
			return_bill.splice( $.inArray(removeItem, return_bill) ,1 );
		}
		
		
	}else if (path[0] == "purchase"){
		var tuple = $('.product-list table tbody tr');
		var td = $(tuple[row].cells);
		$('#productName').val($(td[1]).html());
		insertDetails();
	}else{
		var tuple = $('.product-list table tbody tr');
		var td = $(tuple[row].cells);
		var batch = '';
		var data = $(td[1]).html();
		if ($('#state').val() == 'old'){
			batch = $(td[2]).html();	
		}
		
		$('#productName_'+(counter-1)).val(data).focus();
		getData('_'+(counter-1), data, batch, $('#state').val());
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
			console.log(data);
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
			$('#return_bills').val("");
			//console.log(data);
		}
	});
}

function add_credit_note(){
	
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
				console.log("RETURN BILL = "+data);
				//return_amount.push(data);
				credit_total += parseInt(data);
				$('#creditNote').val(credit_total);
				this_total = credit_total;
				// console.log("TOTAL in loop "+ $('#creditNote').val(credit_total));
				$('#credit_show').val("");
			}
		});
		total = this_total;
	}

	$.each($('#return_products_list input[type="checkbox"]:checked'), function(){
		var values = $(this).val().split(",");
		var bill_no = values[1];
		console.log(credit_total);
		if ($(this).attr('disabled') != 'disabled'){
			$.ajax({
				url: "functions/otherFunctions.php",
				type: 'post',
				data: {
					amount: values[0],
					invoiceNo: bill_no,
					option: 'get_return_bill_amount'
				},
				success:function(data){
					return_amount.push(data);
					console.log("selected Item= "+data);
					credit_total += data;
					sum_credit();
				}
			});
		}
	});
	console.log("After sub addition = "+credit_total);
	//$('#creditNote').val(parseInt(credit_total));

	// Get the products selected and calculate the final total amount 
	sum_credit();
	$('#creditNote').val(total);
	getTotal(counter);
	$('#creditModal').modal('hide');
	credit_total = 0;
	
}

function sum_credit(){
	var total = parseInt($('#creditNote').val());
	console.log("total -> "+total);
	for (var i = 0; i < return_amount.length; i++){
		total += parseInt(return_amount[i]);
		console.log(return_amount[i]);
	}
	$('#creditNote').val(total);
}

function getProductPurchaseDetails(row){
	var tuple = $('.details-table table tbody tr');
	var td = $(tuple[row].cells);

	var product = $(td[1]).html();
	var batch = $(td[2]).html();

	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			product: product,
			batch: batch,
			option: 'getProductPurchaseDetails'
		},
		success: function (data){
			$('.purchase-details').html(data);
		}
	})
}

$('#new_product').click(function (){
	window.open('http://www.tslifecare.com/purchase.php', '_blank', "toolbar=yes,scrollbars=yes,resizable=yes,fullscreen=yes, width=1200");
});