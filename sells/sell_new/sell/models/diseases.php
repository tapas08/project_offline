<?php

class diseases  extends DB
{
	var $table = "diseases";
	
	function validate_diseases()
	{
		$errors = array();
		
		if(empty($_POST['name']))
		{
			$errors['name']="Please Enter Name of Diseases";
		}
		elseif(!preg_match("#^[-A-Za-z' ]*$#",$_POST['name']))
		{
			$errors['name'] = "Please enter valid name.";
		}
		return $errors;
		
	}
}

?>