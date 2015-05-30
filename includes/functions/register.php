<?PHP
	if (!defined('sitecms'))
	die('Hacking attempt...');
	
	require_once(dirname(__FILE__) ."/../connection/db.php");
	require_once(dirname(__FILE__) ."/password.php");
	
	function doRegister()
	{
		global $link;
		
		$fullname 	= 	ucwords(strtolower(mysqli_real_escape_string($link,  $_POST['FullName'])));
		$email 		=	strtolower(filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL));
		$userName   =   strtolower(mysqli_real_escape_string($link, $_POST['User']));
		$hash		=	create_hash(mysqli_real_escape_string($link, $_POST['Password1']));
		$active		=	 0;
		$activateKey = hash('sha256', mt_rand());
		
		mysqli_query($link, "SET AUTOCOMMIT=0");
		mysqli_query($link, "START TRANSACTION");
		
		
		$sql =  "INSERT IGNORE INTO  " . T_USERS . 
					" (Username,email,password,Fullname,active,activateKey) " .
				" VALUES ('$userName','$email','$hash','$fullname',$active,'$activateKey')";
								
		$result = mysqli_query($link, $sql) or die(mysqli_error($link) . "SQL = {$sql}");
		
		
		if($result)
		{
			mysqli_query($link, "COMMIT");
			
			sendActivationEmail($fullname, $email, $activateKey);
			
			header('location: /index.php');
		}
		else
		{
			mysqli_query($link, "ROLLBACK");
			echo "Insert Failed.";
		}			
	}
	
	function doActivate($activateKey)
	{		
		global $link;
		
		//adjust the active from 0 to 1 then delete the activateKey from user record
		$sql = 	"UPDATE " . T_USERS . " SET active = 1, activateKey = null WHERE activateKey = '$activateKey'";
		
		//Commented out while in test when not in development.
		mysqli_query($link, $sql) or die(mysqli_error($link) . "SQL = {$sql}");
		
		//go to the login page to have user login
		header('location: /index.php');
	}
	
	function sendActivationEmail($name, $to, $activateKey)
	{		
		$headers = 'From: admin@meinertfamily.us' . PHP_EOL ; 
		
		$site = $_SERVER['HTTP_HOST']; //modify when moved to production
		
		$message = 	"Hello " . $name . ", welcome to CLB 453's Marine Corps Ball website. " . 
					"Before you can use your account you must activate it! " .
					"You can activate here: " . 
					"http://" . $site . "/includes/ui/activate.php?key=" . $activateKey;
		
		$subject = "Your New Account on Ian's Blog";
		
		mail($to, $subject, $message, $headers);
		header('location: /index.php');
	}
?>