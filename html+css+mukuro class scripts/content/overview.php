<?php
include_once('content/classes/view_klas.php');
if(isset($_GET['klas']))
{
	//
}
?>
<div id="content">
	<div id="previous"><a href="index.php">< terug naar het overzicht</a></div>
	<div style='float:left;'>
	<?php 
		$klas = new Bekijk_klas();
		echo $klas->haal('MT');
	?>
	</div>
</div>
</body>
</html>