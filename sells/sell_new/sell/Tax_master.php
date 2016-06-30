<?php
require_once('core/init.php');
	$db = DB::getInstance();
$error =array();
if (Input::exists() && Input::get('submit') != null ){
if(empty($_POST['vat_category']))
{
$errors['vat_category']="Enter the Vat category ";
}
if(empty($_POST['vat']))
{
$errors['vat']="Enter the Vat";
}
if(empty($_POST['lbt']))
{
$errors['lbt']="Enter the LBT ";
}

$insert = $db->insert('tax_masters', array(
					'vat_catogary'=> $_POST["vat_catogary"],
					'vat' => $_POST["vat"],
					'lbt'  => $_POST["lbt"],
					));
		}	
	
	
	
?>
<html>
<head>
<title></title>

<link href="" type="text/css" rel="stylesheet">
<style>
.container{
margin:0 auto;
width:1000px;
background-color:#F0F0F0;
}
.header1{
width:60%;
margin:0 auto;

}
.h1col1{
float:left;
width:18%;
text-align:left;
padding-top:2px;
font-family:arial;
font-size:small;
font-weight:bold;
}
.h1col2{
margin-left:18%;
width:82%;
text-align:left;
padding-left:5px;
font-family:arial;
font-size:small;
font-weight:bold;
}
.h1col{
margin-left:18%;
width:100%;
text-align:left;
padding-left:5px;
font-family:arial;
font-size:small;
font-weight:bold;
}

.header2{
width:60%;
margin:0 auto;


}
</style>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="script/patient_common.js"></script>
</head>
<body>
<form method="post" id="addForm">
<div class="container-fluid">
		
		<div class="header1">
			<div class="h1col1">VAT CATEGORY :</div>
			<div class="h1col2">
				<input type="text" name="vat_catogary"  class="form-control2" list="vat_category_list">
				<datalist id="vat_category_list">
					<?php
						
	
							$query = $db->query("SELECT * FROM vat_category");
							
							 $results = $query->results();
							
							foreach ($results as $record) {
								
						?>
							<option value="<?php echo $record['vat_type']; ?>"><?php echo $record['vat_type']; ?></option>
						<?php
							}
						 ?>
				</datalist>
				</div><br>
				<div  style="background-color:#DFF0D8;color:#3D6330;width:60%;"><center>
				<?php if(isset($errors['lbt'])){ echo $errors['lbt']; }?>
				</center>
				</div>
			
			
			<div class="h1col1">VAT % :</div>
			<div class="h1col2">
			<input type="text" name="vat" class="form-control3"></div><br>
			<div   style="background-color:#DFF0D8;color:#3D6330;width:60%;"><center>
			<?php if(isset($errors['vat'])){ echo $errors['vat']; }?>
			</center>
			</div>
			

			
			<div class="h1col1">LBT % :</div>
			<div class="h1col2"><input type="text"  name="lbt" class="form-control3">
			</div><br>
			<div  style="background-color:#DFF0D8;color:#3D6330;width:60%;"><center>
			<?php if(isset($errors['lbt'])){ echo $errors['lbt']; }?>
			</center>
			</div>
			
			
		</div><br>
		<div class="header2" >
			<input type="button" name="Cancel" value="Cancel" class="btn btn-primary">
			<a href="Tax_delete.php"><input type="button" name="delete" value="F6 Delete" class="btn btn-primary">
			<a href="tax_modify.php"><input type="button" name="modify" value="F9 Modify" class="btn btn-primary"></a>
			<input type="submit" name="submit" value="F10 Save" class="btn btn-primary">
			<input type="button" name="exit" value="Esc-Exit " class="btn btn-primary">
		</div>
</div>
</form>
</body>
</html>