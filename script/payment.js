/*
	
	*************************************************
	*************************************************
	####### Script to navigate through heads ########
	*************************************************
	*************************************************
*/

function highlight(tableIndex) {
	
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('.invoice-list tr').length ){
        tableIndex = 0;
    }

    // Element exists?
    if($('.invoice-list tr:eq('+tableIndex+')').length > 0)
    {
        // Remove other highlights
        $('.invoice-list tr').removeClass('focus');	
        
        // Highlight your target
        $('.invoice-list tr:eq('+tableIndex+')').addClass('focus');

        $('.invoice-list tr.focus').trigger('click');
   
    }
}

$('#goto_first').click(function() {
    highlight(0);
});

$('#goto_prev').click(function() {
	highlight($('.invoice-list tr.focus').index() - 1);
});

$('#goto_next').click(function() {
	highlight($('.invoice-list tr.focus').index() + 1);	
});

$('#goto_last').click(function() {	
	highlight($('.invoice-list tr:last').index());
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
            $('#stockist_name').val(stockist_name);
            // Get row number
            var num = $('.invoice-list tr.focus').index() + 1;
            $('#inv_'+num).each(function () { 
                this.checked = !this.checked;
                var value = $('#inv_'+num).val().split("/");
                if (this.checked){
                    console.log(value);
                    total += parseInt(value[1]);
                    invoice_numbers.push(value[0]);
                    console.log("PLus = "+invoice_numbers);
                }else{
                    total -= parseInt(value[1]);
                    removeItem = value[0];
                    //invoice_numbers.splice($.inArray(invoice_numbers, value[0]), 1);

                    invoice_numbers = jQuery.grep(invoice_numbers, function(value) {
                      return value != removeItem;
                    });

                    console.log("Minus = "+invoice_numbers);
                }
                $('#amount_paid').val(total);
            });
            // if ($('#inv_'+num).attr("checked")){
            //     var value = $('#inv_'+num).val().split("/");
            //     console.log(value);
            //     total += parseInt(value[1]);
            //     console.log(total);
            // }

            // console.log($('#inv_'+num).attr("checked"));
            break;
    }

 });