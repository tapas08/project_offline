<?php

	class Token{

		public static function generate(){
			return Session::put(Config::get('session/token_name'), md5(uniqid()));
		}

		public static function generate_for_regForm(){
			return Session::put(Config::get('session/token_reg'), md5(uniqid()));
		}

		public static function generate_for_loginForm(){
			return Session::put(Config::get('session/token_login'), md5(uniqid()));
		}

		public static function check($token){
			$tokenName = Config::get('session/token_name');

			if (Session::exists($tokenName) && $token === Session::get($tokenName)){
				Session::delete($tokenName);
				return true;
			}
			return false;
		}

		public static function check_for_reg($token){
			$tokenName = Config::get('session/token_reg');

			if (Session::exists($tokenName) && $token === Session::get($tokenName)){
				Session::delete($tokenName);
				return true;
			}
			return false;
		}

		public static function check_for_login($token){
			$tokenName = Config::get('session/token_login');
			// $tokenName = $_SESSION['Ltoken'];

			if (Session::exists($tokenName) && $token === Session::get($tokenName)){
				Session::delete($tokenName);
				return true;
			}
			return false;
		}

	}