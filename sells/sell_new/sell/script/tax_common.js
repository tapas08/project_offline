function getList(id, list, drug, insertData){
	var value = document.getElementById(id).value;
	//alert(value);
	$.ajax({
		url: 'functions/tax_funtion.php',
		type: 'post',
		data: {
			searchTerm:value,
			table: id,
			access: 'getList',
		},
		success: function(data){
			console.log("hello");
			document.getElementById(list).innerHTML = data;
			console.log(data);
			
			if (insertData != null && insertData == true){
				console.log("hello_I_M");
				getData1();
			}
		}
	});
}

