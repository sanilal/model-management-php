<?php
error_reporting(E_ALL);
ob_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Flc Models | View Job </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="control_panel/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="control_panel/dist/css/ionicons.min.css">
     <link rel="stylesheet" href="control_panel/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="control_panel/dist/css/skins/_all-skins.min.css">
  

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
table td{ padding:5px; font-size:14px; position:relative;}
.other_thumbs .thumb_div{ height:220px; overflow:hidden}
.other_thumbs .thumb_div > img{ min-height:220px; max-height:260px; width:auto; max-width:190px;}

@media print
    {
	.no-print{ display:none;}
	
	}
	
	.absl_div { z-index:10; position:absolute; height:100%; width:100%; top:0; }
	.absl_div img{position: absolute; opacity: 0.5;
filter: alpha(opacity=50);
left: 33%;
bottom: 2%;
width: 30%;}
</style>
    
  </head>
  

 

<body style=" background:#f1eee7; background-size:contain; width:900px; margin:0 auto;">
    
   
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin:0 auto; width:900px; background:none;">
    
     
                    
           
               
                    
                    
                 
                
                 <?php
			require_once("config/db.php");
			require_once("classes/Models.php");
			$models = new Models();
			
			if(isset($_REQUEST['res_id'])){
				//var_dump($models);
				$model_res = $models->getModels(NULL,$_REQUEST['res_id'],NULL);
				
				$model=$model_res->fetch_object();
				
				 $sub_folder=$models->getImageFolder($model->Resource_ID);
		define('IMAGEPATH', image_path.$sub_folder."/");
		  $all_imgs=glob(IMAGEPATH.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//sort
		natsort($all_imgs);
			
		//
          ?>
                    <table width="100%" style=" border-bottom:1px solid #B6B6B6">
                    <tr>
                    	<td width="34%"></td>
                    	<td width="66%">
                        	<table>
                        		<tr>
                                <td align="left"><?php echo $model->First_Name; ?></td>
                        		<td align="right"><?php echo $model->Resource_ID; ?></td>
                                </tr>
                        	</table>
                        </td>
                    </tr>
                    
                        <tr>
                            <td style="overflow:hidden">
                                <img src="<?php echo  $all_imgs[0]; ?>" style="height:452px; width:auto;" />
                                <div class="absl_div"> 
                            	<img alt="FLC Models &amp; Talents"  src="images/flc_mark.png"  />
                            </div>
                            </td>
                            <td>
                                <table class="other_thumbs">
                                	<tr>
                                    	<td><div class="thumb_div">
                                        		<div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="images/flc_mark.png" > 
                                      			</div>
                                      		<img src="<?php echo  $all_imgs[1]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[2]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[3]; ?>" /></div></td>
                                    </tr>
                                    <tr>
                                    	<td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[4]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[5]; ?>" /></div></td>
                                        <td><div class="thumb_div">
                                        <div class="absl_div"> 
                                          			<img alt="FLC Models &amp; Talents" width="50"  src="images/flc_mark.png" > 
                                      			</div>
                                        <img src="<?php echo  $all_imgs[6]; ?>" /></div></td>
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
                 
           
              
                  
                
            
           <?php 
			}
		   /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>

      </div><!-- /.content-wrapper -->
     
     
</body>
<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
</html>
    
<?php  ob_end_flush(); ?>