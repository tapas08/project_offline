<?php
require_once('core/init.php');

$db = DB::getInstance(true);

?>
<!DOCTYPE <html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>

<div class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<a href="#" class="navbar-brand">Medical Shop</a>
		</div>
		<div class="navbar-header">
			<ul class="nav navbar-nav">
				<li><a href="#">Home</a></li>
				<li><a href="updateInventory.php">Update Inventory</a></li>
				<li><a href="#">Send Mail</a></li>
				<li role="presentation" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						Inventory <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="database.php?loc=nagpur" id="nagpur">Nagur</a></li>
						<li><a href="database.php?loc=amravati" id="amravati">Amravati</a></li>
						<li><a href="database.php?loc=yavatmal" id="yavatmal">Yavatmal</a></li>
						<li><a href="database.php?loc=pune" id="pune">Pune</a></li>
					</ul>
				</li>
				<li><a href="#">Sing Out</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div>
					<i class="fa fa-database fa-5x col-lg-6"></i>
					<h3 class="col-lg-6 name">Nagur</h3>
				</div>
				<div class="caption">
					<p class="alert alert-success">
					<?php  
					$sale = 0;
					$nagpur = $db->query("SELECT * from nagpur_bill WHERE bill_date >= ? AND bill_number <= ?", array(date('Y-m-1'), date('Y-m-d')));
					$results = $nagpur->results();
					foreach ($results as $key => $value) {
						$sale += $value['grand_total'];
					}
					?>
					SALE <i class="fa fa-rupee"></i> - <?php echo $sale; ?>
					</p>
					<p class='alert alert-info'>From <?php echo "<span>",date('Y-m-1'), " to ", date('Y-m-d'),"</span>"; ?></p>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div>
					<i class="fa fa-database fa-5x col-lg-6"></i>
					<h3 class="col-lg-6 name">Amravati</h3>
				</div>
				<div class="caption">
					<p class="alert alert-success">
					<?php  
					$sale = 0;
					$nagpur = $db->query("SELECT * from amravati_bill WHERE bill_date >= ? AND bill_number <= ?", array(date('Y-m-1'), date('Y-m-d')));
					$results = $nagpur->results();
					foreach ($results as $key => $value) {
						$sale += $value['grand_total'];
					}
					?>
					SALE <i class="fa fa-rupee"></i> - <?php echo $sale; ?>
					</p>
					<p class='alert alert-info'>From <?php echo "<span>",date('Y-m-1'), " to ", date('Y-m-d'),"</span>"; ?></p>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<i class="fa fa-database fa-5x col-lg-6"></i>
				<h3 class="col-lg-6 name">Yavatmal</h3>
				<div class="caption">
					<p class="alert alert-success">
					<?php  
					$sale = 0;
					$nagpur = $db->query("SELECT * from yavatmal_bill WHERE bill_date >= ? AND bill_number <= ?", array(date('Y-m-1'), date('Y-m-d')));
					$results = $nagpur->results();
					foreach ($results as $key => $value) {
						$sale += $value['grand_total'];
					}
					?>
					SALE <i class="fa fa-rupee"></i> - <?php echo $sale; ?>
					</p>
					<p class='alert alert-info'>From <?php echo "<span>",date('Y-m-1'), " to ", date('Y-m-d'),"</span>"; ?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div>
					<i class="fa fa-database fa-5x col-lg-6"></i>
					<h3 class="col-lg-6 name">Pune</h3>
				</div>
				<div class="caption">
					<p class="alert alert-success">
					<?php  
					$sale = 0;
					$nagpur = $db->query("SELECT * from pune_bill WHERE bill_date >= ? AND bill_number <= ?", array(date('Y-m-1'), date('Y-m-d')));
					$results = $nagpur->results();
					foreach ($results as $key => $value) {
						$sale += $value['grand_total'];
					}
					?>
					SALE <i class="fa fa-rupee"></i> - <?php echo $sale; ?>
					</p>
					<p class='alert alert-info'>From <?php echo "<span>",date('Y-m-1'), " to ", date('Y-m-d'),"</span>"; ?></p>
				</div>
			</div>
		</div>
</div>
<script type="text/javascript" src="script/jquery-min.js"></script>
<script type="text/javascript" src="script/bootstrap.min.js"></script>
</body>
</html>