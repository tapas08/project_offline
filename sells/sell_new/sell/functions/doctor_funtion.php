<?php 

require_once('../core/init.php');
if (Input::exists()){
	$functionName = Input::get('access');

	switch ($functionName){
		case 'getDrug':
			getDrug();
			break;
		case 'insertData':
			insertData();
			break;
		case 'update':
			updateData();
			break;
		case 'delete':
			deleteDrug();
			break;
		case 'getList':
			getList(Input::get('table'));
			break;
	}
}

function insertData(){
	$db = DB::getInstance();
	$drug = Input::get('drug');

	$details = $db->get("doctor_details", array('doctor_name', '=', $drug));

	if ($details){
		$data = [];
		$data['doctor_name'] = $details->first()['doctor_name'];
		$data['city'] = $details->first()['city'];
		//doctor data//
		echo json_encode($data);
	}else{
		echo "ERROR!";
	}
}
function getList($table){
	//echo "$table";
	if (Input::exists()){
		$db = DB::getInstance();

		$searchTerm = Input::get('searchTerm');
		$searchTerm = "%$searchTerm%";
		//echo $searchTerm;
		$get = $db->query("SELECT * FROM doctor_details WHERE `doctor_name` LIKE ?",
		array($searchTerm));

	if (!$get->error()){
		//if($get->count() > 0){
			//insertData();
		//}
		foreach ($get->results() as $key => $value){
			echo "<option value='{$value['doctor_name']}'>{$value['doctor_name']}</option>";
		}
	}else{
		echo "Error!";
	}

}
}