<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/order.php");
	
	echo "<select name=\"meals\" >";
	echo "<option value=''>Select a Meal</option>";
	$result = getMealList();
	
	while($row = mysqli_fetch_assoc($result))
	{	
		 echo '<option value=' . $row['ID'] .'>' .   $row['type'] . '</option>';
	}
	
	echo "</select>";
?>