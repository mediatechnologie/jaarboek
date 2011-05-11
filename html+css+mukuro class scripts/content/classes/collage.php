<?php
include 'classes/Connect.php';

Class Collage
{
	function init()
	{
		$con = new Connect();
		$con->connect();
		
		$list = 
		"<ul>
			<li>barf</li>
			<li>dur</li>
		</ul>";
		echo $list;
	}
}
$col = new Collage();
$col->init();

?>