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
<title>FLC - Shortlist</title>

<style type="text/css">

.content{ min-height:581px; width:79%; margin:0 auto;}
.contenter a{ text-decoration:none}
.cart_table td, .cart_table th{text-align:center; padding:4px 0px}
.delete_icon { color:#E70312; text-decoration:none}
.water_mark{ width:60px; height:80px; font-size:12px;}
.water_mark > b{ bottom:3px; z-index:0; }
input.required{ width:200px}
textarea{ width:200px; height:80px}
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


<script type="text/javascript">
	function delete_cart(id,obj){
		$.ajax({
			url: "ajax.php",
			type: "post",
			data:  {deldata: "cart",item_id:id },
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
</script>

</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="container">

<div class="punch_cont">
        	<div class="text-left">
                Wishlist
            </div>
        </div>

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          
            <td>
            <?php
			session_start();
			if(isset($_SESSION['models_man'])){
			?>
            <form action="checkout.php" method="post">
                <div style="max-height:600px; overflow:auto">
            	<table  width="100%" border="0" cellpadding="0" cellspacing="0" class="cart_table">
                	<tr bgcolor="#333333" style="font-size: 13px; font-weight:bold; color:#FFF">
                    	<th>Sl.No</th><th colspan="2">Model</th><th>Age</th><th>&nbsp;</th>
                     </tr>
				<?php
						$k=1;
						foreach ($_SESSION['models_man'] as $model){
							require_once("../classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							$test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
							//$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
							//$img_path="../../FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
							if(!file_exists($img_path)) {
								$img_path="../image/model_thumb.jpg";
							}
							?>
                            <tr bgcolor="#E1E1E1" style="border:2px solid #5A5858">
                            	<td><?php echo $k; $k++; ?></td>
                                <td>
                                	<div style="width:60px; position:relative; min-height:72px">
                                        
                                       <img src="<?php echo $img_path; ?>" width="50"  />
                                    </div>
                                	
                                
                                </td>
                                <td> <?php echo $row->First_Name; ?></td>
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
                <?php if(sizeof($_SESSION['models_man'])>0){ ?>
                    <div style="padding-top:13px">
                    	 <table width="100%">
                         	<tr class="bodyfont">
                                <td>Subject: </td>
                                <td><input type="text" name="subject" required="required"  class="required" style="width:300px" />
                                
                                </td>
                            </tr>
                            <tr class="bodyfont">
                                <td>To: </td>
                                <td><input type="text" name="to_email" required="required"  class="required" style="width:300px" />
                                	<br />
                                    <span style="color:#666666">(Add multiple emails seperated by comma)</span>
                                
                                </td>
                            </tr>
                            <tr class="bodyfont">
                                <td>CC: </td>
                                <td><input type="text" name="cc_email" class="" style="width:300px" />
                                	<br />
                                    <span style=" color:#666666">(Add multiple emails seperated by comma)</span>
                                
                                </td>
                            </tr>
                            <tr class="bodyfont">
                                <td> Message:</td><td><textarea name="remarks" style="width:400px; height:300px"></textarea></td>
                                
                            </tr>
                            
                        </table>        
                        <input type="submit" value="Send" style="background:#469E3A; color:#FFF; font-weight:bold"/>               
                    </div>
                <?php } ?>
                    
                <input type="hidden" name="action" value="checkout"  />
             </form>
            <?php } else{ ?>
            	<h3 style=""> Wishlist</h3>
                <div style="height:310px; overflow:auto">
                    <table style="" width="100%" border="0" cellpadding="0" cellspacing="0" class="cart_table">
                        <tr bgcolor="#333333" style="font-size: 13px; font-weight:bold; color:#FFF">
                            <th align="center">Empty Wishlist</th>
                        </tr>
                    </table>
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
<?php 
	}
	else {
    	header("Location:../login.php");
	}
    
} else {
    header("Location:../login.php");
}
 ?>