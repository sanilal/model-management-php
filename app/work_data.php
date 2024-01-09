<?php
require_once("../config/db.php");
?>

<head>

<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- jssor slider scripts-->
    <!-- use jssor.slider.debug.js for debug -->
<script type="text/javascript" src="js/jssor.slider.mini.js"></script>
<style type="text/css">
	.thumb{ width:100%; height:400px !important; font-size:16px !important;}
	.water_mark{ position:absolute; color:#E7040D;  filter:alpha(opacity=70); opacity:0.7; z-index:10}
	.water_mark > b, .water_mark > img{ position:absolute; bottom:3px; border:none; left:4px}
	.water_mark > img{ filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+ */
	  filter: gray; /* IE6-9 */
	  -webkit-filter: grayscale(100%); /* Chrome 19+ & Safari 6+ */
	  -webkit-transition: all .6s ease; /* Fade to color for Chrome and Safari */
	  -webkit-backface-visibility: hidden; /* Fix for transition flickering */}
</style>
</head>
         
          <?php
				require_once("../classes/Media.php");
				$media = new Media();
				if(isset($_REQUEST['id'])){
					$media_res = $media->getMedia($_REQUEST['id'],NULL);
					$row=$media_res->fetch_object();
				}
			?>
         
          
           
               <body>
               <?php
				if(isset($row)){
	
				?>
              
                <div id="slider1_container" style="display: none; position: relative; margin: 0 auto; top: 0px; left: 0px; width: 300px; height: 400px; overflow: hidden;">
                	<div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
                        top: 0px; left: 0px; width: 100%; height: 100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;
                        top: 0px; left: 0px; width: 100%; height: 100%;">
                        </div>
                    </div>
                	 
                    
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 300px; height: 400px; overflow: hidden;">
                    
                    <?php
						
							$img_path="../uploads/".$row->work_image;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image!="") {
					?>
                            <div>
                            	<?php /*?><a href="<?php echo $img_path; ?>"  class="gallery__link" data-fancybox-group="catalogue"><?php */?>
                              		
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                                <?php /*?></a><?php */?>
                            </div>
                        
                    <?php } ?>   
                    <?php
						
							$img_path="../uploads/".$row->work_image2;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image2!="") {
					?>
                            <div>
                              		
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>    
                    <?php
						
							$img_path="../uploads/".$row->work_image3;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image3!="") {
					?>
                            <div>
                              		
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>  
                    <?php
						
							$img_path="../uploads/".$row->work_image4;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image4!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>   
                    <?php
						
							$img_path="../uploads/".$row->work_image5;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image5!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>  
                    <?php
						
							$img_path="../uploads/".$row->work_image6;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image6!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>   
                    <?php
						
							$img_path="../uploads/".$row->work_image7;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image7!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>  
                    <?php
						
							$img_path="../uploads/".$row->work_image8;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image8!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>  
                    <?php
						
							$img_path="../uploads/".$row->work_image9;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image9!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>  
                    <?php
						
							$img_path="../uploads/".$row->work_image10;
							$opt_img_path="image.php?img=".urlencode($img_path);
							if($row->work_image10!="") {
					?>
                            <div>
                            	
                                    <img src="<?php echo $opt_img_path; ?>" u="image" /> 
                            </div>
                        
                    <?php } ?>          
                        
              		</div>
                       <style>
                /* jssor slider arrow navigator skin 21 css */
                /*
                .jssora21l                  (normal)
                .jssora21r                  (normal)
                .jssora21l:hover            (normal mouseover)
                .jssora21r:hover            (normal mouseover)
                .jssora21l.jssora21ldn      (mousedown)
                .jssora21r.jssora21rdn      (mousedown)
                */
                .jssora21l, .jssora21r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 55px;
                    height: 55px;
                    cursor: pointer;
                    background: url(images/a21.png) center center no-repeat;
                    overflow: hidden;
                }
                .jssora21l { background-position: -3px -33px; }
                .jssora21r { background-position: -63px -33px; }
                .jssora21l:hover { background-position: -123px -33px; }
                .jssora21r:hover { background-position: -183px -33px; }
                .jssora21l.jssora21ldn { background-position: -243px -33px; }
                .jssora21r.jssora21rdn { background-position: -303px -33px; }
            </style>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
            </span>
                 
                 </div>
                 
                 <?php } ?>
                
     <script>
        jQuery(document).ready(function ($) {

            var options = {
                $FillMode: 1,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                $SlideDuration: 800,                               //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
              
                $BulletNavigatorOptions: {                          //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                 //[Required] Class to create navigator instance
                    $ChanceToShow: 0,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                },

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };

            //Make the element 'slider1_container' visible before initialize jssor slider.
            $("#slider1_container").css("display", "block");
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
            </body>
			
            
          
           

