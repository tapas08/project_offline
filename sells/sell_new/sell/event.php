<?php

require_once('core/init.php');

$db = DB::getInstance();
$productGroup = [];
$message = [];

if (Input::exists() && Input::get('submitUpdate') != null){
	$insert = $db->insert('events', array(
			'name'			    => Input::get('Headname'),
			'address'			=> Input::get('Addr'),
			'phone_no'			=> Input::get('ph_no'),
			'mobile_no'			=> Input::get('mo_no'),
			'remind_date'		=> Input::get('remind_date'),
			'event_to_remind'	=> Input::get('EventToRemind'),
			'criteria'			=> Input::get('Criteria'),
			'before_days'		=> Input::get('BeforeDays'),
			'description'		=> Input::get('Description')
			
		));

	//print_r($_POST);

	if ($insert){
		$message[] = "New Event Saved";
	}else{
		$message[] = "SOmething went wrong!!!";
	}
}

?>

<!DOCTYPE <html>
<head>
	<title>Event Change</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<?php include('templates/eventheader.php'); ?>

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
	
			include('forms/addevent.php'); 
		

	?>
</section>	

