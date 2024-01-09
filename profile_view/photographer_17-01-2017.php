<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>FLC Production & Model Management - PHOTOGRAPHER - Dubai Models | Model Agency Dubai  | FLC Models & Talents</title>

<meta name="Description" content=" FLC Photographer - Model Agency Dubai,FLC Models, FLC Talents, International Models,Casting & Production Agency, Dubai,Cast & crew, Model Management"/>

<meta name="Keywords" content="Dubai Photographer,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Kids models UAE ,Middle east models,Photographer promoters in Dubai, promoters UAE, Product Shoot, Casting Agency, Stylist in Dubai, Promotions in Dubai,Print Campaigns, Make-up artist,portfolio for models in Dubai, photographers in Dubai, photo shoot  in Dubai, make up artist in Dubai, stylist in  Dubai, Cast & Crew in Dubai,Events & Exhibitions"/>

<META NAME="author" CONTENT="FLC MODELS">
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
               <a class="text_none" href="photographer.php"><span class="title-grey">PHOTOGRAPHER &gt;</span></a>
                <span>
                <?php
					if(isset($_POST['name'])){
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
      <?php /*?>   <header class="hero-spacer">
        	<div>
                <a class="text_none" href="photographer.php"><span class="title-grey">PHOTOGRAPHER &gt;</span></a>
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
                
                <?php include_once("includes/cart_resp.php"); ?>
            </div>
                        
        </header><?php */?>

       <!-- <hr>-->
		<script type="text/javascript">
			function pagin(obj){
				$("#pagin_form").attr("action","photographer.php?page="+obj)
				$("#pagin_form").submit();
			}
		</script>
        <!-- Title -->
         <?php
		  require_once("classes/Models.php");
		  $models = new Models();
		   if(isset($_POST['name'])){
			  ?>
           <div class="row content-main"> 
           <?php include_once("includes/cart_resp.php"); ?>
              <?php	
				  $model_res =$models->searchSpModels('Photographer',$_POST['name'],$_POST['categories']);
					$total_num = $models-> paginateSpResult('Photographer',$_POST['name'],$_POST['categories']);
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
				  <div style="padding: 0px 10px; ">
				  <?php
				  while($row=$model_res->fetch_object()){
					  ?>
					 <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=photographer" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="../app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - Photographer" />';
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
				 
          </div>
          <?php
		  }
		  else{ ?>
        <div class="row content-main">   
        <?php include_once("includes/cart_resp.php"); ?>
        	<div class="col-sm-6">
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
                        <label for="categories" class="col-xs-2 col-sm-2 text-left">Categories:</label>
                        <div class="col-xs-10 col-sm-5">
                            <Select class="form-control" id="categories" name="categories">
                               <option value="">All</option>
                                <option>International</option>
                                <option>Lifestyle</option>
                                <option>Portfolio</option>
                                <option>Fashion</option>
                                <option>Product  </option>
                                <option>Children </option>
                                <option>Events</option>
                                <option>Sports/Dance </option>
                                <option>Advertising</option>
                                <option>Hotel</option>
                                <option>Wedding</option>
                                <option>Car</option>
                                <option>Beauty</option>
                                <option>Landscape</option>
                                <option>Editorial</option>
                                <option>Food</option>
                                <option>Jewellery</option>
                                <option>Interior/Arch</option>
                            </Select>
                        </div>
                        <div class="col-sm-5 space_search">
                        	&nbsp;
                        </div>
                    </div>                    
            
                    
            
                    <div class="form-group ">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input type="image" src="images/find-b1.gif" />
                        </div>
                    </div>
            
                </form>

        	</div>
            <div class="col-sm-6">
            	 <img src="image/cam_theme.png" alt="FLC Models & Talents" title="Photographers" style="width:98%" />
            </div>
        </div>
       <?php } ?>
    </div>
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
