<?php
require_once("config/db.php");
?>
<style type="text/css">
html,body{ height:460px}
.model_thumbs{ float:left; margin-right:12px; width:300px; height:375px; overflow:hidden; margin-bottom:12px}
.model_thumbs  img{ width:300px;}
.add-to-cart{color:#666666; text-decoration:none}
.cart_drag{ }
.main_image_cont{float:left; margin-right:5px; padding-top:5px; height:511px; overflow:hidden; width:340px}
.main_image_cont > img{ max-height:530px; max-width:349px; min-height:511px; min-width:340px}
.water_mark{ width:340px; height:511px; font-size:40px;}
.thumb{ width:300px !important; height:375px !important; font-size:16px !important;}

.gallery { position: relative; left: 0; top: 0; height:380px; overflow:hidden }
.gallery__controls { margin-top: 10px; }
.gallery__controls-prev { cursor: pointer; float: left; }
.gallery__controls-next { cursor: pointer; float: right; }
.water_mark{ position:absolute; color:#E7040D;  filter:alpha(opacity=70); opacity:0.7; z-index:1}
.water_mark > b, .water_mark > img{ position:absolute; bottom:5px; border:none; left:35%}
</style>
<link href="css/flc1.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src='http://code.jquery.com/ui/1.10.2/jquery-ui.js' type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
    // Only run everything once the page has completely loaded
    $(window).load(function(){

        // Set general variables
        // ====================================================================
        var totalWidth = 0;

        // Total width is calculated by looping through each gallery item and
        // adding up each width and storing that in `totalWidth`
        $(".gallery__item").each(function(){
            totalWidth = totalWidth + $(this).outerWidth(true);
        });

        // The maxScrollPosition is the furthest point the items should
        // ever scroll to. We always want the viewport to be full of images.
        var maxScrollPosition = totalWidth - $(".gallery-wrap").outerWidth();

        // This is the core function that animates to the target item
        // ====================================================================
        function toGalleryItem($targetItem){
            // Make sure the target item exists, otherwise do nothing
            if($targetItem.length){

                // The new position is just to the left of the targetItem
                var newPosition = $targetItem.position().left;

                // If the new position isn't greater than the maximum width
                if(newPosition <= maxScrollPosition){

                    // Add active class to the target item
                    $targetItem.addClass("gallery__item--active");

                    // Remove the Active class from all other items
                    $targetItem.siblings().removeClass("gallery__item--active");

                    // Animate .gallery element to the correct left position.
                    $(".gallery").animate({
                        left : - newPosition
                    });
                } else {
                    // Animate .gallery element to the correct left position.
                    $(".gallery").animate({
                        left : - maxScrollPosition
                    });
                };
            };
        };

        // Basic HTML manipulation
        // ====================================================================
        // Set the gallery width to the totalWidth. This allows all items to
        // be on one line.
        $(".gallery").width(totalWidth);

        // Add active class to the first gallery item
        $(".gallery__item:first").addClass("gallery__item--active");

        // When the prev button is clicked
        // ====================================================================
        $(".gallery__controls-prev").click(function(){
            // Set target item to the item before the active item
            var $targetItem = $(".gallery__item--active").prev();
            toGalleryItem($targetItem);
        });

        // When the next button is clicked
        // ====================================================================
        $(".gallery__controls-next").click(function(){
            // Set target item to the item after the active item
            var $targetItem = $(".gallery__item--active").next();
            toGalleryItem($targetItem);
        });
    });
</script>
<script type="text/javascript">
    // Fancybox specific
    // To make images pretty. Not important
    $(document).ready(function(){
        $(".gallery__link").fancybox({
            'titleShow'     : false,
            'transitionIn'  : 'elastic',
            'transitionOut' : 'elastic'
        });
    });
    </script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <?php
				require_once("classes/Models.php");
				$models = new Models();
				if(isset($_REQUEST['ref_id'])){
					$model_res = $models->getModels(NULL,$_REQUEST['ref_id'],NULL);
					$row=$model_res->fetch_object();
				}
			?>
         
          <tr>
            <td>
            <?php
				$sub_folder=$models->getImageFolder($row->Resource_ID);
				if(isset($row)){
					
					
				
				
				?>
               
                <div style="text-align:left; color:#666; padding-left:10px; font-size:16px; width:955px; overflow:hidden" class="gallery-wrap" >
                	<div style="margin-bottom:15px">
                    	<?php echo $row->First_Name; ?>  <div style="float:right"> ID No. <?php echo $row->Resource_ID; ?></div>
                         <?php /*?>&nbsp; * <?php echo  $row->Resource_Type; ?> *<?php */?>
                    </div> 
                    
                    <div class="gallery clearfix">
                    <?php
						//$number_arr=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15');
					define('IMAGEPATH', image_path.$sub_folder."/");
					$all_imgs=glob(IMAGEPATH.$row->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					foreach($all_imgs as $filename){
							//$img_path=image_path.$sub_folder."/".$row->Resource_ID."_".$numb.".jpeg";
							$img_path=$filename;
							if(file_exists($img_path)) {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	<?php /*?><a href="<?php echo $img_path; ?>"  class="gallery__link" data-fancybox-group="catalogue"><?php */?>
                              		<div class="water_mark thumb">
                                    	<img src="images/flc_mark.png"  style="width:20%"  />
                                	</div>
                                    <img src="<?php echo $img_path; ?>" /> 
                                <?php /*?></a><?php */?>
                            </div>
                        
                    <?php } 
					
						}
					?>    
                        
              		</div>
                    <div class="gallery__controls clearfix">
                        <div href="#" class="gallery__controls-prev">
                            <img src="image/prev.png" alt="" />
                        </div>
                        <div href="#" class="gallery__controls-next">
                            <img src="image/next.png" alt="" />
                        </div>
                    </div>
                 </div>
                
			<?php }
			?>
            
           <?php /*?> <img src="image/models-profile.jpg" width="913" height="377" /><?php */?>
            
            </td>
          </tr>
        </table>
</body>

