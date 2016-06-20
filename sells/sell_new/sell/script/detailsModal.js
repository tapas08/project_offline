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