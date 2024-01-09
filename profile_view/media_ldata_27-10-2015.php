<?php
require_once("config/db.php");
?>
<style type="text/css">
html,body{ height:510px}
.model_thumbs{ float:left; margin-right:12px; width:auto; max-height:425px; overflow:hidden; margin-bottom:12px}
.model_thumbs  img{ height:400px;}


.gallery { position: relative; left: 0; top: 0; height:420px; overflow:hidden }
.gallery__controls { margin-top: 10px; }
.gallery__controls-prev { cursor: pointer; float: left; }
.gallery__controls-next { cursor: pointer; float: right; }

</style>
<link href="css/flc1.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src='http://code.jquery.com/ui/1.10.2/jquery-ui.js' type="text/javascript"></script>
<!--<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.4" media="screen" />-->
<script type="text/javascript">
    // Only run everything once the page has completely loaded
    $(window).load(function(){

        // Set general variables
        // ====================================================================
        var totalWidth = 0;
		

        // Total width is calculated by looping through each gallery item and
        // adding up each width and storing that in `totalWidth`
        $(".gallery__item").each(function(){
            totalWidth = totalWidth + $(this).outerWidth(true)+5;
        });

        // The maxScrollPosition is the furthest point the items should
        // ever scroll to. We always want the viewport to be full of images.
        var maxScrollPosition = totalWidth - $(".gallery-wrap").outerWidth();
		if(maxScrollPosition < 300){
			maxScrollPosition=310;
		}
        // This is the core function that animates to the target item
        // ====================================================================
        function toGalleryItem($targetItem){
            // Make sure the target item exists, otherwise do nothing
			
			if($targetItem.length==0){
				
				$targetItem=$(".gallery__item:last");
				// Add active class to the target item
				$targetItem.addClass("gallery__item--active");

				// Remove the Active class from all other items
				$targetItem.siblings().removeClass("gallery__item--active");
			}
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
            }
			
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

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <?php
				require_once("classes/Media.php");
				$media = new Media();
				if(isset($_REQUEST['id'])){
					$media_res = $media->getMedia($_REQUEST['id'],NULL);
					$row=$media_res->fetch_object();
				}
			?>
         
          <tr>
            <td>
            <?php
				if(isset($row)){
	
				?>
               
                <div style="text-align:left; color:#666; padding-left:10px; font-size:16px; width:955px; overflow:hidden" class="gallery-wrap" >
                	<div style="margin-bottom:15px">
                    	<?php echo stripslashes($row->work_title); ?>  
                      
                    </div> 
                    
                    <div class="gallery clearfix">
                    <?php
						
							$img_path="uploads/".$row->work_image;
							if($row->work_image!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path; ?>" /> 
                               
                            </div>
                        
                    <?php } 
					$img_path2="uploads/".$row->work_image2;
							if($row->work_image2!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path2; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path3="uploads/".$row->work_image3;
							if($row->work_image3!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path3; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path4="uploads/".$row->work_image4;
							if($row->work_image4!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path4; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path5="uploads/".$row->work_image5;
							if($row->work_image5!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path5; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path6="uploads/".$row->work_image6;
							if($row->work_image6!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path6; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path7="uploads/".$row->work_image7;
							if($row->work_image7!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path7; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path8="uploads/".$row->work_image8;
							if($row->work_image8!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path8; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path9="uploads/".$row->work_image9;
							if($row->work_image9!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path9; ?>" /> 
                               
                            </div>
                        
                    <?php } 
						$img_path10="uploads/".$row->work_image10;
							if($row->work_image10!="") {
					?>
                            <div class="model_thumbs gallery__item"> 
                            	
                              		
                                    <img src="<?php echo $img_path10; ?>" /> 
                               
                            </div>
                        
                    <?php } 

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
            
          
            
            </td>
          </tr>
        </table>
</body>

