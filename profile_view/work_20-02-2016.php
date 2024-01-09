<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>FLC Production & Model Management PORTFOLIO - Dubai Models , Model Agency Dubai  , FLC Models & Talents</title>

<meta name="Description" content=" Models Portfolio - Model Agency Dubai,FLC Models, FLC Talents, International Models,Casting & Production Agency, Dubai,Cast & crew, Model Management"/>

<meta name="Keywords" content="Dubai models Portfolio,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Kids models UAE ,Middle east models, promoters in Dubai, promoters UAE, Product Shoot, Casting Agency, hostesses in Dubai, Promotions in Dubai,Print Campaigns, Make-up artist,portfolio for models in Dubai, photographers in Dubai, photo shoot  in Dubai, make up artist in Dubai, stylist in  Dubai, Cast & Crew in Dubai,Events & Exhibitions"/>

<META NAME="author" CONTENT="FLC MODELS">

<meta name="robots" content="index,follow"/>
<meta name="rating" content="General"/>

    <?php include_once("includes/head_common.php"); ?>

<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.4" media="screen" />
<style type="text/css">
	.work_item{ margin-bottom:15px;}
	.work_item img{ min-height:150px; width:90%}
	.work_item .absl_div{ width:90%}
	.work_item .absl_name{ width:100%; font-size:14px; height:40px}
</style>
</head>

<body>  
    
  <div class="container">
   		 <?php include_once("includes/header.php"); ?>
        
    </div>
    
    <!-- Page Content -->
    <div class="container inner_content">
    	<div class="punch_cont">
        	<div class="text-left">
                <a class="text_none" href="#"><span class="title-grey">Our Works &gt;</span></a>
                <?php 
					require_once("classes/Media.php");
					$media= new Media();
					$cat_res=$media->getCategory($_REQUEST['cat-id']);
					$cat_row=$cat_res->fetch_object();
					 ?>
                <span><?php echo $cat_row->category_name; ?></span>
            </div>
        </div>

        <!-- Jumbotron Header -->
         <?php /*?><header class="hero-spacer" style="margin:15px 0px">
        	<div>
                <a class="text_none" href="#"><span class="title-grey">Our Works &gt;</span></a>
               
                <span class="title-red">
					 <?php 
					require_once("classes/Media.php");
					$media= new Media();
					$cat_res=$media->getCategory($_REQUEST['cat-id']);
					$cat_row=$cat_res->fetch_object();
					echo $cat_row->category_name; ?>
                </span>
            </div>
        </header><?php */?>

       <!-- <hr>-->

        <!-- Title -->
        <div class="row content-main">
           
           	 <?php
			 	if(isset($_REQUEST['cat-name'])){
					$media_res=$media->getMedia(NULL,NULL,$_REQUEST['cat-name']);
				}
				else{
			  		$media_res=$media->getMedia(NULL,$_REQUEST['cat-id'],NULL);
				}
				$i=1;
				while($row=$media_res->fetch_object()){ ?>
				<div class="col-sm-3 col-xs-6 work_item" style="overflow:hidden; height:150px" >
                	
                	<?php if($row->work_type=="Video"){ ?>
                    	<a class="fancybox_v fancybox.iframe" href="ajax.php?media_id=<?php echo $row->work_id; ?>"  title="<?php echo stripslashes($row->work_title); ?>">
                        <?php
							$step1=explode('v=', $row->work_link);
							$step2 =explode('&amp;',$step1[1]);
							$vedio_id = $step2[0];
						?>
                  			<img src='http://img.youtube.com/vi/<?php echo $vedio_id; ?>/0.jpg' class="img-responsive" alt="FLC Models & Talents -<?php echo $cat_row->category_name." - ".stripslashes($row->work_title); ?> " />
                            <div class="absl_div"> 
                                <div class="absl_name">
                                    <?php echo stripslashes($row->work_title);?>  
                                </div>
                            </div>
                        </a> 
                    <?php } else{ ?>
                    	<?php if($row->work_image2!="" || $row->work_image3!="" || $row->work_image4!=""){ 
                        	echo '<a class="fancybox_m fancybox.iframe" href="media_ldata.php?id='.$row->work_id.'"  >';
                       } else{ ?>
                  		<a class="fancybox" href="uploads/<?php echo $row->work_image; ?>"  title="<?php echo stripslashes($row->work_title); ?>">
                        <?php } ?>
                  			<img src='uploads/<?php echo $row->work_image; ?>' alt="FLC Models & Talents - <?php echo $cat_row->category_name." - ".stripslashes($row->work_title); ?>" class="img-responsive" />
                            <div class="absl_div"> 
                                <div class="absl_name">
                                    <?php echo stripslashes($row->work_title);?>  
                                </div>
                            </div>
                        </a> 
                     <?php } ?>
                   </div>
					
				<?php
				}
			  
			  ?>
            
        </div>
        
        
    </div>
    
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
    <script type="text/javascript">
	$(function(){
		$('.fancybox_v').fancybox({
				width: 500,
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
		//
		$('.fancybox').fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
			$('.fancybox_m').fancybox({width: 970});
	})
	
</script>
</body>

</html>
