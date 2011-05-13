<!DOCTYPE html>
<html>
<head>
	<title>Jaarboek Profielpagina</title>
	<link rel="shortcut icon" href="images/favicon.ico"/>
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>

	<!--[if !IE 7]>
		<style type="text/css">
			#container {display:table;height:100%}
		</style>
	<![endif]-->

</head>
<body>

<div id="container">
	<div id="topContainer">
		<div id="nav">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="Jaarboek logo"></a>
			</div>
			<ul>
				<li><a href="overview.php?klas=all">ALLES</a></li>
				<li><a href="overview.php?klas=IV">IV</a></li>
				<li><a href="overview.php?klas=GV">GV</a></li>
				<li><a href="overview.php?klas=MT">MT</a></li>
				<li><a href="overview.php?klas=GD">GD</a></li>
				<li><a href="overview.php?klas=MV">MV</a></li>
				<li><a href="overview.php?klas=AV">AV</a></li>
				<li><a href="overview.php?klas=RV">RV</a></li>
			</ul>
			<div id="search">
			<form method="post" action="search.php">
				<table border="0">
					<tr> 
						<td><input type="text" name="searchBar" size="30"/></td>
						<td><input type="image" src="images/search.png" alt="Logo jaarboek"/></td>
					</tr>
				</table>
				
			</form>
			</div>
		</div>
	</div>