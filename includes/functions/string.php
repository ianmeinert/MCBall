<?PHP
	if (!defined('sitecms'))
	die('Hacking attempt...');
	
	function left($str, $length) {
		 return substr($str, 0, $length);
	}
	
	function right($str, $length) {
		 return substr($str, -$length);
	}
	
	function html2txt($document){
		$search = array('@<script[^>]*?>.*?</script>@si');  // Strip out javascript
		$text = preg_replace($search, '', $document);
		return $text;
	} 
	
	function formatPhone($num)
	{
		$num = preg_replace('/[^0-9]/', '', $num);
		 
		$len = strlen($num);
		if($len == 7)
		$num = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $num);
		elseif($len == 10)
		$num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $num);
		 
		return $num;
	}
?>