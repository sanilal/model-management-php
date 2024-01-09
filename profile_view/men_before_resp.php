<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Men Models - Dubai Models - Model Agency Dubai  - Casting & Production Agency | FLC Models</title>

<meta name="Description" content="Men Models - Men Model Agency Dubai,FLC Models, FLC Talents, International Models, Casting & Production Agency,Cast & crew, Fashion Shows"/>

<meta name="Keywords" lang="en" content=" Men Models, Dubai models,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Middle east models,International Models,Casting & Production Agency, female models in Dubai,TVC, Video Shooting,Fashion Shows, Product Shoot, Casting Agency, Model hostesses in Dubai, Promotions in Dubai, Dubai modeling agency kids, Print Campaigns, kids models in Dubai, portfolio for models in Dubai, photographers in Dubai, stylist in  Dubai, Cast & Crew in Dubai,Events & Exhibitions"/>

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
		$("#pagin_form").attr("action","model.php?page="+obj)
		$("#pagin_form").submit();
	}

</script>
</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
    	<?php /*?><a href="model.php" style="text-decoration:none" ><span class="title-grey">MODELS &gt;</span></a>
                <span class="title-red">
            	<?php
					if(isset($_POST['gender'])){
						echo "Search Result";
					}
					else{
						echo "Search";
					}
				?>
				
            	</span><?php */
				$mentitle= "FLC MEN MODELS";
				?>
                 <?php include_once("includes/cart.php"); ?>
                <?php
    				require_once("classes/Models.php");
					$models = new Models();
					
						$etnicity=NULL;
						
						$ethin_str=NULL;
						
						$age=NULL;
						
						//
						
						
							
							//$model_res = $models->getModels('Model',NULL,$_REQUEST['gend']);
							$model_res_inter =$models->searchHost('Model','Male',NULL,NULL,"",NULL,"Internationals");
							//$total_num = $models-> paginateResult('Model',$_POST['gender'],$age,$etnicity,$_POST['name']);
							
							$k=1;
							//$total=$total_num->fetch_object();
							//$total_pag= ceil($total->total/$models->limit);
							?>
						<?php /*?>	<div class="pagination" style="text-align:right; margin-right:3px; margin-bottom:20px">
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
                                       <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>"  />
                                    <?php if($ethin_str!=NULL){ ?>
                                    <input type="hidden" name="ethnicity" value="<?php echo $ethin_str; ?>"  />
                                    <?php }?>
                                    
                                </form>
							</div><?php */?>
                            <?php
							if($model_res_inter->num_rows>0){
							
							?>
                            <span class="title-grey">INTERNATIONAL MODELS</span>
                            <div style="overflow:hidden; width:980px">
                            <?php
                            while($row=$model_res_inter->fetch_object()){
								?>
                                
                                <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
								<div style=" <?php if($k%5!=0) {echo "margin-right:32px;";} ?>" class="res_thumb_cont">
                                	<div class="water_mark">
                                    	<img src="image/flc_mark.jpg" width="25" class="grayscale" title="FLC MEN MODELS"  alt="FLC Models & Talents" />
                                    </div>
                          			<?php 
									$sub_folder=$models->getImageFolder($row->Resource_ID);
									$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
									$img_code='<img src="'.image_path.$sub_folder.'/'.$row->Resource_ID.'_01.jpeg" class="grayscale res-thumb" title='.$mentitle.' alt=" alt="FLC MEN MODELS & TALENTS - DUBAI" />';
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
                            <?php } ?>
                             <h2 class="title-grey">MODELS</h2>
                            <div style="overflow:hidden; width:980px">
                            <?php
							$model_res=$models->searchHost('Model','Male',NULL,NULL,"",NULL,"NOTIN");
							
							$k=1;
                            while($row=$model_res->fetch_object()){
								?>
                                
                                <a href="profile.php?res_id=<?php echo $row->Resource_ID; ?>&type=model" class="bwWrapper"  >
								<div style=" <?php if($k%5!=0) {echo "margin-right:32px;";} ?>" class="res_thumb_cont">
                                	<div class="water_mark">
                                    	<img src="image/flc_mark.jpg" width="25" class="grayscale" alt="FLC Models & Talents" />
                                    </div>
                          			<?php 
									$sub_folder=$models->getImageFolder($row->Resource_ID);
									$img_path=image_path.$sub_folder."/".$row->Resource_ID."_01.jpeg";
									$img_code='<img src="'.image_path.$sub_folder.'/'.$row->Resource_ID.'_01.jpeg" class="grayscale res-thumb" alt="FLC MEN MODELS & TALENTS - DUBAI" />';
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
			
				 ?>
     </div>
</div>

<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>

</body>
</html>
