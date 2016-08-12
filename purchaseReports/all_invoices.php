<?php 
require_once '../core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Invoices</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/accounts.css">
</head>
<body>
	
	<div class="col-md-12 text-center">
		<p class="text-info" id="page_desc"></p>
		<br>
	</div>

	<table class="table table-condensed">	
		<thead>
			<td>#</td>
			<td>Inv No</td>
			<td>Date</td>
			<td>Cash</td>
			<td>Credit</td>
			<td>Disc</td>
			<td>Cr. Note</td>
			<td>Dr. Note</td>
			<td>MRP Total</td>
			<td>Payment</td>
			<td>Days</td>
			<td></td>
		</thead>
		<tbody>
<?php 
	$db = DB::getInstance();

	// Get each supplier from stockist_name table
	$stockist = DB::getInstance()->query("SELECT * FROM stockist_name");
	if ($stockist->count()){

		// Loop through each stockist
		// and get their invoice details from purchaseInvoice table
		foreach ($stockist->results() as $data => $supplier){
			echo "<tr>";
			echo "<td style='font-weight:bold; padding: 16px 0 5px 0' colspan='12'>" . $supplier['name'] . "</caption>";
			echo "</tr>";

			$invoiceDetails = DB::getInstance()->get('purchaseInvoice', array('supplier', '=', $supplier['name']));
			
			if ($invoiceDetails->count()){
				$credit = 0;
				$creditNote = 0;
				$discount = 0;
				$debitNote = 0;
				$mrp_total = 0;
				foreach ($invoiceDetails->results() as $details => $invoice){
					// Count number of days since the invoice
					$current_date = time();
					$invoice_date = strtotime($invoice['billDate']);

					$diff = $current_date - $invoice_date;

					$days = floor($diff/(60*60*24));
					$flag = $invoice['balance'] == 0;
					$status = $flag ? "PAID" : ((float)$invoice['balance'] < (float)$invoice['netAmount'] && (float)$invoice['balance'] > 1.0 ? 'PARTIALLY' : 'UNPAID');

					echo "<tr>";
					echo "<td>" . $invoice['id'] . "</td>";
					echo "<td>" . $invoice['invoiceNumber'] . "</td>";
					echo "<td>" . $invoice['billDate'] . "</td>";
					echo "<td>  </td>";
					echo "<td>" . $invoice['netAmount'] . "</td>";
					echo "<td>" . $invoice['discount'] . "</td>";
					echo "<td>" . $invoice['creditNote'] . "</td>";
					echo "<td>" . $invoice['debitNote'] . "</td>";
					echo "<td>" . $invoice['mrp_total'] . "</td>";
					echo "<td>" . $status . "</td>";
					echo "<td>" . $days . "</td>";
					echo "<td>" . @DB::getInstance()->get('purchaseBills', array('invoiceNumber', '=', $invoice['invoiceNumber']))->first()['bType'] . "</td>";
					echo "</tr>";

					$credit += $invoice['netAmount'];
					$creditNote += $invoice['creditNote'];
					$debitNote += $invoice['debitNote'];
					$discount += $invoice['discount'];
					$mrp_total += $invoice['mrp_total'];
				}
				echo "<tr style='color:red; background:#e3e3e3'>";
				echo "<td colspan=\"4\">SUB TOTAL : </td>";
				echo "<td>$credit</td>";
				echo "<td>$discount</td>";
				echo "<td>$creditNote</td>";
				echo "<td>$debitNote</td>";
				echo "<td>$mrp_total</td>";
				echo "<td colspan=3></td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td colspan='12'></td>";
				echo "</tr>";
			}
		}

	}
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