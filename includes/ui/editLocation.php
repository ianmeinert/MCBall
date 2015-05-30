<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/manage.php");
	
	if(isset($_POST['Submit']))
	{
		if(isset($_POST['locationName']))
		{
			$nonNumericChars = array ( "(", ")", "-", ".", " " );
			
			$locationArray = array(
					"locationName" => filter_var(ucwords(strtolower($_POST['locationName'])), FILTER_SANITIZE_STRING),
					"locationStreet" => filter_var(ucwords(strtolower($_POST['locationStreet'])), FILTER_SANITIZE_STRING),
					"locationCity" => filter_var(ucwords(strtolower($_POST['locationCity'])), FILTER_SANITIZE_STRING),
					"locationState" => filter_var(strtoupper($_POST['locationState']), FILTER_SANITIZE_STRING),
					"locationZip" => filter_var(str_replace($nonNumericChars, "", $_POST['locationZip']), FILTER_SANITIZE_STRING),
					"locationPhone" => filter_var(str_replace($nonNumericChars, "", $_POST['locationPhone']), FILTER_SANITIZE_STRING),
					"locationTables" => $_POST['locationTables'],
					"locationSeats" => $_POST['locationSeats'],
					"locationID" => $_POST['locationID'],
				);
			
			
			createDinnerTableTables($_POST['locationTables'], $_POST['locationSeats']);
			
			doEditLocation($locationArray);
			header("Location: /manage-location.php");
		}
		else
		{
			echo "Please verify fields.";
			require_once('/editLocation.php');
		}
	}
	else
	{
		header("Location: /editLocation.php");
	}
?>