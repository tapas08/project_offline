<?php
require_once('core/init.php');
	$db = DB::getInstance();

if (Input::exists() && Input::get('submit') != null ){
$insert = $db->insert('messages', array(
					'message' => $_POST["message"],
					
				  ));
		}	
	
	
	
?>
<html>
<head>
<script src="script/patient_common.js"></script>
<title> Patient Details </title>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<!--<style>
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
</style>-->
</head>
<body>
	<div class="container">
		<form method="post" id="addForm">
				<div class="row">
	
					<div class="titles"><label class="control-label">Message :</label></div>
					<div ><input type="textarea" class="form-control" name="message"></div>
				</div>
				
			<div class="row" style="padding-left:230px;">
            	<div id="btn">
                	
                	<a href="#"><input type="submit" class="btn btn-primary" value="F6 Delete" name="F6 Delete">
                	<input type="submit" class="btn btn-primary" value="F10 Save" name="submit" >
                	<input type="submit" class="btn btn-primary" value="Esc-Exit"  name="Esc-Exit">
               	</div>
            </div>
			
        </form>
	</div>
</body>
</html>