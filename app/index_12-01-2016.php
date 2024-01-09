<?php
ob_start();
	if(isset($_GET['deviceid'])){
		session_start();
		$_SESSION['deviceid']=$_GET['deviceid'];
		require_once("../config/db.php");
		$db_connection=db_connect();
		$checkdevice = $db_connection->query("SELECT device_id FROM app_devices WHERE device_id = '".$_GET['deviceid']."'");
        if ($checkdevice->num_rows == 0) {
			$db_connection->query("INSERT INTO app_devices (device_id) VALUES ('".$_GET['deviceid']."')");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents </title>
   
</head>

<body>
<style type="text/css">body {padding-top: 120px;}</style>
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
    <img src="images/loading.gif" style="display:none" />
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">

        <!-- Jumbotron Header -->
        <div class="row home-icons">
        	<div class="col-md-3 col-xs-6 text-center"> 
            	<a href="men.php"> <p> <img src="images/men-ico.png" /> </p> <p>MEN</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="women.php"> <p><img src="images/women-ico.png" /> </p> <p>WOMEN</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="talents.php"><p><img src="images/talent-ico.png" /> </p> <p>TALENTS</p></a>
            </div>
            <div class="col-md-3 col-xs-6 text-center">
            	<a href="works.php"><p><img src="images/work-ico.png" /> </p> <p>OUR WORKS</p></a>
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
