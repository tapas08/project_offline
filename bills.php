<?php
	require_once('core/init.php');

	$db = DB::getInstance();

	$bills = $db->query("SELECT * FROM bills");

	if (!$bills->error()){
		foreach ($bills->results() as $bill){
			$grandTotal = 0;
			echo "{$bill['bill_number']} | {$bill['customer_name']}<br/>";
			$content = json_decode($bill['bill_content'], true);
			
			foreach ($content as $key) {
				echo "{$key['name']}    {$key['quantity']}		{$key['total']}";
				$grandTotal+= (int)$key['total'];
				echo "<br>";
			}
			echo "Total amount			{$grandTotal}";
			echo "<br/>";
			echo "<hr>";
		}
	}
?>