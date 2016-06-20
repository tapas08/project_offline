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

function getDrug(){
	$db = DB::getInstance();
	$searchTerm = Input::get('searchTerm');
	$searchTerm = "%$searchTerm%";

	$get = $db->query("SELECT * FROM purchasebills WHERE `productName` LIKE ?", array($searchTerm));

	if (!$get->error()){
		//if($get->count() > 0){
			//insertData();
		//}
		foreach ($get->results() as $key => $value){
			echo "<option value='{$value['productName']}'>{$value['productName']}</option>";
		}
	}else{
		echo "Error!";
	}

}

function insertData(){
	$db = DB::getInstance();
	$drug = Input::get('drug');
	
	$details = $db->get("purchasebills", array('productName', '=', $drug));

	if ($details){
		$data = [];
		$data['supplier'] = $details->first()['supplier'];
		/* $get = DB::getInstance()->query("SELECT * FROM stockist_name WHERE name = ?", array($data['supplier']));
		foreach ($get->results() as $key => $value){
		$data['manufacturer'] = DB::getInstance()->get('company_name', array("id", '=', $value['company_id'] ))->first()['name'];
		}*/
		$data['manufacturer'] =  DB::getInstance()->get('items', array("productName", '=', $drug))->first()['manufacturer'];
		$data['productQuantity'] = $details->first()['productQuantity'];
		$data['purchaseSize'] = $details->first()['purchaseSize'];
		$data['batchNo'] = $details->first()['batchNo'];
		$data['expiryDate'] = $details->first()['expiryDate'];
		$data['MRP'] = $details->first()['MRP'];
		$data['Tax'] = DB::getInstance()->get('items', array("productName", '=', $drug))->first()['Tax'];
		$data['shelf'] = DB::getInstance()->get('items', array("productName", '=', $drug))->first()['shelf'];
		$data['stock']=$details->first()['tabQuantity'];;
		//$data['stock'] = DB::getInstance()->get('items', array("productName", '=', $drug))->first()['stock'];
		echo json_encode($data);
	}else{
		echo "ERROR!";
	}
}

function updateData(){
	$db = DB::getInstance();
	if (Input::exists()){
		$update = $db->update('items', array('productName', '=', Input::get('productName')), array(
				'marketedBy'	=> Input::get('productMarketedBy'),
				'manufacturer'	=> Input::get('productManftr'),
				'productName'	=> Input::get('productName'),
				'packSize'		=> Input::get('productPackSize'),
				'productRate' 	=> Input::get('productRate'),
				'MRP' 			=> Input::get('productMRP'),
				'Tax' 			=> Input::get('productTax'),
				'shelf' 		=> Input::get('productShelf'),
				'mainCategory' 	=> Input::get('productMainCategory'),
				'subCategory' 	=> Input::get('productSubCategory'),
				'productType' 	=> Input::get('productType'),
				'productGroup' 	=> Input::get('productGroup'),
				'orderQuantity' => Input::get('productOrderQuantity'),
				'quantity' 		=> Input::get('productQuantity'),
				'VAT' 			=> Input::get('productVat'),
				'reorderLvl' 	=> Input::get('productReorderLvl'),
				'drugContent' 	=> Input::get('productContent')
			));
		
		if ($update){
			echo "Product entry updated!";
		}else{
			echo "Error! Something went wrong during process.";
		}

	}else{
		echo "No Input";
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
	if (Input::exists()){
		$db = DB::getInstance();

		$searchTerm = Input::get('searchTerm');
		$searchTerm = "%$searchTerm%";

		$get = $db->query("SELECT * FROM {$table} WHERE `name` = ?", array($searchTerm));
		print_r($get);

		if (!$get->error() && $get->count() > 0){
			foreach ($get->results() as $key => $value) {
				echo "<option value='",$value['abbreviation'],"'>{$value['abbreviation']}  {$value['name']}</option>";
			}
		}
	}
}