<?php 

require_once('core/init.php');

$db = DB::getInstance();
$message = [];

if (Input::exists()){
		$db = DB::getInstance();

		$delete = $db->query("DELETE FROM doctor_details WHERE `doctor_name` = ?", array(Input::get('doctor_name')));
		if (!$delete->error()){
			echo "Doctor entry deleted!";
		}else{
			echo "Error! Something went wrong during process.";
		}
	}


?>
<!DOCTYPE <html>

	<head>
		<title>Doctor Master</title>
	</head>
		
		<link rel="stylesheet" type="text/css" href="css/style2.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="css/theme.css"> -->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		
		<script src="script/jquery-min.js"></script>
	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <script src="script/jquery.mtz.monthpicker.js"></script>
		
<body>
<form method="post" id="deleteForm" action=" ">
			<div class="container1">
					
					<center><h2 class="alert alert-success1" id="Message"> Doctor Master </h2></center>
			
				
				
					<div class="in_container">
						
					<div class="input-group col-lg-12 input-divs">
					     <span class="col-lg-2"><label for="DoctorName"><!--<i class="fa fa-tag"></i> -->Doctor Name</label></span>
					    <span class="col-lg-4"><input type="text" id="doctor_name" class="form-control" name="doctor_name" placeholder="Doctor Name" list="DoctorList" oninput ="getList2('doctor_name','DoctorList',false,true);" required pattern ="[A-Za-z]*"
						style="width:400px;"></span>
					    <datalist id="DoctorList"></datalist>
					</div>

				</div>
						
					<br/>
					
					<div class="in_container">
						
						<div class="input-group col-lg-12 input-divs">
					     <span class="col-lg-2"><label for="Address"><!--<i class="fa fa-tag"></i> -->Address</label></span>
					    <span class="col-lg-4"><textarea style="width:400px" placeholder="Address" id="address" name="address">&nbsp;</textarea></span>
					    
					</div>
						
						
					</div><br><br><br>
					
					
					<div class="in_container">
						
					<div class="input-group col-lg-12 input-divs">
					  <span class="col-lg-2"><label for="city" class="control-label">City</label></span>
					  <span class="col-lg-4"  >
						<select name="city" id="city" class="form-control" style="width:400px;">
							<option value="0" >Amravti</option>
							<option value="1" >Washim</option>
							<option value="2" >Pune</option>
							<option value="3" >Akola</option>
							<option value="4" >Nagpur</option>
							<option value="5" >Mumbai</option>
						</select>
					</span>
			</div>
						
						
					</div><br>
					
					<div class="in_container">
						
						<div class="input-group col-lg-12 input-divs">
					     <span class="col-lg-2"><label for="Qualification"><!--<i class="fa fa-tag"></i> -->Qualification</label></span>
					    <span class="col-lg-4"><input type="text" id="qualification" class="form-control" name="qualification" placeholder="qualification"  style="width:400px" ></span>
					   
					</div>
						
						
					</div><br>
					
					<div class="in_container">
						
						<div class="input-group col-lg-12 input-divs">
					     <span class="col-lg-2"><label for="reg_no"><!--<i class="fa fa-tag"></i> -->Reg No.</label></span>
					    <span class="col-lg-4"><input type="text" id="reg_no" class="form-control" name="reg_no" placeholder="Reg no" style="width:400px"
						></span>
					  
					</div>
						
						
					</div><br>
					
					<div class="in_container">
						
						<div class="input-group col-lg-12 input-divs">
					     <span class="col-lg-2"><label for="ContactNo"><!--<i class="fa fa-tag"></i> -->Contact no</label></span>
					    <span class="col-lg-4"><input type="phone" id="contact_no" class="form-control" name="contact_no" placeholder="contact no" style="width:400px"></span>
					  
					</div>
						
						
					</div><br>
					
					
					<div class="in_container">
						
						<div class="input-group col-lg-12 input-divs">
					     <span class="col-lg-2"><label for="DoctorNo"><!--<i class="fa fa-tag"></i> -->Doctor no</label></span>
					    <span class="col-lg-4"><input type="text" id="doctor_no" class="form-control" name="doctor_no" placeholder="doctor no" style="width:400px" ></span>
					    
					</div>
						
				 		</div><br>
					
				<br/>
				
				<div class="col-md-8" style="margin-left:200px;">
						
						<input type="reset" form="invoiceForm" id="reset" name="reset" class="btn btn-primary" value="Cancel">
						<input type="submit" id="pendingDM" name="delete" class="btn btn-primary" form="deleteForm" value="F8 Delete">
						
						<!--<input type="submit" name="submit" class="btn btn-primary" value="F10 Save">-->
						<input type="submit"  id="saveInvoice" name="Exit" class="btn btn-primary" value="Esc Exit">
				
				</div>
					
					
		</div>
</form>
	
	<script src="script/d_common.js"></script>
	<script src="script/bootstrap.min.js"></script>
	<script>
	function getData(){
			var drug = $('#doctor_name').val();
		
			console.log("getdata!!!");
			//console.log(id);
			//alert(id);
			$.ajax({
				type: 'post',
				url: 'functions/doctor_function.php',
				dataType: 'json',
				data: {
					drug: drug,
					access: 'insertData'
				},
				success: function(data){
					console.log(data);
					//$('#quantity'+id).val(data.quantity);
					
					
					$('#address').val(data.address);
					$('#city').val(data.city);
					$('#qualification').val(data.qualification);
					$('#reg_no').val(data.reg_no);
					$('#contact_no').val(data.contact_no);
					$('#doctor_no').val(data.doctor_no);
					
				},
				error: function(data){
					console.log(data);
				}
			});
			console.log("getdataend");
		}
	</script>
</body>
</html>



