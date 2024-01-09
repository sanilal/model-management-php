<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>FLC Models &amp; Talents - Models Women</title>
<meta name="author" content="www.flcmodels.com"/>
<meta name="Description" content="FLC Models & Talents provide you with a range of local & international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more Dubai , UAE .Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels."/>

<meta name="Keywords" content="Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist "/>
<meta name="robots" content="index,follow"/>
<meta name="rating" content="General"/>

   <?php include_once("includes/head_common.php"); ?>
   
</head>

<body>  
    
  <div class="container">
    	 <?php include_once("includes/header.php"); ?>
        
    </div>
    
    <!-- Page Content -->
    <div class="container inner_content">

        <!-- Jumbotron Header -->
         <header class="hero-spacer">
        	<div>
                <a class="text_none" href="#"><span class="title-grey">MODELS &gt;</span></a>
                <span class="title-red">
                	Women
                </span>
                
                <?php include_once("includes/cart_resp.php"); ?>
            </div>
                        
        </header>

       
         <?php
		  require_once("classes/Models.php");
			$models = new Models();
			$etnicity=NULL;
			$ethin_str=NULL;
			$age=NULL;
			$model_res_inter =$models->searchHost('Model','Female',NULL,NULL,"",NULL,"Internationals");
			if($model_res_inter->num_rows>0){
			  ?>
           <div class="row content-main" style="padding-bottom:20px"> 
           		<div class="col-sm-12"> <span class="title-grey"> INTERNATIONAL MODELS </span> </div>
				<div class="container" style="padding: 0px 10px; display:table">
				  <?php
				  while($row=$model_res_inter->fetch_object()){
					  ?>
					 <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $img_code='<img src="'.image_path.$sub_folder.'/'.$row->Resource_ID.'_01.jpeg" class="grayscale img-responsive" alt="FLC Models & Talents - casts" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
								<?php echo $row->First_Name; ?>  
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
           		<div class="col-sm-12"> <span class="title-grey"> MODELS </span> </div>
				<div class="container" style="padding: 0px 10px; display:table">
                <?php
					$model_res=$models->searchHost('Model','Female',NULL,NULL,"",NULL,"NOTIN");
					while($row=$model_res->fetch_object()){
				?>
                	<div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $img_code='<img src="'.image_path.$sub_folder.'/'.$row->Resource_ID.'_01.jpeg" class="grayscale img-responsive" alt="FLC Models & Talents - casts" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div>
               <?php } ?>
                
                </div>
            </div>
    </div>
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
