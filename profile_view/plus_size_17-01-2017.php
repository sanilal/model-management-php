<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLC Production & Model Management - Plus Size Search</title>
    <meta name="author" content="www.flcmodels.com"/>
    <meta name="Description" content="FLC Models & Talents provide you with a range of local & international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more Dubai , UAE .Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels."/>
    
    <meta name="Keywords" content="Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist "/>
    <meta name="robots" content="index,follow"/>
    <meta name="rating" content="General"/>

   <?php include_once("includes/head_common.php"); ?>
   
</head>

<body>  
    
  <div class="container">
    	 <?php include_once("includes/header.php"); ?>
        
    </div>
    
    <!-- Page Content -->
    <div class="container inner_content">
			<div class="punch_cont">
        	<div class="text-left">
                <a class="text_none" href="plus_size.php"><span class="title-grey">PLUS SIZE &gt;</span></a>
               
                <span>
                <?php
					if(isset($_POST['gender'])){
						echo "Search Result";
					}
					else{
						echo "Search";
					}
				?>
                </span>
            </div>
        </div>
        <!-- Jumbotron Header -->
         <?php /*?><header class="hero-spacer">
        	<div>
                <a class="text_none" href="cast.php"><span class="title-grey">CAST &gt;</span></a>
                <span class="title-red">
                	<?php
					if(isset($_POST['gender'])){
						echo "Search Result";
					}
					else{
						echo "Search";
					}
				?>
                </span>
                
                <?php include_once("includes/cart_resp.php"); ?>
            </div>
                        
        </header><?php */?>

       <!-- <hr>-->
		<script type="text/javascript">
			function pagin(obj){
				$("#pagin_form").attr("action","plus_size.php?page="+obj)
				$("#pagin_form").submit();
			}
		</script>
        <!-- Title -->
         <?php
		  require_once("classes/Models.php");
		  $models = new Models();
		  if(isset($_POST['gender'])){
			  ?>
           <div class="row content-main"> 
           <?php include_once("includes/cart_resp.php"); ?>
              <?php
			  $etnicity=NULL;
			  if(isset($_POST['ethnicity'])){
				  if(is_array($_POST['ethnicity'])){
					  $etnicity=$_POST['ethnicity'];
				  }
				  else{
					  $etnicity=explode(",",$_POST['ethnicity']);
				  }
			  }
			  $ethin_str=NULL;
			  if($etnicity!=NULL){ $ethin_str=implode(",",$etnicity); }
			  $age=NULL;
			  if($_POST['age']!=""){
				  $age=$_POST['age'];
			  }
			  //
			  if($_REQUEST['gender']!=""){
				  if($_REQUEST['gender']=="Kids"){
					  $model_res = $models->getKidModels($etnicity);
				  }
				  else{
					  //$model_res = $models->getModels('Model',NULL,$_REQUEST['gend']);
					  $model_res =$models->searchModels('Plus Size',$_POST['gender'],$age,$etnicity,$_POST['name']);
					  $total_num = $models-> paginateResult('Plus Size',$_POST['gender'],$age,$etnicity,$_POST['name']);
				  }
				  $k=1;
				  $total=$total_num->fetch_object();
				  $total_pag= ceil($total->total/$models->limit);
				  ?>
				 <div class="col-lg-12">
            		<div class="pagination_flc">
					   <form method="post" action="" id="pagin_form">
                       	<ul class="pagination">
					  <?php
					  $i=1;
					  $current_page=1;
					  if(isset($_REQUEST['page'])){
						  $current_page=$_REQUEST['page'];
					  }
					  while($i<=$total_pag){
						  if($current_page==$i){
							  echo '<li class="active"><a href="#">'.$i.'</a></li>';
						  }
						  else{
							  echo '<li><a href="javascript:;" onclick="pagin('.$i.')">'.$i.'</a></li>';
						  }
						  $i++;
					  }
					  ?>
                      </ul>
						  <input type="hidden" name="gender" value="<?php echo $_POST['gender'] ?>"  />
						  <input type="hidden" name="age" value="<?php echo $_POST['age'] ?>"  />
							 <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"  />
						  <?php if($ethin_str!=NULL){ ?>
						  <input type="hidden" name="ethnicity" value="<?php echo $ethin_str; ?>"  />
						  <?php }?>
						  
					  	</form>
                      </div>
				  </div>
				  <div  style="padding: 0px 10px; ">
				  <?php
				  while($row=$model_res->fetch_object()){
					  ?>
					 <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=plus_size" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="../app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - Plus Size" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div> 
										  
					  <?php
					  $k++;
				  }
				  if($k==1){
					  echo '<div class="title-red" style="font-size:15px"> No Results</div>';
				  }
				  
				  ?>
				  </div>   
				  <?php
			  }
		   ?>
          </div>
          <?php
		  }
		  else{ ?>
        <div class="row content-main">  
        <?php include_once("includes/cart_resp.php"); ?> 
        	<div class="col-lg-7">
                <form class="form-horizontal" method="post" action="">
                
                    <div class="form-group">
                        <label for="inputName" class="col-xs-2 col-sm-2 text-left">Name:</label>
                        <div class="col-xs-10 col-sm-5">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
                        </div>
                        <div class="col-sm-5 space_search">
                        	&nbsp;
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="inputGender" class="col-xs-2 col-sm-2 text-left">Gender:</label>
                        <div class="col-xs-10 col-sm-5">
                            <Select class="form-control" id="inputGender" name="gender">
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </Select>
                        </div>
                        <div class="col-sm-5 space_search">
                        	&nbsp;
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAge" class="col-xs-2 col-sm-2 text-left">Age:</label>
                        <div class="col-xs-10 col-sm-5">
                            <Select class="form-control" id="inputAge" name="age">
                                <option value="">All</option>
                                <option value="20 AND 25">20 - 25</option>
                                <option value="26 AND 30">26 - 30</option>
                                <option value="31 AND 35">31 - 35</option>
                                <option value="36 AND 40">36 - 40</option>
                                <option value="41 AND 45">41 - 45</option>
                                <option value="46 AND 50">46 - 50</option>
                                <option value="51 AND 100">Above 50</option>
                            </Select>
                        </div>
                        <div class="col-sm-5 space_search">
                        	&nbsp;
                        </div>
                    </div>
            
                    <div class="form-group row">
                    	<label class="col-sm-12">Ethnicity:</label>
                        <div class="col-sm-12">
                        	 <?php
                                
                                $gnd_res = $models->getallEthnicity('Model');
                                $k=1;
                                while($row=$gnd_res->fetch_object()){
                                    

                                    if($row->Ethnicity!=""){
                            ?>
                            <label class="checkbox-inline">
                                <input value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  type="checkbox"><?php echo $row->Ethnicity; ?>
                            </label>
                            <?php
										if($k%3==0){
											echo '</div><div class="col-sm-12">';
										}
										$k++;
								 	}
								}
							 ?>
                            
                        </div>
                        
                    </div>
            
                    <div class="form-group ">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input type="image" src="images/find-b1.gif" />
                        </div>
                    </div>
            
                </form>

        	</div>
        </div>
       <?php } ?>
    </div>
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
