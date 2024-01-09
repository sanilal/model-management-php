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
.model_thumbs{ float:left; margin-right:5px}
.model_thumbs  img{ width:110px; height:150px}
.add-to-cart{font-family: Tahoma,Geneva,sans-serif; font-size: 11px;color:#666666; text-decoration:none}
.cart_drag{ max-height:382px; min-height:350px}
</style>
<link href="css/flc1.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<?php /*?><!--fancybox-->
 <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
<!--fancybox ends--><?php */?>
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
		/*$('.fancybox').fancybox({helpers:{title : false}});*/
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
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
            	<a href="<?php echo $_REQUEST['type']; ?>.php" style="text-decoration:none" ><span class="title-grey" style="text-transform:uppercase"><?php echo $_REQUEST['type']; ?> &gt;</span></a>
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
				if(isset($row)){
					$img_path="../FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
					if(!file_exists($img_path)) {
						$img_path="image/model_thumb.jpg";
					}
					$img_path1="../FLC_Resource_Images/".$row->Resource_ID."_02.jpeg";
					if(!file_exists($img_path1)) {
						$img_path1="image/model_thumb.jpg";
					}
					$img_path2="../FLC_Resource_Images/".$row->Resource_ID."_03.jpeg";
					if(!file_exists($img_path2)) {
						$img_path2="image/model_thumb.jpg";
					}
					$img_path3 ="../FLC_Resource_Images/".$row->Resource_ID."_04.jpeg";
					if(!file_exists($img_path3)) {
						$img_path3="image/model_thumb.jpg";
					}
					//
					$img_path4="../FLC_Resource_Images/".$row->Resource_ID."_05.jpeg";
					if(!file_exists($img_path4)) {
						$img_path4="image/model_thumb.jpg";
					}
					//
					$img_path5="../FLC_Resource_Images/".$row->Resource_ID."_06.jpeg";
					if(!file_exists($img_path5)) {
						$img_path5="image/model_thumb.jpg";
					}
					$img_path6="../FLC_Resource_Images/".$row->Resource_ID."_07.jpeg";
					if(!file_exists($img_path6)) {
						$img_path6="image/model_thumb.jpg";
					}
					$img_path7="../FLC_Resource_Images/".$row->Resource_ID."_08.jpeg";
					if(!file_exists($img_path7)) {
						$img_path7="image/model_thumb.jpg";
					}
					
				?>
                <div style="float:left; margin-right:10px; padding-top:10px">
                	<img src="<?php echo $img_path ?>" width="250" class="cart_drag"  /> 
                
                </div>
                <div style="float:left;font-family: Tahoma,Geneva,sans-serif; font-size: 14px; text-align:left; color:#666; padding-left:10px">
                	<div style="margin-bottom:5px"><b><?php echo $row->First_Name; ?></b></div> 
                    <div class="model_thumbs"> <a ref="<?php echo $img_path ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 1"><img src="<?php echo $img_path ?>" /> </a></div>
                    <div class="model_thumbs"><a ref="<?php echo $img_path1 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 2"> <img src="<?php echo $img_path1 ?>" /> </a></div>
                    <div class="model_thumbs"><a ref="<?php echo $img_path2 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 3"> <img src="<?php echo $img_path2 ?>" /> </a></div>
                     
                    <br />
                    <p>&nbsp; </p>
                    <div class="model_thumbs"><a ref="<?php echo $img_path3 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 4"> <img src="<?php echo $img_path3 ?>" /> </a></div>
                     <div class="model_thumbs"> <a ref="<?php echo $img_path4 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 5"><img src="<?php echo $img_path4 ?>" /> </a></div>
                    <div class="model_thumbs"><a ref="<?php echo $img_path5 ?>" href="javascript:;" title="<?php echo $row->First_Name; ?> image 6"> <img src="<?php echo $img_path5 ?>" /> </a></div>
                    
                    <div style=" clear:both;font-family: Tahoma,Geneva,sans-serif; font-size: 12px; text-align:left; color:#666; padding-left:12px; padding-top:10px">
                        Age:<?php echo $row->Age; ?> &nbsp; * &nbsp; <?php echo $row->Ethnicity; ?>
                    </div>
                </div>
                <div style="clear:both; padding-top:30px">
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
        <td colspan="2" bgcolor="#333333"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" height="32"><img src="image/bottom-bit.jpg" width="10" height="32" /></td>
            <td width="99%" class="bodyfont">&copy;2013 flcmodels.com | Privacy Policy</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
