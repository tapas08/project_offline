<?php 

require_once('core/init.php');


if (Input::exists()){
	

function getDrug(){
	$db = DB::getInstance();


   
	if($_POST['type'] == 'country_table'){
	$row_num = $_POST['row_num'];
	$patients =$db->query( "SELECT patient_name,patient_address,phone_no,patient_city  FROM patients where name LIKE '".strtoupper($_POST['name_startsWith'])."%'");	
	$data = array();
	foreach ($patients->resulst() {
		$name = $row['patient_name'].'|'.$row['patient_address'].'|'.$row['phone_no'].'|'.$row['patient_city'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
}
}
?>