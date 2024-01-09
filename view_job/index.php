<?php
error_reporting(0);
ob_start();
require_once("../control_panel/includes/conn.php"); 
//var_dump($_SESSION['user_id']);

//$_GET['q']=base64_encode("model_id=F001&job_id=4");
//var_dump($_GET['q']);
$submit=0;


$url_link=base64_decode($_GET['q']);
//var_dump($url);
parse_str($url_link, $vals);
//var_dump( $vals); //exit;
//echo $_SERVER['REQUEST_URI']; $job_id=4;
$job_id=$vals['job_id'];
if($job_id!=""){
	$job_id=mysqli_real_escape_string($url,$job_id);
	if(isset($_POST['btnadd'])){
		
		foreach($_POST['client_select'] as $model){
			$model=mysqli_real_escape_string($url,$model);
			$query = "UPDATE `Smart_FLC_job_assign` SET `client_check`='1' WHERE `job_id`='".$job_id."' && `model_id`='".$model."'";
			if(mysqli_query($url,$query)){
				$submit=1;
			}
		}
		mysqli_query($url, "UPDATE `Smart_FLC_jobs` SET client_note='".mysqli_real_escape_string($url,$_POST['notes'])."' WHERE job_id='".$job_id."'");
		$to_email=mysqli_fetch_object(mysqli_query($url,"SELECT user_email FROM `fdl_bookers_gin` WHERE user_id=".mysqli_real_escape_string($url,$_POST['booker'])));
		$to=$to_email->user_email;
		//var_dump($to);
		//$to="smtp@flcmodels.com";
		$from = 'no-reply@flcmodels.com';
		$subject = "Client responded to the job";
		$message= '<html>
	   <body bgcolor=\"#DCEEFC\">
	   <h5>Client responded to the job</h5>
	   <p>'.$_POST['notes'].'</p>
	   <a href="http://flcmodels.com/view_job?q='.$_GET['q'].'" target="_blank">View Job</a>
	   </body>
	   </html>';
	   $headers  = "MIME-Version:1.0 \r\n";
	  	$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	  	$headers  .= "From: $from\r\n";
		mail($to,$subject,$message,$headers);
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Flc Models | View Job </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../control_panel/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../control_panel/dist/css/ionicons.min.css">
     <link rel="stylesheet" href="../control_panel/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../control_panel/dist/css/skins/_all-skins.min.css">
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<style type="text/css">
table {
    table-layout:fixed;
    width:100%;
	background:#f1eee7; color:#585858;
}
table img {
	width:100%;
}
table td{ padding:5px; font-size:14px; position:relative;}
.other_thumbs .thumb_div{ height:220px; overflow:hidden}
.other_thumbs .thumb_div > img{ min-height:220px; max-height:260px; width:auto; max-width:190px;}

@media print
    {
	.no-print{ display:none;}
	
	}
	
	.absl_div { z-index:10; position:absolute; height:100%; width:100%; top:0; }
	.absl_div img{position: absolute; opacity: 0.5;
filter: alpha(opacity=50);
left: 33%;
bottom: 2%;
width: 30%;}
</style>
    
  </head>
  

 <?php 
// echo "select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'";
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  //var_dump($job);
  ?>

<body style=" background:#000; background-size:contain; width:900px; margin:0 auto;">
    <div style="width:100%; text-align:center;">
        <img src="images/flc-bg.jpg" width="100%" />
    </div>
    <div style="width:100%; height:700px; padding-top:130px; background:url(images/flc-bg.jpg) center center no-repeat;">
     <div class="logo-caption" style="font-size:45px; width:100%; padding:10px; background:#00b350; color:#fff; text-align:center; margin:150px 0;"> FLC PRODUCTION &amp; MODEL MANAGEMENT</div>
     </div>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin:0 auto; width:900px; background:none;">
      <button type="button" onClick="window.location.href='print.php?q=<?php echo $_GET['q']; ?>'"class="btn btn-warning no-print">Save page</button>
        <!-- Content Header (Page header) -->
        <?php /*?><div class="row">
       <div class="col-sm-12 logo" style="text-align:center">
    <a href="index.php">
        <img alt="FLC Productions &amp; MODELS MGMT - Logo" title="FLC Model MGMT" src="../images/green/flc-logo_green.png">
    </a>
    
            
     
    </div>
    </div><?php */?>



      
            
                 
                  
                    
                    <?php if($submit==1){ ?>
                    <div style="background:#f1eee7; color:#585858; margin:10px 0; padding:10px; text-align:center" class="no-print">
                  <h4 style="color:green; font-size:20px;">Thank you for your response</h4>
                  </div>
                  <?php }  ?>
           
                 <form action="" method="post" onSubmit="return validate();" > 
                 <div style="background:#f1eee7; color:#585858; margin:10px 0; padding:10px; text-align:center" class="no-print">
                    <p style="color:red"><b>Please select the models and submit </b></p>
                 </div>
                 
                    
                     <?php
					 
			$cat_rext_arr=explode(":;",$job->model_cats); 
			 $cat_id=0;
			 foreach($cat_rext_arr as $cat_text){
				 $query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id='".$job_id."' && model_cat='".$cat_id."'");
				 if(mysqli_num_rows($query)>0){
				 ?>
                 
                   <div style="background:#00b350; color:#fff; margin:20px 0 0 0; padding:10px; text-align:center; font-size:18px; font-weight:bold;" >
                    <p>Category: <b><?php echo $cat_text ?> </b></p>
                 </div>
                 <div style="background:#f1eee7; padding:20px;">
                 <?php
					 
					
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//echo $model->job_assign_status;
					/*if($model->job_assign_status=="Confirmed"){*/
			?>
                    <table width="100%" style=" border-bottom:1px solid #B6B6B6">
                    <tr>
                    	<td width="34%"></td>
                    	<td width="66%">
                        	<table>
                        		<tr>
                                <td align="left"><?php echo $model->First_Name; ?></td>
                        		<td align="right"><?php echo $model->Resource_ID; ?></td>
                                </tr>
                        	</table>
                        </td>
                    </tr>
                    
                        <tr>
                            <td style="overflow:hidden">
                                <img src="<?php echo  $all_imgs[0]; ?>" style="height:452px; width:auto;" />
                                <div class="absl_div"> 
                            	<img alt="FLC Models &amp; Talents"  src="../images/flc_mark.png"  />
                            </div>
                            </td>
                            <td>
                                <table class="other_thumbs">
                                	<tr>
                                    	<td><div class="thumb_div">
                                        		<div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="../images/flc_mark.png" > 
                                      			</div>
                                      		<img src="<?php echo  $all_imgs[1]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="../images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[2]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="../images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[3]; ?>" /></div></td>
                                    </tr>
                                    <tr>
                                    	<td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="../images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[4]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="../images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[5]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="../images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[6]; ?>" /></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                        	<td></td>
                        	<td>
                            	<table>
                                	<tr>
                                    	<td>Height: <?php echo $model->Height; ?></td>
                                        <td>Bust: <?php echo $model->Bust; ?></td>
                                        <td>Waist: <?php echo $model->Waist; ?></td>
                                        <td>Hips: <?php echo $model->Hips; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Eyes: <?php echo $model->EyesColor; ?></td>
                                        <td>Hair: <?php echo $model->HairColor; ?></td>
                                        <td>Shoes: <?php echo $model->ShoesSize; ?></td>
                                        <td>Skin: <?php echo $model->SkinColor; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <tr class="no-print">
                    	<td>
                    		<a href="../profile.php?res_id=<?php echo $model->Resource_ID; ?>" target="_blank" r class="btn btn-default ">View Profile</a>
                    	</td>
                        <td>
                        <?php
							  $st_clss="label-warning";
							  	switch($model->job_assign_status) {
								  case 'Confirmed':
								 $st_clss='label-success';
									break;
								  case 'Rejected':
								$st_clss='label-danger';
									break;
								}
							  ?>
                        <span class="label <?php echo $st_clss; ?>" style="font-size:14px; padding:5px; border-radius:0"> <?php echo $model->job_assign_status; ?></span>
                              <input type="hidden" name="selct_model[]" value="<?php echo $model->Resource_ID; ?>" />
                              <span style="margin-left:10px; padding:5px; background:#00b350">
                              <input type="checkbox" id="check_client<?php echo $model->Resource_ID; ?>" name="client_select[]" <?php if($model->client_check=='1'){ echo 'checked="checked"';} ?> value="<?php echo $model->Resource_ID; ?>" class="foi_check" /> <label for="check_client<?php echo $model->Resource_ID; ?>" style="font-weight:bold; color:#fff;">Select</label>
                              </span>
                        </td>
                    </tr>
                    </table>
                 <?php }   ?> </div> <?php } $cat_id++; } ?>
           
               <div style="background:#f1eee7; color:#585858; margin:10px 0; padding:10px;" class="no-print">
                   <div class="form-group" >
                   <label>Add Note(Optional)</label>
                          <textarea class="form-control" placeholder="Notes" name="notes" ><?php echo $job->client_note; ?></textarea>
                   </div>
                   <div>
                   		<input type="hidden" name="booker" value="<?php echo $job->job_created_by; ?>" />
                        <button type="submit" class="btn btn-primary" name="btnadd">Submit</button>
                    </div>
                </div>
               </form>
                  
                
            
           <?php /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>

      </div><!-- /.content-wrapper -->
      <div style="width:100%; text-align:center;">
<img src="images/flc-footer.jpg" width="100%" />
</div>
      <script src="../control_panel/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script type="text/javascript" >
      	function validate(){
			var check_foi=0;
			 $('.foi_check').each(function () {
				if ($(this).is(':checked')) {
				  check_foi=1;
				  // Stop .each from processing any more items
				  return false;
				}
			  });
			  if(check_foi==1){ return true;}
			  alert("Please select atleast one model to submit");
			  return false;
		}
      </script>
</body>
<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
</html>
    
  
<?php } ob_end_flush(); ?>