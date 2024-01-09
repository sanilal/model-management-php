<?php
$type_title="Women";
$type_var="women";
?>
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
             <div class="col-4">
                <div class="userRoomBox cf">
				<h2>WANT TO BOOK A TALENT?</h2>
				<a href="contact.php" class="formLink back contactManagerNewMain">Please contact us</a>

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
			if(isset($_POST['age'])){
				if($_POST['age']!=""){
					$age=$_POST['age'];
				}
			}
			$gender='Female';
			if(isset($_POST['gender'])){
				$gender=$_POST['gender'];
			}
			$name="";
			if(isset($_POST['name'])){
				$name=$_POST['name'];
			}
			?>

			</div>
            
            <div class="modFilters cf">

	<form action="<?php echo $type_var ?>.php" method="post" >
	<div class="filtersBoxes hideMobile " style="clear:both;">
		

	<h2>FILTERS</h2>
    <?php if(isset($_POST['name'])){ ?>
	<a href="<?php echo $type_var; ?>.php" class="marked  hidden" id="clearFilters" style="display: inline;"><img src="assets/images/icon_delete_p.png" height="9" /> clear all filters</a>
    <?php } ?>
	<div class="modFilterBox modFiltersSearch">
		<h2>SEARCH BY NAME</h2>
			<input type="text" name="name" value="<?php echo $name; ?>" id="search_artist" autocomplete="off" class="form_field_text ">			<!-- <input type="submit" id="submitSearchArtist" value="search" class="form_field_submit back" style="margin-left:5px;" > -->
	</div>





			<div class="modFilterBox filterCheckboxes">

			
			
			<h2>AGE RANGE</h2>



			  <Select class="form-control" id="inputAge" name="age">
                                <option value="">All</option>
                                <option value="20 AND 25" <?php if($age!=NULL && $age=='20 AND 25'){ echo 'selected="selected"';} ?>>20 - 25</option>
                                <option value="26 AND 30" <?php if($age!=NULL && $age=='26 AND 30'){ echo 'selected="selected"';} ?>>26 - 30</option>
                                <option value="31 AND 35" <?php if($age!=NULL && $age=='31 AND 35'){ echo 'selected="selected"';} ?>>31 - 35</option>
                                <option value="36 AND 40" <?php if($age!=NULL && $age=='36 AND 40'){ echo 'selected="selected"';} ?>>36 - 40</option>
                                <option value="41 AND 45" <?php if($age!=NULL && $age=='41 AND 45'){ echo 'selected="selected"';} ?>>41 - 45</option>
                                <option value="46 AND 50" <?php if($age!=NULL && $age=='46 AND 50'){ echo 'selected="selected"';} ?>>46 - 50</option>
                                <option value="51 AND 100" <?php if($age!=NULL && $age=='51 AND 100'){ echo 'selected="selected"';} ?>>Above 50</option>
                            </Select>

			
		</div>
	





	
		<div class="modFilterBox filterCheckboxes" id="filter17">

			
			<h2>ETHNICITY</h2>


							<div class="row">
                            <?php
							require_once(MN_url."classes/Models.php");
			$models = new Models();
                             $gnd_res = $models->getallEthnicity('Model');
                                $k=1;
                                while($row=$gnd_res->fetch_object()){
                                    

                                    if($row->Ethnicity!=""){
										?>
                            <div class="checkboxItem col-6"><input type="checkbox" name="ethnicity[]" 
							<?php if($etnicity!=NULL){ if(in_array($row->Ethnicity,$etnicity)){ echo 'checked="checked"';}} ?> value="<?php echo $row->Ethnicity; ?>"  class="icheckbox_minimal"> <?php echo $row->Ethnicity; ?></div>
                            
                            <?php } } ?>
							
					</div>
				</div>
                <div class="modFilterBox">
                <input type="submit" class="formLink" value="Search" style="border:0;" />
                </div>
                <p>&nbsp; </p>
		


	</div>
	</form>

		
</div>
            
            </div>
            <div class="col-8">
                <h2>Women Models</h2>
               <?php include_once("md-includes/cart_resp.php"); ?>
                <style type="text/css">
                 .cart_content{float: right; margin-top: -40px}
                </style>
               <?php /*?><p>Search Results</p><?php */?>
               <?php  if(isset($_POST['name'])){ ?>
               <div class=" chosenFilters" >Search Results For:  
               <?php if($name!=""){ ?>
               <div class="chosenFilter clearSelectFilter" data-filterid="filterBasedin">Name In: <?php echo $name; ?></div>
               <?php } if($age!=NULL){ ?>
               <div class="chosenFilter clearSelectFilter" data-filterid="filterBasedin">Age Between: <?php echo $age; ?></div>
               <?php } if($ethin_str!=NULL){ ?>
               <div class="chosenFilter clearSelectFilter" data-filterid="filterBasedin">Ethnicity: <?php echo $ethin_str; ?></div>
               <?php } ?>
               
               </div>
               <?php
			   }
			   //echo MN_url."classes/Models.php";
		  require_once(MN_url."classes/Models.php");
			$models = new Models();
			
			$model_res_inter =$models->searchHost('Model','Female',$age,$etnicity,$name,NULL,"Internationals");
			
			if($model_res_inter->num_rows>0){
			  ?>
                <div class=" chosenFilters">INTERNATIONAL MODELS</div>
                <div class="row">
                <?php
				  while($row=$model_res_inter->fetch_object()){
					  if(strpos($row->Resource_Type, 'Plus Size')===false){
					  ?>
                	<div class="col-3">
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
                <?php
					$model_res=$models->searchHost('Model','Female',$age,$etnicity,$name,NULL,"NOTIN");
					if(isset($_POST['name'])){
					$total_num = $models-> paginateHostResult('Model','Female',$age,$etnicity,$name,NULL,"NOTIN",NULL);
					$k=1;
			 $total=$total_num->fetch_object();
			$total_pag= ceil($total->total/$models->limit);
			?>
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
						  <input type="hidden" name="age" value="<?php echo $age; ?>"  />
							 <input type="hidden" name="name" value="<?php echo $name; ?>"  />
						  <?php if($ethin_str!=NULL){ ?>
						  <input type="hidden" name="ethnicity" value="<?php echo $ethin_str; ?>"  />
						  <?php }?>
						  
					  	</form>
            <?php
					}
					?>
                <div class="row">
                <?php
					while($row=$model_res->fetch_object()){
						if(strpos($row->Resource_Type, 'Plus Size')===false){
				?>
                	<div class="col-3">
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
  <script type="text/javascript">
			function pagin(obj){
				$("#pagin_form").attr("action","<?php echo $type_var; ?>.php?page="+obj)
				$("#pagin_form").submit();
			}
		</script>
  <script src="assets/js/icheck.js"></script>
  <script type="text/javascript">
		$('.btnShowFiltes').on('click', function (e) {
			e.preventDefault();

			$('.filtersBoxes').toggle(300);
			$('.filtersBoxes').removeClass('hideMobile');
		});

		$('.showSorting').on('click', function (e) {
			e.preventDefault();

			$('.modFiltersSorting').toggle(300);

		});
		$(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_minimal',
				radioClass: 'iradio_minimal'
				//increaseArea: '20%' // optional
			  });
		})
	</script>
  </body>
</html>