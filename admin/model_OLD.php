<?php
require_once("../config/db.php");
require_once("../classes/Login.php");


$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
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
</style>
<link href="../css/flc1.css" rel="stylesheet" type="text/css" />
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
</script>
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <?php
		include_once("includes/left.php");
	 ?>
    </td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%" height="587" bgcolor="#FFFFFF"><img src="../image/hidden.gif" width="34" height="611" /></td>
        <td width="99%" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="../image/hidden.gif" width="946" height="52" /></td>
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
					require_once("../classes/Models.php");
					$models = new Models();
					if(isset($_POST['gender'])){
						$age=NULL;
						if($_POST['age']!=""){
							$age=$_POST['age'];
						}
						//
						if($_REQUEST['gender']!=""){
							if($_REQUEST['gender']=="Kids"){
								$model_res = $models->getKidModels($_POST['ethnicity']);
							}
							else{
								//$model_res = $models->getModels('Model',NULL,$_REQUEST['gend']);
								$model_res =$models->searchModels('Model',$_POST['gender'],$age,$_POST['ethnicity']);
							}
							$k=1;
							while($row=$model_res->fetch_object()){
								?>
                                <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" >
								<div style="float:left; width:95px; margin-right:6px; margin-bottom:5px">
                          			<?php 
									$img_path="../../FLC_Resource_Images/".$row->Resource_ID."_01.jpeg";
									if(file_exists($img_path)) {
									?>
										<img src="<?php echo $img_path; ?>" width="95" height="123" />
                                    <?php } 
										else{
											$img_path="../image/model_thumb.jpg";
									?>	
                                    	<img src="<?php echo $img_path; ?>" width="95" height="123" />
                                    <?php } ?>
                                    
                                    <div style="float:left; width:95px;font-family: Tahoma,Geneva,sans-serif; font-size: 10px; text-align: center; color:#666" ><b><?php echo $row->First_Name; ?></b></div>
								</div>
                                </a>
								<?php
								if($k%9==0){
									echo "<br/>";
								}
								$k++;
                            }
							
						}
					}
					
					else{ ?>
						
           <form method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="34%"><table width="100%" height="92" border="0" cellpadding="0" cellspacing="4">
                  <tr>
                    <td colspan="2"><img src="../image/find-title.jpg" width="124" height="22" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="../image/hidden.gif" width="5" height="5" /></td>
                  </tr>
                  <tr>
                    <td width="25%" class="bodyfont">Gender:</td>
                    <td width="75%"><label for="select"></label>
                      <select name="gender" class="bodyfont" id="select_gender">
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Kids">Kids</option>
                      </select>
                      </td>
                  </tr>
                  <tr>
                    <td height="20" class="bodyfont">Age:</td>
                    <td>
                    	<select name="age" class="bodyfont" id="select_age">
                        	<option value="">All</option>
                      <?php
							$gnd_res = $models->getallAge('Model');
							while($row=$gnd_res->fetch_object()){
									
						?>
                        	<option value="<?php echo $row->Age; ?>"><?php echo $row->Age; ?></option>
                        <?php 	
							} 
						?>
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
                            <div style="height:55px; overflow:auto">
                        <?php
                                
                                $gnd_res = $models->getallEthnicity('Model');
                                $k=1;
                                while($row=$gnd_res->fetch_object()){
                                    
                                    if($row->Ethnicity!=""){
                            ?>
                                <div class="eth_div">
                             
                                        <input type="checkbox" value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  />
                                      
                                        <label for="check_<?php echo $row->Ethnicity; ?>" style="float: right; width: 80px; overflow: hidden;"><?php echo $row->Ethnicity; ?></label>
                                </div>
                                    
                            <?php 	
                                    if($k%3==0){
                                        echo "<br/>";
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
                                <input type="image" src="../image/find-b1.gif" width="41" height="21"  />
                            </div>
                        </td>
                        <td colspan="6" width="65%">&nbsp;
                        	
                        </td>
                      </tr>
                    </table></td>
                    </tr>
              
            </table>
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
        <td colspan="2">
        	<?php include_once("includes/bottom.php"); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#333333"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" height="32"><img src="../image/bottom-bit.jpg" width="10" height="32" /></td>
            <td width="99%" class="bodyfont">&copy;2013 flcmodels.com | Privacy Policy</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
}
else{
	include("views/not_logged_in.php");
}
 ?>