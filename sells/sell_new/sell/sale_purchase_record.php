<?php 
//set_time_limit(999);
require_once('core/init.php');
$tmon;
	$message = [];
	$detail = [];
	$details = [];
	$data =[];
	$data1 =[];
	$sum=0;
	$session_id = session_id();
	$db = DB::getInstance();
	
						
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
				<h3 >Kanade Bal Rugnalaya,Hingoli Highway Road,Washim</h3>
				<h3 style="border-bottom:2px grey solid;color:grey;">DAY WISE SALE PURCHASE SUMMARY</h3>
			
				<input type="data" id="datePicker" name="datePicker" style="visibility:hidden;">
			<center>
</div>			
<div class="container-fluid" id="productEntry">
	
					<table class="table table-bordered">
					<thead>
						
						<td>DATE</td>
						<td>Inv NO</td>
						<td>Sale</td>
						<td>Sale Ret </td>
						<td>Total Sale</td>
						
					</thead>
					<tbody>
					
					<?php 
					
					$sum=0;
					$months = array (1=>'January',2=>'February',3=>'March',4=>'April',
					5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'october',
					11=>'November',12=>'December');
					
					$s = "15-04-01";
				
					$c = date('Y-m-d');
					//echo $c;
				
					while($s!=$c)
					{
					$newmonth = date("m",strtotime($s));
					//$mon = date("m",strtotime($c));

					//$n = date("m",strtotime($months[(int)$newmonth ]));
					/*if($newmonth!=$n){
						echo $tmon = $months[(int)$newmonth ];
						$n = date("m",strtotime($tmon));
					
						}*/
					/*do {
						echo $tmon = $months[(int)$newmonth ];
						$n = date("m",strtotime($tmon));
						}while(int($tmon)!=$n);*/
					$detail = $db->query("SELECT MAX(invoiceNumber),MIN(invoiceNumber),
					billDate FROM purchaseinvoice where billDate='".$s."' 
					group by billdate");
					$details = DB::getInstance()->query("SELECT count(total_amt),
					sum(total_amt) FROM patients where date='".$s."'  group by date");
					
					?>
					
					<?php
					if ($detail->count() > 0){
						
						
						if($newmonth!= $n){
						
							echo $tmon = $months[(int)$newmonth ];
							$n = date("m",strtotime($tmon));

							}
						foreach($detail->results() as $data => $items)//foreach($details->results() as $data => $itms)
					{
					
					?>
						
						<tr>
						
							<td><?php echo $date_bill = date( "d-m-Y" ,  strtotime($items['billDate']));?></td>
							<td><?php echo "C".$items['MIN(invoiceNumber)']."-C".$items['MAX(invoiceNumber)'];?></td>
							<?php foreach($details->results() as $data => $itms){?>
							<td><?php echo $itms['count(total_amt)'];?></td>
			
							<td></td>
							<td><?php echo $itms['sum(total_amt)'];?></td>
							<?php }?>
						</tr>
						
						<?php } } ?>
                      
						<?php 
					
						$s = strtotime( "+1 day" , strtotime($s) ) ;
						$s = date ( 'Y-m-d' , $s );
						
						}
						?>
						
					</tbody>
				</table>
</div>
</section>
</body>
</html>
							