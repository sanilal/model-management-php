<!DOCTYPE html>
<html lang="en">
  <head>
  <title>FLC Production & Model Management- Models Women</title>
	<?php include_once('md_includes/head.php'); ?>
     
 
  </head>

  <body>
    
    <?php include_once('md_includes/header.php'); ?>
        
          <section class="modelsWraper">
    	<div class="container">
    	<div class="row">
            
            <div class="col-12">
                <h2>Women Models</h2>
               <p>&nbsp;</p>
               <?php
			   //echo MN_url."classes/Models.php";
		  require_once(MN_url."classes/Models.php");
			$models = new Models();
			$etnicity=NULL;
			$ethin_str=NULL;
			$age=NULL;
			$model_res_inter =$models->searchHost('Model','Female',NULL,NULL,"",NULL,"Internationals");
			if($model_res_inter->num_rows>0){
			  ?>
                <div class=" chosenFilters">INTERNATIONAL MODELS</div>
                <div class="row">
                <?php
				  while($row=$model_res_inter->fetch_object()){
					  if(strpos($row->Resource_Type, 'Plus Size')===false){
					  ?>
                	<div class="col-2">
               	    	<div class="models-thumb">
                             <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=women"  > 
                             <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob(MN_url.image_path.$sub_folder."/".$row->Resource_ID."*.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  $img_path=ltrim($img_path,MN_url);
						  //$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path=MN_url."app/image.php?img=../".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="img-fluid" alt="FLC Models & Talents - Women International Models" />';
						  if(!file_exists(MN_url.$img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
                             <?php echo $img_code; ?>
                           <span class="moname"><?php echo $row->First_Name; ?>  </span></a>
                        </div>
                    </div>
                    <?php
					  }
				  }
				  
				  ?>
                    
                    
                    
                </div>
                
                <?php } ?>
                
                <div class=" chosenFilters">MODELS</div>
                <div class="row">
                <?php
					$model_res=$models->searchHost('Model','Female',NULL,NULL,"",NULL,"NOTIN");
					while($row=$model_res->fetch_object()){
						if(strpos($row->Resource_Type, 'Plus Size')===false){
				?>
                	<div class="col-2">
               	    	<div class="models-thumb">
                             <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=women"  > 
                             <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob(MN_url.image_path.$sub_folder."/".$row->Resource_ID."*.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  $img_path=ltrim($img_path,MN_url);
						 // var_dump($img_path);
						  //$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path=MN_url."app/image.php?img=../".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="img-fluid" alt="FLC Models & Talents - Women Models" />';
						  if(!file_exists(MN_url.$img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
                             <?php echo $img_code; ?>
                           <span class="moname"><?php echo $row->First_Name; ?>  </span></a>
                        </div>
                    </div>
                <?php } } ?>
                </div>
                  
                </div>




            </div>
        </div>
    </section>

  
  <?php include_once('md_includes/footer.php'); ?>
 
  </body>
</html>