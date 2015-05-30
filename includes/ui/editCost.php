<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/manage.php");
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['price']) && is_numeric($_POST['price']))
		{
			doEditCost(
				$_POST['price'],
				$_POST['priceID']);
							
			header("Location: /manage-prices.php");
		}
		else
		{
			echo "Please set a price.";
			require_once('/manage-prices.php?edit=' . $_POST['priceID']);
		}
	}
	else
	{
		header("Location: /manage-prices.php");
	}

?>