<?php 

require_once('core/init.php');


if (Input::exists()){
	$functionName = Input::get('access');
	
	switch ($functionName){
		case 'getDrug':
			getDrug();
			break;
		case 'importBills':
			importBills();
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

function deleteDrug(){
	if (Input::exists()){
		$db = DB::getInstance();

		$delete = $db->query("DELETE FROM items WHERE `productName` = ?", array(Input::get('productName')));
		if (!$delete->error()){
			echo "Product entry deleted!";
		}else{
			echo "Error! Something went wrong during process.";
		}
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
}?>