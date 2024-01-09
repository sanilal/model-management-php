<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents - Women </title>
   
</head>

<body>
    
    <?php /*?><div id="slideshow">
      <img src="images/bg1.gif" class="bgM"/>
    </div><?php */?>
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">
		<header class="hero-spacer">
        	<div class="main_title">
                <?php /*?><a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                <span class="title-red">
                	Women
                </span><?php */?>
                WOMEN
            </div>
                        
        </header>
        <?php
		  require_once("../classes/Models.php");
			$models = new Models();
			$etnicity=NULL;
			$ethin_str=NULL;
			$age=NULL;
			$model_res_inter =$models->searchHost('Model','Female',NULL,NULL,"",NULL,"Internationals");
			if($model_res_inter->num_rows>0){
			  ?>
           <div class="row content-main" style="padding-bottom:20px"> 
           		<div class="col-sm-12"> <div class="title-grey"> INTERNATIONAL MODELS </div> </div>
				<div class="container" style="padding: 0px 10px;">
				  <?php
				  while($row=$model_res_inter->fetch_object()){
					  ?>
					 <div class="col-xs-4">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=women" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						 // $img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - Women" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
<?php /*?>                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
<?php */?>								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div> 
										  
					  <?php
				  }
				  
				  ?>
				  </div>
            </div>   
		  <?php
              }
           ?>
       		<div class="row content-main"> 
           		<div class="col-sm-12"> <div class="title-grey"> MODELS </div> </div>
				<div class="container" style="padding: 0px 10px;">
                <?php
					$model_res=$models->searchHost('Model','Female',NULL,NULL,"",NULL,"NOTIN");
					while($row=$model_res->fetch_object()){
				?>
                	<div class="col-xs-4">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=women" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - Women" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
<?php /*?>                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
<?php */?>								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div>
               <?php } ?>
                
                </div>
            </div>
         
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
<div class="col-xs-3">
        <a href="men.php">
            <?php /*?><i class="fa fa-home " ></i><?php */?> MEN
        </a>
    </div>
<div class="col-xs-7">
<div class="row">
	<div class="col-xs-6"> <a href="talents.php"> <?php /*?><i class="fa fa-adjust" ></i><?php */?> TALENTS</a></div>
    <div class="col-xs-6"> <a href="works.php"> <?php /*?><i class="fa fa-adjust" ></i><?php */?> WORKS</a></div>
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

        
    </footer>
</body>

</html>
