function detailsPatient(id){
	console.log(id);
	var input = $('#'+id).val();
	//alert(input);
	if (input.length == 3){
		$('#modal_inputp').val(input);
		$('#modal_inputp').focus();
		$('.modal-patients').modal();
		list_modal_detailp();
	}
}

function list_modal_detailp(){
	var input = $('#modal_inputp').val();
	//alert('hello');
	if(input.length >= 1){

		$.ajax({
			url: 'functions/otherFunctions.php',
			type: 'post',
			data: {
				input: input,
				option: 'patient_details'
			},
			success: function(data){
				$('.detailp-table').html(data);
				//document.write(data);
				//console.log(data);
			}
		});
	}
}
/************funtion product************/
function detailsModal(id){
		console.log(id);
	var input = $('#'+id).val();
	//alert(input);
	if (input.length == 3){
		$('#modal_input').val(input);
		$('#modal_input').focus();
		$('.modal-details').modal();
		list_modal_details();
	}
}

function list_modal_details(){
	var input = $('#modal_input').val();
	//alert('hello');
	if(input.length >= 1){

		$.ajax({
			url: 'functions/otherFunctions.php',
			type: 'post',
			data: {
				input: input,
				option: 'product_details'
			},
			success: function(data){
				$('.details-table').html(data);
				//document.write(data);
				console.log(data);
			}
		});
	}
}


/**************************************************
******************<<Handle table>>*******************
****************************************************/

function highlight_2(tableIndex) {
	console.log("hereme..");
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
    }
    //console.log("table-index => "+tableIndex);
}


/**************************************************
******************<<Handle table>>*******************
****************************************************/

function highlight(tableIndex) {
	//console.log("here!");
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('.detailp-table tbody tr').length ){
        tableIndex = 0;
    }
    
    // Element exists?
    if($('.detailp-table tbody tr:eq('+tableIndex+')').length > 0)
    {
        // Remove other highlights
        $('.detailp-table tbody tr').removeClass('focus');
        
        // Highlight your target
        $('.detailp-table tbody tr:eq('+tableIndex+')').addClass('focus');
    }
    //console.log("table-index => "+tableIndex);
}

$('#goto_first').click(function() {
	if ($('#patient_details').val() == "true"){
		highlight(0);
	}else{
		highlight_2(0);
	}
    
});

$('#goto_prev').click(function() {
	if ($('#patient_details').val() == "true"){
		highlight($('.detailp-table tbody tr.focus').index() - 1);
	}else{
		highlight_2($('.details-table table tbody tr.focus').index() - 1);

	}
    
    
});

$('#goto_next').click(function() {
	if ($('#patient_details').val() == "true"){
		var next = parseInt($('.detailp-table tbody tr.focus').index()) + 1;
		highlight(next);
		
	}else{
		var next = parseInt($('.details-table table tbody tr.focus').index()) + 1;
		highlight_2(next);
	}
	
});

$('#goto_last').click(function() {
	if ($('#patient_details').val() == "true"){
		 highlight($('.detailp-table tbody tr:last').index());
	}else{
		highlight_2($('.details-table table tbody tr:last').index())
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
		if ($('#patient_details').val() == "true"){
				selected($('.detailp-table tbody tr.focus').index());
				break;
			}else{
				selected($('.details-table table tbody tr.focus').index());
				break;
			}
   
        	
    }

 });


/**********************************************************
**************Get Details of selected Bill*****************
***********************************************************/

function selected(row){
	if ($('#patient_details').val() == "true"){
	var tuple = $('.detailp-table tbody tr');
	console.log(row);
	if (row == -1){
		row = 0;
	}
	var td = $(tuple[row].cells);

	var data = $(td[4]).html();
	var batch = $(td[2]).html();
	
	$('#bill_no'+(counter-1)).val(data).focus();
	convert_to_bill('_'+(counter-1), data, batch);
	//getData('_'+(counter-1), data, batch);
	$('.modal-patients').modal('hide');
	console.log(data);

	/* $.ajax({
	 	url: 'functions/otherFunctions.php',
	 	type: 'post',
	 	data: {
	 		bill_no: data,
	 		access: 'convert_to_INV'
	 	},
		success: function(data){
	 		$('#bill_details').html(data);
	 	}
	 });
*/
	}else{
		var tuple = $('.details-table table tbody tr');
	var td = $(tuple[row].cells);

	var data = $(td[1]).html();
	var batch = $(td[2]).html();
	
	$('#productName_'+(counter-1)).val(data).focus();
	getData('_'+(counter-1), data, batch);
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
}