<?php
require_once('core/init.php');

$db = DB::getInstance(true);

?>

<!DOCTYPE <html>
<head>
	<title>Update Inventory</title>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-default">
	<div class="navbar-brand">Medical Shop</div>
	<div class="navbar-header">
		<ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li><a href="updateInventory.php">Update Inventory</a></li>
			<li><a href="#">Send Mail</a></li>
			<li><a href="#">Sing Out</a></li>
		</ul>
	</div>
</nav>

<section class="container">
	<form method="post" id="updateForm">
		<div class="row">
			<div class="col-lg-3">
				<div class="input-group">
					<span class="input-group-addon" id="sizing-addon1">Store</span>
					<input type="text" class="form-control" name="storeLocation" id="storeLocation" placeholder="Store Location" aria-describedby="sizing-addon1" list="location">
					<datalist id="location">
						<option value="NAGPUR"></option>
						<option value="AMRAVATI"></option>
						<option value="YAVATMAL"></option>
						<option value="PUNE"></option>
					</datalist>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="input-group">
					<span class="input-group-addon" id="sizing-addon2">Name</span>
					<input type="text" class="form-control" name="name" placeholder="Name" id="name" aria-describedby="sizing-addon2">
				</div>
			</div>
		</div>
		<div class="row">		
			<p class="alert alert-success">Enter product details</p>
			<div class="center" id="center">
				<div class="input-group col-lg-4">
					<label><i class="fa fa-barcode"></i> Product Number</label>
					<input type="number" class="form-control" name="productNumber" aria-describedby="sizing-addon3" placeholder="Product Number">
				</div>
			

				<div class="input-group col-lg-4">
					<label><i class="fa fa-tag"></i> Product Name</label>
					<input type="text" class="form-control" name="productName" placeholder="Product Name">
				</div>
			
				<div class="input-group col-lg-4">
					<label><i class="fa fa-gears"></i> Manufacturer</label>
					<input type="text" class="form-control" name="productManftr" placeholder="Product Manufacturer">
				</div>
			
				<div class="input-group col-lg-4">
					<label><i class="fa fa-plus-square"></i> Quantity</label>
					<input type="number" class="form-control" name="productQuantity" aria-describedby="sizing-addon6" placeholder="Product Quantity">
				</div>
			
				<div class="input-group col-lg-4">
					<label>Manufacturing Date</label>
					<input type="date" class="form-control" name="productMDate">
				</div>
			
				<div class="input-group col-lg-4">
					<label for="productExpDate">Expiry Date</label>
					<input type="date" class="form-control" name="productExpDate" id="productExpDate">
				</div>
			</div>

		</div>
	</form>
</section>	

</body>
</html>