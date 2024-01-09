<?php
ob_start();
	if(isset($_GET['deviceid'])){
		session_start();
		$_SESSION['deviceid']=$_GET['deviceid'];
		$_SESSION['device']=$_GET['device'];
		require_once("../config/db.php");
		$db_connection=db_connect();
		$checkdevice = $db_connection->query("SELECT device_id FROM app_devices WHERE device_id = '".$_GET['deviceid']."' && device='".$_GET['device']."'");
        if ($checkdevice->num_rows == 0) {
			$db_connection->query("INSERT INTO app_devices (device_id, device) VALUES ('".$_GET['deviceid']."','".$_GET['device']."')");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents </title>
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
    display: table-cell; height:50%; width:50%;
}
.inner_content{ padding:0; padding-bottom:47px;}
.body_content{background-image:url("images/bg-fl.jpg");
    background-repeat: no-repeat;
    background-size:cover;}
.greylay{ background: rgba(255,255,255,0.35);}
.home-icons .col-xs-6 a{ position:absolute; bottom:0; height:40px; width:100%; left:0px;  color:#FFFEFE; font-size:25px; line-height:40px;}
   </style>
</head>

<body>
<?php /*?><div data-role="page" id="page_data"><?php */?>

    <?php /*?><div id="slideshow">
      <img src="images/bg1.gif" class="bgM"/>
      <img src="images/bg_men.gif" class="bgM"/>
      <img src="images/bg3.gif" class="bgM"/>
    </div><?php */?>
    <img src="images/loading.gif" style="display:none" />
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content body_content ">

        <!-- Jumbotron Header -->
        <div class="row home-icons">
        	<div class="col-md-6 col-xs-6 text-center greylay"> 
            	<a href="men.php"> <p>MEN</p></a>
            </div>
            <div class="col-md-6 col-xs-6 text-center pull-right">
            	<a href="women.php">  <p>WOMEN</p></a>
            </div>
            <div class="col-md-6 col-xs-6 text-center">
            	<a href="talents.php"> <p>TALENTS</p></a>
            </div>
            <div class="col-md-6 col-xs-6 text-center greylay pull-right">
            	<a href="works.php"> <p>OUR WORK</p></a>
            </div>
        
        </div>

       <!-- <hr>-->
		
        <!-- Title -->
         
    </div>
    <footer>
    	<?php //include_once("includes/footer.php"); ?>
        
        <script type="text/javascript">
    // Fancybox specific
    // To make images pretty. Not important
	function cart_check(){
		$.ajax({
				url: "../ajax.php",
				type: "post",
				data:  {getdata: "cart_size"},
				success: function(message){
					
					//$("#cart_size").html("("+message+")")
					$(".badge1").attr("data-badge",message);
				},
				error:function(){
					//alert("failure");
				}
			})
	}
    $(document).ready(function(){
       cart_check();
    });
    </script>
	<style type="text/css">
    	<?php /*?>.shopping-cart{ color:#F3F3F3;}<?php */?>
		.shopping-cart{ padding-left:0px; height:25px;}
		.footer{ color:#615f5f; padding:10px;}
		.proceed-text{ margin-left: 45px; position:absolute; display: inline-block; margin-top: 5px; color:whitesmoke; padding:5px; border:1px solid#ddd; border-radius:5px; background:#E3E3E3; font-size:14px; -webkit-background-clip: text;
-webkit-animation-name: shining;
-webkit-animation-duration: 3s;
-webkit-animation-iteration-count: infinite;}
@-webkit-keyframes shining
{
0%
{
background-position: left top;
}
100%
{
background: right bottom;
}
}
.badge1[data-badge]:after { top:-3px; right:-10px; width:17px; height:16px;}
    </style>
<?php
 ob_start();
 session_start();
 $cart_disp=0;
 if(isset($_SESSION['models'])){
	if(sizeof($_SESSION['models']) > 0){
		$cart_disp=1;
	}
	
}
?>  
<div class="footer navbar-fixed-bottom navbar-inverse">
<div class="row">
<div class="col-xs-10">
<div class="row">
	<div class="col-xs-3">
        <a href="index.php">
            <i class="fa fa-home fa-2x" ></i>
        </a>
    </div>
	<div class="col-xs-3"> <a href="tel:+971 4 4548684"> <i class="fa fa-phone fa-2x" ></i> </a></div>
    <div class="col-xs-3"> <a href="contact.php"> <i class="fa fa-map-marker fa-2x" ></i> </a></div>
    <div class="col-xs-3"> <a href="about.php"> <i class="fa fa-info-circle fa-2x" ></i> </a></div>
</div>
</div>
<div class="col-xs-2">
	<div class="cart_content">
    <a href="cart.php?v=1.1">
    	<?php
			   if($cart_disp > 0){
                    $cart_val= sizeof($_SESSION['models']);
			   }
                else
                    $cart_val=0;
        ?>
        <span class="shopping-cart"> <span class="badge1" data-badge="<?php echo $cart_val; ?>"> <?php /*?><img src="images/cart-white.png" /><?php */?>
        <i class="fa fa-shopping-cart fa-2x" ></i> </span> <?php /*?><span class="proceed-text">Proceed to request</span><?php */?>
            	
      </span> 
    </a>
</div>
</div>
</div>
</div>
        
        <!--lllllll-->
        
    </footer>
    <?php /*?></div><?php */?>
</body>

</html>
