<?php
error_reporting(E_ALL);
ob_start();

require_once("../control_panel/includes/conn.php"); 


$url_link=base64_decode($_GET['q']);
//var_dump($url);
parse_str($url_link, $vals);

$job_id=$vals['job_id'];

if($job_id!=""){

?>
<!doctype html>
<html>    
<head>
   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../control_panel/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../control_panel/dist/css/ionicons.min.css">
     <link rel="stylesheet" href="../control_panel/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../control_panel/dist/css/skins/_all-skins.min.css">
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">
table {
    table-layout:fixed;
    width:100%;
	background:#f1eee7; color:#585858;
}
table img {
	width:100%;
}
table td{ padding:5px; font-size:14px;}
.other_thumbs .thumb_div{ height:220px; overflow:hidden}
.other_thumbs .thumb_div img{ min-height:220px; max-height:260px; width:auto; max-width:190px;}
@media print
    {
	.no-print{ display:none;}
	
	}
</style>
</head>   
  <?php 
// echo "select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'";
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  //var_dump($job);
  ?>

 
<body style=" background:#000; background-size:contain; margin:0; padding:0;" >
    <div style="width:100%; text-align:center;" id="top">
        <img src="images/flc-bg.jpg" width="100%" />
    </div>
    <div style="width:100%; height:650px; padding-top:130px; background:url(images/flc-bg.jpg) top center no-repeat;">
     <div class="logo-caption" style="font-size:45px; padding:10px; background:#00b350; color:#fff; text-align:center; margin:150px 0;"> FLC PRODUCTION &amp; MODEL MANAGEMENT</div>
     </div>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin:0 auto; width:900px; background:none;">
      <button type="button" onClick="screenshot()" class="btn btn-warning no-print" data-html2canvas-ignore>Save Page</button>
       

            
                  
                    
           
                
                 
                    
                     <?php
					 
			$cat_rext_arr=explode(":;",$job->model_cats); 
			 $cat_id=0;
			 foreach($cat_rext_arr as $cat_text){
				 ?>
                 
                   <div style="background:#00b350; color:#fff; margin:20px 0 0 0; padding:10px; text-align:center" >
                    <p>Category: <b><?php echo $cat_text ?> </b></p>
                 </div>
                 <div style="background:#f1eee7; padding:20px;">
                 <?php
					 
					$query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$job_id." && model_cat=".$cat_id);
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//echo $model->job_assign_status;
					/*if($model->job_assign_status=="Confirmed"){*/
			?>
                    <table width="100%" style=" border-bottom:1px solid #B6B6B6">
                    <tr>
                    	<td width="34%"></td>
                    	<td width="66%">
                        	<table>
                        		<tr>
                                <td align="left"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></td>
                        		<td align="right"><?php echo $model->Resource_ID; ?></td>
                                </tr>
                        	</table>
                        </td>
                    </tr>
                    
                        <tr>
                            <td style="overflow:hidden">
                                <img src="<?php echo  $all_imgs[0]; ?>" style="height:452px; width:auto;" />
                            </td>
                            <td>
                                <table class="other_thumbs">
                                	<tr>
                                    	<td><div class="thumb_div"><img src="<?php echo  $all_imgs[1]; ?>" /></div></td>
                                        <td><div class="thumb_div"><img src="<?php echo  $all_imgs[2]; ?>" /></div></td>
                                        <td><div class="thumb_div"><img src="<?php echo  $all_imgs[3]; ?>" /></div></td>
                                    </tr>
                                    <tr>
                                    	<td><div class="thumb_div"><img src="<?php echo  $all_imgs[4]; ?>" /></div></td>
                                        <td><div class="thumb_div"><img src="<?php echo  $all_imgs[5]; ?>" /></div></td>
                                        <td><div class="thumb_div"><img src="<?php echo  $all_imgs[6]; ?>" /></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                        	<td></td>
                        	<td>
                            	<table>
                                	<tr>
                                    	<td>Height: <?php echo $model->Height; ?></td>
                                        <td>Bust: <?php echo $model->Bust; ?></td>
                                        <td>Waist: <?php echo $model->Waist; ?></td>
                                        <td>Hips: <?php echo $model->Hips; ?></td>
                                    </tr>
                                    <tr>
                                    	<td>Eyes: <?php echo $model->EyesColor; ?></td>
                                        <td>Hair: <?php echo $model->HairColor; ?></td>
                                        <td>Shoes: <?php echo $model->ShoesSize; ?></td>
                                        <td>Skin: <?php echo $model->SkinColor; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                   
                    </table>
                 <?php } $cat_id++; ?> </div> <?php } ?>
           
             
                  
                
            
           <?php /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>

      </div><!-- /.content-wrapper -->
      <div style="width:100%; text-align:center;">
<img src="images/flc-footer.jpg" width="100%" />
</div>
      <script src="../control_panel/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script type="text/javascript" src="html2canvas-master/dist/html2canvas.js"></script>
      <script type='text/javascript'>
	  $(function(){
		screenshot();
		})
            function screenshot(){
				window.scrollTo(0,0);
				html2canvas(document.body, 
				{
				  onrendered: function (canvas) {
					var a = document.createElement('a');
					// toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
					a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
					a.download = 'job_details-JB<?php echo $job_id; ?>.jpg';
					a.click();
				  }
				});
            }
        </script>
</body>
 </html>    
<?php
}
 ob_end_flush();
 ?>