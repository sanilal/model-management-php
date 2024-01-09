<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLC Production & Model Management - Shortlist </title>
<meta name="author" content="www.flcmodels.com/cart.php"/>

<meta name="Description" content="FLC Models & Talents provide you with a range of local & international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more Dubai , UAE . Register as Model, register as Cast, egister as Teens, register as Kids in Dubai UAE .Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels."/>

<meta name="Keywords" content="Dubai Modeling Agency, UAE Modeling Agency, register as Model, register as Cast, egister as Teens, register as Kids in Dubai UAE ,Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist "/>
<meta name="rating" content="General"/>

    <?php include_once("includes/head_common.php"); ?>
<style type="text/css">

.contenter a{ color:#E70310}
.water_mark{
	height: 80px; width: 60px;opacity: 0.7;    position: absolute;    z-index: 1;
}
.water_mark > img {bottom: 3px; left: 4px; position: absolute;}
table th{ padding:10px 0px}
table th, table td{ text-align:center}
</style>
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
</head>

<body>  
    
  <div class="container">
   		 <?php include_once("includes/header.php"); ?>
        
    </div>
    
    <!-- Page Content -->
    <div class="container inner_content">
		<div class="punch_cont">
        	<div class="text-left">
                <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
               
                <span>Wishlist</span>
            </div>
        </div>
        <!-- Jumbotron Header -->
        <?php /*?> <header class="hero-spacer" style="margin:15px 0px">
        	<div>
                <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                
                <span class="title-red">Wishlist</span>
            </div>
        </header><?php */?>

       <!-- <hr>-->

        <!-- Title -->
        <div class="row content-main">
        <?php
			session_start();
			if(isset($_SESSION['models'])){
			?>
             <div class="col-sm-12" style="margin-bottom:20px;max-height:500px; overflow:auto">            	
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
                            <tr bgcolor="#E1E1E1">
                            	<td><?php echo $k; $k++; ?></td>
                                <td>
                                	<div style="width:60px; position:relative; min-height:72px">
                                        <?php /*?><div class="water_mark">
                                             <img src="image/flc_mark.jpg" width="15"  />
                                        </div><?php */?>
                                        <img src="<?php echo $img_path; ?>" width="50"  />
                                    </div>
                                </td>
                                <td style="text-align:left"><a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>" target="_blank"> <?php echo $row->First_Name; ?></a></td>
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
                <form action="checkout.php" method="post" onsubmit="return validate(this)">
                	<div class="col-sm-4">
                    
                    	<div class="form-group">
                        	<label for="inputName" class="text-left">Full Name: <sup>*</sup></label>
                            <input type="text" class="form-control" id="inputName" placeholder="Full Name" name="name" required="required"  />
                   		</div>
                        <div class="form-group">
                        	<label for="company" class="text-left">Company: <sup>*</sup></label>
                            <input type="text" class="form-control" id="company" placeholder="Company" name="company" required="required"  />
                   		</div>
                         <div class="form-group">
                        	<label for="remark" class="text-left">Remarks:</label>
                            <textarea class="form-control" id="remark" placeholder="Remarks" name="remarks" ></textarea>
                   		</div>
                                         
                    </div>   
                    <div class="col-sm-4">  
                    	<div class="form-group">
                        	<label for="inputemail" class="text-left">Email: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control" id="inputemail" placeholder="Email"  required="required"  />
                   		</div> 
                        <div class="form-group">
                        	<label for="inputemail" class="text-left">Contact Number: <sup>*</sup></label>
                            <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Contact Number"  required="required"  />
                   		</div> 
                        
                        <div class="form-group">
                        	<label for="address" class="text-left">Address:</label>
                            <textarea class="form-control" id="address" placeholder="Address" name="address" ></textarea>
                   		</div> 
                         
                     </div>  
                     <div class="col-sm-4">  &nbsp;      </div>     
                     <div class="col-sm-12" style="margin-top:15px">
                     <input type="submit" value="Submit Request" style="background:#469E3A; color:#FFF; font-weight:bold"/>               
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
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
