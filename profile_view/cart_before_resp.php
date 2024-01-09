<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC - Shortlist</title>
<link href="css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.content{ min-height:591px}
.contenter a{ text-decoration:none}
.cart_table td, .cart_table th{text-align:center; padding:4px 0px}
.delete_icon { color:#E70312; text-decoration:none}
.water_mark{ width:60px; height:80px; font-size:12px;}
.water_mark > b{ bottom:3px; z-index:0; }
input.required{ width:200px}
textarea{ width:200px; height:80px}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function delete_cart(id,obj){
		$.ajax({
			url: "ajax.php",
			type: "post",
			data:  {dedata: "cart",item_id:id },
			success: function(message){
				message=message.replace(/\s/g, '')
				if(message=="success"){
					location.reload();
				}
			},
			error:function(){
				alert("failure");
			}
		})
	}
	function validate(obj){
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		if($(obj).find("#contact_name").val()=="" || $(obj).find("#email_id").val()=="" ){
			alert("Please fill the mandatory fields!")
			return false
		}
		else if(!pattern.test($(obj).find("#email_id").val())){
			alert("Please add a valid email address!")
			return false
		}
		else{
			return true;
			$(obj).submit();
		}
		
	}
</script>


</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td><span class="title-grey">Wishlist</span></td>
          </tr>
          
          <tr>
            <td>
            <?php
			session_start();
			if(isset($_SESSION['models'])){
			?>
            <form action="checkout.php" method="post" onsubmit="return validate(this)">
            	
                <div style="max-height:500px; overflow:auto">
            	<table style="" width="100%" border="0" cellpadding="0" cellspacing="0" class="cart_table">
                	<tr bgcolor="#333333" style="font-size: 13px; font-weight:bold; color:#FFF">
                    	<th>Sl.No</th><th colspan="2">Model</th><th>Age</th><th>&nbsp;</th>
                     </tr>
				<?php
						$k=1;
						foreach ($_SESSION['models'] as $model){
							require_once("classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
							//$img_path="../FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
							if(!file_exists($img_path)) {
								$img_path="image/model_thumb.jpg";
							}
							?>
                            <tr bgcolor="#E1E1E1" style="border:2px solid #5A5858">
                            	<td><?php echo $k; $k++; ?></td>
                                <td>
                                	<div style="width:60px; position:relative; min-height:72px">
                                        <div class="water_mark">
                                             <img src="image/flc_mark.jpg" width="15"  />
                                        </div>
                                        <img src="<?php echo $img_path; ?>" width="50"  />
                                    </div>
                                </td>
                                <td style="text-align:left"> <?php echo $row->First_Name; ?></td>
                                <td><?php echo $row->Age; ?></td>
                                <td><a href="javascript:;" class="delete_icon" onclick="delete_cart('<?php echo $row->Resource_ID; ?>',this)" >delete</a></td>
                            </tr>
                            <tr bgcolor="#686666">
                            	<td colspan="5" style="padding:0px; height:3px"></td>
                            </tr>
						<?php
                        }
					
				?>
			
            	</table>
         		</div>
                <?php if(sizeof($_SESSION['models'])>0){ ?>
                    <div style="padding:20px 0px">
                    	 <table width="70%" cellpadding="3">
                            <tr class="bodyfont">
                                <td valign="top">
                                	<table>
                                        <tr>
                                            <td> Full Name: <sup>*</sup></td>
                                            <td><input type="text" name="name" required="required" class="required" id="contact_name"  /></td>
                                         </tr>
                                         <tr>
                                            <td>Company: </td><td><input type="text" name="company" class="required" /></td>
                                         </tr>
                                         <tr>
                                            <td> Remarks:</td><td><textarea name="remarks" ></textarea></td>
                                        </tr>
                                  	</table>
                                </td>
                                <td valign="top">
                                	<table>
                                		<tr>
                                			<td>Email: <sup>*</sup></td><td><input type="email" name="email" required="required"  class="required" id="email_id" /></td>
                            			</tr>
                                         <tr>
                                            <td>Address: </td><td><textarea name="address" ></textarea></td>
                                        </tr>
                            		</table>
                           		</td>
                               </tr>
                        	</table>        
                        <input type="submit" value="Submit Request" style="background:#469E3A; color:#FFF; font-weight:bold"/>               
                    </div>
                <?php } ?>
                    
                <input type="hidden" name="action" value="checkout"  />
             </form>
            <?php } else{ ?>
            	
                <div style="height:310px; overflow:auto">
                 <span class="title-red">Empty Wishlist</span>
                </div>
            <?php } ?>
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
</body>
</html>
