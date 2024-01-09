<?php  
ob_start();
error_reporting(0);
include("../includes/conn.php"); 
if(isset($_POST['img'])){
	if(preg_match('(jpg|JPEG|jpeg|png|JPG)', $_POST['img']) === 1) { unlink("../".$_POST['img']);  } 
	echo 'done';
}