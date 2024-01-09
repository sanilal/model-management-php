<?php

$filename=urldecode($_GET['img']);
if (($img_info = getimagesize($filename)) === FALSE)
  die("Image not found or not an image");
//
switch ($img_info[2]) {
  case IMAGETYPE_GIF  : $img = imagecreatefromgif($filename);  break;
  case IMAGETYPE_JPEG : $img = imagecreatefromjpeg($filename); break;
  case IMAGETYPE_PNG  : $img = imagecreatefrompng($filename);  break;
  default : die("Unknown filetype");
}
  
//$img = imagecreatefromjpeg($filename);
//var_dump($img);
header("Content-Type: image/jpeg");
imagejpeg($img, NULL, 35);

?>