<?php
ob_start();
session_start();
error_reporting(0);
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

	if(isset($_POST['filename'])){
			
			$extension=array("jpeg","jpg","png","gif");
			
			include_once("class.upload.php");
			 
			$gallery=array();
			 $size = $_FILES['myfile']['size'];
    		if(!isset($_SESSION['img_count'])){
				$_SESSION['img_count']=1;
				$_SESSION['img_files']=array();
			}
			$i=$_SESSION['img_count'];
			
                if($i > 20 ) exit;
				//var_dump($size); exit;
				if ($size < 5348880) {
				$img_src=image_upload($_FILES['myfile'],$_POST['filename']."img".time()."_".$i,500);
				if($img_src!=""){
				//var_dump($_SESSION['img_files']); exit;
				$_SESSION['img_files'][]=$img_src;
				
				$_SESSION['img_count']++;
					echo "Image uploaded successfully!";
				}
				else {
                    echo "failed";
                }
            }
			else {
                echo "File size exceeded the max 5 MB";
            }
			//var_dump($_SESSION['img_files']);
	}
	//
	 
	
	if(isset($_POST['index'])){
		$i=$_POST['index'];
		unlink('photo_gallery/'.$_SESSION['img_files'][$i-1]);
		array_splice($_SESSION['img_files'], $i-1, 1);
		$_SESSION['img_count']--;
		echo "Image deleted successfully!";
		//var_dump($_SESSION['img_files']);
	}
	//
	if(isset($_POST['get_file'])){
		echo end($_SESSION['img_files']);
	}
			
}