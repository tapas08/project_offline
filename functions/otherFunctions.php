<?php

require_once '../core/init.php';

if (Input::exists()){
	$option = Input::get('option');

	switch ($option) {
		case 'save':
			save();
			break;

		case 'saveOrUpdate':
			saveOrUpdate();
			break;

		case 'DM':
			checkDM();
			break;

		case 'importBills':
			importBills();
			break;

		case 'insertToTable':
			insertToTable();
			break;
		
		case 'save_stockist_company':
			save_stockist_company();
			break;

		case 'delete_drugcontent';
			delete_drugcontent();
			break;

		case 'convert_to_INV':
			convert_to_INV();
			break;

		case 'insert_or_update_drugcontent':
			insert_or_update_drugcontent();
			break;

		default:
			# code...
			break;
	}

}

function save(){
	if (Input::exists()){
		$db = DB::getInstance();

		$table;

		if (Input::get('acType') == "Customer"){
			$table = 'customer';
		}else if (Input::get('acType') == "Supplier"){
			$table = "stockist_name";
			$stockist = $db->insert('stockist_name', array(
					'abbreviation' => abrevate(Input::get('name')),
					'name' => Input::get('name')
				));
		}

		$save = $db->insert('account', array(
				'acType'		=> Input::get('type'),
				'name' 			=> Input::get('name'),
				'city' 			=> Input::get('city'),
				'address' 		=> Input::get('address'),
				'phone' 		=> Input::get('phone'),
				'debitLimit' 	=> Input::get('debit_limit'),
				'daysLimit' 	=> Input::get('days_limit'),
				'email' 		=> Input::get('email'),
				'vat_tin_no' 	=> Input::get('vat_tin_no'),
				'LBTNo' 		=> Input::get('lbtNo'),
				'openingBalance'=> Input::get('openingBalance'),
				'CR_or_DR' 		=> Input::get('onoffswitch')
			));

		//print_r($save);
		echo "<p id='productTypeMsg' class='alert alert-info'>Saved new " + Input::get('acType') + "entry</p>";
		if ($save){
			echo "<p id='productTypeMsg' class='alert alert-info'>Saved new " + Input::get('acType') + "entry</p>";
		}else{
			echo "<p id='productTypeMsg' class='alert alert-info'>Error! Looks like something went wrong. <br> Could not finish your request. Please try again!</p>";
		}
	}
}

function saveOrUpdate(){
	if (Input::exists()){
		$db = DB::getInstance();
		$update = 0;

		//Checking for the product type in database
		//If it exists then the operation we need to
		//perform is "update" 
		//and change the update to 1
		//Else "save" the new product type
		
		$check = $db->get('product_type', array('type', '=', Input::get('productType')));

		if ($check->count() > 0){
			$update = 1;
		}

		if ($update == 1){
			//Update
			$updateType = $db->update('product_type', 
				array(
					'type', '=', Input::get('productType')
				), 
				array(
					'abbreviation' => Input::get('code')
				));

			if ($updateType){
				echo "<p id='productTypeMsg' class='alert alert-info'>Product Type updated</p>";
			}else{
				echo "<p id='productTypeMsg' class='alert alert-info'>ERROR! Something went wrong!</p>";
			}

		}else{
			//Save
			$save = $db->insert('product_type', array(
					'type' => Input::get('productType'),
					'code' => Input::get('code')
				));

			if ($save){
				echo "<p id='productTypeMsg' class='alert alert-info'>New product added!</p>";
			}else{
				echo "<p id='productTypeMsg' class='alert alert-info'>Error! Something went wrong.</p>";
			}
		}
	}
}

function checkDM(){
	$db = DB::getInstance();
	
	$DM = $db->query("SELECT * FROM purchaseBills WHERE `bType` = ? AND `supplier` = ?", array('DM', Input::get('supplier')));

	if ($DM->count() > 0){
		$invoiceNumber = 0;

		echo "<table class='table table-bordered'>";
		echo "<thead>";
		echo "<td>INV No.</td>";
		echo "<td>Supplier</td>";
		echo "<td>Date</td>";
		echo "<td>Total</td>";
		echo "</thead>";
		echo "<tbody>";

		foreach ($DM->results() as $result => $bill){
			if ($invoiceNumber != $bill['invoiceNumber']){
				echo "<tr>";
				$invoiceNumber = $bill['invoiceNumber'];
				$dmData = $db->get('purchaseInvoice', array('invoiceNumber', '=', $invoiceNumber));
				echo "<td>$invoiceNumber</td>";
				echo "<td>".$bill['supplier']."</td>";
				echo "<td>".$bill['date']."</td>";
				echo "<td>".$dmData->first()['netAmount']."</td>";
				echo "<td><a href='#' onclick='convert_to_INV(".$invoiceNumber.");'>Convert to INV</a></td>";
				echo "</tr>";
			}
		}
		echo "</tbody>";
		echo "</table>";
	}else{
		echo "0";
	}
}

function importBills(){
	if (Input::exists()){
		$db = DB::getInstance();

		$supplier = Input::get('supplier');
		$date = Input::get('date');

		//Get the previous bills from the supplier

		$bills = $db->query("SELECT * FROM purchaseBills WHERE `supplier` = ? AND `date` = ?", 
						array($supplier, $date));

		if (!$bills->error()){
			if ($bills->count() > 0){
				$i = 1;
				$counter = 0;
				//display all the rows in a tabular form inside input fields
				foreach($bill->results() as $row){
?>
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
<?php	
				}			
				$GLOBALS['counter'] = $i;
				
			}else{
				echo 0;
			}
			
		}
	}
}

function insertToTable(){
	if (Input::exists()){
		$db = DB::getInstance();
		$product = $db->get('purchaseBills', array('productName', '=', Input::get('product')));

		if ($product->count() > 0){
			$id = Input::get('count');
			foreach ($product->resulst() as $drugs => $drug){
				$dateArray = explode('-', $drug['expiryDate']);
				if ((int)$dateArray[0] <= (int)date('n')){

					if ((int)$dateArray[1] <= (int)date('y')){

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
						echo "<td id='vat_",$id,"'>{$drug['VAT']}</td>";
						echo "<td id='scode_",$id,"'>-</td>";
					}

				}
			}
		}else{
			echo "0";
		}
	}
}

function purchaseTable(){
	if (Input::exists()){
		$db = DB::getInstance();

		$product = $db->get('purchaseBills', array('productName', '=', Input::get('product')));

		if ($product->count() > 0){
			foreach ($product->resulst() as $drugs => $drug){
				$dateArray = explode('-', $drug['expiryDate']);
				if ((int)$dateArray[0] <= (int)date('n')){

					if ((int)$dateArray[1] <= (int)date('y')){
						echo "<option>{$drug['productName']}</option>";
					}

				}
			}
		}else{
			echo "0";
		}
	}
}

function abrevate($name){
	$abr = '';
	for ($i = 0; $i < 3; $i++){
		$abr .= substr($name, rand($i, strlen($name)));
	}

	return $abr;
}

function save_stockist_company(){
	if (Input::exists()){
		$db = DB::getInstance();

		$from = Input::get('from');
		$to = $table = Input::get('table');
		$abr = Input::get('abr');

		// Insert data to respective table
		if (Input::get('stockist') == '1'){
			$insert = $db->insert('stockist_name', array(
					'name' => Input::get('table'),
					'abbreviation' => Input::get('abr'),
					'company_id' => DB::getInstance()->get('company_name', array('name', '=', Input::get('from')))->first()['id']
				));

			if ($insert){
				echo "<p class='text-alert'>New Entry Saved</p>";
			}
		}else{
			$insert = $db->insert('comapany_name', array(
					'name' => Input::get('table'),
					'abbreviation' => Input::get('abr')
				));

			$insertStockist = $db->insert('stockist_name', array(
					'name' => Input::get('from'),
					'abbreviation' => abrevate(Input::get('from')),
					'company_id' => DB::getInstance()->get('company_name', array('name', '=', Input::get('from')))->first()['id']
				));

			if ($insert && $insertStockist){
				echo "<p class='text-alert'>New Entry Saved</p>";
			}
		}
	}
}

function convert_to_INV($purEntry = -1){
	$data = [];
	if (Input::exists()){
		$db = DB::getInstance();

		$invNo = Input::get('invNo');

		if ($purEntry > -1){
			$getInv = DB::getInstance()->get('purchaseInvoice', array("invoiceNumber", "=", $purEntry));
			$invNo = $getInv->first()['invoiceNumber'];
		}
		
		$getDM = $db->get('purchaseBills', array('invoiceNumber', '=', $invNo));
		$i = 1;
		$data['count'] = $getDM->count();
		$data['billDate'] = $getDM->first()['date'];
		$data['bill'] = '';
		foreach ($getDM->results() as $content => $dm){
			$data['bill'] .= "<tr>";
			$data['bill'] .= '<td>
				<input type="text" name="productName_'.$i.'" id="productName_'.$i.'" class="form-control" list="drugList_'.$i.'" value="'.$dm['productName'].'">
					<datalist id="drugList_'.$i.'"></datalist>
				</input>
			</td>';
			$data['bill'] .= '<td><input type="number" name="productQuantity_" id="productQuantity_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['productQuantity'].'"></td>';
			$data['bill'] .= '<td><input type="number" name="productFree_'.$i.'" id="productFree_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['productFree'].'"></td>';
			$data['bill'] .= '<td><input type="number" name="productSize_'.$i.'" id="productSize_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['purchaseSize'].'"></td>';
			$data['bill'] .= '<td><input type="number" name="tabQuantity_'.$i.'" id="tabQuantity_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['tabQuantity'].'"></td>';
			$data['bill'] .= '<td><input type="text" name="batchNo_'.$i.'" id="batchNo_'.$i.'" class="form-control" value="'.$dm['batchNo'].'"></td>';
			$data['bill'] .= '<td><input type="text" name="exDate_'.$i.'" id="exDate_'.$i.'" class="form-control month" value="'.$dm['expiryDate'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="purchaseRate_'.$i.'" id="purchaseRate_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['purchaseRate'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="discount_'.$i.'" id="discount_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['discount'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="VAT_'.$i.'" id="VAT_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['vatAmount'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="vatPer_'.$i.'" id="vatPer_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['VAT'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="CST_'.$i.'" id="CST_'.$i.'" class="form-control" value="'.$dm['CST'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="MRP_'.$i.'" id="MRP_'.$i.'" class="form-control" value="'.$dm['MRP'].'"></td>';
			$data['bill'] .= '<td><input type="number" step="any" name="productAmount_'.$i.'" id="productAmount_'.$i.'" class="form-control" value="'.$dm['purchaseAmount'].'"></td>';
			$data['bill'] .= "</tr>";
			$i++;
		}
		echo json_encode($data);
	}
}

function insert_or_update_drugcontent(){
	if (Input::exists()){
		$db = DB::getInstance();

		$insert = $db->insert('drug_content', array(
				'content' => Input::get('drug_content'),
				'sub_category' => Input::get('sub_category')
			));

		if ($insert){
			echo "<p class='text-success'>Drug Content inserted.</p>";
		}else{
			echo "<p class='text-warning'>Error! Please try again.</p>";
		}
	}
}

function delete_drugcontent(){
	if (Input::exists()){
		$db = DB::getInstance();

		$delete = $db->query("DELETE FROM drug_content WHERE 
				content = ? AND sub_category = ?", array(
				Input::get('drug_content'), 
				Input::get('sub_category')
			));

		if ($delete){
			echo "<p class='text-success'>Drug Content deleted.</p>";
		}else{
			echo "<p class='text-warning'>Error! Please try again.</p>";
		}
	}
}