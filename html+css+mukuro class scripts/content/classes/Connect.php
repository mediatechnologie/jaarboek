<?php
Class Connect
{
/*	var $user = 'examen'; 
	var $passw = 'sadef5N8'; 
	var $server = 'localhost'; 
	var $database = 'examen_db1';
*/	
	var $user = 'root'; 
	var $passw = ''; 
	var $server = 'localhost'; 
	var $database = 'php_ma-jaarboek';
		
	function connect()
	{
		mysql_connect($this->server,$this->user,$this->passw);
		mysql_select_db($this->database);
	}
}
?>