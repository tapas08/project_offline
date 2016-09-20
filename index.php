<?php
require_once('core/init.php');

$user = new User();

// if ($user->isLoggedIn()){
//     $data = $user->data();
//     //Redirect::to('dashboard.php');
// }
//$bcrypt = new Bcrypt;

//echo $bcrypt->hash("ts@1#2#3#");

// $user = new User();
// $bcrypt = new Bcrypt;

// try{

//     $user->create(array(

//         'username' => "Sujit",
//         'password' => $bcrypt->hash("ts@1#2#3#"),
//         'email' => "",
//         //'salt' => '',
//         'name' => "Admin",
//         'date' => date('Y-m-d H:i:s'),
//         'permission' => 1

//         ));
//     echo "true";

// }catch(Exception $e){
//     die($e->getMessage());
//     //echo "Oops there was problem registering user!";
// }



$db = DB::getInstance();

if (Input::exists()){
    if (Token::check_for_login(Input::get('token'))){

            $validate = new Validation();

            $validation = $validate->check($_POST,array(
                'username' => array(
                    'required' => true
                    ),
                'password' => array('required' => true)
            ));

            if ($validation->passed()){
                $user = new User();
                $remember = (Input::get('rememberme') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);
                if($login){
                    //Redirect::to("dashboard.php");
                }else{
                    echo 'username / password is incorrect!';
                }
            }else{
                foreach($validation->errors() as $error){
                    echo $error."<br/>";
                }
            }

        }
}

?>

<!DOCTYPE html>
<html class=" ">
    

<head>
        
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Medisoft Admin : Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->




        <!-- CORE CSS FRAMEWORK - START -->
        <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <link href="assets/plugins/icheck/skins/square/orange.css" rel="stylesheet" type="text/css" media="screen"/>        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" login_page">


        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <h1><a href="#" title="Login Page" tabindex="-1">Medisoft Admin</a></h1>

                <form name="loginform" id="loginform" action="sample.php" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="user_login">Username<br/>
                            <input type="text" name="username" id="user_login" class="input"  size="20" /></label>
                    </p>
                    <p>
                        <label for="user_pass">Password<br/>
                            <input type="password" name="password" id="user_pass" class="input"  size="20" /></label>
                    </p>
                    <input type="hidden" name="token" value="<?php echo Token::generate_for_loginForm(); ?>">
                    <p class="forgetmenot">
                        <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" class="skin-square-orange" checked> Remember me</label>
                    </p>



                    <p class="submit">
                        <input type="submit" name="login" id="wp-submit" class="btn btn-orange btn-block" value="Sign In" />
                    </p>
                </form>

                <p id="nav">
                    <a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a>
                    <a class="pull-right" href="ui-register.php" title="Sign Up">Sign Up</a>
                </p>


            </div>
        </div>

    </body>
</html>



