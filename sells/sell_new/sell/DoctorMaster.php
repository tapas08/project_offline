<?php

require_once('core/init.php');

$db = DB::getInstance();
$message = [];

if (Input::exists()){

		$insert = $db->insert('doctor_details', array(
			'doctor_name'		=> Input::get('doctor_name'),
			'address'			=> Input::get('address'),
			'city'				=> Input::get('city'),
			'qualification'		=> Input::get('qualification'),
			'reg_no'			=> Input::get('reg_no'),
			'contact_no'		=> Input::get('contact_no'),
			'doctor_no'		    => Input::get('doctor_no')
	));

	//print_r($_POST);

	if ($insert){
		$message[] = "New doctor details Saved";
	}else{
		$message[] = "SOmething went wrong!!!";
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
		
<body>
	
<section class="container" id="formArea">

	<div>
	
		<?php
		if (count($message) > 0){
			foreach($message as $msg){
				echo "<p class='alert alert-info'>$msg</p>";
			}
		}
		?>

	</div>
	<?php 
	
			include('forms/adddoctor.php'); 
		

	?>
</section>	

</body>
</html>