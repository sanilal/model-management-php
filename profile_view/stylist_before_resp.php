<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC STYLIST - Dubai Models | Model Agency Dubai  | FLC Models & Talents</title>

<meta name="Description" content=" FLC Stylist - Model Agency Dubai,FLC Models, FLC Talents, International Models,Casting & Production Agency, Dubai,Cast & crew, Model Management"/>

<meta name="Keywords" content="Dubai Stylist,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Kids models UAE ,Middle east models,Stylist promoters in Dubai, promoters UAE, Product Shoot, Casting Agency, Stylist in Dubai, Promotions in Dubai,Print Campaigns, Make-up artist,portfolio for models in Dubai, photographers in Dubai, photo shoot  in Dubai, make up artist in Dubai, stylist in  Dubai, Cast & Crew in Dubai,Events & Exhibitions"/>

<META NAME="author" CONTENT="FLC MODELS">

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="css/flc.css" rel="stylesheet" type="text/css" />
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
.content{ min-height:581px}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function pagin(obj){
		$("#pagin_form").attr("action","stylist.php?page="+obj)
		$("#pagin_form").submit();
	}
</script>
</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
    	<a href="stylist.php" style="text-decoration:none" ><span class="title-grey">STYLIST &gt;</span></a>
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
                 <?php include_once("includes/cart.php"); ?>
                <?php
    				require_once("classes/Models.php");
					$models = new Models();
					if(isset($_POST['name'])){
							$model_res =$models->searchSpModels('Stylist',$_POST['name'],$_POST['categories']);
							$total_num = $models-> paginateSpResult('Stylist',$_POST['name'],$_POST['categories']);
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
                                	
                                <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"  />
                                <input type="hidden" name="categories" value="<?php echo  $_POST['categories']; ?>"  />
                                    
                                </form>
							</div>
                            <div style="overflow:hidden; width:980px">
                            <?php
                            while($row=$model_res->fetch_object()){
								?>
                                
                                <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=stylist" class="bwWrapper"  >
								<div style=" <?php if($k%5!=0) {echo "margin-right:32px;";} ?>" class="res_thumb_cont">
                                	<div class="water_mark">
                                    	<img src="image/flc_mark.jpg" width="25" class="grayscale" alt="FLC Models & Talents" />
                                    </div>
                          			<?php 
									$sub_folder=$models->getImageFolder($row->Resource_ID);
									$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
									$img_code='<img src="'.$img_path.'" class="grayscale res-thumb" alt="FLC Models & Talents - Stylists" />';
									if(!file_exists($img_path)) {
										$img_code='<div class="blank_cont">&nbsp; </div>';
									}
									?>
										<?php echo $img_code; ?>
                                    
                                    
                                    <div class="name_cont" ><?php echo $row->First_Name; ?></div>
                           		</div>
                               	</a>
                               
                                
								<?php
								if($k%5==0){
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
					
					else{ ?>
						
           <form method="post" action="">
            <table width="44%" border="0" cellspacing="0" cellpadding="0" style="float:left">
              <tr>
                <td width="34%"><table width="100%" height="92" border="0" cellpadding="0" cellspacing="4">
                 
                  
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
                        <option>Hair Stylist</option>
                        <option>Makeup Artist</option>
                        <option>Prop Master</option>
                       <?php /*?> <option>Wardrobe Stylist</option><?php */?>
                       <option>Fashion Stylist</option>
                        <option>Food Stylist</option>
                        <option>Product Stylist</option>
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
                                <input type="image" src="image/find-b1.gif" width="41" height="21"  />
                            </div>
                        </td>
                        <td colspan="6" width="65%">&nbsp;
                        	
                        </td>
                      </tr>
                    </table></td>
              </tr>
              
            </table>
            <img src="image/stylist_theme.png"  style="float:left; bottom:0; margin-left:70px; margin-top:45px" alt="FLC Models & Talents - Sylists" width="450"/>
      </form>		<?php	
						}
				 ?>

    </div>
</div>
<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>
</body>
</html>
