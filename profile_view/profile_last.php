<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC - Profile</title>
<style type="text/css">
img{ border:none}
body {
	background-color: #E1E1E1;
}
.model_thumbs{ float:left; margin-right:12px; width:190px; height:220px; overflow:hidden}
.model_thumbs  img{ width:190px;}
.add-to-cart,.catalog_link{color:#666666; text-decoration:none}
.cart_drag{ }
.main_image_cont{float:left; margin-right:5px; padding-top:5px; height:511px; overflow:hidden; width:340px}
.main_image_cont > img{ max-height:530px; max-width:349px; min-height:511px; min-width:340px}
.water_mark{ width:340px; height:511px; font-size:40px;}
.thumb{ width:190px !important; height:220px !important; font-size:16px !important;}
</style>
<link href="css/flc1.css" rel="stylesheet" type="text/css" />
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
						'height': 75
				}, 1000, 'easeInOutExpo');
				
				setTimeout(function () {
					cart.effect("shake", {
						times: 2
					}, 200);
				}, 1500);
	
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
			$(".cart_drag").attr('src',$(this).attr('ref'))
		})
	})
</script>
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <?php
		include_once("includes/left.php");
	 ?>
    </td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
    	<tr>
            <td width="100%" valign="top" bgcolor="#000000" colspan="2"  height="26">
                 <?php
                    include_once("includes/top.php");
                 ?>
            </td>
        </tr>
      <tr>
        <td width="1%" height="587" bgcolor="#FFFFFF"><img src="image/hidden.gif" width="34" height="611" /></td>
        <td width="99%" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="image/hidden.gif" width="946" height="52" /></td>
          </tr>
          <?php
				require_once("classes/Models.php");
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
               		echo '<a href="'.$_REQUEST['type'].'.php" style="text-decoration:none" ><span class="title-grey" style="text-transform:uppercase">'.$_REQUEST['type'].' &gt;</span></a>';
				 } ?>
            	<a href="javascript:history.back()" style="text-decoration:none" ><span class="title-grey">Search Result &gt;</span></a>
                <span class="title-red"><?php echo $row->Resource_ID; ?></span>
           </td>
          </tr>
          <tr>
            <td height="19"><img src="image/hidden.gif" width="946" height="32" /></td>
          </tr>
          <tr>
            <td>
            <?php
				$sub_folder=$models->getImageFolder($row->Resource_ID);
				if(isset($row)){
					$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
					if(!file_exists($img_path)) {
						$img_path="image/model_thumb.jpg";
					}
					$img_path1=image_path.$sub_folder."/".$row->Resource_ID."_02.jpeg";
					if(!file_exists($img_path1)) {
						$img_path1="image/model_thumb.jpg";
					}
					$img_path2=image_path.$sub_folder."/".$row->Resource_ID."_03.jpeg";
					if(!file_exists($img_path2)) {
						$img_path2="image/model_thumb.jpg";
					}
					$img_path3 =image_path.$sub_folder."/".$row->Resource_ID."_04.jpeg";
					if(!file_exists($img_path3)) {
						$img_path3="image/model_thumb.jpg";
					}
					//
					$img_path4=image_path.$sub_folder."/".$row->Resource_ID."_05.jpeg";
					if(!file_exists($img_path4)) {
						$img_path4="image/model_thumb.jpg";
					}
					//
					$img_path5=image_path.$sub_folder."/".$row->Resource_ID."_06.jpeg";
					if(!file_exists($img_path5)) {
						$img_path5="image/model_thumb.jpg";
					}
					$img_path6=image_path.$sub_folder."/".$row->Resource_ID."_07.jpeg";
					if(!file_exists($img_path6)) {
						$img_path6="image/model_thumb.jpg";
					}
					$img_path7=image_path.$sub_folder."/".$row->Resource_ID."_08.jpeg";
					if(!file_exists($img_path7)) {
						$img_path7="image/model_thumb.jpg";
					}
					
				?>
                <div class="main_image_cont">
                	<div class="water_mark">
                      <img src="image/flc_mark.jpg"  />
                  </div>
                	<img src="<?php echo $img_path ?>" class="cart_drag"  /> 
                
                </div>
                <div style="float:left; text-align:left; color:#666; padding-left:10px; font-size:16px">
                	<div style="margin-bottom:5px">
                    	<?php echo $row->First_Name; ?>  <div style="float:right"> ID No. <?php echo $row->Resource_ID; ?></div>
                         <?php /*?>&nbsp; * <?php echo  $row->Resource_Type; ?> *<?php */?>
                    </div> 
                    <div style="overflow:hidden">
                        <div class="model_thumbs"> <a ref="<?php echo $img_path ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 1">
                        	<div class="water_mark thumb">
                                <img src="image/flc_mark.jpg" width="32" style="width:32px"  />
                            </div>
                        		<img src="<?php echo $img_path ?>" /> 
                          	</a>
                         </div>
                        <div class="model_thumbs">
                        	<a ref="<?php echo $img_path1 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 2"> 
                        		<div class="water_mark thumb">
                                    <img src="image/flc_mark.jpg" width="32" style="width:32px" />
                                </div>
                            	<img src="<?php echo $img_path1 ?>" /> 
                            </a>
                        </div>
                        <div class="model_thumbs" style="margin-right:0">
                        	<a ref="<?php echo $img_path2 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 3">
                            	<div class="water_mark thumb">
                                    <img src="image/flc_mark.jpg" width="32" style="width:32px"  />
                                </div>
                            	 <img src="<?php echo $img_path2 ?>" />
                            </a>
                        </div>
                    </div>
                    <p style="margin:0; height:10px">&nbsp; </p>
                    <div style="overflow:hidden">
                        <div class="model_thumbs">
                        	<a ref="<?php echo $img_path3 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 4"> 
                        		<div class="water_mark thumb">
                                   <img src="image/flc_mark.jpg" width="32" style="width:32px"  />
                                </div>
                            	<img src="<?php echo $img_path3 ?>" /> 
                            </a>
                        </div>
                         <div class="model_thumbs"> 
                         	<a ref="<?php echo $img_path4 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 5">
                            	<div class="water_mark thumb">
                                    <img src="image/flc_mark.jpg" width="32" style="width:32px" />
                                </div>
                            	<img src="<?php echo $img_path4 ?>" />
                            </a>
                         </div>
                        <div class="model_thumbs" style="margin-right:0">
                        	<a ref="<?php echo $img_path5 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 6"> 
                        		<div class="water_mark thumb">
                                    <img src="image/flc_mark.jpg" width="32" style="width:32px" />
                                </div>
                            	<img src="<?php echo $img_path5 ?>" />
                             </a>
                        </div>
                    </div>
                    <div style=" clear:both;font-family: Tahoma,Geneva,sans-serif; font-size: 14px; text-align:left; color:#666; padding:7px 4px 0px 0px">
                   <?php /*?> <?php
						if($row->Age!="N/A" && $row->Age!="" && $row->Age!="0"){
					?>
                        Age: <?php echo $row->Age; ?>&nbsp; * &nbsp; 
					<?php } ?>
                    <?php
						if($row->Ethnicity!="N/A" && $row->Ethnicity!=""){
					?>
						Ethnicity: <?php echo $row->Ethnicity; ?>&nbsp; * &nbsp;
                    <?php } ?>
                     <?php
						if($row->Gender!="N/A" && $row->Gender!=""){
					?>
						Gender: <?php echo $row->Gender; ?>
                    <?php } ?>
                    <br /> <br /><?php */?>
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
                        	<td colspan="7" height="10"></td>
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
                            <td colspan="2">&nbsp; </td>
                        </tr>
                              
                   	</table>
                    </div>
                </div>
                <div style="clear:both; padding-top:30px">
                	<a href="catalogue.php?ref_id=<?php echo $_REQUEST['res_id']; ?>&type=<?php echo $_REQUEST['type']; ?>" target="_blank" class="catalog_link"> SEE FULL CATALOGUE  </a> &nbsp;&nbsp;&nbsp;&nbsp;
                	<a href="javascript:;" class="add-to-cart" rel="<?php echo $row->Resource_ID ?>" ><img src="image/cart.png" />ADD TO SHORTLIST</a>
                </div>
                
			<?php }
			?>
            
           <?php /*?> <img src="image/models-profile.jpg" width="913" height="377" /><?php */?>
            
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
        	<?php include_once("includes/bottom.php"); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" <?php /*?>bgcolor="#333333"<?php */?> valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" height="32"><?php /*?><img src="image/bottom-bit.jpg" width="10" height="32" /><?php */?></td>
            <td width="99%" class="bodyfont">&copy;2013 flcmodels.com | Privacy Policy
            <div style="float:right; margin-right:20px" class="bodyfont">
            	Powered by: <a href="http://iconceptme.com/" target="_blank" class="iconcept_a">iConcept LLC</a>
            </div>
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
