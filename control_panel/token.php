<?php
error_reporting(0);
ob_start();
session_start();
 $active="token"; ?>

<?php include_once('includes/header.php');

if($_SESSION['user_id']!="1"){ 
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
 ?>


      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

      <!-- =============================================== -->
<?php
ob_start();
include("includes/conn.php"); 
//
	$token_data = mysqli_fetch_object(mysqli_query($url,"SELECT * FROM `Smart_FLC_tokens` WHERE `token_id`='1'"));
	$r = mysqli_fetch_object(mysqli_query($url, "SELECT `token_val` FROM `Smart_FLC_tokens` WHERE `token_id`='1' AND `created` > NOW() - INTERVAL ".$token_data->valid_hours." HOUR"));
	//var_dump($r->token_val); exit;
	$pass=$r->token_val;
	if($r->token_val==NULL || isset($_POST['token'])){
			$pwd = bin2hex(openssl_random_pseudo_bytes(4));
			$pass=$pwd;
			$hours=$token_data->valid_hours; $status=$token_data->token_status;
			if(isset($_POST['token'])){
				$pass=$_POST['token'];
				$hours=$_POST['valid_hours'];
				$status=$_POST['token_status'];
			}
 			$query = "UPDATE `Smart_FLC_tokens` SET `token_val` = '".$pass."',`created`=NOW(),`valid_hours`=$hours,`token_status`=$status  WHERE token_id=1";
			$r = mysqli_query($url, $query) or die(mysqli_error($url));
			if($r){
				  $msg.= "Security Token settings updated successfully";
			 }
			 else {
				  $error.= "Failed: Error occured";
			 }
		}
		if(isset($_POST['submit-new'])){
			$pwd = bin2hex(openssl_random_pseudo_bytes(4));
			$pass=$pwd;
			$query = "UPDATE `Smart_FLC_tokens` SET `token_val` = '".$pass."' WHERE token_id=1";
			$r = mysqli_query($url, $query) or die(mysqli_error($url));
			if($r){
				  $msg.= "Security Token generated successfully";
			 }
			 else {
				  $error.= "Failed: Error occured";
			 }
		}
		$token_data = mysqli_fetch_object(mysqli_query($url,"SELECT * FROM `Smart_FLC_tokens` WHERE `token_id`='1'"));
//
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Login Token
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Current Security Token</h3>
              
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
            <form action="" method="post">
            <div class="box-body">
                <div class="form-group">
                      <label> Security Token</label> &nbsp; &nbsp;
                      <input type="text" name="token" value="<?php echo $pass; ?>" required readonly />
                </div>
                <div class="form-group">
                      <label>Token Valiidity in hours</label> &nbsp; &nbsp;
                      <input type="number" name="valid_hours" value="<?php echo $token_data->valid_hours; ?>" required />
                </div>
                <div class="form-group">
                      <label>Token Status</label> &nbsp; &nbsp;
                     <select name="token_status">
                     	<option value="1" <?php if($token_data->token_status==1){ echo 'selected="selected"';} ?>>Enabled</option>
                     	<option value="0" <?php if($token_data->token_status==0){ echo 'selected="selected"';} ?>>Disabled</option>
                     </select>
                </div>
            </div><!-- /.box-body -->
            
            <div class="box-footer" >
              <input type="submit" name="submit" value="Submit" class="btn btn-primary" /> 
            </div><!-- /.box-footer-->
            </form>
            <form action="" method="post">
            <div class="box-footer" >
              <input type="submit" name="submit-new" value="New Token" class="btn btn-primary" /> 
            </div>
            </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

 <?php include_once('includes/footer.php'); ?>
 </body>
</html>
<?php ob_end_flush(); ?>