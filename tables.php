<?php

require_once 'core/init.php';

$db = DB::getInstance();

$tables = $db->tables();

foreach ($tables as $key) {
	$table = $db->query("SELECT * FROM $key");

	foreach($table->results() as $row => $data){
		echo $db->create_table($key);
		//print_r($db->query("SELECT * FROM {$key}_copy")->results());
	}
}