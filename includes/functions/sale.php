<?PHP
	if (!defined('sitecms'))
		die('Hacking attempt...');
	
	require_once(dirname(__FILE__) ."/../connection/db.php");
	require_once(dirname(__FILE__) ."/../functions/manage.php");
	require_once(dirname(__FILE__) ."/../functions/string.php");
	require_once(dirname(__FILE__) ."/../functions/order.php");
	
	function doAddPerson($person, $paid)
	{
		$person["IsComplimentary"] = isset($person["IsComplimentary"]) ? "1" : "0";
		global $link;
		
		$sql = "INSERT INTO " . T_PERSON .
				" VALUES(" .
					" 'null', '" .
					$person["Name"] . "', " .
					$person["Rank"] . ", " .
					$person["IsComplimentary"] . ", " .
					$person["Meal"] . ", " .
					$person["Table"] . ", " .
					$person["Chairs"] . ", " .
					$person["NumberTickets"] . ", " .
					$paid . ", '" .
					date("Y-m-d H:i:s") . "', '" .
					$person["EmailAddress"] . "')";
				
		if(!$result = mysqli_query($link, $sql))
		{
			printf("Error: %s\n", mysqli_error($link));
			return false;
		}
		else
		{
			return true;	
		}
	}
	
	function doAddGuest($guestInfo)
	{
		global $link;
				
		$sql = "INSERT INTO " . T_GUESTS .
				" VALUES(" .
					" 'null', '" .
					$guestInfo["fullname"] . "', " .
					$guestInfo["sponsor"] . ", " .
					$guestInfo["mealType"] . ", " .
					$guestInfo["isComplimentary"] . ", " .
					$guestInfo["tableNum"] . ", " .
					$guestInfo["chairNum"] . ")";
				
		if(!$result = mysqli_query($link, $sql))
		{
			printf("Error: %s\n", mysqli_error($link));
		}
	}
	
	function doEmailReceipt($name, $to)
	{		
		$headers = 'From: CLB-453 Marine Corps Ball Application <' . $_SESSION['email'] . '>' . PHP_EOL ; 
				
		$person = getPersonByFullName($name);
		$location = getLocation();
		
		$locationPhone = formatPhone($location["L_Phone"]);
		
		$message = 	"Hello " . $name . ",\n" .
					"Below is a copy of your receipt for your recent transaction on " . $person["datePaid"] . ".\n\n" .
					
					"Number of tickets: " . $person["SeatsRequired"] . "\n" .
					"Total Paid: " . $person["AmtPaid"] . " (at the " . getRank($person["rank"]) . " rate)" . ".\n\n" .
					
					"The CLB-453 Marine Corps Ball will be held at the " . $location["L_Name"] . " this year.\n" .
					"It is located at " . $location["L_Street"] . ", " . $location["L_City"] . ", " . $location["L_State"] . " " . $location["L_Zip"] . ".\n" .
					"For driving directions, use Google maps at https://www.google.com/maps/preview#!q=Renaissance+Denver+Hotel or call the " . $location["L_Name"] . " at " . $locationPhone . ".\n\n\n\n" .
					
					"We look forward to seeing you there!\n\n" .
					"Semper Fidelis.";
		
		$subject = "Your Marine Corps Ball Ticket Purchase Receipt";
		
		mail($to, $subject, $message, $headers);
		
	}
	
	function getPersonByFullName($name)
	{
		global $link;
		
		$sql = "SELECT * FROM " . T_PERSON . " LIMIT 1";
		if($result = mysqli_query($link, $sql))
		{
			return mysqli_fetch_assoc($result);
		}
	}
?>