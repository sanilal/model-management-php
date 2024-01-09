<?php
if($_SESSION['user_id']!=1){
	/*$query = "SELECT `token_val` FROM `Smart_FLC_tokens` WHERE `token_id`='1' AND `created` > NOW() - INTERVAL 12 HOUR";
	$r = mysqli_fetch_object(mysqli_query($url, $query));
	if($r->token_val!=$_SESSION['token']){
		header("Location: logout.php");
		echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
		exit;
	}*/
	
}
?>
<footer class="main-footer">
        <div class="pull-right hidden-xs">
        	All rights reserved.
        </div>
      </footer>
    
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
   <?php include_once('includes/footer-scripts.php'); ?>
