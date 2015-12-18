<?php

	require_once('core/init.php');
	$error = "true";
	$lowStock = [];
	$db = DB::getInstance(true);
	//echo "Start time -> ",$time = time(),"<br>";
	$select = $db->query("SELECT * FROM inventory_nagpur");
	$count = $select->count();
	
	// foreach ($select->results() as $key => $value) {
	// 	if($value['quantity'] <= 1000){
	// 		$lowStock[] = array('item' => $value['item'],
	// 							'quantity' => $value['quantity']);
	// 	}
	// }

	// echo "List of drugs with low stocks!<br>";
	// foreach ($lowStock as $key) {
	// 	echo $key['item']," ------------- ",$key['quantity'],"<br>";
	// }

	if(isset($_POST['update']) && !empty($_POST['update'])){
		$updatedList = $_POST['update'];
		$total_update = count($_POST['update']);
		foreach ($updatedList as $key) {
			$drug = $key['name'];
			$quantity = $key['quantity'];
			$db->query("UPDATE inventory_nagpur SET quantity = quantity - ? WHERE item = ?", array($quantity, $drug));
			
			if(!$db->error()){
				$error = "false";
			}
		}
		echo $error;
	}else{
		//$localDB = DB::getInstance(false)->query("SELECT * FROM bills WHERE store_location = ?", array('NAGPUR'));
		$localDB = DB::getInstance(false)->query("SELECT * FROM bills WHERE date_of_bill >= ? AND date_of_bill <= ? AND store_location = ?", array(date('Y-m-1'), date('Y-m-d'), 'NAGPUR'));
		if(!$localDB->error()){
			if($db->query("SELECT * FROM nagpur_bill")->count() == 0){
				foreach ($localDB->results() as $key => $value) {
						$db->insert('nagpur_bill', array(
							'bill_number' => $value['bill_number'],
							'bill_date' => $value['date_of_bill'],
							'customer_name' => $value['customer_name'],
							'bill_content' => $value['bill_content'],
							'grand_total' => $value['grandTotal']
							));
				}
			}else{
				foreach ($localDB->results() as $key => $value){
					$db->update();
				}
			}
		}else{
			echo "Booo!";
		}
	}
	//die();
	if((int)$count == 0){
		
		$localDB = DB::getInstance(false)->query("SELECT * FROM users");
		$results = $localDB->results();

		foreach($results as $item ){
			$drug = $item['item'];
			$rate = $item['rate'];
			$quantity = $item['quantity'];
			$db->insert("inventory_nagpur", array(
					'item' => $drug,
					'quantity' => $quantity,
					'rate' => $rate
				));
		}

	}/*else{
		$localDB = DB::getInstance(false)->query("SELECT * FROM users");
		$results = $localDB->results();
		foreach($results as $item ){
			$drug = $item['item'];
			//$rate = $item['rate'];
			$quantity = $item['quantity'];
			$db->update("inventory_nagpur",$drug, array(
					'quantity' => $quantity
				));
		}*/
	//}

	

