<?php

require_once('core/init.php');

$db = DB::getInstance();
$message = [];

if (Input::exists()){
	$insert = $db->insert('kit_details', array(
			'kit_name'		=> Input::get('kit_name'),
			'kit_type'		=> Input::get('kit_type'),
			'pat_address'	=> Input::get('pat_address'),
			'doctor_name'	=> Input::get('doctor_name'),
			'remind_days'	=> Input::get('remind_days'),
			'product'		=> Input::get('product'),
			'qty'		    => Input::get('qty'),
			'doc_city'		=> Input::get('doc_city')
	));

	//print_r($_POST);

	if ($insert){
		$message[] = "New kit details Saved";
	}else{
		$message[] = "SOmething went wrong!!!";
	}
}

?>

<html>
<head><title>Kit Defination</title>
		
		<link href="css/kit.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style2.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="css/theme.css"> -->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>	
   <body>
   
<form method="post" id="addForm" action="#">
    <!--<div id="container">
	   <div id="header">-->
	     <!--<div class="h1">
		 <!--<center><font style="font-size:18px;color:#C1121B;font-weight:bold;padding-left:150px;">KIT DEFINATION</font></center>-->
		 <center><h2 class="alert alert-success1" id="Message" style="width:600px;"> Kit defination </h2></center>
		 
		 <!--</div>-->
	     <!--<div class="h2">
            <input type="Button" value="Cancel"       style="float:left;width:120px;background-color:white;padding-top:2px">
			<input type="Button" value="F9 Modify"       style="float:left;width:120px;background-color:white;padding-top:2px">
			<input type="Button" value="Delete Kit"  style="float:left;width:120px;background-color:white;padding-top:2px">
			<input type="Button" value="F10 Save"       style="float:left;width:120px;background-color:white;padding-top:2px">		
			<input type="Button" value="Exit"             style="float:left;width:120px;background-color:white;padding-top:2px">			
					
         </div>-->
		
		
		<div id="container2" style="padding-left:200px">
	   <div id="header2">
	    <!--<div class="head-h1">-->
		
				<div class="input-group col-lg-12 input-divs" >
		  
					
					<span class="col-lg-2"><label for="HeadName"><!--<i class="fa fa-tag">--></i> Kit Name</label></span>
					    
					<span class="col-lg-4"><input type="text" id="HeadName" class="form-control" name="kit_name" placeholder="Kit Name" list="nameList" oninput="getDrug();" required pattern ="[A-Za-z]*" style="width:400px;"></span>
					    <datalist id="Headname"></datalist>
				</div>
						
		
		 
		  
			<div class="input-group col-lg-12 input-divs">
					  <span class="col-lg-2"><label for="kitType" class="control-label">Kit type</label></span>
		     <span class="col-lg-4"  >
					<select name="kit_type" id="kit_type" class="form-control" style="width:400px;">
		     
		            <option>Patient Kit</option>
					<option>AED & prep Kit</option>
					<option>Emergency Medical Kit</option>
					<option>Flu Kit</option>
					
					</select>
			</div> 
		  
		 <div class="input-group col-lg-12 input-divs">
					     
						<span class="col-lg-2"><label for="HeadName"><!--<i class="fa fa-tag"></i>--> Pat. Address</label></span>
					    <span class="col-lg-4"><textarea  name="pat_address" required pattern ="[A-Za-z]*" placeholder="address">&nbsp; </textarea></span>
					  
		</div>
		  
		  <div class="input-group col-lg-12 input-divs">
					     
						<span class="col-lg-2"><label for="DoctorName"><!--<i class="fa fa-tag"></i>--> Doctor Name</label></span>
					    <span class="col-lg-4"><input type="text" id="doctor_name" class="form-control" name="doctor_name" placeholder="doctor name" list="nameList" oninput="getDrug();" style="width:400px" required pattern ="[A-Za-z]*"></span>
					  
		  </div>
		   
		 <div class="input-group col-lg-12 input-divs">
					
					<span class="col-lg-2"><label for="remind_days"><!--<i class="fa fa-plus-square"></i>--> Remind days</label></span>
					<span class="col-lg-4"><input type="number" id="remind_days" class="form-control" name="remind_days" placeholder="Remind Days" required pattern="[0-9]+"></span>
		
		</div>
		   
		   <div class="input-group col-lg-12 input-divs">
					     
						<span class="col-lg-2"><label for="Doc_qty"><!--<i class="fa fa-tag"></i>--> Doct. city</label></span>
					    <span class="col-lg-4"><input type="text" id="doc_qty" class="form-control" name="doc_city" placeholder="doct. city" list="nameList" oninput="getDrug();" style="width:400px" required pattern ="[A-Za-z]*"></span>
					  
			</div>
		  
		  
		 <div class="input-group col-lg-12 input-divs">
					     
						<span class="col-lg-2"><label for="product"><!--<i class="fa fa-tag"></i>--> Product</label></span>
					    <span class="col-lg-4"><input type="text" id="product" class="form-control" name="product" placeholder="product" list="nameList" oninput="getDrug();" style="width:400px" required pattern ="[A-Za-z]*"></span>
					  
			</div>
		   
		   
		 <div class="input-group col-lg-12 input-divs">
					     
						<span class="col-lg-2"><label for="quantity"><!--<i class="fa fa-tag"></i>--> qty</label></span>
					    <span class="col-lg-4"><input type="text" id="qty" class="form-control" name="qty" placeholder="qty" list="nameList" oninput="getDrug();" style="width:400px" required pattern="[0-9]+"></span>
					  
		</div>
        <!--</div> -->
		 
		
		<div class="col-md-8" style="padding-left:50px;padding-top:20px;">
						
						<input type="reset" form="invoiceForm" id="reset" name="reset" class="btn btn-primary" value="Cancel">
						<input type="button" id="pendingDM" name="pendingDM" class="btn btn-primary" onclick="checkPendingDM();" value=	"F8 Delete">	
						<a href="modifykit.php"><input type="button" id="convDM" name="convDM" class="btn btn-primary" value="F9 Modify"></a>
						<input type="submit" form="addForm" id="saveInvoice" name="submit" class="btn btn-primary" value="F10 
						Save">
						<input type="submit" form="invoiceForm" id="saveInvoice" name="Exit" onclick="checkAndSave();" class="btn btn-primary" value="Esc Exit">
				
		</div>
		
		
		  
		<!--<div style="width:80% ;height100px;" >
				
				
				
			<!--	<table style=" width:43%;background-color:#ffffff;margin-top:20px;">
		    
					<tr style="border:solid black 2px;">
						<td style="background-color:#286090;width:80%"> PRODUCT NAME</td>
						<td style="background-color:#286090;width:10%"> PACK</td>
						<td style="background-color:#286090;width:10%"> QTY</td>
					</tr>
					<tr>
						<td style="background-color:#ffffff;width:80%;height:150px"></td>
			 
					</tr>
				</table>
				-->
				
		  
		<!--</div> -->
	</div>
	</div>
  
   </form>
  </body>
</html>
