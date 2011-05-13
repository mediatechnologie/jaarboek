<?php
include_once 'content/classes/Connect.php';
include_once 'content/classes/Defineer_klas.php';
Class Bekijk_klas
{	
	function haal($klas)
	{
		
		$con = new Connect();
		$con->connect();
		
		$k = new Defineer_klas();
		$klas = $k->reverse($klas);
		
		$query = mysql_query("SELECT * FROM leerling WHERE richting = '$klas'");
		$rows= mysql_num_rows($query);
		
		$klas_tabel = "<table>";
		
		if($rows != 0){		
			while ($row = mysql_fetch_array($query)) {
				$klas_tabel .= "<tr><td><img src='images/studenten/" . $row['avatar'] . "' width='87' height='87'><td>"
				."<td><a href='profile.php?id=". $row['leerling_id'] ."'>". $row['voornaam'] . " " . $row['tussenvoegsels'] . " " . $row['achternaam'] ."</a></td>"
				."</tr>"; 
			}
			
		}
		$klas_tabel .= "</table>";
		return $klas_tabel;
	}
}
?>