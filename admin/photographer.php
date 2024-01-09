<?php
ob_start();
require_once("../config/db.php");
require_once("../classes/Login.php");

$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
	if($_SESSION['user_role']==2 || $_SESSION['user_role']==4){
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - PHOTOGRAPHER</title>
<style type="text/css">
img{ border:none}

.water_mark{ width:170px; height:220px;  font-size:14px;}
img.grayscale {
    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+ */
    filter: gray; /* IE6-9 */
    -webkit-filter: grayscale(100%); /* Chrome 19+ & Safari 6+ */
    -webkit-transition: all .6s ease; /* Fade to color for Chrome and Safari */
    -webkit-backface-visibility: hidden; /* Fix for transition flickering */
}

a.bwWrapper:hover img.grayscale {
    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
    -webkit-filter: grayscale(0%);
}
.content{ min-height:581px; width:79%; margin:0 auto;}
</style>

<link rel="icon" href="../favicon.ico" type="image/x-icon" />
  <!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
 <!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery(".navbar-brand").click(function(){
            jQuery(".navbar-toggle").click();
        })
    })
</script>


<script type="text/javascript">
	function pagin(obj){
		$("#pagin_form").attr("action","photographer.php?page="+obj)
		$("#pagin_form").submit();
	}
</script>
</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="container">
	<div class="punch_cont">
        	<div class="text-left">
               <a href="photographer.php" style="text-decoration:none" ><span class="title-grey">PHOTOGRAPHER &gt;</span></a>
                                <span><?php
					if(isset($_POST['name'])){
						echo "Search Result";
					}
					else{
						echo "Search";
					}
				?></span>
            </div>
        </div>

	<div class="content">
    
    	                 <?php include_once("includes/cart.php"); ?>
                <?php
    				session_start();
					require_once("../classes/Models.php");
					$models = new Models();
					if(isset($_POST['name'])){
							$model_res =$models->searchSpModels('Photographer',$_POST['name'],$_POST['categories']);
							//var_dump($model_res);
							$total_num = $models->paginateSpResult('Photographer',$_POST['name'],$_POST['categories']);
							//var_dump($total_num);
							$k=1;
							$total=$total_num->fetch_object();
							$total_pag= ceil($total->total/$models->limit);
							?>
							<div class="pagination" style="text-align:right; margin-right:3px; margin-bottom:20px">
                            	 <form method="post" action="" id="pagin_form">
                            	<?php
								$i=1;
								$current_page=1;
								if(isset($_REQUEST['page'])){
									$current_page=$_REQUEST['page'];
								}
                                while($i<=$total_pag){
									if($current_page==$i){
										echo '&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$i.'</span>';
									}
									else{
                            			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="pagin('.$i.')">'.$i.'</a>';
									}
									$i++;
								}
								
								$_SESSION['name']=$_POST['name'];
								$_SESSION['categories']=$_POST['categories'];
								$_SESSION['page']=$current_page;
								?>
                                	 <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"  />
                                    
                                    <input type="hidden" name="categories" value="<?php echo $_POST['categories']; ?>"  />
                                    
                                </form>
							</div>
                            <div style="overflow:hidden; width:980px">
                            <?php
                            while($row=$model_res->fetch_object()){
								?>
                       <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=photographer" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="../app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - photographer" />';
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
						///////////////////
					else if(isset($_GET['res_back'])){
						if(isset($_SESSION['name'])){
							$current_page=1;
							if(isset($_REQUEST['page'])){
								$current_page=$_REQUEST['page'];
							}
							else if(isset($_SESSION['page'])){
								$_REQUEST['page']=$_SESSION['page'];
								$current_page=$_SESSION['page'];
							}
							$model_res =$models->searchSpModels('Photographer',$_SESSION['name'],$_SESSION['categories']);
							//var_dump($model_res);
							$total_num = $models->paginateSpResult('Photographer',$_SESSION['name'],$_SESSION['categories']);
							
							$k=1;
							$total=$total_num->fetch_object();
							$total_pag= ceil($total->total/$models->limit);
							?>
							<div class="pagination" style="text-align:right; margin-right:3px; margin-bottom:20px">
                            	 <form method="post" action="" id="pagin_form">
                            	<?php
								$i=1;
								
                                while($i<=$total_pag){
									if($current_page==$i){
										echo '&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$i.'</span>';
									}
									else{
                            			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="pagin('.$i.')">'.$i.'</a>';
									}
									$i++;
								}
								?>
                                	 <input type="hidden" name="name" value="<?php echo $_SESSION['name'] ?>"  />
                                    
                                    <input type="hidden" name="categories" value="<?php echo $_SESSION['categories']; ?>"  />
                                    
                                </form>
							</div>
                            <div style="clear:both; height:1px"></div>
                            <?php
                            while($row=$model_res->fetch_object()){
								?>
                                  <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=photographer" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="../app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - photographer" />';
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
						}

					}
					//////////////////////////////////
					
					else{ ?>
						
           <form method="post" action="">
            <table width="44%" border="0" cellspacing="0" cellpadding="0" style="float:left">
              <tr>
                <td width="34%"><table width="100%" height="92" border="0" cellpadding="0" cellspacing="4">
                
                  <tr>
                    <td colspan="2"><img src="../image/hidden.gif" width="5" height="5" /></td>
                  </tr>
                  <tr>
                    <td width="8%" class="bodyfont">Name:</td>
                    <td width="75%">
                      <input type="text" name="name" class="bodyfont" size="32" />
                    </td>
                  </tr>
                  <tr>
                    <td width="8%" class="bodyfont">Categories:</td>
                    <td width="75%">
                      <select name="categories" class="bodyfont" id="select_cat">
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
                      </select>
                    </td>
                  </tr>
                  
                  
                </table></td>
           
              </tr>
                <tr>
                    <td width="62%"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                     
                      <tr>
                      	<td colspan="2" align="right"> 
                        	<div class="eth_div" style="float:right">
                                <input type="image" src="../image/find-b1.gif" width="41" height="21"  />
                            </div>
                        </td>
                        <td colspan="6" width="65%">&nbsp;
                        	
                        </td>
                      </tr>
                    </table></td>
              </tr>
              
            </table>
            <img src="../image/cam_theme.png"  style="float:left; bottom:0; margin-top:200px; margin-left:0px" width="544"/>
      </form>
                        
					<?php	
						}
				 ?>
    
    
    
    </div>


</div>

<!---------------------------------------------------------------main_content_end------------------------------------------------------------------>

<!-------------------------------------------------------------------footer------------------------------------------------------------------------------------->
<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>
<!-----------------------------------------------------------------------footer---------------------------------------------------------------------------------------->
</body>
</html>
<?php 
	}
	else {
    	header("Location:../login.php");
	}
    
} else {
    header("Location:../login.php");
}
 ?>