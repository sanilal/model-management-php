<?php
header("Cache-Control: no-cache, must-revalidate");
ob_start();
		
	if(isset($_POST['insertdata'])){
		if($_POST['insertdata']=="models"){
			$id=$_POST['id'];
			session_start();
			$_SESSION['models'][$id]=$id;
			echo sizeof($_SESSION['models']);
		}
	}
	if(isset($_POST['dedata'])){
		if($_POST['dedata']=="cart"){
			session_start();
			unset($_SESSION['models'][$_POST['item_id']]);
			echo "success";
		}
	}
	if(isset($_POST['getdata'])){
		if($_POST['getdata']=="cart_size"){
			session_start();
			echo sizeof($_SESSION['models']);
		}
	}
	if(isset($_REQUEST['media_id'])){
		require_once("config/db.php");
		require_once("classes/Media.php");
		$media= new Media();
		$media_res=$media->getMedia($_REQUEST['media_id']);
		$row=$media_res->fetch_object();
		$step1=explode('v=', $row->work_link);
		$step2 =explode('&amp;',$step1[1]);
		$vedio_id = $step2[0];
		echo'<body style="margin:0; height:380px; width:500px">';
        echo '<iframe width="500" height="380" src="http://www.youtube.com/embed/'. $vedio_id.'?autoplay=1" frameborder="0"></iframe>';
        echo '</body>';
	}
	?>