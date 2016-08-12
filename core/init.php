<?php

	session_start();
	ini_set('default_charset', 'UTF-8');

	$GLOBALS['config'] = array(
			'mysql' => array(
				'host' => '127.0.0.1',
				'username' => 'root',
				'password' => '',
				'db' => 'project_offline_db',
				// 'host' => 'localhost',
				// 'username' => 'hotel8cr_admin',
				// 'password' => 'Monty123**',
				// 'db' => 'hotel8cr_tslifecare',
				'remote_db' => 'sql687707',
				'remote_host' => 'sql6.freemysqlhosting.net',
				'remote_password' => 'mD1!qK8*',
				'remote_username' => 'sql687707'
			),
			'remember' => array(
				'cookie_name' => 'hash',
				'cookie_expiry' => 604800
			),
			'session' => array(
				'session_name' => 'user',
				'token_name' => 'token',
				'token_reg' => 'Rtoken',
				'token_login' => 'Ltoken'
			)
		);

	$GLOBALS['counter'] = 1;

	spl_autoload_register(function($class){
		if (!file_exists('functions')){
			require_once '../Class/'. $class .'.php';
		}else{
			require_once 'Class/'. $class .'.php';
		}
	});