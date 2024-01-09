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
	if(isset($_POST["note_add"])){
         $note_query = $db_connection->query("INSERT INTO notification (title, text, status, created_date) VALUES ('".$_POST['title']."', '".$_POST['text']."', '".$_POST['status']."','".date('Y-m-d H:i:s')."') ");
		 if($note_query){
			$message="New notification added successfully";	
			if($_POST['status']=="1"){
				////
				require_once("classes/pushfunction.php");
				$device_res = $db_connection->query("SELECT device_id FROM app_devices WHERE device='android'");
				$dev_ids=array(); 
				while($dev_row=$device_res->fetch_object()){
					$dev_ids[]=$dev_row->device_id;
				}
				$msg = array
				(
					'message' 	=> substr($_POST['title'],0,200),
					'title'		=> $_POST['title'],
					'subtitle'	=> '',
					'tickerText'	=> '',
					'vibrate'	=> 1,
					'sound'		=> 1,
				);
				$res=sendPushNotificationToGCM($dev_ids, $msg);
				//var_dump($res);
				///Apple
				// Put your device token here (without spaces):
				//$deviceToken = '82f927999213724825ec1e3c05ab68cdce14c4edc767e7dba1352f96072d1cfb';
				$deviceToken = 'd320fc7201c9fed5959d531cc8afea04fb40e20c45692ca90f846d178ed2e8ee';
				
				// Put your alert message here:
				$message = substr($_POST['title'],0,200);
				
				// Put your private key's passphrase here:
				$passphrase = 'flc@987';
				
				////////////////////////////////////////////////////////////////////////////////
				
				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', 'fk.pem');
				stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
				
				// Open a connection to the APNS server
				$fp = stream_socket_client(
					'ssl://gateway.push.apple.com:2195', $err,
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
				
				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);
				
				echo 'Connected to APNS' . PHP_EOL;
				
				// Create the payload body
				$body['aps'] = array(
					'alert' => $message,
					'sound' => 'default'
					);
				
				// Encode the payload as JSON
				$payload = json_encode($body);
				
				$idevice_res = $db_connection->query("SELECT device_id FROM app_devices WHERE device='iphone'");
				$idev_ids=array(); 
				while($idev_row=$idevice_res->fetch_object()){
					$idev_ids[]=$idev_row->device_id;
				}
				foreach($idev_ids as $idev_id){
				// Build the binary notification
					$msg = chr(0) . pack('n', 32) . pack('H*', $dev_id) . pack('n', strlen($payload)) . $payload;
					$result = fwrite($fp, $msg, strlen($msg));
				}
				
				// Send it to the server
				
				
				//if (!$result)
					//echo 'Message not delivered' . PHP_EOL;
				//else
					//echo 'Message successfully delivered' . PHP_EOL;
				
				// Close the connection to the server
				fclose($fp);
				//////Apple close
				
			}
		}
		else{ $error="Error occured";}
	}
	if(isset($_POST["del_note"])){
		$note_query = $db_connection->query("DELETE FROM notification WHERE id=".$_POST['note_id']);
		 if($note_query){
			$message="Selected notification deleted successfully";	
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
.data_table{ border:1px solid #ccc}
.data_table tr:nth-child(even) {
    background-color: #f2f2f2;
}
.data_table tr:nth-child(odd) {
    background-color: #fff;
}
.data_table tr{ border-bottom:1px solid #d0d0d0; padding:4px;}

img{ border:none}
.dialog_bg{
	background-color:#666;
	filter:alpha(opacity=50);
	left:0;
	opacity:0.5;
	position:fixed;
	top:0;
	width:100%;
	height:100%;
	z-index:1000;
	display:none
}
.dialog_form{
	min-width: 370px;
	top: 35%;
	left: 40%;
	margin-top: -170px;
	margin-left: -340px;
	overflow:hidden;
	z-index:1002;
	position:fixed;
	display:none;
	-moz-box-shadow:rgba(0,0,0,.2) 0 4px 16px;
	-webkit-box-shadow:rgba(0,0,0,.2) 0 4px 16px;
	background-color:#fff;
	border:1px solid #666;
	box-shadow:rgba(0,0,0,.2) 0 4px 16px;
	min-height:300px; text-align:left; line-height:25px; padding-bottom: 10px;
}
.close-bg{background-color:#333333; height: 31px; left: 24px; top: 1px; color:#F3F3F3; /*width: 100%;*/}
.pop_content{ padding:8px;  }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	///
	jQuery(function(){
		jQuery(".dialog_bg").click(function(){
			pop_close();
		}) 
		///
	})
	
	function popup(){
		jQuery(".dialog_bg").show()
		jQuery(".dialog_form").fadeIn('fast');
	}
	function pop_close(){
		jQuery(".dialog_form").fadeOut('fast');
		jQuery(".dialog_bg").hide()
		jQuery(".loading_div").show();
	}
	//
	function create_note(){
		popup();
	}
	function confirm_del(obj){
		var conf=confirm("Are you sure want to delete this notification!!!")
		if(conf){
			return true;
		}
		else{
			return false;
		}
	}
</script>

</head>

<body>
<div class="dialog_bg"></div>
<div class="dialog_form" style="width:auto">
    <div class="close-bg" > Add new notification
        <a onclick="pop_close();" style="float: right; margin-right: 3px; margin-top: 3px; cursor:pointer">
            <img border="0" src="../../image/close-pop.png">
        </a>
    </div>      
    <div class="pop_content">
    	<form method="post" action="" enctype="multipart/form-data" >
          <table style="margin: 0 auto;">
              
              <tr>
                  <td width="30%">
                      <!-- the user name input field uses a HTML5 pattern check -->
                      <label for="note_title">Notification Title</label>
                  </td>
                  <td>
              <input id="note_title"  type="text" name="title" required autocomplete="off"  />
                  </td>
              </tr>
             <tr><td colspan="2">&nbsp;</td></tr>
              <tr>
                  <td >
                      <label for="note_desc">Content</label>
                  </td>
                  <td>
                      <textarea id="note_desc" name="text" class="textarea" style=" width:100%"> </textarea>
                  </td>
              </tr>
              <tr><td colspan="2">&nbsp;</td></tr>
               <tr>
                  <td>
                      <label for="Status">Status </label>
                  </td>
                  <td>
                      <select name="status" id="Status">
                      	<option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                  </td>
              </tr>
              
              <tr>
                  <td colspan="2" align="center"> 
                      <input type="submit" name="note_add" value="SUBMIT" />
                  </td>
               </tr>
               
           </table>       
      </form>
                
    </div>
</div>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td>
            	<span class="title-grey">Admin Panel &gt;</span>
                <span class="title-red">
            		Notifications
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
            <p><input type="button" value="Create" onclick="create_note()" style="font-size:14px; font-weight:bold" /></p>
            <table width="90%" class="data_table">
                <tr style="background:#353030; color:#Fff">
                    <th>Title</th><th>Text</th><th>Status</th><th>Edit</th><th>Delete</th>
                </tr>
                    <?php
                    $notes = $db_connection->query("SELECT * FROM notification ORDER BY id DESC ");
                    while($n_row=$notes->fetch_object()){
                    ?>
                    <tr>
                        <td><?php echo $n_row->title; ?></td><td><?php echo $n_row->text; ?></td><td><?php if($n_row->status==1){ echo "Active";} else{ echo "Inactive";} ?></td>
                        <td><a href="edit_note.php?id=<?php echo $n_row->id; ?>">Edit</a></td> 
                        <td><form action="" method="post" onsubmit="return confirm_del(this)">
								<input type="hidden" name="note_id" value="<?php echo $n_row->id; ?>" />
                                <input type="submit" name="del_note" value="Delete"  />
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </td>
              </tr>
          </table>
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