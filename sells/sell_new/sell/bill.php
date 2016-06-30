<?php
   require_once('core/init.php');
	$message = [];
	$get = array();
	// var_dump($_POST);
	$db=DB::getInstance();
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
	if (Input::exists()/*  && Input::get('ADD') != null */){
	
		for($i = 1; $i<(int)$_POST['counter']; $i++){
		$get = DB::getInstance()->query("select * from items where productName='".$_POST["productName_$i"]."' ");
		foreach ($get->results() as $key => $value){
		  $stock = ($value['stock'])-1;
		 
		 $insert = $db->insert('items', array(
				'stock' => $stock,

			));
		 
			
		}
	}
	
		$bill = json_encode($bill_data);
		
		//print_r($bill);
		// if (Input::exists() && Input::get('submit') != null){
		//var_dump($bill_data);
		$insert = $db->insert('patients', array(
				'bill_no' => $_POST['billNo'],
				'date' => $_POST['billDate'],
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
				//'discount' => $_POST['totalDiscount'],
				'bal_amt' => $_POST['bal_amt']
			));
		 }
 
?>

<!DOCTYPE html>
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

		

			<h1 class="main1" style="padding-left:580px"><b >Bill Generate</b></h1>

<div style="padding-top:80px;">
<form method="POST" action="sale_register.php">
<table border="1px" cellspacing="0" cellpadding="0" width="1000px" height="500px" align="center" class="border" style="padding-top:0px;">

    <tr>
	<td colspan="1">
		<table border="1" cellpadding="0" cellspacing="0" width="400px" height="200px">
		
		<tr class="main">
		    <td> <b>WINSMED'S</b></td>
		</tr>
		
		<tr class="main1">
		    <td >Shree Gurudeo Medicose</td>
		</tr>
		
		<tr class="main2" >
		   <td>CHEMIST & DRUGIST</td>
		</tr>
		
		<tr class="text" align="center">
			<td height="10px"> Bharusali Multispeciality Hospital,Vakli line,Paratwada
			</td>
		</tr>
		<tr>
		<td>
		
		<table border="2" cellpadding="0" cellspacing="0" width="3S00px" height="200px">
		    <tr class="main2">
		
		        <td width="30px">MEMO</td>
		        <td width="40px">BILL NO</td>
		        <td width="40px">DATE</td>
		
		    </tr>
		
		    <tr>
		        <td><center><?php echo $_POST['cash_or_credit'] ;?><center></td>
		        <td><center><?php echo $_POST['billNo'] ;?></center></td>
		        <td><center><?php echo date(("d-m-y"),strtotime($_POST['billDate']));?></center></td>
		    </tr>
		
		</table>
	
	   </td>
	   </tr>
	</table>
		
	</td>
	<td>
	<table border="0" cellpadding="0" cellspacing="0" width="300px" >
	    
		<tr>
		<td class="third_box">
			<table border="0" cellpadding="0" cellspacing="0" width="470px" height="20px">
				<tr >
					<td width="200px" >D. L. No:&nbsp;20-50145<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;21-50148<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;20C50147</td>
					<td width="250px" style="padding-left:300px;"><i class="fa fa-phone"></i>0712-234576</td>
				</tr>
		   
			</table>
		</td>
		</tr >

		<tr>
		<td class="first_box">
			
			<table border="0px" cellpadding="5px" cellspacing="5px" width="420px" height="330px" >
			
			<tr >
			<td class="table-space"> Pt's Name:</td>
			<td class="table-space"><?php echo $_POST['patient_name'] ;?> </td>
			</tr>
			
			
			<tr >
			<td class="table-space"> Address:</td>
			<td class="table-space"><?php echo $_POST['patient_address'] ;?> </td>
			</tr>
		
			
			<tr >
			<td class="table-space"> Doctor's Name:</td>
			<td class="table-space"><?php echo $_POST['doctor_name'] ;?> </td>
			
			</tr>
		
			
			<tr >
			<td class="table-space"> Address:</td>
			<td class="table-space"><?php echo	$_POST['doctor_city'] ;?> </td>
			
			
			</tr>
			
			</form>
			</table>
		</td>
		</tr>
		
	</table>
	</td>
	</tr>`
	
	<tr>
	<td colspan="2">
		<table border="1" cellpadding="0" cellspacing="0" width="1000px" height="130px" >
	    
		<tr class="second_box" >
	        
			<td width="10px">Sr. No.</td>
			<td width="80px" > Name Of Drug </td>
			<td width="80px"> Pack. </td>
			<td width="50px"> Mfg </td>
			<td width="30px"> B.No. </td>
			<td width="40px" > Ex. Dt.</td>
			<td width="50px" > Qty.</td>
			<td width="50px"> Amount </td>
		
		</tr>
		<?php for($i = 1; $i<(int)$_POST['counter']; $i++){ ?>
		<tr>
			<td><?php echo $i  ?>           </td>
			<td><?php echo $_POST["productName_$i"] ?></td>
			<td><?php echo $_POST["packSize_$i"] ?></td>
			<td><?php echo $_POST["manufacturer_$i"] ?></td>
			<td ><?php echo $_POST["batchNo_$i"]?></td>
			<td><?php echo $_POST["expiryDate_$i"] ?></td>
			<td><?php echo $_POST["quantity_$i"] ?></td>
			<td class="box"><?php echo $_POST["cost_$i"] ?></td>
			
		
		</tr>
		<?php }?>
		<tr >
		<td width="100px" colspan="7" style="padding-left:20px;"><b> # WISH YOU A SPEEDY RECOVERY # </b></td>
		</tr>

	</table>
	</td>
	</tr>
	
	
	<tr>
	<td colspan="2">
	<table border="1px" width="1000px" cellpadding="0" cellspacing="0" align="center" height="80px">
		<tr>
			<td width="100px">&nbsp;</td>
			<td width="50px" style="padding-top:50px;" align="center">No. of Items</td>
			<td width="50px" style="padding-top:50px;" align="center">Signature of Q.P.</td>
			<td width="40px" class="box"><?php echo $_POST['totalAmt']?></td>
		</tr>
	</table>
	</td>
	</tr>

</table>


</div>
<br/>

			<div >
			<div class="input-group col-lg-12" align="center" style="padding-left:600px;">
				
				
				<span style="padding-right:40px;">
					<input type="reset" name="reset" id="reset" value="Print" value="Print" onclick="printpage();" class="btn btn-success col-md-2" >
				</span>
				<span >
					<input type="submit" name="submitUpdate" id="submitUpdate" value="Exit" class="btn btn-success col-md-2">
				</span>
				
			</div>
		</div>



</body>
</html>