<?php
include_once 'content/classes/Connect.php';
//include_once 'Connect.php';

Class Project
{	
	var $projectData = array();
	var $image;
	var $naam;
	var $beschrijving;
	var $tot;
	
	function haal($user_id)
	{
		$con = new Connect();
		$con->connect();
		$query = mysql_query("SELECT * FROM project WHERE leerling_id = '$user_id'");
		$rows=mysql_num_rows($query);
		if($rows != 0){		
			while ($row = mysql_fetch_array($query)) {
				
				if(isset($this->projectData["naam"]))
				{
					$this->projectData['naam'][] .= $row['naam'];
				}
				else{
					$this->projectData['naam'][] = $row['naam'];
				}
				if(isset($this->projectData["image"]))
				{
					$this->projectData['image'][] .= $row['image'];
				}
				else{
					$this->projectData['image'][] = $row['image'];
				}
				if(isset($this->projectData["beschrijving"]))
				{
					$this->projectData['beschrijving'][] .= $row['beschrijving'];
				}
				else{
					$this->projectData['beschrijving'][] = $row['beschrijving'];
				}
			}
		}
		
	}
	function kijk($c_id,$num)
	{
		if($this->haal($c_id))
		{
			$this->naam = $this->projectData['naam'][$num];
			$this->beschrijving = $this->projectData['beschrijving'][$num];
			$this->image = $this->projectData['image'];
			$this->tot = $this->totaal($c_id);
		}
		else
		{
			$this->naam = '';
			$this->beschrijving = '';
			$this->image = '';
			$this->tot = '0';
		}
	}
	function totaal($user_id)
	{
		$query = mysql_query("SELECT count(*) FROM project WHERE leerling_id = '$user_id'");
		$row = mysql_fetch_array($query);
		
		return $row[0];
	}
	function meer($user_id,$num)
	{
		$tot = $this->totaal($user_id);
		for($i = 0; $i < $tot; $i++){
			if($this->projectData['image'][$i] == $this->projectData['image'][$num]){}else
			{
				
				return '<li><a href="?id='.$user_id.'&p='.$i.'"><img src="'. $this->projectData['image'][$i] .'" width="75" height="75" /></a></li>';
			}
		}
		
	}
}
?>