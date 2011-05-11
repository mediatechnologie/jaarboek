<?php
include_once 'Connect.php';
include_once 'Defineer_klas.php';

Class Zoek
{
	function haal($opdracht)
	{
		$this->zoeken($opdracht);
	}
	private function zoeken($opdracht)
	{
		$con = new Connect();
		$con->connect();
		
		$query = mysql_query($this->returnQ($opdracht));
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
	private function returnQ($opdracht)
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
		$resultaat = "<a href='http://localhost/jaarboek/Profiel.php?id=" . $arr['leerling_id'] . "'>". $arr['leerling_id']. " " . $arr['voornaam']. " ". $arr['tussenvoegsels']. " ". $arr['achternaam']. " ". $klas."</a><br/><br/>";
		
		return $resultaat;
	}
}
?>
<form method=post acion=""<?php $_SERVER['PHP_SELF'] ?>"">       
		<INPUT type="text" name="opdracht">       
		<input type="submit" value="zoeken" name="submit">
</form>
<?
$zoek = new Zoek();

if(isset($_POST['submit']))
{
	$zoek->haal($_POST['opdracht']);
}
?>