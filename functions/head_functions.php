<?php
require_once '../core/init.php';
if (Input::exists()){
	switch (Input::get('access')) {
		case 'get_sub_heads':
			getSubHead();
			break;

		case 'add_sub_head';
			addSubHead();
			break;

		default:
			# code...
			break;
	}
}

function getSubHead(){
	if (Input::exists()){
		$db = DB::getInstance();
		// Get head id from parent_head table
		$parent_id = $db->get('parent_head', array('name', '=', Input::get('head')))->first()['head_id'];

		// Get sub heads from child_head table
		$sub_heads = $db->get('child_heads', array('parent_id', '=', $parent_id));

		if ($sub_heads->count()){
			foreach ($sub_heads->results() as $key => $head_name){
				echo "<tr>";
				echo "<td>". $head_name['name'] ."</td>";
				echo "<td>". $head_name['opening_balance'] ."</td>";
				echo "<td>". $head_name['closing_balance'] ."</td>";
				echo "</tr>";
			}
		}
	}
}

function addSubHead(){
	if (Input::exists()){
		$db = DB::getInstance();

		// Get head id
		$head_id = $db->get('parent_head', array('name', '=', Input::get('head')))->first()['head_id'];

		// Create child id
		$child_id = $head_id."1";
		$sub_heads = $db->query("SELECT * FROM child_heads WHERE child_id LIKE ?", array("$head_id%"));

		if ($sub_heads->count()){
			$last_entry = $sub_heads->count();
			$child_id = $head_id.($last_entry+1);
		}

		// Save in child_heads table with parent_id
		$save = $db->insert('child_heads', array(
				'name' => Input::get('sub_head'),
				'parent_id' => $head_id,
				'child_id' => $child_id,
				'opening_balance' => Input::get('op_bal'),
				'closing_balance' => Input::get('op_bal'),
				'company_code' => 1,
				'type' => Input::get('type')
			));

		if ($save){
			echo "success";
		}else{
			echo "SOmething went wrong!";
		}
	}
}

function parentHeadId($parent_head){
	$db = DB::getInstance();

	// Get head id
	return $head_id = $db->get('parent_head', array('name', '=', $parent_head))->first()['head_id'];	
}