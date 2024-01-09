<?php
header("Cache-Control: no-cache, must-revalidate");
ob_start();		
	if(isset($_POST['getdata'])){
		if($_POST['getdata']=="note_count"){			
			require_once("../config/db.php");
			 $db_connection=db_connect();
			 session_start();
			 $check_sql="";
			 //var_dump($_SESSION['deviceid']);
			 if(isset($_SESSION['deviceid'])){
				 $res_not_dev=$db_connection->query("SELECT * FROM device_notes WHERE device_id = '".mysqli_real_escape_string($db_connection,$_SESSION['deviceid'])."' ORDER BY id DESC");
					$row_not_dev=$res_not_dev->fetch_object();
					if($row_not_dev->id){
						$check_sql=" && id > ".$row_not_dev->last_note_id;
					}
			  }
			 $notes_cnt = $db_connection->query("SELECT count(id) as not_count FROM notification WHERE status = 1 ".$check_sql);
			 //var_dump($notes_cnt->fetch_object());
			 $n_cnt = $notes_cnt->fetch_object();
			 echo $n_cnt->not_count;
		}
	}
	?>