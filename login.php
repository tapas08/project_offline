
<?php 
require_once("includes/config.php");

if(isset($_POST['login']))
{
	
	if(empty($_POST['email']) && empty($_POST['password']))
	{
	
		$errors="Please Enter Login Credentials";	
	
	}
	else
	{
	
		$_POST['password']= md5($_POST['password']);
		$sql = mysql_query("select * from users where email='".$_POST['email']."' and password='".$_POST['password']."'");	
		$result = mysql_fetch_assoc($sql);
		if(isset($result['id']))
		{
			unset($result['password']);
			$_SESSION['auth'] = $result;
			header("location:dashboard.php");
		}
		else
		{
			$errors= "Not Authorised";
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

                <form name="loginform" id="loginform" method="post" enctype="multipart/form-data>
                    <p>
                        <label for="user_login">Email<br/>
                            <input type="text" name="email" id="user_login" class="input"  size="20" /></label>
                    </p>
                    <p>
                        <label for="user_pass">Password<br/>
                            <input type="password" name="password" id="user_pass" class="input"  size="20" /></label>
                    </p>
                    <p class="forgetmenot">
                        <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" class="skin-square-orange" checked> Remember me</label>
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



