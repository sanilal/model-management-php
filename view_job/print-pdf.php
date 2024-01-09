<?php
error_reporting(E_ALL);
ob_start();
require_once ('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
require_once("../control_panel/includes/conn.php"); 
//var_dump($_SESSION['user_id']);

//$_GET['q']=base64_encode("model_id=F001&job_id=4");
//var_dump($_GET['q']);

$url_link=base64_decode($_GET['q']);
//var_dump($url);
parse_str($url_link, $vals);
//var_dump( $vals); //exit;
//echo $_SERVER['REQUEST_URI']; $job_id=4;
$job_id=$vals['job_id'];

if($job_id!=""){

//echo "ok";
$dompdf = new Dompdf();
//echo $job_id;
$html_cont='
    
<head>
   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
.nobreak , .nobreak > tr {
  page-break-inside: avoid;
}
</style>
</head>   
  ';

// echo "select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'";
  $job=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_jobs` WHERE `job_id`='".$job_id."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  //var_dump($job);
 
$html_cont.='<body style=" background:#000; background-size:contain; margin:0; padding:0">
    <div style="width:100%; text-align:center;">
        <img src="images/flc-bg.jpg" width="100%" />
    </div>
    <div style="width:100%; height:700px; padding-top:130px; background:url(images/flc-bg.jpg) center center no-repeat;">
     <div class="logo-caption nobreak" style="font-size:45px; width:100%; padding:10px; background:#00b350; color:#fff; text-align:center; margin:150px 0;"> FLC PRODUCTION &amp; MODEL MANAGEMENT</div>
	 </div>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin:0 auto; width:900px; background:none;">
        <!-- Content Header (Page header) -->';
        

					$query=mysqli_query($url,"SELECT * FROM `Smart_FLC_job_assign` as j INNER JOIN `Smart_FLC_Resource_Details` as r ON j.model_id=r.Resource_ID WHERE job_id=".$job_id);
					 while($model=mysqli_fetch_object($query)){
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//echo $model->job_assign_status;
					/*if($model->job_assign_status=="Confirmed"){*/
			 $html_cont.='
                    <table style="border-collapse: collapse;width:100%; margin-bottom: 0px;" cellspacing="0" cellpadding="0" class="nobreak">
                    <tr>
                    	<td width="34%"></td>
                    	<td width="66%">
                        	<table cellspacing="0" cellpadding="0">
                        		<tr>
                                <td align="left">'.$model->First_Name.' '.$model->Middle_Name.' '.$model->Last_Name.'</td>
                        		<td align="right">'.$model->Resource_ID.'</td>
                                </tr>
                        	</table>
                        </td>
                    </tr>
                    
                        <tr>
                            <td>
                                <img src="'.$all_imgs[0].'" />
                            </td>
                            <td>
                                <table cellspacing="0" cellpadding="0">
                                	<tr>
                                    	<td><img src="'.$all_imgs[1].'" /></td>
                                        <td><img src="'. $all_imgs[2].'" /></td>
                                        <td><img src="'. $all_imgs[3].'" /></td>
                                    </tr>
                                    <tr>
                                    	<td><img src="'. $all_imgs[4].'" /></td>
                                        <td><img src="'. $all_imgs[5].'" /></td>
                                        <td><img src="'. $all_imgs[6].'" /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                        	<td></td>
                        	<td>
                            	<table cellspacing="0" cellpadding="0">
                                	<tr>
                                    	<td>Height: '.$model->Height.'</td>
                                        <td>Bust: '.$model->Bust.'</td>
                                        <td>Waist: '.$model->Waist.'</td>
                                        <td>Hips: '.$model->Hips.'</td>
                                    </tr>
                                    <tr>
                                    	<td>Eyes: '.$model->EyesColor.'</td>
                                        <td>Hair: '.$model->HairColor.'</td>
                                        <td>Shoes: '.$model->ShoesSize.'</td>
                                        <td>Skin: '.$model->SkinColor.'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    
                    </table>'; 
					
					 } 
				 
				 $html_cont.='</div><!-- /.content-wrapper -->
      <div style="width:100%; text-align:center;">
<img src="images/flc-footer.jpg" width="100%" />
</div>
 </body>     
';
 }
 //echo $html_cont;
$dompdf->load_html($html_cont);
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
 ob_end_flush();
 ?>