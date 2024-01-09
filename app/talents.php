<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents </title>
   
</head>

<body>
<style type="text/css">
html,body,.container
{
    height:100%;
}
body{ padding-top:76px;}
.container
{
    display:table;
    width: 100%;
    /*margin-top: -50px;
    padding: 50px 0 0 0; */
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.row.home-icons
{
    height: 100%;
    display: table-row;
}

.home-icons .col-xs-6
{
    display: table-cell; height:33.33%; width:49.4%; padding:0; background: rgba(162,162,162,0.50); margin-bottom:4px;
}
.inner_content{ padding: 50px 20px 159px 20px;}
.inner_content{background-image:url("images/bgbl.jpg");
    background-repeat: no-repeat;
    background-size:cover;}
.greylay{ background: rgba(120,120,120,0.50) !important;}
.home-icons .col-xs-6 a{  bottom:0; width:100%; color:#FFFEFE; font-size:14px; overflow:hidden;  display:block; height:100%; line-height:150px; }
.home-icons .col-xs-6 a p{ display:inline-block; line-height:normal; vertical-align:middle}

</style>
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
        	<div class="col-xs-6 text-center greylay"> 
            	<a href="cast.php">  <p>CAST</p> </a>
            </div>
            <div class="col-xs-6 text-center pull-right">
            	<a href="teens.php"> <p>TEENS</p> </a>
            </div>
            <div class="col-xs-6 text-center ">
            	<a href="kids.php"> <p>KIDS</p>  </a>
            </div>
            <div class="col-xs-6 text-center greylay pull-right">
            	<a href="hostess.php"> <p>HOSTESS</p></a>
            </div>
            <div class="col-xs-6 text-center greylay">
            	<a href="stylist.php"><p>STYLIST</p></a>
            </div>
            <div class="col-xs-6 text-center pull-right">
            	<a href="photographer.php"> <p>PHOTOGRAPHER</p></a>
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
