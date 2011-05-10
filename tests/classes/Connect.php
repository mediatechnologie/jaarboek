<?php
Class Connect
{
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