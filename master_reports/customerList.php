<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer List</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="col-md-12 text-center">
		<h3>MATOSHREE MEDICOSE U/O TS LIFECARE Pvt. Ltd.</h3>
		<h3>CUSTOMER LIST</h3>
	</div>
	<table class="table table-bordered">
		<thead class="text-center">
			<td>Customer Name</td>
			<td>Address</td>
			<td>Phone</td>
			<td>City</td>
		</thead>
		<tbody>
<?php 
require_once '../core/init.php';

$db = DB::getInstance();

$customer_list = $db->get('account', array('ac_type', '=', 'Customer'));

if ($customer_list){
	if ($customer_list->count() > 0){
		foreach ($customer_list->result() as $customer_details => $customer):

?>
			<tr>
				<td><?php echo $customer['name'] ?></td>
				<td><?php echo $customer['address'] ?></td>
				<td><?php echo $customer['phone'] ?></td>
				<td><?php echo $customer['city'] ?></td>
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