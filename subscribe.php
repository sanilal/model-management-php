<?php
ob_start();
if(isset($_POST['email'])){
if($_POST['email']!=""){	
include($_POST['mn_url']."control_panel/includes/conn.php");
$cur_date=date("Y-m-d");
$email=mysqli_real_escape_string($url,$_POST['email']);
$cat_qr=mysqli_query($url,"SELECT subscriber_email FROM  `Smart_FLC_subscribers` WHERE subscriber_email='".$email."' ");
if($cat_qr->num_rows==0){
	$sub_qr=mysqli_query($url,"INSERT INTO `Smart_FLC_subscribers` (subscriber_email,subscribe_date) VALUES ('".$email."','$cur_date') ");
	if($sub_qr){
		echo "Subscribed Successfully";
	}
	else{
		echo "Error Occured. Please try again later";
	}
}
else{
	echo "You are already subscribed";
}
}
} ?>
		
		
		
	