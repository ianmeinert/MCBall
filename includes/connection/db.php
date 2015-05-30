<?PHP
	if (!defined('sitecms'))
	die('Hacking attempt...');
	
	require_once(dirname(__FILE__) ."/../globals.php");

	session_start();
	
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>