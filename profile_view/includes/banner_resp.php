<header class="hero-spacer">
	  
        	  <script type="text/javascript" src="js/jssor.slider.mini_org.js"></script>
              <script>
				 
				 jQuery(document).ready(function ($) {
						var jssor_1_SlideoTransitions = [];
						var _SlideshowTransitions = [{$Duration:1200,x:1,$Easing:{$Left:$JssorEasing$.$EaseInOutQuart,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2,$Brother:{$Duration:1200,x:-1,$Easing:{$Left:$JssorEasing$.$EaseInOutQuart,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2}}];
						var jssor_1_options = {
						  $AutoPlay: true,
						  $SlideDuration: 700,
						  $SlideshowOptions: {                                //Options which specifies enable slideshow or not
								$Class: $JssorSlideshowRunner$,                 //Class to create instance of slideshow
								$Transitions: _SlideshowTransitions,            //Transitions to play slide, see jssor slideshow transition builder
								$TransitionsOrder: 1,                           //The way to choose transition to play slide, 1 Sequence, 0 Random
								$ShowLink: 2,                                   //0 After Slideshow, 2 Always
								$ContentMode: false                             //Whether to trait content as slide, otherwise trait an image as slide
							},
						  $CaptionSliderOptions: {
							$Class: $JssorCaptionSlideo$,
							$Transitions: jssor_1_SlideoTransitions
						  },
						  $ArrowNavigatorOptions: {
							$Class: $JssorArrowNavigator$
						  },
						  
						};
						
						var jssor_1_slider = new $JssorSlider$("slider1_container", jssor_1_options);
						
						//responsive code begin
						//you can remove responsive code if you don't want the slider scales while window resizing
						function ScaleSlider() {
							var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
							if (refSize) {
								refSize = Math.min(refSize, 1200);
								jssor_1_slider.$ScaleWidth(refSize);
							}
							else {
								window.setTimeout(ScaleSlider, 30);
							}
						}
						ScaleSlider();
						$(window).bind("load", ScaleSlider);
						$(window).bind("resize", ScaleSlider);
						$(window).bind("orientationchange", ScaleSlider);
						//responsive code end
					});
					
			</script>
            <style type="text/css">
        	.jssora03L, .jssora03R {
				display: block;
				position: absolute;
				cursor: pointer;
				/*background: url('/theme/img/a22.png') center center no-repeat;*/
				overflow: hidden;
			}
			.jssora03L{background: url('images/green/arrow_left.png') center center no-repeat; top: 171px; left: 100px; width: 40px; height: 58px;}
			.jssora03R{background: url('images/green/arrow_right.png') center center no-repeat; top: 171px; right: 100px; width: 40px; height: 58px;}
			#slider1_container{position: relative; top: 0px; left: 0px; width: 1100px; height: 430px; overflow: hidden;}
			#slider1_container .slides_u{cursor: move; position: absolute; left: 0px; top: 0px; width:1100px; height:430px; overflow: hidden;}
        </style>
    <div id="slider1_container">
        <div u="slides" class="slides_u">
        	<?php
				require_once("classes/Article.php");
				$article= new Article();
				$banners=$article->getBanner();
				while($row=$banners->fetch_object()){
			?>
            	<div>
                    <img u="image" src="uploads/<?php echo $row->banner_image; ?>" alt="FLC Production & Model Management " />
                </div>
            <?php } ?>
            
        </div>
        
        <span  data-u="arrowleft" class="jssora03L" ></span>
        <!-- Arrow Right -->
        <span  data-u="arrowright" class="jssora03R" ></span>
        
    </div>    

      
  
</header>