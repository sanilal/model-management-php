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
.label.label-success{font-size:14px; margin-right:15px; }
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
  $models_query=mysqli_query($url,"select * from `Smart_FLC_Resource_Details` WHERE Resource_ID LIKE '%".$_GET['q_val']."%' OR First_Name LIKE '%".$_GET['q_val']."%' OR Last_Name LIKE '%".$_GET['q_val']."%' LIMIT 100");
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID LIKE '%".$_GET['q_val']."%' OR fname LIKE '%".$_GET['q_val']."%' OR lname LIKE '%".$_GET['q_val']."%' LIMIT 100";
  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0; ">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section>

        <div class="box box-primary">
              
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                  <?php
				  //var_dump($models_query);
				  while($model=mysqli_fetch_object($models_query)){
					 
					$img=0;
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//var_dump($all_imgs);
				   ?>
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>">
                      </div>
                      <div class="product-info">
                       <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default pull-right">View</a></span>
                       
                       
                        <a href="javascript::;" class="product-title"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?><span class="label label-success pull-right"> Select & Add Model</span></a>  &nbsp;&nbsp;
                        <span class="product-description">
                          <?php echo $model->Gender; ?>,  <?php echo $model->Nationality; ?>, <?php echo $model->Ethnicity; ?>
                          <br/>Age: <?php echo $model->Age; ?>
                        </span>
                       
                      </div>
                     
                    </li><!-- /.item -->
                    
                  <?php } ?>
                    
                  </ul>
                </div><!-- /.box-body -->
             
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    

<?php ob_end_flush(); ?>