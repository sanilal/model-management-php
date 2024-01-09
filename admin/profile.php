<?php
ob_start();
require_once("../config/db.php");
require_once("../classes/Login.php");

$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
	if($_SESSION['user_role']==2 || $_SESSION['user_role']==4){
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC - Profile</title>

<style type="text/css">

img,a{ border:none; text-decoration:none}

.add-to-cart,.catalog_link{color:#666666; text-decoration:none}
.cart_drag{ }

			@media (min-width: 768px) {
        		.content-main .col-sm-4{ padding-right:5px;}
				.content-main .col-sm-8 { padding-left:5px;}
				
				.content-main .middle_img { padding-left:5px; padding-right:5px}
				.first_img{ padding-right:5px}
				.last_img{ padding-left:5px}
				/*.prof_name, .prof_id{ width:43.3%;}*/
				/*.prof_thumb{width:29.333%}
				.content-main .middle_img { width:27.9%}*/
				.particulars{ width:97%;}
				.main_img-cont{ padding-top:22px;}
			}
			@media (min-width: 992px)and (max-width: 1199px) {
				.thumb_cont{ height:202px;}
			}
			@media (min-width: 768px)and (max-width: 991px) {
			.thumb_cont{ height:155px;}
			}
			@media (min-width: 1200px){
				.thumb_cont{ height:247px;}
			}
			@media (max-width: 768px) {
				.name_cont{ margin:10px 0px}
				.absl_div{ width:100%;}
				.thumb_cont{ height:180px;}
			}
			@media (max-width: 455px) {
				.thumb_cont{ height:150px !important;}	
			}
			.thumb_cont { margin-bottom:10px; overflow:hidden; position:relative}
			.particulars{ font-size:14px;}
			.catalog_link, .add-to-cart{color: #666; font-size:14px;}
			.absl_div { z-index:100;}
			.absl_div img{opacity:0.5;filter:alpha(opacity=50);}
			

</style>


<link rel="icon" href="../favicon.ico" type="image/x-icon" />
  <!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
 <!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery(".navbar-brand").click(function(){
            jQuery(".navbar-toggle").click();
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
		
		$(".model_thumbs > a").click(function(){
			var new_img=$(".cart_drag").attr('src');
			$(".cart_drag").attr('src',$(this).attr('ref'))
			$(this).attr('ref',new_img);
			$(this).children('.water_mark').next().attr('src',new_img);
			var img_name=$(".cart_drag").attr('src').slice(-7);
			
			if(img_name=="01.jpeg"){
				$(".main_image_cont").removeClass("main_image_stretch");
			}
			else{
				$(".main_image_cont").addClass("main_image_stretch");
			}
		})
	})
</script>

</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="container">
	<div class="punch_cont">
    		 <?php
				require_once("../classes/Models.php");
				$models = new Models();
				if(isset($_REQUEST['res_id'])){
					$model_res = $models->getModels(NULL,$_REQUEST['res_id'],NULL);
					$row=$model_res->fetch_object();
				}
			?>
        	<div class="text-left">
            	<?php
				 if(isset($_REQUEST['type'])){
               	?>
                <a href="<?php echo $_REQUEST['type']?>.php" style="text-decoration:none" ><span class="title-grey" style="text-transform:uppercase"><?php echo $_REQUEST['type']?> &gt;</span></a>
                <a href="<?php echo $_REQUEST['type']?>.php?res_back=true" style="text-decoration:none" >
                	Search Result &gt;
                 </a>
                                
                <?php
				 	} 
					else{
				?>
                Profile &gt;
                <?php } ?>
                <?php echo $row->Resource_ID; ?>
            </div>
        </div>

	
    <div class="container inner_content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          
          <tr>
            <td>
            	
                <?php include_once("includes/cart.php"); ?>
           </td>
          </tr>
          <tr>
            <td height="19"><img src="../image/hidden.gif" width="946" height="5" /></td>
          </tr>
          <tr>
            <td>
            <?php
				$sub_folder=$models->getImageFolder($row->Resource_ID);
				if(isset($row)){
					
					
				?>
               
                
                <div class="content-main"> 
                <div class="row" style="position:relative">
            	<?php
				$img_path1=""; $img_path2=""; $img_path3=""; $img_path4=""; $img_path5=""; $img_path6="";
            	$sub_folder=$models->getImageFolder($row->Resource_ID);
				define('IMAGEPATH', "../".image_path.$sub_folder."/");
				if(isset($row)){
					$test_path=glob(IMAGEPATH.$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
					$img_path=$test_path[0];
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
							$k++;
						}
							//echo basename($filename);
					}
					
				}
				?>
            	
                 <div class="col-sm-4 main_img-cont" >
                    <div style="width:100%;">
                    	<img src="<?php echo $img_path; ?>" class="img-responsive cart_drag" width="100%"  />
                        <div class="absl_div"> 
                            <img alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.png" style="position:absolute;left: 33%;bottom:2%;width: 30%;" />
                        </div>
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
                                    <div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="40"  src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:0;"> 
                                      </div>
                                    	<?php if(file_exists($img_path1)) { echo '<img src="'.$img_path1.'" class="img-responsive"  />';} ?>
                                        

                                    </div>
                                                                     </a>
                            </div>
                            <div class="col-xs-4 middle_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path2; ?>">
                                    <div style="width:100%;" class="thumb_cont">
                                    	<div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="40"  src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:0;"> 
                                      </div>
										<?php if(file_exists($img_path2)) { echo '<img src="'.$img_path2.'" class="img-responsive"  />';} ?>
                                        
                                    </div>
                                    
                                  </a>
                            </div>
                            <div class="col-xs-4 last_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path3; ?>">
                                    <div style="width:100%;" class="thumb_cont">
									<div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="40"  src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:0;"> 
                                      </div>
									<?php if(file_exists($img_path3)) { echo '<img src="'.$img_path3.'" class="img-responsive"  />';} ?>
                                     
                                    </div>
                                   
                                 </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 first_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path4; ?>">
                                    <div style="width:100%;" class="thumb_cont">
									<div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="40"  src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:0;"> 
                                      </div>
									<?php if(file_exists($img_path4)) { echo '<img src="'.$img_path4.'" class="img-responsive"  />';} ?>
                                    
                                    </div>
                                    
                                 </a>
                            </div>
                            <div class="col-xs-4 middle_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path5; ?>">
                                    <div style="width:100%;" class="thumb_cont">
										<div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="40"  src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:0;"> 
                                      </div>

									<?php if(file_exists($img_path5)) { echo '<img src="'.$img_path5.'" class="img-responsive"  />';} ?>
                                            </div>
                                    
                                 </a>
                            </div>
                            <div class="col-xs-4 last_img prof_thumb">
                            	<a title="*Aleksandra image" href="javascript:;" ref="<?php echo $img_path6; ?>">
                                    <div style="width:100%;" class="thumb_cont">
									<div class="absl_div"> 
                                          <img alt="FLC Models &amp; Talents" width="40"  src="../images/flc_mark.png" style=" position:absolute; left:0; bottom:0;"> 
                                      </div>
									<?php if(file_exists($img_path6)) { echo '<img src="'.$img_path6.'" class="img-responsive"  />';} ?>
                                    
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
            
                <div style="clear:both; padding-top:30px">
                	<a href="../catalogue.php?ref_id=<?php echo $_REQUEST['res_id']; ?>&type=<?php echo $_REQUEST['type']; ?>" target="_blank" class="catalog_link fancybox.iframe"> SEE FULL CATALOGUE  </a> &nbsp;&nbsp;&nbsp;&nbsp;
                	<a href="javascript:;" class="add-to-cart" rel="<?php echo $row->Resource_ID ?>" ><img src="../image/cart.png" />ADD TO SHORTLIST</a>
                </div>
                
			<?php }
			?>
            
          
            
            </td>
          </tr>
        </table>
    
    </div>


</div>

<!---------------------------------------------------------------main_content_end------------------------------------------------------------------>

<!-------------------------------------------------------------------footer------------------------------------------------------------------------------------->
<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>
<!-----------------------------------------------------------------------footer---------------------------------------------------------------------------------------->
<script type="text/javascript" src="../js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
	$(function(){
		
		//
		$('.catalog_link').fancybox({width: 970,height:350});
	})
	
</script>
</body>
</html>
<?php 
	}
	else {
    	header("Location:../login.php");
	}
    
} else {
    header("Location:../login.php");
}
 ?>