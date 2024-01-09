<?php
error_reporting(0);
ob_start();
require_once("../control_panel/includes/conn.php"); 
//var_dump($_SESSION['user_id']);

//$_GET['q']=base64_encode("model_id=F001&job_id=4");
//var_dump($_GET['q']);
$submit=0;
if(isset($_POST['job_id'])){
	$model=$_POST['model_id'];
	$job_d=$_POST['job_id'];
	$query = "UPDATE `Smart_FLC_job_assign` SET `job_assign_status`='".$_POST['status']."' WHERE `job_id`=".$job_d." && `model_id`='".$model."'";
	//echo $query;
	if(mysqli_query($url,$query)){
		$submit=1;
	}
	//var_dump($submit);
	//exit;
	$to_email=mysqli_fetch_object(mysqli_query($url,"SELECT user_email FROM `lcfd_users_login` WHERE user_id=".$_POST['booker']));
		$to=$to_email->user_email;
		//var_dump($to);
		//$to="smtp@flcmodels.com";
		$from = 'no-reply@flcmodels.com';
		$subject = "Model ".$_POST['status']." the job Offer";
		$en_url=base64_encode("job_id=".$_POST['job_id']);
		$message= '<html>
	   <body bgcolor=\"#DCEEFC\">
	   <h5>Model '.$_POST['status'].' the job Offer</h5>
	   <a href="http://flcmodels.com/view_job?q='.$en_url.'" target="_blank">View Job</a>
	   </body>
	   </html>';
	   $headers  = "MIME-Version:1.0 \r\n";
	  	$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	  	$headers  .= "From: $from\r\n";
		mail($to,$subject,$message,$headers);
}


$url_link=base64_decode($_GET['q']);
//var_dump($url);
parse_str($url_link, $vals);
//var_dump( $vals); //exit;
//echo $_SERVER['REQUEST_URI']; $job_id=4;
$job_id=$vals['job_id']; $model_id=$vals['model_id'];
if($job_id!="" && $model_id!=""){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Flc Models | Job Confirm </title>
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
                 <div class="form-group">
                  <?php
					$ja_query=mysqli_fetch_object(mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` WHERE `model_id`='".$model_id."' && job_id=".$job_id));
					?>
                <label for="inputAddress" >Budget:</label>
                
                  <?php echo $ja_query->budget;  ?>
                </div>
                <form action="" method="post" id="job_form"> 
             <div class="form-group">
              <button type="button" class="btn btn-success" name="btnadd" onClick="confirm_offer('Confirmed')">Confirm Offer</button> &nbsp;&nbsp;&nbsp;&nbsp; 
              <button type="button" class="btn btn-danger" name="btnadd" onClick="confirm_offer('Rejected')">Reject Offer</button>
              <input type="hidden" name="model_id" id="model_id" value="<?php echo $model_id ?>" />
              <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" />
              <input type="hidden" name="status" value="" id="job_status" />
              <input type="hidden" name="booker" value="<?php echo $job->job_created_by; ?>" />
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
      	function confirm_offer(obj){
			$("#job_status").val(obj);
			$("#job_form").submit();
		}
      </script>
</body>
<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
</html>
    
  
<?php } ob_end_flush(); ?>