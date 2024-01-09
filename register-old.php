<?php
error_reporting(0);
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Dubai based Production & Model Management Agency - Models Register, Casts Register, Talents Register, Artists Registration form</title>
	<?php include_once('md_includes/head.php'); ?>
     
 <style type="text/css">

.contenter a{ color:#E70310}
.error_red{ border:1px solid #DF1518}
.mail_error{ color:#DF1518;}
</style>
<script type="text/javascript">
	function validate_form(){
		var check=1;
		$(".required").each(function(){
			//alert($(this).val());
			if($(this).val()==""){
				check=0;
				$(this).addClass("error_red");
			}
			else{
				$(this).removeClass("error_red");
			}
		})
		var check_dress=0;
		$('.dress_check').each(function () {
			if ($(this).is(':checked')) {
			  check_dress=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		  var check_foi=0;
		 $('.foi_check').each(function () {
			if ($(this).is(':checked')) {
			  check_foi=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		  if(check_dress==0 || check_foi==0){ check=0; }
		if(check==0){
			alert("please fill required fields");
			return false;
			
		}
	}
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
<?php
require_once(MN_url.'classes/recaptchalib.php');
$publickey = "6LfQjysUAAAAAKaZjpZiL0AmNTGX1ZdNw9pwnepl"; // you got this from the signup page
$privatekey = "6LfQjysUAAAAAH7Rby-OwqWOmtG-Ok86w1xxisLt";

    // Your code here to handle a successful verification
  
	if(isset($_POST['fname'])){
		 if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            //get verified response data
            $param = "https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response'];
            $verifyResponse = file_get_contents($param);
            $responseData = json_decode($verifyResponse);
		//$responseData=true;
            if($responseData->success){
			   //if($responseData){
                // success
                
            
		$error="";
		if($_POST['fname']!="" || $_POST['lname']!="" || $_POST['email']!="" || $_POST['phone']!="" || $_POST['dob']!="" || $_POST['gender']!="" || $_POST['country']!="" || $_POST['mlang']!=""  || $_POST['height']!=""  || $_POST['weight']!=""  ){
			
			
			function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){
			
				$from = $senderName." <".$senderMail.">"; 
				$headers = "From: $from";
			
				// boundary 
				$semi_rand = md5(time()); 
				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
			
				// headers for attachment 
				$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
			
				// multipart boundary 
				$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
				"Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
			
				// preparing attachments
				if(count($files) > 0){
					for($i=0;$i<count($files);$i++){
						if(is_file($files[$i])){
							$message .= "--{$mime_boundary}\n";
							$fp =    @fopen($files[$i],"rb");
							$data =  @fread($fp,filesize($files[$i]));
			
							@fclose($fp);
							$data = chunk_split(base64_encode($data));
							$message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
							"Content-Description: ".basename($files[$i])."\n" .
							"Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
							"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
						}
					}
				}
			
				$message .= "--{$mime_boundary}--";
				$returnpath = "-f" . $senderMail;
			
				//send email
				$mail = @mail($to, $subject, $message, $headers, $returnpath); 
			
				//function return true, if email sent, otherwise return fasle
				if($mail){ return TRUE; } else { return FALSE; }
			
			}
			
			//email variables
			$to = 'register@flcmodels.com';
			$from = $_POST['email'];
			$from_name = 'flcmodels.com register request';
			
			
			//////
			//
			$un_files = glob(MN_url."photo_gallery/*");
			$now   = time();
			//var_dump($un_files);
			foreach ($un_files as $un_file) {
			  if (is_file($un_file)) {
				if ($now - filemtime($un_file) >= 60 * 60 * 24 * 60) { // 2 days
				  unlink($un_file);
				  //echo $un_file.",,, ";
				}
			  }
			}
			//
			/////
			
			$files=array();
			
			$extension=array("jpeg","jpg","png","gif");
			$cnt=1;
    		$i=1;
			$gallery=array();
			foreach($_SESSION['img_files'] as $file_val)
            {
                if($i > 20 ) exit;
				//$img_src=image_upload($_FILES['file_src-'.$i],$_POST['fname']."img".time()."_".$i);
				$img_src=$file_val;
				$files[]=MN_url."photo_gallery/".$img_src;
				$gallery[]=$img_src;
				$i++;
			}
			
			$mail=0;
			//attachment files path array
			//$files = array('images/green/flc-logo_green.png');
			$subject = 'flcmodels.com Registration';
			$html_content = '<h1>Registration Request</h1>
						<p>
						<table>
							<tr><td> &nbsp;</td></tr>
							<tr><td>Contact information</td></tr>
							<tr>
								 <td >Full Name: </td><td>'.$_POST["fname"].' '.$_POST["lname"].'</td>
							</tr>
							<tr>
                                <td>Email: </td><td>'.$_POST["email"].'</td>
							</tr>
							<tr>
								 <td >Contact Number: </td><td>'.$_POST['phone'].'</td>
							</tr>
							<tr>
                                <td>Address: </td><td>'.$_POST["address"].'</td>
							</tr>
							<tr><td> &nbsp;</td></tr>
							<tr><td>Personel information</td></tr>
							<tr>
								 <td> Date of Birth: </td><td>'.$_POST['dob'].'</td>
							</tr>
							<tr>
								 <td >Sex: </td><td>'.$_POST['gender'].'</td>
							</tr>
							<tr>
								 <td >Nationality: </td><td>'.$_POST['country'].'</td>
							</tr>
							<tr>
                                <td>Mother language: </td><td>'.$_POST["mlang"].'</td>
							</tr>
							<tr>
                                <td>Other languages spoken: </td><td>'.$_POST["olang"].'</td>
							</tr>
							<tr><td> &nbsp;</td></tr>
							<tr><td>Measurement information</td></tr>
							<tr>
                                <td>Height: </td><td>'.$_POST["height"].'</td>
							</tr>
							
							<tr>
								 <td>Weight: </td><td>'.$_POST['weight'].'</td>
							</tr>
							<tr>
                                <td>Bust: </td><td>'.$_POST["bust"].'</td>
							</tr>
							<tr>
								 <td>Waist: </td><td>'.$_POST['waist'].'</td>
							</tr>
							<tr>
                                <td>Hips: </td><td>'.$_POST["hips"].'</td>
							</tr>
							<tr>
								 <td>Eyes: </td><td>'.$_POST['eyes'].'</td>
							</tr>
							<tr>
                                <td>Skin: </td><td>'.$_POST["skin"].'</td>
							</tr>
							<tr>
								 <td>Hair: </td><td>'.$_POST['hair'].'</td>
							</tr>
							<tr>
                                <td>Shoe: </td><td>'.$_POST["shoe"].'</td>
							</tr>
							<tr>
								 <td>Dress: </td><td>'.implode(", ",$_POST['dress']).'</td>
							</tr>
							<tr><td> &nbsp;</td></tr>
							<tr><td>General information</td></tr>
							<tr>
                                <td>Fields of interest: </td><td>'.implode(", ",$_POST['foi']).'</td>
							</tr>
							
							<tr>
                                <td>Publish photos on website? : </td><td>'.$_POST["publish_photo"].'</td>
							</tr>
						</table>
						</p>';
			
			//call multi_attach_mail() function and pass the required arguments
			$send_email = multi_attach_mail($to,$subject,$html_content,$from,$from_name,$files);
			multi_attach_mail("iconceptfze@gmail.com",$subject,$html_content,$from,$from_name,$files);
			multi_attach_mail("flcmregister@gmail.com",$subject,$html_content,$from,$from_name,$files);
			
			//print message after email sent
					if($send_email){
						
						$mail=1;
						
						/////
						//
						include_once(MN_url."control_panel/includes/conn.php");
						$cur_date=date("Y-m-d H:i:s");
						
						$query = "INSERT INTO `Smart_FLC_mail_Details` (`First_Name`, `Gender`, `Height`, `Bust`, `Waist`, `Hips`, `HairColor`, `SkinColor`, `ShoesSize`, `EyesColor`, `Native_Language`, `Languages_Spoken`, `Date_Created`, `Last_Name`, `Cell_phone`, `Email1`, `Address`, `Nationality`, `DOB`, `DressSize`, `Weight`, images, `publish_photo`) VALUES('".$_POST["fname"]."', '".$_POST['gender']."', '".$_POST["height"]."', '".$_POST["bust"]."', '".$_POST['waist']."', '".$_POST["hips"]."', '".$_POST['hair']."', '".$_POST["skin"]."', '".$_POST["shoe"]."', '".$_POST['eyes']."', '".$_POST["mlang"]."', '".$_POST["olang"]."', '".$cur_date."', '".$_POST["lname"]."', '".$_POST['phone']."', '".$_POST["email"]."', '".$_POST["address"]."', '".$_POST['country']."', '".date('Y-m-d', strtotime($_POST['dob']))."', '".implode(",",$_POST['dress'])."', '".$_POST['weight']."', '".implode(",",$files)."', '".$_POST['publish_photo']."' )";
						
						$r = mysqli_query($url, $query) or die(mysqli_error($url));
						if($r){
							$sucess=1;
						}
						//echo $query; exit;
						//
						/////
						/*foreach($files as $file){
							//unlink("./".$file);
						}*/
					}
			
						
					}
					else{
						$error="Error: Please fill all required fields to submit the form";
					}
				}
				else{
                $error="Error: Failed to check captcha";
            }
		 }

  }
?>
  <body>
    
    <?php include_once('md_includes/header.php'); ?>
        <section class="model-submission">
    
    	<div class="container">
        	<h2>Model Submission - Registration Form</h2>
            <div class="left-brdr"></div>
                        <p class="lead">Register with us</p>
<?php
		$mail_check=0;
			if(isset($error)){
				if($error!=0 || $error!=""){
					echo '<div class="mail_error">'.$error.'</div>';
				}
				if($mail==1){
					$mail_check=1;
					echo '<div class="mail_green">Thank you for registering with us. <br/> You will be contacted soon. <p><a href="register.php" target="_blank">Register again</a></p></div>
					<p>For inquiries email us : <a href="mailto:register@flcmodels.com" >register@flcmodels.com</a></p>';
				}
			}
		?>
	<form class="modelreg" action="" enctype="multipart/form-data" onSubmit="return validate_form();" <?php if($mail_check==1) { echo 'style="display:none"';} ?>>
    	<div class="row">
            <div class="col-4" ><input type="text" class="required" id="inputFname" placeholder="First Name" name="fname" required /></div>
            <div class="col-4" ><input type="text" class="required" id="inputLname" placeholder="Last Name" name="lname" required /></div>
           <div class="col-4" ><input type="email" class="required" id="inputEmail3" placeholder="Email Address" name="email" required /></div>
           <div class="col-4" ><input type="text" class="required" id="inputPhone" placeholder="Contact Number" name="phone" required /></div>
          <div class="col-4" ><input type="text" class="required" id="inputAddress"  placeholder="Address" name="address" required />
          </div>
              <div class="col-4" >
                  <Select class="required" id="inputCountry" name="country" required placeholder="Nationality" >
                    	 <option value="">Select Nationality</option>  <option value="Afghanistan">Afghanistan</option>  <option value="Albania">Albania</option>  <option value="Algeria">Algeria</option>  <option value="Argentina">Argentina</option>  <option value="Armenia">Armenia</option>  <option value="Australia">Australia</option>  <option value="Austria">Austria</option>  <option value="Azerbaijan">Azerbaijan</option>  <option value="Bahrain">Bahrain</option>  <option value="Bangladesh">Bangladesh</option>  <option value="Belarus">Belarus</option>  <option value="Belgium">Belgium</option>  <option value="Bolivia">Bolivia</option>  <option value="Brazil">Brazil</option>  <option value="Brunei">Brunei</option>  <option value="Bulgaria">Bulgaria</option>  <option value="Canada">Canada</option>  <option value="Chile">Chile</option>  <option value="China">China</option>  <option value="Colombia">Colombia</option>  <option value="Costa Rica">Costa Rica</option>  <option value="Croatia">Croatia</option>  <option value="Cuba">Cuba</option>  <option value="Cyprus">Cyprus</option>  <option value="Czech Rep">Czech Rep</option>  <option value="Denmark">Denmark</option>  <option value="Ecuador">Ecuador</option>  <option value="Egypt">Egypt</option>  <option value="Eritrea">Eritrea</option>  <option value="Estonia">Estonia</option>  <option value="Ethiopia">Ethiopia</option>  <option value="Finland">Finland</option>  <option value="France">France</option>  <option value="Gabon">Gabon</option>  <option value="Georgia">Georgia</option>  <option value="Germany">Germany</option>  <option value="Ghana">Ghana</option>  <option value="Greece">Greece</option>  <option value="Hong Kong">Hong Kong</option>  <option value="Hungary">Hungary</option>  <option value="Iceland">Iceland</option>  <option value="India">India</option>  <option value="Indonesia">Indonesia</option>  <option value="Iran">Iran</option>  <option value="Iraq">Iraq</option>  <option value="Ireland">Ireland</option>  <option value="Italy">Italy</option>  <option value="Jamaica">Jamaica</option>  <option value="Japan">Japan</option>  <option value="Jordan">Jordan</option>  <option value="Kazakhstan">Kazakhstan</option>  <option value="Kenya">Kenya</option>  <option value="Korea">Korea</option>  <option value="Kuwait">Kuwait]</option>  <option value="Kyrgyzstan">Kyrgyzstan</option>  <option value="Latvia">Latvia</option>  <option value="Lebanon">Lebanon</option>  <option value="Liberia">Liberia</option>  <option value="Libya">Libya</option>  <option value="Lithuania">Lithuania</option>  <option value="Luxembourg">Luxembourg</option>  <option value="Macedonia">Macedonia</option>  <option value="Madagascar">Madagascar</option>  <option value="Malaysia">Malaysia</option>  <option value="Mali">Mali</option>  <option value="Malta">Malta</option>  <option value="Mauritania">Mauritania</option>  <option value="Mauritius">Mauritius</option>  <option value="Mexico">Mexico</option>  <option value="Moldova">Moldova</option>  <option value="Mongolia">Mongolia</option>  <option value="Montenegro">Montenegro</option>  <option value="Morocco">Morocco</option>  <option value="Mozambique">Mozambique</option>  <option value="Namibia">Namibia</option>  <option value="Nepal">Nepal</option>  <option value="Netherlands">Netherlands</option>  <option value="New Zealand">New Zealand</option>  <option value="Niger">Niger</option>  <option value="Nigeria">Nigeria</option>  <option value="Norway">Norway</option>  <option value="Oman">Oman</option>  <option value="Others">Others</option>  <option value="Pakistan">Pakistan</option>  <option value="Palestine">Palestine</option>  <option value="Paraguay">Paraguay</option>  <option value="Peru">Peru</option>  <option value="Philippines">Philippines</option>  <option value="Poland">Poland</option>  <option value="Portugal">Portugal</option>  <option value="Puerto Rico">Puerto Rico</option>  <option value="Qatar">Qatar</option>  <option value="Romania">Romania</option>  <option value="Russia">Russia</option>  <option value="Saudi Arabia">Saudi Arabia</option>  <option value="Senegal">Senegal</option>  <option value="Serbia">Serbia</option>  <option value="Sierra Leone">Sierra Leone</option>  <option value="Singapore">Singapore</option>  <option value="Slovakia">Slovakia</option>  <option value="Slovenia">Slovenia</option>  <option value="South Africa">South Africa</option>  <option value="Spain">Spain</option>  <option value="Sri Lanka">Sri Lanka</option>  <option value="Sudan">Sudan</option>  <option value="Sweden">Sweden</option>  <option value="Switzerland">Switzerland</option>  <option value="Syria">Syria</option>  <option value="Taiwan">Taiwan</option>  <option value="Tajikistan">Tajikistan</option>  <option value="Tanzania">Tanzania</option>  <option value="Thailand">Thailand</option>  <option value="Togo">Togo</option>  <option value="Tonga">Tonga</option>  <option value="Tunisia">Tunisia</option>  <option value="Turkey">Turkey</option>  <option value="Turkmenistan">Turkmenistan</option>  <option value="Ukraine">Ukraine</option>  <option value="United Arab Emirates">United Arab Emirates</option>  <option value="United Kingdom">United Kingdom</option>  <option value="United States">United States</option>  <option value="Uruguay">Uruguay</option>  <option value="Uzbekistan">Uzbekistan</option>  <option value="Venezuela">Venezuela</option>  <option value="Vietnam">Vietnam</option>  <option value="Yemen">Yemen</option>  <option value="Zambia">Zambia</option>  <option value="Zimbabwe">Zimbabwe</option>  
                  </select>
             </div>
            <div class="col-6">
                <input type="text" placeholder="Date of Birth" class="required" id="inputDob" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="dob" required />
            </div>
            <div class="col-6">
                <Select class="required" id="inputGender" name="gender" required placeholder="Gender">
                    	<option value="">Select Gender</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </Select>
            </div>
            <div class="col-6">
            	<input type="text" class="required" id="inputMlang" placeholder="Mother language" name="mlang" required />
            </div>
            <div class="col-6">
            	<input type="text" class="required" id="inputOlang" placeholder="Other languages spoken" name="olang" required />
            </div>
            <div class="col-4">
                <select class="required" id="inputHeight" name="height" required placeholder="Height">  
                  	<option value="">-None-</option>  
                    <option value="Less than 152 cm">Less than 152 cm</option>  
                    <option value="153 cm / 5">153 cm / 5</option>  
                    <option value="155 cm / 5-1">155 cm / 5-1</option>  
                    <option value="158 cm / 5-2">158 cm / 5-2</option>  
                    <option value="160 cm / 5-3">160 cm / 5-3</option>  
                    <option value="163 cm / 5-4">163 cm / 5-4</option>  
                    <option value="165 cm / 5-5">165 cm / 5-5</option>  
                    <option value="168 cm / 5-6">168 cm / 5-6</option>  
                    <option value="170 cm / 5-7">170 cm / 5-7</option>  
                    <option value="171 cm / 5-7">171 cm / 5-7</option>  
                    <option value="172 cm / 5-7">172 cm / 5-7</option>  
                    <option value="173 cm / 5-8">173 cm / 5-8</option>  
                    <option value="174 cm / 5-8">174 cm / 5-8</option>  
                    <option value="175 cm / 5-9">175 cm / 5-9</option>  
                    <option value="176 cm / 5-9">176 cm / 5-9</option>  
                    <option value="177 cm / 5-9">177 cm / 5-9</option>  
                    <option value="178 cm / 5-10">178 cm / 5-10</option>  
                    <option value="179 cm / 5-10">179 cm / 5-10</option>  
                    <option value="180 cm / 5-11">180 cm / 5-11</option>  
                    <option value="181 cm / 5-11">181 cm / 5-11</option>  
                    <option value="183 cm / 6">183 cm / 6</option>  
                    <option value="184 cm / 6">184 cm / 6</option>  
                    <option value="185 cm / 6-1">185 cm / 6-1</option>  
                    <option value="186 cm / 6-1">186 cm / 6-1</option>  
                    <option value="187 cm / 6-1">187 cm / 6-1</option>  
                    <option value="188 cm / 6-2">188 cm / 6-2</option>  
                    <option value="189 cm / 6-2">189 cm / 6-2</option>  
                    <option value="190 cm / 6-3">190 cm / 6-3</option>
                    <option value="191 cm / 6-3">191 cm / 6-3</option>
                    <option value="192 cm / 6-3">192 cm / 6-3</option>
                    <option value="193 cm / 6-4">193 cm / 6-4</option> 
                    <option value="194 cm / 6-4">194 cm / 6-4</option>
                    <option value="195 cm / 6-4">195 cm / 6-4</option> 
                    <option value="More than 195 cm">More than 195 cm</option>  
                  </select>
            </div>
             <div class="col-4">
                <input type="text" class="required" id="inputWeight" placeholder="Weight" name="weight" required/>
            </div>
             <div class="col-4">
                 <input type="text" class=" required" id="inputBust" placeholder="Bust" name="bust" required />
            </div>
            <div class="col-4">
                 <input type="text" class="required" id="inputWaist" placeholder="Waist" name="waist" required />
            </div>
            <div class="col-4">
                <input type="text" class="required" id="inputHips" placeholder="Hips" name="hips" required />
            </div>
            <div class="col-4">
                <input type="text" class="required" id="inputEye" placeholder="Eyes Colour" name="eyes" required />
            </div>
            <div class="col-4">
                <input type="text" class="required" id="inputSkin" placeholder="Skin Colour" name="skin" required />
            </div>
            <div class="col-4">
                <input type="text" class="required" id="inputHair" placeholder="Hair Colour" name="hair" required />
            </div>
             <div class="col-4">
                <select class="required" id="inputShoe" placeholder="Shoe size in cm" name="shoe" required>  
                  	<option value="">-None-</option>
                  <option value="2 UK / 34.5 EU">2 UK / 34.5 EU</option>  <option value="2.5 UK / 35 EU">2.5 UK / 35 EU</option>  <option value="3 UK / 35.5 EU">3 UK / 35.5 EU</option>  <option value="3.5 UK / 36 EU">3.5 UK / 36 EU</option>  <option value="4 UK / 37 EU">4 UK / 37 EU</option>  <option value="4.5 UK / 37.5 EU">4.5 UK / 37.5 EU</option>  <option value="5 UK / 37.5 EU">5 UK / 37.5 EU</option>  <option value="5.5 UK / 38 EU">5.5 UK / 38 EU</option>  <option value="6 UK / 38.5 EU">6 UK / 38.5 EU</option>  <option value="6.5 UK / 39 EU">6.5 UK / 39 EU</option>  <option value="7 UK / 40 EU">7 UK / 40 EU</option>  <option value="7.5 UK / 41 EU">7.5 UK / 41 EU</option>  <option value="8 UK / 42 EU">8 UK / 42 EU</option>  <option value="8.5 UK / 43 EU">8.5 UK / 43 EU</option>  <option value="10 UK / 44 EU">10 UK / 44 EU</option>  <option value="11 UK / 45 EU">11 UK / 45 EU</option>
                  </select>
            </div>
            <div class="col-6">
            	<select class="select2" multiple placeholder="Dress Size" name="dress[]" class="dress_check">
                	<option>Extra Small</option>
                    <option>Small</option>
                    <option>Medium</option>
                    <option>Large</option>
                    <option>Extra Large</option>
                </select>
            </div>
            <div class="col-6">
            	<select class="select2" multiple placeholder="Fields of interest" name="foi[]" class="foi_check">
                	<option>Fashion shows</option>
                    <option>Movie/Theater acting</option>
                    <option>TV commercials</option>
                    <option>Corporate videos </option>
                    <option>Photography shoots for commercial, print, catalogs</option>
                    <option>Music video clips</option>
                    <option>Host/Hostess</option>
                    <option>Promotions</option>
                    <option>Extra</option>
                    <option>Hand modeling</option>
                    <option>Feet modeling</option>
                    <option>Teeth modeling</option>
                </select>
            </div>
             <div class="col-4">
                <input type="file" name="file_src-1" id="file" class="inputfile" onchange="ajax_upload(this)" class="required" required />
                <div class="progress">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
                        <div class="msg"></div>
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            <div class="col-4">
                 <button type="button" onClick="add_img(this);" class="btn btn-default" style="margin-top:10px;">+ Add Image</button>
            </div>
           <?php /*?> <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div>
            <div class="col-4">
                <input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><span class="fileupload">+</span> Upload 01</label>
            </div><?php */?>
            <div style="clear:both; width:100%;">
                <label for="inputPphoto" class="col-4 control-label">Publish photos on website? </label>
                <div class="col-8">
                  <label class="">
                      <input value="Yes"  name="publish_photo"  type="radio" checked />Yes
                  </label>
                  <label class="" style="margin-left:15px; display:inline-block">
                      <input value="No"  name="publish_photo"  type="radio" />No
                  </label>
                </div>
              </div>
            <div style="clear:both">
            	 <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
            </div>
             <p class="text-justify" >
              I hereby appoint FLC Production & Model Management to act as my personal manager in the fields of modeling, advertising and entertainment. FLC Production & Model Management is hereby granted the right to use and distribute and allow or license others to make use of and distribute Model's name, portrait and pictures in connection with the advertising and/or publicity and/or website of the model in the fields.  Talent agrees to provide FLC Production & Model Management  with current information, photographs, comp cards, and tear sheets/advertising, written or other related material for promotional use of FLC Production & Model Management
              </p>
              <p class="text-justify" style=" font-style:italic" >
              I have read, understood and agreed, with the terms and conditions stated above. I hereby indemnify FLC Production & Model Management against all information provided by me. I give consent to the discretionary use of my contact information by FLC Production & Model Management
              
              </p>
              <p>For inquiries email us : <a href="mailto:register@flcmodels.com" >register@flcmodels.com</a></p>
            <input type="submit" value="SUBMIT APPLICATION" id="submit_button" />
           
         </div>
    </form>

        </div>
  	
  
  </section>

  
  <?php include_once('md_includes/footer.php'); ?>
 <link type="text/css" href="<?php echo MN_url; ?>control_panel/plugins/datepicker/datepicker3.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo MN_url; ?>control_panel/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
//

	function add_img(val){
	  var img_name=$(val).parent().prev().children().attr("name");
	  var new_val=parseInt(img_name.substr(img_name.indexOf("-") + 1))+1;
	  if(new_val<=20){
	  $("#img_count").val(new_val);
	  //alert(new_val);
	  $('<div class="col-4"><input type="file" placeholder="Image" name="file_src-'+new_val+'" onchange="ajax_upload(this)" class="inputfile" id="file-'+new_val+'" /><div class="progress"><div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div></div><div class="msg"></div><label for="file-'+new_val+'"><span class="fileupload">+</span> Upload '+new_val+'</label><button type="button" onclick="del_img('+new_val+',this)" class="del_img">X Delete</button></div>').insertBefore($(val).parent());
	  }
	}
	function ajax_upload(obj){                    
                    var filename = $('#inputFname').val();
                    var myfile = $(obj).val();
                    if ( myfile == '' || filename=='') {
                        alert('Please enter name and add image');
						$(obj).val("");
                        return false;
                    }
					$(obj).next('.progress').show();
					$(obj).next().find('.myprogress').css('width', '0');
                   $(obj).next().next('.msg').text('');
                    var formData = new FormData();
                    formData.append('myfile', $(obj)[0].files[0]);
					formData.append('filename', filename);
                    $('#submit_button').attr('disabled', 'disabled');
                    $(obj).next().next('.msg').text('Uploading in progress...');
					
					//alert(filename)
                    $.ajax({
                        url: '<?php echo MN_url; ?>ajax_upload.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        // this part is progress bar
                        xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $(obj).next().find('.myprogress').text(percentComplete + '%');
                                    $(obj).next().find('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (data) {
                            $(obj).next().next('.msg').text(data);
                            $('#submit_button').removeAttr('disabled');
							if(data=="Image uploaded successfully!"){
								/*setTimeout(function () {
									$(obj).next().next().next().html('');
									$(obj).next().next().fadeOut('slow');
								}, 1000);*/
							}
							else{
                                    var percentComplete =60;
                                    $(obj).next().find('.myprogress').text(percentComplete + '%');
                                    $(obj).next().find('.myprogress').css('width', percentComplete + '%');
									$(obj).next().find('.myprogress').css('background', 'red');
								$(obj).val("");
							}
                        }
                    });
                
		}
		
	 function del_img(val,obj){
		//alert(val);
		var formData = new FormData();
                    formData.append('index', val);
                    $('#submit_button').attr('disabled', 'disabled');
                    $(obj).prev().prev('.msg').text('Deleting...');
					
					//alert(filename)
                    $.ajax({
                        url: '<?php echo MN_url; ?>ajax_upload.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        // this part is progress bar
                        xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $(obj).next().next().find('.myprogress').text(percentComplete + '%');
                                    $(obj).next().next().find('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (data) {
                            $(obj).prev().prev('.msg').text(data);
							 $(obj).parent().remove();
							 /*$(obj).next().remove();
							 $(obj).prev().remove();
							 $(obj).remove();*/
                            $('#submit_button').removeAttr('disabled');
                        }
                    });
                
		}
</script>
<script type="text/javascript" src="assets/js/select2.min.js"></script>
<script type="text/javascript">
$(function(){
$(".select2").select2();
})
</script>
<style type="text/css">
.progress{ display:none}
input[type=file]{ display:inline-block;}
.progress{ margin-bottom:0;}
.msg{ margin-bottom:10px;}
.del_img{ background:red; border:0; border-radius:3px; float:right; margin-right:150px;}
</style>
 
  </body>
</html>