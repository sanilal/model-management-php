<?php
//mysqli::close (  );
 $url = mysqli_connect("p:localhost","models_com","KXwEakljkjkNew","models_com")  or die("Connection failed".mysqli_connect_error());
 define('TB_pre','');
 define("image_path", "../FLC_Resource_Image_Folders/");
 
 function str_clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

function getImageFolder($id){
		if($id!=NULL){
			$str = $id;
		    preg_match("/([0-9]+[\.,]?)+/",$str,$matches);
		    $val = $matches[0];
			$flder_no=ceil($val/100);
			return str_pad($flder_no, 2, "0", STR_PAD_LEFT); 
			
		}
		
	}
 ?>