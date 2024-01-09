<?php
error_reporting(0);
ob_start();
session_start();
 $active="job"; ?>

<?php include_once('includes/header.php'); ?>

      <!-- Left side column. contains the sidebar -->
<?php include_once('includes/side_bar.php'); ?>

<?php  
ob_start();
include("includes/conn.php"); 
//
 if(isset($_REQUEST['btnadd'])){
	 
	$job=$_POST['job_title'];	
	$job_id=$_POST['job_id'];
	$msg=""; $error="";
	if($job!=""){
		//
		
		//var_dump($p_image); exit;
		//
		  //var_dump($num); exit;
		  $cur_date=date("Y-m-d H:i:s");
		  $num=mysqli_num_rows(mysqli_query($url,"SELECT `job_title` FROM `Smart_FLC_jobs` WHERE `job_title`='$job' && `job_id`!=".$job_id));
	  //var_dump($num); exit;
	  $num=0;
	  if($num < 1){
		  $query = "UPDATE `Smart_FLC_jobs` SET `job_title`='$job',`job_desc`='".$_POST['job_desc']."', `casting_date`='".$_POST['cast_date']."', `shoot_date`='".$_POST['shoot_date']."', `job_location`='".$_POST['location']."', `job_modified_by`='".$_SESSION['user_id']."', `job_modified_date`='$cur_date', client_details='".$_POST['client']."', client_budget='".$_POST['budget']."',job_status=".$_POST['job_complete'].", `model_cats`='".implode(":;",$_POST['model_cat_text'])."' WHERE `job_id`=".$job_id;
		  //var_dump($query); exit;
		  $r = mysqli_query($url, $query) or die(mysqli_error($url));
		  if($r){
			  if(isset($_POST['selct_model'])){
				  $insertid=$job_id;
				  $model_arr=array_unique($_POST['selct_model']);
				  mysqli_query($url, "DELETE FROM `Smart_FLC_job_assign` WHERE `job_id`=".$job_id);
				  $i=0;
				foreach($model_arr as $model_id){
					//var_dump($_POST['ja_status']);
					$status=$_POST['ja_status'][$i];
					
					if($status=="" || $status==NULL){
						$status="Pending";
					}
					//var_dump($status); 
					//echo "INSERT INTO `Smart_FLC_job_assign` (`job_id`,`model_id`, `job_assign_status`, `job_assign_date`) VALUES($insertid,'$model_id', '$status', '$cur_date')";
					mysqli_query($url, "INSERT INTO `Smart_FLC_job_assign` (`job_id`,`model_id`, `job_assign_status`, `job_assign_date`,job_agree_status,hours_worked,hourly_rate,payout, budget, `model_cat`) VALUES($insertid,'$model_id', '$status', '$cur_date','".$_POST['agree_status'][$i]."', '".$_POST['hours_worked'][$i]."', '".$_POST['hourly_rate'][$i]."', '".$_POST['payout'][$i]."', '".$_POST['m_budget'][$i]."',".$_POST['model_cat_id'][$i].")");
					$i++;
				}
				foreach($_POST['client_select'] as $model){
					$query = "UPDATE `Smart_FLC_job_assign` SET `client_check`='1' WHERE `job_id`=".$job_id." && `model_id`='".$model."'";
					mysqli_query($url,$query);
				}
			}
			  $msg.= "Job Successfully Updated";
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
$job_res=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE job_id=".$_GET['job_id']));
?>
  

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Job
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
                      <input type="text" class="form-control" placeholder="Job Title" name="job_title" value="<?php echo $job_res->job_title; ?>" />
                    </div>
                    
                    <div class="form-group">
                      <label>Job Description</label>
                      <textarea class="form-control" placeholder="Job Description" name="job_desc" id="job_desc"><?php echo $job_res->job_desc; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label>Casting Date</label>
                      <input type="text" class="form-control" value="<?php echo $job_res->casting_date; ?>" placeholder="Cast Date" name="cast_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
                    </div>
                    <div class="form-group">
                      <label>Shoot Date</label>
                      <input type="text" class="form-control" placeholder="Shoot Date" value="<?php echo $job_res->shoot_date; ?>" name="shoot_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" />
                    </div>
                    
                      <div class="form-group">
                      <label>Location</label>
                      <input type="text" class="form-control" placeholder="Location" name="location" value="<?php echo $job_res->job_location; ?>" />
                    </div>
               
               <div class="form-group">
                  <label>Client Details</label>
                  <textarea class="form-control" placeholder="Client" name="client" ><?php echo $job_res->client_details; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Client Budget</label>
        <input type="text" class="form-control" placeholder="Budget" name="budget" value="<?php echo $job_res->client_budget; ?>" />
                </div>
             
             <?php $cat_rext_arr=explode(":;",$job_res->model_cats); 
			 $cat_id=0;
			 $cat_msgs=explode("<=>",$job_res->cat_messages); 
			 foreach($cat_rext_arr as $cat_text){
				 $query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$job_res->job_id." && model_cat=".$cat_id);
				 
			  ?>
              
              <div class="form-group" <?php if(mysqli_num_rows($query)==0 && $cat_id!=0){ echo 'style="display:none;"';} ?>>
               		<div class="tab_title">
                         <label>Model Category</label><?php if($cat_id!=0){ echo '<label style="float: right;"><a href="javascript:;" onclick="del_cat(this);" style="color: #ff9e8a;">Delete x</a></label>';}?>
                        <input type="text" class="form-control" placeholder="Category" name="model_cat_text[]" value="<?php echo $cat_text; ?>" />
                        	
                            <textarea class="form-control" placeholder="Category Message" name="cat_message[]"><?php echo $cat_msgs[$cat_id]; ?></textarea>
                    </div>
                    
                    <div style="clear:both; padding-top:15px;">
             <ul class="products-list product-list-in-box" id="model_select">
                       	
                       
                    <?php
					
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
			?>
                    
                   <li class="item">
                              <div class="product-img">
                                <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>">
                              </div>
                              <div class="product-info">                               
                               
                                <a href="javascript::;"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></a>  &nbsp;&nbsp;
                                <span class="product-description">
                                  <?php
								  if($model->Email1!=""){ echo '<a href="mailto:'.$model->Email1.'" >'. $model->Email1.'</a>'; } if($model->Email2!=""){ echo ', <a href="mailto:'.$model->Email2.'" >' .$model->Email2.'</a>';} if($model->Email3!=""){ echo ', <a href="mailto:'.$model->Email3.'" >'.$model->Email3.'</a>';} 
								echo "Phone: ".$model->Cell_phone." &nbsp;";
								echo '<a href="https://api.whatsapp.com/send?phone='.ltrim($model->whatsapp,'+').'" target="_blank"><i class="fa fa-whatsapp"></i> '.$model->whatsapp.'</a><br/>';
								   echo $model->Gender; ?>,  <?php echo $model->Nationality; ?>, <?php echo $model->Ethnicity; ?>
                                  <br/>Age: <?php echo $model->Age; ?>
                                </span>
                               <?php if($model->Email1=="" || $model->Email1==NULL){ ?>
                               <div style="color:#E11A1D">No Email</div>
                               <?php } ?>
                              </div>
                              
                              <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default ">View</a></span> &nbsp;&nbsp; <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="unselect_model(this)" class="btn btn-default">Delete</a></span>
                              <select name="ja_status[]" >
                              	<?php $ja_vals=array("Pending","Confirmed","Rejected"); 
								foreach($ja_vals as $ja_val){
									?>
                                    <option <?php if($ja_val==$model->job_assign_status){ echo 'selected="selected"';} ?>><?php echo $ja_val ?></option>
							<?php
                            	}
								?>
                              </select> 
                              <?php /*?><span class="label label-success pull-right"> <?php echo $model->job_assign_status; ?></span><?php */?>
                              <span style="margin-left:10px; padding:5px; background:#00b350">
                              <input type="checkbox" id="check_client<?php echo $model->Resource_ID; ?>" name="client_select[]" <?php if($model->client_check=='1'){ echo 'checked="checked"';} ?> value="<?php echo $model->Resource_ID; ?>" class="foi_check" /> <label for="check_client<?php echo $model->Resource_ID; ?>" style="font-weight:bold; color:#fff;">Client Select</label>
                              </span>
                              <input type="hidden" name="selct_model[]" value="<?php echo $model->Resource_ID; ?>"  class="model_val" />
                              <input type="hidden" name="model_cat_id[]" value="<?php echo $model->model_cat; ?>" class="model_cat" />
                              &nbsp;&nbsp; Budget: 
                              <input type="text" name="m_budget[]" value="<?php echo $model->budget;  ?>" /> &nbsp;&nbsp; 
                              <?php
                              if($model->client_check=='1' && $model->job_assign_status=='Confirmed'){
								  $en_url=base64_encode("model_id=".$model->Resource_ID."&job_id=".$job_res->job_id);
									?>
                          &nbsp;&nbsp; <a href="http://flcmodels.com/book_form?q=<?php echo $en_url; ?>" target="_blank" class="btn"><i class="fa fa-print"></i> Print Book form</a>
                                    <?php
								}
                              ?>
                            </li>
                    
                      <input type="hidden" name="agree_status[]" value="<?php echo $model->job_agree_status; ?>" /> 
                      <input type="hidden" name="hours_worked[]" value="<?php echo $model->hours_worked; ?>" /> 
                       <input type="hidden" name="hourly_rate[]" value="<?php echo $model->hourly_rate; ?>" /> 
                       <input type="hidden" name="payout[]" value="<?php echo $model->payout; ?>" /> 
                    <?php
					}
				 ?>                   

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
                                     <input type="hidden" class="model_cat_val" value="<?php echo $cat_id; ?>" />
                            	</div>
                           </div>
                       </div>
             
              </div>
              <?php  $cat_id++; } ?>
               <div class="form-group">
                       <button type="button"  onClick="add_category(this);" class="btn btn-success">Add Model Category</button>
                     </div>
              <div class="form-group" style="border:1px solid #278D1D; padding:5px" >
                  <label class="col-md-4">Job Completion Status</label>
        <select name="job_complete" class="col-md-5">
        <option <?php if($job_res->job_status==0){ echo 'selected="selected"';} ?> value="0">Pending</option>
        <option <?php if($job_res->job_status==1){ echo 'selected="selected"';} ?> value="1">Completed</option>
        	
        </select>
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
var curr_cat_area="";
var model_cat_id=<?php echo $cat_id-1; ?>;
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('job_desc');
  });
  function search_models(obj){
	   curr_cat_area=obj;
	//var q=jQuery("#models_q").val();
	//if(q=="" || q.length<=2){alert("please type model id or name with more than 2 character"); return false;}
	//else{
		BootstrapDialog.show({
			type:'type-default',
			title: 'Select and Add Models',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('search_model.php'),
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
		var add_cont='<div class="form-group"><div class="tab_title"><label>Model Category</label><label style="float: right;"><a href="javascript:;" onclick="del_cat(this);" style="color: #ff9e8a;">Delete x</a></label><input type="text" class="form-control" placeholder="Category" name="model_cat_text[]" />	<textarea class="form-control" placeholder="Category Message" name="cat_message[]"></textarea></div><div style="clear:both;"><ul class="products-list product-list-in-box" ></ul></div><div style="clear:both">&nbsp;</div><label class="col-sm-2 control-label" style="text-align:left">Assign Models</label><div class="col-sm-10" ><div class="row itemrow"><div class="col-md-5"><button type="button"  onClick="search_models(this);" class="btn btn-success">Select Models</button> <input type="hidden" class="model_cat_val" value="'+model_cat_id+'" /></div></div></div><div class="clearfix models_list" ></div></div>';
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