<?php
	require_once('core/init.php');
	
	$message = [];
	$mrp_total = 0;

	if (Input::exists()){
		
		$db = DB::getInstance();
		$check = $db->get('purchaseInvoice', array('invoiceNumber', '=', Input::get('invoiceNumber')));
		if ($check->count() > 0){
			if (Input::get('modify') == 'true'){
				//print_r($_POST);
				for($i = 1; $i < Input::get('counter'); $i++){
				$update = $db->query("UPDATE purchaseBills SET 
						productName 		= ?,
						productQuantity 	= ?,
						purchaseSize 		= ?,
						productFree 		= ?,
						tabQuantity 		= ?,
						batchNo 			= ?,
						expiryDate 		= ?,
						purchaseRate 		= ?,
						discount 			= ?,
						vatAmount 		= ?,
						VAT 				= ?,
						CST 				= ?,
						MRP 				= ?,
						purchaseAmount 	= ?
						WHERE invoiceNumber = ? AND batchNo = ?", array(
								$_POST["productName_$i"],
								$_POST["productQuantity_$i"],
								$_POST["productSize_$i"],
								$_POST["productFree_$i"],
								$_POST["tabQuantity_$i"],
								$_POST["batchNo_$i"],
								$_POST["exDate_$i"],
								$_POST["purchaseRate_$i"],
								$_POST["discount_$i"],
								$_POST["VAT_$i"],
								$_POST["vatPer_$i"],
								$_POST["CST_$i"],
								$_POST["MRP_$i"],
								$_POST["productAmount_$i"],
								Input::get("invoiceNumber"),
								Input::get("batchNo_$i")
							));	

				$mrp_total += $_POST["MRP_$i"];
				
				// $update = $db->update('purchaseBills', array('invoiceNumber', '=', Input::get('invoiceNumber')), array(
				// 		'invoiceNumber' 	=> $_POST["invoiceNumber"],
				// 		'bType' 			=> $_POST['billType'],
				// 		'supplier' 			=> $_POST['stockist_name'],
				// 		'date' 				=> $_POST['billDate'],
				// 		'productName' 		=> $_POST["productName_$i"],
				// 		'productQuantity' 	=> $_POST["productQuantity_$i"],
				// 		'purchaseSize' 		=> $_POST["productSize_$i"],
				// 		'productFree' 		=> $_POST["productFree_$i"],
				// 		'tabQuantity' 		=> $_POST["tabQuantity_$i"],
				// 		'batchNo' 			=> $_POST["batchNo_$i"],
				// 		'expiryDate' 		=> $_POST["exDate_$i"],
				// 		'purchaseRate' 		=> $_POST["purchaseRate_$i"],
				// 		'discount' 			=> $_POST["discount_$i"],
				// 		'vatAmount' 		=> $_POST["VAT_$i"],
				// 		'VAT' 				=> $_POST["vatPer_$i"],
				// 		'CST' 				=> $_POST["CST_$i"],
				// 		'MRP' 				=> $_POST["MRP_$i"],
				// 		'purchaseAmount' 	=> $_POST["productAmount_$i"]
				// 	));

				if ($update){

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
			}else{
				$message[] = "This bill is already saved!";	
			}
		}else{
		
			for($i = 1; $i < Input::get('counter'); $i++){
			
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
				$mrp_total += $_POST["MRP_$i"];

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
					'netAmount' 	 => $_POST['netAmnt'],
					'balance'		 => ($_POST['cash_or_credit'] == 'C-Cash') ? 0 : $_POST['netAmnt'],
					'mrp_total'		 => $mrp_total
				));

			if (!$insertInvoice){
				$message[] = "Error! Couldn't insert invoice details.";
			}
		}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Purchase Invoice / Delivery Memo</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/invoice.css">
	
	<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>-->
	<!--<script src="script/jquery.mtz.monthpicker.js"></script>-->

	<!--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">-->
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
					
				<input type="date" id="datePicker" name="datePicker" style="visibility:hidden">
			</div>
			<div class="col-md-6">
				<a href="<?php echo $_SERVER['PHP_SELF']; ?>" form="invoiceForm" id="reset" name="reset" class="btn btn-primary">Cancel</a>
				<input type="button" id="impBill" name="impBill" class="btn btn-primary" onclick="importBills();" value="Imp Bill">
				<input type="button" id="pendingDM" name="pendingDM" class="btn btn-primary" onclick="checkPendingDM(true);" value="Pending DM">
				<!-- <input type="button" id="convDM" name="convDM" class="btn btn-primary" value="Conv DM"> -->
				<input type="submit" form="invoiceForm" id="saveInvoice" name="saveInvoice" onclick="checkAndSave();" class="btn btn-primary" value="Save">
				<a href="#" id="exit" name="exit" class="btn btn-primary">Exit</a>
			</div>
		</div>
		<br>
		<form action="" class="form" id="invoiceForm" method="POST">
			<div class="row col-md-12 form-top">
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="stockist_name" class="control-label">Supplier</label></span>
					<span class="col-md-9"><input type="text" id="stockist_name" name="stockist_name" list="stockist_list" class="form-control" oninput="getList('stockist_name', 'stockist_list')" autofocus required></span>
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
						<td>Pack Size</td>
						<td>Free</td>
						<td>Quantity</td>
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
					<tbody id="billContent">
						<tr>
							<td>
								<input type="text" name="productName_1" id="productName_1" class="form-control product_names" list="drugList_1" oninput="detailsModal('productName_1');"> 	<!-- getList('productName_1', 'drugList_1', true, true); -->
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
			<input type="hidden" id="modify" name='modify' value="false">
			<br>
			<div class="container-fluid" id="otherEntries">
				<div class="col-md-7">
					<div class="col-md-3">
						<label for="purchaseEntry" class="control-label">
							PurEntryNo.
						</label>
						<?php
							$purchaseEntry = DB::getInstance()->query("SELECT * FROM purchaseInvoice")->count() + 1;
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
						<input type="text" id="cash_or_credit" name="cash_or_credit" list="option" class="form-control" required>
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
							<input type="number" value=0.0 step="any" id="debitNote" name="debitNote" class="form-control" oninput="addDebit();">
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
		<div class="modal-dialog modal-lg container" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Purchase Return Bills</h4>

					<input type="hidden" id="credit_show" name="credit_show" />
					<div class="container col-md-12 details-table credit-bills-div">
						<table class="table table-bordered table-condensed">
							<thead>
								<td>Select</td>
								<td>Inv No.</td>
								<td>Date</td>
								<td>Amnt</td>
								<td>Balance</td>
								<td>Loss</td>
								<td>Btype</td>
								<td>Year</td>
								<td>Narration</td>								
							</thead>
							<tbody class="credit-bills"></tbody>
						</table>
					</div>
					<div class="return_product_table">
						<table class="table table-bordered table-condensed">
							<thead>
								<td>MFG</td>
								<td>Product</td>
	 							<td>Pack</td>
	 							<td>Batch</td>
	 							<td>Pr Rate</td>
	 							<td>MRP</td>
	 							<td>QTY</td>
	 							<td>Amnt</td>
	 							<td>PinvNo</td>
	 							<td>Select</td>
							</thead>
							<tbody id="return_products_list"></tbody>
						</table>
					</div>
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
	<?php require_once 'templates/productList.php'; ?>


	<script src="script/jquery-min.js"></script>
	<script src="script/generateFields.js"></script>
	<script src="script/bootstrap.min.js"></script>
	<script src="script/save.js"></script>
	<script src="script/navigate.js"></script>
	<script src="script/common.js"></script>

	<script>

		// $('#purchaseEntry').focus({
		// 	$('#purchaseEntry').on('keypress', function(e){
		// 		if(e.which == 13)
		// 			convert_to_INV(0, $('#purchaseEntry'.val()));
		// 	});
		// })

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
					'class': 'form-control product_names',
					'oninput': "detailsModal('productName_"+counter+"');",
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
		$('#invoiceForm').submit(function(e){
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
				return false;
			}
			
		});

		//function that will update discount value in every row of inputs

		window.changeDiscount = function(){
			for(var i=1; i < counter; i++){
				$('#discount_'+i).val(parseFloat($('#overallDisc').val()).toFixed(2));
				//console.log(i);
			}
			calculate(counter);
		};

		window.getData = function(id, drug, batchNo, bill){
			//var drug = $('#productName'+id).val();
			var drug = (drug == undefined || drug == '') ? $('#productName'+id).val() : drug;
			// console.log("Drug "+drug);
			// console.log($('#productName'+id).val());

			$.ajax({
				type: 'post',
				url: 'functions/purchaseFunctions.php',
				dataType: 'json',
				data: {
					drug: drug,
					batchNo: batchNo,
					where: bill,
					access: 'insertData'
				},
				success: function(data){
					//console.log(data);
					$('#productQuantity'+id).val(data.quantity);
					$('#purchaseRate'+id).val(data.purchaseRate);
					$('#batchNo'+id).val(data.batchNo);
					$('#exDate'+id).val(data.expiryDate);
					$('#vatPer'+id).val(data.VAT);
					$('#MRP'+id).val(data.MRP);
					//console.log(data.batchNo);
				}
			});
		}

		window.calculate = function(count){
			console.log("Counter"+counter);
			console.log("Product Size"+$('#productSize_'+count).val());
			var temp = counter;
			if (count){
				counter = count;
			}
			
			var quantity = $('#productQuantity_'+count+'').val();
			console.log("Quantity "+ quantity);
			var productSize = $('#productSize_'+count+'').val();
			console.log("productSize "+ productSize);
			var productAmount = 0.0;
			if ($('#productFree_'+count).val() !== ''){
				console.log("here");
				productSize = parseInt(productSize) + parseInt($('#productFree_'+count).val());
				//console.log("NEw Quantity "+quantity);
			}
			//console.log(quantity + " " + productSize);
			var tabs = quantity * productSize;
			console.log(tabs);
			//console.log(tabs);
			var discount = $('#discount_'+count).val();
			if (discount == ""){
				console.log("yes");
				discount = 0.0;
			}

			//console.log("Discount "+ discount);

			//calculating discount
			discount = (parseFloat(discount) / 100) 
							* (parseFloat($('#productQuantity_'+count).val()) * parseFloat($('#purchaseRate_'+count).val()));
			//console.log("DISCOUNT -> "+discount);

			
			//console.log("Discount "+ discount);
			productAmount = (parseFloat($('#purchaseRate_'+count).val()) * parseFloat(productSize));

			//calculating VAT
			console.log("vAT PER"+parseFloat($('#vatPer_'+count).val()) / 100);
			var VAT = ( (parseFloat($('#productSize_'+count).val()) * parseFloat($('#purchaseRate_'+count).val())) - discount ) * ( parseFloat($('#vatPer_'+count).val()) / 100 );
			//console.log("VAT -> "+VAT);


			// Calculate total amount after each entry
			var grandTotal = 0;
			for (var i = 1; i <= counter; i++){
				// Calculate total amount minus the discount
				grandTotal += parseFloat($('#purchaseRate_'+i).val()) * parseFloat($('#productSize_'+i).val());
				//console.log("total amount"+grandTotal);
			}

			$('#totalAmnt').val(grandTotal.toFixed(2));

			$('#VAT_'+count).val(VAT.toFixed(2));

			$('#tabQuantity_'+count).val(tabs);

			$('#productAmount_'+count).val(productAmount.toFixed(2));
			//console.log("counter = "+temp);
			getTotal(temp);
			counter = temp;
		};

		window.getTotal = function(counter){
			counter = $('#productEntry table tbody tr').length + 1;
			console.log("getTotal"+counter);
			$('#counter').val(counter);
			//Insert the discount value to the newly created row
			var totalDiscount = parseFloat($('#totalDiscount').val());
			//$('#discount_'+counter).val(totalDiscount.toFixed(2));
			
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


				//totalVat += parseFloat($('#VAT_'+i).val());
				// Get productAmount
				var product_amount = parseFloat($('#productAmount_'+i).val());

				// Get discount
				var dis = (parseFloat($('#discount_'+i).val()) / 100.00) * product_amount;

				// Get productAmount after discount
				product_amount = product_amount - dis;

				// Get vat value
				totalVat += (parseFloat($('#vatPer_'+i).val()) / 100) * product_amount;
				console.log("productAMount = "+product_amount+" Discout = "+dis+"VAT value = "+totalVat);
				var discount = $('#discount_'+i).val();
				if (discount == ""){
					discount = 0.0;
				}
				totalDiscount += (parseFloat(discount) / 100) 
							* (parseFloat($('#productSize_'+i+'').val()) * parseFloat($('#purchaseRate_'+i).val()));

				//console.log(totalVat+"  "+totalDiscount);
			}

			$('#totalDiscount').val(totalDiscount.toFixed(2));
			//totalVat = netAmnt - totalDiscount * ($('#'));
			$('#vatOnBill').val(totalVat.toFixed(2));

			var debit = parseFloat($('#debitNote').val()).toFixed(2);
			console.log(debit);

			netAmnt = parseFloat(netAmnt - totalDiscount) + parseFloat(totalVat);
			//console.log(netAmnt);
			netAmnt += parseFloat(debit);
			netAmnt -= parseFloat($('#creditNote').val() != '' ? $('#creditNote').val() : 0.0);


			$('#netAmnt').val(Math.round(parseFloat(netAmnt).toFixed(2)));
			
		};

		// Function to check if there are any due on the supplier
		// if yes display a modal with credit details
		function checkCredit(){
			var supplier = $('#stockist_name').val();
			console.log(supplier);
			$('#credit_show').val("true");
			if(supplier !== ''){
				$.ajax({
					url: 'functions/otherFunctions.php',
					type: 'post',
					data: {
						supplier: $('#stockist_name').val(),
						option: 'checkCredit'
					},
					success: function(data){
						$('.credit-bills').html(data);
						$('#return_products_list').html("");
						$('#credit-bills-div table tbody').html("");
						$('#creditModal').modal();
					}
				});
			}
		}

		function checkPendingDM(check){

			if ($('#stockist_name').val() !== ''){
				console.log($('#stockist_name').val());
				$.ajax({
					type: 'post',
					url: 'functions/otherFunctions.php',
					data: {option: 'DM', supplier: $('#stockist_name').val()},
					success: function(data){
						if (data == "0"){
							(check == true) ? alert("There are no pending DM's") : false;
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

		window.addDebit = function(){
			var debit = parseFloat($('#debitNote').val());
			if ($('#debitNote').val() == ''){
				debit = 0.0;
				getTotal(counter);
			}
			getTotal(counter);
			/*var netAmnt = parseFloat($('#netAmnt').val());
			var total = debit + netAmnt;
			$('#netAmnt').val(total.toFixed(2));*/
		}

		$('#invoiceNumber').keydown(function(e){
			if (e.which == 13 && $('#modify').val() == 'false'){
				$.ajax({
					url: 'functions/otherFunctions.php',
					type: 'post',
					data: {
						supplier: $('#stockist_name').val(),
						invoice: $('#invoiceNumber').val(),
						option: 'check_invoice'
					},
					success: function(data){
						if(data == 'true'){
							alert('Invoice can not be repeated for same supplier');
							$('#invoiceNumber').val("");
							$('#invoiceNumber').focus();
						}
					}
				});
			}else if(e.which == 13 && $('#modify').val() == 'true'){
				convert_to_INV($('#invoiceNumber').val());
			}
		});
	</script>
	<script src="script/detailsModal.js"></script>
</body>
</html>