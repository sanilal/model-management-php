<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php
ob_start();
		
	if(isset($_POST['action'])){
		if($_POST['action']=="checkout"){
			session_start();
			//
			  $to = "heshani@flcmodels.com";
			  //$to = "augustian@iconceptme.com";
			  $from = $_POST["email"];
			  $subject = "New request placed through mobile application";
		  
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
				<h3 style="font-family: Tahoma,Geneva,sans-serif;"> The following SHORTLIST requested through mobile application</h3>
						
						<table style="font-family: Tahoma,Geneva,sans-serif;" width="905" border="0" cellpadding="0" cellspacing="0">
                	<tr bgcolor="#000000" style="font-size: 13px; font-weight:bold; color:#FFF">
                    	<th>Sl.No</th><th colspan="2">Model</th><th>Age</th>
                     </tr>';
				$k=1;
				foreach ($_SESSION['models'] as $model){
							require_once("../config/db.php");
							require_once("../classes/Models.php");
							$models = new Models();
							$model_res = $models->getModels(NULL,$model,NULL);
							$row=$model_res->fetch_object();
							$sub_folder=$models->getImageFolder($row->Resource_ID);
							$test_path=glob(image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  	$img_path=$test_path[0];
							//$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
							//echo $img_path;
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
			  //
			  $db_connection=db_connect();
			  $result=true;
			  $checkuser = $db_connection->query("SELECT name, email FROM app_users WHERE email = '".$_POST["email"]."'");
              if ($checkuser->num_rows == 0) {
				  $stmt = $db_connection->prepare("INSERT INTO app_users (name, email, company, address, date_of_join	) VALUES(?,?,?,?,?)");
				  $stmt->bind_param("sssss",$_POST["name"],$_POST["email"],$_POST["company"],$_POST["address"],date('Y-m-d H:i:s'));
				  $result=$stmt->execute();
			  }
			  if($result){
				  
			  ///
			  
			  if(mail($to, $subject, $message, $headers)){
				  mail("iconceptfze@gmail.com", $subject, $message, $headers);
					$_SESSION['models'] = array();
					unset($_SESSION['models']);
            		session_destroy();
					?>
                    <!DOCTYPE html>
                    <html lang="en">
                    
                    <head>
                        
                       <?php include_once("includes/head_common.php");  ?>
                       <title>FLC Models &amp; Talents - Shortlist </title>
                       
                       
                    </head>
                    <body>
                        <div id="slideshow">
    
                        </div>
                             <?php include_once("includes/header.php"); ?>
                        <!-- Page Content -->
                        <div class="container inner_content">
                            <!-- Jumbotron Header -->
                             <header class="hero-spacer" style="margin:15px 0px">
                                <div>
                                    <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                                    
                                    <span class="title-red">Shortlist</span>
                                </div>
                            </header>
                    
                            <div class="row content-main" style="color:#5ece4a">
                            	<div class="col-sm-12" >
                                    Thank you for your enquiry and our team will contact you at the earliest.
                                </div>
                            </div>
                        </div>
                    </body>
                    
                  <?php  
				}
			  }
		 	 else{
				header('Location:cart.php');
			}
			//
			}
			else{
				header('Location:cart.php');
			}
		}
	}
	?>