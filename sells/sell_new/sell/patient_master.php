<?php
require_once('core/init.php');
	$db = DB::getInstance();

if (Input::exists() && Input::get('submit') != null ){
$insert = $db->insert('patient_masters', array(
					'name' 		=> $_POST["name"],
					'address' 	=> $_POST["address"],
					'city' 	    => $_POST["city"],
					'ward' 	    => $_POST["ward"],
					'phone' 	=> $_POST["phone"],
				  ));
		}	
	
	
	
?>
<html>
<head>
<script src="script/patient_common.js"></script>
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
#btn{
	width:80%;
	margin:0 auto;
}
#tbl1{
	border:1px solid black;
	width:80%;
	margin:0 auto;
}
#thtr{
	border:1px solid black;
	background-color:#6283D0;
}
</style>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="container-fluid">
		<form method="post" id="addForm">
				<div class="row">
            	<div class="titles">Name:</div>
                <div ><input type="text" class="form-control3" name="name" style="width:300px;" list="Name_list"  required pattern="[A-Za-z]*">
				<datalist id="Name_list">

				<?php
				
							$query = $db->query("SELECT * FROM patient_masters");
							 $results = $query->results();
							
							foreach ($results as $record) {
								
						?>
							<option value="<?php echo $record['name']; ?>"><?php echo $record['name']; ?></option>
						<?php
							}
						 ?>
				</datalist>

				</div>
				</div>
				<div class="row">
            	<div class="titles">Address : </div>
                <div >
				<textarea name="address" id="address" class="form-control3" style="width:300px;"  pattern="[A-Za-z]*"></textarea>
				</div>
            </div>
			  <div class="row">
            	<div class="titles">City : </div>
                <div >
				<input type="text" name="city" id="city" class="form-control3" style="width:300px;" list="Name_city">
				<datalist id="Name_city">
					<?php
				
							$query = $db->query("SELECT * FROM cities");
							 $results = $query->results();
							
							foreach ($results as $record) {
								
						?>
							<option value="<?php echo $record['name']; ?>"><?php echo $record['name']; ?></option>
						<?php
							}
						 ?>
				</datalist>
				</input>
				</div>
            </div>
          
            <div class="row">
            	<div class="titles">Ward:</div>
                <div ><input type="text" class="form-control3" name="ward" style="width:300px;" pattern="[0-9]+"></div>
            </div>
            <div class="row">
            	<div class="titles">Phone No :</div>
                <div ><input type="phone" class="form-control3" name="phone" style="width:300px;" pattern="^\d{10}$"></div>
            </div>
            <div class="row" style="padding-left:100px;">
            	<div id="btn">
                	
                	<input type="reset"  class="btn btn-primary" value="Cancel" name="Cancel">
                	<a href="patient_modify.php"><input type="button" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this  detail.');" value="F9 Modify" name="F9 Modify"></a>
                	<a href="patient_delete.php"><input type="submit" class="btn btn-primary" value="F6 Delete" name="F6 Delete">
                	<input type="submit" class="btn btn-primary" value="F10 Save" name="submit" >
                	<input type="submit" class="btn btn-primary" value="Esc-Exit"  name="Esc-Exit">
               	</div>
            </div>
			
        </form>
	</div>
</body>
</html>