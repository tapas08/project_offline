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
		case 'check_and_save_company':
			check_and_save_company();
			break;
		case 'save_stockist':
			save_stockist();
			break;
	}
}

function getDrug(){
	$db = DB::getInstance();
	$searchTerm = strtoupper(Input::get('searchTerm'));
	$searchTerm = strtoupper("%$searchTerm%");

	$get = $db->query("SELECT * FROM purchaseBills WHERE `productName` LIKE ?", array($searchTerm));

	if (!$get->error()){
		// if($get->count() > 0){
		// 	insertData();
		// }
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
	$details = $db->get("purchaseBills", array('productName', '=', $drug));
	$invoiceDetails = DB::getInstance()->query("SELECT * FROM purchaseBills WHERE productName = ? AND batchNo = ?", array($drug, Input::get('batchNo')));

	if ($details){
		$data = [];
		$data['marketedBy'] = $details->first()['marketedBy'];
		$data['manufacturedBy'] = $details->first()['manufacturer'];
		$data['packSize'] = $details->first()['packSize'];
		$data['batchNo'] = $invoiceDetails->first()['batchNo'];
		$data['expiryDate'] = $invoiceDetails->first()['expiryDate'];
		$data['quantity'] = $details->first()['quantity'];
		$data['mainCategory'] = $details->first()['mainCategory'];
		$data['subCategory'] = $details->first()['subCategory'];
		$data['productType'] = $details->first()['productType'];
		$data['productGroup'] = $details->first()['productGroup'];
		$data['purchaseRate'] = $invoiceDetails->first()['purchaseRate'];
		$data['MRP'] = $details->first()['MRP'];
		$data['Tax'] = $details->first()['Tax'];
		$data['VAT'] = $details->first()['VAT'];
		$data['shelf'] = $details->first()['shelf'];
		$data['reorderLvl'] = $details->first()['reorderLvl'];
		$data['orderQuantity'] = $details->first()['orderQuantity'];
		$data['drugContent'] = $details->first()['drugContent'];
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

		$searchTerm = strtoupper(Input::get('searchTerm'));
		$searchTerm = "%$searchTerm%";

		$get = $db->query("SELECT * FROM {$table} WHERE `name` LIKE ?", array($searchTerm));

		if (!$get->error() && $get->count() > 0){
			foreach ($get->results() as $key => $value) {
				if ($table == 'company_name'){
					echo "<option value='"+$value['name']+"'>[ {$value['abbreviation']} ] - {$value['name']}</option>";
				}else{
					echo "<option>{$value['name']}</option>";
				}
			}
		}
	}
}

function check_and_save_company(){
	if (Input::exists()){
		$db = DB::getInstance();
		$data = [];
		$company = $db->get('company_name', array('name', '=', Input::get('company_name')));
		//echo $company->count();
		if (Input::get('save') == 'false'){
			if ($company->count() == 0){
				echo "0";
			}else{
				echo $company->first()['name']."/".$company->first()['abbreviation'];
			}
		}else{
			$save = $db->insert('company_name', array(
					'name' => Input::get('company_name'),
					'abbreviation' => Input::get('abr')
				));

			if ($save){
				echo "saved";
			}else{
				echo "Fail";
			}
		}

	}
}

function save_stockist(){
	if (Input::exists()){
		$db = DB::getInstance();

		print_r($_POST);

		//Get company's id
		$company_id = $db->get('company_name', array('name', '=', Input::get('company_name')))->first()['id'];

		//Save data to stockist_name table
		$save_stockist = $db->insert('stockist_name', array(
				'abbreviation' => abrevate(Input::get('stockist_name')),
				'name' => Input::get('stockist_name'),
				//'priority' => Input::get('priority'),
				'company_id' => $company_id
			));

		if ($save_stockist){
			echo "<tr>";
			echo "<td>"+Input::get('stockist_name')+"</td>";
			echo "<td>"+Input::get('priority')+"</td>";
			echo "</tr>";
		}
	}
}


function abrevate($name){
	$abr = substr($name, 0, 1);
	for ($i = 0; $i < 1; $i++){
		$abr .= substr($name, rand($i, strlen($name)));
	}
	return substr($abr, 0, 3);
}