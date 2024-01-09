 <style type="text/css">
 .title-grey{ font-weight:bold; color:#767676;}
 .model-parameters div{ padding:5px 3%;}
 .model-parameters{ text-align:center;}
 #modelgal img{ width:100%; padding:0;}
 #modelgal{ margin-top:20px;}
 #modelgal .col-4{ max-height:358px; overflow:hidden; margin-bottom:10px;}
 .absl_div{ position:absolute; bottom:0px; height:100%; z-index:10; width:100%; }
 .absl_div img{opacity:0.5;filter:alpha(opacity=50);}
 </style>

        
        <?php
define('MN_url','');
		require_once(MN_url."config/db.php");
			require_once(MN_url."classes/Models.php");
			$models = new Models();
			if(isset($_REQUEST['res_id'])){
				$model_res = $models->getModels(NULL,$_REQUEST['res_id'],NULL);
				$row=$model_res->fetch_object();
			}
		//
          ?>
         <section class="single-model" style="padding-top:50px;">
  	<div class="container">
    <?php
    if(isset($_REQUEST['type'])){
					 if($_REQUEST['type']=="model"){
					 	$_REQUEST['type']="women";	
					 }
               		echo '&lt; <a style="text-decoration:none" href="javascript:;" onClick="close_pop()"><span class="title-grey" style=""> Back to <span style="text-transform:capitalize;">'.$_REQUEST['type'].'</span> </span></a>';
				 } 
?>
<h2 style="text-align:center"><?php echo $row->First_Name; ?> &nbsp; <span class="title-grey">(<?php echo $row->Resource_ID ?>)</span></h2>
     <?php include_once("md-includes/cart_resp.php"); ?>
  <div class="shortlist">
										<a rel="<?php echo $row->Resource_ID ?>" class="add-to-cart" href="#cart_size"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Shortlist</a>
                </div>
       <style type="text/css">
                 .cart_content{float: right; margin-top: -70px !important;}
                </style>
                
                <div style="overflow:auto; margin-bottom:10px;">
                	<a style="float:left; font-weight:bold" href="javascript:;" onClick="prev_model()" class="title-grey">&lt;&lt; Previous </a>
                    <a style="float:right; font-weight:bold" href="javascript:;" onClick="next_model();"  class="title-grey">&gt;&gt; Next </a>
                </div>
        </div>
        
        
        
        <div class="model-parameters grey gradient_bg_goriz before_cover" <?php if($_REQUEST['type']=="stylist" || $_REQUEST['type']=="photographer"){ echo 'style="display:none;"';} ?>>
									<div>
										<span class="bold">Height</span>
										<br>
										<span><?php echo $row->Height; ?></span>
									</div>
									<div>
										<span class="bold">Bust</span>
										<br>
										<span><?php echo $row->Bust; ?></span>
									</div>
									<div>
										<span class="bold">Waist</span>
										<br>
										<span><?php echo $row->Waist; ?> </span>
									</div>
									<div>
										<span class="bold">Hips</span>
										<br>
										<span><?php echo $row->Hips; ?> </span>
									</div>
									<div>
										<span class="bold">Shoe</span>
										<br>
										<span><?php echo $row->ShoesSize; ?></span>
									</div>
									<div>
										<span class="bold">Eyes</span>
										<br>
										<span><?php echo $row->EyesColor; ?></span>
									</div>
                                    <div>
										<span class="bold">Hair</span>
										<br>
										<span><?php echo $row->HairColor; ?></span>
									</div>
                                     <div>
										<span class="bold">Skin</span>
										<br>
										<span><?php echo $row->SkinColor; ?></span>
									</div>
        </div>
        
        <div class="container">                        
                                
    	<div class="row">
        <div class="col-1"></div>
            <div class="col-10">
            
            
            
    
              
              
                
          <div id="modelgal" class="row">
          <?php
		  $sub_folder=$models->getImageFolder($row->Resource_ID);
		define('IMAGEPATH', image_path.$sub_folder."/");
		  $all_imgs=glob(MN_url.IMAGEPATH.$row->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//sort
		natsort($all_imgs);
		//var_dump(IMAGEPATH);
		$i=0;
		foreach($all_imgs as $filename){
			/*$ext=pathinfo($filename, PATHINFO_EXTENSION);
						$img=basename($filename);
						//var_dump($img);
						if(basename($img,".".$ext)!=$row->Resource_ID."_01"){*/
		  ?>
          <div class="col-4">
            <a href="<?php echo $filename; ?>" class="<?php if($i==0){ echo 'cart_drag';}?>" rel="gallery"><img src="<?php echo $filename; ?>" alt=""></a>
            <div class="absl_div"> 
                            <img alt="FLC Models &amp; Talents" class="grayscale" src="<?php echo MN_url; ?>images/flc_mark.png" style="position:absolute;left: 33%;bottom:2%;width: 30%;">
                        </div>
           </div>
            <?php //}
			$i++;
			 } ?>
            
        
        </div>
    
    
    
            
            </div>
           <?php /*?> <div class="col-5">
                <div class="model-pic" style="height:480px; overflow:hidden;">
                	<img src="<?php echo $all_imgs[0]; ?>" class="img-fluid cart_drag" alt="" width="100%"> 
                </div>
              
                
                                
                                 <div class="shortlist">
										<a rel="<?php echo $row->Resource_ID ?>" class="add-to-cart" href="#cart_size"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> ADD TO SHORTLIST</a>
                </div>
                
          </div><?php */?>
          <div class="col-1"></div>
      </div>
       <div class="shortlist">
          <a rel="<?php echo $row->Resource_ID ?>" class="add-to-cart" href="#cart_size"> 
          	<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Shortlist
          </a>
        </div>
        <div style="text-align:center; margin:10px 0;">
        	<a href="profile.php?res_id=<?php echo $row->Resource_ID ?>" target="_blank"> 
          	<i class="fa fa-eye" aria-hidden="true"></i> Open Profile
          </a>
          &nbsp;&nbsp; <a href="com_cart.php?res_id=<?php echo $row->Resource_ID ?>" target="_blank"> 
          	<i class="fa fa-eye" aria-hidden="true"></i> View Catalogue
          </a>
        </div>
    </div>
    
    <div class="model-parameters grey gradient_bg_goriz before_cover" style="display:none">
    </div>
  
  </section>
  
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
						url: "<?php echo MN_url ?>ajax.php",
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
         