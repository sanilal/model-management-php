<?php
error_reporting(0);
ob_start();
session_start();

 $active="home"; ?>

<?php include_once('includes/header.php');
if($_SESSION['user_role']==2){
	header("Location: dashboard.php");
	echo "<script type='text/javascript'>window.top.location='dashboard.php';</script>";
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
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Home
            <small>it all starts here</small>
          </h1>
         
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Welcome <?php echo $_SESSION['user_name']; ?></h3>
              
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
              
            </div><!-- /.box-body -->
            <div class="box-footer">
              
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

 <?php include_once('includes/footer.php'); ?>
 </body>
</html>
<?php ob_end_flush(); ?>