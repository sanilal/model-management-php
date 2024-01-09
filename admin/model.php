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
<title>FLC</title>
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
		$("#pagin_form").attr("action","model.php?page="+obj)
		$("#pagin_form").submit();
	}
</script>
</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="container">
	<div class="punch_cont">
        	<div class="text-left">
                <a class="text_none" href="model.php"><span class="title-grey">MODELS &gt;</span></a>
                                <span><?php
					if(isset($_POST['gender'])){
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
					if(isset($_POST['gender'])){
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
							
							//$model_res = $models->getModels('Model',NULL,$_REQUEST['gend']);
							//$model_res =$models->searchModels('Model',$_POST['gender'],$age,$etnicity,$_POST['name']);
							//$total_num = $models-> paginateResult('Model',$_POST['gender'],$age,$etnicity,$_POST['name']);
							$model_res_inter =$models->searchHost('Model',$_POST['gender'],$age,$etnicity,$_POST['name'],NULL,"Internationals");
							
							$_SESSION['gender']=$_POST['gender'];
							$_SESSION['age']=$_POST['age'];
							$_SESSION['name']=$_POST['name'];
							$_SESSION['ethnicity']=$ethin_str;
							
							$k=1;
							
							?>
							  <?php
							if($model_res_inter->num_rows>0){
							
							?>
                            <br />
                            <div style="clear:both"><span class="title-grey">INTERNATIONAL MODELS</span></div>
                            <br />
                            <div class="row" style="padding-bottom:20px">
                            <div style="padding: 0px;">
                            <?php
                            while($row=$model_res_inter->fetch_object()){
								if(strpos($row->Resource_Type, 'Plus Size')===false){
								?>
                                
                                <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="..//app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - casts" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0; display:none"> 
								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div> 
                                
								<?php
								$k++;
                            	}
							}
							?>
                            </div>  
                            
                            
                            <?php
							}
							?>
                            <br />
                            <div style="clear:both"><span class="title-grey">MODELS</span> </div>
                            <br />
                            <div style="overflow:hidden; width:980px">
                            <?php
							$k=1;
							$model_res =$models->searchHost('Model',$_POST['gender'],$age,$etnicity,$_POST['name'],NULL,"NOTIN");
                            while($row=$model_res->fetch_object()){
								if(strpos($row->Resource_Type, 'Plus Size')===false){
								?>
                                
                                     <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="..//app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - casts" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0; display:none"> 
								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div> 
                               
                                
								<?php
								
								$k++;
                            }
							}
							if($k==1){
								echo '<div class="title-red" style="font-size:15px"> No Results</div>';
							}
							
							?>
                            </div>  
						<?php
                        }
						
                    }
						///////////////////
					else if(isset($_GET['res_back'])){
						$etnicity=NULL;
						if(isset($_SESSION['ethnicity'])){
							if(is_array($_SESSION['ethnicity'])){
								$etnicity=$_SESSION['ethnicity'];
							}
							else{
								$etnicity=explode(",",$_SESSION['ethnicity']);
							}
						}
						$ethin_str=NULL;
						if($etnicity!=NULL){ $ethin_str=implode(",",$etnicity); }
						$age=NULL;
						if($_SESSION['age']!=""){
							$age=$_SESSION['age'];
						}
						//
						if($_SESSION['gender']!=""){
							
							
								//$model_res = $models->getModels('Model',NULL,$_REQUEST['gend']);
								$model_res_inter =$models->searchHost('Model',$_SESSION['gender'],$age,$etnicity,$_SESSION['name'],NULL,"Internationals");
								
							
							$k=1;
							
							?>
							
                             <?php
							if($model_res_inter->num_rows>0){
							
							?>
                            <br />
                            <div style="clear:both"> <span class="title-grey">INTERNATIONAL MODELS</span> </div>
                            <br />
                            <div style="overflow:hidden; width:980px">
							<?php
                            while($row=$model_res_inter->fetch_object()){
								if(strpos($row->Resource_Type, 'Plus Size')===false){
								?>
                                     <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="..//app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - casts" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0; display:none"> 
								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div> 
								<?php
								
								$k++;
                            	}
							}
								?>
							</div>
                            <?php
                            }
							?>
                            <br />
                            <div style="clear:both"> <span class="title-grey">MODELS</span> </div>
                            <br />
                            <div style="overflow:hidden; width:980px">
                            <?php
							$k=1;
							$model_res =$models->searchHost('Model',$_SESSION['gender'],$age,$etnicity,$_SESSION['name'],NULL,"NOTIN");
							 while($row=$model_res->fetch_object()){
								 if(strpos($row->Resource_Type, 'Plus Size')===false){
								?>
                                     <div class="col-sm-15 col-xs-6">
					  	<a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
						  
						  <?php 
						  $sub_folder=$models->getImageFolder($row->Resource_ID);
						  $test_path=glob("../".image_path.$sub_folder."/".$row->Resource_ID."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
						  $img_path=$test_path[0];
						  //$img_path="../".image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
						  $opt_img_path="..//app/image.php?img=".$img_path;
						  $img_code='<img src="'.$opt_img_path.'" class="grayscale img-responsive" alt="FLC Models & Talents - casts" />';
						  if(!file_exists($img_path)) {
							  $img_code='<div class="blank_cont">&nbsp; </div>';
						  }
						  ?>
							  <?php echo $img_code; ?>
						  
						  
						<div class="absl_div"> 
                        	<div class="absl_name">
                            	<img width="25" alt="FLC Models &amp; Talents" class="grayscale" src="../images/flc_mark.jpg" style=" position:absolute; left:0; bottom:0; display:none"> 
								<?php echo $row->First_Name; ?>  
                            </div>
                    	</div>
					  	</a>
					</div> 
								<?php
								
								$k++;
                            	}
							 }
							if($k==1){
								echo '<div class="title-red" style="font-size:15px"> No Results</div>';
							}
							?>
						</div>
					<?php
                    	}

					}
					//////////////////////////////////
					
					else{ ?>
						
           <form method="post" action="">
            <table width="44%" border="0" cellspacing="0" cellpadding="0" style="float:left">
              <tr>
                <td width="34%"><table width="100%" height="92" border="0" cellpadding="0" cellspacing="4">
                  <tr>
                    <td colspan="2"><img src="../image/find-title.jpg" width="124" height="22" /></td>
                  </tr>
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
                    <td width="8%" class="bodyfont">Gender:</td>
                    <td width="75%">
                      <select name="gender" class="bodyfont" id="select_gender">
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                      </select>
                      </td>
                  </tr>
                  <tr>
                    <td height="20" class="bodyfont">Age:</td>
                    <td>
              
                    	<select name="age" class="bodyfont" id="select_age">
                        	<option value="">All</option>
                            <option value="20 AND 25">20 - 25</option>
                            <option value="26 AND 30">26 - 30</option>
                            <option value="31 AND 35">31 - 35</option>
                            <option value="36 AND 40">36 - 40</option>
                            <option value="41 AND 45">41 - 45</option>
                            <option value="46 AND 50">46 - 50</option>
                            <option value="51 AND 100">Above 50</option>
                    	</select>
                    </td>
                  </tr>
                </table></td>
           
                </tr>
                <tr>
                    <td width="62%"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                      <tr>
                        <td colspan="8" class="bodyfont">Ethnicity:</td>         
                     </tr>
                      <tr>
                        <td colspan="8"><img src="../image/hidden.gif" width="5" height="5" /></td>
                      </tr>
                      <tr>
                        <td width="100%" colspan="8">
                        	<table>
                            	<tr>
                            
                        <?php
                                
                                $gnd_res = $models->getallEthnicity('Model');
                                $k=1;
                                while($row=$gnd_res->fetch_object()){
                                    

                                    if($row->Ethnicity!=""){
                            ?>
                                <td>
                             
                                        <input type="checkbox" value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  />&nbsp;
                                      
                                        <label for="check_<?php echo $row->Ethnicity; ?>" ><?php echo $row->Ethnicity; ?></label>
                                </td>
                                    
                            <?php 	
                                    if($k%3==0){
                                        echo "</tr><tr>";
                                    }
                                    $k++;
                                    } 
                                } 
                            ?>
                            	</tr>
                            </table>
                        </td>
                      </tr>
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
            <img src="../image/model_search.png"  style="float:right; bottom:0" width="480"/>
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