<!DOCTYPE html>
<html lang="en">

<head>
    
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css?v=2.1.4" media="screen" />
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents - Profile </title>
   
</head>

<body>
    
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">
		<?php
			require_once("../classes/Models.php");
			$models = new Models();
			if(isset($_REQUEST['res_id'])){
				$model_res = $models->getModels(NULL,$_REQUEST['res_id'],NULL);
				$row=$model_res->fetch_object();
			}
		?>

        <!-- Jumbotron Header -->
         <header class="hero-spacer">
        	
            	<?php
                 if(isset($_REQUEST['type'])){
					 ?>
                  <div class="main_title">
                     <?php
					 if($_REQUEST['type']=="model"){
						//echo '<a href="index.php" style="text-decoration:none" ><span class="main_title" style="text-transform:uppercase">HOME &gt;</span></a>';
					}
					else
               		 echo '<a href="'.$_REQUEST['type'].'.php" style="text-decoration:none" ><span class="main_title" style="text-transform:uppercase">'.$_REQUEST['type'].'</span></a>';
					 ?>
                     </div>
                     <a style="text-decoration:none" href="javascript:history.back()"><div class="title-grey">Back to search results</div></a>   
				<?php } else{?>
                <div class="main_title">Profile</div>
                <?php } /*?><span class="title-red"><?php echo $row->Resource_ID; ?></span><?php */?>
                
                <?php //include_once("includes/cart_resp.php"); ?>
                
                     
        </header>
		<style type="text/css">
			/*@media (min-width: 768px) {
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
			}*/
			.thumb_cont { margin-bottom:10px; overflow:hidden;}
			.particulars{ font-size:12px;}
			.catalog_link, .add-to-cart{font-size:13px;}
			<?php /*?>a.catalog_link{ color:#d6131d !important;}
			a.add-to-cart{ color:#31a01b !important}<?php */?>
			
        </style>
		<script type="text/javascript">
		jQuery(function(){
			jQuery(".col-xs-4 > a").click(function(){
				var new_img=$(".cart_drag").attr('src');
				jQuery(".cart_drag").attr('src',$(this).attr('ref'))
				jQuery(this).attr('ref',new_img);
				jQuery(this).children('.thumb_cont').find(".img-responsive").attr('src',new_img);
				//var img_name=$(".cart_drag").attr('src').slice(-7);
				//jQuery(this).children('.thumb_cont').find(".img-responsive").attr('ref',new_img);
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
					$(".footer").show();
					var cart = $('.shopping-cart');
					var imgtodrag = $('.cart_drag');
					//alert(imgtodrag.attr('src'))
				/*	if (imgtodrag) {
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
					}*/
					//
					var obj=$(this).attr('rel')
					$.ajax({
						url: "../ajax.php",
						type: "post",
						data:  {insertdata: "models",id:obj },
						success: function(message){
							$(".footer").show();
							$(".badge1").attr("data-badge",message);
							$(".badge1").effect( "bounce", {times:4}, 500 );
						},
						error:function(){
							alert("failure");
						}
					})
					//
					$(".badge1").effect( "bounce", {times:4}, 500 );
					});
			})
		</script>
        <div class="content">   
        	<div class="row">
            	<?php
				$img_path1=""; $img_path2=""; $img_path3=""; $img_path4=""; $img_path5=""; $img_path6="";
            	$sub_folder=$models->getImageFolder($row->Resource_ID);
				define('IMAGEPATH', "../".image_path.$sub_folder."/");
				if(isset($row)){
					$test_path=glob(IMAGEPATH.$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
					$img_path=$test_path[0];
					$opt_img_path="image.php?img=".$img_path;
					$all_imgs=glob(IMAGEPATH.$row->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//sort
					natsort($all_imgs);
					//
					$k=1;
					foreach($all_imgs as $filename){
						$ext=pathinfo($filename, PATHINFO_EXTENSION);
						$img=basename($filename);
						if(basename($img,".".$ext)!=$row->Resource_ID."_01"){
							${'img_path'.$k}=IMAGEPATH.$img;
							${'opt_img_path'.$k}="image.php?img=".IMAGEPATH.$img;
							$k++;
						}
							//echo basename($filename);
					}
					
				}
				?>
                
                 <div class="col-sm-4">
                    <div style="max-width:340px; margin-left:auto; margin-right:auto; position:relative" id="main_thumb">
                    	<img src="<?php echo $opt_img_path; ?>" class="img-responsive cart_drag" width="100%"  />
                    	<div class="absl_div"> 
                            <img alt="FLC Models &amp; Talents"  class="grayscale" src="../images/flc_mark.png" width="55" style=" position:absolute; left:0; bottom:10px;"> 
                        </div>
                    </div>
                    
                 </div>
                 <div class="col-sm-8">
                    <div class="table" style="font-size: 16px; overflow:hidden">
                        <div class="row name_cont">
                            <div class="col-xs-12 text-left prof_name" style="margin:8px auto"><?php echo $row->First_Name; ?></div> 
                        </div>
                        <div class="row">
                            <div class="col-xs-4 first_img prof_thumb">
                            	<a title="<?php echo $row->First_Name; ?> image" href="#main_thumb" ref="<?php echo $opt_img_path1; ?>">
                                    <div style="width:100%;" class="thumb_cont" >
                                    	<?php if(file_exists($img_path1)) { echo '<img src="'.$opt_img_path1.'" class="img-responsive"  />';} ?>
                                    </div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="35"  class="grayscale" src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                            <div class="col-xs-4 middle_img prof_thumb">
                            	<a title="<?php echo $row->First_Name; ?> image" href="#main_thumb" ref="<?php echo $opt_img_path2; ?>">
                                    <div style="width:100%;" class="thumb_cont">
                                    	<?php if(file_exists($img_path2)) { echo '<img src="'.$opt_img_path2.'" class="img-responsive"  />';} ?>
                                    </div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="35"  class="grayscale" src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                  </a>
                            </div>
                            <div class="col-xs-4 last_img prof_thumb">
                            	<a title="<?php echo $row->First_Name; ?> image" href="#main_thumb" ref="<?php echo $opt_img_path3; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path3)) { echo '<img src="'.$opt_img_path3.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="35"  class="grayscale" src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 first_img prof_thumb">
                            	<a title="<?php echo $row->First_Name; ?> image" href="#main_thumb" ref="<?php echo $opt_img_path4; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path4)) { echo '<img src="'.$opt_img_path4.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="35"  class="grayscale" src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                            <div class="col-xs-4 middle_img prof_thumb">
                            	<a title="<?php echo $row->First_Name; ?> image" href="#main_thumb" ref="<?php echo $opt_img_path5; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path5)) { echo '<img src="'.$opt_img_path5.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="35"  class="grayscale" src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                 </a>
                            </div>
                            <div class="col-xs-4 last_img prof_thumb">
                            	<a title="<?php echo $row->First_Name; ?> image" href="#main_thumb" ref="<?php echo $opt_img_path6; ?>">
                                    <div style="width:100%;" class="thumb_cont"><?php if(file_exists($img_path6)) { echo '<img src="'.$opt_img_path6.'" class="img-responsive"  />';} ?></div>
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="35"  class="grayscale" src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:10px;"> 
                                      </div>
                                </a>
                            </div>
                        </div>
                        <div class="row particulars" <?php if($_REQUEST['type']=="stylist" || $_REQUEST['type']=="photographer"){ echo 'style="display:none;"';} ?>>
                            <div class="col-xs-6 text-left">Height: <?php echo $row->Height; ?> </div> 
                            <div class="col-xs-6 text-left"> | Bust:  <?php echo $row->Bust; ?> </div> 
                            <div class="col-xs-6 text-left">Waist: <?php echo $row->Waist; ?>  </div> 
                            <div class="col-xs-6 text-left"> | Hips: <?php echo $row->Hips; ?></div> 
                        </div>
                        <div class="row particulars" <?php if($_REQUEST['type']=="stylist" || $_REQUEST['type']=="photographer"){ echo 'style="display:none;"';} ?>>
                            <div class="col-xs-6 text-left">Eyes: <?php echo $row->EyesColor; ?>  </div> 
                            <div class="col-xs-6 text-left"> | Hair: <?php echo $row->HairColor; ?>  </div> 
                            <div class="col-xs-6 text-left">Shoes:  <?php echo $row->ShoesSize; ?> </div> 
                            <div class="col-xs-6 text-left"> | Skin: <?php echo $row->SkinColor; ?> </div> 
                        </div>
                    </div>
                 </div>
            </div>
      
            <div class="row" style="margin-top:10px"> 
               <div class="col-md-4">
              	<div class="table">
                  <div class="row">
                      <div class="col-xs-12 text-left" style="margin-bottom:15px;"> <a class="catalog_link fancybox.iframe" ref="catalogue.php?ref_id=<?php echo $_REQUEST['res_id']; ?>&type=<?php echo $_REQUEST['type']; ?>" href="javascript:;"><img src="images/eye-ico.png" height="20" /> &nbsp; SEE FULL CATALOGUE  </a> </div>
                      <div class="col-xs-12 text-left"> <a rel="<?php echo $row->Resource_ID ?>" class="add-to-cart" href="#cart_size"><img src="images/cart-green.png" height="20" /> &nbsp; ADD TO SHORTLIST</a> </div>
                  </div>
                </div>
               </div>
               
              
            </div>
        
    	</div>
        
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
        </footer>
		 <?php /*?><script type="text/javascript" src="../js/jquery.fancybox.js?v=2.1.4"></script>
        <script type="text/javascript">
            $(function(){
                
                //
                $('.catalog_link').fancybox({height:460,
					afterShow : function() {
						$(".fancybox-close").html("Close");
					}	
				});
				
            })
            
        </script><?php */?> 
        <link href="css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
		<script src="js/bootstrap-dialog.min.js"></script>
        <script type="text/javascript">
		$(function (){
			$(".catalog_link").click( function(){
				 BootstrapDialog.show({
					type:'type-default',
					title: 'Catalogue',
					message: '<iframe width="100%" src="'+$(this).attr('ref')+'" frameborder="0" scrolling="no" id="iframe" onload="javascript:resizeIframe(this);" ></iframe>',
					buttons: [{
						label: 'Close',
						action: function(dialogItself){
							dialogItself.close();
						}
					}]
				});
			})
		})
        function resizeIframe(obj) {
			obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		  }
        </script>
</body>

</html>
