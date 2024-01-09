<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents </title>
   
</head>

<body>
<style type="text/css">body {padding-top: 140px;}</style>
<?php /*?><div data-role="page" id="page_data"><?php */?>
<script type="text/javascript" src="js/jquery-1.6.3.min.js"></script>
    <script type="text/javascript">
    	var js = jQuery.noConflict();
    </script>
    <script type="text/javascript" src="js/jquery.cycle.all.2.74.js"></script>
    <script type="text/javascript">
	js(document).ready(function() {
		js('#slideshow').cycle({
		fx: 'fade',
		pager: '#smallnav',
		pause:   1,
		speed: 1800,
		timeout:  3500
		});
	});
	</script>
    <?php /*?><div id="slideshow">
      <img src="images/bg1.gif" class="bgM"/>
      <img src="images/bg_men.gif" class="bgM"/>
      <img src="images/bg3.gif" class="bgM"/>
    </div><?php */?>
    
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">

        <!-- Jumbotron Header -->
        <div class="row home-icons">
        	<div class="col-md-3 col-xs-6 text-center"> 
            	<a href="cast.php"> <p> <img src="images/cast1.png" /> </p> <p>CAST</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="teens.php"> <p><img src="images/teens.png" /> </p> <p>TEENS</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="kids.php"><p><img src="images/kids.png" /> </p> <p>KIDS</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="hostess.php"><p><img src="images/hostess.png" /> </p> <p>HOSTESS</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="stylist.php"><p><img src="images/stylist.png" /> </p> <p>STYLIST</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="photographer.php"><p><img src="images/photographer.png" /> </p> <p>PHOTOGRAPHER</p></a>
            </div>
        
        </div>

       <!-- <hr>-->
		
        <!-- Title -->
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
    <?php /*?></div><?php */?>
</body>

</html>
