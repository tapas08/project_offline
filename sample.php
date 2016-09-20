<?php 

require_once 'core/init.php';

// $user = new User();

if (Input::exists()){
    if (Token::check_for_login(Input::get('token'))){
            $validate = new Validation();

            $validation = $validate->check($_POST,array(
                'username' => array(
                	'required' => true,
                	'min' => 5,
                	'max' => 10,
                	'numeric' => true
                	),
                'password' => array('required' => true),
                'c_pass' => array(
                	'required' => true,
                	'matches' => 'password'
                	)
            ));

           print_r($validation->errors());
    }
}



?>

<form action="" method="POST">
	<input type="text" name="username">
	<input type="password" name="password">
	<input type="password" name="c_pass">
	<input type="hidden" name="token" value="<?php echo Token::generate_for_loginForm(); ?>">
	<input type="submit">
</form>
