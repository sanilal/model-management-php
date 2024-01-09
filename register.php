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
.tab_title{ font-size: 16px; margin:10px 15px;  font-weght:bold; line-height:25px; padding:5px; background:#009944; border-radius:4px; width:100%; color:#fff; font-weight:bold; }
div.form-group{ width:100%; }
.col-2,.col-4,.col-8,.col-10, .col-6{ float:left;}
label.col-4 input, label.col-6 input, label.col-10 input{ width:auto; height:auto; margin-right:4px;}
</style>

<script type="text/javascript">
var captcha_check=0;
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
		  //
		  var check_cat=0;
		 $('.cat_check').each(function () {
			if ($(this).is(':checked')) {
			  check_cat=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		  //
		  var check_eth=0;
		 $('.eth_check').each(function () {
			if ($(this).is(':checked')) {
			  check_eth=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		  if(check_dress==0 || check_foi==0 || check_cat==0 || check_eth==0){ check=0; }
		if(check==0){
			alert("please fill required fields");
			return false;
			
		}
		else if(captcha_check==0){ 
			alert("please check 'you are not robot' captcha");
			return false;
		}
	}
	function recaptchaCallback() {
    	captcha_check=1;
	};
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
				if ($now - filemtime($un_file) >= 60 * 60 * 24 * 600) { // 2 days
				  //unlink($un_file);
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
				$gallery[]="photo_gallery/".$img_src;
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
			//multi_attach_mail("iconceptfze@gmail.com",$subject,$html_content,$from,$from_name,$files);
			//multi_attach_mail("flcmregister@gmail.com",$subject,$html_content,$from,$from_name,$files);
			
			//print message after email sent
					if($send_email){
						
						
						
						
						$mail=1;
						
						/////
						
	require("control_panel/class.phpmailer.php");
	  $mail = new PHPMailer();
	  $mail->IsSMTP();                                      // set mailer to use SMTP
	  $mail->Host = "mailout.one.com";  // specify main and backup server
	  $mail->Port = 25; 
	  $mail->SMTPAuth = true;     // turn on SMTP authentication
	  $mail->Username = "smtp@flcmodels.com";  // SMTP username
	  $mail->Password = "NLQ-QV2-ZpY-zVK"; // SMTP password
	  
	  $mail->From = "smtp@flcmodels.com";
	  $mail->FromName = "Flcmodels";
	  $mail->AddReplyTo("no-reply@flcmodels.com", "Flcmodels");
	  //
	  if(count($files) > 0){
			for($i=0;$i<count($files);$i++){
				if(is_file($files[$i])){
				$mail->AddAttachment($files[$i]);    	
				}
			}
		}
	////
	  $mail->IsHTML(true);  
	  $mail->AddAddress('iconceptfze@gmail.com', "");
	
	  
	  $mail->Subject = $subject;
	  $mail->Body    = $html_content;
	 $mail->Send();   
						
						//
						include_once(MN_url."control_panel/includes/conn.php");
						$cur_date=date("Y-m-d H:i:s");
						
						$query = "INSERT INTO `Smart_FLC_mail_Details` (`First_Name`, `Gender`, `Height`, `Bust`, `Waist`, `Hips`, `HairColor`, `SkinColor`, `ShoesSize`, `EyesColor`, `Native_Language`, `Languages_Spoken`, `Date_Created`, `Last_Name`, `Cell_phone`, `Email1`, `Address`, `Nationality`, `DOB`, `DressSize`, `Weight`, images, `publish_photo`,`Resource_Type`, `Ethnicity`,`whatsapp`) VALUES('".$_POST["fname"]."', '".$_POST['gender']."', '".$_POST["height"]."', '".$_POST["bust"]."', '".$_POST['waist']."', '".$_POST["hips"]."', '".$_POST['hair']."', '".$_POST["skin"]."', '".$_POST["shoe"]."', '".$_POST['eyes']."', '".$_POST["mlang"]."', '".implode(",",$_POST["olang"])."', '".$cur_date."', '".$_POST["lname"]."', '".$_POST['cont_code'].$_POST['phone']."', '".$_POST["email"]."', '".$_POST["address"]."', '".$_POST['country']."', '".date('Y-m-d', strtotime($_POST['dob']))."', '".implode(",",$_POST['dress'])."', '".$_POST['weight']."', '".implode(",",$gallery)."', '".$_POST['publish_photo']."', '".implode(",",$_POST['category'])."', '".implode(",",$_POST['ethnicity'])."', '".$_POST['what_code'].$_POST['whatsapp']."'  )";
						
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
	<form class="modelreg" method="post" enctype="multipart/form-data" onSubmit="return validate_form();" <?php if($mail_check==1) { echo 'style="display:none"';} ?>>
    	<div class="row">
            <div class="tab_title">Contact information</div>
             
<div class="form-group">
                <label for="inputFname" class="col-4 control-label">First Name</label>
                <div class="col-8">
                  <input type="text" class="form-control required" id="inputFname" placeholder="First Name" name="fname" required />
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputLname" class="col-4 control-label">Last Name</label>
                <div class="col-8">
                  <input type="text" class="form-control required" id="inputLname" placeholder="Last Name" name="lname" required />
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputEmail3" class="col-4 control-label">Email Address</label>
                <div class="col-8">
                  <input type="email" class="form-control required" id="inputEmail3" placeholder="Email Address" name="email" required />
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputPhone" class="col-4 control-label">Contact Number</label>
                <div class="col-8">
                 <div class="input-group">
                 <span class="input-group-addon">
 <select style="background: none;border: none; height:25px; margin:0" name="cont_code">
<option data-countrycode="AE" value="+971">+971</option>
<option data-countrycode="US" value="+1">+1</option>
<option data-countrycode="UZ" value="+7">+7</option>
<option data-countrycode="EG" value="+20">+20</option>
<option data-countrycode="ZA" value="+27">+27</option>
<option data-countrycode="GR" value="+30">+30</option>
<option data-countrycode="NL" value="+31">+31</option>
<option data-countrycode="BE" value="+32">+32</option>
<option data-countrycode="FR" value="+33">+33</option>
<option data-countrycode="ES" value="+34">+34</option>
<option data-countrycode="HU" value="+36">+36</option>
<option data-countrycode="IT" value="+39">+39</option>
<option data-countrycode="RO" value="+40">+40</option>
<option data-countrycode="CH" value="+41">+41</option>
<option data-countrycode="CZ" value="+42">+42</option>
<option data-countrycode="AT" value="+43">+43</option>
<option data-countrycode="GB" value="+44">+44</option>
<option data-countrycode="DK" value="+45">+45</option>
<option data-countrycode="SE" value="+46">+46</option>
<option data-countrycode="NO" value="+47">+47</option>
<option data-countrycode="PL" value="+48">+48</option>
<option data-countrycode="DE" value="+49">+49</option>
<option data-countrycode="PE" value="+51">+51</option>
<option data-countrycode="MX" value="+52">+52</option>
<option data-countrycode="CU" value="+53">+53</option>
<option data-countrycode="AR" value="+54">+54</option>
<option data-countrycode="BR" value="+55">+55</option>
<option data-countrycode="CL" value="+56">+56</option>
<option data-countrycode="CO" value="+57">+57</option>
<option data-countrycode="VE" value="+58">+58</option>
<option data-countrycode="MY" value="+60">+60</option>
<option data-countrycode="AU" value="+61">+61</option>
<option data-countrycode="ID" value="+62">+62</option>
<option data-countrycode="PH" value="+63">+63</option>
<option data-countrycode="NZ" value="+64">+64</option>
<option data-countrycode="SG" value="+65">+65</option>
<option data-countrycode="TH" value="+66">+66</option>
<option data-countrycode="JP" value="+81">+81</option>
<option data-countrycode="KR" value="+82">+82</option>
<option data-countrycode="VN" value="+84">+84</option>
<option data-countrycode="CN" value="+86">+86</option>
<option data-countrycode="TR" value="+90">+90</option>
<option data-countrycode="IN" value="+91">+91</option>
<option data-countrycode="LK" value="+94">+94</option>
<option data-countrycode="MN" value="+95">+95</option>
<option data-countrycode="IR" value="+98">+98</option>
<option data-countrycode="MA" value="+212">+212</option>
<option data-countrycode="DZ" value="+213">+213</option>
<option data-countrycode="TN" value="+216">+216</option>
<option data-countrycode="LY" value="+218">+218</option>
<option data-countrycode="GM" value="+220">+220</option>
<option data-countrycode="SN" value="+221">+221</option>
<option data-countrycode="MR" value="+222">+222</option>
<option data-countrycode="ML" value="+223">+223</option>
<option data-countrycode="GN" value="+224">+224</option>
<option data-countrycode="BF" value="+226">+226</option>
<option data-countrycode="NE" value="+227">+227</option>
<option data-countrycode="TG" value="+228">+228</option>
<option data-countrycode="BJ" value="+229">+229</option>
<option data-countrycode="LR" value="+231">+231</option>
<option data-countrycode="SL" value="+232">+232</option>
<option data-countrycode="GH" value="+233">+233</option>
<option data-countrycode="NG" value="+234">+234</option>
<option data-countrycode="CF" value="+236">+236</option>
<option data-countrycode="CM" value="+237">+237</option>
<option data-countrycode="CV" value="+238">+238</option>
<option data-countrycode="ST" value="+239">+239</option>
<option data-countrycode="GQ" value="+240">+240</option>
<option data-countrycode="GA" value="+241">+241</option>
<option data-countrycode="CG" value="+242">+242</option>
<option data-countrycode="AO" value="+244">+244</option>
<option data-countrycode="GW" value="+245">+245</option>
<option data-countrycode="SC" value="+248">+248</option>
<option data-countrycode="SD" value="+249">+249</option>
<option data-countrycode="RW" value="+250">+250</option>
<option data-countrycode="ET" value="+251">+251</option>
<option data-countrycode="SO" value="+252">+252</option>
<option data-countrycode="DJ" value="+253">+253</option>
<option data-countrycode="KE" value="+254">+254</option>
<option data-countrycode="UG" value="+256">+256</option>
<option data-countrycode="BI" value="+257">+257</option>
<option data-countrycode="MZ" value="+258">+258</option>
<option data-countrycode="MG" value="+261">+261</option>
<option data-countrycode="RE" value="+262">+262</option>
<option data-countrycode="NA" value="+264">+264</option>
<option data-countrycode="MW" value="+265">+265</option>
<option data-countrycode="LS" value="+266">+266</option>
<option data-countrycode="BW" value="+267">+267</option>
<option data-countrycode="SZ" value="+268">+268</option>
<option data-countrycode="KM" value="+269">+269</option>
<option data-countrycode="ZM" value="+260">+260</option>
<option data-countrycode="ZW" value="+263">+263</option>
<option data-countrycode="YT" value="+269">+269</option>
<option data-countrycode="SH" value="+290">+290</option>
<option data-countrycode="ER" value="+291">+291</option>
<option data-countrycode="AW" value="+297">+297</option>
<option data-countrycode="FO" value="+298">+298</option>
<option data-countrycode="GL" value="+299">+299</option>
<option data-countrycode="GI" value="+350">+350</option>
<option data-countrycode="PT" value="+351">+351</option>
<option data-countrycode="LU" value="+352">+352</option>
<option data-countrycode="IE" value="+353">+353</option>
<option data-countrycode="IS" value="+354">+354</option>
<option data-countrycode="MT" value="+356">+356</option>
<option data-countrycode="CY" value="+357">+357</option>
<option data-countrycode="FI" value="+358">+358</option>
<option data-countrycode="BG" value="+359">+359</option>
<option data-countrycode="LT" value="+370">+370</option>
<option data-countrycode="LV" value="+371">+371</option>
<option data-countrycode="EE" value="+372">+372</option>
<option data-countrycode="MD" value="+373">+373</option>
<option data-countrycode="AM" value="+374">+374</option>
<option data-countrycode="BY" value="+375">+375</option>
<option data-countrycode="AD" value="+376">+376</option>
<option data-countrycode="MC" value="+377">+377</option>
<option data-countrycode="SM" value="+378">+378</option>
<option data-countrycode="VA" value="+379">+379</option>
<option data-countrycode="CS" value="+381">+381</option>
<option data-countrycode="UA" value="+380">+380</option>
<option data-countrycode="HR" value="+385">+385</option>
<option data-countrycode="SI" value="+386">+386</option>
<option data-countrycode="BA" value="+387">+387</option>
<option data-countrycode="MK" value="+389">+389</option>
<option data-countrycode="LI" value="+417">+417</option>
<option data-countrycode="SK" value="+421">+421</option>
<option data-countrycode="FK" value="+500">+500</option>
<option data-countrycode="BZ" value="+501">+501</option>
<option data-countrycode="GT" value="+502">+502</option>
<option data-countrycode="SV" value="+503">+503</option>
<option data-countrycode="HN" value="+504">+504</option>
<option data-countrycode="NI" value="+505">+505</option>
<option data-countrycode="CR" value="+506">+506</option>
<option data-countrycode="PA" value="+507">+507</option>
<option data-countrycode="HT" value="+509">+509</option>
<option data-countrycode="GP" value="+590">+590</option>
<option data-countrycode="BO" value="+591">+591</option>
<option data-countrycode="GY" value="+592">+592</option>
<option data-countrycode="EC" value="+593">+593</option>
<option data-countrycode="GF" value="+594">+594</option>
<option data-countrycode="PY" value="+595">+595</option>
<option data-countrycode="MQ" value="+596">+596</option>
<option data-countrycode="SR" value="+597">+597</option>
<option data-countrycode="UY" value="+598">+598</option>
<option data-countrycode="NP" value="+670">+670</option>
<option data-countrycode="GU" value="+671">+671</option>
<option data-countrycode="NF" value="+672">+672</option>
<option data-countrycode="BN" value="+673">+673</option>
<option data-countrycode="NR" value="+674">+674</option>
<option data-countrycode="PG" value="+675">+675</option>
<option data-countrycode="TO" value="+676">+676</option>
<option data-countrycode="SB" value="+677">+677</option>
<option data-countrycode="VU" value="+678">+678</option>
<option data-countrycode="FJ" value="+679">+679</option>
<option data-countrycode="PW" value="+680">+680</option>
<option data-countrycode="WF" value="+681">+681</option>
<option data-countrycode="CK" value="+682">+682</option>
<option data-countrycode="NU" value="+683">+683</option>
<option data-countrycode="KI" value="+686">+686</option>
<option data-countrycode="NC" value="+687">+687</option>
<option data-countrycode="TV" value="+688">+688</option>
<option data-countrycode="PF" value="+689">+689</option>
<option data-countrycode="FM" value="+691">+691</option>
<option data-countrycode="MH" value="+692">+692</option>
<option data-countrycode="KP" value="+850">+850</option>
<option data-countrycode="HK" value="+852">+852</option>
<option data-countrycode="MO" value="+853">+853</option>
<option data-countrycode="KH" value="+855">+855</option>
<option data-countrycode="LA" value="+856">+856</option>
<option data-countrycode="BD" value="+880">+880</option>
<option data-countrycode="TW" value="+886">+886</option>
<option data-countrycode="MV" value="+960">+960</option>
<option data-countrycode="LB" value="+961">+961</option>
<option data-countrycode="JO" value="+962">+962</option>
<option data-countrycode="SI" value="+963">+963</option>
<option data-countrycode="IQ" value="+964">+964</option>
<option data-countrycode="KW" value="+965">+965</option>
<option data-countrycode="SA" value="+966">+966</option>
<option data-countrycode="YE" value="+967">+967</option>
<option data-countrycode="OM" value="+968">+968</option>
<option data-countrycode="YE" value="+969">+969</option>
<option data-countrycode="AE" value="+971">+971</option>
<option data-countrycode="AE" value="+971">+971</option>
<option data-countrycode="IL" value="+972">+972</option>
<option data-countrycode="BH" value="+973">+973</option>
<option data-countrycode="QA" value="+974">+974</option>
<option data-countrycode="BT" value="+975">+975</option>
<option data-countrycode="MN" value="+976">+976</option>
<option data-countrycode="NP" value="+977">+977</option>
<option data-countrycode="TM" value="+993">+993</option>
<option data-countrycode="AZ" value="+994">+994</option>
<option data-countrycode="KG" value="+996">+996</option>
<option data-countrycode="GE" value="+7880">+7880</option>
<option data-countrycode="BS" value="+1242">+1242</option>
<option data-countrycode="BB" value="+1246">+1246</option>
<option data-countrycode="AI" value="+1264">+1264</option>
<option data-countrycode="AG" value="+1268">+1268</option>
<option data-countrycode="VG" value="+1284">+1284</option>
<option data-countrycode="VI" value="+1340">+1340</option>
<option data-countrycode="KY" value="+1345">+1345</option>
<option data-countrycode="BM" value="+1441">+1441</option>
<option data-countrycode="GD" value="+1473">+1473</option>
<option data-countrycode="TC" value="+1649">+1649</option>
<option data-countrycode="MS" value="+1664">+1664</option>
<option data-countrycode="SC" value="+1758">+1758</option>
<option data-countrycode="PR" value="+1787">+1787</option>
<option data-countrycode="DM" value="+1809">+1809</option>
<option data-countrycode="DO" value="+1809">+1809</option>
<option data-countrycode="TT" value="+1868">+1868</option>
<option data-countrycode="KN" value="+1869">+1869</option>
<option data-countrycode="JM" value="+1876">+1876</option>
<option data-countrycode="CY" value="+90392">+90392</option>
 </select>
</span>
                  <input type="text" class="form-control required" id="inputPhone" placeholder="Contact Number" name="phone" required />
                  </div>
                </div>
              </div>
               <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="whatsapp" class="col-4 control-label">Whatsapp Number</label>
                <div class="col-8">
                 <div class="input-group">
                 <span class="input-group-addon">
 <select style="background: none;border: none; height:25px; margin:0" name="what_code">
<option data-countrycode="AE" value="+971">+971</option>
<option data-countrycode="US" value="+1">+1</option>
<option data-countrycode="UZ" value="+7">+7</option>
<option data-countrycode="EG" value="+20">+20</option>
<option data-countrycode="ZA" value="+27">+27</option>
<option data-countrycode="GR" value="+30">+30</option>
<option data-countrycode="NL" value="+31">+31</option>
<option data-countrycode="BE" value="+32">+32</option>
<option data-countrycode="FR" value="+33">+33</option>
<option data-countrycode="ES" value="+34">+34</option>
<option data-countrycode="HU" value="+36">+36</option>
<option data-countrycode="IT" value="+39">+39</option>
<option data-countrycode="RO" value="+40">+40</option>
<option data-countrycode="CH" value="+41">+41</option>
<option data-countrycode="CZ" value="+42">+42</option>
<option data-countrycode="AT" value="+43">+43</option>
<option data-countrycode="GB" value="+44">+44</option>
<option data-countrycode="DK" value="+45">+45</option>
<option data-countrycode="SE" value="+46">+46</option>
<option data-countrycode="NO" value="+47">+47</option>
<option data-countrycode="PL" value="+48">+48</option>
<option data-countrycode="DE" value="+49">+49</option>
<option data-countrycode="PE" value="+51">+51</option>
<option data-countrycode="MX" value="+52">+52</option>
<option data-countrycode="CU" value="+53">+53</option>
<option data-countrycode="AR" value="+54">+54</option>
<option data-countrycode="BR" value="+55">+55</option>
<option data-countrycode="CL" value="+56">+56</option>
<option data-countrycode="CO" value="+57">+57</option>
<option data-countrycode="VE" value="+58">+58</option>
<option data-countrycode="MY" value="+60">+60</option>
<option data-countrycode="AU" value="+61">+61</option>
<option data-countrycode="ID" value="+62">+62</option>
<option data-countrycode="PH" value="+63">+63</option>
<option data-countrycode="NZ" value="+64">+64</option>
<option data-countrycode="SG" value="+65">+65</option>
<option data-countrycode="TH" value="+66">+66</option>
<option data-countrycode="JP" value="+81">+81</option>
<option data-countrycode="KR" value="+82">+82</option>
<option data-countrycode="VN" value="+84">+84</option>
<option data-countrycode="CN" value="+86">+86</option>
<option data-countrycode="TR" value="+90">+90</option>
<option data-countrycode="IN" value="+91">+91</option>
<option data-countrycode="LK" value="+94">+94</option>
<option data-countrycode="MN" value="+95">+95</option>
<option data-countrycode="IR" value="+98">+98</option>
<option data-countrycode="MA" value="+212">+212</option>
<option data-countrycode="DZ" value="+213">+213</option>
<option data-countrycode="TN" value="+216">+216</option>
<option data-countrycode="LY" value="+218">+218</option>
<option data-countrycode="GM" value="+220">+220</option>
<option data-countrycode="SN" value="+221">+221</option>
<option data-countrycode="MR" value="+222">+222</option>
<option data-countrycode="ML" value="+223">+223</option>
<option data-countrycode="GN" value="+224">+224</option>
<option data-countrycode="BF" value="+226">+226</option>
<option data-countrycode="NE" value="+227">+227</option>
<option data-countrycode="TG" value="+228">+228</option>
<option data-countrycode="BJ" value="+229">+229</option>
<option data-countrycode="LR" value="+231">+231</option>
<option data-countrycode="SL" value="+232">+232</option>
<option data-countrycode="GH" value="+233">+233</option>
<option data-countrycode="NG" value="+234">+234</option>
<option data-countrycode="CF" value="+236">+236</option>
<option data-countrycode="CM" value="+237">+237</option>
<option data-countrycode="CV" value="+238">+238</option>
<option data-countrycode="ST" value="+239">+239</option>
<option data-countrycode="GQ" value="+240">+240</option>
<option data-countrycode="GA" value="+241">+241</option>
<option data-countrycode="CG" value="+242">+242</option>
<option data-countrycode="AO" value="+244">+244</option>
<option data-countrycode="GW" value="+245">+245</option>
<option data-countrycode="SC" value="+248">+248</option>
<option data-countrycode="SD" value="+249">+249</option>
<option data-countrycode="RW" value="+250">+250</option>
<option data-countrycode="ET" value="+251">+251</option>
<option data-countrycode="SO" value="+252">+252</option>
<option data-countrycode="DJ" value="+253">+253</option>
<option data-countrycode="KE" value="+254">+254</option>
<option data-countrycode="UG" value="+256">+256</option>
<option data-countrycode="BI" value="+257">+257</option>
<option data-countrycode="MZ" value="+258">+258</option>
<option data-countrycode="MG" value="+261">+261</option>
<option data-countrycode="RE" value="+262">+262</option>
<option data-countrycode="NA" value="+264">+264</option>
<option data-countrycode="MW" value="+265">+265</option>
<option data-countrycode="LS" value="+266">+266</option>
<option data-countrycode="BW" value="+267">+267</option>
<option data-countrycode="SZ" value="+268">+268</option>
<option data-countrycode="KM" value="+269">+269</option>
<option data-countrycode="ZM" value="+260">+260</option>
<option data-countrycode="ZW" value="+263">+263</option>
<option data-countrycode="YT" value="+269">+269</option>
<option data-countrycode="SH" value="+290">+290</option>
<option data-countrycode="ER" value="+291">+291</option>
<option data-countrycode="AW" value="+297">+297</option>
<option data-countrycode="FO" value="+298">+298</option>
<option data-countrycode="GL" value="+299">+299</option>
<option data-countrycode="GI" value="+350">+350</option>
<option data-countrycode="PT" value="+351">+351</option>
<option data-countrycode="LU" value="+352">+352</option>
<option data-countrycode="IE" value="+353">+353</option>
<option data-countrycode="IS" value="+354">+354</option>
<option data-countrycode="MT" value="+356">+356</option>
<option data-countrycode="CY" value="+357">+357</option>
<option data-countrycode="FI" value="+358">+358</option>
<option data-countrycode="BG" value="+359">+359</option>
<option data-countrycode="LT" value="+370">+370</option>
<option data-countrycode="LV" value="+371">+371</option>
<option data-countrycode="EE" value="+372">+372</option>
<option data-countrycode="MD" value="+373">+373</option>
<option data-countrycode="AM" value="+374">+374</option>
<option data-countrycode="BY" value="+375">+375</option>
<option data-countrycode="AD" value="+376">+376</option>
<option data-countrycode="MC" value="+377">+377</option>
<option data-countrycode="SM" value="+378">+378</option>
<option data-countrycode="VA" value="+379">+379</option>
<option data-countrycode="CS" value="+381">+381</option>
<option data-countrycode="UA" value="+380">+380</option>
<option data-countrycode="HR" value="+385">+385</option>
<option data-countrycode="SI" value="+386">+386</option>
<option data-countrycode="BA" value="+387">+387</option>
<option data-countrycode="MK" value="+389">+389</option>
<option data-countrycode="LI" value="+417">+417</option>
<option data-countrycode="SK" value="+421">+421</option>
<option data-countrycode="FK" value="+500">+500</option>
<option data-countrycode="BZ" value="+501">+501</option>
<option data-countrycode="GT" value="+502">+502</option>
<option data-countrycode="SV" value="+503">+503</option>
<option data-countrycode="HN" value="+504">+504</option>
<option data-countrycode="NI" value="+505">+505</option>
<option data-countrycode="CR" value="+506">+506</option>
<option data-countrycode="PA" value="+507">+507</option>
<option data-countrycode="HT" value="+509">+509</option>
<option data-countrycode="GP" value="+590">+590</option>
<option data-countrycode="BO" value="+591">+591</option>
<option data-countrycode="GY" value="+592">+592</option>
<option data-countrycode="EC" value="+593">+593</option>
<option data-countrycode="GF" value="+594">+594</option>
<option data-countrycode="PY" value="+595">+595</option>
<option data-countrycode="MQ" value="+596">+596</option>
<option data-countrycode="SR" value="+597">+597</option>
<option data-countrycode="UY" value="+598">+598</option>
<option data-countrycode="NP" value="+670">+670</option>
<option data-countrycode="GU" value="+671">+671</option>
<option data-countrycode="NF" value="+672">+672</option>
<option data-countrycode="BN" value="+673">+673</option>
<option data-countrycode="NR" value="+674">+674</option>
<option data-countrycode="PG" value="+675">+675</option>
<option data-countrycode="TO" value="+676">+676</option>
<option data-countrycode="SB" value="+677">+677</option>
<option data-countrycode="VU" value="+678">+678</option>
<option data-countrycode="FJ" value="+679">+679</option>
<option data-countrycode="PW" value="+680">+680</option>
<option data-countrycode="WF" value="+681">+681</option>
<option data-countrycode="CK" value="+682">+682</option>
<option data-countrycode="NU" value="+683">+683</option>
<option data-countrycode="KI" value="+686">+686</option>
<option data-countrycode="NC" value="+687">+687</option>
<option data-countrycode="TV" value="+688">+688</option>
<option data-countrycode="PF" value="+689">+689</option>
<option data-countrycode="FM" value="+691">+691</option>
<option data-countrycode="MH" value="+692">+692</option>
<option data-countrycode="KP" value="+850">+850</option>
<option data-countrycode="HK" value="+852">+852</option>
<option data-countrycode="MO" value="+853">+853</option>
<option data-countrycode="KH" value="+855">+855</option>
<option data-countrycode="LA" value="+856">+856</option>
<option data-countrycode="BD" value="+880">+880</option>
<option data-countrycode="TW" value="+886">+886</option>
<option data-countrycode="MV" value="+960">+960</option>
<option data-countrycode="LB" value="+961">+961</option>
<option data-countrycode="JO" value="+962">+962</option>
<option data-countrycode="SI" value="+963">+963</option>
<option data-countrycode="IQ" value="+964">+964</option>
<option data-countrycode="KW" value="+965">+965</option>
<option data-countrycode="SA" value="+966">+966</option>
<option data-countrycode="YE" value="+967">+967</option>
<option data-countrycode="OM" value="+968">+968</option>
<option data-countrycode="YE" value="+969">+969</option>
<option data-countrycode="AE" value="+971">+971</option>
<option data-countrycode="AE" value="+971">+971</option>
<option data-countrycode="IL" value="+972">+972</option>
<option data-countrycode="BH" value="+973">+973</option>
<option data-countrycode="QA" value="+974">+974</option>
<option data-countrycode="BT" value="+975">+975</option>
<option data-countrycode="MN" value="+976">+976</option>
<option data-countrycode="NP" value="+977">+977</option>
<option data-countrycode="TM" value="+993">+993</option>
<option data-countrycode="AZ" value="+994">+994</option>
<option data-countrycode="KG" value="+996">+996</option>
<option data-countrycode="GE" value="+7880">+7880</option>
<option data-countrycode="BS" value="+1242">+1242</option>
<option data-countrycode="BB" value="+1246">+1246</option>
<option data-countrycode="AI" value="+1264">+1264</option>
<option data-countrycode="AG" value="+1268">+1268</option>
<option data-countrycode="VG" value="+1284">+1284</option>
<option data-countrycode="VI" value="+1340">+1340</option>
<option data-countrycode="KY" value="+1345">+1345</option>
<option data-countrycode="BM" value="+1441">+1441</option>
<option data-countrycode="GD" value="+1473">+1473</option>
<option data-countrycode="TC" value="+1649">+1649</option>
<option data-countrycode="MS" value="+1664">+1664</option>
<option data-countrycode="SC" value="+1758">+1758</option>
<option data-countrycode="PR" value="+1787">+1787</option>
<option data-countrycode="DM" value="+1809">+1809</option>
<option data-countrycode="DO" value="+1809">+1809</option>
<option data-countrycode="TT" value="+1868">+1868</option>
<option data-countrycode="KN" value="+1869">+1869</option>
<option data-countrycode="JM" value="+1876">+1876</option>
<option data-countrycode="CY" value="+90392">+90392</option>
 </select>
</span>
                  <input type="text" class="form-control required" id="whatsapp" placeholder="Whatsapp Number" name="whatsapp" required />
                  </div>
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputAddress" class="col-4 control-label">Address</label>
                <div class="col-8">
                  <textarea class="form-control required" id="inputAddress" placeholder="Address" name="address" required > </textarea>
                </div>
              </div>
              
              <div class="tab_title">Personel information</div>
              
<div class="form-group">
                <label for="inputDob" class="col-4 control-label">Date of Birth</label>
                <div class="col-8">
                  <input type="text" class="form-control required" id="inputDob" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="dob" required />
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputGender" class="col-4 control-label">Sex</label>
                <div class="col-8">
                  	<Select class="form-control required" id="inputGender" name="gender" required>
                    	<option value="">Select</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </Select>
                </div>
              </div>
              
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputCountry" class="col-4 control-label">Nationality</label>
                <div class="col-8">
                  	<Select class="form-control required" id="inputCountry" name="country" required>
                    	 <option value="">Select</option>  <option value="Afghanistan">Afghanistan</option>  <option value="Albania">Albania</option>  <option value="Algeria">Algeria</option>  <option value="Argentina">Argentina</option>  <option value="Armenia">Armenia</option>  <option value="Australia">Australia</option>  <option value="Austria">Austria</option>  <option value="Azerbaijan">Azerbaijan</option>  <option value="Bahrain">Bahrain</option>  <option value="Bangladesh">Bangladesh</option>  <option value="Belarus">Belarus</option>  <option value="Belgium">Belgium</option>  <option value="Bolivia">Bolivia</option>  <option value="Brazil">Brazil</option>  <option value="Brunei">Brunei</option>  <option value="Bulgaria">Bulgaria</option>  <option value="Canada">Canada</option>  <option value="Chile">Chile</option>  <option value="China">China</option>  <option value="Colombia">Colombia</option>  <option value="Costa Rica">Costa Rica</option>  <option value="Croatia">Croatia</option>  <option value="Cuba">Cuba</option>  <option value="Cyprus">Cyprus</option>  <option value="Czech Rep">Czech Rep</option>  <option value="Denmark">Denmark</option>  <option value="Ecuador">Ecuador</option>  <option value="Egypt">Egypt</option>  <option value="Eritrea">Eritrea</option>  <option value="Estonia">Estonia</option>  <option value="Ethiopia">Ethiopia</option>  <option value="Finland">Finland</option>  <option value="France">France</option>  <option value="Gabon">Gabon</option>  <option value="Georgia">Georgia</option>  <option value="Germany">Germany</option>  <option value="Ghana">Ghana</option>  <option value="Greece">Greece</option>  <option value="Hong Kong">Hong Kong</option>  <option value="Hungary">Hungary</option>  <option value="Iceland">Iceland</option>  <option value="India">India</option>  <option value="Indonesia">Indonesia</option>  <option value="Iran">Iran</option>  <option value="Iraq">Iraq</option>  <option value="Ireland">Ireland</option>  <option value="Italy">Italy</option>  <option value="Jamaica">Jamaica</option>  <option value="Japan">Japan</option>  <option value="Jordan">Jordan</option>  <option value="Kazakhstan">Kazakhstan</option>  <option value="Kenya">Kenya</option>  <option value="Korea">Korea</option>  <option value="Kuwait">Kuwait]</option>  <option value="Kyrgyzstan">Kyrgyzstan</option>  <option value="Latvia">Latvia</option>  <option value="Lebanon">Lebanon</option>  <option value="Liberia">Liberia</option>  <option value="Libya">Libya</option>  <option value="Lithuania">Lithuania</option>  <option value="Luxembourg">Luxembourg</option>  <option value="Macedonia">Macedonia</option>  <option value="Madagascar">Madagascar</option>  <option value="Malaysia">Malaysia</option>  <option value="Mali">Mali</option>  <option value="Malta">Malta</option>  <option value="Mauritania">Mauritania</option>  <option value="Mauritius">Mauritius</option>  <option value="Mexico">Mexico</option>  <option value="Moldova">Moldova</option>  <option value="Mongolia">Mongolia</option>  <option value="Montenegro">Montenegro</option>  <option value="Morocco">Morocco</option>  <option value="Mozambique">Mozambique</option>  <option value="Namibia">Namibia</option>  <option value="Nepal">Nepal</option>  <option value="Netherlands">Netherlands</option>  <option value="New Zealand">New Zealand</option>  <option value="Niger">Niger</option>  <option value="Nigeria">Nigeria</option>  <option value="Norway">Norway</option>  <option value="Oman">Oman</option>  <option value="Others">Others</option>  <option value="Pakistan">Pakistan</option>  <option value="Palestine">Palestine</option>  <option value="Paraguay">Paraguay</option>  <option value="Peru">Peru</option>  <option value="Philippines">Philippines</option>  <option value="Poland">Poland</option>  <option value="Portugal">Portugal</option>  <option value="Puerto Rico">Puerto Rico</option>  <option value="Qatar">Qatar</option>  <option value="Romania">Romania</option>  <option value="Russia">Russia</option>  <option value="Saudi Arabia">Saudi Arabia</option>  <option value="Senegal">Senegal</option>  <option value="Serbia">Serbia</option>  <option value="Sierra Leone">Sierra Leone</option>  <option value="Singapore">Singapore</option>  <option value="Slovakia">Slovakia</option>  <option value="Slovenia">Slovenia</option>  <option value="South Africa">South Africa</option>  <option value="Spain">Spain</option>  <option value="Sri Lanka">Sri Lanka</option>  <option value="Sudan">Sudan</option>  <option value="Sweden">Sweden</option>  <option value="Switzerland">Switzerland</option>  <option value="Syria">Syria</option>  <option value="Taiwan">Taiwan</option>  <option value="Tajikistan">Tajikistan</option>  <option value="Tanzania">Tanzania</option>  <option value="Thailand">Thailand</option>  <option value="Togo">Togo</option>  <option value="Tonga">Tonga</option>  <option value="Tunisia">Tunisia</option>  <option value="Turkey">Turkey</option>  <option value="Turkmenistan">Turkmenistan</option>  <option value="Ukraine">Ukraine</option>  <option value="United Arab Emirates">United Arab Emirates</option>  <option value="United Kingdom">United Kingdom</option>  <option value="United States">United States</option>  <option value="Uruguay">Uruguay</option>  <option value="Uzbekistan">Uzbekistan</option>  <option value="Venezuela">Venezuela</option>  <option value="Vietnam">Vietnam</option>  <option value="Yemen">Yemen</option>  <option value="Zambia">Zambia</option>  <option value="Zimbabwe">Zimbabwe</option>  
                  </select>
                </div>
              </div>
               <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputCat" class="col-4 control-label">Category</label>
                <div class="col-8">
                  <label class="col-4">
                        <input value="Model" name="category[]" type="checkbox" class="cat_check">Model
                    </label>
                     <label class="col-4">
                        <input value="Actor" name="category[]" type="checkbox" class="cat_check">Actor
                    </label>
                    <label class="col-4">
                        <input value="Cast" name="category[]" type="checkbox" class="cat_check">Cast
                    </label>
                    <label class="col-4">
                        <input value="Teens" name="category[]" type="checkbox" class="cat_check">Teens
                    </label>
                    <label class="col-4">
                        <input value="Kids" name="category[]" type="checkbox" class="cat_check">Kids        
                    </label>
                    <label class="col-4">
                        <input value="Hostess" name="category[]" type="checkbox" class="cat_check">Hostess
                    </label>
                    <label class="col-4">
                        <input value="Plus Size Model" name="category[]" type="checkbox" class="cat_check">Plus Size Model          
                    </label>
                    <label class="col-4">
                        <input value="Stylist" name="category[]" type="checkbox" class="cat_check">Stylist          
                    </label>
                    <label class="col-4">
                        <input value="Photographer" name="category[]" type="checkbox" class="cat_check">Photographer         
                    </label>
                </div>
              </div>
               <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputEth" class="col-4 control-label">Ethnicity</label>
                <div class="col-8">
                  <label class="col-4">
                      <input value="African" name="ethnicity[]" type="checkbox" class="eth_check">African
                  </label>
                  <label class="col-4">
                      <input value="Arabic" name="ethnicity[]" type="checkbox" class="eth_check">Arabic
                  </label>
                  <label class="col-4">
                      <input value="European" name="ethnicity[]" type="checkbox" class="eth_check">European
                  </label>
                  <label class="col-4">
                      <input value="indian" name="ethnicity[]" type="checkbox" class="eth_check">indian        
                  </label>
                  <label class="col-4">
                      <input value="Asian" name="ethnicity[]" type="checkbox" class="eth_check">Asian          
                  </label>
                  <label class="col-4">
                      <input value="Mediterranean" name="ethnicity[]" type="checkbox" class="eth_check">Mediterranean
                  </label>
                  <label class="col-4">
                      <input value="Oriental" name="ethnicity[]" type="checkbox" class="eth_check">Oriental          
                  </label>
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputMlang" class="col-4 control-label">Mother language</label>
                <div class="col-8">
                <select class="form-control required" id="inputMlang" placeholder="Mother language" name="mlang" required >
                  	<option value="">Select</option>
                      <option value="Arabic" >Arabic</option>
                  
                      <option value="English" >English</option>
                  
                      <option value="Farsi" >Farsi</option>
                  
                      <option value="French" >French</option>
                  
                      <option value="German" >German</option>
                  
                      <option value="Hindi" >Hindi</option>
                  
                      <option value="Italian" >Italian</option>
                  
                      <option value="Malayalam" >Malayalam</option>
                  
                      <option value="Marathi" >Marathi</option>
                  
                      <option value="Russian" >Russian</option>
                  
                      <option value="Spanish" >Spanish</option>
                  
                      <option value="Tagalog" >Tagalog</option>
                       <option value="Other" >Other Language</option>
                    </select>
                  
                </div>
              </div>
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputOlang" class="col-4 control-label">Other languages spoken</label>
                <div class="col-8">
                 <div class="row">
                  <label class="col-6">
                      <input value="Arabic" name="olang[]" type="checkbox" class="foi_lang">Arabic
                  </label>
                  <label class="col-6">
                      <input value="English" name="olang[]" type="checkbox" class="foi_lang">English
                  </label>
                  <label class="col-6">
                      <input value="Farsi" name="olang[]" type="checkbox" class="foi_lang">Farsi
                  </label>
                  <label class="col-6">
                      <input value="French" name="olang[]" type="checkbox" class="foi_lang">French
                  </label>
                  <label class="col-6">
                      <input value="German" name="olang[]" type="checkbox" class="foi_lang">German
                  </label>
                  <label class="col-6">
                      <input value="Hindi" name="olang[]" type="checkbox" class="foi_lang">Hindi          
                  </label>
                  <label class="col-6">
                      <input value="Italian" name="olang[]" type="checkbox" class="foi_lang">Italian
                  </label>
                  <label class="col-6">
                      <input value="Malayalam" name="olang[]" type="checkbox" class="foi_lang">Malayalam          
                  </label>
                  <label class="col-6">
                      <input value="Marathi" name="olang[]" type="checkbox" class="foi_lang">Marathi
                  </label>
                  <label class="col-6">
                      <input value="Russian" name="olang[]" type="checkbox" class="foi_lang">Russian         
                  </label>
                  <label class="col-6">
                      <input value="Spanish" name="olang[]" type="checkbox" class="foi_lang">Spanish        
                  </label>
                  <label class="col-6">
                      <input value="Tagalog" name="olang[]" type="checkbox" class="foi_lang">Tagalog          
                  </label>
                  
                  <label class="col-sm-12">
                      Other, Please specify <input name="olang[]" type="text" class="form-control" />         
                  </label>
                  </div>
                 
                </div>
              </div>
              
              
              <div class="tab_title">Measurement information</div>
              
<div class="form-group">
                <label for="inputHeight" class="col-2 control-label">Height</label>
                <div class="col-4">
                  <select class="form-control required" id="inputHeight" name="height" required>  
                  	<option value="">-None-</option>  
                    <option value="< 10 cm">Less than 10 cm</option> 
                    <?php for($h=10;$h<=150;$h++){ ?>
                     <option value="<?php echo $h; ?>cm"><?php echo $h; ?> cm</option>
                     <?php } ?>
                    <option value="151 cm">151 cm</option> 
                     <option value="152 cm">152 cm</option>
                    <option value="153 cm">153 cm / 5</option>  
                    <option value="155 cm">155 cm / 5-1</option>  
                    <option value="158 cm">158 cm / 5-2</option>  
                    <option value="160 cm">160 cm / 5-3</option>  
                    <option value="163 cm">163 cm / 5-4</option>  
                    <option value="165 cm">165 cm / 5-5</option>  
                    <option value="168 cm">168 cm / 5-6</option>  
                    <option value="170 cm">170 cm / 5-7</option>  
                    <option value="171 cm">171 cm / 5-7</option>  
                    <option value="172 cm">172 cm / 5-7</option>  
                    <option value="173 cm">173 cm / 5-8</option>  
                    <option value="174 cm">174 cm / 5-8</option>  
                    <option value="175 cm">175 cm / 5-9</option>  
                    <option value="176 cm">176 cm / 5-9</option>  
                    <option value="177 cm">177 cm / 5-9</option>  
                    <option value="178 cm">178 cm / 5-10</option>  
                    <option value="179 cm">179 cm / 5-10</option>  
                    <option value="180 cm">180 cm / 5-11</option>  
                    <option value="181 cm">181 cm / 5-11</option>  
                    <option value="183 cm">183 cm / 6</option>  
                    <option value="184 cm">184 cm / 6</option>  
                    <option value="185 cm">185 cm / 6-1</option>  
                    <option value="186 cm">186 cm / 6-1</option>  
                    <option value="187 cm">187 cm / 6-1</option>  
                    <option value="188 cm">188 cm / 6-2</option>  
                    <option value="189 cm">189 cm / 6-2</option>  
                    <option value="190 cm">190 cm / 6-3</option>
                    <option value="191 cm">191 cm / 6-3</option>
                    <option value="192 cm">192 cm / 6-3</option>
                    <option value="193 cm">193 cm / 6-4</option> 
                    <option value="194 cm">194 cm / 6-4</option>
                    <option value="195 cm">195 cm / 6-4</option> 
                    <option value="> 195 cm">More than 195 cm</option> 
                  </select>
                </div>
                <label for="inputWeight" class="col-2 control-label right-label" style="display:none">Weight</label>
                <div class="col-4" style="display:none">
                  <select class="form-control" id="inputWeight" placeholder="Weight" name="weight"  >
                  
                  <option value="">Select</option>
<option value="1 Kg">1 Kg</option>
<option value="2 Kg">2 Kg</option>
<option value="3 Kg">3 Kg</option>
<option value="4 Kg">4 Kg</option>
<option value="5 Kg">5 Kg</option>
<option value="6 Kg">6 Kg</option>
<option value="7 Kg">7 Kg</option>
<option value="8 Kg">8 Kg</option>
<option value="9 Kg">9 Kg</option>
<option value="10 Kg">10 Kg</option>
<option value="11 Kg">11 Kg</option>
<option value="12 Kg">12 Kg</option>
<option value="13 Kg">13 Kg</option>
<option value="14 Kg">14 Kg</option>
<option value="15 Kg">15 Kg</option>
<option value="16 Kg">16 Kg</option>
<option value="17 Kg">17 Kg</option>
<option value="18 Kg">18 Kg</option>
<option value="19 Kg">19 Kg</option>
<option value="20 Kg">20 Kg</option>
<option value="21 Kg">21 Kg</option>
<option value="22 Kg">22 Kg</option>
<option value="23 Kg">23 Kg</option>
<option value="24 Kg">24 Kg</option>
<option value="25 Kg">25 Kg</option>
<option value="26 Kg">26 Kg</option>
<option value="27 Kg">27 Kg</option>
<option value="28 Kg">28 Kg</option>
<option value="29 Kg">29 Kg</option>
<option value="30 Kg">30 Kg</option>
<option value="31 Kg">31 Kg</option>
<option value="32 Kg">32 Kg</option>
<option value="33 Kg">33 Kg</option>
<option value="34 Kg">34 Kg</option>
<option value="35 Kg">35 Kg</option>
<option value="36 Kg">36 Kg</option>
<option value="37 Kg">37 Kg</option>
<option value="38 Kg">38 Kg</option>
<option value="39 Kg">39 Kg</option>
<option value="40 Kg">40 Kg</option>
<option value="41 Kg">41 Kg</option>
<option value="42 Kg">42 Kg</option>
<option value="43 Kg">43 Kg</option>
<option value="44 Kg">44 Kg</option>
<option value="45 Kg">45 Kg</option>
<option value="46 Kg">46 Kg</option>
<option value="47 Kg">47 Kg</option>
<option value="48 Kg">48 Kg</option>
<option value="49 Kg">49 Kg</option>
<option value="50 Kg">50 Kg</option>
<option value="51 Kg">51 Kg</option>
<option value="52 Kg">52 Kg</option>
<option value="53 Kg">53 Kg</option>
<option value="54 Kg">54 Kg</option>
<option value="55 Kg">55 Kg</option>
<option value="56 Kg">56 Kg</option>
<option value="57 Kg">57 Kg</option>
<option value="58 Kg">58 Kg</option>
<option value="59 Kg">59 Kg</option>
<option value="60 Kg">60 Kg</option>
<option value="61 Kg">61 Kg</option>
<option value="62 Kg">62 Kg</option>
<option value="63 Kg">63 Kg</option>
<option value="64 Kg">64 Kg</option>
<option value="65 Kg">65 Kg</option>
<option value="66 Kg">66 Kg</option>
<option value="67 Kg">67 Kg</option>
<option value="68 Kg">68 Kg</option>
<option value="69 Kg">69 Kg</option>
<option value="70 Kg">70 Kg</option>
<option value="71 Kg">71 Kg</option>
<option value="72 Kg">72 Kg</option>
<option value="73 Kg">73 Kg</option>
<option value="74 Kg">74 Kg</option>
<option value="75 Kg">75 Kg</option>
<option value="76 Kg">76 Kg</option>
<option value="77 Kg">77 Kg</option>
<option value="78 Kg">78 Kg</option>
<option value="79 Kg">79 Kg</option>
<option value="80 Kg">80 Kg</option>
<option value="81 Kg">81 Kg</option>
<option value="82 Kg">82 Kg</option>
<option value="83 Kg">83 Kg</option>
<option value="84 Kg">84 Kg</option>
<option value="85 Kg">85 Kg</option>
<option value="86 Kg">86 Kg</option>
<option value="87 Kg">87 Kg</option>
<option value="88 Kg">88 Kg</option>
<option value="89 Kg">89 Kg</option>
<option value="90 Kg">90 Kg</option>
<option value="91 Kg">91 Kg</option>
<option value="92 Kg">92 Kg</option>
<option value="93 Kg">93 Kg</option>
<option value="94 Kg">94 Kg</option>
<option value="95 Kg">95 Kg</option>
<option value="96 Kg">96 Kg</option>
<option value="97 Kg">97 Kg</option>
<option value="98 Kg">98 Kg</option>
<option value="99 Kg">99 Kg</option>
<option value="100 Kg">100 Kg</option>
<option value="101 Kg">101 Kg</option>
<option value="102 Kg">102 Kg</option>
<option value="103 Kg">103 Kg</option>
<option value="104 Kg">104 Kg</option>
<option value="105 Kg">105 Kg</option>
<option value="106 Kg">106 Kg</option>
<option value="107 Kg">107 Kg</option>
<option value="108 Kg">108 Kg</option>
<option value="109 Kg">109 Kg</option>
<option value="110 Kg">110 Kg</option>
<option value="111 Kg">111 Kg</option>
<option value="112 Kg">112 Kg</option>
<option value="113 Kg">113 Kg</option>
<option value="114 Kg">114 Kg</option>
<option value="115 Kg">115 Kg</option>
<option value="116 Kg">116 Kg</option>
<option value="117 Kg">117 Kg</option>
<option value="118 Kg">118 Kg</option>
<option value="119 Kg">119 Kg</option>
<option value="120 Kg">120 Kg</option>
<option value="121 Kg">121 Kg</option>
<option value="122 Kg">122 Kg</option>
<option value="123 Kg">123 Kg</option>
<option value="124 Kg">124 Kg</option>
<option value="125 Kg">125 Kg</option>
<option value="126 Kg">126 Kg</option>
<option value="127 Kg">127 Kg</option>
<option value="128 Kg">128 Kg</option>
<option value="129 Kg">129 Kg</option>
<option value="130 Kg">130 Kg</option>
<option value="131 Kg">131 Kg</option>
<option value="132 Kg">132 Kg</option>
<option value="133 Kg">133 Kg</option>
<option value="134 Kg">134 Kg</option>
<option value="135 Kg">135 Kg</option>
<option value="136 Kg">136 Kg</option>
<option value="137 Kg">137 Kg</option>
<option value="138 Kg">138 Kg</option>
<option value="139 Kg">139 Kg</option>
<option value="140 Kg">140 Kg</option>
<option value="141 Kg">141 Kg</option>
<option value="142 Kg">142 Kg</option>
<option value="143 Kg">143 Kg</option>
<option value="144 Kg">144 Kg</option>
<option value="145 Kg">145 Kg</option>
<option value="146 Kg">146 Kg</option>
<option value="147 Kg">147 Kg</option>
<option value="148 Kg">148 Kg</option>
<option value="149 Kg">149 Kg</option>
<option value="150 Kg">150 Kg</option>
<option value="> 150 Kg">more than 150 Kg</option>
</select>
                </div>
             
                <label for="inputBust" class="col-2 control-label">Bust</label>
                <div class="col-4">
                  <select class="form-control required" id="inputBust" placeholder="Bust" name="bust" required >
                  <option value=""> Select</option>
                  <?php for($h=1;$h<40;$h++){ ?>
                     <option value="<?php echo $h; ?>cm"><?php echo $h; ?> cm</option>
                     <?php } ?>
<option value="40 cm">40 cm</option>
<option value="41 cm">41 cm</option>
<option value="42 cm">42 cm</option>
<option value="43 cm">43 cm</option>
<option value="44 cm">44 cm</option>
<option value="45 cm">45 cm</option>
<option value="46 cm">46 cm</option>
<option value="47 cm">47 cm</option>
<option value="48 cm">48 cm</option>
<option value="49 cm">49 cm</option>
<option value="50 cm">50 cm</option>
<option value="51 cm">51 cm</option>
<option value="52 cm">52 cm</option>
<option value="53 cm">53 cm</option>
<option value="54 cm">54 cm</option>
<option value="55 cm">55 cm</option>
<option value="56 cm">56 cm</option>
<option value="57 cm">57 cm</option>
<option value="58 cm">58 cm</option>
<option value="59 cm">59 cm</option>
<option value="60 cm">60 cm</option>
<option value="61 cm">61 cm</option>
<option value="62 cm">62 cm</option>
<option value="63 cm">63 cm</option>
<option value="64 cm">64 cm</option>
<option value="65 cm">65 cm</option>
<option value="66 cm">66 cm</option>
<option value="67 cm">67 cm</option>
<option value="68 cm">68 cm</option>
<option value="69 cm">69 cm</option>
<option value="70 cm">70 cm</option>
<option value="71 cm">71 cm</option>
<option value="72 cm">72 cm</option>
<option value="73 cm">73 cm</option>
<option value="74 cm">74 cm</option>
<option value="75 cm">75 cm</option>
<option value="76 cm">76 cm</option>
<option value="77 cm">77 cm</option>
<option value="78 cm">78 cm</option>
<option value="79 cm">79 cm</option>
<option value="80 cm">80 cm</option>
<option value="81 cm">81 cm</option>
<option value="82 cm">82 cm</option>
<option value="83 cm">83 cm</option>
<option value="84 cm">84 cm</option>
<option value="85 cm">85 cm</option>
<option value="86 cm">86 cm</option>
<option value="87 cm">87 cm</option>
<option value="88 cm">88 cm</option>
<option value="89 cm">89 cm</option>
<option value="90 cm">90 cm</option>
<option value="91 cm">91 cm</option>
<option value="92 cm">92 cm</option>
<option value="93 cm">93 cm</option>
<option value="94 cm">94 cm</option>
<option value="95 cm">95 cm</option>
<option value="96 cm">96 cm</option>
<option value="97 cm">97 cm</option>
<option value="98 cm">98 cm</option>
<option value="99 cm">99 cm</option>
<option value="100 cm">100 cm</option>
<option value="101 cm">101 cm</option>
<option value="102 cm">102 cm</option>
<option value="103 cm">103 cm</option>
<option value="104 cm">104 cm</option>
<option value="105 cm">105 cm</option>
<option value="106 cm">106 cm</option>
<option value="107 cm">107 cm</option>
<option value="108 cm">108 cm</option>
<option value="109 cm">109 cm</option>
<option value="110 cm">110 cm</option>
<option value="111 cm">111 cm</option>
<option value="112 cm">112 cm</option>
<option value="113 cm">113 cm</option>
<option value="114 cm">114 cm</option>
<option value="115 cm">115 cm</option>
<option value="116 cm">116 cm</option>
<option value="117 cm">117 cm</option>
<option value="118 cm">118 cm</option>
<option value="119 cm">119 cm</option>
<option value="120 cm">120 cm</option>
<option value="121 cm">121 cm</option>
<option value="122 cm">122 cm</option>
<option value="123 cm">123 cm</option>
<option value="124 cm">124 cm</option>
<option value="125 cm">125 cm</option>
<option value="126 cm">126 cm</option>
<option value="127 cm">127 cm</option>
<option value="128 cm">128 cm</option>
<option value="129 cm">129 cm</option>
<option value="130 cm">130 cm</option>
<option value="131 cm">131 cm</option>
<option value="132 cm">132 cm</option>
<option value="133 cm">133 cm</option>
<option value="134 cm">134 cm</option>
<option value="135 cm">135 cm</option>
<option value="136 cm">136 cm</option>
<option value="137 cm">137 cm</option>
<option value="138 cm">138 cm</option>
<option value="139 cm">139 cm</option>
<option value="140 cm">140 cm</option>
<option value="141 cm">141 cm</option>
<option value="142 cm">142 cm</option>
<option value="143 cm">143 cm</option>
<option value="144 cm">144 cm</option>
<option value="145 cm">145 cm</option>
<option value="146 cm">146 cm</option>
<option value="147 cm">147 cm</option>
<option value="148 cm">148 cm</option>
<option value="149 cm">149 cm</option>
<option value="150 cm">150 cm</option>
</select>
                </div>
                 </div>
              
              
               <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputWaist" class="col-2 control-label right-label">Waist</label>
                <div class="col-4">
                  <select class="form-control required" id="inputWaist" placeholder="Waist" name="waist" required >
                  <option value="">Select</option>
                  <?php for($h=1;$h<40;$h++){ ?>
                     <option value="<?php echo $h; ?>cm"><?php echo $h; ?> cm</option>
                     <?php } ?>
<option value="40 cm">40 cm</option>
<option value="41 cm">41 cm</option>
<option value="42 cm">42 cm</option>
<option value="43 cm">43 cm</option>
<option value="44 cm">44 cm</option>
<option value="45 cm">45 cm</option>
<option value="46 cm">46 cm</option>
<option value="47 cm">47 cm</option>
<option value="48 cm">48 cm</option>
<option value="49 cm">49 cm</option>
<option value="50 cm">50 cm</option>
<option value="51 cm">51 cm</option>
<option value="52 cm">52 cm</option>
<option value="53 cm">53 cm</option>
<option value="54 cm">54 cm</option>
<option value="55 cm">55 cm</option>
<option value="56 cm">56 cm</option>
<option value="57 cm">57 cm</option>
<option value="58 cm">58 cm</option>
<option value="59 cm">59 cm</option>
<option value="60 cm">60 cm</option>
<option value="61 cm">61 cm</option>
<option value="62 cm">62 cm</option>
<option value="63 cm">63 cm</option>
<option value="64 cm">64 cm</option>
<option value="65 cm">65 cm</option>
<option value="66 cm">66 cm</option>
<option value="67 cm">67 cm</option>
<option value="68 cm">68 cm</option>
<option value="69 cm">69 cm</option>
<option value="70 cm">70 cm</option>
<option value="71 cm">71 cm</option>
<option value="72 cm">72 cm</option>
<option value="73 cm">73 cm</option>
<option value="74 cm">74 cm</option>
<option value="75 cm">75 cm</option>
<option value="76 cm">76 cm</option>
<option value="77 cm">77 cm</option>
<option value="78 cm">78 cm</option>
<option value="79 cm">79 cm</option>
<option value="80 cm">80 cm</option>
<option value="81 cm">81 cm</option>
<option value="82 cm">82 cm</option>
<option value="83 cm">83 cm</option>
<option value="84 cm">84 cm</option>
<option value="85 cm">85 cm</option>
<option value="86 cm">86 cm</option>
<option value="87 cm">87 cm</option>
<option value="88 cm">88 cm</option>
<option value="89 cm">89 cm</option>
<option value="90 cm">90 cm</option>
<option value="91 cm">91 cm</option>
<option value="92 cm">92 cm</option>
<option value="93 cm">93 cm</option>
<option value="94 cm">94 cm</option>
<option value="95 cm">95 cm</option>
<option value="96 cm">96 cm</option>
<option value="97 cm">97 cm</option>
<option value="98 cm">98 cm</option>
<option value="99 cm">99 cm</option>
<option value="100 cm">100 cm</option>
<option value="101 cm">101 cm</option>
<option value="102 cm">102 cm</option>
<option value="103 cm">103 cm</option>
<option value="104 cm">104 cm</option>
<option value="105 cm">105 cm</option>
<option value="106 cm">106 cm</option>
<option value="107 cm">107 cm</option>
<option value="108 cm">108 cm</option>
<option value="109 cm">109 cm</option>
<option value="110 cm">110 cm</option>
<option value="111 cm">111 cm</option>
<option value="112 cm">112 cm</option>
<option value="113 cm">113 cm</option>
<option value="114 cm">114 cm</option>
<option value="115 cm">115 cm</option>
<option value="116 cm">116 cm</option>
<option value="117 cm">117 cm</option>
<option value="118 cm">118 cm</option>
<option value="119 cm">119 cm</option>
<option value="120 cm">120 cm</option>
<option value="121 cm">121 cm</option>
<option value="122 cm">122 cm</option>
<option value="123 cm">123 cm</option>
<option value="124 cm">124 cm</option>
<option value="125 cm">125 cm</option>
<option value="126 cm">126 cm</option>
<option value="127 cm">127 cm</option>
<option value="128 cm">128 cm</option>
<option value="129 cm">129 cm</option>
<option value="130 cm">130 cm</option>
<option value="131 cm">131 cm</option>
<option value="132 cm">132 cm</option>
<option value="133 cm">133 cm</option>
<option value="134 cm">134 cm</option>
<option value="135 cm">135 cm</option>
<option value="136 cm">136 cm</option>
<option value="137 cm">137 cm</option>
<option value="138 cm">138 cm</option>
<option value="139 cm">139 cm</option>
<option value="140 cm">140 cm</option>
<option value="141 cm">141 cm</option>
<option value="142 cm">142 cm</option>
<option value="143 cm">143 cm</option>
<option value="144 cm">144 cm</option>
<option value="145 cm">145 cm</option>
<option value="146 cm">146 cm</option>
<option value="147 cm">147 cm</option>
<option value="148 cm">148 cm</option>
<option value="149 cm">149 cm</option>
<option value="150 cm">150 cm</option>
</select>
                </div>
             
                <label for="inputHips" class="col-2 control-label">Hips</label>
                <div class="col-4">
                 <select class="form-control required" id="inputHips" placeholder="Hips" name="hips" required >
                 <option value="">Select</option>
                 <?php for($h=1;$h<40;$h++){ ?>
                     <option value="<?php echo $h; ?>cm"><?php echo $h; ?> cm</option>
                     <?php } ?>
<option value="40 cm">40 cm</option>
<option value="41 cm">41 cm</option>
<option value="42 cm">42 cm</option>
<option value="43 cm">43 cm</option>
<option value="44 cm">44 cm</option>
<option value="45 cm">45 cm</option>
<option value="46 cm">46 cm</option>
<option value="47 cm">47 cm</option>
<option value="48 cm">48 cm</option>
<option value="49 cm">49 cm</option>
<option value="50 cm">50 cm</option>
<option value="51 cm">51 cm</option>
<option value="52 cm">52 cm</option>
<option value="53 cm">53 cm</option>
<option value="54 cm">54 cm</option>
<option value="55 cm">55 cm</option>
<option value="56 cm">56 cm</option>
<option value="57 cm">57 cm</option>
<option value="58 cm">58 cm</option>
<option value="59 cm">59 cm</option>
<option value="60 cm">60 cm</option>
<option value="61 cm">61 cm</option>
<option value="62 cm">62 cm</option>
<option value="63 cm">63 cm</option>
<option value="64 cm">64 cm</option>
<option value="65 cm">65 cm</option>
<option value="66 cm">66 cm</option>
<option value="67 cm">67 cm</option>
<option value="68 cm">68 cm</option>
<option value="69 cm">69 cm</option>
<option value="70 cm">70 cm</option>
<option value="71 cm">71 cm</option>
<option value="72 cm">72 cm</option>
<option value="73 cm">73 cm</option>
<option value="74 cm">74 cm</option>
<option value="75 cm">75 cm</option>
<option value="76 cm">76 cm</option>
<option value="77 cm">77 cm</option>
<option value="78 cm">78 cm</option>
<option value="79 cm">79 cm</option>
<option value="80 cm">80 cm</option>
<option value="81 cm">81 cm</option>
<option value="82 cm">82 cm</option>
<option value="83 cm">83 cm</option>
<option value="84 cm">84 cm</option>
<option value="85 cm">85 cm</option>
<option value="86 cm">86 cm</option>
<option value="87 cm">87 cm</option>
<option value="88 cm">88 cm</option>
<option value="89 cm">89 cm</option>
<option value="90 cm">90 cm</option>
<option value="91 cm">91 cm</option>
<option value="92 cm">92 cm</option>
<option value="93 cm">93 cm</option>
<option value="94 cm">94 cm</option>
<option value="95 cm">95 cm</option>
<option value="96 cm">96 cm</option>
<option value="97 cm">97 cm</option>
<option value="98 cm">98 cm</option>
<option value="99 cm">99 cm</option>
<option value="100 cm">100 cm</option>
<option value="101 cm">101 cm</option>
<option value="102 cm">102 cm</option>
<option value="103 cm">103 cm</option>
<option value="104 cm">104 cm</option>
<option value="105 cm">105 cm</option>
<option value="106 cm">106 cm</option>
<option value="107 cm">107 cm</option>
<option value="108 cm">108 cm</option>
<option value="109 cm">109 cm</option>
<option value="110 cm">110 cm</option>
<option value="111 cm">111 cm</option>
<option value="112 cm">112 cm</option>
<option value="113 cm">113 cm</option>
<option value="114 cm">114 cm</option>
<option value="115 cm">115 cm</option>
<option value="116 cm">116 cm</option>
<option value="117 cm">117 cm</option>
<option value="118 cm">118 cm</option>
<option value="119 cm">119 cm</option>
<option value="120 cm">120 cm</option>
<option value="121 cm">121 cm</option>
<option value="122 cm">122 cm</option>
<option value="123 cm">123 cm</option>
<option value="124 cm">124 cm</option>
<option value="125 cm">125 cm</option>
<option value="126 cm">126 cm</option>
<option value="127 cm">127 cm</option>
<option value="128 cm">128 cm</option>
<option value="129 cm">129 cm</option>
<option value="130 cm">130 cm</option>
<option value="131 cm">131 cm</option>
<option value="132 cm">132 cm</option>
<option value="133 cm">133 cm</option>
<option value="134 cm">134 cm</option>
<option value="135 cm">135 cm</option>
<option value="136 cm">136 cm</option>
<option value="137 cm">137 cm</option>
<option value="138 cm">138 cm</option>
<option value="139 cm">139 cm</option>
<option value="140 cm">140 cm</option>
<option value="141 cm">141 cm</option>
<option value="142 cm">142 cm</option>
<option value="143 cm">143 cm</option>
<option value="144 cm">144 cm</option>
<option value="145 cm">145 cm</option>
<option value="146 cm">146 cm</option>
<option value="147 cm">147 cm</option>
<option value="148 cm">148 cm</option>
<option value="149 cm">149 cm</option>
<option value="150 cm">150 cm</option>
</select>
                </div>
                 </div>
              
              
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputEye" class="col-2 control-label right-label">Eyes</label>
                <div class="col-4">
                   <select class="form-control required" id="inputEye" placeholder="Eyes" name="eyes" required >
                  	<option value="">Select</option>
                  	<option>Black</option>
                    <option>Brown</option>
                    <option>Blue</option>
                    <option>Gray</option>
                    <option>Green</option>
                  </select>
                </div>
              
                <label for="inputSkin" class="col-2 control-label">Skin</label>
                <div class="col-4">
                  <select class="form-control required" id="inputSkin" placeholder="Skin" name="skin" required >
                  <option value="">Select</option>
                  	<option>Pale White (Light)</option>
                  	<option>White(Fair)</option>
                    <option>Tanned</option>
                    <option>Brown</option>
                    <option>Dark</option>
                    <option>Black</option>
                  </select>
                </div>
                </div>
              
              
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                 <label for="inputHair" class="col-2 control-label right-label">Hair</label>
                <div class="col-4">
                   <select class="form-control required" id="inputHair" placeholder="Hair" name="hair" required >
                  <option value="">Select</option>
                  	<option>Black</option>
                    <option>Brown</option>
                    <option>Blonde</option>
                    <option>Gray</option>
                    <option>Red</option>
                  </select>
                </div>
             
              	<label for="inputShoe" class="col-2 control-label ">Shoe</label>
                <div class="col-4">
               		<select class="form-control required" id="inputShoe" placeholder="Shoe size in cm" name="shoe" required>  
                  	<option value="">-None-</option>
                  <option value="2 UK / 34.5 EU">2 UK / 34.5 EU</option>  <option value="2.5 UK / 35 EU">2.5 UK / 35 EU</option>  <option value="3 UK / 35.5 EU">3 UK / 35.5 EU</option>  <option value="3.5 UK / 36 EU">3.5 UK / 36 EU</option>  <option value="4 UK / 37 EU">4 UK / 37 EU</option>  <option value="4.5 UK / 37.5 EU">4.5 UK / 37.5 EU</option>  <option value="5 UK / 37.5 EU">5 UK / 37.5 EU</option>  <option value="5.5 UK / 38 EU">5.5 UK / 38 EU</option>  <option value="6 UK / 38.5 EU">6 UK / 38.5 EU</option>  <option value="6.5 UK / 39 EU">6.5 UK / 39 EU</option>  <option value="7 UK / 40 EU">7 UK / 40 EU</option>  <option value="7.5 UK / 41 EU">7.5 UK / 41 EU</option>  <option value="8 UK / 42 EU">8 UK / 42 EU</option>  <option value="8.5 UK / 43 EU">8.5 UK / 43 EU</option>  <option value="10 UK / 44 EU">10 UK / 44 EU</option>  <option value="11 UK / 45 EU">11 UK / 45 EU</option>
                  </select>
                </div>
                 </div>
              
              
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
                <label for="inputDress" class="col-2 control-label right-label">Dress</label>
                <div class="col-4">
                <label class="col-6">
                      <input value="Extra Small"  name="dress[]"  type="checkbox" class="dress_check" />Extra Small
                  </label>
                  <label class="col-6">
                      <input value="Small"  name="dress[]"  type="checkbox" class="dress_check"/>Small
                  </label>
                  
                  <label class="col-6">
                      <input value="Medium"  name="dress[]"  type="checkbox" class="dress_check" />Medium
                  </label>
                  <label class="col-6">
                      <input value="Large"  name="dress[]"  type="checkbox" class="dress_check"/>Large
                  </label>
                  <label class="col-6">
                      <input value="Extra Large"  name="dress[]"  type="checkbox"class="dress_check" />Extra Large
                  </label>
                </div>
                 
              </div>
              
              <div class="tab_title">General information</div>
              
              
<div class="form-group">
                <label for="inputFoi" class="col-4 control-label">Fields of interest</label>
                <div class="col-8">
                  <label class="col-4">
                      <input value="Fashion shows"  name="foi[]"  type="checkbox" class="foi_check" />Fashion shows
                  </label>
                  <label class="col-4">
                      <input value="Movie/Theater acting"  name="foi[]"  type="checkbox" class="foi_check" />Movie/Theater acting
                  </label>
                  <label class="col-4">
                      <input value="TV commercials"  name="foi[]"  type="checkbox" class="foi_check" />TV commercials
                  </label>
                  <label class="col-4">
                      <input value="Corporate videos"  name="foi[]"  type="checkbox" class="foi_check" />Corporate videos          
                  </label>
                 
                  <label class="col-4">
                      <input value="Music video clips"  name="foi[]"  type="checkbox" class="foi_check" />Music video clips          
                  </label>
                  <label class="col-4">
                      <input value="Host/Hostess"  name="foi[]"  type="checkbox" class="foi_check" />Host/Hostess
                  </label>
                  <label class="col-4">
                      <input value="Promotions"  name="foi[]"  type="checkbox" class="foi_check" />Promotions          
                  </label>
                  <label class="col-4">
                      <input value="Extra"  name="foi[]"  type="checkbox" class="foi_check" />Extra          
                  </label>
                  <label class="col-4">
                      <input value="Hand modeling"  name="foi[]"  type="checkbox" class="foi_check" />Hand modeling          
                  </label>
                  <label class="col-4">
                      <input value="Feet modeling"  name="foi[]"  type="checkbox" class="foi_check" />Feet modeling          
                  </label>
                  <label class="col-4">
                      <input value="Teeth modeling"  name="foi[]"  type="checkbox" class="foi_check" />Teeth modeling          
                  </label>
                   <label class="col-10">
                      <input value="Photography shoots for commercial, print, catalogs"  name="foi[]"  type="checkbox" class="foi_check" />Photography shoots for commercial, print, catalogs
                  </label>
                </div>
              </div>
              
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
               <?php /*?> <label for="inputPhotos" class="col-4 control-label">Attach photos </label>
                <div class="col-8">
                 <input type="file" name="files[]" multiple id="inputPhotos" class="required" required />(maximum 20 images) 
                </div><?php */?>
                <label for="inputPhotos" class="col-2 control-label">Attach photos </label>
                <div class="col-8">
                 <p style="background:#EDFF2B; padding:2px">
                 First Photo should be Face Shot.
                 Please upload minimum 7 photos and avoid selfie photos
                 </p>
                 <input type="file" name="file_src-1"  id="inputPhotos" onchange="ajax_upload(this)" class="required" required ><button style=" display:none"></button>
                
                        <div class="progress">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
                        <div class="msg"></div>
                 <button type="button" onClick="add_img(this);" class="btn btn-default" style="margin-top:10px;border: 1px solid #b3b3b3;background: #f4f4f4;">+ Add Image</button><span style="background:#EDFF2B; padding:2px">(maximum 20 images)</span> 
                </div>
              </div>
              
               <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
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
              <div class="tab_title" style="height: 1px; padding: 0; background:#a6a795"></div>
<div class="form-group">
              	<?php
				  
				  //echo recaptcha_get_html($publickey);
				?>
                 <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>" data-callback="recaptchaCallback"></div>
              </div>
              <p class="text-justify" >
              I hereby appoint FLC Production & Model Management to act as my personal manager in the fields of modeling, advertising and entertainment. FLC Production & Model Management is hereby granted the right to use and distribute and allow or license others to make use of and distribute Model's name, portrait and pictures in connection with the advertising and/or publicity and/or website of the model in the fields.  Talent agrees to provide FLC Production & Model Management  with current information, photographs, comp cards, and tear sheets/advertising, written or other related material for promotional use of FLC Production & Model Management
              </p>
              <p class="text-justify" style=" font-style:italic" >
              I have read, understood and agreed, with the terms and conditions stated above. I hereby indemnify FLC Production & Model Management against all information provided by me. I give consent to the discretionary use of my contact information by FLC Production & Model Management
              
              </p>
              <p>For inquiries email us : <a href="mailto:register@flcmodels.com" >register@flcmodels.com</a></p>
<div class="form-group">
                <div class="">
                  <button type="submit" class="btn btn-default" style="padding-left:30px; padding-right:30px; font-size:16px; background:#009944; color:#fff; font-weight:bold;" id="submit_button">Register</button>
                </div>
              </div>
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
	  var img_name=$(val).prev().prev().prev().prev().attr("name");
	  if(!img_name){
		  img_name=$(val).prev().prev().prev().prev().prev().attr("name");
	  }
	  var new_val=parseInt(img_name.substr(img_name.indexOf("-") + 1))+1;
	  if(new_val<=20){
	  $("#img_count").val(new_val);
	  //alert(new_val);
	  $('<input type="file" placeholder="Image" name="file_src-'+new_val+'" onchange="ajax_upload(this)" style="width:60%;" /><button type="button" onclick="del_img('+new_val+',this)" class="del_img">X Delete</button><div class="progress"><div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div></div><div class="msg"></div>').insertBefore($(val));
	  }
	  else{
			alert("Can't Upload more than 20 images");
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
					$(obj).next().next('.progress').show();
					$(obj).next().next().find('.myprogress').css('width', '0');
                   $(obj).next().next().next('.msg').text('');
                    var formData = new FormData();
                    formData.append('myfile', $(obj)[0].files[0]);
					formData.append('filename', filename);
                    $('#submit_button').attr('disabled', 'disabled');
                    $(obj).next().next().next('.msg').text('Uploading in progress...');
					
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
                            $(obj).next().next().next('.msg').text(data);
                            $('#submit_button').removeAttr('disabled');
							if(data=="Image uploaded successfully!"){
								/*setTimeout(function () {
									$(obj).next().next().next().html('');
									$(obj).next().next().fadeOut('slow');
								}, 1000);*/
							}
							else{
                                    var percentComplete =60;
                                    $(obj).next().next().find('.myprogress').text(percentComplete + '%');
                                    $(obj).next().next().find('.myprogress').css('width', percentComplete + '%');
									$(obj).next().next().find('.myprogress').css('background', 'red');
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
                    $(obj).next().next('.msg').text('Deleting...');
					
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
                            $(obj).next().next('.msg').text(data);
							 $(obj).next().next().remove();
							 $(obj).next().remove();
							 $(obj).prev().remove();
							 $(obj).remove();
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
.progress-bar{ background:green;}
</style>
 
  </body>
</html>
<?php $_SESSION['img_files']=""; $_SESSION['img_count']=1; ob_end_flush(); ?>