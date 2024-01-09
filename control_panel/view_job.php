<?php
error_reporting(0);
ob_start();
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
else if($_SESSION['user_id']=="" || $_SESSION['user_id']==NULL){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
include("includes/conn.php"); 
//var_dump($_SESSION['user_id']);
?>

<style type="text/css">
.tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px;}
.form-group{ overflow:hidden; font-size:16px; font-weight:bold}
.form-group  label { font-weight:normal; padding-right:10px;}

.multi-item-carousel{
  .carousel-inner{
    > .item{
      transition: 500ms ease-in-out left;
    }
    .active{
      &.left{
        left:-33%;
      }
      &.right{
        left:33%;
      }
    }
    .next{
      left: 33%;
    }
    .prev{
      left: -33%;
    }
    @media all and (transform-3d), (-webkit-transform-3d) {
      > .item{
        // use your favourite prefixer here
        transition: 500ms ease-in-out left;
        transition: 500ms ease-in-out all;
        backface-visibility: visible;
        transform: none!important;
      }
    }
  }
  .carouse-control{
    &.left, &.right{
      background-image: none;
    }
  }
}
</style>
 <?php 
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$_GET['j_id']."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section>

          <!-- Default box -->
          <div class="box" style="border:0">

      
            
            <div class="box-body">
                  <div class="box-body">
                 
                  
                  	<div class="tab_title">Job information</div>
              <div class="form-group">
                <label for="inputFname" >Job:</label>
                  <?php echo $job->job_title; ?>
                </div>
              
              <div class="form-group">
                <label for="inputEmail3" >Job Details:</label>
                  <?php echo $job->job_desc; ?>
                </div>
              <div class="form-group">
                <label for="inputPhone" >Casting Date:</label>
                
                  <?php echo $job->casting_date; ?>
                </div>
                 <div class="form-group">
                <label for="inputPhone" >Shoot Date:</label>
                
                  <?php echo $job->shoot_date; ?>
                </div>
              <div class="form-group">
                <label for="inputAddress" >Location:</label>
                
                  <?php echo $job->job_location;  ?>
                </div>
              <div class="tab_title">Client information</div>  
                <div class="form-group">
                <label for="inputAddress" >Client Details:</label>
                
                  <?php echo $job->client_details;  ?>
                </div>
                <div class="form-group">
                <label for="inputAddress" >Client Budget:</label>
                
                  <?php echo $job->client_budget;  ?>
                </div>
              
             
              <div class="tab_title">Models information</div>
              
             
               <?php $cat_rext_arr=explode(":;",$job->model_cats); 
			 $cat_id=0;
			 foreach($cat_rext_arr as $cat_text){
				 $query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$_GET['j_id']." && model_cat=".$cat_id);
				 if(mysqli_num_rows($query)>0){
			  ?>
              <div class="form-group" style="margin-top:30px;">
              <div class="tab_title">
                         <label>Model Category: <?php echo $cat_text; ?></label>
                    </div>
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
                              <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default ">View</a></span> &nbsp;&nbsp; 
                              <?php
							  $st_clss="label-warning";
							  	switch($model->job_assign_status) {
								  case 'Confirmed':
								 $st_clss='label-success';
									break;
								  case 'Rejected':
								$st_clss='label-danger';
									break;
								}
							  ?>
                              <span class="label <?php echo $st_clss; ?>"> <?php echo $model->job_assign_status; ?></span>
                              &nbsp;&nbsp; 
                              <?php if($model->client_check=='1'){ ?>
                              <label style="font-weight:bold; color:#fff;" class="label label-success">Client Selected</label>
                              <?php }
							  if($model->client_check=='1' && $model->job_assign_status=='Confirmed'){
								  $en_url=base64_encode("model_id=".$model->Resource_ID."&job_id=".$_GET['j_id']);
									?>
                          &nbsp;&nbsp; <a href="http://flcmodels.com/book_form?q=<?php echo $en_url; ?>" target="_blank" class="btn"><i class="fa fa-print"></i> Print Book form</a>
                                    <?php
								}
							   ?>
                              
                              
                            </li>
                    
                      
                    <?php
					}
				//}
				 ?>                   

                </ul>
                  
              </div>
              <?php } $cat_id++; } ?>
              <?php if($job->client_note!=""){ ?>
               <div class="form-group">
                <label for="inputAddress" >Client Notes:</label>
                
                  <?php echo $job->client_note;  ?>
                </div>
                <?php } ?>
               
                  </div><!-- /.box-body -->
                  
                
            </div><!-- /.box-body -->
            
           <?php /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    
  
<?php ob_end_flush(); ?>