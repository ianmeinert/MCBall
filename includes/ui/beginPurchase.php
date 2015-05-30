<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/manage.php");
	
	if(isset($_POST['submit']))
	{
		$purchaseOrderInfo = array 
			(
				"Name" => $_POST['name'],
				"Service" => $_POST['service'],
				"Rank" => $_POST['rank'],
				"Meal" => $_POST['meals'],
				"IsComplimentary" => $_POST['isComplimentary'],
				"Table" => $_POST['table'],
				"Chairs" => $_POST['chairs'],
				"NumberTickets" => $_POST['numberTickets'],
				"EmailReceipt" => $_POST['emailReceipt'],
				"EmailAddress" => $_POST['emailAddress']
			);
			
		$_SESSION["PurchaseOrderInformation"] = $purchaseOrderInfo;
			
		if(isset($_POST['numberTickets']) && is_numeric($_POST['numberTickets']) && $_POST['numberTickets'] > 1)
		{
			header("Location: /add-guests.php");
		}
		else
		{
			header("Location: /checkout.php");
		}
	}
	else
	{
		header("Location: /new-order.php");
	}

?>