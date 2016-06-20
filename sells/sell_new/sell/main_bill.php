<?php
   require_once('core/init.php');
	$message = [];
	$get = array();
	// var_dump($_POST);
	$db=DB::getInstance();
	$res = $db->query("SELECT * FROM messages");
	$db = DB::getInstance();
	$bill_data = array();
	if (Input::exists()/*  && Input::get('ADD') != null */){
	
		for($i = 1; $i<(int)$_POST['counter']; $i++){
			
			$bill_data[$_POST["productName_$i"]] = array(
					'quantity' 	        => $_POST["quantity_$i"],
					'productRate' 	    => $_POST["productRate_$i"],
					'MRP' 				=> $_POST["MRP_$i"],
					'batchNo' 			=> $_POST["batchNo_$i"],
					'packSize' 			=> $_POST["packSize_$i"],
					'expiryDate' 		=> $_POST["expiryDate_$i"],
					'manufacturer' 		=> $_POST["manufacturer_$i"],
					'purchaseSize' 	    => $_POST["purchaseSize_$i"],
					'Tax' 				=> $_POST["Tax_$i"],
					'shelf' 			=> $_POST["shelf_$i"],
					'cost'              => $_POST["cost_$i"],
				);
				
		}
		
			}
			if (Input::exists()){
		//var_dump($bill_data);
		$update = $db->update('customers',array('customer_name', '=',$_POST["patient_name"] ), array(
			
				'bal_amt' => $_POST['bal_amt'],
				
			));
		}
		
	if (Input::exists()){
	
		for($i = 1; $i<(int)$_POST['counter']; $i++){
		$get = DB::getInstance()->query("select * from purchasebills where productName='".$_POST["productName_$i"]."' ");
		foreach ($get->results() as $key => $value){
		  $tab = ($value['tabQuantity'])-$_POST["quantity_$i"];
		 
		 $insert = $db->update('purchasebills',array('productName', '=',$_POST["productName_$i"] ), array(
				'tabQuantity' => $tab,

			));
		 
			
		}
	}
	if (Input::exists()){
	
	
		$get = DB::getInstance()->query("select * from customers where customer_name='".$_POST["patient_name"]."' ");
		if ($get->count()> 0){
		 
		}else{
		 
		 $insert = $db->insert('customers', array(
				'customer_name' => $_POST['patient_name'],
				'customer_address' => $_POST['patient_address'],
				'phone_no' => $_POST['phone_no'],
				'city' => $_POST['patient_city'],
				

			));
		 
			
		}
	
	}
	}
		$bill = json_encode($bill_data);
		
		//print_r($bill);
		// if (Input::exists() && Input::get('submit') != null){
		//var_dump($bill_data);
		
	
	
		$getbill = DB::getInstance()->query("select * from patients where bill_no='".$_POST['billNo']."' ");
		if($getbill->count()> 0)
		{
		 $insert = $db->update('patients',array('bill_no', '=',$_POST['billNo'] ), array(
				'bill_no' => $_POST['billNo'],
				'date' 	=> $_POST['billDate'],
				'patient_name' => $_POST['patient_name'],
				'patient_address' => $_POST['patient_address'],
				'phone_no' => $_POST['phone_no'],
				'patient_city' => $_POST['patient_city'],
				'doctor_name' => $_POST['doctor_name'],
				'doctor_city' => $_POST['doctor_city'],
				'cash-or-credit' => $_POST['cash_or_credit'],
				'bill' => $bill,
				'total_amt' => $_POST['totalAmt'],
				'paid_amt' => $_POST['paid_amt'],
				'discount' => $_POST['discount'],
				'totalDiscount' => $_POST['totalDiscount'],
				'bal_amt' => $_POST['bal_amt']
			));
		}
		else{
			$insert =  DB::getInstance()->insert('patients', array(
				'bill_no' => $_POST['billNo'],
				'date' 	=> $_POST['billDate'],
				'patient_name' => $_POST['patient_name'],
				'patient_address' => $_POST['patient_address'],
				'phone_no' => $_POST['phone_no'],
				'patient_city' => $_POST['patient_city'],
				'doctor_name' => $_POST['doctor_name'],
				'doctor_city' => $_POST['doctor_city'],
				'cash-or-credit' => $_POST['cash_or_credit'],
				'bill' => $bill,
				'total_amt' => $_POST['totalAmt'],
				'paid_amt' => $_POST['paid_amt'],
				'discount' => $_POST['discount'],
				'totalDiscount' => $_POST['totalDiscount'],
				'bal_amt' => $_POST['bal_amt']
			));
		}
	
?>
<!DOCTYPE html>

<html>
<head>
	<title>Bill</title>
	<script src="script/jquery-min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/theme.css">--> 
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	

</head>
<script language="javascript">
 function printpage()
  {
   window.print();
  }
</script>

<body>
<div id="container_bill">
	<div class="contain_1">
		<div class="Top_Left">
		<div class="heading">
			<div class="head1">WINSMED'S</div>
			<div class="head2">
				<div class="head_tl">Shree Gurudeo Medicose</div>
					<center><div style="background-color:#587942;height:17px;width:170px;color:white;">
					CHEMIST & DRUGIST</div>

					</center>			
					<div class="head_sbtl">
					Bharusali Multispeciality Hospital,Vakli line,Paratwada
					</div>
			
			</div>
		</div>
			<div class="div_tb">
			<table class="table_1">
			<tr style="background-color:#587942;color:#ffffff;width:480px;border-radius:4px;">
				<td style="text-align:center;">MEMO</td>
				<td style="text-align:center;">BILL NO</td>
				<td style="text-align:center;">DATE</td>
			</tr>
			<tr>
				<td><br/><?php echo $_POST['cash_or_credit'] ;?></td>
				<td><br/><center><?php echo $_POST['billNo'] ;?></center></td>
				<td><br/><?php echo date(("d-m-y"),strtotime($_POST['billDate']));?></center></td>
			</tr>
			</table>
			</div>
		</div>
		<div class="Top_Right">
		<div class="Tp_t">
		<div style="float:left;">D. L. No:&nbsp;20-50145<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		20-50146<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		20C-50147</div>
			<div style="float:right;width:200px;height:60px;">
			<div style="color:#587942">VAT TIN:27771135443 V/C</br></div>
			<div style="color:#587942"><i class="fa fa-phone"></i>07223-220632</div>
		</div></div>
		<div class="Tp_b">
			<div style="color:#587942;font-weight:bold;padding-left:10px;" >
			Pt's Name &nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['patient_name'] ;?></br>
			Address	  &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['patient_address'] ;?></br>
			Dr's Name &nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_POST['doctor_name'] ;?></br>
			Address	  &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo	$_POST['doctor_city'] ;?></div>
		</div>
		</div>
		
	</div>
	<div id="table_main">
	<table border="1" cellpadding="0" cellspacing="0" width="1000px" height="250px" >
	    
		<tr class="thead" >
	        
			<td width="10px">Shelf</td>
			<td width="100px" > Name Of Drug </td>
			<td width="50px"> Pack. </td>
			<td width="50px"> Mfg </td>
			<td width="30px"> B.No. </td>
			<td width="40px" > Ex. Dt.</td>
			<td width="50px" > Qty.</td>
			<td width="50px" > Amount </td>
		
		</tr>
		
		
	<?php $srno=1;$no=1;for($i = 1; $i<(int)$_POST['counter']; $i++){ ?>
	<tr>
			<td><?php echo $_POST["shelf_$i"] ?></td>
			<td><?php echo $_POST["productName_$i"] ?></td>
			<td><?php echo $_POST["packSize_$i"] ?></td>
			<td><?php echo $_POST["manufacturer_$i"] ?></td>
			<td ><?php echo $_POST["batchNo_$i"]?></td>
			<td><?php echo $_POST["expiryDate_$i"] ?></td>
			<td><?php echo $_POST["quantity_$i"] ?></td>
			<td style="background-color:#C3D9A8;"><?php echo $_POST["productRate_$i"] ?></td>
	</tr>
	<?php $no = $srno-$no;$srno++; }?>
		
		</table>
	</div>
	<div class="foot-base">
		<div class="left-footer">
		<ul >
		<li>Paratwada U/o Evolet Enterprises Pvt. Ltd.</li>
		<li>Difference in price if found,will be refunded.</li>
		<li>Subject to Nagpur Jurisdiction.</li>
		<li>"Prices Charged includes all Recoverable Taxes Suffered" E. & O.E.</li>
		<li>Certified that our Rgtn No. under M.S. VAT act 2002 is in force on the date of this sale.</li>
		<ul></div>
		
		<div class="right-footer">
		<?php foreach($res->results() as $data => $msg){ ?>
		<br><?php echo $msg['message']; ?>
		<?php } ?>
		
		</div>
		<div class="foot-base1"><center >
		</br><?php echo $no; ?></br>No.of items</center ></div>
		<div class="foot-base2"></br></br>signature of Q.P</div>
		<div class="foot-base3"><center ></br>
		<!--Discount :<?php // echo $_POST["totalDiscount"] ?></br>-->
		TOTAL :<?php echo $_POST["paid_amt"] ?></center></div>

		
	</div>
	<div >
			<div class="input-group col-lg-12" align="center" style="padding-left:400px;padding-top:30px;">
				
				
				<span style="">
					<input type="reset" name="reset" id="reset" value="Print" value="Print" onclick="printpage();" class="btn btn-success col-md-2" >
				</span>
				<span >
					<a href="sells.php"><input type="submit"  onclick="window.location('sells.php');"name="submitUpdate" id="submitUpdate" value="Exit" class="btn btn-success col-md-2">
			</a>
				
				</span>
				
			</div>

</div>
</body>
</html>
