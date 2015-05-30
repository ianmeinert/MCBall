<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/sale.php");
	
	if(isset($_POST['submit']))
	{
		array_pop($_SESSION["GuestTickets"]);
		
		$GuestTickets = $_SESSION["GuestTickets"];
		
		unset($GuestTickets["submit"]);
				
		$PurchaseOrderInformation = $_SESSION["PurchaseOrderInformation"];
		
		//save person with payment information		
		if(doAddPerson($PurchaseOrderInformation, $_POST["paid"]))
		{			
			$personID = mysqli_insert_id($link);
			$maxGuest = preg_replace("/[^0-9,.]/", "", end( array_keys( $GuestTickets) ));
					
			//rebuild the guest info and submit it
			for($i = 1; $i <= (int) $maxGuest; $i++)
			{
				$guestInfo = array
				(
					"fullname" => $GuestTickets["guest".$i."fullname"],
					"sponsor" => $personID,
					"tableNum" => $GuestTickets["guest".$i."tableNum"],
					"mealType" => $GuestTickets["guest" . $i . "MealType"],
					"chairNum" => $GuestTickets["guest".$i."chairNum"]
				);
				
				$guestInfo["isComplimentary"] = isset($GuestTickets["guest".$i."IsComplimentary"]) ? "1" : "0";
								
				doAddGuest($guestInfo);
			}
			
			if(isset($PurchaseOrderInformation["EmailReceipt"]) 
				&& isset($PurchaseOrderInformation["EmailAddress"]))
				{
					doEmailReceipt(
						$PurchaseOrderInformation["Name"],
						$PurchaseOrderInformation["EmailAddress"]);
				}

			header('location: /index.php');
		}		
	}
	else
	{
		header("Location: /checkout.php");
	}

?>