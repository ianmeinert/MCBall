<?PHP
	if (!defined('sitecms'))
	die('Hacking attempt...');
	
	require_once(dirname(__FILE__) ."/../connection/db.php");
	
	function createDinnerTableTables($tables, $chairs)
	{
		global $link;
		
		//Lets just drop the table
		$sql = "DROP TABLE IF EXISTS `" . T_TABLES . "` ";
		mysqli_query($link, $sql);
		
		
		//Recreate the table with the appropriate data
		$sql =	"CREATE TABLE IF NOT EXISTS `" . T_TABLES . "` (
					`ID` INT( 3 ) NOT NULL ,
					`ChairNum` VARCHAR( 2 ) NOT NULL ,
					`IsTaken` TINYINT( 2 ) NOT NULL
				)";		
		mysqli_query($link, $sql);		
		
		for($tableNum = 1; $tableNum <= $tables; $tableNum++)
		{
			for($chairNum = 1; $chairNum <= $chairs; $chairNum++)
			{
				//Check to make sure the seat is not taken
				$sql =  "SELECT * " .
						" FROM " . T_PERSON .
						" WHERE Table = " . $tableNum .
						" AND Seat = " . $chairNum;
				
				$isTaken = 0;
				
				//1 = taken, 0 = available
				if($result = mysqli_query($link, $sql))
				{
					$isTaken = mysqli_num_rows($result) > 0 ? 1 : 0;	
				}						
				
				//Add the new record
				$sql = "INSERT INTO " . T_TABLES .
						" VALUES(" .
						$tableNum . ", " .
						$chairNum . ", " .
						$isTaken . ")";
				
				if(!$result = mysqli_query($link, $sql))
				{
					printf("Error: %s\n", mysqli_error($link));
				}
			}
		}		
	}
	
	function getLocation()
	{
		global $link;
		
		$sql = "SELECT * FROM " . T_LOCATION . " LIMIT 1";
		if($result = mysqli_query($link, $sql))
		{
			return mysqli_fetch_assoc($result);
		}
	}
	
	function doEditLocation($locationArray)
	{
		global $link;
		$locId = $locationArray["locationID"];
		
		if($locId == NULL || $locId == "")
		{
			doAddLocation($locationArray);
		}
		else
		{
			$sql = "UPDATE " . T_LOCATION . " SET " .
					"L_Name = '" . $locationArray["locationName"] . "', " .
					"L_Street  = '" . $locationArray["locationStreet"] . "', " .
					"L_City  = '" . $locationArray["locationCity"] . "', " .
					"L_State = '" . $locationArray["locationState"] . "', " .
					"L_Zip  = '" . $locationArray["locationZip"] . "', " .
					"L_Phone  = '" . $locationArray["locationPhone"] . "', " .
					"NumTables  = '" . $locationArray["locationTables"] . "', " .
					"NumChairs  = '" . $locationArray["locationSeats"] . "' " .
					"WHERE ID = " . (int) $locId;
					
			if(!$result = mysqli_query($link, $sql))
			{
				printf("Error: %s\n", mysqli_error($link));
			}
		}
	}
		
	function doAddLocation($locationArray)
	{
		global $link;
		
		$sql = "INSERT INTO " . T_LOCATION .
				" VALUES(" .
					" 'null', '" .
					$locationArray["locationName"] . "', '" .
					$locationArray["locationStreet"] . "', '" .
					$locationArray["locationCity"] . "', '" .
					$locationArray["locationState"] . "', '" .
					$locationArray["locationZip"] . "', '" .
					$locationArray["locationPhone"] . "', '" .
					$locationArray["locationTables"] . "', '" .
					$locationArray["locationSeats"] . "')";
				
		if(!$result = mysqli_query($link, $sql))
			{
				printf("Error: %s\n", mysqli_error($link));
			}
	}
	
	function getPrices()
	{
		global $link;
		
		$query = "SELECT * FROM " . T_COSTS . " ORDER BY ID ASC";
				
		if (mysqli_real_query( $link, $query)) 
		{
			if ($result = mysqli_use_result($link)) {				
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>" . $row['grade'] . "</td>";
					echo "<td>" . $row['price'] . "</td>";
					echo "<td><a href='manage-prices.php?edit=" . $row['ID'] . "'>Edit</a>";
					echo "</td></tr>";
				}
				mysqli_free_result($result);
			}
		}
	}
	
	function getPricesWithEdit($priceID)
	{		
		global $link;
		
		$query = "SELECT * FROM " . T_COSTS . " ORDER BY ID ASC";

		if ($result = mysqli_query($link, $query)) 
		{
			
			if(mysqli_affected_rows($link) != 0)
			{
				while ($row = mysqli_fetch_array($result))
				{					
					if($row['ID'] == $priceID)
					{	
						echo "<form method='post' action='/includes/ui/editCost.php' onsubmit='return validate(this);'>";
						echo "<tr><td>" . $row['grade'] . "</td>";
						echo "<td><input type='text' name='price' maxlength='5' placeholder='" . $row['price'] . "' />";
						echo "<input type='hidden' name='priceID' value='" . $row['ID'] . "' /></td>";
						echo "<td><button type='submit' name='submit' >Save</button>";
						echo " | <a href=\"/manage-prices.php\">Cancel</a>";
						echo "</form>";
					}
					else
					{
						echo "<tr><td>" . $row['grade'] . "</td>";
						echo "<td>" . $row['price'] . "</td>";
						echo "<td><a href='manage-prices.php?edit=" . $row['ID'] . "'>Edit</a>";
					}
					echo "</td></tr>";
				}
			}
			else
			{
				echo "<tr><td colspan='2'>No meal types found</td></tr>";
			}
		
			mysqli_free_result($result);
		}
	}
	
	function getCost($costID)
	{
		global $link;
		
		$sql = "SELECT * FROM " . T_COSTS .
			   " WHERE ID = " . $costID;
			   
		if($result = mysqli_query($link, $sql))
		{
			return mysqli_fetch_assoc($result);
		}
	}
	
	function doEditCost($price, $priceID)
	{	
		global $link;
		
		$sql = "UPDATE " . T_COSTS . " SET " .
				"price  = " . $price . " " .
				"WHERE ID = " . (int) $priceID;
				
		if(!$result = mysqli_query($link, $sql))
		{
			printf("Error: %s\n", mysqli_error($link));
		}
	}
	
	function getMeals()
	{
		global $link;
		
		$query = "SELECT * FROM " . T_MEALS . " ORDER BY ID ASC";

		if ($result = mysqli_query($link, $query)) {
			
			if(mysqli_affected_rows($link) != 0)
			{
				while ($row = mysqli_fetch_array($result))
				{
					echo "<tr><td>" . $row['type'] . "</td>";
					echo "<td><a href=\"manage-meals.php?edit=" . $row['ID'] . "\">Edit</a>";
					echo " | <a href=\"/includes/ui/deleteMeal.php?id=" . $row['ID'] . "\" onclick=\"return confirm('Are you sure you want to delete this?') \">Delete</a>";
					echo "</td></tr>";
				}
			}
			else
			{
				echo "<tr><td colspan='2'>No meal types found</td></tr>";
			}
		
			mysqli_free_result($result);
		}
	}
	
	function getMealTypeWithEdit($mealID)
	{
		global $link;
		
		$query = "SELECT * FROM " . T_MEALS . " ORDER BY ID ASC";

		if ($result = mysqli_query($link, $query)) {
			
			if(mysqli_affected_rows($link) != 0)
			{
				while ($row = mysqli_fetch_array($result))
				{
					if($row['ID'] == $mealID)
					{	
						echo "<form method='post' action='/includes/ui/editMeal.php' onsubmit='return validate(this);'>";
						echo "<tr><td><input type='text' name='mealType' maxlength='50' size='75' placeholder='" . $row['type'] . "' />";
						echo "<input type='hidden' name='mealID' value='" . $row['ID'] . "' /></td>";
						echo "<td><button type='submit' name='submit' >Save</button>";
						echo " | <a href=\"/manage-meals.php\">Cancel</a>";
						echo "</form>";
					}
					else
					{
						echo "<tr><td>" . $row['type'] . "</td>";
						echo "<td><a href=\"editMeal.php?id=" . $row['ID'] . "\">Edit</a>";
						echo " | <a href=\"/includes/ui/deleteMeal.php?id=" . $row['ID'] . "\" onclick=\"return confirm('Are you sure you want to delete this?') \">Delete</a>";
					}
					echo "</td></tr>";
				}
			}
			else
			{
				echo "<tr><td colspan='2'>No meal types found</td></tr>";
			}
		
			mysqli_free_result($result);
		}
	}
	
	function getMealType($mealID)
	{
		global $link;
		
		$sql = "SELECT * FROM " . T_MEALS .
			   " WHERE ID = " . $mealID;
			   
		if($result = mysqli_query($link, $sql))
		{
			return mysqli_fetch_assoc($result);
		}
	}
	
	function doEditMeal($mealType, $mealID)
	{	
		global $link;
		
		$sql = "UPDATE " . T_MEALS . " SET " .
				"type  = '" . $mealType . "' " .
				"WHERE ID = " . (int) $mealID;
				
		if(!$result = mysqli_query($link, $sql))
		{
			printf("Error: %s\n", mysqli_error($link));
		}
	}
	
	function doDeleteMeal($id) 
	{
		global $link;
		$id = (int)$id;
		
		$sql = "DELETE FROM " . T_MEALS . " WHERE ID = " . $id;
		mysqli_query($link, $sql);
		
		header("Location: /manage-meals.php");
	}
	
	function doAddMeal($mealType)
	{	
		global $link;
		
		$sql =  "INSERT INTO " . T_MEALS . 
			   " VALUES ('null', '" . $mealType . "')";
				
		if(!$result = mysqli_query($link, $sql))
		{
			printf("Error: %s\n", mysqli_error($link));
		}
	}
?>