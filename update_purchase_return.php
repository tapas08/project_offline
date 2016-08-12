<?php
require_once('core/init.php');

if (Input::exists()){
	print_r($_POST);
	$flag = 0;
	$db = DB::getInstance();

	$data = [];
	$previous_value = [];

	foreach (json_decode($product = DB::getInstance()->get('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNumber')))->first()['product_details'], true) as $product => $drug){
		$previous_value[] = $drug['return_value'];
	}

	$msg = [];

	// Get the updated product's details
	for($i = 1; $i <= 3; $i++){
		$data[Input::get("name_$i")] = array(
				'batchNo' => $_POST["batch_$i"],
				'expiry_date' => Input::get("exp_$i"),
				'return_value' => Input::get("sendQuantity_$i"),
				'amount' => Input::get("amnt_$i")
			);	
	}

	echo json_encode($data);

	// Update return bill
	$update = $db->update('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNumber')), array(
			'product_details' => json_encode($data),
			'amount' => Input::get('totalAmnt')
		));

	if ($update){
		// If successfully updated then update stock of each product
		// Check each updated return quantity of the products 
		$details = DB::getInstance()->get('purchaseReturn', array('invoiceNo', '=', Input::get('invoiceNumber')))->first();
		$i = 1;
		foreach (json_decode($details['product_details'], true) as $products => $drug){

			$stock = DB::getInstance()->query("SELECT * FROM purchaseBills WHERE productName = ? AND batchNo = ? ", 
								array($products, $drug['batchNo']));
			$revisedStock = $drug['return_value'];
			
			if ((int)Input::get("sendQuantity_$i") < (int)$previous_value[$i-1]){
				
				$return_quantity = $previous_value[$i-1] - Input::get("sendQuantity_$i");
				$revisedStock = (int)$stock->first()['tabQuantity'] + (int)$return_quantity;
			
			}else if ((int)Input::get("sendQuantity_$i") > (int)$previous_value[$i-1]){
				
				$return_quantity = Input::get("sendQuantity_$i") - $previous_value[$i-1];
				$revisedStock = (int)$stock->first()['tabQuantity'] - (int)$return_quantity;
			
			}

			$update_stock = $db->query("UPDATE purchaseBills SET tabQuantity = ? WHERE productName = ? AND batchNo = ?", 
					array($revisedStock, $products, $drug['batchNo']));
			
			if (!$update_stock){
				$flag = 0;
			}else{
				$flag = 1;
			}
			
			$i++;
		}

		// if ($flag = 1){		
		// 	$msg[] = "Bill updated!";
		//$msg[] = "Error! Please try again!";
		//header('Location:purchaseReturn.php?flag='.$flag);
	}else{
		$msg[] = "Error! Something Went Wrong. Please Try Again";
	}
	
}
