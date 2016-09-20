<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Item List</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="col-md-12 text-center">
		<h2>MATOSHREE MEDICOSE U/O TS LIFECARE Pvt. Ltd.</h2>
		<h2>ITEM LIST</h2>
	</div>
	<table class="table table-bordered table-condensed">
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

if (Input::exists('get')){

	$db = DB::getInstance();

	// Get the short name of Manufacturer
	$short_name = DB::getInstance()->get('company_name', array('name', '=', Input::get('mfg')))->first()['abbreviation'];

	$item_list = $db->query("SELECT * FROM items WHERE manufacturer = ? OR manufacturer = ?", array(Input::get('mfg'), $short_name));

	if ($item_list->count() > 0){
		$x = 1;
		foreach ($item_list->results() as $item_details => $item):

?>
			<tr>
				<td><?php echo $x ?></td>
				<td><?php echo $short_name ?></td>
				<td><?php echo $item['productName'] ?></td>
				<td><?php echo $item['packSize'] ?></td>
				<td><?php echo $item['productRate'] ?></td>
				<td><?php echo $item['MRP'] ?></td>
				<td><?php echo $item['shelf'] ?></td>
				<td><?php echo $item['quantity'] ?></td>
				<td><?php echo $item['productType'] ?></td>
				<td>
					<?php 
						echo $db::getInstance()->query("SELECT * FROM purchaseBills")->first()['expiryDate'];
					?>
				</td>
			</tr>


<?php

		endforeach;
	}
}
?>
		</tbody>
	</table>
</div>
</body>
</html>