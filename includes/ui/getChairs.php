<?PHP
	require_once(dirname(__FILE__) ."/../globals.php");
	require_once(dirname(__FILE__) ."/../functions/order.php");
	
	if(isset($_GET["s"]) && !isset($_GET["g"]))
	{
		echo "<select name=\"chairs\">";
		echo "<option value=''>Select a Seat</option>";
		$result = getChairList($_GET["s"]);
		
		while($row = mysqli_fetch_assoc($result))
		{	
			echo '<option value=' . $row['ChairNum'] .'>Chair ' . $row['ChairNum'] . '</option>';
		}
		echo "</select>";
	}
	
	if(isset($_GET["s"]) && isset($_GET["g"]))
	{
		echo "<select name=\"guest" . $_GET["g"] . "chairNum\">";
		echo "<option value=''>Select a Seat</option>";
		$result = getChairList($_GET["s"]);
		
		while($row = mysqli_fetch_assoc($result))
		{	
			echo '<option value=' . $row['ChairNum'] .'>Chair ' . $row['ChairNum'] . '</option>';
		}
		echo "</select>";
	}
?>