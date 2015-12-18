<?php
require_once('core/init.php');

if(isset($_GET['loc']) && !empty($_GET['loc'])){
	$locations = array("nagpur", "pune", "yavatmal", "amravati");
	$loc = $_GET['loc'];
	if(in_array($loc, $locations)){
		$db = DB::getInstance(true)->query("SELECT * FROM ".$loc."_bill");
		if(!$db->error()){
			echo $db->count();

?>	

<!DOCTYPE <html>
<head>
	<title><?php echo strtoupper($loc); ?></title>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>

</body>
</html>

<?php		
		}
	}
}

?>