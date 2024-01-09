<?php
error_reporting(0);
ob_start();
session_start();
$active="bookers"; 
//echo "ok"; exit;
?>

<?php include_once('includes/header.php');
	if($_SESSION['user_id']!="1"){ 
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
 ?>

      <!-- Left side column. contains the sidebar -->
<?php include_once('includes/side_bar.php'); ?>

<?php  
include("includes/conn.php"); 
//
 if(isset($_REQUEST['btnedit'])){
	 
	$booker=$_POST['full_name'];	
	$id=$_POST['booker_id'];
	$msg=""; $error="";
	if($booker!=""){
		if($_POST['password']==$_POST['conf_password']){
		//
		
		if($_POST['password']=="thannethanne"){ $pass_q=""; }
		else{ $pass_q="`user_pass`='".md5($_POST['password'])."', ";}
		  $cur_date=date("Y-m-d H:i:s");
		  $num=mysqli_num_rows(mysqli_query($url,"SELECT `user_name` FROM `fdl_bookers_gin` WHERE `user_email`='$booker' && user_role=2 && user_id!=".$id));
	  //$num=0;
	  if($num < 1){
		  $query = "UPDATE `fdl_bookers_gin` SET `user_name`='$booker', `user_email`='".$_POST['email']."', ".$pass_q." `user_role`='2', `signature`='".$_POST['sign']."' WHERE user_id=$id && user_role=2";
		  //var_dump($query); exit;
		  $r = mysqli_query($url, $query) or die(mysqli_error($url));
		  if($r){
			
			  $msg.= "Booker Successfully Updated";
		  }
		  else {
			  $error.= "Failed: Error occured";
		  }
	  }
	   else{
			$error.= "Failed: Booker exist already";
		}
	}
	else{ $error.= "Failed: Password and confirm password are incorrect"; }
	}
	else {
			  $error.= "Failed: Fill all the required fields";
		  }
}
?>
  

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Booker info
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="bookers.php" class="btn btn-block"><i class="fa fa-eye"></i>View Bookers</a></li>
          </ol>
        
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">

            <div class="box-header with-border">
              <?php if(isset($msg)){ if($msg!=""){ ?>
              	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
                    
               	</div>
               <?php }} ?> 
               <?php if(isset($error)){ if($error!=""){ ?>
              	<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> <?php echo $error; ?></h4>
                    
               	</div>
               <?php } } ?> 
            </div>
            <?php $booker_data=mysqli_fetch_object(mysqli_query($url,"select * from `".TB_pre."fdl_bookers_gin` WHERE user_role=2 && user_id=".$_GET['booker_id'])); ?>
            
            <div class="box-body">
              <form role="form" method="post"  class="form-horizontal" action="" enctype="multipart/form-data">
                  <div class="box-body">
                  
                  	<div class="form-group">
                      <label>Booker Name</label>
                      <input type="text" class="form-control" placeholder="Booker Name" name="full_name" required value="<?php echo $booker_data->user_name; ?>" />
                    </div>
                    
                    <div class="form-group">
                      <label>Email Id</label>
                       <input type="email" class="form-control" placeholder="Email Id" name="email" required value="<?php echo $booker_data->user_email; ?>" />
                      
                    </div>
                    
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password" required value="thannethanne" />
                    </div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" placeholder="Confirm Password" name="conf_password" required value="thannethanne" />
                    </div>
                    <div class="form-group">
                      <label>Signature</label>
                      <textarea class="form-control" placeholder="Signature" name="sign" id="booker_sign"><?php echo $booker_data->signature; ?></textarea>
                    </div>
                    
                  
                    
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<input type="hidden" name="booker_id" value="<?php echo $_GET['booker_id']; ?>" />
                    <button type="submit" class="btn btn-primary" name="btnedit">Update Booker</button>
                  </div>
                </form>
            </div><!-- /.box-body -->
            
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
<?php include_once('includes/footer-scripts.php'); ?> 
<link type="text/css" href="plugins/datepicker/datepicker3.css" rel="stylesheet" />
<script type="text/javascript" src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('booker_sign');
  });
	
</script>
  <style type="text/css">
  .tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px;}
  </style>  
  </body>
</html>
<?php ob_end_flush(); ?>