<!DOCTYPE html>
<html lang="en">
  <head>
 <title>FLC Production & Model Management PORTFOLIO - Dubai Models , Model Agency Dubai  , FLC Models & Talents</title>
	<?php include_once('md_includes/head.php'); ?>
     
 
<link rel="stylesheet" type="text/css" href="<?php echo MN_url; ?>css/jquery.fancybox.css?v=2.1.4" media="screen" />
<style type="text/css">
	.work_item{ margin-bottom:15px; position:relative}
	.work_item img{ min-height:150px; width:94%}
	.work_item .absl_div{ width:94%; background-color: rgba(0, 0, 0, .5); opacity:0; position: absolute;
bottom: 0px;
height: 100%;}
	.work_item .absl_name{ width:100%; font-size:16px; height:40px; background:none; top:45%; font-weight:bold; text-align:center; color:#fff; position:absolute;}
</style>
</head>
  </head>

  <body>
    
    <?php include_once('md_includes/header.php'); ?>
        
         <?php 
					require_once(MN_url."classes/Media.php");
					$media= new Media();
					//echo mysqli_real_escape_string($db_connection,$_REQUEST['cat-id']);
					$cat_res=$media->getCategory($_REQUEST['cat-id']);
					$cat_row=$cat_res->fetch_object();
					 ?>
   <section class="modelsWraper">
    	<div class="container">
    	<div class="row">
            
            <div class="col-12">
                <h2><?php echo $cat_row->category_name; ?></h2>
               <p>&nbsp;</p>
            </div>
             <?php
			 	if(isset($_REQUEST['cat-name'])){
					$media_res=$media->getMedia(NULL,NULL,$_REQUEST['cat-name']);
				}
				else{
			  		$media_res=$media->getMedia(NULL,$_REQUEST['cat-id'],NULL);
				}
				$i=0;
				
				$n_rows=$media_res->num_rows;
				$col_count=floor($n_rows/4);
				//echo $col_count;
				$k=1;
				?>
                	<div class="col-3" >
                <?php
				while($row=$media_res->fetch_object()){ ?>
                	<div class="work_item">
                	<?php if($row->work_type=="Video"){ ?>
                    	<a class="fancybox_v fancybox.iframe" href="<?php echo MN_url; ?>ajax.php?media_id=<?php echo $row->work_id; ?>"  title="<?php echo stripslashes($row->work_title); ?>">
                        <?php
							$step1=explode('v=', $row->work_link);
							$step2 =explode('&amp;',$step1[1]);
							$vedio_id = $step2[0];
						?>
                  			<img src='http://img.youtube.com/vi/<?php echo $vedio_id; ?>/0.jpg' class="img-responsive" alt="FLC Models & Talents -<?php echo $cat_row->category_name." - ".stripslashes($row->work_title); ?> " />
                            <div class="absl_div"> 
                                <div class="absl_name">
                                <span class="moname">
                                    <?php echo stripslashes($row->work_title);?>  
                                    </span>
                                </div>
                            </div>
                        </a> 
                    <?php } else{ ?>
                    	<?php if($row->work_image2!="" || $row->work_image3!="" || $row->work_image4!=""){ 
                        	echo '<a class="fancybox_m fancybox.iframe" href="'.MN_url.'media_ldata.php?id='.$row->work_id.'"  >';
                       } else{ ?>
                  		<a class="fancybox" href="<?php echo MN_url; ?>uploads/<?php echo $row->work_image; ?>"  title="<?php echo stripslashes($row->work_title); ?>">
                        <?php } ?>
                  			<img src='<?php echo MN_url; ?>uploads/<?php echo $row->work_image; ?>' alt="FLC Models & Talents - <?php echo $cat_row->category_name." - ".stripslashes($row->work_title); ?>" class="img-responsive" />
                            <div class="absl_div"> 
                                <div class="absl_name">
                                <span class="moname">
                                    <?php echo stripslashes($row->work_title);?>  
                                    </span>
                                </div>
                            </div>
                        </a> 
                     <?php } ?>
                     
                	</div>   
				<?php
				$i++;
				if($k<4){
				  if($i >= $col_count){
					  //echo $i;
					  $i=0; $k++;
				  ?>
				  </div>
				  <div class="col-3" >
				  <?php	
				  }
				}
			}
			  ?>
              
           </div>
       </div>
       </div>
   </section>

  
  <?php include_once('md_includes/footer.php'); ?>
  <script type="text/javascript" src="<?php echo MN_url; ?>js/jquery.fancybox.js?v=2.1.4"></script>
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
			//
			$(".work_item a").hover(
				function(){$(this).find(".absl_div").fadeTo( "fast", 1 );},
				function(){$(this).find(".absl_div").fadeTo( "fast", 0 );}
			);
	})
	
</script>
  </body>
</html>