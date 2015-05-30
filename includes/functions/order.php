<?PHP
	if (!defined('sitecms'))
		die('Hacking attempt...');
	
	require_once(dirname(__FILE__) ."/../connection/db.php");
	
	function getRankList($service)
	{
		global $link;
		
		$sql = "SELECT grade, Rank_Long FROM " . T_RANK . " WHERE Service = '" . $service . "' ORDER BY ID";	
		
		if($result = mysqli_query($link, $sql))
		{		
			return $result;
		}		
	}
	
	function getRank($rankID)
	{
		global $link;
		
		$sql = "SELECT Rank_Long FROM " . T_RANK . " WHERE ID = " . $rankID;	
		
		if($result = mysqli_query($link, $sql))
		{	
			while($row = mysqli_fetch_assoc($result))
			{	
				 return $row['Rank_Long'];
			}				
		}		
	}
	
	function getMealList()
	{
		global $link;
		
		$sql = "SELECT * FROM " . T_MEALS . " ORDER BY type";	
		
		if($result = mysqli_query($link, $sql))
		{		
			return $result;
		}		
	}
	
	function getTableList()
	{
		global $link;
		
		$sql = "SELECT DISTINCT ID FROM " . T_TABLES . " WHERE isTaken = 0 ORDER BY ID";	
		
		if($result = mysqli_query($link, $sql))
		{		
			return $result;
		}	
	}

	function getChairList($tableNum)
	{
		global $link;
		
		$sql = "SELECT ChairNum FROM " . T_TABLES . " WHERE ID = " . $tableNum . " AND isTaken = 0 ORDER BY ID";	
		
		if($result = mysqli_query($link, $sql))
		{		
			return $result;
		}	
	}
	
	function getTicketPrice($ID)
	{
		global $link;
		
		$sql = "SELECT price FROM " . T_COSTS . " WHERE ID = " . $ID;	
		
		if($result = mysqli_query($link, $sql))
		{		
			while($row = mysqli_fetch_assoc($result))
			{	
				 return $row['price'];
			}
		}	
		
	}
	
	function getMeal($ID)
	{
		global $link;
		
		$sql = "SELECT type FROM " . T_MEALS . " WHERE ID=" . $ID;	
		
		if($result = mysqli_query($link, $sql))
		{		
			while($row = mysqli_fetch_assoc($result))
			{	
				 return $row['type'];
			}
		}		
	}
?>