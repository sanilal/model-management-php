<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models</title>
<style type="text/css">
body {
	background-color: #E1E1E1;
}
img{ border:none}
#pagin_form > a { color:#666666; text-decoration:none}
#pagin_form > span{ color:#E7040D}
.water_mark{ width:130px; height:165px; font-size:14px;}
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
</style>
<link href="css/flc1.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$("#select_gender").change(function(){
			if($(this).val()=="Kids"){
				$("#select_age").find("option").hide();
				$("#select_age").val('');
				$("#select_age option[value='']").show();
			}
			else{
				$("#select_age").find("option").show();
			}
		})
	})
	function pagin(obj){
		$("#pagin_form").attr("action","model.php?page="+obj)
		$("#pagin_form").submit();
	}
</script>
<?php /*?><script src="js/jquery.blackandwhite.js"></script>
<script type="text/javascript">
	$(window).load(function(){
		$('.bwWrapper').BlackAndWhite({
			hoverEffect : true, // default true
			// set the path to BnWWorker.js for a superfast implementation
			webworkerPath : false,
			// for the images with a fluid width and height 
			responsive:true,
			// to invert the hover effect
			invertHoverEffect: false,
			// this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
			intensity:1,
			speed: { //this property could also be just speed: value for both fadeIn and fadeOut
				fadeIn: 200, // 200ms for fadeIn animations
				fadeOut: 800 // 800ms for fadeOut animations
			},
			onImageReady:function(img) {
				// this callback gets executed anytime an image is converted
			}
		});
	});
</script><?php */?>
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <?php
		include_once("includes/left.php");
	 ?>
    </td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
    	<tr>
            <td width="100%" valign="top" bgcolor="#000000" colspan="2" height="26">
                 <?php
                    include_once("includes/top.php");
                 ?>
            </td>
        </tr>
      <tr>
        <td width="1%" height="587" bgcolor="#FFFFFF"><img src="image/hidden.gif" width="34" height="611" /></td>
        <td width="99%" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="image/hidden.gif" width="946" height="52" /></td>
          </tr>
          <tr>
            <td>
            	<a href="model.php" style="text-decoration:none" ><span class="title-grey">MODELS &gt;</span></a>
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
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
            	<?php
					require_once("classes/Models.php");
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
							if($_REQUEST['gender']=="Kids"){
								$model_res = $models->getKidModels($etnicity);
							}
							else{
								//$model_res = $models->getModels('Model',NULL,$_REQUEST['gend']);
								$model_res =$models->searchModels('Model',$_POST['gender'],$age,$etnicity,$_POST['name']);
								$total_num = $models-> paginateResult('Model',$_POST['gender'],$age,$etnicity,$_POST['name']);
							}
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
								?>
                                	<input type="hidden" name="gender" value="<?php echo $_POST['gender'] ?>"  />
                                    <input type="hidden" name="age" value="<?php echo $_POST['age'] ?>"  />
                                    <?php if($ethin_str!=NULL){ ?>
                                    <input type="hidden" name="ethnicity" value="<?php echo $ethin_str; ?>"  />
                                    <?php }?>
                                    
                                </form>
							</div>
                            <div style="overflow:hidden; width:954px">
                            <?php
                            while($row=$model_res->fetch_object()){
								?>
                                
                                <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
								<div style=" float:left;width:134px; <?php if($k%6!=0) {echo "margin-right:30px;";} ?> margin-bottom:20px">
                                	<div class="water_mark">
                                    	<img src="image/flc_mark.jpg" width="25" class="grayscale" />
                                    </div>
                          			<?php 
									$sub_folder=$models->getImageFolder($row->Resource_ID);
									$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
									if(!file_exists($img_path)) {
										$img_path="image/model_thumb.jpg";
									}
									?>
										<img src="<?php echo $img_path; ?>" width="130" height="165" class="grayscale" />
                                    
                                    
                                    <div style="float:left; width:124px; text-align: center; color:#666; margin-top:4px; font-size:12px" ><?php echo $row->First_Name; ?></div>
                               		</div>
                               	</a>
                               
                                
								<?php
								if($k%6==0){
									echo "<br/>";
								}
								$k++;
                            }
							if($k==1){
								echo '<div class="title-red" style="font-size:15px"> No Results</div>';
							}
							
							?>
                            </div>   
                            <?php
						}
						
                    }
					
					else{ ?>
						
           <form method="post" action="">
            <table width="44%" border="0" cellspacing="0" cellpadding="0" style="float:left">
              <tr>
                <td width="34%"><table width="100%" height="92" border="0" cellpadding="0" cellspacing="4">
                  <tr>
                    <td colspan="2"><img src="image/find-title.jpg" width="124" height="22" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="image/hidden.gif" width="5" height="5" /></td>
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
                   <?php /*?> <?php
						$k=0;
						$numbers=array();
						$gnd_res = $models->getallAge('Model');
						while($row=$gnd_res->fetch_object()){
							$numbers[$k]=$row->Age;
							$k++;
						}
						//var_dump($numbers);
						$x=0;
						$output = array();
						foreach($numbers as $k=>$n){
							if(isset($numbers[$k+1]) && $numbers[$k+1]==$n+5){
								$output[$x][]=$n;
							}elseif(isset($output[$x][count($output[$x])-1]) && $output[$x][count($output[$x])-1]+1==$n){
								$output[$x][]=$n;
							}else{
								$x++;
								$output[$x][] = $n;
								$x++;
							}
						}
						//var_dump($output);
					?><?php */?>
                    	<select name="age" class="bodyfont" id="select_age">
                        	<option value="">All</option>
                            <option value="15 AND 20">15 - 20</option>
                            <option value="21 AND 25">21 - 25</option>
                            <option value="26 AND 30">26 - 30</option>
                            <option value="31 AND 35">31 - 35</option>
                            <option value="36 AND 40">36 - 40</option>
                            <option value="41 AND 50">41 - 50</option>
                            <option value="51 AND 100">Above 50</option>
                     <?php /*?> <?php
							$gnd_res = $models->getallAge('Model');
							while($row=$gnd_res->fetch_object()){
									
						?>
                        	<option value="<?php echo $row->Age; ?>"><?php echo $row->Age; ?></option>
                        <?php 	
							} 
						?><?php */?>
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
                        <td colspan="8"><img src="image/hidden.gif" width="5" height="5" /></td>
                      </tr>
                      <tr>
                        <td width="100%" colspan="8">
                            <div style="min-height:55px; overflow:auto">
                        <?php
                                
                                $gnd_res = $models->getallEthnicity('Model');
                                $k=1;
                                while($row=$gnd_res->fetch_object()){
                                    
                                    if($row->Ethnicity!=""){
                            ?>
                                <div class="eth_div">
                             
                                        <input type="checkbox" value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  />
                                      
                                        <label for="check_<?php echo $row->Ethnicity; ?>" style="float: right; min-width: 100px; overflow: hidden;"><?php echo $row->Ethnicity; ?></label>
                                </div>
                                    
                            <?php 	
                                    if($k%3==0){
                                        echo "<br/><br/>";
                                    }
                                    $k++;
                                    } 
                                } 
                            ?>
                            </div>
                        </td>
                      </tr>
                      <tr>
                      	<td colspan="2" align="right"> 
                        	<div class="eth_div" style="float:right">
                                <input type="image" src="image/find-b1.gif" width="41" height="21"  />
                            </div>
                        </td>
                        <td colspan="6" width="65%">&nbsp;
                        	
                        </td>
                      </tr>
                    </table></td>
                    </tr>
              
            </table>
            <img src="image/model_search.png"  style="float:right;" width="512"/>
            </form>
                        
					<?php	
						}
				 ?>
           
            
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" >
        	<?php include_once("includes/bottom.php"); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" height="32"><?php /*?><img src="image/bottom-bit.jpg" width="10" height="32" /><?php */?></td>
            <td width="99%" class="bodyfont">&copy;2013 flcmodels.com | Privacy Policy
            <div style="float:right; margin-right:20px" class="bodyfont">
            	Powered by: <a href="http://iconceptme.com/" target="_blank" class="iconcept_a">iConcept LLC</a>
            </div>
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
