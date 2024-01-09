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
	if(isset($_POST['agree'])){
	$query = "UPDATE `Smart_FLC_job_assign` SET `job_agree_status`='".$_POST['agree']."' WHERE `job_id`=".$job_d." && `model_id`='".$model."'";
	//echo $query;
	if(mysqli_query($url,$query)){
		$submit=1;
	}
	}
	//var_dump($submit);
	//exit;
	$to_email=mysqli_fetch_object(mysqli_query($url,"SELECT user_email FROM `lcfd_users_login` WHERE user_id=".$_POST['booker']));
		$to=$to_email->user_email;
		//var_dump($to);
		//$to="smtp@flcmodels.com";
		$from = 'no-reply@flcmodels.com';
		$subject = $_POST['model_name']." has Agreed the job ";
		$en_url=base64_encode("model_id=$model&job_id=$job_d");
		//$en_url=base64_encode("job_id=".$_POST['job_id']);
		$message= '<html>
	   <body bgcolor=\"#DCEEFC\">
	   <h5>'.$_POST['model_name'].' has Agreed the job</h5>
	   <a href="http://flcmodels.com/book_form?q='.$en_url.'" target="_blank">View Book form of the model</a>
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
    <title>Flc Models | Model Booking Form </title>
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
@media print
    {
	.btn{ display:none;}
	}
</style>
    
  </head>
  

 <?php 
// echo "select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'";
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'"));
 $model_res=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$model_id."'"));
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
                 <h4 align="center"><b>MODEL BOOKING FORM </b></h4>
                
                  <?php $cur_date=date("Y-M-d"); ?>
                    
                    <?php if($submit==1){ ?>
                  <h4 style="color:green">Thank you for your response</h4>
                  <?php } else{ ?>
              <div style="text-align:center">
                 <table width="90%" border="1" style="text-align:left">
                     <tr>
                         <td><b>Date:</b> <?php echo $cur_date; ?></td>
                         <td><b>Job Name:</b> <?php echo $job->job_title; ?></td>
                     </tr>
                     <tr>
                         <td><b>Name:</b> <?php echo $model_res->First_Name." ".$model_res->Last_Name;  ?></td>
                         <td><b>Shoot Date:</b> <?php echo $job->shoot_date; ?></td>
                     </tr>
                     <tr>
                         <td><b>Location:</b>  <?php echo $job->job_location;  ?></td>
                         <td><b>Hours/Timings:</b>  </td>
                     </tr>
                     <?php $booker_name=mysqli_fetch_object(mysqli_query($url,"SELECT user_name FROM `lcfd_users_login` WHERE user_id=".$job->job_created_by)); ?>
                     <tr>
                         <td><b>Contact Person:</b>  <?php echo $booker_name->user_name; ?> </td>
                          <?php $agree_check=mysqli_fetch_object(mysqli_query($url,"SELECT job_agree_status,budget FROM `Smart_FLC_job_assign` WHERE model_id='".$model_id."' && job_id=".$job_id)); //var_dump($agree_check); ?>
                         <td><b>Budget:</b><?php echo $agree_check->budget; ?> </td>
                     </tr>
                     <tr>
                     <td colspan="2"><b>Usages:</b> </td>
                     </tr>
                 </table>
                 </div>
                 <div style="clear:both"></div>
                 <p>
                 	<b>Job Details:</b> <?php echo $job->job_desc; ?> 
                 </p>
                 <p>
                 	<b>Punctuality:</b> Should you foresee you will be late in arriving to the pickup point/ 
Venue you are requested to call minimum 4 hours in advance  
                 </p>
                 <p>
                 	<b>Regulations:</b> No smoking/ No drinking (unless stated otherwise)  
                 </p>
                 <p>
                 	<b>Conditions:</b> Remember you are representing FLC Production & Model Management 
and the client at all times whilst on the job any forms or complaints of misconduct will 
lead to a warning from the agency, should the clients dismiss you will lead to 
nonpayment .  <br/>
As per agency policy payments is after client pays (up to 30 days). A no show it will 
lead to full nonpayment and canvassing the clients for future jobs will lead to you 
being taken of the books immediately. <br/> 
If you are having problems with the client please contact FLC Production & Model 
Management. <br/>
Please be aware that any kind of budget discussion with the client or other models is 
strictly prohibited.   <br/>
 
I hereby confirm that I have read, understood and accepted the terms and conditions 
provided by FLC Production & Model Management, with regards to taking on an 
assignment. <br/>
 
I hereby authorize FLC Production & Model Management and their clients to use 
film/photographers containing my likeness for the use of the above description. I 
understand that such a copyright material shall be deemed to represent any 
imaginary person unless agreed in writing by mu agent or by myself. 
I understand that the compensation received will be accepted as full and final 
payment for my services rendered and rights granted herein and I will not receive 
further compensation in connection with this production. I hereby waive any right to 
use of my likeness. <br/>
In connection therewith, I hereby release FLC Production & Model Management and 
their clients from all liability.  
                 </p>
                  <p>
                 	<b>Note:</b>  Enjoy yourself; be professional as you are representing yourself and FLC 
Models 
                 </p>
                <form action="" method="post" id="job_form"> 
                
             <div class="form-group">
            
              <input type="checkbox" name="agree" value="1" id="agree_check" <?php if($agree_check->job_agree_status==1){ echo 'checked="checked"';} ?> /> &nbsp;<label for="agree_check">I Agree terms and conditions and accept the job</label>
              
              <input type="hidden" name="model_id" id="model_id" value="<?php echo $model_id ?>" />
              <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" />
              <input type="hidden" name="model_name" value="<?php echo $model_res->First_Name." ".$model_res->Last_Name;  ?>" />
              <input type="hidden" name="booker" value="<?php echo $job->job_created_by; ?>" />
              
              </div>
              <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
              &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onClick="window.print()"class="btn btn-warning">Print this page</button>
              </div>
               </form>
               <table width="90%" style="text-align:left">
               <tr>
               	<td><b>Name:</b> <?php echo $model_res->First_Name." ".$model_res->Last_Name;  ?></td>
               	<td><b>Signature:</b> </td>
               </tr>
               </table>
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