<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/order.php");
	
	$result = getTableList();
	
	while($row = mysqli_fetch_assoc($result))
	{	
		echo '<option value=' . $row['ID'] .'>Table ' . $row['ID'] . '</option>';
	}
?>