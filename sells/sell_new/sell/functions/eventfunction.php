<?php

require_once('../core/init.php');

function updateData(){
	$db = DB::getInstance();
	if (Input::exists()){
		$update = $db->update('events', array('headName', '=', Input::get('headName')), array(
				    'headname' 		    => Input::get('headName_'),
					'address'			=> Input::get('Addr_'),
					'phone_no'			=> Input::get('ph_no'),
					'mobile_no'			=> Input::get('mo_no'),
					'remind_date'		=> Input::get('remind_date'),
					'event_to_remind'	=> Input::get('EventToRemind'),
					'criteria'			=> Input::get('Criteria'),
					'before_days'		=> Input::get('BeforeDays'),
					'description'		=> Input::get('Description'),
			));
		
		if ($update){
			echo "Event entry updated!";
		}else{
			echo "Error! Something went wrong during process.";
		}

	}else{
		echo "No Input";
	}

}
?>
