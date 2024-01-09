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
	if(isset($_POST['btnadd'])){
		foreach($_POST['client_select'] as $model){
			$query = "UPDATE `Smart_FLC_job_assign` SET `client_check`='1' WHERE `job_id`=".$job_id." && `model_id`='".$model."'";
			if(mysqli_query($url,$query)){
				$submit=1;
			}
		}
		mysqli_query($url, "UPDATE `Smart_FLC_jobs` SET client_note='".$_POST['notes']."' WHERE job_id=".$job_id);
		$to_email=mysqli_fetch_object(mysqli_query($url,"SELECT user_email FROM `lcfd_users_login` WHERE user_id=".$_POST['booker']));
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
    <link rel="stylesheet" href="../control_panel/https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
.tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px;}
.form-group{ overflow:hidden; font-size:16px; font-weight:bold}
.form-group  label { font-weight:normal; padding-right:10px;}

.multi-item-carousel{
  .carousel-inner{
    > .item{
      transition: 500ms ease-in-out left;
    }
    .active{
      &.left{
        left:-33%;
      }
      &.right{
        left:33%;
      }
    }
    .next{
      left: 33%;
    }
    .prev{
      left: -33%;
    }
    @media all and (transform-3d), (-webkit-transform-3d) {
      > .item{
        // use your favourite prefixer here
        transition: 500ms ease-in-out left;
        transition: 500ms ease-in-out all;
        backface-visibility: visible;
        transform: none!important;
      }
    }
  }
  .carouse-control{
    &.left, &.right{
      background-image: none;
    }
  }
}
</style>
    
  </head>
  

 <?php 
// echo "select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'";
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  //var_dump($job);
  ?>

<body>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin:0 auto; width:70%; background:none">
        <!-- Content Header (Page header) -->
        <div class="row">
       <div class="col-sm-12 logo" style="text-align:center">
    <a href="index.php">
        <img alt="FLC Productions &amp; MODELS MGMT - Logo" title="FLC Model MGMT" src="../images/green/flc-logo_green.png">
    </a>
    
             <div class="logo-caption"> FLC PRODUCTION <br>&amp; MODEL MANAGEMENT</div>
     
    </div>
    </div>

        <!-- Main content -->
        <section>

          <!-- Default box -->
          <div class="box" style="border:0">

      
            
            <div class="box-body">
                  <div class="box-body">
                 
                  
                  	<div class="tab_title">Job information</div>
                    
                    <?php if($submit==1){ ?>
                  <h4 style="color:green">Thank you for your response</h4>
                  <?php } else{ ?>
              <div class="form-group">
                <label for="inputFname" >Job:</label>
                  <?php echo $job->job_title; ?>
                </div>
              
              <div class="form-group">
                <label for="inputEmail3" >Job Details:</label>
                  <?php echo $job->job_desc; ?>
                </div>
              <div class="form-group">
                <label for="inputPhone" >Casting Date:</label>
                
                  <?php echo $job->casting_date; ?>
                </div>
                 <div class="form-group">
                <label for="inputPhone" >Shoot Date:</label>
                
                  <?php echo $job->shoot_date; ?>
                </div>
              <div class="form-group">
                <label for="inputAddress" >Location:</label>
                
                  <?php echo $job->job_location;  ?>
                </div>
                 <form action="" method="post" onSubmit="return validate();" > 
                <div class="form-group">
               		<div class="tab_title" style="text-align:left">Assigned Models </div>
                    <p style="color:red"><b>Please select the models and submit </b></p>
                    <div>
             <ul class="products-list product-list-in-box" id="model_select">
                       	
                       
                    <?php
					$query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$job_id);
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//echo $model->job_assign_status;
					/*if($model->job_assign_status=="Confirmed"){*/
			?>
                    
                   <li class="item">
                              <div class="product-img" >
                                <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>" style="width:auto; height:66px;">
                              </div>
                              <div class="product-info">                               
                               
                                <a href="javascript::;"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></a>  &nbsp;&nbsp;
                                <span class="product-description">
                                  <?php echo $model->Gender; ?>,  <?php echo $model->Nationality; ?>, <?php echo $model->Ethnicity; ?>
                                  <br/>Age: <?php echo $model->Age; ?>
                                </span>
                               
                              </div>
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
                              <div style="clear:both; padding-top:10px;">
                              <span style=""><a href="../profile.php?res_id=<?php echo $model->Resource_ID; ?>" target="_blank" r class="btn btn-default ">View</a></span> &nbsp;&nbsp; <span style="margin-left:10px;"></span>
                              <span class="label <?php echo $st_clss; ?>"> <?php echo $model->job_assign_status; ?></span>
                              <input type="hidden" name="selct_model[]" value="<?php echo $model->Resource_ID; ?>" />
                              <span style="margin-left:10px; padding:5px; background:#00b350">
                              <input type="checkbox" id="check_client<?php echo $model->Resource_ID; ?>" name="client_select[]" <?php if($model->client_check=='1'){ echo 'checked="checked"';} ?> value="<?php echo $model->Resource_ID; ?>" class="foi_check" /> <label for="check_client<?php echo $model->Resource_ID; ?>" style="font-weight:bold; color:#fff;">Select</label>
                              </span>
                              </div>
                            </li>
                    
                      
                    <?php
					/*}*/
					}
				//}
				 ?>                   

                </ul>
               </div> 
                    
               </div>
               <div class="form-group">
               <label>Add Note(Optional)</label>
                      <textarea class="form-control" placeholder="Notes" name="notes" ><?php echo $job->client_note; ?></textarea>
               </div>
               <div class="box-footer">
               <input type="hidden" name="booker" value="<?php echo $job->job_created_by; ?>" />
                    <button type="submit" class="btn btn-primary" name="btnadd">Submit</button>
                  </div>
               </form>
              <?php } ?>
                  </div><!-- /.box-body -->
                  
                
            </div><!-- /.box-body -->
            
           <?php /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
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