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

	$details = $db->get("tax_masters", array('vat_catogary', '=', $name));

	if ($details){
		$data = [];
		$data['vat_catogary'] = $details->first()['vat_catogary'];
		$data['vat'] = $details->first()['vat'];
		$data['lbt'] = $details->first()['lbt'];
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
		$get = $db->query("SELECT * FROM tax_masters WHERE `vat_catogary` LIKE ?", array($searchTerm));
		

		if (!$get->error() && $get->count() > 0){
			foreach ($get->results() as $key => $value) {
				echo "<option value='{$value['vat_catogary']}'>{$value['vat_catogary']}</option>";
			}
		}else{
			print_r($get->results());
		}
	}
}