<?php
Class Profiel
{
	var $user = 'root'; 
	var $passw = ''; 
	var $server = 'localhost'; 
	var $database = 'php_ma-jaarboek';
	
	var $gebruikerData = array();
	
	function _connect()
	{
		mysql_connect($this->server,$this->user,$this->passw);
		mysql_select_db($this->database);
	}
	function haal($user_id)
	{
		$this->_connect();
		$query = mysql_query("SELECT * FROM leerling WHERE leerling_id = '$user_id'");
		$row = mysql_fetch_array($query);
		foreach($row as $key => $val)
		{
			if(!is_numeric($key))
			{
				if(isset($this->gebruikerData["$key"]))
				{
					//
				}
				else
				{
					$this->gebruikerData["$key"] = $val;
				}
			}
		}
	}
	function kijk($c_id)
	{
		$this->haal($c_id);
		echo $this->gebruikerData['voornaam'] ." ". $this->gebruikerData['achternaam'];
		echo "<img src='images/studenten/".$this->gebruikerData['avatar'] ."' height='150'>";
		echo $this->gebruikerData['richting'];
	}
}
$db = new Profiel();
if(isset($_GET['id']))
{
	$db->kijk($_GET['id']);
}
else{
?>
<form method=post acion=""<?php $_SERVER['PHP_SELF'] ?>"">       
		Leerling ID: <INPUT type="text" name="ll_id">       
		<input type="submit" value="submit" name="submit">
</form>
<?
if(isset($_POST['submit']))
{
	if(is_numeric($_POST['ll_id'])){
	$url = 'http://localhost/jaarboek/Profiel.php?id='.$_POST['ll_id'];
	header("Location: $url");
	}
	else
	{ echo 'id plz!'; }
}
}?>