function highlight(tableIndex) {
    // Just a simple check. If .highlight has reached the last, start again
    if( (tableIndex+1) > $('#data tbody tr').length )
        tableIndex = 0;
    
    // Element exists?
    if($('#data tbody tr:eq('+tableIndex+')').length > 0)
    {
        // Remove other highlights
        $('#data tbody tr').removeClass('highlight');
        
        // Highlight your target
        $('#data tbody tr:eq('+tableIndex+')').addClass('highlight');
    }
}

$('#goto_first').click(function() {
    highlight(0);
});

$('#goto_prev').click(function() {
    highlight($('#data tbody tr.highlight').index() - 1);
});

$('#goto_next').click(function() {
    highlight($('#data tbody tr.highlight').index() + 1);
});

$('#goto_last').click(function() {
    highlight($('#data tbody tr:last').index());
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
    }

 });
