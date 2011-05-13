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
		if($richting == 4)
		{
			$klas = 'MV';
		}
		if($richting == 5)
		{
			$klas = 'AV';
		}
		if($richting == 6)
		{
			$klas = 'RV';
		}
		return $klas;		
	}
	function reverse($richting)
	{
		$klas;
		if($richting == 'MT')
		{
			$klas = 0;
		}
		if($richting == 'GV')
		{
			$klas = 1;
		}
		if($richting == 'IV')
		{
			$klas = 2;
		}
		if($richting == 'GD')
		{
			$klas = 3;
		}
		if($richting == 'MV')
		{
			$klas = 4;
		}
		if($richting == 'AV')
		{
			$klas = 5;
		}
		if($richting == 'RV')
		{
			$klas = 6;
		}
		return $klas;		
	}
}
?>