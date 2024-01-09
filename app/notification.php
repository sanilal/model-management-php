<?php
ob_start();
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents - Notifications </title>
   
</head>

<body>

    
    <img src="images/loading.gif" style="display:none" />
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">

        <!-- Jumbotron Header -->
        <div class="row">
        <?php
			session_start();
			//var_dump($_SESSION['deviceid']);
			require_once("../config/db.php");
			 $db_connection=db_connect();
			 $cnter=0;
			 $check_id=0;
			 if(isset($_SESSION['deviceid'])){
				 
			 	$res_not_dev=$db_connection->query("SELECT * FROM device_notes WHERE device_id = '".$_SESSION['deviceid']."' ORDER BY id DESC");
				$row_not_dev=$res_not_dev->fetch_object();
				if($row_not_dev->id){
					$check_id=$row_not_dev->last_note_id;
				}
			 }
			 $notes = $db_connection->query("SELECT * FROM notification WHERE status = 1 ORDER BY id DESC LIMIT 0,20");
			 $last_id=NULL;
			 while($n_row = $notes->fetch_object()){
				 if($cnter==0){$last_id=$n_row->id;}
		 ?>
        	<div class="col-md-12 text-center <?php if($check_id >= $n_row->id){ echo "disabled";} ?>"> 
            	<div><b><?php echo $n_row->title; ?></b></div>
                <p><?php echo $n_row->text; ?></p>
                <hr style=" background:#686666; height:2px; border:none; margin:10px auto;"/>
            </div>
            <?php $cnter++; } ?>
            <?php 
				if($cnter==0){ ?>
					<div class="col-md-12 text-center"> 
                    <div><b>No new notifications</b></div>
                    </div>
			<?php	}
			if(isset($_SESSION['deviceid'])){
				if($last_id){
					if($row_not_dev->id){
						$dev_note = $db_connection->query("UPDATE device_notes SET last_note_id=".$last_id." WHERE id=".$row_not_dev->id);
					}
					else{
						$dev_note = $db_connection->query("INSERT INTO device_notes (device_id,last_note_id) VALUES ('".$_SESSION['deviceid']."',".$last_id.")");
					}
				}
			}
			?>
        
        </div>

       <!-- <hr>-->
		
        <!-- Title -->
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
    <?php /*?></div><?php */?>
</body>

</html>
