<?php

	switch ($_POST['option']) {
		case 'sqlInjection':
			sqlInjection();
			break;
		
		default:
			# code...
			break;
	}

	function sqlInjection(){
		echo "Sql sqlInjection";
	}
