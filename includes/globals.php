<?PHP

	/*********************************/
	/* Database definitions */
	/*********************************/

	define('DB_HOST','db485994345.db.1and1.com');
	define('DB_USER','dbo485994345');
	define('DB_PASS','vB2XSzaQguMM');
	define('DB_NAME','db485994345');

	/*********************************/
	/* Website global variables */
	/*********************************/
	
	$site['title'] = "CLB-453 Marine Corps Ball";
	$site['logoAlt'] = "Cutthroat";
	$site['logoImg'] = "logo.png";
	
	/*********************************/
	/* Do Not Modify below this line */
	/*********************************/
	
	define('sitecms', 1);
	define('T_PREFIX','mc_');
	define('T_COSTS',T_PREFIX . 'cost');	
	define('T_GUESTS',T_PREFIX . 'guest');	
	define('T_LOCATION',T_PREFIX . 'location');
	define('T_MEALS',T_PREFIX . 'meals');
	define('T_PERSON',T_PREFIX . 'person');
	define('T_RANK',T_PREFIX . 'rank');
	define('T_TABLES',T_PREFIX . 'tables');
	define('T_USERS',T_PREFIX . 'users');	
?>