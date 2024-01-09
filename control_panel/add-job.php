<?php
error_reporting(0);
ob_start();
session_start();
$active="job"; 
//echo "ok"; exit;
?>

<?php include_once('includes/header.php'); ?>

      <!-- Left side column. contains the sidebar -->
<?php include_once('includes/side_bar.php'); ?>

<?php  
include("includes/conn.php"); 
//
 if(isset($_REQUEST['btnadd'])){
	 
	$job=$_POST['job_title'];	
	
	$msg=""; $error="";
	if($job!=""){
		//
		
		//var_dump($p_image); exit;
		//
		  //var_dump($num); exit;
		  $cur_date=date("Y-m-d H:i:s");
		  $num=mysqli_num_rows(mysqli_query($url,"SELECT `job_title` FROM `Smart_FLC_jobs` WHERE `job_title`='$job'"));
	  //var_dump($num); exit;
	  $num=0;
	  if($num < 1){
		  $query = "INSERT INTO `Smart_FLC_jobs` (`job_title`,`job_desc`, `casting_date`, `shoot_date`, `job_location`, `job_created_by`, `job_created_date`, client_details, client_budget, `model_cats`,`cat_messages`) VALUES('$job','".$_POST['job_desc']."', '".$_POST['cast_date']."', '".$_POST['shoot_date']."', '".$_POST['location']."', '".$_SESSION['user_id']."', '$cur_date','".$_POST['client']."', '".$_POST['budget']."','".implode(":;",$_POST['model_cat_text'])."','".implode("<=>",$_POST['cat_message'])."')";
		  //var_dump($query); exit;
		  $r = mysqli_query($url, $query) or die(mysqli_error($url));
		  //$r=true;
		  if($r){
			  if(isset($_POST['selct_model'])){
				 // var_dump($_POST['selct_model']); exit;
				  $insertid=mysqli_insert_id($url);
				  $model_arr=array_unique($_POST['selct_model']);
				  $i=0;
				foreach($model_arr as $model_id){
					mysqli_query($url, "INSERT INTO `Smart_FLC_job_assign` (`job_id`,`model_id`, `job_assign_status`, `job_assign_date`, `budget`, `model_cat`) VALUES($insertid,'$model_id', 'Pending', '$cur_date', '".$_POST['m_budget'][$i]."',".$_POST['model_cat_id'][$i].") ");
					 //$to = $_POST['job_mail'][$i];
					  //$from = 'no-reply@flcmodels.com';
					  //$subject = "Job requirement";
					  //if($to!=""){
						 // $en_url=base64_encode("model_id=$model_id&job_id=$insertid");
					  /*$message= '<html>
 						 <body bgcolor=\"#DCEEFC\"> 
						 <table>
							<tr>
								<td colspan="4">Job Details</td>
							</tr>
							<tr>
								 <td width="100" colspan="2" >Job: </td><td colspan="2">'.$job.'</td>                                
							</tr>
							<tr>
                                <td colspan="2">Details: </td><td colspan="2">'.$_POST['job_desc'].'</td>
							</tr>
							<tr>
								<td>Cast Date:</td><td>'.$_POST['cast_date'].' &nbsp;&nbsp;</td>
								<td>Shoot Date: </td><td>'.$_POST['shoot_date'].'</td>
							</tr>
							<tr>
                                <td colspan="2">Location: </td><td colspan="2">'.$_POST['location'].'</td>
							</tr>
						</table>
						
				<a href="http://flcmodels.com/confirm_job/?q='.$en_url.'"><h3 style="font-family: Tahoma,Geneva,sans-serif;">CLick the link to submit you Status</h3></a>
						</body>
						</html>
						';
					  	$headers  = "MIME-Version:1.0 \r\n";
						$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
						$headers  .= "From: $from\r\n";
						mail($to, $subject, $message, $headers);*/
					  //}
					  
					$i++;
				}
			}
			  $msg.= "Job Successfully Added";
		  }
		  else {
			  $error.= "Failed: Error occured";
		  }
	  }
	   else{
			$error.= "Failed: Job title exist already";
		}
	  
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
            Add new Job
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="jobs.php" class="btn btn-block"><i class="fa fa-eye"></i>View Jobs</a></li>
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
                      <input type="text" class="form-control" placeholder="Job Title" name="job_title" />
                    </div>
                    
                    <div class="form-group">
                      <label>Job Description</label>
                      <textarea class="form-control" placeholder="Job Description" name="job_desc" id="job_desc"></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label>Casting Date</label>
                      <input type="text" class="form-control" placeholder="Cast Date" name="cast_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
                    </div>
                    <div class="form-group">
                      <label>Shoot Date</label>
                      <input type="text" class="form-control" placeholder="Shoot Date" name="shoot_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
                    </div>
                    
                      <div class="form-group">
                      <label>Location</label>
                      <input type="text" class="form-control" placeholder="Location" name="location" />
                    </div>
                     <div class="form-group">
                      <label>Client Details</label>
                      <textarea class="form-control" placeholder="Client" name="client" ></textarea>
                    </div>
                    <div class="form-group">
                      <label>Client Budget</label>
                      <input type="text" class="form-control" placeholder="Budget" name="budget" />
                    </div>
                    
                      <div class="form-group">
                          <div class="tab_title">
                           <label>Model Category</label>
                          	<input type="text" class="form-control" placeholder="Category" name="model_cat_text[]" />
                          	<textarea class="form-control" placeholder="Category Message" name="cat_message[]"></textarea>
                          </div>
                       <div style="clear:both;">
                       	<ul class="products-list product-list-in-box" id="model_select">
                       		
                       	</ul>
                       </div>
                       <div style="clear:both">&nbsp;</div>
                      <label class="col-sm-2 control-label" style="text-align:left">Assign Models</label>
                      <div class="col-sm-10" >
                      		<div class="row itemrow">
                            	<div class="col-md-5" style="display:none">
		                      		<input type="text" class="form-control" placeholder="Search Models by typing name or model id" id="models_q"  />
                                </div>
                                <div class="col-md-5">
                                     <button type="button"  onClick="search_models(this);" class="btn btn-success">Select Models</button>
                                     <input type="hidden" class="model_cat_val" value="0" />
                            	</div>
                           </div>
                       </div>
                      
                      <div class="clearfix models_list" >
                      	
                      </div>
                    </div>
                    
                    <div class="form-group">
                       <button type="button"  onClick="add_category(this);" class="btn btn-success">Add Model Category</button>
                     </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="btnadd">Add Job</button>
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
var curr_cat_area="";
var model_cat_id=0;
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('job_desc');
  });
  
  function search_models(obj){
	  curr_cat_area=obj;
	var q=jQuery("#models_q").val();
	//if(q=="" || q.length<=2){alert("please type model id or name with more than 2 character"); return false;}
	//else{
		BootstrapDialog.show({
			type:'type-default',
			title: 'Select and Add Models',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('search_model.php?q_val='+q),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	//}	
}


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
	function select_model(obj,val){
		var check=0;
		jQuery(".products-list").find('.model_val').each(function() {
            if(jQuery(obj).next().find('.model_val').val()==jQuery(this).val()){
				check=1;
			}
        });
		if(check==0){
			jQuery(obj).next().find(".model_cat").val(jQuery(curr_cat_area).next(".model_cat_val").val());
			
		jQuery(curr_cat_area).parent().parent().parent().prev().prev().prev().find('.products-list').append(jQuery(obj).next().html());
			
			jQuery(obj).children().html("Deselect");
			//jQuery(obj).removeAttr('onclick');
		}
		else{
		//alert("already added");
			var del_obj=jQuery( ".btn[ref="+val+"]" );
			unselect_model(del_obj);
			jQuery(obj).children().html("Select & Add Model");
			
		}
		
	}
	function unselect_model(obj){
		jQuery(obj).parent().parent().remove();
	}
	function add_category(obj){
		model_cat_id++;
		var add_cont='<div class="form-group"><div class="tab_title"><label>Model Category</label><label style="float: right;"><a href="javascript:;" onclick="del_cat(this);" style="color: #ff9e8a;">Delete x</a></label><input type="text" class="form-control" placeholder="Category" name="model_cat_text[]" /><textarea class="form-control" placeholder="Category Message" name="cat_message[]"></textarea></div><div style="clear:both;"><ul class="products-list product-list-in-box" ></ul></div><div style="clear:both">&nbsp;</div><label class="col-sm-2 control-label" style="text-align:left">Assign Models</label><div class="col-sm-10" ><div class="row itemrow"><div class="col-md-5"><button type="button"  onClick="search_models(this);" class="btn btn-success">Select Models</button> <input type="hidden" class="model_cat_val" value="'+model_cat_id+'" /></div></div></div><div class="clearfix models_list" ></div></div>';
		$(add_cont).insertBefore( $(obj).parent());
	}
	function del_cat(obj){
		jQuery(obj).parent().parent().parent().find(".products-list").remove();
		jQuery(obj).parent().parent().parent().find(".form-control").val("");
		jQuery(obj).parent().parent().parent().find("textarea.form-control").html("");
		jQuery(obj).parent().parent().parent().hide();
	}
	function search_advanced(){
		BootstrapDialog.closeAll();
		BootstrapDialog.show({
			type:'type-default',
			title: 'Select and Add Models',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('search_model_advanced.php?q_val='),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
		
	}
</script>
  <style type="text/css">
  .tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px;}
  </style>  
  </body>
</html>
<?php ob_end_flush(); ?>