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
			<td>Customer Name</td>
			<td>Address</td>
			<td>Phone</td>
			<td>City</td>
		</thead>
		<tbody>
<?php 
require_once '../core/init.php';

$db = DB::getInstance();

$supplier_list = $db->get('account', array('ac_type', '=', 'Supplier'));

if ($supplier_list->count() > 0){
	foreach ($supplier_list->result() as $supplier_details => $supplier):

?>
			<tr>
				<td><?php echo $supplier['name'] ?></td>
				<td><?php echo $supplier['address'] ?></td>
				<td><?php echo $supplier['phone'] ?></td>
				<td><?php echo $supplier['city'] ?></td>
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