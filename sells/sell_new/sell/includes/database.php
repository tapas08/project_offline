<?php
	function __autoload($class)
	{
		require_once('models/'.$class.".php");
	}
?>
