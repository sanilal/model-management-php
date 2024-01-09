<?php $active="token"; ?>

<?php include_once('includes/header.php'); ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

      <!-- =============================================== -->
<?php
ob_start();
include("includes/conn.php"); 
//
	$query = "SELECT `token_val` FROM `Smart_FLC_tokens` WHERE `token_id`='1' AND `created` > NOW() - INTERVAL 12 HOUR";
		$r = mysqli_fetch_object(mysqli_query($url, $query));
		//var_dump($r->token_val); exit;
		$pass=$r->token_val;
		if($r->token_val==NULL || isset($_POST['submit'])){
				$pwd = bin2hex(openssl_random_pseudo_bytes(4));
				$pass=$pwd;
				$query = "UPDATE `Smart_FLC_tokens` SET `token_val` = '".$pass."',`created`=NOW()  WHERE token_id=1";
				$r = mysqli_query($url, $query) or die(mysqli_error($url));
				if($r){
					  $msg.= "Security Token updated successfully";
				 }
				 else {
					  $error.= "Failed: Error occured";
				 }
			}
		
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
            <div class="box-body">
              
                <div class="form-group">
                      <label> Security Token</label>
                      <input type="text" name="token" value="<?php echo $pass; ?>" required readonly />
                    </div>
            </div><!-- /.box-body -->
            <form action="" method="post">
            <div class="box-footer" >
              <input type="submit" name="submit" value="Generate" class="btn btn-primary" />
            </div><!-- /.box-footer-->
            </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

 <?php include_once('includes/footer.php'); ?>
 </body>
</html>
<?php ob_end_flush(); ?>