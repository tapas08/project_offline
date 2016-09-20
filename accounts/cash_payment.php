<?php 
require_once '../core/init.php';

$msg = [];

$receipt_no = DB::getInstance()->query("SELECT * FROM payment")->count();

if (Input::exists()){
	// Save the data to payment table
	// Get other details regarding the head
	// like its parent head or sub parent head

	$head_id;
	$parent_id;
	$sub_parent_id;

	$head = Input::get('head_name');

	$head_id = DB::getInstance()->get('child_heads', array('name', '=', $head));

	if ($head_id->count()){
		// Get parent head id
		$parent_id = $head_id->first()['parent_id'];

		// Get head id
		$head_id = $head_id->first()['child_id'];

		// Get sub parent id if any
		// Uncomment the following line when the column is added
		// $sub_parent_id = ($head_id->first()['sub_parent_id'] != '') : ? '';
	
	}else{
		$parent_id = DB::getInstance()->get('parent_head', array('name', '=', $head));

		$head_id = $parent_id = ($parent_id->count()) ? $parent_id->first()['head_id'] : exit($msg[] = "0");
		
	}

	// Insert payment details in payment table
	$payment = DB::getInstance()->insert('payment', array(
			'paid_to' => $head,
			'head_id' => $head_id,
			'amount' => Input::get('amount'),
			'particular' => Input::get('particular'),
			'receipt_no' => Input::get('receipt_no'),
			'v_type' => $parent_id,
			'date' => date('Y-m-d')
		));

	if ($payment){
		$msg[] = "Payment successful";
	}else{
		$msg[] = "Error! Unable to proceed. Please try again";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cash Receipt</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/accounts.css">
</head>
<body>
	<?php require_once 'templates/header.php'; ?>
	<section>
		<form action="" method="POST" id="payment_form">
		<div class="container-fluid">
		<?php
			if (count($msg)){
				foreach ($msg as $message){
					if ($message == "0"){
						echo "NOTHING!";
					}else{
						echo "<p class=\"alert alert-warning\">$message</p>";
					}
				}
			}
		?>
		</div>
		<h3 class="text-center">Cash Payment</h3>
		<article class="container-fluid" id="buttons">
			<div class="col-md-offset-6 col-md-6">
				<button class="btn btn-primary"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" style="color:white; text-decoration:none;">Cancel</a></button>
				<input type="button" class="btn btn-primary" value="Print">
				<!-- <input type="button" class="btn btn-primary" value="Register"> -->
				<input type="button" class="btn btn-primary" value="Delete">
				<input type="button" class="btn btn-primary" value="Modify">
				<input type="submit" class="btn btn-primary" value="Save" name="save" id="save">
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
							<label for="from">PAID TO</label>
						</span>
						<div class="col-md-8">
							<input type="text" id="head_name" name="head_name" list="head_list" class="form-control" >
							<datalist id="head_list"></datalist>
						</div>
						<div class="col-md-offset-4 col-md-3">
							0
						</div>
						<div class="col-md-2">
							<input type="button" class="open_heads_modal btn btn-primary" value="Add">
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

			<table class="table table-condensed">
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
		</form>
	</section>
	
	<?php require_once '../templates/account_heads.php'; ?>

	<script src="../script/jquery-min.js"></script>
	<script src="../script/bootstrap.min.js"></script>
	<script src="../script/common.js"></script>
	<script src="../script/accounts.js"></script>
	<script>
		$('#head_name').keydown(function(e){
			if (e.which == 13){
				e.preventDefault();
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
						console.log("getting ledger ->"+data);
						$('#ledger').html(data.list);
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