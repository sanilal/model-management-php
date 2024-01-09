<?php
error_reporting(0);
ob_start();
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
else if($_SESSION['user_id']=="" || $_SESSION['user_id']==NULL){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
include("includes/conn.php"); 
//var_dump($_SESSION['user_id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w =300; 
	$targ_h = 480;
	$jpeg_quality = 100;

	$src = $_POST['img_val'];
	//$img_r = imagecreatefromjpeg($src);
	$img_r=imagecreatefromstring(file_get_contents($src));
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	//header('Content-type: image/jpeg');
	$extension_pos = strrpos($_POST['img_val'], '.'); // find position of the last dot, so where the extension starts
	if(is_numeric($_POST['model_id'])){
		$croped_name = substr($_POST['img_val'], 0, $extension_pos) . '_cr' . substr($_POST['img_val'], $extension_pos);
		$img_name=ltrim($src,"../photo_gallery/");
		rename($src,"../deleted-images/".$img_name);
	}
	else{
		$sub_folder=getImageFolder($_POST['model_id']);
		$croped_name = substr($_POST['img_val'], 0, $extension_pos) . '-cr' . substr($_POST['img_val'], $extension_pos);
		$img_name=ltrim($src,image_path.$sub_folder."/");
		rename($src,"../deleted-images/".$img_name);	
	}
	imagejpeg($dst_r,$croped_name,$jpeg_quality);
	
	echo 'saved';
	exit;
}
?>

 <?php 
 if(isset($_GET['m_id'])){
	$img_val=$_GET['img'];
}
  //$models_query=mysqli_query($url,"select * from `Smart_FLC_Resource_Details` WHERE Resource_ID LIKE '%".$_GET['q_val']."%' OR First_Name LIKE '%".$_GET['q_val']."%' OR Last_Name LIKE '%".$_GET['q_val']."%' LIMIT 100");
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID LIKE '%".$_GET['q_val']."%' OR fname LIKE '%".$_GET['q_val']."%' OR lname LIKE '%".$_GET['q_val']."%' LIMIT 100";
  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0; ">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section>

        <div class="box box-primary">
              
                <div class="box-body">
                 <img src="<?php echo $img_val; ?>" id="cropbox" />
                <!-- This is the form that our event handler fills -->
                <form action="" method="post" onsubmit="return checkCoords();" id="crop_from">
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" name="img_val" value="<?php echo $img_val; ?>" />
                    <input type="hidden" name="model_id" value="<?php echo $_GET['m_id']; ?>" />
                    <button type="submit" class="btn btn-large btn-inverse has-spinner" >
                    	<span class="spinner"><i class="fa fa-spin fa-refresh"></i></span> Crop Image
                     </button>
                </form>
                </div><!-- /.box-body -->
             
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <style type="text/css">
      .spinner {
  display: inline-block;
  opacity: 0;
  max-width: 0;

  -webkit-transition: opacity 0.25s, max-width 0.45s; 
  -moz-transition: opacity 0.25s, max-width 0.45s;
  -o-transition: opacity 0.25s, max-width 0.45s;
  transition: opacity 0.25s, max-width 0.45s; /* Duration fixed since we animate additional hidden width */
}

.has-spinner.active_crop {
  cursor:progress;
}

.has-spinner.active_crop .spinner {
  opacity: 1;
  max-width: 50px; /* More than it will ever come, notice that this affects on animation duration */
}
      </style>
<script type="text/javascript">
//crop
	

    $('#cropbox').Jcrop({
      aspectRatio: 0.64,
      onSelect: updateCoords
    });

  

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    //e.preventDefault();
	if (parseInt($('#w').val())) {
		//alert("Croping");
		jQuery(".has-spinner").toggleClass('active_crop');
		$.ajax({
				  type: 'POST',
				  url: "crop_image.php",
				  data: $("#crop_from").serialize(),
				  success: function(message) {
					  if(message=="saved"){ alert("Croped"); 
				  		//alert($("#crop_from").parent().parent().parent().parent().html());
					  $("#crop_from").parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".bootstrap-dialog-footer button").click()
					  //dialog_reload();
					  <?php
					  $trim_val=ltrim($img_val,'../');
					  $extension_pos = strrpos($trim_val, '.'); // find position of the last dot, so where the extension starts
	$croped_name = substr($trim_val, 0, $extension_pos) . '_cr' . substr($trim_val, $extension_pos);
					  ?>
					  $('input[value="<?php echo $trim_val; ?>"]').val("<?php echo $croped_name; ?>");
					  //$("#update_button").click();
					  $("#mail_edit_form").submit();
				 	 }
				  }
			});
	}
	else{
    	alert('Please select a crop region then press submit.');
    	
	}
	return false;
  };
  //crop ends
</script>
<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    

<?php ob_end_flush(); ?>