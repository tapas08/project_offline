<?php  

 date_default_timezone_set('Asia/Calcutta'); 
define('HTTP_DOMAIN','http://localhost/project_offline_db/');
define('FTP_DOMAIN', 'D:/xampp/htdocs/project_offline_db/');

define('FTP_AVATAR_DIR', FTP_DOMAIN.'images/Avatar/');
define('HTTP_AVATAR_DIR', HTTP_DOMAIN.'images/Avatar/');

require_once('models/db.php');
require_once('includes/database.php');
session_name('Auth');
session_start();
?>
