<?php 
require_once '../core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payment</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/accounts.css">
</head>
<body>
<?php require_once 'templates/header.php' ?>
<div class="container">
	<form action="">
		<div class="row">
			<div class="col-md-4 well payment-form">
				<div class="form-group">
					<label for="stokist_name">Stockist</label>
					<input type="text" id="stockist_name" name="stockist_name" list="stockist_name_list" class="form-control" oninput="generatePaymentDetails();">
					<datalist id="stockist_name_list"></datalist>
				</div>
				<div class="form-group">
					<label for="bank">Pay by</label>
					<select name="bank" id="bank" class="form-control">
						<option>H.D.F.C. BANK NAGPUR</option>
					</select>
				</div>
				<div class="form-group">
					<h5 class="text-muted">Check Details</h5>
					<label for="check_no">Check Number</label>
					<input type="number" id="check_no" name="check_no" class="form-control">
				</div>
				<div class="form-group">
					<label for="check_date">Check Date</label>
					<input type="date" id="check_date" name="check_date" class="form-control">
					<hr/>
				</div>
				<div class="form-group">
					<label for="total_amount">Total Amount</label>
					<input type="number" step="any" id="total_amount" name="total_amount"class="form-control">
				</div>
				<div class="form-group">
					<label for="amount_paid">Amount Paid</label>
					<input type="number" step="any" id="amount_paid" name="amount_paid" class="form-control">
				</div>
				<br>
				<div class="form-group">
					<input type="button" name="submit" id="submit" value="Pay" class="btn btn-primary" onclick="makePayment();">
					<input type="button" name="submit" id="modify" value="Modify" class="btn btn-primary" onclick="modifyPayment();">
					<input type="reset" name="reset" id="reset" value="Cancel" class="btn btn-warning">
					<span>Voucher No. : <b id="v_no"><?php echo DB::getInstance()->query("SELECT * FROM supplier_payment")->count() + 1; ?></b></span>
				</div>
				<div class="form-group row options">
					<div class="col-md-4">
						<a href="../purchaseReports/all_invoices.php" target="_window" class="btn btn-default">All invoice</a>
					</div>
					<div class="col-md-4">
						<a href="../purchaseReports/paid_invoices.php" id="paid_reports" class="btn btn-default" target="_window">Paid invoice</a>
					</div>
					<div class="col-md-4">
						<a href="#" taget="_window" id="party_ledger" target="_window" class="btn btn-default">Party Ledger</a>
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="Payment Details">
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="Unpaid Bills">	
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="Balance Bills">	
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="SemiCash Sumry">	
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="Payment Sumry">	
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group row">
					<div class="row">
						<h4 class="col-md-4">Invoice between</h4>
						<div class="col-md-6" id="msg"></div>
					</div>
					<div class="col-md-6">
						<label for="invoice_from">From</label>
						<input type="date" name="invoice_from" id="invoice_from" class="form-control" value="<?php echo date('Y-m-d', strtotime(date('Y')."-04-01 -1 year")); ?>">
					</div>
					<div class="col-md-6">
						<label for="invoice_to">To</label>
						<input type="date" name="invoice_to" id="invoice_to" class="form-control" value="<?php echo date('Y-m-d'); ?>">
					</div>
				</div>
				<div class="row well pre-scroll invoice-details">
					<input type="button" id="goto_prev" value="prev" style="display:none;">
					<input type="button" id="goto_next" value="next" style="display:none;">
					<table class="table table-bordered table-condensed">
						<thead class="text-center">
							<td></td>
							<td>Sr.</td>
							<td>Date</td>
							<td>Inv No</td>
							<td>Pur Qt</td>
							<td>Bill Amnt</td>
							<td>Paid</td>
							<td>Bal</td>
							<td>Disc</td>
							<td>Type</td>
							<td>Day</td>
						</thead>
						<tbody class="invoice-list">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>

<script src="../script/jquery-min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/payment.js"></script>
<script>
	var stockist_name = '';
	var total = 0;
	var invoice_numbers = [];
	function generatePaymentDetails(){
		var supplier_name = $('#stockist_name').val();
		$.ajax({
			url: '../functions/accountFunctions.php',
			type: 'post',
			data: {
				supplier_name: supplier_name,
				access: 'getList'
			},
			success: function(data){
				$('#stockist_name_list').html(data);
			}
		});
	}

	$('#stockist_name').keydown(function(e){
		if (e.which == 13){
			stockist_name = $('#stockist_name').val();
			getInvoices();
			$('#stockist_name_list').html("");
		}
	});

	function getInvoices(){
		var supplier_name = $('#stockist_name').val();
		console.log(supplier_name);
		var from = $('#invoice_from').val();
		var to = $('#invoice_to').val();

		$.ajax({
			url: '../functions/accountFunctions.php',
			type: 'post',
			dataType: 'JSON',
			data: {
				supplier_name: supplier_name,
				from: from,
				to: to,
				access: 'getInvoice'
			},
			success: function(data){
				//console.log(data);
				$('tbody').html(data.row);
				$('#total_amount').val(data.total);
				console.log(data);
			}
		});
	}

	function makePayment(){
		var supplier_name = $('#stockist_name').val();
		var bank = $('#bank').val();
		var check_no = $('#check_no').val();
		var check_date = $('#check_date').val();
		var total_amount = $('#total_amount').val();
		var amount_paid = parseFloat($('#amount_paid').val());

		// Check payment mode
		// if payment is not done by "Cash In Hand"
		// then - make sure that the #check_date and #check_no fields are not empty

		if ($('#bank').val() != "Cash In Hand"){
			if ($('#check_date').val() == '' || $('#check_no').val() == ''){
				alert("Do not leave check date and check number field empty");
				return false;
			}
		}

		if (amount_paid != '' && $('#submit').val() != 'Update'){
			var balanace = parseFloat(total_amount) - amount_paid;

			$.ajax({
				url: '../functions/accountFunctions.php',
				type: 'post',
				data: {
					supplier_name: supplier_name,
					bank: bank,
					check_no: check_no,
					check_date: check_date,
					total_amount: total_amount,
					amount_paid: amount_paid,
					balanace: balanace,
					invoiceNumber: invoice_numbers,
					access: 'makePayment'
				},
				success: function(data){
					console.log(data);
					$('#msg').html(data);
				}
			});
		}else if (amount_paid != '' && $('#submit').val() == 'Update'){
			// Update the unchecked invoice, set its balance to unpaid
			// Remove it's entry from `paid_to` to column in supplier_payment
			$.ajax({
				url: '../functions/accountFunctions.php',
				type: 'post',
				data: {
					amount_paid: amount_paid,
					v_no: $('#v_no').html(),
					invoiceNumber: invoice_numbers,
					access: 'updatePayment'
				},
				success: function(data){
					console.log(data);
					$('#msg').html("<p class=\"text-alert\">Payment Updated!</p>");
				}
			});
		}
	}

	function modifyPayment(){
		if ($('#supplier_name').val() != ''){
			invoice_numbers = [];
			$.ajax({
				url: '../functions/accountFunctions.php',
				type: 'post',
				dataType: 'json',
				data: {
					supplier_name: $('#stockist_name').val(),
					access: 'getPayments'
				},
				success: function(data){
					console.log(data);
					$('tbody').html(data.row);
					$('#check_date').val(data.check_date);
					$('#check_no').val(data.check_no);
					$('#total_amount').val(data.amount);
					$('#v_no').html(data.v_no);

					// Set Modify parameter to true
					$('#submit').val('Update');
				}
			});
		}else{
			alert("Please Enter Stockist Name");
		}
	}

	$('#invoice_from, #invoice_to').change(function (){
		var from = $('#invoice_from').val();
		var to = $('#invoice_to').val();
		var href = "../purchaseReports/paid_invoices.php?from="+ from +"&to="+to;
		$('#paid_reports').attr("href", href);
	});

	$('#party_ledger').click(function (){
		if ($('#stockist_name').val() == '' || $('#stockist_name').val() == undefined){
			alert("Enter Supplier Name");
			return false;
		}

		var from = $('#invoice_from').val();
		var to = $('#invoice_to').val();
		var href = "../purchaseReports/party_ledger.php?supplier="+ $('#stockist_name').val() +"&from="+ from +"&to="+to;
		$('#party_ledger').attr("href", href);

		return true;

	});

</script>

</body>
</html>