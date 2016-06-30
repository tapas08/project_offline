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

	$details = $db->get("customers", array('customer_name', '=', $drug));

	if ($details){
		$data = [];
		$data['customer_name'] = $details->first()['customer_name'];
		$data['customer_address'] = $details->first()['customer_address'];
		$data['phone_no']  = $details->first()['phone_no'];
		$data['city'] = $details->first()['city'];
		$data['bal_amt'] = $details->first()['bal_amt'];
		//patient data//
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
	//echo "$table";
	if (Input::exists()){
		$db = DB::getInstance();

		$searchTerm = Input::get('searchTerm');
		$searchTerm = "%$searchTerm%";
		//echo $searchTerm;
		$get = $db->query("SELECT * FROM customers WHERE `customer_name` LIKE ?", array($searchTerm));

	if (!$get->error()){
		//if($get->count() > 0){
			//insertData();
		//}
		foreach ($get->results() as $key => $value){
			echo "<option value='{$value['customer_name']}'>{$value['customer_name']}</option>";
		}
	}else{
		echo "Error!";
	}

}
}