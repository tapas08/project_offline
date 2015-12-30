<?php
	/*require_once('core/init.php');

	if (Input::exists()){
		$db = DB::getInstance();
		for($i = 1; $i<(int)$_POST['counter']; $i++){
			$insert = $db->insert('purchaseBills', array(
					'invoiceNumber' => $_POST["invoiceNumber"],
					'bType' => $_POST['billType'],
					'supplier' => $_POST['stockist_name'],
					'date' => $_POST['billDate'],
					'productName' => $_POST["productName_"+$i],
					'productQuantity' => $_POST["productQuantity_"+$i],
					'productSize' => $_POST["productSize_"+$i],
					'productFree' => $_POST["productFree_"+$i],
					'tabQuantity' => $_POST["tabQuantity_"+$i],
					'batchNo' => $_POST["batchNo_"+$i],
					'expiryDate' => $_POST["exDate_"+$i],
					'purchaseRate' => $_POST["purchaseRate_"+$i],
					'discount' => $_POST["discount_"+$i],
					'vatAmount' => $_POST["VAT_"+$i],
					'VAT' => $_POST["vatPer_"+$i],
					'CST' => $_POST["CST_"+$i],
					'MRP' => $_POST["MRP_"+$i],
					'purchaseAmount' => $_POST["productAmount_"+$i]
				));
		}
		$insertInvoice = $db->insert('purchaseBills', array(
				'invoiceNumber' => $_POST['invoiceNumber'],
				'purchaseEntry' => $_POST['purchaseEntry'],
				'billDate' => $_POST['billDate'],
				'supplier' => $_POST['stockist_name'],
				'cash_or_credit' => $_POST['cash_or_credit'],
				'creditNote' => $_POST['creditNote'],
				'debitNote' => $_POST['debitNote'],
				'discountPer' => $_POST['overallDisc'],
				'discount' => $_POST['totalDiscount'],
				'VAT' => $_POST['totalVat'],
				'netAmount' => $_POST['netAmnt']
			));
	}*/
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Purchase Oder</title>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/invoice.css">
	
	<script src="script/jquery-min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script src="script/jquery.mtz.monthpicker.js"></script>

</head>
<body>
		
	<?php include('templates/header.php'); ?>

	<section class="container">
		<div class="col-md-12">
			<div class="col-md-4">
				<h2>Purchase Order</h2>
			</div>
			<div class="col-md-7">
				<input type="reset" form="orderForm" id="reset" name="reset" class="btn btn-primary" value="Cancel">
				<input type="button" id="soldProduct" name="soldProduct" class="btn btn-primary" value="Sold Product">
				<input type="button" id="print" name="print" class="btn btn-primary" value="Print">
				<input type="button" id="modifyPO" name="modifyPO" class="btn btn-primary" value="Modify PO">
				<input type="button" id="getItemsOrder" name="getItemsOrder" class="btn btn-primary" value="Get Items To Order">
				<input type="submit" form="orderForm" id="saveOrder" name="saveOrder" onclick="checkAndSave();" class="btn btn-primary" value="Save">
				<a href="#" id="exit" name="exit" class="btn btn-primary">Exit</a>
			</div>
		</div>
		
		<form action="" class="form" id="orderForm" method="POST">
			<div class="row col-md-12 form-top">
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="stockist_name" class="control-label">PurOrderNo</label></span>
					<span class="col-md-9"><input type="text" id="stockist_name" name="stockist_name" list="stockist_list" class="form-control" oninput="getList('stockist_name', 'stockist_list')" autofocus></span>
					<datalist id="stockist_list"></datalist>
				</div>
				<div class="form-group col-md-1" id="cr/dr">
					1
				</div>
				<div class="form-group col-md-4">
					<span class="col-md-4"><label for="orderType" class="control-label">Stockist Name</label></span>
					<span class="col-md-8" ><input type="text"name="orderType" id="orderType" class="form-control">
							
						
					</span>
				</div>
				
				<div class="form-group col-md-3">
					<span class="col-md-2"><label for="orderDate" class="control-label">Date</label></span>
					<span class="col-md-9"><input type="date" class="form-control" id="orderDate" name="orderDate" value="<?php echo date('Y-m-d'); ?>"></span>
				</div>
			</div>

			<div class="container-fluid" id="productEntry">
	
				<table class="table table-bordered">
					<thead>
						<td>Product Name</td>
						<td>Stock</td>
						<td>PrSize</td>
						<td>Stokist Name</td>
						<td>OrdQty</td>
						<td>Free</td>
						
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" name="productName_1" id="productName_1" class="form-control" list="drugList_1" oninput="getList('productName_1', 'drugList_1', true, true);">
									<datalist id="drugList_1"></datalist>
								</input>
							</td>
							<td><input type="number" name="productStock_1" id="productStock_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" name="productSize_1" id="productSize_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="text" name="stokistName_1" id="stokistName_1" class="form-control" list="drugList_1" oninput="getList('productName_1', 'drugList_1', true, true);">
									<datalist id="drugList_1"></datalist></input></td>
							<td><input type="number" name="orderQuantity_1" id="orderQuantity_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" name="productFree_1" id="productFree_1" oninput="calculate(1);" class="form-control"></td>
							
						</tr>
					</tbody>
				</table>

			</div>
			<input type="button" id="addField" name="addField" class="btn btn-primary" value="Next Entry">
			<input type="hidden" form="invoiceForm" id="counter" name="counter" value=2>
			<br>


		</form>

	</section>

	

	<script src="script/generateFields.js"></script>
	<script src="script/common.js"></script>
	<script src="script/bootstrap.min.js"></script>

<script>

		var counter = 2;
		var netAmnt =0, total=0;

		//Script running every 100ms to get all the input fields
		//with class "month". 
		//This is making it to dynamically write to month input field
		//in mm-yy format
		//Validation of month will be done in php when the form is
		//submitted.

		setInterval(function (){
			var month = document.getElementsByClassName('month');
			for (var i = 0; i < month.length; i++) {
			    month[i].addEventListener('keyup', function (e) {
			        var reg = /[0-9]/;
			        if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-"; //Add colon if string length > 2 and string is a number 
			        if (this.value.length > 5) this.value = this.value.substr(0, this.value.length - 1); //Delete the last digit if string length > 5
			    });
			};
			
		}, 100);
		

		$('#addField').click( function(){
			var inputFiled = {

				'1': [{
					'tag': 'input',
					'type': 'text',
					'id': 'productName',
					'name': 'productName',
					'list': 'drugList_'+counter,
					'class': 'form-control',
					'oninput': "getList('productName_"+counter+"', 'drugList_"+counter+"', true, true);"
				}],
				'2': [{
					'tag': 'input',
					'type': 'number',
					'id': 'productStock',
					'name': 'productStock',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],

				'3': [{
					'tag': 'input',
					'type': 'number',
					'id': 'productSize',
					'name': 'productSize',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],

				'4': [{
					'tag': 'input',
					'type': 'text',
					'id': 'stokistName',
					'name': 'stokistName',
					'list': 'drugList_'+counter,
					'class': 'form-control',
					'oninput': "getList('productName_"+counter+"', 'drugList_"+counter+"', true, true);"
					}],

				'5': [{
					'tag': 'input',
					'type': 'number',
					'id': 'orderQuantity',
					'name': 'orderQuantity',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				
			    '6': [{
					'tag': 'input',
					'type': 'number',
					'id': 'productFree',
					'name': 'productFree',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}]
				};
			generateFields('invoiceForm', inputFiled, counter);

			getTotal(counter);

			counter++;
			$('#counter').val(counter);

			changeDiscount();

		});

				
				

		//function that will update discount value in every row of inputs

		function changeDiscount(){
			for(var i=1; i < counter; i++){
				$('#discount_'+i).val(parseFloat($('#overallDisc').val()).toFixed(2));
				console.log(i);
			}
		}


		function getData(id){
			var drug = $('#productName'+id).val();
			console.log(drug);
			$.ajax({
				type: 'post',
				url: 'functions/purchaseFunctions.php',
				dataType: 'json',
				data: {
					drug: drug,
					access: 'insertData'
				},
				success: function(data){
					$('#productQuantity'+id).val(data.quantity);
					$('#purchaseRate'+id).val(data.purchaseRate);
					//$('#tax'+id).val(data.Tax);
					$('#vatPer'+id).val(data.VAT);
					$('#MRP'+id).val(data.MRP);
				}
			});
		}

		function calculate(count){
			
			var quantity = $('#productQuantity_'+count+'').val();
			var productSize = $('#productSize_'+count+'').val();
			var productAmount = 0.0;
			if ($('#productFree_'+count).val() !== ''){
				quantity = parseInt(quantity) + parseInt($('#productFree_'+count).val());
			}
			//console.log(quantity + " " + productSize);
			var tabs = parseInt(quantity) * parseInt(productSize);
			//console.log(tabs);

			//calculating discount
			var discount = (parseFloat($('#discount_'+count).val()) / 100) 
							* (parseFloat($('#productQuantity_'+count).val()) * parseFloat($('#purchaseRate_'+count).val()));
			//console.log("DISCOUNT -> "+discount);

			if (discount == NaN){
				discount = 0.0;
			}

			productAmount = (parseFloat($('#purchaseRate_'+count).val()) * parseFloat(productSize));

			//calculating VAT
			var VAT = ( parseFloat($('#vatPer_'+count).val()) / 100 ) 
						* ( (parseFloat($('#productQuantity_'+count).val()) * parseFloat($('#purchaseRate_'+count).val())) - discount );
			//console.log("VAT -> "+VAT);
			$('#VAT_'+count).val(VAT.toFixed(2));

			$('#tabQuantity_'+count).val(tabs);

			$('#productAmount_'+count).val(productAmount.toFixed(2));

			getTotal(counter);

		}

		function getTotal(counter){

			//Insert the discount value to the newly created row
			var totalDiscount = parseFloat($('#totalDiscount').val());
			$('#discount_'+counter).val(totalDiscount.toFixed(2));
			
			//Once the fields are generated, add the
			//total amount of current item and the net amount of 
			//all the items till now!

			total = parseFloat($('#purchaseRate_'+(counter-1)).val()) * parseFloat($('#productQuantity_'+(counter-1)).val());

			$('#totalAmnt').val(total.toFixed(2));

			//console.log(netAmnt +"  "+ total);

			//calculate total amount of VAT upon purchased item
			//and total amount of Discount

			//set this variable to 0 each time the script runs
			//so that it won't add up the previous one over and over
			
			var totalVat = 0, totalDiscount = 0;

			netAmnt = 0;

			for(var i = 1; i < counter; i++){
				
				//Calculate total amount
				netAmnt += parseFloat($('#productAmount_'+i).val());


				//This calculate all the vat values from each fields
				//and return a fresh value!


				totalVat += parseFloat($('#VAT_'+i).val());

				totalDiscount += (parseFloat($('#discount_'+i).val()) / 100) 
							* (parseFloat($('#productQuantity_'+i+'').val()) * parseFloat($('#purchaseRate_'+i).val()));

				console.log(totalVat+"  "+totalDiscount);
			}

			$('#totalDiscount').val(totalDiscount.toFixed(2));
			$('#vatOnBill').val(totalVat.toFixed(2));
			$('#netAmnt').val(netAmnt.toFixed(2));
			
		}

		//Function to check if there are any due on the supplier
		//if yes display a modal with credit details
		function checkCredit(){
			var supplier = $('#stockist_name').val();
			if(supplier !== ''){
				$('#creditModal').modal();
			}
		}


	</script>
	

</body>
</html>