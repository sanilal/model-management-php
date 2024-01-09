<?php
header("Cache-Control: no-cache, must-revalidate");
$flc_id=$_GET['flc_id'];
$dir_no=$_GET['dir_no'];

//echo $flc_id;
//echo " && ";
//echo $dir_no;

//$flc_id = "F8080";
//$dir_no = "80";

$mask = "FLC_Resource_Image_Folders/$dir_no/$flc_id*.*";
array_map('unlink', glob($mask));

//unlink("DirectUpload_specific/$flc_id.csv");		
?>