function getList(id, list, drug, insertData){
	var value = document.getElementById(id).value;
	
	$.ajax({
		url: 'functions/master_funtion.php',
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
			
			if ( deleteDrug!= null && deleteDrug  == true){
				//console.log("hello_I_M");
				//getData1();
			}
		}
	});
}
