function getList1(id, list, drug, insertData){
	var value = document.getElementById(id).value;
	//alert(value);
	//id = (id.substr(7) == "MarketedBy") ? id.substr(7) : (id.substr(7) == "Manftr" ? 'company_name' : id);
	if (id == 'customer_name'){
		id = 'customers';
	}

	//console.log(drug+"  "+insertData);

	$.ajax({
		url: 'functions/patient_funtion.php',
		type: 'post',
		data: {
			searchTerm:value,
			table: id,
			access: 'getList',
		},
		success: function(data){
			//console.log(data);
			document.getElementById(list).innerHTML = data;
			console.log(data);
			if (id == 'stockist_name'){
				if ( document.getElementById('productMarketedBy') !== null){
					document.getElementById('productMarketedBy').value = document.getElementById('company_name').value;
				}
				if ( document.getElementById('productManftr') !== null ){
					document.getElementById('productManftr').value = document.getElementById('company_name').value;
				}
			}

			if (insertData != null && insertData == true){
				console.log("hello");
				getData1('_'+(counter-1));
			}
		}
	});
}
