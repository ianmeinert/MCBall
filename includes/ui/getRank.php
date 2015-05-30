<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/order.php");
	
	echo "<select name=\"rank\" >";
	echo "<option value=''>Select a Rank</option>";
	$result = getRankList($_GET['s']);
	
	while($row = mysqli_fetch_assoc($result))
	{	
		 echo '<option value=' . $row['grade'] .'>' .   $row['Rank_Long'] . '</option>';
	}
	
	echo "</select>";
?>