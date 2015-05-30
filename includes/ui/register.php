<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/register.php");
	
	if(isset($_POST['Submit']) && $_POST["body"] == "")
	{
		doRegister();
	}
	elseif(isset($_REQUEST['key']) && !empty($_REQUEST['key']))
	{
		doActivate(filter_var($_REQUEST['key'], FILTER_SANITIZE_STRING));
	}
	else
	{
		header('location: /index.php');
	}
?>