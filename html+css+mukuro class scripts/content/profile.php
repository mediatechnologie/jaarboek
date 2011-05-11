<?
include_once('content/classes/profiel.php');
$db = new Profiel();
if(isset($_GET['id']))
{
	$db->kijk($_GET['id']);
?>
<div id="content">
	<div id="previous"><a href="#">< terug naar het overzicht</a></div>
	<div id="profile">
		<div id="studentInfo">
			<div id="thumb">
				<img src="<? echo $db->avatar;?>">			
			</div>
			<div id="person" style="height:81%">
				<h3><? echo $db->voornaam . "" . $db->tussenvoegsels . "" . $db->achternaam;  ?></h3>
				<p><? echo $db->richting; ?></p>
			</div>
			<div id="social" style="height:16%">
				<a href="#"><img src="images/profile/icon/linkedin.png" /></a>
				<a href="#"><img src="images/profile/icon/facebook.png" /></a>
				<a href="#"><img src="images/profile/icon/flickr.png" /></a>
			</div>
		</div>
		<div id="description">
			<p>Lorem ipsum dolor sit amet, consec tetur adipisci Suspendisse 
			id augue augue. Suspendisse auctor, eros eget odo lacinia, libero 
			ante venenatis mauris, eget pharetra ante ien id leo. Duis sed 
			lorem dolor. Aliquam  sodales massallam.</p>
		</div>
		<div id="stats">
			<ul>	
				<li><b>10123908</b> bytes geupload</li>
				<li>Er zijn <b>3</b> projecten</li>
				<li> Dit project is <b>103</b> keer bekeken</li>
				<li>Totaal <b>12</b> stemmen uitgebracht</li>
			</ul>
		</div>
	</div>
	<div id="bigThumb">
		<div id="bigTitle">
			<h1>Vuur met olieverf schilderij</h1>
		</div>
		<img src="images/profile/bigproject.png" alt="Mijn project" style="border:1px solid black;"/>
	</div>
	<div id="about">
		<div id="desc">	
			<h1>Beschrijving project</h1>
			<p>Phasellus egestas dui eu velit hendrerit eleifend. Proin vitae ante 
			non nunc laoreet tincidunt. Suspendisse a purus at elit sagittis ornare 
			sed id risus. Phasellus euismod tortor vel nulla sollicitudin tempor. 
			Donec a massa nibh. Ut congue sollicitudin libero, in ultrices neque 
			ultricies sed. Mauris vel libero sed augue mollis mattis ac vel arcu. 
			Quisque eu felis odio. Nullam eget congue velit. Nulla at pretium odio. 
			Nunc </p>
		</div>	
		<div id="more">	
		<h1>Meer projecten</h1>
		<a href="#" class="move" style="top:65px; left:-15px; background-position:0px 0px;">&nbsp;</a>
		<ul>	
			<li><a href="#"><img src="images/profile/more/1.jpg" /></a></li>
			<li><a href="#"><img src="images/profile/more/2.jpg" /></a></li>
			<li><a href="#"><img src="images/profile/more/1.jpg" /></a></li>
		</ul>
		<a href="#" class="move" style="top:65px; right:-5px; background-position:-30px 0px;">&nbsp;</a>
		</div>
	</div>
	
</div>

</body>
</html>
<?
}
?>