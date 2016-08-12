<?php 
require_once '../core/init.php';
if (Input::exists('get')){
	$supplier = Input::get('supplier');

	$from_date;

	$from = date('Y-m-d', strtotime(Input::get('from')));
	$to = date('Y-m-d', strtotime(Input::get('to')));

	$from_date = $from;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Party Ledger</title>
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
			<td>Date</td>
			<td>V Type</td>
			<td>Particular</td>
			<td>Debit</td>
			<td>Credit</td>
			<td>Balance</td>
			<td></td>
		</thead>
		<tbody>

<?php 
	$db = DB::getInstance();

	$balance = 0;
	$netAmount = 0;
	$total_debit = 0;

	while ($from != $to){
		// First we will get from purchase invoices
		$invoices = $db->query("SELECT * FROM purchaseInvoice WHERE billDate = ? AND supplier = ?", array($from, $supplier));

		if ($invoices->count()){
			foreach ($invoices->results() as $details => $invoice){
				echo "<tr>";
				echo "<td>" . $invoice['billDate'] . "</td>";
				echo "<td> PR " . $invoice['id'] . "</td>";
				echo "<td> Purchase Account Invoice No : " . $invoice['invoiceNumber'] . "</td>";
				echo "<td> </td>";
				echo "<td>" . $invoice['netAmount'] . "</td>";
				echo "<td>" . $balance += $invoice['netAmount'] . "</td>";
				echo "<td>CR</td>";
				echo "</tr>";

				$netAmount += $invoice['netAmount'];
			}
		}

		// Now we will check for payment
		$payment = DB::getInstance()->query("SELECT * FROM supplier_payment WHERE supplier = ? AND payment_date = ?", array($supplier, $from));

		if ($payment->count()){
			foreach ($payment->results() as $payment_details => $pay){
				echo "<tr>";
				echo "<td>" . $pay['payment_date'] . "</td>";
				echo "<td> PP " . $pay['v_no'] . "</td>";
				echo "<td>" . DB::getInstance()->get('payment', array('id', '=', $pay['v_no']))->first()['particular'] . "</td>";
				echo "<td>" . $pay['amount_paid'] . "</td>";
				echo "<td>  </td>";
				echo "<td>" . $balance -= $pay['amount_paid'] . "</td>";
				echo "<td>CR</td>";
				echo "</tr>";

				$total_debit += $pay['amount_paid'];
			}
		}
		$from = date('Y-m-d', strtotime('+1 day', strtotime($from)));
	}

	echo "<tr style='background:#e4e4e4; color:red;font-size:17px;font-weight:bold'>";
	echo "<td colspan=2></td>";
	echo "<td>Average Balance</td>";
	echo "<td style='border-top:2px solid black'>" . $netAmount . "</td>";
	echo "<td style='border-top:2px solid black'>" . $total_debit . "</td>";
	echo "</tr>";

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
<?php 
}
?>