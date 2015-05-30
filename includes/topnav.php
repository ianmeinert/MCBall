<?PHP 
	if(isset($_SESSION['user']))
	{
?>
		<ul class="username">
<?PHP
		echo "Hello " . $_SESSION['name'];
?>
        </ul>
        <ul id="nav">
            <li><a href="/">Home</a></li>
            <li><a href="/reports.php">Reports</a></li>
        </ul>
<?PHP
	}
?>