		
		<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
       
		<script type="text/javascript" src="js/jquery.pikachoose.js"></script>
		<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();
				});
		</script>

<div class="pikachoose">
	<ul id="pikame" class="jcarousel-skin-pika">
	<?php
		require_once("config/db.php");
		require_once("classes/Article.php");
		$article= new Article();
		$banners=$article->getBanner();
		while($row=$banners->fetch_object()){
	?>
    		<li><img src="uploads/<?php echo $row->banner_image; ?>" alt="FLC MODELS & TALENTS - Model Agency Dubai" title="FLC MODELS"/></li>
    <?php } ?>
	<?php /*?>	<li><img src="image/1.jpg"/><span>Model 1.</span></li>
		<li><img src="image/2.jpg"/></li>
		<li><img src="image/3.jpg"/></li>
		<li><img src="image/4.jpg"/></li>
		<li><img src="image/5.jpg"/></li><?php */?>
	</ul>
</div>