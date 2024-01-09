<?php
ob_start();
		
	if(isset($_POST['action'])){
		if($_POST['action']=="checkout"){
			session_start();
			//
			  $to_array = explode(",",$_POST['email']);
			  $from = "info@flcmodels.com";
			  $subject = "Profile Details From FLC Models";
		  
			  //begin of HTML message
			  if(isset($_SESSION['models_man'])){
			  	$message= '<html>
 						 <body bgcolor=\"#DCEEFC\"> 
				<h3 style="font-family: Tahoma,Geneva,sans-serif;">Profile Details</h3>
						<p>'.$_POST['remarks'].'</p>
						<table style="font-family: Tahoma,Geneva,sans-serif;" width="905" border="0" cellpadding="0" cellspacing="0">
                	<tr bgcolor="#000000" style="font-size: 13px; font-weight:bold; color:#FFF">
                    	<th>Sl.No</th><th colspan="6">Model</th><th>Age</th>
                     </tr>';
				$k=1;
				echo $message;
				foreach ($_SESSION['models_man'] as $model){
							require_once("../config/db.php");
							require_once("../classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$img_path="../../FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
							echo $img_path;
							if(!file_exists($img_path)) {
								$img_path="demo/image/model_thumb.jpg";
							}
							else{
								$img_path="FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
							}
							//
							
							$img_path1='<td><img src="http://'. $_SERVER["HTTP_HOST"] .'/FLC_Resource_Images/'.$row->Resource_ID.'_02.jpeg" width="250" height="380" /> </td>';
							if(!file_exists("../../FLC_Resource_Images/".$row->Resource_ID."_02.jpeg")) {
								$img_path1="<td><&nbsp;/td>";
							}
							$img_path2='<td><img src="http://'. $_SERVER["HTTP_HOST"] .'/FLC_Resource_Images/'.$row->Resource_ID.'_03.jpeg" width="250" height="380" /> </td>';
							if(!file_exists("../../FLC_Resource_Images/".$row->Resource_ID."_03.jpeg")) {
								$img_path2="<td><&nbsp;/td>";
							}
							$img_path3 ='<td><img src="http://'. $_SERVER["HTTP_HOST"] .'/FLC_Resource_Images/'.$row->Resource_ID.'_04.jpeg" width="250" height="380" /> </td>';
							if(!file_exists("../../FLC_Resource_Images/".$row->Resource_ID."_04.jpeg")) {
								$img_path3="<td><&nbsp;/td>";
							}
							//
							$img_path4='<td><img src="http://'. $_SERVER["HTTP_HOST"] .'/FLC_Resource_Images/'.$row->Resource_ID.'_05.jpeg" width="250" height="380" /> </td>';
							if(!file_exists("../../FLC_Resource_Images/".$row->Resource_ID."_05.jpeg")) {
								$img_path4="<td><&nbsp;/td>";
							}
                        $message.='<tr bgcolor="#E1E1E1" style="border:2px solid #5A5858">
                            	<td>'.$k.'</td>
                                <td><img src="http://'. $_SERVER["HTTP_HOST"] .'/'.$img_path.'" width="250" height="380" /> </td>'.$img_path1.$img_path2.$img_path3.$img_path4.								
                                '<td><a href="http://'. $_SERVER["HTTP_HOST"] . '/demo/profile.php?res_id='.$row->Resource_ID.'"> '.$row->First_Name.'</a></td>
                                <td>'.$row->Age.'</td>
                            </tr>
                            <tr bgcolor="#686666">
                            	<td colspan="5" style="padding:0px; height:3px"></td>
                            </tr>';
						$k++;
                        }
			  $message .= '</table>
			  				
			 		 </body></html>';
			 //end of message
			  // To send the HTML mail we need to set the Content-type header.
			 $headers  = "From: $from\r\n";
    			$headers .= "Content-type: text/html\r\n"; 
			  //options to send to cc+bcc
			  //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
			  //$headers .= "Bcc: [email]email@maaking.cXom[/email]";
			  
			  // now lets send the email.
			  $status=1;
			  
			  foreach($to_array as $to){
				  if(!mail($to, $subject, $message, $headers)){
				  	$status=0;
				  }
						
			  }
			  if($status==1){	
				$_SESSION['models_man'] = array();	
				header('Location:cart.php');
			  }
		  
			//
			}
		}
	}
	?>