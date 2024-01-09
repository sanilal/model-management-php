<?php
error_reporting(0);
ob_start();
session_start();
 $active="model"; ?>
<?php include_once('includes/header.php'); ?>

 <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

 <style type="text/css">
.tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px; margin-bottom:15px;}
.contenter a{ color:#E70310}
.error_red{ border:1px solid #DF1518}
.form-group label{ text-align:left !important;}
.crop_button{ position:absolute; left:20px; bottom:0}
.del_button{ position:absolute; right:20px; bottom:0}
#sortable{ float:none; position:relative; display:block; overflow:auto;}
#sortable .item{ position:relative; }
</style>



<?php

include("includes/conn.php"); 
    // Your code here to handle a successful verification
	
	
	
	
  $sucess=0;
	if(isset($_POST['fname'])){
         $id=$_POST['mailer_id'];
		$error="";
		if($_POST['fname']!="" || $_POST['email']!="" || $_POST['phone']!="" || $_POST['dob']!="" || $_POST['gender']!="" || $_POST['country']!="" || $_POST['mlang']!=""  || $_POST['height']!=""  || $_POST['weight']!=""  ){			
			
			$files=array();
			$sub_cat="";
			if(isset($_POST['inter_status'])){
				$sub_cat=$_POST['inter_status'];
			}
			//$extension=array("jpeg","jpg","png","gif");
			//$cnt=1;
    		
			$cur_date=date("Y-m-d H:i:s");
			$new_sub_cat="";
			if(isset($_POST['new_sub_cats'])){
				$new_sub_cat=implode(",",$_POST['new_sub_cats']);
			}	
			 //$last_model=mysqli_fetch_object(mysqli_query($url,"select Resource_ID from `Smart_FLC_Resource_Details` ORDER BY Resource_ID DESC LIMIT 1"));
			 //echo $last_model->Resource_ID."<br/>";
			// $res_id=ltrim($last_model->Resource_ID,'F')+1; 
			 //$res_id='F'.$res_id;
			 //var_dump($_POST['gallery']); exit;
			$query = "UPDATE `Smart_FLC_mail_Details` SET `First_Name`='".$_POST["fname"]."', `Resource_Type`='".implode(",",$_POST['category'])."', `Gender`='".$_POST['gender']."', `Ethnicity`='".implode(",",$_POST['ethnicity'])."', `Height`='".$_POST["height"]."', `Bust`='".$_POST["bust"]."', `Waist`='".$_POST['waist']."', `Hips`='".$_POST["hips"]."', `HairColor`='".$_POST['hair']."', `SkinColor`='".$_POST["skin"]."', `ShoesSize`='".$_POST["shoe"]."', `EyesColor`='".$_POST['eyes']."', `Native_Language`='".$_POST["mlang"]."', `Languages_Spoken`='".$_POST["olang"]."',  `Last_Name`='".$_POST["lname"]."', `Cell_phone`='".$_POST['phone']."', `Email1`='".$_POST["email"]."', `Address`='".$_POST["address"]."', `Nationality`='".$_POST['country']."', `DOB`='".date('Y-m-d', strtotime($_POST['dob']))."', `DressSize`='".implode(",",$_POST['dress'])."', `Weight`='".$_POST['weight']."', `Modified_By`='".$_SESSION['user_id']."', `Date_Modified`='$cur_date', `publish_photo`='".$_POST['publish_photo']."', images='".implode(",",$_POST['gallery'])."', `whatsapp`='".$_POST['whatsapp']."',`In_Town_Status`='".$_POST['in_town_st']."', `Age`='".$_POST['age']."',Sub_Category='".$sub_cat."', `new_sub_cats`='".$new_sub_cat."' WHERE `Mailer_ID`='$id' ";
			
			//echo $query; exit;
			$r = mysqli_query($url, $query) or die(mysqli_error($url));
			if($r){
				
				if(isset($_POST['add_to_model'])){
					if($_POST['add_to_model']=="true"){
						
						$num=mysqli_num_rows(mysqli_query($url,"SELECT `First_Name` FROM `Smart_FLC_Resource_Details` WHERE `First_Name`='".$_POST["fname"]."' && `Email1`='".$_POST["email"]."' "));
						if($num < 1){
						$last_model=mysqli_fetch_object(mysqli_query($url,"select Resource_ID from `Smart_FLC_Resource_Details` ORDER BY CAST(SUBSTR(`Resource_ID`,INSTR(`Resource_ID`, 'F') + 1) AS UNSIGNED) DESC LIMIT 1"));
			 //echo $last_model->Resource_ID."<br/>";
						 $res_id=ltrim($last_model->Resource_ID,'F')+1; 
						 $res_id='F'.$res_id;
						 $sub_folder=getImageFolder($res_id);
						 //echo $sub_folder; exit;
						 if (!file_exists(image_path.$sub_folder)) {
							mkdir(image_path.$sub_folder, 0755, true);
						}
						$model_imgs=mysqli_fetch_object(mysqli_query($url,"select images from `Smart_FLC_mail_Details` WHERE Mailer_ID='".$_GET['m_id']."'"));
						$all_imgs=explode(",",$model_imgs->images);
						$cnt=1;
						foreach($all_imgs as $filename){
							//echo image_path.$sub_folder.'/'.$res_id.'_'.$cnt.'.jpg';
							$count=sprintf("%02d", $cnt);
						 	copy('../'.$filename, image_path.$sub_folder.'/'.$res_id.'_'.$count.'.jpg');
							$cnt++;
						}
						$query = "INSERT INTO `Smart_FLC_Resource_Details` (`Resource_ID`,`First_Name`, `Resource_Type`, `Gender`, `Ethnicity`, `Height`, `Bust`, `Waist`, `Hips`, `HairColor`, `SkinColor`, `ShoesSize`, `EyesColor`, `Native_Language`, `Languages_Spoken`, `Date_Created`, `Last_Name`, `Cell_phone`, `Email1`, `Address`, `Nationality`, `DOB`, `DressSize`, `Weight`, `Created_By`,`whatsapp`, `In_Town_Status`, `Age`, `Sub_Category`, `from`) VALUES('".$res_id."', '".$_POST["fname"]."', '".implode(",",$_POST['category'])."', '".$_POST['gender']."', '".implode(",",$_POST['ethnicity'])."', '".$_POST["height"]."', '".$_POST["bust"]."', '".$_POST['waist']."', '".$_POST["hips"]."', '".$_POST['hair']."', '".$_POST["skin"]."', '".$_POST["shoe"]."', '".$_POST['eyes']."', '".$_POST["mlang"]."', '".implode(",",$_POST["olang"])."', '".$cur_date."', '".$_POST["lname"]."', '".$_POST['phone']."', '".$_POST["email"]."', '".$_POST["address"]."', '".$_POST['country']."', '".date('Y-m-d', strtotime($_POST['dob']))."', '".implode(",",$_POST['dress'])."', '".$_POST['weight']."', '".$_SESSION['user_id']."', '".$_POST['whatsapp']."', '".$_POST['in_town_st']."', '".$_POST['age']."', '".$sub_cat."', 'request' )";
						//var_dump($query); 
						$success=mysqli_query($url, $query) or die(mysqli_error($url));
						if($success){
							mysqli_query($url,"UPDATE `Smart_FLC_mail_Details` SET `added_status`='Added to Models' WHERE `Mailer_ID`='$id'");
							/*foreach($all_imgs as $filename){
								unlink('../'.$filename);
							}
							mysqli_query($url,"DELETE FROM `Smart_FLC_mail_Details` WHERE `Mailer_ID`='$id'");*/
						}
					}
					else{
						$error.="The model details already exist in models";
					}
					}
				}
				$sucess=1;
			}
					
		  }
		  else{
			  $error.="Error: Please fill all required fields to submit the form";
		  }
				

  }
 
 
 $country_arr=array("Afghanistan",  "Albania",  "Algeria",  "Argentina",  "Armenia",  "Australia",  "Austria",  "Azerbaijan",  "Bahrain",  "Bangladesh",  "Belarus",  "Belgium",  "Bolivia",  "Brazil",  "Brunei",  "Bulgaria",  "Canada",  "Chile",  "China",  "Colombia",  "Costa Rica",  "Croatia",  "Cuba",  "Cyprus",  "Czech Rep",  "Denmark",  "Ecuador",  "Egypt",  "Eritrea",  "Estonia",  "Ethiopia",  "Finland",  "France",  "Gabon",  "Georgia",  "Germany",  "Ghana",  "Greece",  "Hong Kong",  "Hungary",  "Iceland",  "India",  "Indonesia",  "Iran",  "Iraq",  "Ireland",  "Italy",  "Jamaica",  "Japan",  "Jordan",  "Kazakhstan",  "Kenya",  "Korea",  "Kuwait]",  "Kyrgyzstan",  "Latvia",  "Lebanon",  "Liberia",  "Libya",  "Lithuania",  "Luxembourg",  "Macedonia",  "Madagascar",  "Malaysia",  "Mali",  "Malta",  "Mauritania",  "Mauritius",  "Mexico",  "Moldova",  "Mongolia",  "Montenegro",  "Morocco",  "Mozambique",  "Namibia",  "Nepal",  "Netherlands",  "New Zealand",  "Niger",  "Nigeria",  "Norway",  "Oman",  "Others",  "Pakistan",  "Palestine",  "Paraguay",  "Peru",  "Philippines",  "Poland",  "Portugal",  "Puerto Rico",  "Qatar",  "Romania",  "Russia",  "Saudi Arabia",  "Senegal",  "Serbia",  "Sierra Leone",  "Singapore",  "Slovakia",  "Slovenia",  "South Africa",  "Spain",  "Sri Lanka",  "Sudan",  "Sweden",  "Switzerland",  "Syria",  "Taiwan",  "Tajikistan",  "Tanzania",  "Thailand",  "Togo",  "Tonga",  "Tunisia",  "Turkey",  "Turkmenistan",  "Ukraine",  "United Arab Emirates",  "United Kingdom",  "United States",  "Uruguay",  "Uzbekistan",  "Venezuela",  "Vietnam",  "Yemen",  "Zambia",  "Zimbabwe");
 
 $height_arr=array("Less than 152 cm",  
                    "153 cm / 5",  
                    "155 cm / 5-1",  
                    "158 cm / 5-2",  
                    "160 cm / 5-3",  
                    "163 cm / 5-4",  
                    "165 cm / 5-5",  
                    "168 cm / 5-6",  
                    "170 cm / 5-7",  
                    "171 cm / 5-7",  
                    "172 cm / 5-7",  
                    "173 cm / 5-8",  
                    "174 cm / 5-8",  
                    "175 cm / 5-9",  
                    "176 cm / 5-9",  
                    "177 cm / 5-9",  
                    "178 cm / 5-10",  
                    "179 cm / 5-10",  
                    "180 cm / 5-11",  
                    "181 cm / 5-11",  
                    "183 cm / 6",  
                    "184 cm / 6",  
                    "185 cm / 6-1",  
                    "186 cm / 6-1",  
                    "187 cm / 6-1",  
                    "188 cm / 6-2",  
                    "189 cm / 6-2",  
                    "190 cm / 6-3",
                    "191 cm / 6-3",
                    "192 cm / 6-3",
                    "193 cm / 6-4", 
                    "194 cm / 6-4",
                    "195 cm / 6-4", 
                    "More than 195 cm");
					
$shoe_arr=array("2 UK / 34.5 EU",  "2.5 UK / 35 EU",  "3 UK / 35.5 EU",  "3.5 UK / 36 EU",  "4 UK / 37 EU",  "4.5 UK / 37.5 EU",  "5 UK / 37.5 EU",  "5.5 UK / 38 EU",  "6 UK / 38.5 EU",  "6.5 UK / 39 EU",  "7 UK / 40 EU",  "7.5 UK / 41 EU",  "8 UK / 42 EU",  "8.5 UK / 43 EU",  "10 UK / 44 EU",  "11 UK / 45 EU");

$cat_arr=array(      "Model"
                    ,
                    "Actor",
                        "Cast"
                    ,
                    
                        "Teens"
                    ,
                    
                        "Kids"        
                    ,
                    
                        "Hostess"
                    ,
                    
                        "Plus Size Model"          
                    ,
                    
                        "Stylist"         
                    ,
                    
                        "Photographer","Presenter","Promoter","Entertainer"   
                    );
$ethn_arr=array( "African"
                  ,
                  
                      "Arabic"
                  ,
                  
                      "European"
                  ,
                  
                      "Indian"        
                  ,
                  
                      "Mediterranean"
                  ,
                  
                      "Oriental" , "Asian");

$dress_arr=array("Extra Small","Small","Medium","Large","Extra Large");	
  
  $model=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_mail_Details` WHERE Mailer_ID='".$_GET['m_id']."'"));
 
?>


    
    <!-- Page Content -->
    <div class="content-wrapper">
		<section class="content-header">
          <h1>
            Update Models Info
            <small></small>
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="mail_models.php" class="btn btn-block"><i class="fa fa-eye"></i> View List</a></li>
          </ol>
          
        </section>
        <!-- Jumbotron Header -->
       <?php /*?>  <header class="hero-spacer" style="margin:15px 0px">
        	<div>
                <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                
                <span class="title-red">Register</span>
            </div>
        </header><?php */?>

       <!-- <hr>-->

        <!-- Title -->
        
        
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Update Models</h3> 
              <?php if($sucess==1){ ?>
              	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Successfully Updated</h4>
               	</div>
               <?php } ?> 
               <?php
			if(isset($error)){
				if($error!=0 || $error!=""){ ?>
					<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> <?php echo $error; ?></h4>
                    
               	</div>
                    <?php
				}
				
			}
		?>
            </div>
            
            <div class="box-body">
            <?php
			if(isset($_POST['add_to_model'])){
					if($_POST['add_to_model']=="true"){
						
						echo '<h3 style="color:green; font-weight:bold">Successfully added to models</h3>';
						
					}
			}
			else{
			?>
                  <form class="form-horizontal" action="" id="mail_edit_form" method="post" enctype="multipart/form-data" onSubmit="return validate_form();">
              <div class="tab_title">Contact information</div>
              <div class="row">
              <div class="col-sm-7" >
              <div class="form-group">
                <label for="inputFname" class="col-sm-4 control-label">First Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control required" id="inputFname" placeholder="First Name" name="fname" required value="<?php echo $model->First_Name; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputLname" class="col-sm-4 control-label">Last Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control required" id="inputLname" placeholder="Last Name" name="lname" required value="<?php echo $model->Last_Name; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Email Address</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control required" id="inputEmail3" placeholder="Email Address" name="email" required value="<?php echo $model->Email1; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputPhone" class="col-sm-4 control-label">Mobile Number</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control required" id="inputPhone" placeholder="Mobile Number" name="phone" required value="<?php echo $model->Cell_phone; ?>" />
                </div>
              </div>
               <div class="form-group">
                <label for="whatsapp" class="col-sm-4 control-label">Whatsapp Number</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control required" id="whatsapp" placeholder="Whatsapp Number" name="whatsapp" required value="<?php echo $model->whatsapp; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress" class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                  <textarea class="form-control required" id="inputAddress" placeholder="Address" name="address" required ><?php echo $model->Address; ?></textarea>
                </div>
              </div>
              </div>
              <div class="col-sm-5">
              </div>
              </div>
              <div class="tab_title">Personel information</div>
              <div class="row">
              <div class="col-sm-7" >
              <div class="form-group">
                <label for="inputDob" class="col-sm-4 control-label">Date of Birth</label>
                <div class="col-sm-8">
             <input type="text" class="form-control required" id="inputDob" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="dob" required value="<?php echo $model->DOB; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputGender" class="col-sm-4 control-label">Sex</label>
                <div class="col-sm-8">
                  	<Select class="form-control required" id="inputGender" name="gender" required>
                    	<option value="">Select</option>
                        <option value="Female" <?php if($model->Gender=="Female"){ echo 'selected="selected"';} ?>>Female</option>
                        <option value="Male" <?php if($model->Gender=="Male"){ echo 'selected="selected"';} ?>>Male</option>
                    </Select>
                </div>
              </div>
               <div class="form-group" style="display:none">
                <label for="inputDob" class="col-sm-4 control-label">Age</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="inputDob" name="age" value="<?php echo $model->Age; ?>"  />
                </div>
              </div>
               <div class="form-group">
                <label for="inputCat" class="col-sm-4 control-label">Category</label>
                <div class="col-sm-8">
                  <?php
				$model_cats=explode(",",$model->Resource_Type);
				 foreach($cat_arr as $cat_val){ ?>
                  <label class="col-sm-6">
                        <input value="<?php echo $cat_val; ?>" name="category[]" type="checkbox" class="foi_check category_check" <?php if(in_array($cat_val,$model_cats)){ echo 'checked="checked"';} ?>><?php echo $cat_val; ?>
                    </label>
                 <?php } ?>
                </div>
              </div>
              
              <div class="form-group" <?php if (!array_intersect(array("Photographer","Stylist"), $model_cats)) { echo 'style="display:none"'; } ?> >
                <label for="inputCat" class="col-sm-4 control-label">Sub Category</label>
                <div class="col-sm-8">
                <div id="stylist-subs" <?php if (in_array("Stylist", $model_cats)) { echo 'style="display:block"'; } ?> class="sub_cats">
                <?php
				$sub_cat_arr=array("Food", "Hair", "Make-up", "Hair & Make-up", "Prop stylist", "Prosthetic Stylist", "Wardrobe", "Others", "Out of Town");
				$model_sub_cats=explode(",",$model->new_sub_cats);
				 foreach($sub_cat_arr as $sub_cat){ ?>
                  <label class="col-sm-6">
                        <input value="<?php echo $sub_cat; ?>" name="<?php if (in_array("Stylist", $model_cats)) { echo 'new_sub_cats'; } ?>" type="checkbox" class="foi_check" <?php if(in_array($sub_cat, $model_sub_cats)){ echo 'checked="checked"';} ?>><?php echo $sub_cat; ?>
                    </label>
                 <?php } ?>
                 </div>
                 <div  id="photogr-subs" <?php if (in_array("Photographer", $model_cats)) { echo 'style="display:block"'; } ?> class="sub_cats">
                 <?php
				$sub_cat_arr=array("International", "Advertising Beauty", "Editorial", "Fashion", "Hair", "Jewellery", "Lifestyle", "Food", "Product/ Still Life", "Aerial", "Hotel", "Interior/ Architecture", "Landscape", "Children", "Wedding", "Car", "Out of Town", "Under Water Photography");
				
				$model_sub_cats=explode(",",$model->new_sub_cats);
				 foreach($sub_cat_arr as $sub_cat){ ?>
                  <label class="col-sm-6">
                        <input value="<?php echo $sub_cat; ?>" name="<?php if (in_array("Photographer", $model_cats)) { echo 'new_sub_cats'; } ?>" type="checkbox" class="foi_check" <?php if(in_array($sub_cat, $model_sub_cats)){ echo 'checked="checked"';} ?>><?php echo $sub_cat; ?>
                    </label>
                 <?php }  ?>
                </div>
                 
                </div>
                 
              </div>

              
              <div class="form-group">
                <label for="inputEth" class="col-sm-4 control-label">Ethnicity</label>
                <div class="col-sm-8">
                 <?php
				$model_eths=explode(",",$model->Ethnicity);
				 foreach($ethn_arr as $ethnct){ ?>
                  <label class="col-sm-6">
                      <input value="<?php echo $ethnct; ?>" name="ethnicity[]" type="checkbox" <?php if(in_array($ethnct,$model_eths)){ echo 'checked="checked"';} ?> class="foi_eth"><?php echo $ethnct; ?>
                  </label>
                <?php } ?>
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputCountry" class="col-sm-4 control-label">Nationality</label>
                <div class="col-sm-8">
                  	<Select class="form-control required" id="inputCountry" name="country" required>
                    	 <option value="">Select</option>  
                         <?php foreach($country_arr as $country){ ?>
                         <option value="<?php echo $country; ?>" <?php if($country==$model->Nationality){ echo 'selected="selected"';} ?>><?php echo $country; ?></option>  
                         <?php } ?>  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputMlang" class="col-sm-4 control-label">Mother language</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control required" id="inputMlang" placeholder="Mother language" name="mlang" required value="<?php echo $model->Native_Language; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputOlang" class="col-sm-4 control-label">Other languages spoken</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputOlang" placeholder="Other languages spoken" name="olang" value="<?php echo $model->Languages_Spoken; ?>" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-4 control-label">In town Status? </label>
                 <div class="col-sm-8">
                  <label class="">
                      <input value="Yes"  name="in_town_st"  type="radio" <?php if($model->In_Town_Status=="Yes"){ echo 'checked="checked"';} ?> />Yes
                  </label>
                  <label class="" style="margin-left:15px; display:inline-block">
                      <input value="No"  name="in_town_st"  type="radio" <?php if($model->In_Town_Status!="Yes"){ echo 'checked="checked"';} ?>  />No
                  </label>
                </div>
              </div>
              
                <div class="form-group">
                <label class="col-sm-4 control-label">International Model/talent? </label>
                 <div class="col-sm-8">
                 <?php
				 
				  ?>
                  <label class="">
                      <input value="International"  name="inter_status"  type="checkbox" <?php if(strpos($model->Sub_Category,"International")!== false){ echo 'checked="checked"';} ?> />Yes
                  </label>
                 
                </div>
              </div>
              
              </div>
              <div class="col-sm-5"></div>
              </div>
              
              <div class="tab_title">Measurement information</div>
              
              <div class="form-group">
                <label for="inputHeight" class="col-sm-2 control-label">Height</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" id="inputHeight" name="height" required value="<?php echo $model->Height; ?>" />
                </div>
                <label for="inputWeight" class="col-sm-2 control-label right-label" style="display:none">Weight</label>
                <div class="col-sm-4" style="display:none">
                  <input type="text" class="form-control" id="inputWeight" placeholder="Weight" name="weight" value="<?php echo $model->Weight; ?>"  />
                </div>
              </div>
              
              
               <div class="form-group">
                <label for="inputBust" class="col-sm-2 control-label">Bust</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" id="inputBust" placeholder="Bust" name="bust" required value="<?php echo $model->Bust; ?>" />
                </div>
                <label for="inputWaist" class="col-sm-2 control-label right-label">Waist</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" id="inputWaist" placeholder="Waist" name="waist" required value="<?php echo $model->Waist; ?>" />
                </div>
              </div>
              
              
              <div class="form-group">
                <label for="inputHips" class="col-sm-2 control-label">Hips</label>
                <div class="col-sm-4">
                 <input type="text" class="form-control required" id="inputHips" placeholder="Hips" name="hips" required value="<?php echo $model->Hips; ?>" />
                </div>
                <label for="inputEye" class="col-sm-2 control-label right-label">Eyes</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" id="inputEye" placeholder="Eyes" name="eyes" required value="<?php echo $model->EyesColor; ?>" />
                </div>
              </div>
              
              
              <div class="form-group">
                <label for="inputSkin" class="col-sm-2 control-label">Skin</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" id="inputSkin" placeholder="Skin" name="skin" required value="<?php echo $model->SkinColor; ?>" />
                </div>
                 <label for="inputHair" class="col-sm-2 control-label right-label">Hair</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" id="inputHair" placeholder="Hair" name="hair" required value="<?php echo $model->HairColor; ?>" />
                </div>
              </div>
              
              
              <div class="form-group">
              	<label for="inputShoe" class="col-sm-2 control-label ">Shoe</label>
                <div class="col-sm-4">
               		<select class="form-control required" id="inputShoe" placeholder="Shoe size in cm" name="shoe" required>  
                  	<option value="">-None-</option>
                  <?php foreach($shoe_arr as $shoe){ ?>
                      <option value="<?php echo $shoe; ?>" <?php if($shoe==$model->ShoesSize){ echo 'selected="selected"';} ?>><?php echo $shoe; ?></option> 
                    <?php } ?>
                  </select>
                </div>
                <label for="inputDress" class="col-sm-2 control-label right-label">Dress</label>
                <div class="col-sm-4">
               <?php
				$model_dress=explode(",",$model->DressSize);
				 foreach($dress_arr as $dress){ ?>
                <label class="col-sm-4">
                      <input value="<?php echo $dress; ?>"  name="dress[]" <?php if(in_array($dress,$model_dress)){ echo 'checked="checked"';} ?>  type="checkbox" class="dress_check" /><?php echo $dress; ?>
                  </label>
                <?php } ?>
                </div>
                 
              </div>
              
              <div class="tab_title">General information</div>
              
              <div class="form-group" style="display:none;">
                <label for="inputPhotos" class="col-sm-4 control-label">Upload photos </label>
                <div class="col-sm-8">
                 <input type="file" name="files[]" multiple id="inputPhotos" />(maximum 20 images) 
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPphoto" class="col-sm-4 control-label">Publish photos on website? </label>
                 <div class="col-sm-8">
                  <label class="">
                      <input value="Yes"  name="publish_photo"  type="radio" <?php if($model->publish_photo=="Yes"){ echo 'checked="checked"';} ?> />Yes
                  </label>
                  <label class="" style="margin-left:15px; display:inline-block">
                      <input value="No"  name="publish_photo"  type="radio" <?php if($model->publish_photo=="No"){ echo 'checked="checked"';} ?>  />No
                  </label>
                </div>
              </div>
              
                <div class="form-group" style="margin:0">
                <label for="inputPhotos" >Photos </label>
                <div class="row">
                <div class="col-md-12" id="sortable">
                    <?php
					$img=0;
				/*$sub_folder=getImageFolder($model->Resource_ID);
                define('IMAGEPATH', image_path.$sub_folder."/");*/
					$all_imgs=explode(",",$model->images);
					foreach($all_imgs as $filename){
			?>
                    
                   
                      <div class="item col-xs-4" >
                        <div class="" style="height:370px; overflow:hidden; margin-bottom:20px;"><img src="../<?php echo $filename; ?>" style="max-height:400px;"  />
                        <a href="javascript:;" onClick="crop_img(this)" rel="<?php echo $model->Mailer_ID; ?>" class="btn btn-warning crop_button" >Crop</a> &nbsp;&nbsp;  <a href="javascript:;" onClick="del_img(this)" rel="<?php echo $model->Mailer_ID; ?>" class="btn btn-danger del_button" >Delete</a>
                        </div>
                        <input type="hidden" name="gallery[]" value="<?php echo $filename; ?>" />
                      </div>
                      
                    <?php
					$img++;
				}
				 ?>
                </div>
              </div>
                
                  
              </div>
            
          
              <div class="form-group">
                <div class="col-sm-10">
                <input type="hidden" name="mailer_id" value="<?php echo $_GET['m_id']; ?>" />
                  <button type="submit" class="btn btn-primary" style="padding-left:30px; padding-right:30px; font-size:16px" id="update_button">Update</button>
                  <?php if($model->added_status!="" && $model->added_status!=NULL){ ?>
                  <span class="label label-success "><?php echo $model->added_status; ?></span>
                  <?PHP }  ?>
                  &nbsp;&nbsp;OR &nbsp;
                  <button type="submit" class="btn btn-primary" style="padding-left:30px;  font-size:16px" onClick="return add_to_model(this)">Add to models</button>
                </div>
              </div>
            </form>
            <?php } ?>
                </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
        
       
        
        
    </div>
    
    <?php include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
   <?php include_once('includes/footer-scripts.php'); ?>
   <link rel="stylesheet" href="dist/css/bootstrap-dialog.css">
   <script src="dist/js/bootstrap-dialog.min.js"></script>
    <link rel="stylesheet" href="plugins/img_crop/jquery.Jcrop.css" type="text/css" />
    <script src="plugins/img_crop/jquery.Jcrop.js"></script>
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
		  var check_eth=0;
		 $('.foi_eth').each(function () {
			if ($(this).is(':checked')) {
			  check_eth=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		  if(check_dress==0 || check_foi==0 || check_eth==0){ check=0; }
		if(check==0){
			alert("please fill required fields");
			return false;
			
		}
	}
	//
	function crop_img(obj){
		var check_foi=0;
		 $('.foi_check').each(function () {
			if ($(this).is(':checked')) {
			  check_foi=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		  var check_eth=0;
		 $('.foi_eth').each(function () {
			if ($(this).is(':checked')) {
			  check_eth=1;
			  // Stop .each from processing any more items
			  return false;
			}
		  });
		if(check_foi==1 && check_eth){
			var id=$(obj).attr('rel');
			var img_src=$(obj).prev().attr('src');
			BootstrapDialog.show({
				type:'type-default',
				title: 'Crop Image',
				message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('crop_image.php?m_id='+id+'&img='+img_src),
				buttons: [{
					label: 'Close',
					action: function(dialogItself){
						dialogItself.close();
					}
				}],
				onhide: function(dialogRef){
					$(obj).prev().attr('src','');
					$(obj).prev().attr('src',img_src);
					//location.reload();
				}
			});	 
		}
		else{
			alert("please check category and ethnicity before croping");
		}
	}
	//
	function add_to_model(obj){
		$('<input type="hidden" name="add_to_model" value="true" />').insertBefore($(obj));
		return true;
	}
	//
	function del_img(obj){
		var conf=confirm("Are you sure want to delete this!");
		if(conf){
			var id=$(obj).attr('rel');
			var img_src=$(obj).prev().prev().attr('src');
			//alert(img_src)
			BootstrapDialog.show({
				type:'type-default',
				title: 'Delete Image',
				message: $('<div><div style="text-align:center;">Update after Deleted...<br/><img src="../images/loader.gif"  /></div></div>'),
				buttons: [{
					label: 'Close',
					action: function(dialogItself){
						dialogItself.close();
					}
				}],
				onhide: function(dialogRef){
					//$(obj).prev().attr('src','');
					//$(obj).prev().attr('src',img_src);
					//location.reload();
				}
			});	 
			$.ajax({
                        url: 'ajax/img_delete.php',
                        data: {img:img_src},
                        type: 'POST',
                        success: function (data) {
							if(data=="done"){
                            	BootstrapDialog.closeAll();
								$(obj).parent().parent().remove();
							}
							
                        }
                    });
		}
		
	}
</script>
<link type="text/css" href="plugins/datepicker/datepicker3.css" rel="stylesheet" />
<script type="text/javascript" src="plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
	  $('.category_check').on('change', function() {
			var val = this.checked ? this.value : '';
			if(val=="Stylist"){ $("#stylist-subs").show();  $("#stylist-subs").parent().parent().show(); $("#stylist-subs").find(".foi_check").attr('name','new_sub_cats[]') }
			if(val=="Photographer"){ $("#photogr-subs").show();  $("#photogr-subs").parent().parent().show(); $("#photogr-subs").find(".foi_check").attr('name','new_sub_cats[]') }
			//
			var un_val = !this.checked ? this.value : '';
			if(un_val=="Stylist"){ $("#stylist-subs").hide();   $("#stylist-subs").find(".foi_check").attr('name','') }
			if(un_val=="Photographer"){ $("#photogr-subs").hide();  $("#photogr-subs").find(".foi_check").attr('name','') }
		});
		
    $( "#sortable" ).sortable({
            refreshPositions: true,scroll:true,
            containment: 'parent'}).disableSelection();
  } );
  </script>
   </body>

</html>
<?php ob_end_flush(); ?>