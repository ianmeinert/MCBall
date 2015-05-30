<?PHP
	if(isset($_SESSION['user'])) 
	{
		require_once(dirname(__FILE__) ."/userMenu.php");
	}

	else
	{
?>
    <form action="/includes/ui/login.php" method="post" id="login-form">
        Username:<br />
        <input type="text" name="username" class="txt"/><br />
        Password:<br /><br />
		<input type="password" name="password" class="txt"/><br />
        Or <a href="register.php">register</a>
        <button type="submit" name="login" onclick="" >Login</button><br />
<?PHP 
		require_once(dirname(__FILE__) ."/../functions/login.php");
		if(isset($_SESSION['login_status']))
		{
			echo "<span style=\"color:red\">" . getLoginStatus($_SESSION['login_status']) . "</span>";
			session_unset();
		}
?>
	</form>
<?PHP } ?>