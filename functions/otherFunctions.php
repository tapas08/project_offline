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
		
		default:
			# code...
			break;
	}

}

function save(){
	if (Input::exists()){
		$db = DB::getInstance();

		$save = $db->insert('Account', array(
				'acType' => Input::get('type'),
				'name' => Input::get('name'),
				'city' => Input::get('city'),
				'address' => Input::get('address'),
				'phone' => Input::get('phone'),
				'debitLimit' => Input::get('debit_limit'),
				'daysLimit' => Input::get('days_limit'),
				'email' => Input::get('email'),
				'vat_tin_no' => Input::get('vat_tin_no'),
				'LBTNo' => Input::get('lbtNo'),
				'openingBalance' => Input::get('openingBalance'),
				'CR_or_DR' => Input::get('onoffswitch')
			));

		if ($save){
			echo "<p id='productTypeMsg' class='alert alert-info'>Saved new {Input::get('acType')} entry</p>";
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
