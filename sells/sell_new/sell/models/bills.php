<?php

class bills extends db
{
	var $table = "bills";
	
	  function validate()
	  {
		  $errors = array();
		  
		  if(empty($_POST['customer_name']))
		  {
			  $errors['customer_name'] = "Enter the name of the customer";
		  }
		   if(empty($_POST['date_of_bill']))
		  {
			  $errors['date_of_bill'] = "Enter the date_of_bill";
		  }
		   if(empty($_POST['bill_no']))
		  {
			  $errors['bill_no'] = "Enter the bill_no";
		  }
		   if(empty($_POST['store_ocation']))
		  {
			  $errors['store_ocation'] = "Enter the store_ocation";
		  }
		  if(empty($_POST['bill_content']))
		  {
			  $errors['bill_content'] = "Enter the bill_content";
		  }
		  if(empty($_POST['grandtotal']))
		  {
			  $errors['grandtotal'] = "Enter the grandtotal";
		  }
		 
	  }
	  
	
	
	
}

?>