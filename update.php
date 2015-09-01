<?php 

require_once('core/init.php');

$db = DB::getInstance();

// $data = is_array($_POST['dataArray']) ? $_POST['dataArray'] : false;
// $db = DB::getInstance();
// if ($data){
// 	foreach($data as $item => $quantity){
		
// 		$query = $db->query("UPDATE users SET quantity = quantity - ? WHERE item = ?", array($quantity, $item));
// 		if(!$query->error()){
// 			echo "ok!";
// 		}else{
// 			echo "error!!!";
// 		}
// 	}
// }

// $f = file_get_contents('inventory/itemsPurchased.txt');

// if ($f!= false){
	
// 	$file_data = unserialize($f);
	
// 	for($i = 0; $i < sizeof($file_data); $i++){
		
// 		$query = $db->query("UPDATE users SET quantity = quantity - ? WHERE item = ?", array($file_data[$i][0], $file_data[$i][1]));
// 		if(!$query->error()){
// 			echo "ok!";
// 		}else{
// 			echo "error!!!";
// 		}
	
// 	}
// 	if (unlink('inventory/itemsPurchased.txt')){
// 		echo "DOne!";
// 	}
	
// }

$data = json_encode($_POST['dataArray']);
$array = json_decode($data, true);

$name = $_POST['name'];
$date = $_POST['date'];
$store = $_POST['store'];
$bill_no = $_POST['number'];

foreach($array as $list){
	$result = $db->query("UPDATE users SET quantity = quantity - ? WHERE item = ?", array($list['quantity'], $list['name']));
}

if(!$result->error()){
	$create_bill = $db->insert("bills", array(
			'customer_name' => $name,
			'date_of_bill' => $date,
			'bill_number' => $bill_no,
			'store_location' => $store,
			'bill_content' => $data
		)) ;
}

