<?php
require_once('core/init.php');
	$db = DB::getInstance();

if (Input::exists() && Input::get('delete') != null ){

		$delete = $db->query("DELETE FROM patient_masters WHERE `name` = ?",array( Input::get('name')));
		if (!$delete->error()){
			echo "Product entry deleted!";
		}else{
			echo "Error! Something went wrong during process.";
		}
	}	
	
	
?>
<html>
<head>

<title> Patient Details </title>
<style>
.container{
	width:1000px;
	margin:0 auto;
	background-color:#999;
}
.row{
	width:80%;
	margin:0 auto;
	padding:5px;
}
.titles{
	width:30%;
	float:left;
	text-align:right;
}
.types{
	margin-left:30%;
	padding-left:15px;
}
</style>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="script/jquery-min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script src="script/jquery.mtz.monthpicker.js"></script>

</head>
<body>
	<div class="container-fluid">
		<form method="post" id="addForm">
        	<div class="row">
            	<div class="titles">Name:</div>
             <div >
			 <input type="text" class="form-control3" id="name" name="name" style="width:300px;"  list="patientlist" oninput="getList('name', 'patientlist', false, true);" autofocus></div>
            <datalist id="patientlist">
			</datalist>

			</div>
            <div class="row">
            	<div class="titles">Address : </div>
                <div>
				<textarea name="address" id="address" class="form-control3" style="width:300px;" list="drugList_1"></textarea>
				</div>
            </div>
			  <div class="row">
            	<div class="titles">City : </div>
                <div >
				<input type="text" name="city" id="city" class="form-control3" style="width:300px;" list="drugList_1">
				<datalist id="drugList_1">
				<?php
				$db = DB::getInstance();
							$query = $db->query("SELECT * FROM cities");
							 $results = $query->results();
							
							foreach ($results as $record) {
								//$itemData[$record['name']] = $record['name'];
						?>
							<option value="<?php echo $record['name']; ?>"><?php echo $record['name']; ?></option>
						<?php
							}
						 ?>
				</datalist>
				</input>
				</div>
            </div>
          
            <div class="row" >
            	<div class="titles">Ward:</div>
                <div ><input type="text" class="form-control3" id="ward" name="ward" style="width:300px;"></div>
            </div>
            <div class="row">
            	<div class="titles">Phone No :</div>
                <div ><input type="text" class="form-control3" id="phone" name="phone" style="width:300px;"></div>
            </div>
            <div class="row"style="padding-left:210px;">
            	<div id="btn">
                	
                	<a href="patient_masters.php"><input type="reset"  class="btn btn-primary" value="Cancel" name="Cancel"></a>
                	<input type="submit" class="btn btn-primary" value="F10 Delete" name="delete" >
                	<input type="submit" class="btn btn-primary" value="Esc-Exit"  name="Esc-Exit">
               	</div>
            </div>
			
        </form>
	</div>
	<script src="script/patient_common.js"></script>
	<script>
	function getData1(){
			var drug = $('#name').val();
		
			console.log("getdata!!!");
			//console.log(id);
			$.ajax({
				type: 'post',
				url: 'functions/master_funtion.php',
				dataType: 'json',
				data: {
					drug: drug,
					access: 'insertData'
				},
				success: function(data){
					console.log(data);
					$('#address').val(data.address);
					$('#city').val(data.city);
					$('#ward').val(data.ward);
					$('#phone').val(data.phone);
					
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