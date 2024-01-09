<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents - Kids </title>
   
</head>

<body>
    
    <?php /*?><div id="slideshow">
      <img src="../image/child_theme.png" class="bgM" /> 
    </div><?php */?>
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">
		<header class="hero-spacer">
        	<?php /*?><div>
                 <a class="text_none" href="kids.php"><span class="title-grey">KIDS &gt;</span></a>
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
            </div><?php */?>
            
            <div class="main_title">
                 KIDS
            </div>
            <div class="title-grey" style="overflow:hidden">
                <?php
                if(isset($_POST['gender'])){
                    echo '<a style="text-decoration:none; float:left" href="javascript:history.back()"><div class="title-grey">Back</div></a><span style="float:left; padding-left:10px; line-height:35px">Search Result</span>';
                }
                else{
                    echo "Search";
                }
            ?>
               
            </div>
                        
        </header>
        <script type="text/javascript">
			function pagin(obj){
				$("#pagin_form").attr("action","kids.php?page="+obj)
				$("#pagin_form").submit();
			}
			function pagin2(obj){
				$("#pagin_form2").attr("action","kids.php?page="+obj)
				$("#pagin_form2").submit();
			}
		</script>
        <!-- Title -->
         <?php
		  require_once("../classes/Models.php");
		  $models = new Models();
		  if(isset($_POST['gender'])){
			  ?>
           <div class="row content-main"> 
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
					  $model_res =$models->searchModels('Kids',$_POST['gender'],$age,$etnicity,$_POST['name']);
					  $total_num = $models-> paginateResult('Kids',$_POST['gender'],$age,$etnicity,$_POST['name']);
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
				  <div class="container" style="padding: 0px 10px;">
				  <?php
				  while($row=$model_res->fetch_object()){
					  ?>
					 <div class="col-sm-15 col-xs-4">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=kids" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - Kids" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
<?php /*?>                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0;"> 
<?php */?>								<?php echo $row->First_Name; ?>  
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
                  <div class="col-lg-12">
            		<div class="pagination_flc">
					   <form method="post" action="" id="pagin_form2">
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
							  echo '<li><a href="javascript:;" onclick="pagin2('.$i.')">'.$i.'</a></li>';
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
				  <?php
			  }
		   ?>
          </div>
          <?php
		  }
		  else{ ?>
        <div class="row content-main">   
        	<div class="col-lg-7 col-xs-12">
                <form class="form-horizontal" method="post" action="">
                
                    <div class="form-group">
                        <label for="inputName" class="col-xs-2 col-sm-2 text-left">Name:</label>
                        <div class="col-xs-12 col-sm-5">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
                        </div>
                      
                    </div>
            
                    <div class="form-group">
                        <label for="inputGender" class="col-xs-2 col-sm-2 text-left">Gender:</label>
                        <div class="col-xs-12 col-sm-5">
                            <Select class="form-control" id="inputGender" name="gender">
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </Select>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAge" class="col-xs-2 col-sm-2 text-left">Age:</label>
                        <div class="col-xs-12 col-sm-5">
                            <Select class="form-control" id="inputAge" name="age">
                               <option value="">All</option>
                                <option value="0 AND 3">0 - 3</option>
                                <option value="4 AND 7">4 - 7</option>
                                <option value="8 AND 12">8 - 12</option>
                            </Select>
                        </div>
                        
                    </div>
            
                    <div class="form-group row">
                    	<label class="col-sm-12">Ethnicity:</label>
                        <div class="col-sm-12">
                        	 <?php
                                
                                $gnd_res = $models->getallEthnicity('Kids');
                                $k=1;
                                while($row=$gnd_res->fetch_object()){
                                    

                                    if($row->Ethnicity!=""){
                            ?>
                            <label class="checkbox">
                                <input value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  type="checkbox"><?php echo $row->Ethnicity; ?>
                            </label>
                            <?php
										/*if($k%3==0){
											echo '</div><div class="col-sm-12">';
										}*/
										$k++;
								 	}
								}
							 ?>
                            
                        </div>
                        
                    </div>
            
                    <div class="form-group ">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input type="image" src="images/search-button.png" height="35" />
                        </div>
                    </div>
            
                </form>

        	</div>
        </div>
       <?php } ?>
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
</body>

</html>