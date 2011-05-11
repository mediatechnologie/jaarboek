<?php
Class Defineer_klas
{
	function defineer($richting)
	{
		$klas;
		if($richting == 0)
		{
			$klas = 'MT';
		}
		if($richting == 1)
		{
			$klas = 'GV';
		}
		if($richting == 2)
		{
			$klas = 'IV';
		}
		if($richting == 3)
		{
			$klas = 'GD';
		}
		return $klas;		
	}
}
?>