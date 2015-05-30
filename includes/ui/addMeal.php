<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/manage.php");
	
	if(isset($_POST['Submit']))
	{
		if(isset($_POST['tbType']) && $_POST['tbType'] != "")
		{
			$mealFiltered = filter_var(ucwords(strtolower($_POST['tbType'])), FILTER_SANITIZE_STRING);
				
			doAddMeal($mealFiltered);
		}
	}
	
	header("Location: /manage-meal.php");
?>