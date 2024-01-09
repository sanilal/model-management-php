<?php
ob_start();
		
	if(isset($_POST['action'])){
		if($_POST['action']=="checkout"){
			session_start();
			//
			  $to = "heshani@flcmodels.com";
			  $from = $_POST["email"];
			  $subject = "New request placed on flcmodels.com";
		  
			  //begin of HTML message
			  if(isset($_SESSION['models'])){
			  	$message= '<html>
 						 <body bgcolor=\"#DCEEFC\"> 
						 <table>
							<tr>
								<td colspan="4">Requestor Details</td>
							</tr>
							<tr>
								 <td width="100" >Full Name: </td><td>'.$_POST["name"].'</td>
                            
                                <td>Email: </td><td>'.$_POST["email"].'</td>
								<td>Contact Number: </td><td>'.$_POST["phone"].'</td>
							</tr>
							<tr>
								 <td width="100" >Company: </td><td>'.$_POST["company"].'</td>
                            
                                <td>Address: </td><td>'.str_replace("\n",'<br>',$_POST["address"]).'</td>
							</tr>
							<tr>
								<td> Remarks:</td><td>'.str_replace("\n",'<br>',$_POST['remarks']).'</td>
								<td colspan="2"> &nbsp;</td>
							</tr>
						</table>	
				<h3 style="font-family: Tahoma,Geneva,sans-serif;"> The following SHORTLIST request placed on flcmodels.com</h3>
						
						<table style="font-family: Tahoma,Geneva,sans-serif;" width="905" border="0" cellpadding="0" cellspacing="0">
                	<tr bgcolor="#000000" style="font-size: 13px; font-weight:bold; color:#FFF">
                    	<th>Sl.No</th><th colspan="2">Model</th><th>Age</th>
                     </tr>';
				$k=1;
				foreach ($_SESSION['models'] as $model){
							require_once("config/db.php");
							require_once("classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
							echo $img_path;
							/*if(!file_exists($img_path)) {
								$img_path="demo/image/model_thumb.jpg";
							}
							else{
								$img_path="FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
							}*/
                        $message.='<tr bgcolor="#E1E1E1" style="border:2px solid #5A5858">
                            	<td>'.$k.'</td>
                                <td><img src="http://'. $_SERVER["HTTP_HOST"] .'/'.$img_path.'" width="50"  /> </td>
                                <td><a href="http://'. $_SERVER["HTTP_HOST"] . '/profile.php?res_id='.$row->Resource_ID.'"> '.$row->First_Name.'</a></td>
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
			  $headers  = "MIME-Version:1.0 \r\n";
    		$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
			 $headers  .= "From: $from\r\n";
			  //options to send to cc+bcc
			  //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
			  //$headers .= "Bcc: [email]email@maaking.cXom[/email]";
			  
			  // now lets send the email.
			  if(mail($to, $subject, $message, $headers)){
					$_SESSION['models'] = array();
            		//session_destroy();
					header('Location:cart.php');
				}
		  
			//
			}
		}
	}
	?>