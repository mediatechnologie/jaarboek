<?php
include_once('content/classes/profiel.php');
include_once('content/classes/project.php');
$db = new Profiel();
$pb = new Project();

$project_num;
if(isset($_GET['p'])){
$project_num = $_GET['p'];
}else{
$project_num = 0;
}
if(isset($_GET['id']))
{
	$db->kijk($_GET['id']);
	$pb->kijk($_GET['id'],$project_num);
?>
<div id="content">
	<div id="previous"><a href="index.php">< terug naar het overzicht</a></div>
	<div id="profile">
		<div id="studentInfo">
			<div id="thumb">
				<img src="<?php echo $db->avatar; ?>">			
			</div>
			<div id="person" style="height:81%">
				<h3><?php echo $db->voornaam . " " . $db->tussenvoegsels . " " . $db->achternaam;  ?></h3>
				<p><?php echo $db->richting; ?></p>
			</div>
			<div id="social" style="height:16%">
				<!--<a href="#"><img src="images/profile/icon/linkedin.png" /></a>-->
				<!--<a href="#"><img src="images/profile/icon/facebook.png" /></a>-->
				<!--<a href="#"><img src="images/profile/icon/flickr.png" /></a>-->
			</div>
		</div>
		<div id="description">
			<p><?php echo $db->beschrijving; ?></p>
		</div>
		<div id="stats">
			<ul>
				<!--<li><b>10123908</b> bytes geupload</li>-->
				<li>Er <?php if($pb->totaal($_GET['id']) == 1){ echo 'is <b>'; } else { echo 'zijn <b>'; } echo $pb->totaal($_GET['id']) . '</b>';  if($pb->totaal($_GET['id']) == 1){ echo ' project <b>'; } else { echo ' projecten <b>'; } ?></li>
				<!--<li> Dit project is <b>103</b> keer bekeken</li>-->
				<!--<li>Totaal <b>12</b> stemmen uitgebracht</li>-->
			</ul>
		</div>
	</div>
	<div id="bigThumb">
		<div id="bigTitle">
			<h1><?php if(isset($pb->projectData['naam'][$project_num])){ echo $pb->projectData['naam'][$project_num]; } ?></h1>
		</div>
		<?php if(isset($pb->projectData['image'][$project_num])){ ?><img src="<?php echo $pb->projectData['image'][$project_num]; ?>" width='375' height='375' alt="Mijn project" style="border:1px solid black;"/><?php } ?>
	</div>
	<div id="about">
		<div id="desc">
			<h1><?php if(isset($pb->projectData['beschrijving'][$project_num])){ echo 'Beschrijving project'; } ?></h1>
			<p><?php if(isset($pb->projectData['beschrijving'][$project_num])){ echo $pb->projectData['beschrijving'][$project_num]; } ?></p>
		</div>	
		<div id="more">	
		<h1><?php if(isset($pb->projectData['beschrijving'][$project_num])){ echo 'Meer projecten'; } ?></h1>
		<!--<a href="#" class="move" style="top:65px; left:-15px; background-position:0px 0px;">&nbsp;</a>-->
		<ul>
			<?php echo $pb->meer($_GET['id'],$project_num); ?>
		</ul>
		<!--<a href="#" class="move" style="top:65px; right:-5px; background-position:-30px 0px;">&nbsp;</a>-->
		</div>
	</div>
	
</div>

</body>
</html>
<?php
}
?>