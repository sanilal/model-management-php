<?php
ob_start();
session_start();
?>
<?php $active="model"; ?>
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
</style>



<?php

include("includes/conn.php"); 
    // Your code here to handle a successful verification
  $sucess=0;
	if(isset($_POST['fname'])){
            $id=$_POST['resource_id'];
		$error="";
		if($_POST['fname']!="" || $_POST['email']!="" || $_POST['phone']!="" || $_POST['dob']!="" || $_POST['gender']!="" || $_POST['country']!="" || $_POST['mlang']!=""  || $_POST['height']!=""  || $_POST['weight']!=""  ){	
		
		if(isset($_POST['sub_cats'])){
				$sub_cat=implode(",",$_POST['sub_cats']);
			}		
			
						$cur_date=date("Y-m-d H:i:s");
			// $last_model=mysqli_fetch_object(mysqli_query($url,"select Resource_ID from `Smart_FLC_Resource_Details` ORDER BY Resource_ID DESC LIMIT 1"));
			 //echo $last_model->Resource_ID."<br/>";
			 //$res_id=ltrim($last_model->Resource_ID,'F')+10; 
			 //$res_id='F'.$res_id;
			$query = "UPDATE `Smart_FLC_Resource_Details` SET `First_Name`='".$_POST["fname"]."', `Resource_Type`='".implode(",",$_POST['category'])."', `Gender`='".$_POST['gender']."', `Ethnicity`='".implode(",",$_POST['ethnicity'])."', `Height`='".$_POST["height"]."', `Bust`='".$_POST["bust"]."', `Waist`='".$_POST['waist']."', `Hips`='".$_POST["hips"]."', `HairColor`='".$_POST['hair']."', `SkinColor`='".$_POST["skin"]."', `ShoesSize`='".$_POST["shoe"]."', `EyesColor`='".$_POST['eyes']."', `Native_Language`='".$_POST["mlang"]."', `Languages_Spoken`='".$_POST["olang"]."',  `Last_Name`='".$_POST["lname"]."', `Cell_phone`='".$_POST['phone']."', `Email1`='".$_POST["email"]."', `Address`='".$_POST["address"]."', `Nationality`='".$_POST['country']."', `DOB`='".date('Y-m-d', strtotime($_POST['dob']))."', `DressSize`='".implode(",",$_POST['dress'])."', `Weight`='".$_POST['weight']."', `Modified_By`='".$_SESSION['user_id']."', `Date_Modified`='$cur_date', `publish_photo`='".$_POST['publish_photo']."',`whatsapp`='".$_POST['whatsapp']."',`In_Town_Status`='".$_POST['in_town_st']."', `Age`='".$_POST['age']."', `Sub_Category`='".$sub_cat."' WHERE Resource_ID='$id' ";
			
			$r = mysqli_query($url, $query) or die(mysqli_error($url));
			$r=true;
			if($r){
				
				$sub_folder=getImageFolder($id);
				 //echo $sub_folder; exit;
				 if (!file_exists(image_path.$sub_folder)) {
					mkdir(image_path.$sub_folder, 0755, true);
				}
				$sucess=1;
				//
				$img_path=image_path.$sub_folder."/";
				//
				if($_POST['sorted']==1){
					//var_dump($_POST['gallery']);
					$cnt=01;
					foreach($_POST['gallery'] as $gallery_img){
						$count=sprintf("%02d", $cnt);
						rename($gallery_img,$img_path.$id.'_'.$count.'-'.time().'.jpg');
						$cnt++;
					}
				}
                //
				$all_imgs=glob($img_path.$id.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
				natsort($all_imgs);
				$last_img=end($all_imgs);
				$last_img=ltrim($last_img,"../");
				$last_img_name=explode($id."_",$last_img);
				//var_dump($last_img_name);
				$cnt= substr($last_img_name[1], 0,2 ); 
				//var_dump($cnt); exit;
				if($cnt){
				 $cnt ++;
				}
				else{
					$cnt=01;
				}
				//$cnt=count($all_imgs)+1;
				foreach($_SESSION['img_files'] as $file_val)
				{
					//if($i > 20 ) exit;
					//$img_src=image_upload($_FILES['file_src-'.$i],$_POST['fname']."img".time()."_".$i);
					$count=sprintf("%02d", $cnt);
					//echo $count; exit;
					copy("../photo_gallery/".$file_val, $img_path.$id.'_'.$count.'.jpg');
					$cnt++;
	
				}
			}
					
		  }
		  else{
			  $error="Error: Please fill all required fields to submit the form";
		  }
				

  }
 $model=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$_GET['r_id']."'"));
 
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
                  
                      "Oriental", "Asian");

$dress_arr=array("Extra Small","Small","Medium","Large","Extra Large");				
?>


    
    <!-- Page Content -->
    <div class="content-wrapper">
		<section class="content-header">
          <h1>
            Update Models Info
            <small></small>
          </h1>
          
          <ol class="breadcrumb">
            <li><a href="models.php" class="btn btn-block"><i class="fa fa-eye"></i> View Models</a></li>
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
                  <form class="form-horizontal" id="model_edit_form" action="" method="post" enctype="multipart/form-data" onSubmit="return validate_form();">
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
              <div class="col-sm-10" >
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
                  <label class="col-sm-4">
                        <input value="<?php echo $cat_val; ?>" name="category[]" type="checkbox" class="foi_check" <?php if(in_array($cat_val,$model_cats)){ echo 'checked="checked"';} ?>><?php echo $cat_val; ?>
                    </label>
                 <?php } ?>
                    
                </div>
              </div>
              <div class="form-group">
                <label for="inputEth" class="col-sm-4 control-label">Ethnicity</label>
                <div class="col-sm-8">
                <?php
				$model_eths=explode(",",$model->Ethnicity);
				 foreach($ethn_arr as $ethnct){ ?>
                  <label class="col-sm-4">
                      <input value="<?php echo $ethnct; ?>" name="ethnicity[]" type="checkbox" <?php if(in_array($ethnct,$model_eths)){ echo 'checked="checked"';} ?> class="foi_check"><?php echo $ethnct; ?>
                  </label>
                <?php } ?>
                 
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputCountry" class="col-sm-4 control-label">Nationality</label>
                <div class="col-sm-8">
                 <input type="text" class="form-control required" id="inputCountry" name="country" required value="<?php echo $model->Nationality; ?>" />
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
				 $sub_cats=explode(",",$model->Sub_Category);
				 $check=0;
				 foreach($sub_cats as $s_cat){
				 	if(strpos($s_cat,"International")!== false){
						$check=1;
				  ?>
                  <label class="">
                      <input value="<?php echo $s_cat ?>"  name="sub_cats[]"  type="checkbox" <?php if(strpos($model->Sub_Category,"International")!== false){ echo 'checked="checked"';} ?> />Yes
                  </label>
                  <?php 
				  
					}
					else if($s_cat!=NULL && $s_cat!=""){
					?>
                    <input type="hidden" name="sub_cats[]" value="<?php echo $s_cat ?>" />
                    <?php
					}
					
				 }
				 if($check==0){
				 ?>
                 <label class="">
                      <input value="International"  name="sub_cats[]"  type="checkbox" />Yes
                  </label>
                 <?php } ?>
                </div>
              </div>
              
              </div>
              <div class="col-sm-5"></div>
              </div>
              
              <div class="tab_title">Measurement information</div>
              
              <div class="form-group">
                <label for="inputHeight" class="col-sm-2 control-label">Height</label>
                <div class="col-sm-4">
                <input type="text" class="form-control required" id="inputHeight" name="height" required value="<?php echo $model->Height; ?>"/>
                  <?php /*?><select class="form-control required" id="inputHeight" name="height" required>  
                  	<option value="">-None-</option>
                    <?php foreach($height_arr as $height){ ?>  
                    <option value="<?php echo $height; ?>" <?php if($model->Height==$height){ echo 'selected="selected"';} ?>><?php echo $height; ?></option>
                    <?php } ?>
                  </select><?php */?>
                </div>
                <label for="inputWeight" class="col-sm-2 control-label right-label" style="display:none">Weight</label>
                <div class="col-sm-4" style="display:none">
                  <input type="text" class="form-control" id="inputWeight" placeholder="Weight" name="weight" value="<?php echo $model->Weight; ?>"/>
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
               		<?php /*?><select class="form-control required" id="inputShoe" placeholder="Shoe size in cm" name="shoe" required>  
                  	<option value="">-None-</option>
                    <?php foreach($shoe_arr as $shoe){ ?>
                      <option value="<?php echo $shoe; ?>" <?php if($shoe==$model->ShoesSize){ echo 'selected="selected"';} ?>><?php echo $shoe; ?></option> 
                    <?php } ?>
                  </select><?php */?>
                  <input type="text" class="form-control required" id="inputShoe" placeholder="Shoe size in cm" name="shoe" required value="<?php echo $model->ShoesSize; ?>" />
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
              
             <?php /*?> <div class="form-group" style="display:none">
                <label for="inputPhotos" class="col-sm-4 control-label">Upload photos </label>
                <div class="col-sm-8">
                 <input type="file" name="files[]" multiple id="inputPhotos" />(maximum 20 images) 
                </div>
              </div><?php */?>
              
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
              
             <div class="form-group">
                <label for="inputPhotos" >Photos </label>
                <div class="row">
                <div class="col-md-12" id="sortable">
                    <?php
					$img=0;
				$sub_folder=getImageFolder($model->Resource_ID);
                define('IMAGEPATH', image_path.$sub_folder."/");
					$all_imgs=glob(IMAGEPATH.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					foreach($all_imgs as $filename){
			?>
                    
                   
                      <div class="item col-xs-4">
                        <div  style="height:370px; overflow:hidden; margin-bottom:20px;"><img src="<?php echo $filename; ?>"  /><a href="javascript:;" onClick="crop_md_img(this)" rel="<?php echo $model->Resource_ID; ?>" class="btn btn-warning crop_button" >Crop</a> &nbsp;&nbsp;   <a href="javascript:;" onClick="del_img(this)" rel="<?php echo $model->Resource_ID; ?>" class="btn btn-danger del_button" >Delete</a></div>
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
               
                <label for="inputPhotos" class="col-sm-2 control-label">Add photos </label>
                <div class="col-sm-8">
                 <input type="file" name="file_src-<?php echo $img; ?>"  id="inputPhotos" onchange="ajax_upload(this)"  ><button style=" display:none"></button>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
                        <div class="msg"></div>
                 <button type="button" onClick="add_img(this);" class="btn btn-default" style="margin-top:10px;">+ Add Image</button>(maximum 20 images) 
                </div>
              </div>
          
              <div class="form-group">
                <div class="col-sm-10">
                <input type="hidden" name="resource_id" value="<?php echo $_GET['r_id']; ?>" />
                  <button type="submit" class="btn btn-default" style="padding-left:30px; padding-right:30px; font-size:16px">Update</button>
                </div>
              </div>
              <input type="hidden" name="sorted" value="0" id="moved_status" />
            </form>
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
   var new_img="";
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
	//
	//

	function add_img(val){
	  var img_name=$(val).prev().prev().prev().prev().attr("name");
	  var new_val=parseInt(img_name.substr(img_name.indexOf("-") + 1))+1;
	  if(new_val<=20){
	  $("#img_count").val(new_val);
	  //alert(new_val);
	  $('<input type="file" placeholder="Image" name="file_src-'+new_val+'" onchange="ajax_upload(this)" /><button type="button" onclick="delete_img('+new_val+',this)" class="del_img">X Delete</button><div class="progress"><div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div></div><div class="msg"></div>').insertBefore($(val));
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
                        url: '../ajax_upload.php',
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
							//alert(data);
                            $(obj).next().next().next('.msg').text(data);
                            $('#submit_button').removeAttr('disabled');
							if(data=="Image uploaded successfully!"){
								/*setTimeout(function () {
									$(obj).next().next().next().html('');
									$(obj).next().next().fadeOut('slow');
								}, 1000);*/
								crop_call(obj);
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
	function delete_img(val,obj){
		//alert(val);
		var formData = new FormData();
                    formData.append('index', val);
                    $('#submit_button').attr('disabled', 'disabled');
                    $(obj).next().next('.msg').text('Deleting...');
					
					//alert(filename)
                    $.ajax({
                        url: '../ajax_upload.php',
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
							 $(obj).prev().prev().remove();
							 $(obj).prev().remove();
							 $(obj).remove();
                            $('#submit_button').removeAttr('disabled');
                        }
                    });
                
		}
		
		//
		function crop_call(obj){
			$.ajax({
                        url: '../ajax_upload.php',
                        data: {get_file:"img"},
                        type: 'POST',
                        success: function (data) {
							
							crop_img(obj,data);
                        }
                    });
		}
		
	function crop_img(obj,img){
			//var id=$(obj).attr('rel');
			id="id";
			var img_src="../photo_gallery/"+img;
			BootstrapDialog.show({
				type:'type-default',
				title: 'Crop Image',
				message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('crop_that_image.php?m_id='+id+'&img='+img_src),
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
					$('<img src="'+img_src+'" width="100" style="float:right" />').insertBefore(obj);
				}
			});	 
	}
	
	function crop_md_img(obj){
		
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
					//$(obj).prev().attr('src','');
					//if(new_img==""){new_img=img_src;}
					//$(obj).prev().attr('src',new_img);
					//location.reload();
				}
			});	 
		
	}
	
</script>
<link type="text/css" href="plugins/datepicker/datepicker3.css" rel="stylesheet" />
<script type="text/javascript" src="plugins/datepicker/bootstrap-datepicker.js"></script>
<style type="text/css">
.progress{ display:none}
input[type=file]{ display:inline-block;}
.progress{ margin-bottom:0; clear:both;}
.msg{ margin-bottom:10px;}
.del_img{ background:red; border:0; border-radius:3px;}
</style>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable({
			change: function(event, ui) {
				 var start_pos = ui.item.data('start_pos');
				if (start_pos != ui.item.index()) {
					$("#moved_status").val("1");
				}
            },
            refreshPositions: true,scroll:true,
            containment: 'parent'}).disableSelection();
			
  } );
  </script>
   </body>

</html>
<?php $_SESSION['img_files']=""; $_SESSION['img_count']=1; ob_end_flush(); ?>