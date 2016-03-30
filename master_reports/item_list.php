<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Item List</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class="container">
	<div class="col-md-12 text-center">
		<h2>MATOSHREE MEDICOSE U/O TS LIFECARE Pvt. Ltd.</h2>
		<h2>ITEM LIST</h2>
	</div>
	<table class="table">
		<thead>
			<td>Sr. No</td>
			<td>MFG</td>
			<td>PRODUCT</td>
			<td>PACK</td>
			<td>PR. RATE</td>
			<td>MRP</td>
			<td>RACK</td>
			<td>PR. SIZE</td>
			<td>CAT</td>
			<td>EXPIRY</td>
		</thead>
		<tbody>
<?php 
require_once '../core/init.php';

$db = DB::getInstance();

$item_list = $db->query("SELECT * FROM items");

if ($item_list->count() > 0){
	$x = 1;
	foreach ($item_list->result() as $item_details => $item):

?>
			<tr>
				<td><?php echo $x ?></td>
				<td><?php echo $item['manufacturer'] ?></td>
				<td><?php echo $item['productName'] ?></td>
				<td><?php echo $item['packSize'] ?></td>
				<td><?php echo $item['productRate'] ?></td>
				<td><?php echo $item['MRP'] ?></td>
				<td><?php echo $item['shelf'] ?></td>
				<td><?php echo $item['quantity'] ?></td>
				<td><?php echo $item['productType'] ?></td>
				<td>
					<?php 
						echo $db::getInstance()->query("SELECT * FROM purchaseBills WHERE supplier = ? AND productName = ?", array($item['marketedBy'], $item['productName']))->first()['expiryDate'];
					?>
				</td>
			</tr>


<?php

	end foreach;
}

?>
		</tbody>
	</table>
</div>
</body>
</html>