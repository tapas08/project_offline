<?php 
require_once '../core/init.php';

$receipt_no = DB::getInstance()->query("SELECT * FROM cash_received")->count();

if (Input::exists()){
	// Set up few variable to be used
	$head_id;
	$v_type;
	$db = DB::getInstance();
	$particular = '';

	// Get head_id of the payer
	// First checking if the head_name belong in child_heads table
	$head_info = $db->get('child_heads', array('name', '=', Input::get('head_name')));

	if ($head_info->count()){
		$head_id = $head_info->first()['child_id'];
	}else{
		// If entry does not exists in child_heads table
		// Then check in
	}

	// Make entry of cash received from
	$received = $db->insert('cash_received', array());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cash Receipt</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/accounts.css">
</head>
<body>
	<?php require_once 'templates/header.php'; ?>
	<section>
		<h3 class="text-center">Cash Receipt</h3>
		<article class="container-fluid" id="buttons">
			<div class="col-md-offset-6 col-md-6">
				<button class="btn btn-primary"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" style="color:white; text-decoration:none;">Cancel</a></button>
				<input type="button" class="btn btn-primary" value="Print">
				<!-- <input type="button" class="btn btn-primary" value="Register"> -->
				<input type="button" class="btn btn-primary" value="Delete">
				<input type="button" class="btn btn-primary" value="Modify">
				<input type="submit" class="btn btn-primary" value="Save">
			</div>
		</article>
		<article class="" id="form">
			<div class="col-md-12">
				<span class="col-md-2">Receipt No :</span>
				<span class="col-md-2"><input type="number" id="receipt_no" name="receipt_no" value="<?php echo ($receipt_no + 1); /* Count total receipts */ ?>" class="form-control" style="border: none !important;"></span>
			</div>
			<div class="col-md-12">
				<span class="col-md-2">Date - </span>
				<span class="col-md-2"><output><?php echo date('d-m-Y'); ?></output></span>
			</div>
			<br>
			<div class="" id="form-content">
				<div class="form-group">
					<div class="col-md-6 form-group">
						<span class="col-md-4">
							<label for="from">RECEIVED FROM</label>
						</span>
						<div class="col-md-8">
							<input type="text" id="head_name" name="head_name" list="head_list" class="form-control" >
							<datalist id="head_list"></datalist>
						</div>
						<div class="col-md-3">
							0
						</div>
					</div>
					<div class="col-md-6 form-group">
						<span class="col-md-4">
							<label for="amount">AMOUNT</label>
						</span>
						<div class="col-md-8">
							<input type="number" step="any" id="amount" name="amount" class="form-control">
						</div>
						<div class="col-md-12">
							<p>Cash in Hand - </p>
						</div>
					</div>
				</div>
				<br>
				<div class="col-md-8 form-group">
					<span class="col-md-4">
						<label for="particular">PARTICULAR</label>
					</span>
					<div class="col-md-8">
						<textarea name="particular" id="particular" class="form-control"></textarea>
					</div>
				</div>
			</div>

			<table class="table table-bordered table-condensed">
				<caption>LEDGER of last 7 entries</caption>
				<thead>
					<td>*</td>
					<td>Date</td>
					<td>Credit</td>
					<td>Debit</td>
					<td>Head</td>
					<td>Particular</td>
					<td>inv-no</td>
					<td>V-Type</td>
				</thead>
				<tbody id="ledger"></tbody>
			</table>
		</article>
	</section>
	
	<script src="../script/jquery-min.js"></script>
	<script src="../script/bootstrap.min.js"></script>
	<script src="../script/common.js"></script>
	<script src="../script/accounts.js"></script>
	<script>
		$('#head_name').keydown(function(e){
			if (e.which == 13){
				// TODO
				// Get the total amount to be paid
				// Get the table details of last 7 ledgers
				$.ajax({
					url: '../functions/accountFunctions.php',
					type: 'post',
					dataType: 'json',
					data: {
						head_name: $('#head_name').val(),
						access: 'paid_ledger'
					},
					success: function(data){
						console.log(data);
						$('tbody').html(data.list);
						$('#amount').val(data.amount);
					}
				});
			}else{
				$.ajax({
					url: '../functions/accountFunctions.php',
					type: 'post',
					data: {
						head_name: $('#head_name').val(),
						access: 'getHeadList'
					},
					success: function(data){
						console.log(data);
						$('#head_list').html(data);
					}
				});
			}
		});
	</script>
</body>
</html>