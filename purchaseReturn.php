<?php
	require_once('core/init.php');

	$msg = [];

	if (Input::exists()){
		$db = DB::getInstance();
		$data = [];

		for($i = 1; $i <= Input::get('counter'); $i++){
			$data[Input::get("name_$i")] = array(
					'batchNo' => $_POST["batch_$i"],
					'expiry_date' => Input::get("exp_$i"),
					'return_value' => Input::get("sendQuantity_$i"),
					'amount' => Input::get("amnt_$i")
				);
		}

		$return = $db->insert('purchaseReturn', array(
				'supplier' 	  		  => Input::get('stockist_name'),
				'bType' 	  		  => Input::get('billType'),
				'loss' 		 		  => Input::get('invoiceLoss'),
				'invoiceNo'   		  => Input::get('invoiceNumber'),
				'invoiceDate' 		  => Input::get('billDate'),
				'product_details' 	  => json_encode($data),
				'status' 	  		  => Input::get('Status'),
				'amount' 	  		  => Input::get('totalAmnt'),
				'narration'   		  => Input::get('message')
			));
		
		if ($return){
			for($i = 1; $i <= Input::get('counter'); $i++):
				$stock = $db->query("SELECT * FROM purchaseBills WHERE productName = ? AND supplier = ? AND batchNo = ? ", 
								array(Input::get("name_$i"), Input::get('stockist_name'), Input::get("batch_$i")));

				//$totalStock = $db->get('items', array('productName', '=', Input::get('product')))->first()['stock'];

				$revisedStock = (int)$stock->first()['tabQuantity'] - (int)Input::get("sendQuantity_$i");

				$deleteStock = $db->query("UPDATE purchaseBills SET tabQuantity = ? WHERE productName = ? AND supplier = ? AND batchNo = ?", 
					array($revisedStock, Input::get("name_$i"), Input::get('stockist_name'), Input::get("batch_$i")));

				if ($deleteStock){
					$msg[] = "Done!";
				}else{
					$msg[] = "Unable to update revised value of drug";
				}
			endfor;
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
	<!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"> -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/invoice.css">
	
	<script src="script/jquery-min.js"></script>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script src="script/jquery.mtz.monthpicker.js"></script>-->

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

			if (Input::exists('get')){
				if (Input::get('flag') == 1){
					echo "<p class='alert alert-info'>Bill Updated</p>";
				}else{
					echo "<p class='alert alert-info'>Error! Please try again</p>";
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
				<input type="button" id="Modify" name="Modify" class="btn btn-primary" value="Modify" onclick="show_previous_return();">
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
					<span class="col-md-8"><input type="text" id="product" name="product" list="product_list" class="form-control" oninput="detailsModal('product');"  autofocus></span> <!-- oninput="getProduct('product', 'product_list', true, true)" -->
					<datalist id="product_list"></datalist>
				</div>
			</div>
				
			<div class="container-fluid col-md-12" id="product_return_list">
				<table class="table table-bordered">
					<thead>
						<td>Product</td>
						<td>Mfg</td>
						<td>Send Qt</td>
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
					<tbody id="product_details"></tbody>
				</table>
			</div>
			<input type="hidden" id="counter" name="counter" value=1>
			<div class="container-fluid col-md-12" id="otherEntries">
				<div class="col-md-7">
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

	<?php require_once 'templates/productList.php'; ?>
	<?php require_once 'templates/return_invoice.php'; ?>

	<script src="script/generateFields.js"></script>
	<script src="script/common.js"></script>
	<script src="script/bootstrap.min.js"></script>
	<script src="script/navigate.js"></script>
	<script src="script/detailsModal.js"></script>

	<script>

		var count = 1;

		function getProduct(id, list){
			$.ajax({
				url: 'functions/otherFunctions.php',
				type: 'post',
				data: {
					product: $('#'+id).val(), 
					option: 'purchaseTable'
				},
				success: function(data){
					if (data != 0){
						console.log(data);
						insertToTable(count);
					}else{
						console.log(data);
					}
				}
			});
		}

		function insertToTable(batch){
			console.log("Insert = > "+batch);
			$.ajax({
				url: 'functions/otherFunctions.php',
				type: 'post',
				dataType: 'json',
				data: {
					product: $('#product').val(), 
					batchNo: batch,
					return_type: $('#billType').val(),
					option: 'insertToTable', 
					count: count
				},
				success: function(data){
					if(data !== '0'){
						var flag = true;
						if ($('#stockist_name') != data.supplier){					
							flag = confirm("The product is not from the selected supplier");
						}

						if (flag == false){
							return false;
						}

						$("tbody").append(data.list);
						$('#product').val("");
						$('#product').focus();
						console.log(data);
						$('#counter').val(count);
						count++;
					}
				}
			});
			
		}

		function calculate(count){
			console.log(count);
			var amount = 0;
			var mrpvalue = 0;
			//console.log($("input[id='pack_"+count+"']").val());
			var amnt = ( ( parseFloat($("input[id='pack_"+count+"']").val()) * parseInt($("input[id='qty_"+count+"']").val()) ) * parseFloat($("input[id='pr_"+count+"']").val()) ) + parseFloat($("input[id='vatAmnt_"+count+"']").val());
			var resp_amount  = parseFloat($("input[id='sendQuantity_"+count+"']").val() / ($("input[id='pack_"+count+"']").val() * $("input[id='qty_"+count+"']").val())) * amnt;
			console.log(resp_amount);
			$("input[id='amnt_"+count+"']").val(Math.round(resp_amount));
			count = $('#product_return_list table tbody tr').length;
			for(var i = 1; i <= count; i++){
				var amnt = ( ( parseFloat($("input[id='pack_"+i+"']").val()) * parseInt($("input[id='qty_"+i+"']").val()) ) * parseFloat($("input[id='pr_"+i+"']").val()) ) + parseFloat($("input[id='vatAmnt_"+i+"']").val());
				amount += parseFloat($("input[id='sendQuantity_"+i+"']").val() / ($("input[id='pack_"+i+"']").val() * $("input[id='qty_"+i+"']").val())) * parseFloat(amnt);
				console.log(amount);
				// mrpvalue += mrp - ( (dis + scheme) * mrp );
				mrpvalue += parseFloat($('#mrp_'+i).val()) - ( ( ( parseFloat($('#dsc_'+i).val()) / 100 ) + ( parseFloat($('#schm').html() !== '' ? 0.0 : $('#schm').html()) / 100) )
							* parseFloat($('#mrp_'+i).val()));
			}

			// Replace data in "narration" and "Amount" field with updated data
			$('#totalAmnt').val(Math.round(amount));
			//$('#narration').val("");
		}

		function show_previous_return(){
			// Display previous purchase return invoice within a modal
			// Open selected invoice to modify
			$('#return_bills').val("return_invoice");
			$('#return_invoice').modal();
		}

	</script>

</body>
</html>