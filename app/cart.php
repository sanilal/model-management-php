
<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents - Shortlist </title>
   
   
</head>

<body>
<style type="text/css">
.delete_icon{ color:#e7040d}
.contenter a{ color:#E70310}
.water_mark{
	height: 80px; width: 60px;opacity: 0.7;    position: absolute;    z-index: 0;
}
.water_mark > img {bottom: 3px; left: 4px; position: absolute;}
.water_mark > img{ filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+ */
  filter: gray; /* IE6-9 */
  -webkit-filter: grayscale(100%); /* Chrome 19+ & Safari 6+ */
  -webkit-transition: all .6s ease; /* Fade to color for Chrome and Safari */
  -webkit-backface-visibility: hidden; /* Fix for transition flickering */}
table th{ padding:10px 0px}
table th, table td{ text-align:center}
</style>
<script type="text/javascript">
	function delete_cart(id,obj){
		$.ajax({
			url: "../ajax.php",
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
		if($(obj).find("#inputName").val()=="" || $(obj).find("#inputemail").val()=="" || $(obj).find("#inputPhone").val()=="" ){
			alert("Please fill the mandatory fields!")
			return false
		}
		else if(!pattern.test($(obj).find("#inputemail").val())){
			alert("Please add a valid email address!")
			return false
		}
		else{
			return true;
			$(obj).submit();
		}
		
	}
</script>    
    
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">
		<!-- Jumbotron Header -->
         <header class="hero-spacer" style="margin:15px 0px">
        	<div class="main_title">
                <?php /*?><a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                
                <span class="title-red">Shortlist</span><?php */?>
                Shortlist
            </div>
        </header>

        <div class="row content-main">
        <?php
			session_start();
			if(isset($_SESSION['models'])){
			?>
             <div class="col-sm-12" style="margin-bottom:20px;max-height:500px; overflow:auto">            	
            		<table style="" width="100%" border="0" cellpadding="0" cellspacing="0" class="cart_table">
                	<tr bgcolor="#333333" style="font-size: 13px; font-weight:bold; color:#FFF">
                    	<th colspan="2">Model</th><th>Age</th><th>&nbsp;</th>
                     </tr>
				<?php
						$k=1;
						foreach ($_SESSION['models'] as $model){
							require_once("../classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							$test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  	$img_path=$test_path[0];
							//$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
							$opt_img_path="image.php?img=".$img_path;
							//$img_path="../FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
							if(!file_exists($img_path)) {
								$img_path="../image/model_thumb.jpg";
								$opt_img_path=$img_path;
							}
							?>
                            <tr>
                            	
                                <td>
                                	<div style="width:60px; position:relative; min-height:72px">
                                        <div class="water_mark">
                                             <img src="../images/flc_mark.png" width="20"  />
                                        </div>
                                        <img src="<?php echo $opt_img_path; ?>" width="50"  />
                                    </div>
                                </td>
                                <td style="text-align:left"><a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>" class="catalog_link"> <?php echo $row->First_Name; ?></a></td>
                                <td><?php echo $row->Age; ?></td>
                                <td><a href="javascript:;" class="delete_icon" onclick="delete_cart('<?php echo $row->Resource_ID; ?>',this)" >delete X</a></td>
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
                <div class=" col-sm-12 text-left" style="text-transform:uppercase; font-size:16px">Enter your details</div>
                <form action="checkout.php" method="post" onsubmit="return validate(this)">
                	<div class="col-sm-4">
                    
                    	<div class="form-group">
                        	<?php /*?><label for="inputName" class="text-left">Full Name: <sup>*</sup></label><?php */?>
                            <input type="text" class="form-control" id="inputName" placeholder="Full Name" name="name" required="required"  />
                   		</div>
                        <div class="form-group">
                        	<?php /*?><label for="company" class="text-left">Company: <sup>*</sup></label><?php */?>
                            <input type="text" class="form-control" id="company" placeholder="Company" name="company"   />
                   		</div>
                         <div class="form-group">
                        	<?php /*?><label for="remark" class="text-left">Remarks:</label><?php */?>
                            <textarea class="form-control" id="remark" placeholder="Remarks" name="remarks" ></textarea>
                   		</div>
                                         
                    </div>   
                    <div class="col-sm-4">  
                    	<div class="form-group">
                        	<?php /*?><label for="inputemail" class="text-left">Email: <sup>*</sup></label><?php */?>
                            <input type="email" name="email" class="form-control" id="inputemail" placeholder="Email"  required="required"  />
                   		</div> 
                        
                        <div class="form-group">
                        	<?php /*?><label for="inputemail" class="text-left">Email: <sup>*</sup></label><?php */?>
                            <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Contact Number"  required="required"  />
                   		</div> 
                        
                        <div class="form-group">
                        	<?php /*?><label for="address" class="text-left">Address:</label><?php */?>
                            <textarea class="form-control" id="address" placeholder="Address" name="address" ></textarea>
                   		</div> 
                         
                     </div>  
                     <div class="col-sm-12" style="margin-top:15px">
                     <input type="submit" value="Submit Request" style="background:#469E3A; color:#FFF; font-weight:bold; padding:10px; border:none; border-radius:4px;"/>               
                   	</div>
                   <input type="hidden" name="action" value="checkout"  />
             	</form>
                <?php 
					} 
				 } else{ ?>
            	
                <div style="height:310px; overflow:auto" class="col-sm-12">
                 <span class="title-red">Empty Wishlist</span>
                </div>
            <?php } ?>
            
            
        </div>
       	
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
</body>

</html>
