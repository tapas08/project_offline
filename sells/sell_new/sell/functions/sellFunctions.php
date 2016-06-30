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

function getDrug(){
	$db = DB::getInstance();
	$get=[];
	$searchTerm=[];
	$searchTerm = Input::get('searchTerm');
	$searchTerm = "%$searchTerm%";
	$get = $db->query("SELECT * FROM purchase WHERE `productName` LIKE ?", array($searchTerm));

   
	if (!$get->error()){
		if($get->count() > 0){
	 	insertData();
		}
		foreach ($get->results() as $key => $value){
			//echo "<option value='{$value['productName']}'>{$value['productName']}</option>";
			$details = $db->get("purchase", array('productName', '=', $drug));
	//print_r($details);

	if ($details){
		$data = [];
		$data['quantity'] = $details->first()['quantity'];
		$data[''] = $details->first()['mainCategory'];
		$data['subCategory'] = $details->first()['subCategory'];
		$data['productType'] = $details->first()['productType'];
		$data['productGroup'] = $details->first()['productGroup'];
		$data['purchaseRate'] = $details->first()['productRate'];
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
		}
	}else{
		echo "Error!";
	} 
}
				
				
function importBills(){
	if (Input::exists()){
		$db = DB::getInstance();

		$supplier = Input::get('supplier');
		$date = Input::get('date');

		//Get the previous bills from the supplier

		$bills = $db->query("SELECT * FROM purchaseBills WHERE `productName` LIKE ?", array($searchTerm), 
						array($supplier, $date));

		if (!$bills->error()){
			if ($bills->count() > 0){
				$i = 1;
				$counter = 0;
				//display all the rows in a tabular form inside input fields
				foreach($bills->results() as $row){
					<tr>
						<td>
							<input type="text" name="productName_<?php echo $i; ?>" id="productName_<?php echo $i; ?>" class="form-control" list="drugList_<?php echo $i; ?>" oninput="getList('productName_1".<?php echo $i; ?>."', 'drugList_".<?php echo $i; ?>."', true, true);">
								<datalist id="drugList_<?php echo $i; ?>"></datalist>
							</input>
						</td>
						<td><input type="number" name="productQuantity_<?php echo $i; ?>" id="productQuantity_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" name="productFree_<?php echo $i; ?>" id="productFree_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" name="productSize_<?php echo $i; ?>" id="productSize_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" name="tabQuantity_<?php echo $i; ?>" id="tabQuantity_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="text" name="batchNo_<?php echo $i; ?>" id="batchNo_<?php echo $i; ?>" class="form-control"></td>
						<td><input type="text" name="exDate_<?php echo $i; ?>" id="exDate_<?php echo $i; ?>" class="form-control month"></td>
						<td><input type="number" step="any" name="purchaseRate_<?php echo $i; ?>" id="purchaseRate_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" step="any" name="discount_<?php echo $i; ?>" id="discount_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" step="any" name="VAT_<?php echo $i; ?>" id="VAT_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" step="any" name="vatPer_<?php echo $i; ?>" id="vatPer_<?php echo $i; ?>" oninput="calculate(<?php echo $i; ?>);" class="form-control"></td>
						<td><input type="number" step="any" name="CST_<?php echo $i; ?>" id="CST_<?php echo $i; ?>" class="form-control"></td>
						<td><input type="number" step="any" name="MRP_<?php echo $i; ?>" id="MRP_<?php echo $i; ?>" class="form-control"></td>
						<td><input type="number" step="any" name="productAmount_<?php echo $i; ?>" id="productAmount_<?php echo $i; ?>" class="form-control"></td>
					</tr>					

				}			
				$GLOBALS['counter'] = $i;
				
			}else{
				echo 0;
			}
			
		}
	}
}

/*
function insertToTable(){
	if (Input::exists()){
		$db = DB::getInstance();
		$product = $db->get('purchaseBills', array('productName', '=', Input::get('product')));

		if ($product->count() > 0){
			$id = Input::get('count');
			foreach ($product->resulst() as $drugs => $drug){
				$
				if ((int)$dateArray[0] <= (int)date('n')){

					if ((int)$dateArray[1] <= (int)date('y'){

						// calculation of some stuffs
						$amnt = (int)$drug['purchaseRate'] * (int)$drug['purchaseSize'];

						echo "<td id='mfg_",$id,"'>-</td>";
						echo "<td id='name_",$id,"'>{$drug['productName']}</td>";
						echo "<td id='pack_",$id,"'>{$drug['productQuantity']}</td>";
						echo "<td id='batch_",$id,"'>{$drug['batchNo']}</td>";
						echo "<td id='qty_",$id,"'>{$drug['purchaseSize']}</td>";
						echo "<td id='pr_",$id,"'>{$drug['purchaseRate']}</td>";
						echo "<td id='mrp_",$id,"'>{$drug['MRP']}</td>";
						echo "<td id='dsc_",$id,"'>{$drug['discount']}</td>";
						echo "<td id='amnt_",$id,"'>{$amnt}</td>";
						echo "<td id='schm_",$id,"'>-</td>";
						echo "<td id='vatAmnt_",$id,"'>{$drug['vatAmount']}</td>";
						
					
				

				}
			}
		}else{
			echo "0";
		}
	}
}
}
*/
function insertData(){
	$db = DB::getInstance();
	$drug = Input::get('drug');
	
	$details = $db->get("purchase", array('productName', '=', $drug));
	//print_r($details);

	if ($details){
		$data = [];
		$data['marketedBy'] = $details->first()['marketedBy'];
		$data['manufacturedBy'] = $details->first()['manufacturer'];
		$data['packSize'] = $details->first()['packSize'];
		$data['quantity'] = $details->first()['quantity'];
		$data['mainCategory'] = $details->first()['mainCategory'];
		$data['subCategory'] = $details->first()['subCategory'];
		$data['productType'] = $details->first()['productType'];
		$data['productGroup'] = $details->first()['productGroup'];
		$data['purchaseRate'] = $details->first()['productRate'];
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
?>
/*
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
}*/?>