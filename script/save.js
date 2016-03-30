function saveEntry(from, to){
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			table: to,
			from: from,
			abr: $('#abr').val(),
			option: "save_stockist_company",
			stockist: (from == 'company_name') ? 1 : 0
		},
		success: function(data){
			// TODO
			$('#message').html(data);
			console.log(data);
		}
	})
}