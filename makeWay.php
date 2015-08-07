<?php

$data = $_POST['dataArray'];

$f = "inventory/itemsPurchased.txt";
$queries = [];
foreach($data as $key => $value){
	$queries[] = $value;
	$queries[] = $key;
	
	if($a = appendData(file_get_contents('inventory/itemsPurchased.txt'), $queries, $f)){
		echo "OK!";
	}
}

function appendData($serializeData, $array, $file){
	$a = unserialize($serializeData);
	$a[] = $array;
	file_put_contents($file, serialize($a));
	return $a;
}

