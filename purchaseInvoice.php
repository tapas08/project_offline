<?php
	require_once('core/init.php');

	$message = [];	

	if (Input::exists()){
		$db = DB::getInstance();
		
		for($i = 1; $i<(int)$_POST['counter']; $i++){
			
			$insert = $db->insert('purchaseBills', array(
					'invoiceNumber' 	=> $_POST["invoiceNumber"],
					'bType' 			=> $_POST['billType'],
					'supplier' 			=> $_POST['stockist_name'],
					'date' 				=> $_POST['billDate'],
					'productName' 		=> $_POST["productName_$i"],
					'productQuantity' 	=> $_POST["productQuantity_$i"],
					'purchaseSize' 		=> $_POST["productSize_$i"],
					'productFree' 		=> $_POST["productFree_$i"],
					'tabQuantity' 		=> $_POST["tabQuantity_$i"],
					'batchNo' 			=> $_POST["batchNo_$i"],
					'expiryDate' 		=> $_POST["exDate_$i"],
					'purchaseRate' 		=> $_POST["purchaseRate_$i"],
					'discount' 			=> $_POST["discount_$i"],
					'vatAmount' 		=> $_POST["VAT_$i"],
					'VAT' 				=> $_POST["vatPer_$i"],
					'CST' 				=> $_POST["CST_$i"],
					'MRP' 				=> $_POST["MRP_$i"],
					'purchaseAmount' 	=> $_POST["productAmount_$i"]
				));

			if ($insert){

				/*
				 * If no errors calculate the new amount 
				 * of stock and update the inventory stored
				 * in "items" table
				*/

				$stock = $db->get('items', array("productName", '=', Input::get("productName_$i")))->first()['stock'];

				$revisedStock = (int)$stock + (int)Input::get("productSize_$i");

				$updateStock = $db->update('items', array(
						'productName', '=', Input::get("productName_$i")
					), array(
						'stock' => $revisedStock
					));

				if (!$updateStock){
					$message[] = "Error! There was problem updating the stock.";
				}
			}else{
				$message[] = "Error inserting " + Input::get("productName_$i") + " in the database!";
			}	

		}
		
		$insertInvoice = $db->insert('purchaseInvoice', array(
				'invoiceNumber'  => $_POST['invoiceNumber'],
				'purchaseEntry'  => $_POST['purchaseEntry'],
				'billDate' 		 => $_POST['billDate'],
				'supplier'		 => $_POST['stockist_name'],
				'cash_or_credit' => $_POST['cash_or_credit'],
				'creditNote' 	 => $_POST['creditNote'],
				'debitNote' 	 => $_POST['debitNote'],
				'discountPer' 	 => $_POST['overallDisc'],
				'discount' 		 => $_POST['totalDiscount'],
				'VAT' 			 => $_POST['vatOnBill'],
				'netAmount' 	 => $_POST['netAmnt']
			));

		if (!$insertInvoice){
			$message[] = "Error! Couldn't insert invoice details.";
		}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Purchase Invoice / Delivery Memo</title>
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
		<div class="col-md-12 top-menu">
			
			<?php
				if (count($message) > 0){
					foreach ($message as $msg){
						echo "<p class='alert alert-warning'>{$msg}</p>";
					}
				}
			?>

			<div class="col-md-6">
				<h2>Purchase Invoice / Delivery Memo</h2>
					
				<input type="data" id="datePicker" name="datePicker" style="visibility:hidden;">
			</div>
			<div class="col-md-6">
				<input type="reset" form="invoiceForm" id="reset" name="reset" class="btn btn-primary" value="Cancel">
				<input type="button" id="impBill" name="impBill" class="btn btn-primary" onclick="importBills();" value="Imp Bill">
				<input type="button" id="pendingDM" name="pendingDM" class="btn btn-primary" onclick="checkPendingDM();" value="Pending DM">
				<input type="button" id="convDM" name="convDM" class="btn btn-primary" value="Conv DM">
				<input type="submit" form="invoiceForm" id="saveInvoice" name="saveInvoice" onclick="checkAndSave();" class="btn btn-primary" value="Save">
				<a href="#" id="exit" name="exit" class="btn btn-primary">Exit</a>
			</div>
		</div>
		<br>
		<form action="" class="form" id="invoiceForm" method="POST">
			<div class="row col-md-12 form-top">
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="stockist_name" class="control-label">Supplier</label></span>
					<span class="col-md-9"><input type="text" id="stockist_name" name="stockist_name" list="stockist_list" class="form-control" oninput="getList('stockist_name', 'stockist_list')" autofocus></span>
					<datalist id="stockist_list"></datalist>
				</div>
				<div class="form-group col-md-1" id="cr/dr">
					0
				</div>
				<div class="form-group col-md-2">
					<span class="col-md-4"><label for="billType" class="control-label">BType</label></span>
					<span class="col-md-8">
						<select name="billType" id="billType" class="form-control">
							<option value="INV">INV</option>
							<option value="DM">DM</option>
						</select>
					</span>
				</div>
				<div class="form-group col-md-2">
					<span class="col-md-4"><label for="invoiceNumber" class="control-label">Inv/DM No.</label></span>
					<span class="col-md-8"><input type="text" id="invoiceNumber" name="invoiceNumber" class="form-control"></span>					
				</div>
				<div class="form-group col-md-3">
					<span class="col-md-2"><label for="billDate" class="control-label">Date</label></span>
					<span class="col-md-9"><input type="date" class="form-control" id="billDate" name="billDate" value="<?php echo date('Y-m-d'); ?>"></span>
				</div>
			</div>

			<div class="container-fluid" id="productEntry">
	
				<table class="table table-bordered">
					<thead>
						<td>Product Name</td>
						<td>Qty</td>
						<td>Free</td>
						<td>PrSize</td>
						<td>Tab Qty</td>
						<td>Batch</td>
						<td>Expiry</td>
						<td>Pr.Rate</td>
						<td>Disc</td>
						<td>VAT</td>
						<td>%</td>
						<td>CST</td>
						<td>MRP</td>
						<td>Amnt</td>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" name="productName_1" id="productName_1" class="form-control" list="drugList_1" oninput="getList('productName_1', 'drugList_1', true, true);">
									<datalist id="drugList_1"></datalist>
								</input>
							</td>
							<td><input type="number" name="productQuantity_1" id="productQuantity_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" name="productFree_1" id="productFree_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" name="productSize_1" id="productSize_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" name="tabQuantity_1" id="tabQuantity_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="text" name="batchNo_1" id="batchNo_1" class="form-control"></td>
							<td><input type="text" name="exDate_1" id="exDate_1" class="form-control month"></td>
							<td><input type="number" step="any" name="purchaseRate_1" id="purchaseRate_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" step="any" name="discount_1" id="discount_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" step="any" name="VAT_1" id="VAT_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" step="any" name="vatPer_1" id="vatPer_1" oninput="calculate(1);" class="form-control"></td>
							<td><input type="number" step="any" name="CST_1" id="CST_1" class="form-control"></td>
							<td><input type="number" step="any" name="MRP_1" id="MRP_1" class="form-control"></td>
							<td><input type="number" step="any" name="productAmount_1" id="productAmount_1" class="form-control"></td>
						</tr>
					</tbody>
				</table>

			</div>
			<input type="button" id="addField" name="addField" class="btn btn-primary" value="Next Entry">
			<input type="hidden" form="invoiceForm" id="counter" name="counter" value=2>
			<br>
			<div class="container-fluid" id="otherEntries">
				<div class="col-md-7">
					<div class="col-md-3">
						<label for="purchaseEntry" class="control-label">
							PurEntryNo.
						</label>
						<?php
							$purchaseEntry = DB::getInstance()->query("SELECT * FROM purchaseInvoice")->count();
						?>
						<input type="number" id="purchaseEntry" name="purchaseEntry" class="form-control" value="<?php echo $purchaseEntry; ?>">
					</div>
					<!-- <div class="col-md-2">
						<label for="shelf" class="control-label">
							Rack/Shelf
						</label>
						<input type="text" id="shelf" name="shelf" class="form-control">
					</div> -->
					<div class="col-md-3">
						<label for="net" class="control-label">
							Net Amnt
						</label>
						<input type="number" step="any" id="net" name="net" class="form-control">
					</div>
					<div class="col-md-2">
						<label for="overallDisc" class="control-label">
							Disc%
						</label>
						<input type="number" step="any" value=0 id="overallDisc" name="overallDisc" oninput="changeDiscount();" class="form-control">
					</div>
					<div class="col-md-3">
						<label for="cash_or_credit" class="control-label">
							Cash/Credit
						</label>
						<input type="text" id="cash_or_credit" name="cash_or_credit" list="option" class="form-control">
						<datalist id="option">
							<option>C-Cash</option>
							<option>R-Credit</option>
						</datalist>
					</div>
					<div class="col-md-10">
						<label for="message" class="control-label">
							NARATION / PARTICULARS 
						</label>
						<textarea name="message" id="message" rows="1" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-md-5">
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalAmnt">Total Amount :</label>
						</span>
						<span class="col-md-7">
							<input type="number" step="any" id="totalAmnt" name="totalAmnt" class="form-control">
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalDiscount">Discount :</label>
						</span>
						<span class="col-md-7">
							<input type="number" value=0.0 step="any" id="totalDiscount" name="totalDiscount" class="form-control">
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="creditNote">Credit Note :</label>
						</span>
						<span class="col-md-7">
							<input type="number" step="any" id="creditNote" name="creditNote" class="form-control" onfocus="checkCredit();">
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="debitNote">Debit Note :</label>
						</span>
						<span class="col-md-7">
							<input type="number" step="any" id="debitNote" name="debitNote" class="form-control">
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="vatOnBill">VAT</label>
						</span>
						<span class="col-md-7">
							<input type="number" step="any" id="vatOnBill" name="vatOnBill" class="form-control">
						</span>
					</div>
					<div class="col-md-12">
						<span class="col-md-4">
							<label for="netAmnt">Net Amount</label>
						</span>
						<span class="col-md-7">
							<input type="number" step="any" id="netAmnt" name="netAmnt" value="0" class="form-control">
						</span>
					</div>
				</div>
			</div>

		</form>

	</section>

	<div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
				...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="billsDates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<h4>Please Select Date of the bill</h4>
					<input type="date" id="bill_date" class="form-control" name="bill_date" autofocus>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="importBills();">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="pendingBillsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2>PharmaSoft</h2>
				</div>
				<div class="modal-body display_dm">
					<h3>There are no pending DM's of this supplier!</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>

	<?php require_once 'templates/modals.php'; ?>

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
			        if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "/"; //Add colon if string length > 2 and string is a number 
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
					'id': 'productQuantity',
					'name': 'productQuantity',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'3': [{
					'tag': 'input',
					'type': 'number',
					'id': 'productFree',
					'name': 'productFree',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'4': [{
					'tag': 'input',
					'type': 'number',
					'id': 'productSize',
					'name': 'productSize',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'5': [{
					'tag': 'input',
					'type': 'number',
					'id': 'tabQuantity',
					'name': 'tabQuantity',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'6': [{
					'tag': 'input',
					'type': 'text',
					'id': 'batchNo',
					'name': 'batchNo',
					'class': 'form-control'
				}],
				'7': [{
					'tag': 'input',
					'type': 'text',
					'id': 'exDate',
					'name': 'exDate',
					'class': 'form-control month'
				}],
				'8': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'purchaseRate',
					'name': 'purchaseRate',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'9': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'discount',
					'name': 'discount',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'10': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'VAT',
					'name': 'VAT',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'11': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'vatPer',
					'name': 'vatPer',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'12': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'CST',
					'name': 'CST',
					'class': 'form-control',
					'oninput': 'calculate('+counter+');'
				}],
				'13': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',
					'id': 'MRP',
					'name': 'MRP',
					'class': 'form-control'
				}],
				'14': [{
					'tag': 'input',
					'type': 'number',
					'step': 'any',	
					'id': 'productAmount',
					'name': 'productAmount',
					'class': 'form-control'
				}]
			};
			generateFields('invoiceForm', inputFiled, counter);

			getTotal(counter);

			$('#productName_'+counter).focus();

			counter++;
			$('#counter').val(counter);

			changeDiscount();

		});


		//Check the Net Amount on invoice and Net Amount on purchase entry
		function checkAndSave(){
			var netAmount = parseFloat($('#netAmnt').val());
			var amountToCheck = parseFloat($('#net').val());

			console.log(counter);

			//if both values are same proceed to calculate the total and save
			if (netAmount == amountToCheck){
				$('#hidden').val(counter);
				getTotal(counter);
				alert('Saving Invoice!');
			}else{
				alert('Amounts do not match!');	
			}
			
		}

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

		function checkPendingDM(){

			if ($('#stockist_name').val() !== ''){
				console.log($('#stockist_name').val());
				$.ajax({
					type: 'post',
					url: 'functions/otherFunctions.php',
					data: {option: 'DM', supplier: $('#stockist_name').val()},
					success: function(data){
						if (data == "0"){
							alert("There are no pending DM's");
						}else{
							$('.display_dm').html(data);
							$('#pendingBillsModal').modal();
						}
					}
				});
			}else{
				alert("Please provide supplier name!");
			}
		}

		function importBills(){
			//import previous saved bills
			
			var count = 1;
			var supplierName = $('#stockist_name').val();
			
			if (supplierName != ''){
				
				$('#billsDates').modal();
				
				if ($('#bill_date').val() !== ''){
					$.ajax({
						type: 'post',
						url: 'functions/otherFunctions.php',
						//dataType: 'JSON',
						data: {supplier: supplierName, date: $('#bill_date').val(), option: 'importBills'},
						success: function(data){
							if (data == 0){
								$('#pendingBillsModal').modal();
							}else{
								$('tbody').html(data);
								counter = <?php echo $GLOBALS['counter']; ?>;
								console.log(counter);
							}
						}
					});
				}
			}else{
				alert("Enter supplier name");
			}

		}


	</script>

</body>
</html>