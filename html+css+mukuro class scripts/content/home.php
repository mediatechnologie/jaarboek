<?php include_once 'content/classes/collage.php'; 
$cola = new Collage();

?>
<div id="contentHome">
		<ul>
			<div class="shadowLeft"></div>	
			<div class="shadowRight"></div>
			<?php $cola->init(); ?>
		</ul>	
	</div>
	<!-- <div id="push"></div> -->
</div>

<div id="footerContainer">
	<ul class="footerBlocks">
		<li>1</li>
		<li>2</li>
		<li>3</li>
	</ul>
</div>
</body>
</html>