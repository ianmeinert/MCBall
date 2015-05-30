<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/register.php");
	
	if ($_GET["key"] != "")
	{
		doActivate($_GET["key"]);
	}
	else
	{
		print("Invalid key.");
	}
?>