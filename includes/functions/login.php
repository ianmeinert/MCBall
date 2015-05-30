<?PHP
	if (!defined('sitecms'))
	die('Hacking attempt...');
	
	require_once(dirname(__FILE__) ."/../connection/db.php");
	require_once(dirname(__FILE__) ."/password.php");
	
	function doLogin()
	{
		global $link;
		
		if(isset($_POST['login']) &&
			isset($_POST['username']) && 
			isset($_POST['password']))
		{
			$username = mysqli_real_escape_string($link, $_POST['username']);
			$sql = "SELECT * FROM " . T_USERS . " WHERE username = '$username'";
			$password = $_POST['password'];
			$username = $_POST['username'];
			$loginStatus = "";
				
			if ($result = mysqli_query($link, $sql)) 
			{			
				while ($row = mysqli_fetch_assoc($result)) 
				{ 
					if(validate_password($password, $row['password']) && $row['active']==0)
					{
						$loginStatus = "inactive";
					}
					elseif(validate_password($password, $row['password']) && $row['active']==1)
					{
						$_SESSION['user'] =  $username;
						$_SESSION['name'] = $row['fullname'];
						$_SESSION['email'] = $row['email'];
						$loginStatus = "loggedin";
					}
					else
					{
						$loginStatus = "invalid";
					}
				}
				
				mysqli_free_result($result);
			}

			
			$_SESSION['login_status'] = $loginStatus;
			header("Location: /index.php");
		}
	}
	
	function getLoginStatus($loginStatus)
	{
		switch($loginStatus)
		{
			case "invalid":
				return "Please check your username/password and try again.";
				break;
			case "inactive":
				return "Your account is not active. Please try again later.";
				break;
			case "loggedin":
				return "Login successful " . $_SESSION['user'];
				break;
			default:
				return "";
				break;	
		}
	}
	
	function doLogout()
	{
		session_destroy();
		header("Location: /index.php");
	}
?>