var maximum_rows = 50;
var rows;
var total_pages;
$(window).load(function(){

	rows = $('table tbody tr');
	var total_rows = $('table tbody tr').length;
	
	var page = 1;
	total_pages = Math.ceil(total_rows/maximum_rows);
	
	rows.hide();
	rows.slice(0, maximum_rows).show();

	var links = '';

	for (var i = 0; i < total_pages; i++){
		links += "<a href='javascript:;' onclick='changePage("+ (i+1) +")'>"+ (i+1) +"</a>";
	}

	$('#page_desc').html("Showing Page 1 / "+total_pages);

	$('#pagination').html(links);

});

function changePage(page){
	$('#page_desc').html("Showing Page "+ page +" / "+total_pages);
	if (page == 1){
		rows.hide();
		rows.slice(0, maximum_rows).show();
	}
	else{
		rows.hide();
		rows.slice(maximum_rows, maximum_rows + 50).show();
		maximum_rows+=50;
	}
}