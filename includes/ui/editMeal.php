<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/manage.php");
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['mealType']))
		{
			doEditMeal($_POST['mealType'], $_POST['mealID']);
			header("Location: /manage-meals.php");
		}
		else
		{
			echo "Please verify fields.";
			require_once('/manage-meals.php?edit=' . $_POST['mealID']);
		}
	}
	else
	{
		header("Location: /manage-meals.php?edit=" . $_POST['mealID']);
	}
?>