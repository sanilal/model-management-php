<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLC - Profile , UAE Modeling Agency , Dubai Modeling Agency , Model Management Dubai, UAE Casting Agency , UAE Talent Management , Fashion Show , TV Commercials, Models Coordination Talent Management, Print Ad Production, TV Commercials, Fashion Shows, Line Production, Editorials, Casting sessions, Portfolio Sessions, Screen Tests, Editorials,  Actors, actresses casting, featured extras and extras, Stylists – Make Up, Hair, Wardrobe, Fashion and Food,    Location Management and Permissions in Dubai UAE.
    </title>
    <meta name="author" content="www.flcmodels.com/aboutus.php"/>
    
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
    	<?php
			require_once("classes/Models.php");
			$models = new Models();
			if(isset($_REQUEST['res_id'])){
				$model_res = $models->getModels(NULL,$_REQUEST['res_id'],NULL);
				$row=$model_res->fetch_object();
			}
		?>

        <!-- Jumbotron Header -->
         <header class="hero-spacer">
        	<div>
            	<?php
                 if(isset($_REQUEST['type'])){
               		echo '<a href="'.$_REQUEST['type'].'.php" style="text-decoration:none" ><span class="title-grey" style="text-transform:uppercase">'.$_REQUEST['type'].' &gt;</span></a>';
				 } ?>
                <a style="text-decoration:none" href="javascript:history.back()"><span class="title-grey">Search Result &gt;</span></a>
                <span class="title-red"><?php echo $row->Resource_ID; ?></span>
                
                <?php include_once("includes/cart_resp.php"); ?>
                
            </div>
                        
        </header>
		<style type="text/css">
			@media (min-width: 768px) {
        		.content-main .col-sm-4{ padding-right:5px;}
				.content-main .col-sm-8 { padding-left:5px;}
				.thumb_cont{ height:230px;}
				.content-main .middle_img { padding-left:5px; padding-right:5px}
				.first_img{ padding-right:5px}
				.last_img{ padding-left:5px}
				.prof_name, .prof_id{ width:43.3%;}
				.prof_thumb{width:29.333%}
				.content-main .middle_img { width:27.9%}
				.particulars{ width:97%;}
			}
			@media (max-width: 768px) {
				.name_cont{ margin:10px 0px}
				.absl_div{ width:90%;}
				.thumb_cont{ height:180px;}
			}
			.thumb_cont { margin-bottom:10px; overflow:hidden;}
			.particulars{ font-size:14px;}
			.catalog_link, .add-to-cart{color: #666; font-size:14px;}
			
        </style>
		<script type="text/javascript">
		jQuery(function(){
			jQuery(".col-xs-4 > a").click(function(){
				var new_img=$(".cart_drag").attr('src');
				jQuery(".cart_drag").attr('src',$(this).attr('ref'))
				jQuery(this).attr('ref',new_img);
				jQuery(this).children('.thumb_cont').find(".img-responsive").attr('src',new_img);
				//var img_name=$(".cart_drag").attr('src').slice(-7);
				jQuery(this).children('.thumb_cont').find(".img-responsive").attr('ref',new_img);
				/*if(img_name=="01.jpeg"){
					$(".main_image_cont").removeClass("main_image_stretch");
				}
				else{
					$(".main_image_cont").addClass("main_image_stretch");
				}*/
			})
		})
        </script>
        <script src='http://code.jquery.com/ui/1.10.2/jquery-ui.js' type="text/javascript"></script>
        <script type="text/javascript">
			$(function(){
				$('.add-to-cart').on('click', function () {
					var cart = $('.shopping-cart');
					var imgtodrag = $('.cart_drag');
					//alert(imgtodrag.attr('src'))
					if (imgtodrag) {
						var imgclone = imgtodrag.clone()
							.offset({
							top: imgtodrag.offset().top,
							left: imgtodrag.offset().left
						})
							.css({
							'opacity': '0.5',
								'position': 'absolute',
								'height': '150px',
								'width': '150px',
								'z-index': '100'
						})
							.appendTo($('body'))
							.animate({
							'top': cart.offset().top + 10,
								'left': cart.offset().left + 10,
								'width': 75,
								'height': 24
						}, 1000, 'easeInOutExpo');
						
						setTimeout(function () {
							cart.effect("none", {
								times: 1
							}, 100);
						}, 1000);
			
						imgclone.animate({
							'width': 0,
								'height': 0
						}, function () {
							$(this).detach()
						});
					}
					//
					var obj=$(this).attr('rel')
					$.ajax({
						url: "ajax.php",
						type: "post",
						data:  {insertdata: "models",id:obj },
						success: function(message){
							$("#cart_size").html("("+message+")")
						},
						error:function(){
							alert("failure");
						}
					})
				
					});
			})
		</script>
       <!-- <hr>-->

        <!-- Title -->
        <div class="content-main">   
        	<div class="row">
            	<?php
            	$sub_folder=$models->getImageFolder($row->Resource_ID);
				if(isset($row)){
					$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
					$img_path1=image_path.$sub_folder."/".$row->Resource_ID."_02.jpeg";
					$img_path2=image_path.$sub_folder."/".$row->Resource_ID."_03.jpeg";
					$img_path3 =image_path.$sub_folder."/".$row->Resource_ID."_04.jpeg";
					$img_path4=image_path.$sub_folder."/".$row->Resource_ID."_05.jpeg";
					$img_path5=image_path.$sub_folder."/".$row->Resource_ID."_06.jpeg";
					$img_path6=image_path.$sub_folder."/".$row->Resource_ID."_07.jpeg";
					$img_path7=image_path.$sub_folder."/".$row->Resource_ID."_08.jpeg";
				}
				?>
                 <div class="col-sm-4">
                    <div style="width:100%;"><img src="<?php echo $img_path; ?>" class="img-responsive cart_drag" width="100%"  /></div>
                    <div class="absl_div"> 
                    	<img alt="FLC Models &amp; Talents"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
                    </div>
                 </div>
                 <div class="col-sm-8">
                    <div class="table" style="font-size: 16px;">
                        <div class="row name_cont">
                            <div class="col-xs-6 text-left prof_name"><?php echo $row->First_Name; ?></div> 
                            <div class="col-xs-6 text-right prof_id">ID No. <?php echo $row->Resource_ID; ?></div> 
                        </div>
                        <div class="row">
                            <div class="col-xs-4 first_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path1; ?>">
                                    <div style="width:100%;" class="thumb_cont" >
                                    	<?php if(file_exists($img_path1)) { echo '<img src="'.$img_path1.'" class="img-responsive"  />';} ?>
                                    </div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="25"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                            <div class="col-xs-4 middle_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path2; ?>">
                                    <div style="width:100%;" class="thumb_cont">
                                    	<?php if(file_exists($img_path2)) { echo '<img src="'.$img_path2.'" class="img-responsive"  />';} ?>
                                    </div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="25"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                  </a>
                            </div>
                            <div class="col-xs-4 last_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path3; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path3)) { echo '<img src="'.$img_path3.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="25"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 first_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path4; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path4)) { echo '<img src="'.$img_path4.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="25"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                            <div class="col-xs-4 middle_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path5; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path5)) { echo '<img src="'.$img_path5.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="25"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                            <div class="col-xs-4 last_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path6; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path6)) { echo '<img src="'.$img_path6.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="25"  src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                </a>
                            </div>
                        </div>
                        <div class="row particulars" <?php if($_REQUEST['type']=="stylist" || $_REQUEST['type']=="photographer"){ echo 'style="display:none;"';} ?>>
                            <div class="col-xs-3 text-left">Height: <?php echo $row->Height; ?> </div> 
                            <div class="col-xs-3 text-left"> | Bust:  <?php echo $row->Bust; ?> </div> 
                            <div class="col-xs-3 text-left"> | Waist: <?php echo $row->Waist; ?>  </div> 
                            <div class="col-xs-3 text-left"> | Hips: <?php echo $row->Hips; ?></div> 
                        </div>
                        <div class="row particulars" <?php if($_REQUEST['type']=="stylist" || $_REQUEST['type']=="photographer"){ echo 'style="display:none;"';} ?>>
                            <div class="col-xs-3 text-left">Eyes: <?php echo $row->EyesColor; ?>  </div> 
                            <div class="col-xs-3 text-left"> | Hair: <?php echo $row->HairColor; ?>  </div> 
                            <div class="col-xs-3 text-left"> | Shoes:  <?php echo $row->ShoesSize; ?> </div> 
                            <div class="col-xs-3 text-left"> | Skin: <?php echo $row->SkinColor; ?> </div> 
                        </div>
                    </div>
                 </div>
            </div>
      
            <div class="row" style="margin-top:10px"> 
               <div class="col-md-4">
              	<div class="table">
                  <div class="row">
                      <div class="col-xs-6 text-left"> <a class="catalog_link fancybox.iframe" href="catalogue.php?ref_id=<?php echo $_REQUEST['res_id']; ?>&type=<?php echo $_REQUEST['type']; ?>"> SEE FULL CATALOGUE  </a> </div>
                      <div class="col-xs-6 text-right"> <a rel="<?php echo $row->Resource_ID ?>" class="add-to-cart" href="#cart_size"><img src="images/cart.png">ADD TO SHORTLIST</a> </div>
                  </div>
                </div>
               </div>
               
               <div class="col-md-8">
                  &nbsp;
               </div>
            </div>
        
    	</div>
        
    </div>
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
 <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
	$(function(){
		
		//
		$('.catalog_link').fancybox({width: 970,height:460});
	})
	
</script>
</body>

</html>
