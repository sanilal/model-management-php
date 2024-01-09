<?php
error_reporting(0);
ob_start();
session_start();
 $active="model"; ?>
<?php include_once('includes/header.php'); ?>

 <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

<?php  
//ob_start();
include("includes/conn.php"); 

if(isset($_GET['p_id']) && isset($_GET['status']) ){
	$id = $_GET['p_id'];
	$status = $_GET['status'];
	$query = "UPDATE `".TB_pre."products` set status='$status' WHERE `product_id`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	if($r){
		$msg = "Status updated Successfully.";
	}
}

if(isset($_GET['remove_res'])){
	$id = $_GET['remove_res'];
	$pr_img_res=mysqli_fetch_object(mysqli_query($url,"select images from `Smart_FLC_mail_Details` WHERE `Mailer_ID`='$id'"));
	$query = "DELETE FROM `Smart_FLC_mail_Details` WHERE `Mailer_ID`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	//unlink( "uploads/".$pr_img_res->product_img);
	$g_imgs=explode(",",$pr_img_res->images);
	foreach($g_imgs as $g_img){
		unlink( "../".$g_img);
	}
	if($r){
		$msg = "The selected model deleted successfully.";
	}
}
//$sql="select * from `".TB_pre."Smart_FLC_Resource_Details` ORDER BY First_Name LIMIT 100 ";
//$r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));

?>  

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Models & Talents Requests
            <small></small>
          </h1>
          
          <ol class="breadcrumb" style="display:none">
            <li><a href="add-model.php" class="btn btn-block"><i class="fa fa-plus"></i> Add new Model</a></li>
          </ol>
          
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List - Models Requests</h3> 
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
                      	<th>Id</th>
                      	<th>Image</th>
                        <th>Model</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                   
                    <tfoot>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

     <div style="height:0;"><img src="../images/loader.gif" style="visibility:hidden" /></div>
      <!-- Control Sidebar -->


	<?php include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
   <?php include_once('includes/footer-scripts.php'); ?>
    <link rel="stylesheet" href="dist/css/bootstrap-dialog.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css" type="text/css" />
    <link rel="stylesheet" href="plugins/img_crop/jquery.Jcrop.css" type="text/css" />
     <script src="dist/js/bootstrap-dialog.min.js"></script>
     <script src="plugins/img_crop/jquery.Jcrop.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
    <!-- AdminLTE for demo purposes -->
     <script>
	 var data_url="";
      $(function () {
        $('#example2').DataTable({
          "pageLength": 50,
         "fixedHeader" : {
                    header : true,
                    footer : true
                },
		  "processing": true,
        "serverSide": true,
		"order": [[ 0, "desc" ]],
		"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            }
        ],
		   "ajax": 'ajax/mail_models.php'
		   <?php /*?>"columns": [
            { "data": "Resource_ID" },
            { "data": "name" },
            { "data": "image" },
            { "data": "category" },
            { "data": "status" },
            { "data": "action" }
        ]<?php */?>
		  });
      });
	  function view_model(obj){
		  var id=$(obj).attr('ref');
		  data_url='view_mail_model.php?m_id='+id;
		BootstrapDialog.show({
			type:'type-default',
			title: 'Model Complete Details',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load(data_url),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	}
	
	function crop_img(obj){
		var id=$(obj).attr('rel');
		var img_src=$(obj).prev().attr('src');
		BootstrapDialog.show({
			type:'type-default',
			title: 'Crop Image',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('crop_image.php?m_id='+id+'&img='+img_src),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	}
	function dialog_reload(){
		BootstrapDialog.closeAll();
		BootstrapDialog.show({
			type:'type-default',
			title: 'Model Complete Details',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load(data_url),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	}
    </script>
    <script type="text/javascript">
    function removeItem(id){
		var c= confirm("Do you want to remove this item?");
		if(c){
			location = "mail_models.php?remove_res="+id;
		}
	}
	
    </script>
  </body>
</html>
<?php ob_end_flush(); ?>