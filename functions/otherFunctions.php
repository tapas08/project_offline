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
			convert_to_INV(Input::get('purEntry'));
			break;

		case 'insert_or_update_drugcontent':
			insert_or_update_drugcontent();
			break;

		case 'product_details';
			product_details();
			break;

		case 'checkCredit':
			check_credit();
			break;

		case 'purchaseTable':
			purchaseTable();
			break;

		case 'show_return_products':
			show_return_products();
			break;

		case 'recreate_return_bill':
			recreate_return_bill();
			break;

		case 'get_return_bill_amount':
			get_return_bill_amount();
			break;

		case 'check_invoice':
			check_invoice();
			break;

		case 'getProductPurchaseDetails':
			productPurchaseDetails();
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
		}else if (Input::get('acType') == "Supplier" && Input::get('status') !== 'Update'){
			$table = "stockist_name";
			$stockist = $db->insert('stockist_name', array(
					'abbreviation' => abrevate(Input::get('name')),
					'name' => Input::get('name')
				));
		}
		if (Input::get('status') != 'Update'){
			$save = $db->insert('account', array(
					'acType'		=> Input::get('acType'),
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


			// Get head id
				$head_id = $db->get('parent_head', array('name', '=', "SUNDRY ACCOUNTS"))->first()['head_id'];

				// Create child id
				$child_id = $head_id."1";
				$sub_heads = $db->query("SELECT * FROM child_heads WHERE child_id LIKE ?", array("$head_id%"));

				if ($sub_heads->count()){
					$last_entry = $sub_heads->count();
					$child_id = $head_id.($last_entry+1);
				}

				$save = @$db->insert('child_heads', array(
					'name' => Input::get('name'),
					'parent_id' => $head_id,
					'child_id' => $child_id,
					'opening_balance' => Input::get('openingBalance'),
					'closing_balance' => Input::get('openingBalance'),
					'company_code' => 1
				));


			//print_r($save);
			echo "<p id='productTypeMsg' class='alert alert-info'>Saved new " + Input::get('acType') + "entry</p>";
		}else if (Input::get('status') == "Update"){
			$save = $save = $db->update('account', array('name', '=', Input::get('name')), array(
					'acType'		=> Input::get('acType'),
					'name' 			=> Input::get('name'),
					'city' 			=> Input::get('city'),
					'address' 		=> Input::get('address'),
					'phone' 		=> Input::get('phone'),
					'debitLimit' 	=> Input::get('debit_limit'),
					'daysLimit' 	=> Input::get('days_limit'),
					'email' 		=> Input::get('email'),
					'vat_tin_no' 	=> Input::get('vat_tin_no'),
					'LBTNo' 		=> Input::get('lbtNo'),
					'openingBalance'=> Input::get('openBalance'),
					'CR_or_DR' 		=> Input::get('onoffswitch')
				));
		}
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
	//print_r(expression)
	if (Input::exists()){
		$db = DB::getInstance();
		$data = [];
		$product = $db->query("SELECT * FROM purchaseBills WHERE productName = ? AND batchNo = ?", array(Input::get('product'), Input::get('batchNo')));
		if ($product->count() > 0){
			//echo Input::get('return_type');
			$data['count'] = $count = $product->count();
			$id = Input::get('count');
			$data['list'] = '';
			$data['supplier'] = $product->first()['supplier'];
			foreach ($product->results() as $drugs => $drug){
				$dateArray = explode('/', $drug['expiryDate']);
				if ((int)$dateArray[1] <= (int)date('y') && Input::get('return_type') == 'Expiry'){					
					if ((int)$dateArray[0] <= (int)date('n') && Input::get('return_type') == 'Expiry'){

						// calculation of some stuffs
						$amnt = (int)$drug['purchaseRate'] * (int)$drug['purchaseSize'];
						$data['list'].= "<tr>";
						$data['list'].= "<td id='name_".$id."'><input type='text' class='form-control' id='name_".$id."' name='name_".$id."' value='".$drug['productName']."' readonly></td>";
						$data['list'].= "<td id='mfg_".$id."'><input type='text' class='form-control' id='mfg_".$id."' name='mfg_".$id."' value='' readonly></td>";
						$data['list'].= "<td id='name_".$id."'><input type='number' step='any' class='form-control' name='sendQuantity_".$id."' id='sendQuantity_".$id."' oninput='calculate(".$id.")' /></td>";
						$data['list'].= "<td id='pack_".$id."'><input type='number' class='form-control' id='pack_".$id."' name='pack_".$id."' value='".$drug['productQuantity']."' readonly></td>";
						$data['list'].= "<td id='batch_".$id."'><input type='text' class='form-control' id=batch_".$id."' name='batch_".$id."' value='".$drug['batchNo']."' readonly></td>";
						$data['list'].= "<td id='qty_".$id."'><input type='number' class='form-control' id='qty_".$id."' name='qty_".$id."' value='".$drug['purchaseSize']."' readonly></td>";
						$data['list'].= "<td id='pr_".$id."'><input type='number' class='form-control' step='any' id='pr_".$id."' name='pr_".$id."' value='".$drug['purchaseRate']."' readonly ></td>";
						$data['list'].= "<td id='mrp_".$id."'><input type='number' class='form-control' id='mrp_".$id."' name='mrp_".$id."' value='".$drug['MRP']."' readonly></td>";
						$data['list'].= "<td id='exp_".$id."'><input type='text' class='form-control' id='exp_".$id."' name='exp_".$id."' value='".$drug['expiryDate']."' readonly></td>";
						$data['list'].= "<td id='dsc_".$id."'><input type='text' class='form-control' id='dsc_".$id."' name='dsc_".$id."' value='".$drug['discount']."' readonly></td>";
						$data['list'].= "<td id='schm_".$id."'><input type='text' class='form-control' id='schm_".$id."' name='schm_".$id."' value='' readonly></td>";
						$data['list'].= "<td id='amnt_".$id."'><input type='text' class='form-control' id='amnt_".$id."' name='amnt_".$id."' value='".(($drug['purchaseRate'] * $drug['purchaseSize']) + $drug['vatAmount'])."' readonly></td>";
						$data['list'].= "<td id='vatAmnt_".$id."'><input type='text' class='form-control' id='vatAmnt_".$id."' name='vatAmnt_".$id."' value='".$drug['vatAmount']."' readonly></td>";
						$data['list'].= "<td id='vat_".$id."'><input type='text' class='form-control' id='vat_".$id."' name='vat_".$id."' value='".$drug['VAT']."' readonly></td>";
						$data['list'].= "<td id='scode_".$id."'><input type='text' class='form-control' id='scode_".$id."' name='scode_".$id."' value='' readonly></td>";
						$data['list'].= "</tr>";
					}
				}else{
					// calculation of some stuffs
					$amnt = (int)$drug['purchaseRate'] * (int)$drug['purchaseSize'];
					$data['list'].= "<tr>";
					$data['list'].= "<td id='name_".$id."'><input type='text' class='form-control' id='name_".$id."' name='name_".$id."' value='".$drug['productName']."' readonly></td>";
					$data['list'].= "<td id='mfg_".$id."'><input type='text' class='form-control' id='mfg_".$id."' name='mfg_".$id."' value='' readonly></td>";
					$data['list'].= "<td id='name_".$id."'><input type='number' step='any' class='form-control' name='sendQuantity_".$id."' id='sendQuantity_".$id."' oninput='calculate(".$id.")' /></td>";
					$data['list'].= "<td id='pack_".$id."'><input type='number' class='form-control' id='pack_".$id."' name='pack_".$id."' value='".$drug['productQuantity']."' readonly></td>";
					$data['list'].= "<td id='batch_".$id."'><input type='text' class='form-control' id=batch_".$id."' name='batch_".$id."' value='".$drug['batchNo']."' readonly></td>";
					$data['list'].= "<td id='qty_".$id."'><input type='number' class='form-control' id='qty_".$id."' name='qty_".$id."' value='".$drug['tabQuantity']."' readonly></td>";
					$data['list'].= "<td id='pr_".$id."'><input type='number' class='form-control' step='any' id='pr_".$id."' name='pr_".$id."' value='".$drug['purchaseRate']."' readonly ></td>";
					$data['list'].= "<td id='mrp_".$id."'><input type='number' class='form-control' id='mrp_".$id."' name='mrp_".$id."' value='".$drug['MRP']."' readonly></td>";
					$data['list'].= "<td id='exp_".$id."'><input type='text' class='form-control' id='exp_".$id."' name='exp_".$id."' value='".$drug['expiryDate']."' readonly></td>";
					$data['list'].= "<td id='dsc_".$id."'><input type='text' class='form-control' id='dsc_".$id."' name='dsc_".$id."' value='".$drug['discount']."' readonly></td>";
					$data['list'].= "<td id='schm_".$id."'><input type='text' class='form-control' id='schm_".$id."' name='schm_".$id."' value='' readonly></td>";
					$data['list'].= "<td id='amnt_".$id."'><input type='text' class='form-control' id='amnt_".$id."' name='amnt_".$id."' value='".(($drug['purchaseRate'] * $drug['purchaseSize']) + $drug['vatAmount'])."' readonly></td>";
					$data['list'].= "<td id='vatAmnt_".$id."'><input type='text' class='form-control' id='vatAmnt_".$id."' name='vatAmnt_".$id."' value='".$drug['vatAmount']."' readonly></td>";
					$data['list'].= "<td id='vat_".$id."'><input type='text' class='form-control' id='vat_".$id."' name='vat_".$id."' value='".$drug['VAT']."' readonly></td>";
					$data['list'].= "<td id='scode_".$id."'><input type='text' class='form-control' id='scode_".$id."' name='scode_".$id."' value='' readonly></td>";
					$data['list'].= "</tr>";
				}
				$id++;
			}
		}else{
			echo "0";
		}
		echo json_encode($data);
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
	$abr = substr($name, 0, 1);
	for ($i = 0; $i < 1; $i++){
		$abr .= substr($name, rand($i, strlen($name)));
	}
	return substr($abr, 0, 3);
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
	//echo "I am here!";
	$data = [];
	if (Input::exists()){
		$db = DB::getInstance();

		$invNo = Input::get('invNo');
		$data['purEntry'] = $purEntry;

		if ($purEntry > -1){
			$getInv = DB::getInstance()->get('purchaseInvoice', array("id", "=", $purEntry));
			$invNo = $getInv->first()['invoiceNumber'];
			$data['purEntry'] = $getInv->first()['id'];
		}else if ($purEntry == -1){
			//echo "here!";
			$getInv = DB::getInstance()->get('purchaseInvoice', array("invoiceNumber", "=", Input::get('invNo')));
			$data['purEntry'] = $getInv->first()['id'];
		}
		
		$getDM = $db->get('purchaseBills', array('invoiceNumber', '=', $invNo));
		$i = 1;
		$data['count'] = $getDM->count();
		$data['billDate'] = $getDM->first()['date'];
		$data['supplier'] = $getDM->first()['supplier'];
		$data['invoiceNo'] = $invNo;
		$data['debit_note'] = DB::getInstance()->get('purchaseInvoice', array('invoiceNumber', '=', $invNo))->first()['debitNote'];
		$data['bill'] = '';
		foreach ($getDM->results() as $content => $dm){
			$data['bill'] .= "<tr>";
			$data['bill'] .= '<td>
				<input type="text" name="productName_'.$i.'" id="productName_'.$i.'" class="form-control" list="drugList_'.$i.'" value="'.$dm['productName'].'">
					<datalist id="drugList_'.$i.'"></datalist>
				</input>
			</td>';
			$data['bill'] .= '<td><input type="number" name="productQuantity_'.$i.'" id="productQuantity_'.$i.'" oninput="calculate('.$i.');" class="form-control" value="'.$dm['productQuantity'].'"></td>';
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
	//TODO 
	/* Update purchaseBills : change DM to Inv */
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

function product_details(){
	if (Input::exists()){

		$searchTerm = Input::get('input');
		$searchTerm = strtoupper("{$searchTerm}%");

		$db = DB::getInstance()->query("SELECT * FROM purchaseBills WHERE productName LIKE ?", array($searchTerm));

		if ($db->count() > 0){
			$x = 1;
			echo "<table class='table table-bordered table-condensed'>";
			echo "<thead>";
			echo "<td>MFG</td>";
			echo "<td>Product Name</td>";
			echo "<td>Batch No</td>";
			echo "<td>Pack Size</td>";
			echo "<td>Expiry Date</td>";
			echo "<td>MRP</td>";
			echo "<td>Rack</td>";
			echo "<td>Stock</td>";
			echo "<td>Tax</td>";
			echo "<td>CAT</td>";
			echo "</thead>";
			echo "<tbody id='product_list_table'>";
			foreach($db->results() as $data => $product){
				echo "<tr>";
				echo "<td>".get_mfg($product['supplier'])."</td>";
				echo "<td>{$product['productName']}</td>";
				echo "<td>{$product['batchNo']}</td>";
				echo "<td>{$product['productQuantity']}</td>";
				echo "<td>{$product['expiryDate']}</td>";
				echo "<td>{$product['MRP']}</td>";
				echo "<td>Shelf</td>";
				echo "<td>{$product['tabQuantity']}</td>";
				echo "<td>{$product['VAT']}</td>";
				echo "<td>category</td>";
				echo "</tr>";

				$x++;
			}
			echo "</tbody>";
			echo "</table>";
			echo "<input type='hidden' id='state' name='state' value='old'>";
		}else{
			$items = DB::getInstance()->query("SELECT * FROM items WHERE productName LIKE ?", array($searchTerm));
			echo "Count".$items->count();
			if ($items->count() > 0){

				echo "<table class='table table-bordered table-condensed'>";
				echo "<thead>";
				echo "<td>MFG</td>";
				echo "<td>Product Name</td>";
				echo "</thead>";
				echo "<tbody>";
				foreach ($items->results() as $item => $product){
					echo "<tr>";
					echo "<td>".$product['manufacturer']."</td>";
					echo "<td>".$product['productName']."</td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "<input type='hidden' id='state' name='state' value='new'>";
			}
		}
	}
}


function check_credit(){
	if (Input::exists()){
		$db = DB::getInstance();

		$credit_list = $db->query("SELECT * FROM purchaseReturn WHERE supplier = ? AND status = ?", array(Input::get('supplier'), 'Creditable'));

		if ($credit_list->count() > 0){
			$i = 1;
			foreach ($credit_list->results() as $return_bill => $bill){
				if ($bill['balance'] > 0){
					echo "<tr>";
					echo "<td><input type='checkbox' id='bill_checked_".$i."' name='bill_checked[]' value=".$bill['invoiceNo']."></td>";
					echo "<td>{$bill['invoiceNo']}</td>";
					echo "<td>{$bill['invoiceDate']}</td>";
					echo "<td>{$bill['amount']}</td>";
					echo "<td>{$bill['balance']}</td>";
					echo "<td>{$bill['loss']}</td>";
					echo "<td>{$bill['bType']}</td>";
					echo "<td>".((date('Y', strtotime($bill['invoiceDate'])) == date('Y')) ? 'CY' : 'LY')."</td>";
					echo "<td>{$bill['narration']}</td>";
					echo "</tr>";
				}
				$i++;
			}
		}

	}
}


function show_return_products(){
	if (Input::exists()){
		$db = DB::getInstance();
		$i = 1;
		$purchase_return = $db->get('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')));
		if ($purchase_return->count()){
			//print_r($purchase_return->first()['product_details']);
			foreach (json_decode($purchase_return->first()['product_details'], true) as $return_bill => $return) {
				$purchaseBills = DB::getInstance()->query("SELECT * FROM purchaseBills WHERE batchNo = ? AND productName = ?", array($return['batchNo'], $return_bill));
				echo "<tr>";
				if (Input::get('credit_note') == 'true'){
					if ($purchase_return->first()['adjusted'] == 'Y'){
						continue;
					}
					echo "<td>".get_mfg($purchase_return->first()['supplier'])."</td>";
				}
				echo "<td>$return_bill</td>";
				echo "<td>".$purchaseBills->first()['productQuantity']."</td>";
				echo "<td>".$return['batchNo']."</td>";
				echo "<td>".$purchaseBills->first()['purchaseRate']."</td>";
				echo "<td>".$purchaseBills->first()['MRP']."</td>";
				echo "<td>".$return['return_value']."</td>";
				echo "<td>".$return['amount']."</td>";
				echo "<td>0</td>";
				if (Input::get('credit_note') == 'true'){
					$value = $return['amount'];
					$bill_no = $purchase_return->first()['invoiceNo'];
					echo "<td><input type=\"checkbox\" id=\"product_selected_$i\" name='product_return_value[]' value=".$value .",". $bill_no ." ". ($return['selected'] == 'y' ? "checked='true' disabled='disabled'": "") ."'></td>";
				}else{
					echo "<td>".$purchase_return->first()['invoiceDate']."</td>";
				}
				echo "<tr>";
				$i++;
			}
		}
	}
}


function recreate_return_bill(){
	if (Input::exists()){
		$db = DB::getInstance();

		$data = [];

		$return_bill  = $db->get('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')));
		$data['supplier'] = $return_bill->first()['supplier'];
		$data['bType'] = $return_bill->first()['bType'];
		$data['invNo'] = $return_bill->first()['invoiceNo'];
		$data['date'] = $return_bill->first()['invoiceDate'];
		$data['loss'] = $return_bill->first()['loss'];
		$data['status'] = $return_bill->first()['status'];
		$data['narration'] = $return_bill->first()['narration'];
		// Print the required details in the tabular format
		if ($return_bill->count()){
			$data['list'] = '';
			$id = 1;
			foreach (json_decode($return_bill->first()['product_details'], true) as $product => $details){
				//var_dump($details);
				$drug = DB::getInstance()->query("SELECT * FROM purchaseBills WHERE batchNo = ? AND productName = ?", array($details['batchNo'], $product))->first();

				$data['list'].= "<tr>";
				$data['list'].= "<td id='name_".$id."'><input type='text' class='form-control' id='name_".$id."' name='name_".$id."' value='".$product."' readonly></td>";
				$data['list'].= "<td id='mfg_".$id."'><input type='text' class='form-control' id='mfg_".$id."' name='mfg_".$id."' value='".get_mfg($drug['supplier'])."' readonly></td>";
				$data['list'].= "<td id='name_".$id."'><input type='number' step='any' class='form-control' name='sendQuantity_".$id."' id='sendQuantity_".$id."' oninput='calculate(".$id.")' value='".$details['return_value']."' /></td>";
				$data['list'].= "<td id='pack_".$id."'><input type='number' class='form-control' id='pack_".$id."' name='pack_".$id."' value='".$drug['productQuantity']."' readonly></td>";
				$data['list'].= "<td id='batch_".$id."'><input type='text' class='form-control' id=batch_".$id."' name='batch_".$id."' value='".$drug['batchNo']."' readonly></td>";
				$data['list'].= "<td id='qty_".$id."'><input type='number' class='form-control' id='qty_".$id."' name='qty_".$id."' value='".$drug['purchaseSize']."' readonly></td>";
				$data['list'].= "<td id='pr_".$id."'><input type='number' class='form-control' step='any' id='pr_".$id."' name='pr_".$id."' value='".$drug['purchaseRate']."' readonly ></td>";
				$data['list'].= "<td id='mrp_".$id."'><input type='number' class='form-control' id='mrp_".$id."' name='mrp_".$id."' value='".$drug['MRP']."' readonly></td>";
				$data['list'].= "<td id='exp_".$id."'><input type='text' class='form-control' id='exp_".$id."' name='exp_".$id."' value='".$drug['expiryDate']."' readonly></td>";
				$data['list'].= "<td id='dsc_".$id."'><input type='text' class='form-control' id='dsc_".$id."' name='dsc_".$id."' value='".$drug['discount']."' readonly></td>";
				$data['list'].= "<td id='schm_".$id."'><input type='text' class='form-control' id='schm_".$id."' name='schm_".$id."' value='' readonly></td>";
				$data['list'].= "<td id='amnt_".$id."'><input type='text' class='form-control' id='amnt_".$id."' name='amnt_".$id."' value='".$return_bill->first()['amount']."' readonly></td>";
				$data['list'].= "<td id='vatAmnt_".$id."'><input type='text' class='form-control' id='vatAmnt_".$id."' name='vatAmnt_".$id."' value='".$drug['vatAmount']."' readonly></td>";
				$data['list'].= "<td id='vat_".$id."'><input type='text' class='form-control' id='vat_".$id."' name='vat_".$id."' value='".$drug['VAT']."' readonly></td>";
				$data['list'].= "<td id='scode_".$id."'><input type='text' class='form-control' id='scode_".$id."' name='scode_".$id."' value='' readonly></td>";
				$data['list'].= "</tr>";
				$id++;
			}
		}
		$data['count'] = $id - 1;
		echo json_encode($data);
	}
}

function get_mfg($supplier){
	$company_code = DB::getInstance()->get('stockist_name', array('name', '=', $supplier));
	if ($company_code->count() > 0){
		$mfg = DB::getInstance()->get('company_name', array('id', '=', $company_code->first()['company_id']));
		if ($mfg->count()){
			return $mfg->first()['abbreviation'];
		}	
	}
	
	return 'NA';
}

function get_return_bill_amount(){
	if (Input::exists()){
		$returnBill = DB::getInstance()->get('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')))->first();
		//echo Input::get('invoiceNo');
		if(!empty(Input::get('amount'))){
			echo $returnBill['balance'];
			// Update return bill balance
			$update_balance = DB::getInstance()->query("UPDATE purchaseReturn SET balance = balance - ? WHERE invoiceNo = ?", array($returnBill['balance'], Input::get('invoiceNo')));	
		}else{
			echo $returnBill['balance'];

			$update_balance = DB::getInstance()->query("UPDATE purchaseReturn SET balance = balance - ? WHERE invoiceNo = ?", array($returnBill['balance'], Input::get('invoiceNo')));
			$returnBill = DB::getInstance()->get('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')))->first();
			$update = DB::getInstance()->update('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')),
						array(
								'adjusted' => 'Y'
							));
		}
		
		// Update return bill with adjusted to Y
		if ($returnBill['balance'] == 0 && !empty(Input::get('amount'))){
			$update = DB::getInstance()->update('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')),
						array(
								'adjusted' => 'Y'
							));
		}else{
			$amount = (int)$returnBill['balance'] - (int)Input::get('amount');
			$update_balance = DB::getInstance()->update('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNo')), 
				array(
						'balance' => $amount
					));

			// Update the json string to reflect which product amount is paid
			$db = DB::getInstance()->query(
				"update purchaseReturn SET common_schema.extract_json_value(purchaseReturn.product_details, '/selected') = ? where common_schema.extract_json_value(purchaseReturn.product_details, '/amount') = ? and invoiceNo = ?", 
				array('y', Input::get('amount'), Input::get('invoiceNo')));

			// foreach (json_decode($returnBill['product_details'], true) as $details => $product){
			// 	if ((int)$product['amount'] == (int)Input::get('amount')){

			// 	}
			// }
			
			//echo "Balance Updated";
		}

	}
}

function check_invoice(){
	if (Input::exists()){
		$db = DB::getInstance()->query("SELECT * FROM purchaseInvoice WHERE invoiceNumber = ? AND supplier = ?", array(Input::get('invoice'), Input::get('supplier')));

		if ($db->count() > 0){
			echo "true";
		}else{
			echo "false";
		}
	}
}

function productPurchaseDetails(){
	if (Input::exists()){
		$db = DB::getInstance()->get('purchaseBills', array('batchNo', '=', Input::get('batch')));

		if ($db->count()){
			echo "<span>[ <b>Supplier</b> : ". $db->first()['supplier'] ." ]</span>  <span>[ <b>INV</b> : ". $db->first()['invoiceNumber'] ." ]</span>  <span>[ <b>Date</b> : ". $db->first()['date'] ." ]</span>";
		}else{
			echo "Nothing!";
		}
	}
}