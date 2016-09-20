<?php
	class Validation{

		private $_passed = false,
				$_errors = array(),
				$_db = null;

		public function __construct(){
			$this->_db = DB::getInstance();
		}

		public function check($source, $items = array()){
			foreach($items as $item => $rules){
				
				foreach($rules as $rule => $rule_value){
					$value = $source[$item]; // $_POST['usersname'];

					if ($rule === 'required' && empty($value)){
						$this->addErrors("{$item} is required!");
					}else if (!empty($value)){

						switch ($rule) {
							case 'min':
								if (strlen($value) < $rule_value){
									$this->addErrors("{$item} must be minimum of {$rule_value} characters!");
								}
								break;

							case 'max':
								if (strlen($value) > $rule_value){
									$this->addErrors("{$item} must be maximum of {$rule_value} characters!");
								}
								break;

							case 'matches':
								if ($value != $source[$rule_value]){
									$this->addErrors("Passwords must match");
								}
								break;

							case 'unique':
								$check = $this->_db->get($rule_value, array($item, '=', $value));
								if ($check->count()){
									$this->addErrors("{$value} already exists");
								}
								break;

							case 'numeric':
								if (!is_numeric($value)){
									$this->addErrors("username must be numeric!");
								}
							
						}

					}

				}
			}

			if(empty($this->_errors)){
				$this->_passed = true;
			}

			return $this;

		}

		public function addErrors($error){
			$this->_errors[] = $error;
		}

		public function errors(){
			return $this->_errors;
		}

		public function passed(){
			return $this->_passed;
		}

	}