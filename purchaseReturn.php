<?php
	require_once('core/init.php');

	$msg = [];

	if (Input::exists()){
		$db = DB::getInstance();

		$return = $db->insert('purchaseReturn', array(
				'supplier' 	  => Input::get('stockist_name'),
				'bType' 	  => Input::get('billType'),
				'loss' 		  => Input::get('invoiceLoss'),
				'invoiceNo'   => Input::get('invoiceNumber'),
				'invoiceDate' => Input::get('billDate'),
				'product' 	  => Input::get('product'),
				'status' 	  => Input::get('Status'),
				'amount' 	  => Input::get('totalAmnt'),
				'narration'   => Input::get('message')
			));
		if ($return){
			$stockReturned = $db->query("SELECT * FROM purchaseBills WHERE productName = ? AND supplier = ? ", 
							array(Input::get('product'), Input::get('stockist_name')))->first()['tabQuantity'];

			$totalStock = $db->get('items', array('productName', '=', Input::get('product')))->first()['stock'];

			$revisedStock = (int)$totalStock - (int)$stockReturned;

			$deleteStock = $db->update('items', array(
						'productName', '=', Input::get('product')
						), array(
						'stock', '=', $revisedStock
						));

			if ($deleteStock){
				$msg[] = "Done!";
			}else{
				$msg[] = "Unable to update revised value of drug";
			}
		}else{
			$msg[] = "Error! Unable to carry the request!";
		}
		
	}

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Expiry / Pur Return / Breakage</title>
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

		<?php
			if (count($msg) > 0){
				foreach ($msg as $message){
					echo "<p class='alert alert-info'>{$message}</p>";
				}
			}
		?>

		<div class="col-md-12">
			<div class="col-md-5">
				<h2>Expiry/ PurReturn/ Breakage</h2>
			</div>
			<div class="col-md-7">
				<input type="reset" form="purchaseReturnForm" id="reset" name="reset" class="btn btn-primary" value="Cancel">
				<input type="button" id="showItems" name="showItems" class="btn btn-primary" value="showItems">
				<input type="button" id="Expiry" name="Expiry" class="btn btn-primary" value="Expiry">
				<input type="button" id="Delete" name="Delete" class="btn btn-primary" value="Delete">
				<input type="button" id="Modify" name="Modify" class="btn btn-primary" value="Modify">
				<input type="button" id="RePrn" name="RePrn" class="btn btn-primary" value="RePrn">
				<input type="submit" form="purchaseReturnForm" id="saveInvoice" name="saveInvoice" onclick="checkAndSave();" class="btn btn-primary" value="Save">
				<a href="#" id="exit" name="exit" class="btn btn-primary">Exit</a>
			</div>
		</div>
		<br>
		<form action="" class="form" id="purchaseReturnForm" method="POST">
			<div class="row col-md-12 form-top return-form">
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="stockist_name" class="control-label">Supplier</label></span>
					<span class="col-md-8"><input type="text" id="stockist_name" name="stockist_name" list="stockist_list" class="form-control" oninput="getList('stockist_name', 'stockist_list')" autofocus></span>
					<datalist id="stockist_list"></datalist>
				</div>
				
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="billType" class="control-label">BType</label></span>
					<span class="col-md-8">
						<select name="billType" id="billType" class="form-control">
							<option value="Breakage">Breakage</option>
							<option value="Destroy">Destroy</option>
							<option value="Expiry">Expiry</option>
							<option value="Return">Return</option>
						</select>
					</span>
				</div>
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="invoiceLoss" class="control-label">Loss %</label></span>
					<span class="col-md-4"><input type="number" step="any" id="invoiceLoss" name="invoiceLoss" class="form-control"></span>					
				</div>
			</div>
			<div class="row col-md-12 return-form">
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="invoiceNumber" class="control-label">InvNo.</label></span>
					<span class="col-md-4"><input type="number" id="invoiceNumber" name="invoiceNumber" class="form-control"></span>					
				</div>
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="billDate" class="control-label">Date</label></span>
					<span class="col-md-8"><input type="date" class="form-control" id="billDate" name="billDate" value="<?php echo date('Y-m-d'); ?>"></span>
				</div>
				<div class="col-md-12"></div>
			</div>

			<div class="row col-md-12 return-form">
				<div class="form-group col-md-4">
					<span class="col-md-3"><label for="product" class="control-label">Product</label></span>
					<span class="col-md-8"><input type="text" id="product" name="product" list="product_list" class="form-control" oninput="getProduct('product', 'product_list', true, true)" autofocus></span>
					<datalist id="product_list"></datalist>
				</div>
			</div>
				
			<div class="container-fluid col-md-12" id="product_return_list">
				<table class="table table-bordered">
					<thead>
						<td>Mfg</td>
						<td>Product</td>
						<td>Pack</td>
						<td>Batch No.</td>
						<td>Qty</td>
						<td>PR</td>
						<td>MRP</td>
						<td>Expiry</td>
						<td>Disc</td>
						<td>Schm</td>
						<td>Amnt</td>
						<td>VAT</td>
						<td>VAT%</td>
						<td>SCode</td>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			
			<div class="container-fluid col-md-12" id="otherEntries">
				<div class="col-md-7">
				<!--	<div class="col-md-3">
						<label for="purchaseEntry" class="control-label">
							PurEntryNo.
						</label>
						<input type="number" id="purchaseEntry" name="purchaseEntry" class="form-control">
					</div>-->
					<!-- <div class="col-md-2">
						<label for="shelf" class="control-label">
							Rack/Shelf
						</label>
						<input type="text" id="shelf" name="shelf" class="form-control">
					</div> -->
					<!-- <div class="form-group col-md-4">
					<span class="col-md-3"><label for="invoiceNumber" class="control-label">InvNo.</label></span>
					<span class="col-md-4"><input type="text" id="invoiceNumber" name="invoiceNumber" class="form-control"></span>					
				</div> -->
				<!--	<div class="col-md-2">
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
					</div> -->
					<div class="col-md-10">
						<label for="message" class="control-label">
							NARATION : 
						</label>
						<textarea name="message" id="message" rows="1" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-md-5">
				<div class="col-md-12">
						<span class ="col-md-4">
							<label for ="Status">Status :</label>
						</span>

						<span class="col-md-7">
						<select name="Status" id="Status" class="form-control">
							<option value="Creditable">Creditable</option>
							<option value="NonCreditable">NonCreditable</option>
							
						</select>
					</span>
				</div>	

					<div class="col-md-12">
						<span class="col-md-4">
							<label for="totalAmnt">Amount :</label>
						</span>
						<span class="col-md-7">
							<input type="number" step="any" id="totalAmnt" name="totalAmnt" class="form-control">
						</span>
					</div>

					

				<!--	<div class="col-md-12">
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
				</div>-->
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


	<script src="script/generateFields.js"></script>
	<script src="script/common.js"></script>
	<script src="script/bootstrap.min.js"></script>

	<script>

		var count = 1;

		function getProduct(id, list){
			$.ajax({
				url: 'functions/otherFunctions.php',
				type: 'post',
				data: {product: $('#'+id).val(), option: 'purchaseTable'},
				success: function(data){
					if (data != 0){
						console.log(data);
						insertToTable(count);
					}
				}
			});
		}

		function insertToTable(count){
			
			$.ajax({
				url: 'functions/otherFunctions.php',
				type: 'post',
				data: {product: $('#stockist_name').val(), option: 'insertToTable', count: count},
				success: function(data){
					if(data !== '0'){
						$("tbody").append(data);
						calculate(count);
						count++;
					}
				}
			});
			
		}

		function calculate(count){
			var amount = 0;
			var mrpvalue = 0;
			for(var i = 1; i <= count; i++){
				amount += parseFloat($('#amnt_'+i).val());
				
				// mrpvalue += mrp - ( (dis + scheme) * mrp );
				mrpvalue += parseFloat($('#mrp_'+i).val()) - ( ( ( parseFloat($('#dsc_'+i).val) / 100 ) + ( parseFloat($('#schm').val()) / 100) )
							* parseFloat($('#mrp_'+i).val()) );
			}
			// TODO
			// Replace data in "narration" and "Amount" field with updated data
			$('#totalAmnt').val(amount);
			$('#narration').val("");
		}


	</script>

</body>
</html>