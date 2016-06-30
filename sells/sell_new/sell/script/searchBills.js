
/**
 *  -> Get the value of respective function
 *  -> Pass it to a common function via ajax
 *  -> Display the bills on right side
 *  -> Pass the cursor control to table view
 */

function searchByName(){
	var name = $('#Name').val();

	$.ajax({
		url: 'functions/searchBills.php',
		type: 'post',
		data: {
			search_by: 'patient_name',
			search_term: name,
			access: "searchBill"
		},
		success: function(data){
			$('#bill_table').html(data);
			// Pass control to table
		}
	});
}

function searchByBill(){
	var bill_no = $('#bill_no').val();
	
	$.ajax({
		url: 'functions/searchBills.php',
		type: 'post',
		data: {
			search_by: 'bill_no',
			search_term: bill_no,
			access: "searchBill"
		},
		success: function(data){
			$('#bill_table').html(data);
			// Pass control to table
			// $('#bill_list').focus();
			// $('#bill_list tbody tr:first').addClass('focus');
		}
	});
}
/**************************************************
******************<<Handle table>>*******************
****************************************************/

function highlight(tableIndex) {
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('#bill_list tbody tr').length ){
        tableIndex = 0;
    }
    
    // Element exists?
    if($('#bill_list tbody tr:eq('+tableIndex+')').length > 0)
    {
        // Remove other highlights
        $('#bill_list tbody tr').removeClass('focus');
        
        // Highlight your target
        $('#bill_list tbody tr:eq('+tableIndex+')').addClass('focus');
    }
    //console.log("table-index => "+tableIndex);
}

$('#goto_first').click(function() {
    highlight(0);
});

$('#goto_prev').click(function() {
    highlight($('#bill_list tbody tr.focus').index() - 1);
});

$('#goto_next').click(function() {
	var next = parseInt($('#bill_list tbody tr.focus').index()) + 1;
    highlight(next);
});

$('#goto_last').click(function() {
    highlight($('#bill_list tbody tr:last').index());
});

$(document).keydown(function (e) {

    switch(e.which) 
    {
        case 38:
            $('#goto_prev').trigger('click');
            break;
        case 40:
            $('#goto_next').trigger('click');
            break;
        case 32:
        	selected($('#bill_list tbody tr.focus').index());
        	break;
    }

 });


/**********************************************************
**************Get Details of selected Bill*****************
***********************************************************/

function selected(row){
	//console.log(row);
	var tuple = $('#bill_list tbody tr');
	var td = $(tuple[row].cells);
	var data = $(td[1]).html();
	console.log(data);

	$.ajax({
		url: 'functions/searchBills.php',
		type: 'post',
		data: {
			bill_no: data,
			access: 'get_bill_details'
		},
		success: function(data){
			$('#bill_details').html(data);
			console.log(data);
		}
	});

}
