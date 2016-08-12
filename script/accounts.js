$('.head-lists li').click(function(e){
	//alert("Here!");
	var li = $(this).html();
	var pieces = li.split('>');
	var key = pieces[3].split('<');
	
	/*
		// TODO
		## Check if there any sub-heads within the selected head
		## If yes display under the resp. head
		## And display each child of resp. sub-head 
		## Plus display it in the table
	*/

	$.ajax({
		url: '../functions/head_functions.php',
		type: 'post',
		data: {
			head: $.trim(key[0]),
			access: 'get_sub_heads'
		},
		success: function(data){
			console.log(data);
			$('.sub-heads-details').html(data);
		}
	});

});


function add_new_head(key){
	$('.head-lists input, .head-lists select').remove();
	$('.head-lists').append("<li><input type='text' id='sub_head' name='sub_head' placeholder='"+key+" - SUB HEAD' class='form-control' autofocus></li>");
	$('.head-lists').append("<li><input type='hidden' id='head' value="+key+"></li>");
	$('.head-lists').append("<li><input type='text' id='op_bal' name='op_bal' placeholder='OPENING BALANCE' class='form-control'></li>");
	$('.head-lists').append("<li><select id='type' name='type'  class='form-control'><option>CR</option><option>DB</option></select></li>");
	$('.head-lists').append("<li><input type='button' id='add_sub_head' name='add_sub_head' value='ADD' class='btn btn-primary' onclick='save_sub_head()'></li>");
	//$(document).off('keydown');
}


function save_sub_head(){
	console.log("here");
	$.ajax({
		url: '../functions/head_functions.php',
		type: 'post',
		data: {
			head: $('#head').val(),
			sub_head: $('#sub_head').val(),
			op_bal: $('#op_bal').val(),
			type: $('#type').val(),
			access: 'add_sub_head'
		},
		success: function(data){
			console.log(data);
			if (data == "success"){
				$('.head-lists input, .head-lists select').remove();
				$('.msg').html("Sub-Head Added");
				$('.head-lists li.focus').trigger('click');
			}
		}
	});
}


/*
	
	*************************************************
	*************************************************
	####### Script to navigate through heads ########
	*************************************************
	*************************************************
*/

function highlight(tableIndex) {
	
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('.head-lists li').length ){
        tableIndex = 0;
    }

    if ($('#on_subheads').val() == "true"){
    	if( (tableIndex+1) > $('.sub-heads-details tr').length ){
	        tableIndex = 0;
	    }
    }
    
    // Element exists?
    if($('.head-lists li:eq('+tableIndex+')').length > 0 && $('#on_subheads').val() == "false")
    {
        // Remove other highlights
        $('.head-lists li').removeClass('focus');	
        
        // Highlight your target
        $('.head-lists li:eq('+tableIndex+')').addClass('focus');

        $('.head-lists li.focus').trigger('click');
   
    }else if ($('.sub-heads-details tr:eq('+tableIndex+')').length > 0 && $('#on_subheads').val() == "true"){
    	// Remove other highlights
        $('.sub-heads-details tr').removeClass('focus');	
        
        // Highlight your target
        $('.sub-heads-details tr:eq('+tableIndex+')').addClass('focus');
    }
    //console.log("table-index => "+tableIndex);
}

$('#goto_first').click(function() {
    highlight(0);
});

$('#goto_prev').click(function() {
	highlight($('.head-lists li.focus').index() - 1);
});

$('#goto_next').click(function() {
	highlight($('.head-lists li.focus').index() + 1);	
});

$('#goto_last').click(function() {	
	highlight($('.head-lists li:last').index());
});

$(document).keydown(function (e) {

    switch(e.which) 
    {
        case 38:
            $('#goto_prev').trigger('click');
            $('#on_subheads').val("false");
            break;
        case 40:
            $('#goto_next').trigger('click');
            $('#on_subheads').val("false");
            break;
        case 78:
        	if ($('#sub_head').val() != undefined){
        		break;
        	}
        	var li = $('.head-lists li.focus').html();
			var pieces = li.split('>');
			var key = pieces[3].split('<');
        	add_new_head(key[0]);
        	$('#on_subheads').val("false");
        	break;
        case 98:
        	$('#on_subheads').val("true");
        	highlight($('.sub-heads-details tr.focus').index() + 1);
        	break;
        case 104:
        	$('#on_subheads').val("true");
        	highlight($('.sub-heads-details tr.focus').index() - 1)
        	break;
    }

 });


function loadSubHeads(){
	var li = $('.head-lists li.focus').html();
	var pieces = li.split('>');
	var key = pieces[3].split('<');

	$.ajax({
		url: '../functions/head_functions.php',
		type: 'post',
		data: {
			head: key[0],
			access: 'get_sub_heads'
		},
		success: function(data){
			$('.sub-heads-detials').html(data);
			console.log(data);
		}
	});
}