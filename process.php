<?php

require_once 'core/init.php';

if (!DB::getInstance()->error()){
	echo "true";
}else{
	echo "false";
}