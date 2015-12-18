<?php

require_once 'core/init.php';

if (!DB::getInstance(true)->error()){
	echo "true";
}else{
	echo "false";
}