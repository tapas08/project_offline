<?php require_once('includes/config.php');

if(isset($_POST['submit']))
{
	$errors=array();
	$errors = validate_signup();
	if(!count($errors))
	{
		$sql = mysql_query("select email from users where email='".$_POST['email']."'");
		$result = mysql_fetch_assoc($sql);
		if(isset($result['email']))
		{
			echo "This Email Already Register";
		}
		else
		{
			$_POST['password'] = md5($_POST['password']);
			$_POST['cpassword'] = md5($_POST['cpassword']);
			
			$adddata = "insert into users set name='".$_POST['name']."', email='".$_POST['email']."',uname='".$_POST['uname']."', password='".$_POST['password']."',cpassword='".$POST['cpassword']."', created=Now()";
			//print_r($adddata);exit;
			if(mysql_query($adddata))
			{
				header("location:signup_success.php");
				exit;
			}
			else
			{
				echo "Fail to Save";
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
        <title>Medisoft Admin : Registration Page</title>
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


        <div class="register-wrapper">
            <div id="register" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <h1><a href="#" title="Login Page" tabindex="-1">Medisoft Admin</a></h1>

                <form name="loginform" id="loginform" enctype="multipart/form-data" action="#" method="post">
                    <p>
                        <label for="user_login">Full Name<br />
                            <input type="text" name="name" id="user_login" class="input" value="" size="20" /></label>
							
							<div><?php if(isset($errors['name'])){?><div class="error"><?php echo $errors['name']; ?></div><?php } ?></div>
                    </p>
                    <p>
                        <label for="user_login">Email<br />
                            <input type="text" name="email" id="user_login" class="input" value="" size="20" /></label>
							<div><?php if(isset($errors['email'])){?><div class="error"><?php echo $errors['email']; ?></div><?php } ?></div>
                    </p>
                    <p>
                        <label for="user_login">Username<br />
                            <input type="text" name="uname" id="user_login" class="input" value="" size="20" /></label>
							<div><?php if(isset($errors['uname'])){?><div class="error"><?php echo $errors['uname']; ?></div><?php } ?></div>
                    </p>
                    <p>
                        <label for="user_pass">Password<br />
                            <input type="password" name="password" id="user_pass" class="input" value="" size="20" /></label>
							<div><?php if(isset($errors['password'])){?><div class="error"><?php echo $errors['password']; ?></div><?php } ?></div>
                    </p>
                    <p>
                        <label for="user_pass">Confirm Password<br />
                            <input type="password" name="cpassword" id="user_pass1" class="input" value="" size="20" /></label>
							<div><?php if(isset($errors['cpassword'])){?><div class="error"><?php echo $errors['cpassword']; ?></div><?php } ?></div>
                    </p>
                    <p class="forgetmenot">
                        <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" class="skin-square-orange" checked> I agree to terms to conditions</label>
                    </p>



                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="btn btn-orange btn-block" value="Sign Up" />
                    </p>
                </form>

                <p id="nav">
                    <a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a>
                    <a class="pull-right" href="index.php" title="Sign Up">Sign In</a>
                </p>
                <div class="clearfix"></div>
                <div class="col-md-12 text-center register-social">

                    <a href="#" class="btn btn-primary btn-lg facebook"><i class="fa fa-facebook icon-sm"></i></a>
                    <a href="#" class="btn btn-primary btn-lg twitter"><i class="fa fa-twitter icon-sm"></i></a>
                    <a href="#" class="btn btn-primary btn-lg google-plus"><i class="fa fa-google-plus icon-sm"></i></a>
                    <a href="#" class="btn btn-primary btn-lg dribbble"><i class="fa fa-dribbble icon-sm"></i></a>

                </div>

            </div>
        </div>

    </body>
</html>



