<?php
ob_start();
/**
* A simple, clean and secure PHP Login Script

*/

// include the configs / constants for the database connection
require_once("../../config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
	$message=""; $error="";
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
	$db_connection=db_connect();
	if(isset($_POST["note_edit"])){
         $note_query = $db_connection->query("UPDATE notification SET title='".$_POST['title']."', text='".$_POST['text']."', status='".$_POST['status']."' WHERE id=".$_POST['note_id']);
		 if($note_query){
			$message="Selected notification updated successfully";	
			if($_POST['status']=="1"){
				require_once("classes/pushfunction.php");
				$device_res = $db_connection->query("SELECT device_id FROM app_devices");
				$dev_ids=array(); 
				while($dev_row=$device_res->fetch_object()){
					$dev_ids[]=$dev_row->device_id;
				}
				sendPushNotificationToGCM($dev_ids, $_POST['title']);
			}
		}
		else{ $error="Error occured";}
	}
	
    ?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Admin Panel</title>
<link href="../../css/flc.css" rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="bootstrap3-wysihtml5.min.css">
<style type="text/css">

.content{ min-height:581px}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>

</head>

<body>

<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td>
            	<a class="title-grey" href="notifications.php">Notifications &gt;</a>
                <span class="title-red">
            		Edit Notifications
            	</span>
            </td>
          </tr>
          <tr>
            <td>
             <?php
                    
                    // show negative messages
                    if ($error!="") { ?>
                    <div class="errors">
                      <?php echo $error; ?>
                       </div>
                    <?php
                    }
                    
                    // show positive messages
                    if ($message!="") {
						?>
                        <div class="messages">
                        <?php echo $message; ?>
                         </div>
                       <?php 
                    }
                
                ?>
            </td>
          </tr>
          <tr>
            <td>
            <?php
            $notes = $db_connection->query("SELECT * FROM notification WHERE id=".$_GET['id']);
            $n_row=$notes->fetch_object();
			?>
          		<form method="post" action="" enctype="multipart/form-data" >
                  <table style="margin: 0 auto;">
                      <tr>
                          <td width="30%">
                              <!-- the user name input field uses a HTML5 pattern check -->
                              <label for="note_title">Notification Title</label>
                          </td>
                          <td>
                      <input id="note_title"  type="text" name="title" required autocomplete="off" value="<?php echo  $n_row->title; ?>" />
                          </td>
                      </tr>
                     <tr><td colspan="2">&nbsp;</td></tr>
                      <tr>
                          <td >
                              <label for="note_desc">Content</label>
                          </td>
                          <td>
                              <textarea id="note_desc" name="text" class="textarea" style=" width:100%"><? echo  $n_row->text; ?></textarea>
                          </td>
                      </tr>
                      <tr><td colspan="2">&nbsp;</td></tr>
                       <tr>
                          <td>
                              <label for="Status">Status </label>
                          </td>
                          <td>
                              <select name="status" id="Status">
                                <option value="1" <?php if($n_row->status=="1"){ echo 'selected="selected"';} ?>>Active</option>
                                <option value="0"  <?php if($n_row->status=="0"){ echo 'selected="selected"';} ?>>Inactive</option>
                              </select>
                          </td>
                      </tr>
                      
                      <tr>
                          <td colspan="2" align="center"> 
                          		<input type="hidden" name="note_id" value="<?php echo $n_row->id; ?>" />
                              <input type="submit" name="note_edit" value="SUBMIT" /> &nbsp; &nbsp;&nbsp; <a href="notifications.php">Cancel</a>
                          </td>
                       </tr>
                       
                   </table>       
              </form>  
            </td>
          </tr>
        </table>
    
    </div>


</div>

<!---------------------------------------------------------------main_content_end------------------------------------------------------------------>

<!-------------------------------------------------------------------footer------------------------------------------------------------------------------------->
<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>
<!-----------------------------------------------------------------------footer---------------------------------------------------------------------------------------->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap3-wysihtml5.all.min.js"></script>
 <script type="text/javascript">
 	$(function () {
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
 </script>
</body>
</html>
    <?php
    
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
   header("Location:index.php?logout");
}