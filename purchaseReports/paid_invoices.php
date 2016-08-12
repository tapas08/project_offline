<?php  
require_once '../core/init.php';

$from_date;

$from = date('Y-m-d', strtotime(Input::get('from')));
$to = date('Y-m-d', strtotime(Input::get('to')));

$from_date = $from;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Paid Invoices</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/accounts.css">
</head>
<body>
	<div class="col-md-12 text-center">
		<p class="text-info" id="page_desc"></p>
		<br>
	</div>

	<div class="col-md-12">
		<p class="text-info text-right">Showing Reports from - <?php echo date('d-m-Y', strtotime($from)) ." to ". date('d-m-Y', strtotime($to)); ?></p>
		<br>
	</div>

	<table class="table table-condensed">	
		<thead>
			<td>#</td>
			<td>Inv No</td>
			<td>Date</td>
			<td>Cash</td>
			<td>Credit</td>
			<td>Paid</td>
			<td>Disc</td>
			<td>Type</td>
			<td>Payment</td>
			<td>Days</td>
		</thead>
		<tbody>

<?php 
	$db = DB::getInstance();

	$suppliers = DB::getInstance()->query("SELECT * FROM stockist_name");

	if ($suppliers->count()):

		foreach ($suppliers->results() as $supplier => $stockist):
			$from = $from_date;
			echo "<tr>";
			echo "<td colspan=10>". $stockist['name'] ."</td>";
			echo "</tr>";

			$total_amount = 0;
			$total_paid = 0;
			$total_discount = 0;

			while ($from != $to){
				$paid_invoices = $db->query("SELECT * FROM purchaseInvoice WHERE billDate = ? AND supplier = ? AND balance = ?", array($from, $stockist['name'], (float)0));
				//print_r($paid_invoices->results());
				if ($paid_invoices->count()){
					foreach ($paid_invoices->results() as $invoices => $invoice){

						$current_date = time();
						$invoice_date = strtotime($invoice['billDate']);

						$diff = $current_date - $invoice_date;

						$days = floor($diff/(60*60*24));
						$flag = $invoice['balance'] == 0;
						
						$status = $flag ? "PAID" : ((float)$invoice['balance'] < (float)$invoice['netAmount'] && (float)$invoice['balance'] > 1.0 ? 'PARTIALLY' : 'UNPAID');

						echo "<tr>";
						echo "<td>". $invoice['id'] ."</td>";
						echo "<td>". $invoice['invoiceNumber'] ."</td>";
						echo "<td>". $invoice['billDate'] ."</td>";
						echo "<td></td>";
						echo "<td>". $invoice['netAmount'] ."</td>";
						echo "<td>". ($invoice['netAmount'] - $invoice['balance']) ."</td>";
						echo "<td>". $invoice['discount'] ."</td>";
						echo "<td>CREDIT</td>";
						echo "<td>". $status ."</td>";
						echo "<td>". $days ."</td>";
						echo "</tr>";

						$total_amount += $invoice['netAmount'];
						$total_paid += ($invoice['netAmount'] - $invoice['balance']);
						$total_discount += $invoice['discount'];
					}

					echo "<tr style='background:#e4e4e4;color:red;font-weight:bold'>";
					echo "<td colspan=4>Sub Total</td>";
					echo "<td style='border:1px solid black'>". $total_amount ."</td>";
					echo "<td style='border:1px solid black'>". $total_paid ."</td>";
					echo "<td style='border:1px solid black'>". $total_discount ."</td>";
					echo "<td colspan=3></td>";
					echo "</tr>";
				}
				$from = date('Y-m-d', strtotime('+1 day', strtotime($from)));
			}
		endforeach;
	endif;
?>

		</tbody>
	</table>

	<div class="col-md-12 text-center">
		<p id="pagination"></p>
	</div>

	<script src="../script/jquery-min.js"></script>
	<script src="script/pagination.js"></script>

</body>
</html>