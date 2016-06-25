<?php

class purchase  extends DB
{
	var $table = "purchase";
	
	function validate_patients()
	{
		$errors = array();
		
		if(empty($_POST['name']))
		{
			$errors['name']="Please Enter Name";
		}
		elseif(!preg_match("#^[-A-Za-z' ]*$#",$_POST['name']))
		{
			$errors['name'] = "Please enter valid name.";
		}
		return $errors;
		
	}
}

?>