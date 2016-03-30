<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payment</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/accounts.css">
</head>
<body>
<?php require_once '../templates/header.php' ?>
<div class="container">
	<form action="">
		<div class="row">
			<div class="col-md-4 well payment-form">
				<div class="form-group">
					<label for="stokist_name">Stockist</label>
					<input type="text" id="stockist_name" name="stockist_name" list="stokist_name_list" class="form-control" oninput="generatePaymentDetails();">
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
					<input type="reset" name="reset" id="reset" value="Cancel" class="btn btn-warning">
				</div>
				<div class="form-group row options">
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="All invoice">
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="Paid invoice">
					</div>
					<div class="col-md-4">
						<input type="button" class="btn btn-default" value="Party Ledger">
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
						<input type="date" name="invoice_from" id="invoice_from" class="form-control">
					</div>
					<div class="col-md-6">
						<label for="invoice_to">To</label>
						<input type="date" name="invoice_to" id="invoice_to" class="form-control">
					</div>
				</div>
				<div class="row well pre-scroll invoice-details">
					<table class="table table-bordered table-condensed">
						<thead class="text-center">
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
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>

<script src="../script/jquery-min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script>
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

				getInvoices();
			}
		});
	}

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
				$('tbody').html(data.row);
				$('#total_amount').val(data.total);
				console.log(data);
			}
		});
	}

	function makePayment(){
		var supplier_name = $('#stockist_name').val();
		var bank = $('#bank').val();
		var check_no = $('#check_date').val();
		var total_amount = $('#total_amount').val();
		var amount_paid = parseFloat($('#amount_paid').val());

		if (bank != '' && check_no != '' && amount_paid != ''){
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
					access: 'makePayment'
				},
				success: function(data){
					console.log(data);
					$('#msg').html(data);
				}
			});
		}
	}

</script>

</body>
</html>