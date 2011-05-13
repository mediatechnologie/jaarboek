<?php
include 'Connect.php';

Class Collage
{
	var $col =array();
	function init()
	{
		$list = '';
		$tot = 403; 
		for($i = 0; $i < $tot; $i++){
			$ran = $this->random_id();
			$url = "images/studenten/". $ran . ".jpg";
			$list .= "<li><a href='profile.php?id=$ran'><img src='$url' height='48' width='48' /></a></li>";
		}
		echo $list;
	}
	function random_id()
	{
		$con = new Connect();
		$con->connect();
		
		$query = mysql_query("SELECT leerling_id FROM leerling WHERE avatar order by rand() limit 1");
		$row = mysql_fetch_array($query);
		
		return $row[0];
	}
}
?>