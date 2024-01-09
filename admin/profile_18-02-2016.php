<?php
ob_start();
require_once("../config/db.php");
require_once("../classes/Login.php");

$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
	if($_SESSION['user_role']==2 || $_SESSION['user_role']==4){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC - Profile</title>
<link href="../css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">
img,a{ border:none; text-decoration:none}
.model_thumbs{ float:left; margin-right:12px; width:190px; height:220px; overflow:hidden}
.model_thumbs  img{ width:190px;}
.add-to-cart,.catalog_link{color:#666666; text-decoration:none}
.cart_drag{ }
.main_image_cont{float:left; margin-right:5px; padding-top:5px; height:511px; overflow:hidden; width:340px}
.main_image_cont > img{ max-height:530px; max-width:349px; min-height:511px; min-width:340px}
.water_mark{ width:340px; height:511px; font-size:40px;}
.thumb{ width:190px !important; height:220px !important; font-size:16px !important;}
.content{ padding-bottom:15px}
.main_image_stretch > img{ min-height:425px;}
.main_image_stretch .water_mark{ height:425px}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
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

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <?php
				require_once("../classes/Models.php");
				$models = new Models();
				if(isset($_REQUEST['res_id'])){
					$model_res = $models->getModels(NULL,$_REQUEST['res_id'],NULL);
					$row=$model_res->fetch_object();
				}
			?>
          <tr>
            <td>
            	<?php
				 if(isset($_REQUEST['type'])){
               	?>
					<a href="<?php echo $_REQUEST['type']?>.php" style="text-decoration:none" ><span class="title-grey" style="text-transform:uppercase"><?php echo $_REQUEST['type']?> &gt;</span></a>
				 
            	<a href="<?php echo $_REQUEST['type']?>.php?res_back=true" style="text-decoration:none" >
                	<span class="title-grey">Search Result &gt;</span>
                 </a>
				 <?php
				 	} 
					else{
				?>
                <span class="title-grey" style="text-transform:uppercase">Profile &gt;</span>
                <?php } ?>
				 
                <span class="title-red"><?php echo $row->Resource_ID; ?></span>
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
					$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
					$img_code='<img src="'.$img_path.'" />';
					if(!file_exists($img_path)) {
						$img_code='<div style="width:340px; height:511px">&nbsp; </div>';
						//$img_path="";
					}
					$img_path1="../".image_path.$sub_folder."/".$row->Resource_ID."_02.jpeg";
					$img_code1='<img src="'.$img_path1.'" />';
					if(!file_exists($img_path1)) {
						$img_code1='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path1="";
					}
					$img_path2="../".image_path.$sub_folder."/".$row->Resource_ID."_03.jpeg";
					$img_code2='<img src="'.$img_path2.'" />';
					if(!file_exists($img_path2)) {
						$img_code2='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path2="";
					}
					$img_path3 ="../".image_path.$sub_folder."/".$row->Resource_ID."_04.jpeg";
					$img_code3='<img src="'.$img_path3.'" />';
					if(!file_exists($img_path3)) {
						$img_code3='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path3="";
					}
					//
					$img_path4="../".image_path.$sub_folder."/".$row->Resource_ID."_05.jpeg";
					$img_code4='<img src="'.$img_path4.'" />';
					if(!file_exists($img_path4)) {
						$img_code4='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path4="";
					}
					//
					$img_path5="../".image_path.$sub_folder."/".$row->Resource_ID."_06.jpeg";
					$img_code5='<img src="'.$img_path5.'" />';
					if(!file_exists($img_path5)) {
						$img_code5='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path5="";
					}
					$img_path6="../".image_path.$sub_folder."/".$row->Resource_ID."_07.jpeg";
					$img_code6='<img src="'.$img_path6.'" />';
					if(!file_exists($img_path6)) {
						$img_code6='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path6="";
					}
					$img_path7="../".image_path.$sub_folder."/".$row->Resource_ID."_08.jpeg";
					$img_code7='<img src="'.$img_path7.'" />';
					if(!file_exists($img_path7)) {
						$img_code7='<div style="width:190px; height:220px">&nbsp; </div>';
						//$img_path7="";
					}
					
				?>
                <div class="main_image_cont">
                	<div class="water_mark">
                      <img src="../image/flc_mark.jpg"  />
                  </div>
                	<img src="<?php echo $img_path ?>" class="cart_drag"  /> 
                
                </div>
                <div style="float:left; text-align:left; color:#666; padding-left:10px; font-size:16px">
                	<div>
                    	<?php echo $row->First_Name; ?>  <div style="float:right"> ID No. <?php echo $row->Resource_ID; ?></div>
                         <?php /*?>&nbsp; * <?php echo  $row->Resource_Type; ?> *<?php */?>
                    </div> 
                    <div style="overflow:hidden">
                        <div class="model_thumbs"> <a ref="<?php echo $img_path1 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 1">
                        	<div class="water_mark thumb">
                                <img src="../image/flc_mark.jpg" width="32" style="width:32px"  />
                            </div>
                        		<?php echo $img_code1 ?>
                          	</a>
                         </div>
                        <div class="model_thumbs">
                        	<a ref="<?php echo $img_path2 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 2" > 
                        		<div class="water_mark thumb">
                                    <img src="../image/flc_mark.jpg" width="32" style="width:32px" />
                                </div>
                            	<?php echo $img_code2 ?>
                            </a>
                        </div>
                        <div class="model_thumbs" style="margin-right:0">
                        	<a ref="<?php echo $img_path3 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 3" >
                            	<div class="water_mark thumb">
                                    <img src="../image/flc_mark.jpg" width="32" style="width:32px"  />
                                </div>
                            	<?php echo $img_code3 ?>
                            </a>
                        </div>
                    </div>
                    <p style="margin:0; height:10px">&nbsp; </p>
                    <div style="overflow:hidden">
                        <div class="model_thumbs">
                        	<a ref="<?php echo $img_path4 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 4" > 
                        		<div class="water_mark thumb">
                                   <img src="../image/flc_mark.jpg" width="32" style="width:32px"  />
                                </div>
                            	<?php echo $img_code4 ?>
                            </a>
                        </div>
                         <div class="model_thumbs"> 
                         	<a ref="<?php echo $img_path5 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 5" >
                            	<div class="water_mark thumb">
                                    <img src="../image/flc_mark.jpg" width="32" style="width:32px" />
                                </div>
                            	<?php echo $img_code5 ?>
                            </a>
                         </div>
                        <div class="model_thumbs" style="margin-right:0">
                        	<a ref="<?php echo $img_path6 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 6" > 
                        		<div class="water_mark thumb">
                                    <img src="../image/flc_mark.jpg" width="32" style="width:32px" />
                                </div>
                            	<?php echo $img_code6 ?>
                             </a>
                        </div>
                    </div>
                    <div style=" clear:both;font-family: Tahoma,Geneva,sans-serif; font-size: 14px; text-align:left; color:#666; padding:7px 4px 0px 0px; <?php if($_REQUEST['type']=="stylist" || $_REQUEST['type']=="photographer"){ echo "display:none;";} ?>">
                   
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td align="left">
                    
								Height: <?php echo $row->Height; ?>
                        	</td>
                        
                        	<td width="10">|</td>
                    
                    		
                            <td align="left">
                     
						Bust: <?php echo $row->Bust; ?>
                    
                    		</td>
                            <td width="10">|</td>
                            <td align="left">
                    
						Waist: <?php echo $row->Waist; ?>
                   
                    		</td>
                            <td width="10">|</td>
                            <td align="left">
                   
						Hips: <?php echo $row->Hips; ?>
                   
                    		</td>
                            
                   		</tr>
                        
                        <tr>
                        	
                                   
                            <td align="left">
                    
                        Eyes: <?php echo $row->EyesColor; ?>
                    
                            </td>
                            <td width="10">|</td>
                            <td align="left">
                    
                        Hair: <?php echo $row->HairColor; ?> 
                   
                            </td>
                            <td width="10">|</td>
                            <td align="left">
                    
                        Shoes: <?php echo $row->ShoesSize; ?>
                   
                            </td>
                           <td width="10">|</td>
                            <td align="left">
                    
                        Skin: <?php echo $row->SkinColor; ?>
                   
                            </td>
                        </tr>
                              
                   	</table>
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