<?php

	session_start();
	ini_set('default_charset', 'UTF-8');

	$GLOBALS['config'] = array(
			'mysql' => array(
				'host' => '127.0.0.1',
				'username' => 'root',
				'password' => '',
				'db' => 'project_offline_db'
				)
		);

	spl_autoload_register(function($class){
		require_once 'Class/'. $class .'.php';
	});