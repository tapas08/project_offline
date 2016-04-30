function getList(id, list, drug, insertData){
	var value = document.getElementById(id).value;
	
	id = (id.substr(7) == "MarketedBy") ? id.substr(7) : (id.substr(7) == "Manftr" ? 'company_name' : id);

	$.ajax({
		url: 'functions/purchaseFunctions.php',
		type: 'post',
		data: {
			searchTerm: value,
			table: id,
			access:  (drug == true) ? 'getDrug' : 'getList',
		},
		success: function(data){
			document.getElementById(list).innerHTML = data;
			
			if (id == 'stockist_name'){
				$('#stockist_name').on('input', function(){
				    var options = $('datalist')[0].options;
				    for (var i=0;i<options.length;i++){
				       if (options[i].value == $(this).val()) 
				         {checkPendingDM(false); break;}
				    }
				});
				if ( document.getElementById('productMarketedBy') !== null){
					document.getElementById('productMarketedBy').value = document.getElementById('company_name').value;
					checkPendingDM();
				}
				if ( document.getElementById('productManftr') !== null ){
					document.getElementById('productManftr').value = document.getElementById('company_name').value;
				}
			}

			if (insertData != null && insertData == true){
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
			console.log(data);
			$('input[type=text]').val("");
			$('input[type=number]').val("");
			$('input[type=email]').val("");
			$('textarea').val("");
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
	var drug_content = $('#drug_content').val();
	var sub_Cat = $('#sub_category').val();
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			drug_content: drug_content,
			sub_category: sub_Cat,
			option: 'insert_or_update_drugcontent'
		},
		success: function(data){
			console.log(data);
		}
	});
}

function deleteDrugContent(){
	var drug_content = $('#drug_content').val();
	var sub_Cat = $('#sub_category').val();
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		data: {
			drug_content: drug_content,
			sub_category: sub_Cat,
			option: 'delete_drugcontent'
		},
		success: function(data){
			console.log(data);
		}
	});
}

function convert_to_INV(inv_no){
	//console.log(inv_no);
	$.ajax({
		url: 'functions/otherFunctions.php',
		type: 'post',
		dataType: 'JSON',
		data: {
			invNo: inv_no,
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
}