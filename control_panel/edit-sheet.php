<?php $active="job"; ?>

<?php include_once('includes/header.php'); ?>

      <!-- Left side column. contains the sidebar -->
<?php include_once('includes/side_bar.php'); ?>

<?php  
ob_start();
include("includes/conn.php"); 
//
 if(isset($_REQUEST['btnadd'])){
	 
	$job_id=$_POST['job_id'];
	$msg=""; $error="";
	if($job_id!=""){
		//
		  $cur_date=date("Y-m-d H:i:s");
		  $query = "UPDATE `Smart_FLC_jobs` SET `job_modified_by`='".$_SESSION['user_id']."', `job_modified_date`='$cur_date', client_details='".$_POST['client']."', client_budget='".$_POST['budget']."', client_contact_person='".$_POST['client_contact']."',client_email='".$_POST['client_email']."',job_no='".$_POST['job_no']."',lpo_no='".$_POST['lpo_no']."',invoice_date='".$_POST['invoice_date']."' WHERE `job_id`=".$job_id;
		  //var_dump($query); exit;
		  $r = mysqli_query($url, $query) or die(mysqli_error($url));
		  if($r){
			  if(isset($_POST['selct_model'])){
				  $insertid=$job_id;
				  $model_arr=array_unique($_POST['selct_model']);
				  $i=0;
				foreach($model_arr as $model_id){
					
					mysqli_query($url, "UPDATE `Smart_FLC_job_assign` SET hours_worked='".$_POST['hours_worked'][$i]."',hourly_rate='".$_POST['hourly_rate'][$i]."',payout='".$_POST['payout'][$i]."' WHERE `job_id`=".$insertid." && `model_id`='".$model_id."'");
					$i++;
				}
			}
			  $msg.= "Call Sheet Successfully Updated";
		  }
	  
	  
	}
	else {
			  $error.= "Failed: Fill all the required fields";
		  }
}
$job_res=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE job_id=".$_GET['job_id']));
?>
  

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Call Sheet - Job 
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="call-sheets.php" class="btn btn-block"><i class="fa fa-eye"></i>View Call Sheets</a></li>
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
            
            <div class="box-body">
              <form role="form" method="post"  class="form-horizontal" action="" enctype="multipart/form-data">
                  <div class="box-body">
                  
                  	<div class="form-group">
                      <label>Job Title</label>
                      <input type="text" class="form-control" readonly placeholder="Job Title" name="job_title" value="<?php echo $job_res->job_title; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Job No</label>
                      <input type="text" class="form-control" placeholder="Job No" name="job_no" value="<?php echo $job_res->job_no; ?>" />
                    </div>
                  <div class="form-group">
                      <label>Shoot Date</label>
                      <?php echo $job_res->shoot_date; ?>
                    </div>
               
               <div class="form-group">
                  <label>Client Details</label>
                  <textarea class="form-control" placeholder="Client" name="client" ><?php echo $job_res->client_details; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Contact Person(Client)</label>
                  <textarea class="form-control" placeholder="Client Contact" name="client_contact" ><?php echo $job_res->client_contact_person; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Contact Email(Client)</label>
                  <textarea class="form-control" placeholder="Client Email" name="client_email" ><?php echo $job_res->client_email; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Client Budget</label>
        <input type="text" class="form-control" placeholder="Budget" name="budget" value="<?php echo $job_res->client_budget; ?>" />
                </div>
                
                <div class="form-group">
                  <label>LPO Number</label>
        <input type="text" class="form-control" placeholder="LPO No" name="lpo" value="<?php echo $job_res->lpo_no; ?>" />
                </div>
                <div class="form-group">
                  <label>Invoice Date</label>
        <input type="text" class="form-control" placeholder="Invoice Date" name="invoice_date" value="<?php if($job_res->invoice_date!='0000-00-00') {echo $job_res->invoice_date;} ?>" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
                </div>
             
              
              <div class="form-group">
               <label class="col-sm-2 control-label" style="text-align:left">Models Payout</label>
             
             <div style="clear:both; padding-top:15px;">
           <table border="1" width="100%">
           <thead>
           	<tr>
            	<th colspan="2">Model</th> <th>Hours Worked</th> <th>Hourly Rate</th> <th>Budget</th> <th>Pay Out</th> <th>Contact</th> <th>Usages</th>
            </tr>
           </thead>
              <tbody>         	
                       
                    <?php
					$query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$job_res->job_id." && j.job_assign_status='Confirmed'");
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
			?>
                    
                   <tr>
                   <td colspan="2">
                              <div class="product-img">
                                <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>" width="80">
                              </div>
                       			<div>  
                               
                                <a href="javascript::;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default "><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></a>  &nbsp;&nbsp;
                                </div>
                                </td>
                                <td>
                                 <input type="text" name="hours_worked[]" value="<?php echo $model->hours_worked; ?>"  class="form-control" placeholder="Hours Worked" /> 
                                </td>
                                <td>
                                <input type="text" name="hourly_rate[]" value="<?php echo $model->hourly_rate; ?>" class="form-control" placeholder="Hourly Rate" /> 
                                </td>
                                <td> <?php echo $model->budget; ?></td>
                                <td>
                                <input type="text" name="payout[]" value="<?php echo $model->payout; ?>" class="form-control" placeholder="Pay Out"/> 
                                </td>
                                <td>
                                  <?php
								  if($model->Email1!=""){ echo '<a href="mailto:'.$model->Email1.'" >'. $model->Email1.'</a>'; } if($model->Email2!=""){ echo ', <a href="mailto:'.$model->Email2.'" >' .$model->Email2.'</a>';} if($model->Email3!=""){ echo ', <a href="mailto:'.$model->Email3.'" >'.$model->Email3.'</a>';} 
								echo "<br/>Phone: ".$model->Cell_phone."<br/>";
								?>
                               </td>
                               <td>
                               <?php echo $model->Resource_Type." ".$model->Sub_Category; ?>
                               </td>
                              
                               
                              <input type="hidden" name="selct_model[]" value="<?php echo $model->Resource_ID; ?>"  class="model_val" />
                              
                            </tr>
                    
                       
                       
                    <?php
					}
				//}
				 ?>                   
					</tbody>
                </table>
               </div> 
              </div>
             
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?>" />
                    <button type="submit" class="btn btn-primary" name="btnadd">Update Job</button>
                    
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
<link rel="stylesheet" href="dist/css/bootstrap-dialog.css">
<link type="text/css" href="plugins/datepicker/datepicker3.css" rel="stylesheet" />
<script type="text/javascript" src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="dist/js/bootstrap-dialog.min.js"></script>
<script>
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('job_desc');
  });


function view_model(obj){
		  var id=$(obj).attr('ref');
		BootstrapDialog.show({
			type:'type-default',
			title: 'Model Complete Details',
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
    
  </body>
</html>
<?php ob_end_flush(); ?>