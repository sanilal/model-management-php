<?php
error_reporting(0);
ob_start();
session_start();
 $active="bookers"; ?>
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
//ob_start();
include("includes/conn.php"); 
if(isset($_GET['remove_pr'])){
	$id = $_GET['remove_pr'];
	$query = "DELETE FROM `".TB_pre."fdl_bookers_gin` WHERE `user_id`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	
	if($r){
		$msg = "The selected booker deleted successfully.";
	}
}
$sql="select * from `".TB_pre."fdl_bookers_gin` WHERE user_role=2 ORDER BY user_id DESC ";
$r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));
?>  

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            bookers
            <small></small>
          </h1>
          
          <ol class="breadcrumb" >
            <li><a href="add-booker.php" class="btn btn-block"><i class="fa fa-plus"></i> Add new Booker</a></li>
          </ol>
          
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bookers List</h3> 
              <?php if(isset($msg)){ ?>
              	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
               	</div>
               <?php } ?> 
            </div>
            
            <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <tr>
                      <th>Sl. No</th>
                      	<th>Booker Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                      </tr>
                    </thead>
                     <tbody>
                    <?php 
					$i = 1;
					while($res = mysqli_fetch_array($r1)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $res['user_name']; ?></td>
                        <td><?php echo $res['user_email']; ?></td>
                         
                        <td>
                        <a href="edit-booker.php?booker_id=<?php echo $res['user_id']; ?>" class="btn">Edit</a> &nbsp; &nbsp; 
                        <a href="javascript:removeItem(<?php echo $res['user_id']; ?>);" class="btn btn-danger">Remove</a>
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  
                    <tfoot>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

     
      <!-- Control Sidebar -->


	<?php include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
   <?php include_once('includes/footer-scripts.php'); ?>
    
    
    <link rel="stylesheet" href="dist/css/bootstrap-dialog.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css" type="text/css" />
     <script src="dist/js/bootstrap-dialog.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
      $(function () {
        $('#example2').DataTable({
          "paging": true,
		   "pageLength": 20,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script type="text/javascript">
    function removeItem(id){
		var c= confirm("Do you want to remove this booker?");
		if(c){
			location = "bookers.php?remove_pr="+id;
		}
	}
	
    </script>
  </body>
</html>
<?php ob_end_flush(); ?>