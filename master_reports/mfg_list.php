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
			<td>Manufacturer</td>
			<td>Short Name</td>
			<td>Code</td>
		</thead>
		<tbody>
<?php 
require_once '../core/init.php';

$db = DB::getInstance();

$company_list = $db->query("SELECT * FROM company_name");

if ($company_list->count() > 0){
	$x = 1;
	foreach ($company_list->results() as $company_details => $company):

?>
			<tr>
				<td><?php echo $x ?></td>
				<td><?php echo $company['name'] ?></td>
				<td><?php echo $company['abbreviation'] ?></td>
				<td><?php echo $company['id'] ?></td>
			</tr>


<?php
	$x++;
	endforeach;
}

?>
		</tbody>
	</table>
</div>
</body>
</html>