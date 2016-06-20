<?php 
require_once('core/init.php');
	$message = [];
	$details = [];
	$data=[];
	$session_id = session_id();
	$db = DB::getInstance();
	$details = $db->query("SELECT * FROM patients");
				

	
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>SELL</title>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/invoice.css">
	<link rel="stylesheet" href="css/style.css">
	
	
	<script src="script/jquery-min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script src="script/jquery.mtz.monthpicker.js"></script>

</head>

<body>
		
	<section class="container">
<div >
				<center><h3 style="color:grey;">MATOSHREE MEDICOSE U/O TS Lifecare Pvt Ltd.</h3>
				<h3 style="border-bottom:2px grey solid;color:grey;">Cash Balance Summary date :01/04/2015 To <?php echo date('d-m-y'); ?></h3>
			
				<input type="data" id="datePicker" name="datePicker" style="visibility:hidden;">
			<center>
</div>			
<div class="container-fluid" id="productEntry">
	
					<table class="table table-bordered">
					<thead>
						<td></td>
						<td>BillNo</td>
						<td>Date</td>
						<td>Patient </td>
						<td>CASH</td>
						<td>Amount</td>
						<td>RECEIVED</td>
						<td>BALANCE</td>
					</thead>
					<tbody>
					<?php foreach($details->results() as $data => $item){?>
						<tr>
							<td><?php echo $item['cash-or-credit'];?></td>
							<td><?php echo $item['bill_no'];?></td>
							<td><?php echo $item['date'];?></td>
							<td><?php echo $item['patient_name'];?></td>
							<td><?php echo $item['total_amt']; ?></td>
							<td><?php echo $item['total_amt'];?></td>
							<td><?php echo $item['paid_amt'];?></td>
						   <td><?php echo $item['bal_amt'];?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
</div>
</section>
</body>
</html>