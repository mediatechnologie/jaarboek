<?php
include_once 'content/classes/Connect.php';
include_once 'content/classes/Defineer_klas.php';

Class Profiel
{	
	var $gebruikerData = array();
	
	var $voornaam;
	var $tussenvoegsels;
	var $achternaam;
	var $richting;
	var $avatar;
	
	function haal($user_id)
	{
		$con = new Connect();
		$con->connect();
		$query = mysql_query("SELECT * FROM leerling WHERE leerling_id = '$user_id'");
		$row = mysql_fetch_array($query);
		if($row < 1){
			return false;
		}
		else{
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
			return true;
		}
	}
	function kijk($c_id)
	{
		$richt = new Defineer_klas();
		if($this->haal($c_id))
		{
			$this->voornaam = $this->gebruikerData['voornaam'];
			$this->tussenvoegsels = $this->gebruikerData['tussenvoegsels'];
			$this->achternaam = $this->gebruikerData['achternaam'];
			$this->avatar = "images/studenten/".$this->gebruikerData['avatar'];
			$this->richting = $richt->defineer($this->gebruikerData['richting']);
		}
	}	
}
?>