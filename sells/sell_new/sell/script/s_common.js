
function getList(id, list, drug, insertData){
	var value = document.getElementById(id).value;
	
	id = (id.substr(7) == "MarketedBy") ? id.substr(7) : (id.substr(7) == "Manftr" ? 'company_name' : id);

	//console.log(drug+"  "+insertData);

	$.ajax({
		url: 'functions/s_function.php',
		type: 'post',
		data: {
			searchTerm: value,
			table: id,
			access:  (drug == true) ? 'getDrug' : 'getList',
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
				console.log("hehe");
				getData('_'+(counter-1));
			}
		}
	});
}

function saveStockistCustomer(){
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			acType: $('#type').val(),
			name: $('#name').val(),
			city: $('#city').val(),
			address: $('#address').val(),
			phone: $('#phone').val(),
			debit_limit: $('#debit_limit').val(),
			days_limit: $('#days_limit').val(),
			email: $('#email').val(),
			vat_tin_no: $('#vat_tin_no').val(),
			lbtNo: $('#lbtNo').val(),
			openBalance: $('#openBalance').val(),
			onoffswitch: $('.onoffswitch-inner').val(),
			option: 'save'
		},
		success: function(data){
			document.getElementById('msgCstSupp').innerHTML = data;
		}
	});
}

function saveType(){
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			productType: $('#productType').val(),
			code: $('#code').val(),
			option: 'savOrUpdate'
		},
		success: function(data){
			document.getElementById('productTypeMsg').innerHTML = data;
		}
	});
}

function deleteType(){
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			productType: $('#productType').val(),
			option: 'deleteType'
		},
		success: function(data){
			document.getElementById('productTypeMsg').innerHTML = data;
		}
	});	
}

function saveDrugContent(){
	alert("Under Construction!");
}

function deleteDrugContent(){
	alert("Under Construction!");
}

$('#billNo').keydown(function(e){
	//alert('ello');
	if (e.which == 13){
		convert_to_bill(0, $('#billNo').val());
}
});
/*
function convert_to_bill(bill_no, purEntry){
	//alert("oh!");
	console.log(bill_no);
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		dataType: 'JSON',
		data: {
			billNo: bill_no,
			purEntry: purEntry > 0 ? purEntry : -1,
			option: 'convert_to_INV'
		},
		success: function(data){
			console.log(data);
			$('#billContent').html(data.bill);
			$('#invoiceNumber').val(inv_no);
			$('#billDate').val(data.billDate);
			calculate(data.count);
		}
	});
}*/