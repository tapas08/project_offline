<?php 
require_once('core/init.php');
$row=[];
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
		
	<section ><!--class="container" -->
<div >
				<center><h3 style="color:grey;">MATOSHREE MEDICOSE U/O TS Lifecare Pvt Ltd.</h3>
				<h3 style="border-bottom:2px grey solid;color:grey;">Cash Balance Summary date :01/04/2015 To <?php echo date('d/m/20y'); ?></h3>
			
				<input type="data" id="datePicker" name="datePicker" style="visibility:hidden;">
			<center>
</div>			
<div  id="productEntry" class="container-fluid">
	<H4>MEDICINE SALE</H4>
	<?php foreach($details->results() as $data => $item) 
	{
					$row =json_decode($item['bill'], 1);
	 
			?>
	<!--
    //echo $product;
		//echo "<br>",$data['quantity'];
 //echo $row['product_name']-->
 					<table class="table table-bordered table-condensed">
					<thead>
					<tr>
						<td>BILL NO :</td>
						<td><?php echo $item['bill_no']?></td>
						<td>PATIENT :</td>
						<td><?php echo $item['patient_name']?></td>
						<td>CASH\CREDIT :</td>
						<td><?php echo $item['cash-or-credit']?></td>
						<td>DATE :</td>
						<td><?php 
						
						echo $newDate = date("d-m-Y", strtotime($item['date']));?></td>
						<td>TIME</td>
						<td>-----</td>
						
					</tr>
					<tr>
						<td>MFG</td>
						<td>DESCR</td>
						<td>PACK</td>
						<td>RACK</td>
						<td>BATCH</td>
						<td>EXPIRY</td>
						<td>QTY</td>
						<td>MRP</td>
						<td>TAX</td>
						<td>AMT</td>
					</tr>
					</thead>
					<tbody>
					<?php 
					foreach($row as $product=>$data) 
					{
					
					?>
					
						<tr>
							<td><?php echo $data['manufacturer']; ?></td>
							<td><?php echo $product;?></td>
							<td><?php echo $data['packSize'];?></td>
							<td><?php echo $data['shelf'];?></td>
							<td><?php echo $data['batchNo'];?></td>
							<td><?php echo $data['expiryDate'];?></td>
							<td><?php echo $data['quantity']; ?></td>
							<td><?php  echo $data['MRP']; ?></td>
							<td><?php echo $data['Tax']; ?></td>
							<td><?php echo $data['cost']; ?></td>
							
							
							
						</tr>
						<?php   }?>
					</tbody>
						
				</table>
				<h4 align="right">AMOUNT  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $item['total_amt']; ?></h4></br></br>
	<?php } ?>			
</div>
</section>
</body>
</html>