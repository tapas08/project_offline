<?php

	class User{

		private $_db,
				$_data,
				$_sessionName,
				$_cookieName,
				$_isLoggedIn;
		protected $_bcrypt;

		public function __construct($user = null){

			$this->_db = DB::getInstance();
			$this->_bcrypt = new Bcrypt;
			$this->_sessionName = Config::get('session/session_name');
			$this->_cookieName = Config::get('remember/cookie_name');

			if (!$user){
				if(Session::exists($this->_sessionName)){
					$user = Session::get($this->_sessionName);

					if($this->find($user)){
						$this->_isLoggedIn = true;
					}else{
						//logout process
					}
				}
			}else{
				$this->find($user);
			}

		}

		public function create($fields = array()){

			if(!$this->_db->insert('users', $fields)){

				throw new Exception("Problem creating acount!");
				
			}

		}

		public function update($fields = array(), $id = null){
			if (!$id && $this->isLoggedIn()){
				$id = $this->data()->id;
			}

			if (!$this->_db->update('users', $id, $fields)){
				throw new Exception("Error Processing Request");
				
			}
		}

		public function find($user = null){
			if($user){
				$field = is_numeric($user) ? 'id' : 'username';
				$data = $this->_db->get('users', array($field, '=', $user));

				if ($data->count()){
					$this->_data = $data->first();
					return true;
				}
			}
			return false;
		}

		public function login($username = null, $password = null, $remember = false){
			
			if (!$username && !$password && $this->exists()){

				Session::put($this->_sessionName, $this->data()->id);

			}else{

				$user = $this->find($username);

				if ($user){
					if ($this->_bcrypt->verify($password, $this->data()['password'])){
						Session::put($this->_sessionName, $this->data()['id']);

						if ($remember){
							$hash = Hash::unique();
							$haskCheck = $this->_db->get('users_sessions', array('user_id', '=', $this->data()['id']));

							if(!$haskCheck->count()){
								$this->_db->insert('users_sessions', array(
									'user_id' => $this->data()['id'],
									'hash' => $hash
									));
							}else{
								$hash = $haskCheck->first()->hash;
							}

							Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
						}

						return true;
					}
				}
			}
			return false;
		}

		public function hashPermission($key){
			$group = $this->_db->get('groups', array('id', '=', $this->data()->group));

			if ($group->count()){
				$permission = json_decode($group->first()->permissions, true);

				if($permission[$key] == true){
					return true;
				}
			}
			return false;
		}

		public function data(){
			return $this->_data;
		}

		public function exists(){
			return (!empty($this->_data)) ? true : false;
		}

		public function isLoggedIn(){
			return $this->_isLoggedIn;
		}

		public function logout(){

			$this->_db->delete('users_sessions', array('user_id', '=', $this->data()->id));

			Session::delete($this->_sessionName);
			Cookie::delete($this->_cookieName);
		}

	}