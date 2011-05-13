<?php
include_once 'classes/Zoek.php';
$s = new Zoek();
?>
<div id="content">
	<div id="previous"><a href="index.php">< terug naar het overzicht</a></div>
	<div style='float:left;'>
	<h3>Leerling(en)</h3>
	<?php
	if(isset($_POST['searchBar']))
	{	
		$s->haal_leerling($_POST['searchBar']);
		
	}
	?>
	</div>
	<div style ='float:right;'>
	<h3>Project(en)</h3>
	<?php
	if(isset($_POST['searchBar']))
	{	
		$s->haal_project($_POST['searchBar']);
		
	}
	?>
	</div>
</div>
</body>
</html>