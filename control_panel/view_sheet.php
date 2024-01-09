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
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
     <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<style type="text/css">
.printable{ display:none}
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

@media print
    {
	.btn, .model_img{ display:none;}
	.printable{ display:block;}
	}
</style>
 <?php 
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$_GET['j_id']."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0; background:none">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section>

          <!-- Default box -->
          <div class="box" style="border:0">
<div class="col-sm-12 logo" style="text-align:center">
    
        <img alt="FLC Productions &amp; MODELS MGMT - Logo" title="FLC Model MGMT" src="../images/green/flc-logo_green.png">
    
    
             <div class="logo-caption"> FLC PRODUCTION <br>&amp; MODEL MANAGEMENT</div>
     
    </div>
      
            <button type="button" onClick="window.print()"class="btn btn-warning" style="padding:5px;"><i class="fa fa-print"></i> Print Call Sheet</button>
            <div class="box-body">
                 
                  <table border="1" style="text-align:left" width="100%">
                   <?php $booker_name=mysqli_fetch_object(mysqli_query($url,"SELECT user_name FROM `lcfd_users_login` WHERE user_id=".$job->job_created_by)); ?>
                  <thead style="background:#B6B6B6">
                  <tr>
                  	<td colspan="8"><b>Call Sheet</b>: <?php echo $booker_name->user_name; ?></td>
                  </tr>
                  <tr>
                  <td>&nbsp;</td>
                      <td colspan="4">
                      <table>
                      	<tr>
                      		<td><b>Client :</b> </td> <td><?php echo $job->client_details; ?></td>
                       	</tr>
                        <tr>
                            <td><b>Contact Person:</b> </td> <td><?php echo $job->client_contact_person; ?></td>
                         </tr>
                         <tr>
                            <td><b>Email:</b> </td> <td><?php echo $job->client_email; ?></td>
                         </tr>
                         <tr>
                            <td><b>Project Name:</b> </td> <td><?php echo $job->job_title; ?></td>
                         </tr>
                         </table>
                      </td>
                      <td colspan="3">
                      <table>
                      	<tr>
                      		<td><b>Job No:</b> </td> <td><?php echo $job->job_no; ?></td>
                       	</tr>
                        <tr>
                            <td><b>LPO No:</b> </td> <td><?php echo $job->lpo_no; ?></td>
                         </tr>
                         <tr>
                            <td><b>Invoice Date:</b> </td> <td><?php echo $job->invoice_date; ?></td>
                         </tr>
                         <tr>
                            <td><b>Job Date:</b> </td> <td><?php echo $job->Shoot_date; ?></td>
                         </tr>
                         </table>
                      	
                      </td>
                  </tr>
                  </thead>
                  <tbody>
                  	<tr style="font-weight:bold">
                    
                    <td>No</td><td>Particulars</td><td>No of Hours</td><td>Rate/ Hour</td><td>Budget</td>
                    <td>Pay out</td><td>Contact</td><td>Usages</td>
                    </tr>
                    <?php
					$i=1; $tot_amt=0;
					$query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$_GET['j_id']." && j.job_assign_status='Confirmed' ");
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
			?>
                    
                  <tr>
                  <td><?php echo $i; ?></td>
                  		<td>
                              <div class="product-img">
                                <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>" width="80" class="model_img">
                              </div>
                              <br/>
                                                             
                               <div class="printable"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></div>
                                <a href="javascript::;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default "><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></a> 
                         </td> 
                         <td>
                         <?php echo $model->hours_worked; ?>
                         </td>
                         <td>
                         <?php echo $model->hourly_rate; ?>
                         </td>
                         <td> <?php echo $model->budget; ?></td>
                         <td>
                         <?php echo $model->payout; $tot_amt+=$model->payout; ?>
                         </td>
                          <td>
							<?php
                             $email=$model->Email1." ".$model->Email2." ".$model->Email3;
                          echo $email." ";
                          echo "<br/>Phone: ".$model->Cell_phone."<br/>";
                          ?>
                         </td>
                         <td>
                         <?php echo $model->Resource_Type." ".$model->Sub_Category; ?>
                         </td>
                       </tr>      
                      
                    <?php
					$i++;
					}
				//}
				 ?> 
                 <tr style="background:#B6B6B6">
                 
                 <td colspan="4"><b>Total Amount:</b></td>
                 <td colspan="4"><?php echo $tot_amt; ?></td>
                 </tr>                  

</tbody>
</table>                  
              
               
                  
                
            </div><!-- /.box-body -->
            
           <?php /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    
  
<?php ob_end_flush(); ?>