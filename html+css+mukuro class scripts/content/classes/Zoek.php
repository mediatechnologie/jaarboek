<?php
include_once 'Connect.php';
include_once 'Defineer_klas.php';

Class Zoek
{
	function haal_leerling($leerling_opdracht)
	{
		$this->zoeken_leerling($leerling_opdracht);
	}
	function haal_project($project_opdracht)
	{
		$this->zoeken_project($project_opdracht);
	}
	private function zoeken_project($opdracht)
	{
		$con = new Connect();
		$con->connect();
		$query = mysql_query($this->returnO($opdracht));
		$rows=mysql_num_rows($query);
		if($rows != 0){		
			while ($row = mysql_fetch_array($query)) {
				echo "<a href='profile.php?id=" .$row['leerling_id'] . "'>". $row['naam'] . "</a><br/>";
			}
		}
		else
		{
			echo 'geen resultaten!';
		}
	}
	private function zoeken_leerling($opdracht)
	{
		$con = new Connect();
		$con->connect();
		
		$query = mysql_query($this->returnL($opdracht));
		$rows=mysql_num_rows($query);
		if($rows != 0){		
			while ($row = mysql_fetch_array($query)) {
				echo $this->resultaten($row);
			}
		}
		else
		{
			echo 'geen resultaten!';
		}
	}
	private function returnO($opdracht)
	{
		if(is_numeric($opdracht)){
			return "SELECT * FROM project WHERE leerling_id like '%$opdracht%' order by leerling_id";
		}
		else
		{
			return "SELECT * FROM project WHERE naam like '%$opdracht%' order by naam";
		}
	}
	private function returnL($opdracht)
	{
		if(is_numeric($opdracht)){
			return "SELECT * FROM leerling WHERE leerling_id like '%$opdracht%' order by leerling_id";
		}
		else
		{
			return "SELECT * FROM leerling WHERE voornaam like '%$opdracht%' order by voornaam";
		}
	}
	private function resultaten($arr)
	{
		$richt = new Defineer_klas();
		$klas = $richt->defineer($arr['richting']);
		$resultaat = "<a href='profile.php?id=" . $arr['leerling_id'] . "'>". $arr['leerling_id']. " " . $arr['voornaam']. " ". $arr['tussenvoegsels']. " ". $arr['achternaam']. " ". $klas."</a><br/><br/>";
		
		return $resultaat;
	}
}
?>