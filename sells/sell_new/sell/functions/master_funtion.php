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
	$name = Input::get('drug');

	$details = $db->get("patient_masters", array('name', '=', $name));

	if ($details){
		$data = [];
		$data['name'] = $details->first()['name'];
		$data['address'] = $details->first()['address'];
		$data['city'] = $details->first()['city'];
		$data['ward']  = $details->first()['ward'];
		$data['phone'] = $details->first()['phone'];
		//patient data//
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
		$get = $db->query("SELECT * FROM patient_masters WHERE `name` LIKE ?", array($searchTerm));
		

		if (!$get->error() && $get->count() > 0){
			foreach ($get->results() as $key => $value) {
				echo "<option value='{$value['name']}'>{$value['name']}</option>";
			}
		}else{
			print_r($get->results());
		}
	}
}