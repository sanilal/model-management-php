		<link type="text/css" href="css/bottom.css" rel="stylesheet" />
		<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="js/jquery.pikachoose.min.js"></script>
		<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose({showCaption:false,carousel:true});
				});
		</script>
		
		<style type="text/css">
        	.jcarousel-skin-pika{ display:none}
			.pika-imgnav a.previous,.pika-imgnav a.next{ display:none}
        </style>

<!-- not really needed, i'm using it to center the gallery. -->
<div class="pikachoose">
	<ul id="pikame" class="jcarousel-skin-pika">
	<?php
		require_once("config/db.php");
		require_once("classes/Article.php");
		$article= new Article();
		$banners=$article->getBanner();
		while($row=$banners->fetch_object()){
	?>
    		<li><img src="uploads/<?php echo $row->banner_image; ?>" alt="FLC Models & Talents - Banner "/></li>
    <?php } ?>
	<?php /*?>	<li><img src="image/1.jpg"/><span>Model 1.</span></li>
		<li><img src="image/2.jpg"/></li>
		<li><img src="image/3.jpg"/></li>
		<li><img src="image/4.jpg"/></li>
		<li><img src="image/5.jpg"/></li><?php */?>
	</ul>
</div>