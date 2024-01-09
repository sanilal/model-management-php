<?php $active="sheets"; //echo phpinfo(); ?>
<?php include_once('includes/header.php'); ?>

 <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

<?php  
//ob_start();
include("includes/conn.php"); 

if(isset($_GET['remove_job'])){
	$id = $_GET['remove_job'];
	$query = "DELETE FROM `Smart_FLC_jobs` WHERE `job_id`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	
	if($r){
		mysqli_query($url, "DELETE FROM `Smart_FLC_job_assign` WHERE `job_id`='$id'");
		$msg = "The selected job deleted successfully.";
	}
}
if(isset($_POST['job_id'])){
	$from = 'no-reply@flcmodels.com';
	$subject = "Job Offer from Flcmodels";
	$insertid=$_POST['job_id'];
	$job_res=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE job_id=".$insertid));
	$ja_query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$insertid);
	$mail_check=0;
	
	//
	require("class.phpmailer.php");
	  $mail = new PHPMailer();
	  $mail->IsSMTP();                                      // set mailer to use SMTP
	  $mail->Host = "mailout.one.com";  // specify main and backup server
	  $mail->Port = 25; 
	  $mail->SMTPAuth = true;     // turn on SMTP authentication
	  $mail->Username = "smtp@flcmodels.com";  // SMTP username
	  $mail->Password = "NLQ-QV2-ZpY-zVK"; // SMTP password
	  
	  $mail->From = "smtp@flcmodels.com";
	  $mail->FromName = "Flcmodels";
	   $mail->AddReplyTo("no-reply@flcmodels.com", "Flcmodels");
	  
	  //$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	  $mail->IsHTML(true);      
	//
	
	while($model=mysqli_fetch_object($ja_query)){
		$to="";
		if($model->Email1!="" || $model->Email1!=NULL){$to=$model->Email1;}
		else if($model->Email2!="" || $model->Email2!=NULL){$to=$model->Email2;}
		else if($model->Email3!="" || $model->Email3!=NULL){$to=$model->Email3;}
		//var_dump($to);
		//var_dump($model); exit;
		$to="augustianjoseph@gmail.com";
	if($to!=""){
		$model_id=$model->Resource_ID;
	$en_url=base64_encode("model_id=$model_id&job_id=$insertid");
	$message= '<html>
	   <body bgcolor=\"#DCEEFC\"> 
	   <table>
		  <tr>
			  <th colspan="2"><u>Job Details</u></th>
		  </tr>
		  <tr>
			   <td width="100" colspan="2" ><b>Job:</b> <br/>'.$job_res->job_title.'</td>                                
		  </tr>
		  <tr>
			  <d colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			  <td colspan="2"><b>Details:</b> <br/>'.$job_res->job_desc.'</td>
		  </tr>
		  <tr>
			  <th>Cast Date:</th><td>'.$job_res->casting_date.' &nbsp;&nbsp;</td>
			  <th>Shoot Date: </th><td>'.$job_res->shoot_date.'</td>
		  </tr>
		  <tr>
			  <d colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			  <td colspan="2"><b>Location:</b><br/> '.$job_res->job_location.'</td>
		  </tr>
	  </table>
	  
<a href="http://flcmodels.com/confirm_job/?q='.$en_url.'"><h3 style="font-family: Tahoma,Geneva,sans-serif;">CLick the link to submit you Status</h3></a>
	  </body>
	  </html>
	  ';
	  /*$headers  = "MIME-Version:1.0 \r\n";
	  $headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	  $headers  .= "From: $from\r\n";*/
	  //var_dump($mail);
	  $mail->AddAddress($to, "");
	  //$mail->AddAddress("ellen@example.com");                  // name is optional
	                             // set email format to HTML
	  
	  $mail->Subject = $subject;
	  $mail->Body    = $message;
	  //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	  //var_dump($mail);
	  //var_dump($mail->AddAddress);
	 $send= $mail->Send();
	 if($send){
		$mail_check=1;
	}
	 //var_dump($send); exit;
	  /*if(mail($to,$subject,$message,$headers))
	  {
		  //mail('augustian@iconceptme.com', 'subject', 'message');
		   //var_dump($message);
			//$mail_check=1;
			//var_dump($to); exit;
		}*/
	}
	}
	if($mail_check==1){
		mysqli_query($url,"UPDATE `Smart_FLC_jobs` SET `mail_status`='1' WHERE job_id=".$insertid);
		$msg = "Mail sent successfully to all the models selected on the job.";}
	
	//mail('augustian@iconceptme.com', 'subject', 'message');
	//exit;
}
?>  

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Call sheets
            <small></small>
          </h1>
          
          <ol class="breadcrumb" style="display:none">
            <li><a href="add-job.php" class="btn btn-block"><i class="fa fa-plus"></i> Add new Job</a></li>
          </ol>
          
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Call sheets - Jobs List</h3> 
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
                      <th>Job Title</th>
                      <th>Shoot Date</th>
                      <th>Client Budget</th>
                      <th>Models</th>
                      <th>Action</th>
                      <th>Owner</th>
                      <th>Status</th>
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
			"order": [[ 3, "desc" ]],
          "columnDefs": [
            {
                "targets": [ 5,6],
                "visible": false
            }
        ],
		  "processing": true,
        "serverSide": true,
		   "ajax": 'ajax/call-sheets.php'
		   
			  
		   <?php /*?>"columns": [
            { "data": "Resource_ID" },
            { "data": "name" },
            { "data": "image" },
            { "data": "category" },
            { "data": "status" },
            { "data": "action" }
        ]<?php */?>
		  });
		  $('#example2').DataTable().column(5).search(
						<?php echo $_SESSION['user_id']; ?>,false, false
					  ).draw();
		 $('#example2').DataTable().column(6).search(
						'1',false, false
					  ).draw();
      });
	  function view_model(obj){
		  var id=$(obj).attr('ref');
		BootstrapDialog.show({
			type:'type-default',
			title: 'Model Details',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('view_model.php?r_id='+id),
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
		var c= confirm("Do you want to remove this?");
		if(c){
			//location = "jobs.php?remove_job="+id;
		}
	}
	function view_sheet(val){
		  var id=val;
		BootstrapDialog.show({
			type:'type-default',
			title: 'Job Details - Call Sheet',
            message: $('<iframe src="view_sheet.php?j_id='+id+'" style="width:100%; min-height:500px;"frameborder="0" ></iframe>'),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	}
	//
	
    </script>
  </body>
</html>
<?php ob_end_flush(); ?>