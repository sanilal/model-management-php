<?php
ob_start();
		
	if(isset($_POST['action'])){
		if($_POST['action']=="checkout"){
			
			session_start();
			//
			///////////////////\
			  //////
			  require_once("../config/db.php");
			  require_once("../classes/Login.php");
			  $login = new Login();
			  $user_id=intval($_SESSION['user_id']);
			
			  $user_dat=$login->getUserData($user_id);
			  
			  $user_row=$user_dat->fetch_object();
			  $signature=$user_row->signature;
			  
			  $from_email= $user_row->user_name.'<'.$user_row->user_email.'>';
			  //////////////\
			  ///
			  $to_array = $_POST['to_email'];
			  $from =  $from_email;
			  $subject = $_POST['subject'];
		  		$cc_mails=$_POST['cc_email'];
			  //begin of HTML message
			  $newTxt = str_replace("\n",'<br>',$_POST['remarks']);
			  if(isset($_SESSION['models_man'])){
			  	$message= '<html>
 						 <body style="font-family:Arial;font-size:14px"> 
						 <p style="font-size:14px">'.$newTxt.'</p>
						
						
						<table border="0" cellspacing="0" cellpadding="0">';
				$k=1;
				
				foreach ($_SESSION['models_man'] as $model){
							
							require_once("../classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							
				$img_path1=""; $img_path2=""; $img_path3=""; $img_path4=""; $img_path5=""; $img_path6="";
            	$sub_folder=$models->getImageFolder($row->Resource_ID);
				define('IMAGEPATH',"http://". $_SERVER["HTTP_HOST"] ."/app/image.php?img=../".image_path);
					$test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
					$img_path="http://". $_SERVER["HTTP_HOST"] ."/app/image.php?img=".$test_path[0];
					$all_imgs=glob("../".image_path.$sub_folder."/".$row->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//sort
					natsort($all_imgs);
					//
					$k=1;
					foreach($all_imgs as $filename){
						$ext=pathinfo($filename, PATHINFO_EXTENSION);
						$img=basename($filename);
						if(basename($img,".".$ext)!=$row->Resource_ID."_01"){
							${'img_path'.$k}=IMAGEPATH.$sub_folder."/".$img;
							$k++;
						}
							//echo basename($filename);
					}
					
							
							
							$message.='<tr>
										<td>
											<div style="float:left;height:511px;margin-right:5px;overflow:hidden;padding-top:5px;width:340px;">
												
												<img src="'.$img_path.'" width="310" /> 
											</div>
										</td>
										<td>
											<div style="float:left; text-align:left; color:#666; padding-left:10px; font-size:14px">
											<table>
											<tr>
											<td>
											
												<div style="margin-bottom:5px; font-family: arial;font-size:14px">'.$row->First_Name.'</div> 
											<td colspan="2" align="right">
												<div style="float:right; font-family: arial;font-size:14px"> ID No. '. $row->Resource_ID.'</div>
											</td>
											</td>
											</tr>
											<tr>
												<td>
											
												<div style="float:left;  height:200px; margin-right:10px; overflow:hidden; width:160px;"> 
													
														<img src="'.$img_path1.'" width="160" height="200"/> 
													
												 </div>
												 </td>
												 <td>
												<div style="float:left;  height:200px; margin-right:10px; overflow:hidden; width:160px;">
													
														
														<img src="'.$img_path2.'" width="160" height="200"/> 
													
												</div>
												</td>
												<td>
												<div style="float:left;  height:200px; margin-right:10px; overflow:hidden; width:160px;">
													
														
														 <img src="'.$img_path3.'" width="160" height="200" />
													
												</div>
											</td>
											</tr>
											<tr>
											<td colspan="3" height="1">
											 
											</td>
											</tr>
											<tr>
											<td>
											
												<div style="float:left;  height:200px; margin-right:10px; overflow:hidden; width:160px;">
													
														
														<img src="'.$img_path4.'" width="160" height="200"/> 
													
												</div>
												</td>
												 <td>
												 <div style="float:left;  height:200px; margin-right:12px; overflow:hidden; width:160px;"> 
													
														
														<img src="'.$img_path5.'" width="160" height="200" />
													
												 </div>
												 </td>
												 <td>
												<div style="float:left;  height:200px; margin-right:10px; overflow:hidden; width:160px;">
													
														
														<img src="'.$img_path6.'" width="160" height="200" />
													
												</div>
												</td>
											</tr>
											<tr>
											<td  colspan="3">
											<div style=" clear:both; font-size:14px; text-align:left; color:#666; padding:7px 4px 0px 0px">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="left" style="font-family: arial;font-size:14px">
												
															Height:'. $row->Height.'
														</td>
													
														<td width="10">|</td>
												
														
														<td align="left" style="font-family: arial;font-size:14px">
												 
													Bust:'.$row->Bust.'
												
														</td>
														<td width="10">|</td>
														<td align="left" style="font-family: arial;font-size:14px">
												
													Waist:'. $row->Waist.'
											   
														</td>
														<td width="10">|</td>
														<td align="left" style="font-family: arial;font-size:14px">
											   
													Hips:'. $row->Hips.'
											   
														</td>
														
													</tr>
													<tr>
														<td colspan="7" height="10"></td>
													</tr>
													<tr>
														
															   
														<td align="left" style="font-family: arial;font-size:14px">
												
													Eyes:'. $row->EyesColor.'
												
														</td>
														<td width="10">|</td>
														<td align="left" style="font-family: arial;font-size:14px">
												
													Hair:'. $row->HairColor.' 
											   
														</td>
														<td width="10">|</td>
														<td align="left" style="font-family: arial;font-size:14px">
												
													Shoes:'. $row->ShoesSize.'
											   
														</td>
														<td width="10">|</td>
														<td align="left" style="font-family: arial;font-size:14px">
												
													Skin:'. $row->SkinColor.'
											   
														</td>
													</tr>
														  
											</table>
										</div>
										</td>
									</tr>
									</table>
									</td></tr>
									<tr>
										<td colspan="2" style="font-family: arial;font-size:14px">
											<a href="http://'. $_SERVER["HTTP_HOST"] . '/profile.php?res_id='.$row->Resource_ID.'"> click to view <b>'.$row->First_Name.'</b> profile</a>
										</td>
									</tr>
									<tr>
										<td colspan="2" height="20" valign="middle"><hr/></td>
									</tr>';
						$k++;
                        }
			  $message .= '</table>'.$signature.'
			  				
			 		 </body></html>';
			 //end of message
			  // To send the HTML mail we need to set the Content-type header.
			  $headers  = 'MIME-Version:1.0' . "\r\n";
    		$headers .= 'Content-type:text/html; charset=iso-8859-1' . "\r\n";
			 $headers  .= 'From:'.$from . "\r\n";
    		 $headers .= 'Cc:'.$cc_mails . "\r\n" ; 
			 //var_dump($cc_mails); exit();
			  //options to send to cc+bcc
			  //$headers .= "Cc:[email]maa@p-i-s.cXom[/email]";
			  //$headers .= "Bcc:[email]email@maaking.cXom[/email]";
			  
			  // now lets send the email.
			  $status=1;
			  
			  if(!mail($to_array, $subject, $message, $headers)){
				  $status=0;
				  echo'<script>alert("Failed: Please check entered emails"); window.location.href ="cart.php"; </script>';
				  //header('Location:cart.php');
				  	
				  }
			 /* foreach($to_array as $to){
				  if(!mail($to, $subject, $message, $headers)){
				  	$status=0;
				  }
						
			  }*/
			  if($status==1){	
			  	$_SESSION['models_man'] = array();	
			 	echo'<script> alert("Message: Successfully send to the emails");  window.location.href ="cart.php"; </script>';
				
				//header('Location:cart.php');
			  }
		  
			//
			}
		}
	}
	?>