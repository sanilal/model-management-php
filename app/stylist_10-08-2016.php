<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC Models &amp; Talents - Stylist </title>
   
</head>

<body>
    
    <?php /*?><div id="slideshow">
      <img src="../image/stylist_theme.png" class="bgM" /> 
    </div><?php */?>
    	 <?php include_once("includes/header.php"); ?>
            
    <!-- Page Content -->
    <div class="container inner_content">
		<header class="hero-spacer">
        	<?php /*?><div>
                 <a class="text_none" href="stylist.php"><span class="title-grey">STYLIST &gt;</span></a>
                <span class="title-red">
                	<?php
					if(isset($_POST['name'])){
						echo "Search Result";
					}
					else{
						echo "Search";
					}
				?>
                </span>
            </div><?php */?>
             <div class="main_title">
                 STYLIST
            </div>
            <div class="title-grey">
                <?php
                if(isset($_POST['name'])){
                    echo "Search Result";
                }
                else{
                    echo "Search";
                }
            ?>
            </div>
                        
        </header>
        <script type="text/javascript">
			function pagin(obj){
				$("#pagin_form").attr("action","stylist.php?page="+obj)
				$("#pagin_form").submit();
			}
			function pagin2(obj){
				$("#pagin_form2").attr("action","stylist.php?page="+obj)
				$("#pagin_form2").submit();
			}
		</script>
        <!-- Title -->
         <?php
		  require_once("../classes/Models.php");
		  $models = new Models();
		  if(isset($_POST['name'])){
			  ?>
           <div class="row content-main"> 
              <?php	
				  $model_res =$models->searchSpModels('Stylist',$_POST['name'],$_POST['categories']);
					$total_num = $models-> paginateSpResult('Stylist',$_POST['name'],$_POST['categories']);
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
						 <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"  />
                         <input type="hidden" name="categories" value="<?php echo  $_POST['categories']; ?>"  />
						  
					  	</form>
                      </div>
				  </div>
				  <div class="container" style="padding: 0px 10px;">
				  <?php
				  while($row=$model_res->fetch_object()){
					  ?>
					 <div class="col-sm-15 col-xs-4">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=stylist" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - Stylist" />';
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
						   <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"  />
                         <input type="hidden" name="categories" value="<?php echo  $_POST['categories']; ?>"  />
						  
					  	</form>
                      </div>
				  </div> 

          </div>
          <?php
		  }
		  else{ ?>
        <div class="row content-main">   
        	<div class="col-lg-7 col-xs-12">
                <form class="form-horizontal" method="post" action="">
                
                    <div class="form-group">
                        <label for="inputName" class="col-xs-2 col-sm-2 text-left">Name:</label>
                        <div class="col-xs-10 col-sm-5">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
                        </div>
                      
                    </div>
            
                    <div class="form-group">
                         <label for="categories" class="col-xs-2 col-sm-2 text-left">Categories:</label>
                        <div class="col-xs-10 col-sm-5">
                            <Select class="form-control" id="categories" name="categories">
                                <option value="">All</option>
                                <option>Hair Stylist</option>
                                <option>Makeup Artist</option>
                                <option>Prop Master</option>
                                <option>Fashion Stylist</option>
                                <option>Food Stylist</option>
                                <option>Product Stylist</option>
                            </Select>
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
