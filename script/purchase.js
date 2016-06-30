// global variable that save current product name
// to modify
var product_name = '';
function getVat(){
	var type = document.getElementById('productGroup').value;

	document.getElementById('productVat').value = vatArray[type];
}

function insertDetails(){
	var drug = document.getElementById('productName').value;
	console.log(drug);
	$.ajax({
		type: 'post',
		url: 'functions/purchaseFunctions.php',
		dataType: 'json',
		data: {
			drug: drug, 
			where: 'new',
			access: 'insertData'
		},
		success: function(data2){
			//console.log("I am here");
			console.log(data2);
			$('#productMarketedBy').val(data2.marketedBy);
			document.getElementById('productManftr').value = data2.manufacturedBy;
			document.getElementById('productPackSize').value = data2.packSize;
			document.getElementById('productQuantity').value = data2.quantity;
			document.getElementById('productMainCategory').value = data2.mainCategory;
			document.getElementById('productSubCategory').value = data2.subCategory;
			document.getElementById('productType').value = data2.productType;
			document.getElementById('productGroup').value = data2.productGroup;
			document.getElementById('productRate').value = data2.purchaseRate;
			document.getElementById('productMRP').value = data2.MRP;
			document.getElementById('productTax').value = data2.Tax;
			document.getElementById('productVat').value = data2.VAT;
			document.getElementById('productShelf').value = data2.shelf;
			document.getElementById('productReorderLvl').value = data2.reorderLvl;
			document.getElementById('productOrderQuantity').value = data2.orderQuantity;
			document.getElementById('productContent').value = data2.drugContent;
			product_name = $('#productName').val();
		}
	});
}

function getDrug(){
	var searchTerm = document.getElementById('productName').value;

	$.ajax({
		url: 'functions/purchaseFunctions.php',
		type: 'post',
		data: {searchTerm: searchTerm, access: 'getDrug'},
		success: function(data){
			console.log(data);
			document.getElementById('drugList').innerHTML = data;
			insertDetails();
		}
	});
}

function updateData(){

	$.ajax({
		url: 'functions/purchaseFunctions.php',
		type: 'post',
		data: {
			orignal_name: 			product_name,
			productName : 			$('#productName').val(),
			productMarketedBy: 		$('#productMarketedBy').val(),
			productManftr: 			$('#productManftr').val(),
			productPackSize: 		$('#productPackSize').val(),
			productQuantity: 		$('#productQuantity').val(),
			productMainCategory: 	$('#productMainCategory').val(),
			productSubCategory: 	$('#productSubCategory').val(),
			productType: 			$('#productType').val(),
			productGroup: 			$('#productGroup').val(),
			productRate: 			$('#productRate').val(),
			productMRP: 			$('#productMRP').val(),
			productTax: 			$('#productTax').val(),
			productVat: 			$('#productVat').val(),
			productShelf: 			$('#productShelf').val(),
			productReorderLvl: 		$('#productReorderLvl').val(),
			productOrderQuantity: 	$('#productOrderQuantity').val(),
			productContent: 		$('#productContent').val(),
			access: 'update'
		},
		success: function(data){
			console.log(data);
			document.getElementById('Message').innerHTML = data;
		}
	});

}

function deleteDrug(){
	$.ajax({
		url: 'functions/purchaseFunctions.php',
		type: 'post',
		data: {
			productName: 	$('#productName').val(),
			access: 		'delete'
		},
		success: function(data){
			location.reload();
			document.getElementById('Message').innerHTML = data;
		}
	});
}