<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
 <title>FLC Production & Model Management Wishlist - Dubai Models , Model Agency Dubai  , FLC Models & Talents</title>
	<?php include_once('md_includes/head.php'); ?>
</head>

  <body>
    
    <?php include_once('md_includes/header.php'); ?>
        
       
   <section class="aboutWraper">
       	  <img src="assets/images/shortlist.jpg" class="img-fluid" alt=""/>
          <h2 class="white">Submit the Wishlist</h2> 
          
          <div class="container mt-5">
          	<div class="row">
               <div class="col-12 mt-2"> 
               <h3>Shortlist</h3>
               <?php
					  if(isset($_SESSION['models'])){
						  //var_dump($_SESSION['models']);
						  if(!empty($_SESSION['models'])){
				?>
               <p>Fill the below form to submit the Shortlist</p>
               
                	<table id="wishlist">
                      <tr>
                        <th>SI. No.</th>
                        <th>&nbsp;</th>
                        <th>Model</th>
                        <th>Age</th>
                        <th>&nbsp;</th>
                      </tr>
                      <?php
						$k=1;
						foreach ($_SESSION['models'] as $model){
							require_once(MN_url."classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							$test_path=glob(MN_url.image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  	$img_path=$test_path[0];
							if(!file_exists($img_path)) {
								$img_path=MN_url."image/model_thumb.jpg";
							}
					?>
                      <tr>
                        <td><?php echo $k; $k++; ?></td>
                        <td><img src="<?php echo $img_path; ?>" style="width:80px; height: auto;" alt=""/></td>
                        <td><a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>" target="_blank"><?php echo $row->First_Name.' '.$row->Last_Name; ?></a></td>
                        <td><?php echo $row->Age; ?></td>
                        <td><a href="javascript:;" onclick="delete_cart('<?php echo $row->Resource_ID; ?>',this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                      </tr>
                     <?php } ?>
                        
				</table>
                <?php if($k > 1){ ?>
                <div class="enqform">
                <h3>Enter your details and submit</h3>
                	<form action="<?php echo MN_url; ?>checkout.php" method="post" onsubmit="return validate(this)">
                    	<input type="text" id="inputName" placeholder="Full Name" name="name" required="required" />
                        <input type="email" name="email" id="inputemail" placeholder="Email"  required="required" />
                        <input type="text" id="company" placeholder="Company" name="company" required="required" />
                        <input type="text" name="phone" id="inputPhone" placeholder="Contact Number"  required="required" />
                        <textarea id="remark" placeholder="Remarks" name="remarks" ></textarea>
                        <textarea id="address" placeholder="Address" name="address" ></textarea>
                        <input type="hidden" name="action" value="checkout"  />
                        <input type="submit" value="Submit" />
                    </form>
                </div>
                <?php
				}
				}else{ ?> 
                <div> Empty Shortlist </div>
                <?php } 
				}else{ ?> 
                <div> Empty Shortlist </div>
                <?php } ?>
                </div>
                
            </div>
          </div>
   </section>

  
  <?php include_once('md_includes/footer.php'); ?>
  <script type="text/javascript">
	function delete_cart(id,obj){
		var conf=confirm("Are you sure you want to delete the item");
		if(conf){
			$.ajax({
				url: "<?php echo MN_url; ?>ajax.php",
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
  </body>
</html>