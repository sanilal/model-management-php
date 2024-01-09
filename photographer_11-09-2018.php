<?php
$type_title="Photographer";
$type_var="photographer";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>FLC Production & Model Management - <?php echo $type_title; ?> Search</title>
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
			require_once(MN_url."classes/Models.php");
			$models = new Models();
			$name="";
			if(isset($_POST['name'])){
				$name=$_POST['name'];
			}
			$category="";
			if(isset($_POST['categories'])){
				$category=$_POST['categories'];
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

			
			
			<h2>Category</h2>

					<Select class="form-control" id="categories" name="categories">
                        <option value="">All</option>
                        <option <?php if($category=='International'){ echo 'selected="selected"';} ?>>International</option>
                        <option <?php if($category=='Lifestyle'){ echo 'selected="selected"';} ?>>Lifestyle</option>
                        <option <?php if($category=='Portfolio'){ echo 'selected="selected"';} ?>>Portfolio</option>
                        <option <?php if($category=='Fashion'){ echo 'selected="selected"';} ?>>Fashion</option>
                        <option <?php if($category=='Product<'){ echo 'selected="selected"';} ?>>Product</option>
                        <option <?php if($category=='Children'){ echo 'selected="selected"';} ?>>Children</option>
                        <option <?php if($category=='Events'){ echo 'selected="selected"';} ?>>Events</option>
                        <option <?php if($category=='Sports/Dance'){ echo 'selected="selected"';} ?>>Sports/Dance</option>
                        <option <?php if($category=='Advertising'){ echo 'selected="selected"';} ?>>Advertising</option>
                        <option <?php if($category=='Hotel'){ echo 'selected="selected"';} ?>>Hotel</option>
                        <option <?php if($category=='Wedding'){ echo 'selected="selected"';} ?>>Wedding</option>
                        <option <?php if($category=='Car'){ echo 'selected="selected"';} ?>>Car</option>
                        <option <?php if($category=='Beauty'){ echo 'selected="selected"';} ?>>Beauty</option>
                        <option <?php if($category=='Landscape'){ echo 'selected="selected"';} ?>>Landscape</option>
                        <option <?php if($category=='Editorial'){ echo 'selected="selected"';} ?>>Editorial</option>
                        <option <?php if($category=='Food'){ echo 'selected="selected"';} ?>>Food</option>
                        <option <?php if($category=='Jewellery'){ echo 'selected="selected"';} ?>>Jewellery</option>
                        <option <?php if($category=='Interior/Arch'){ echo 'selected="selected"';} ?>>Interior/Arch</option>
                    </Select>
                            

			
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
                <h2><?php echo $type_title; ?></h2>
                <?php include_once("md-includes/cart_resp.php"); ?>
                <style type="text/css">
                 .cart_content{float: right; margin-top: -40px}
                </style>
               <?php /*?><p>Search Results</p><?php */?>
               <div class=" chosenFilters">Search Results For:  
               <?php if($name!=""){ ?>
               <div class="chosenFilter clearSelectFilter" data-filterid="filterBasedin">Name In: <?php echo $name; ?></div>
               <?php } if($category!=""){ ?>
               <div class="chosenFilter clearSelectFilter" data-filterid="filterBasedin">Category: <?php echo $category; ?></div>
               <?php } ?>
               </div>
                
               <?php
			   //echo MN_url."classes/Models.php";			
			$model_res =$models->searchSpModels($type_title,$name,$category);
			$total_num = $models->paginateSpResult($type_title,$name,$category);
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
						  <input type="hidden" name="name" value="<?php echo $name; ?>"  />
						  <input type="hidden" name="categories" value="<?php echo $category; ?>"  />
						  
					  	</form>
            <?php
			if($model_res->num_rows>0){
			  ?>
                <div class="row">
                <?php
				  while($row=$model_res->fetch_object()){
					  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob(MN_url.image_path.$sub_folder."/".$row->Resource_ID."*.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  $img_path=ltrim($img_path,MN_url);
						  //$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path=MN_url."app/image.php?img=../".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="img-fluid" alt="FLC Models & Talents - '.$type_title.'" />';
						  //var_dump(MN_url.$img_path);
						  if($img_path!="") {
					  ?>
                	<div class="col-3">
               	    	<div class="models-thumb">
                             <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=<?php echo $type_var; ?>"  > 
                             <?php 
						  
							  //$img_code='<div class="blank_cont">&nbsp; </div>';
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
                
                <?php }
				else{
					echo '<div class="title-red" style="font-size:15px; color:red;"> No Results</div>';
				}
				 ?>
                
                  
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