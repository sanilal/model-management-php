<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONTACT FLC MODELS - Dubai Models - Model Agency Dubai  - Casting & Production Agency | FLC Models</title>

<meta name="Description" content=" FLC MODELS - Model Agency Dubai,FLC Models, FLC Talents, International Models, Casting & Production Agency,Cast & crew, Fashion Shows"/>

<meta name="Keywords" lang="en" content=" Models, Dubai models,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Middle east models,International Models,Casting & Production Agency, female models in Dubai,TVC, Video Shooting,Fashion Shows, Product Shoot, Casting Agency, Model hostesses in Dubai, Promotions in Dubai, Dubai modeling agency kids, Print Campaigns, kids models in Dubai, portfolio for models in Dubai, photographers in Dubai, stylist in  Dubai, Cast & Crew in Dubai,Events & Exhibitions"/>

<META NAME="author" CONTENT="FLC MODELS">

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.content{ min-height:591px}
.contenter a{ text-decoration:none}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>

</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td>
            	<?php
							require_once("classes/Article.php");
							$article= new Article();
							$articles=$article->getArticle(2);
						
							$row=$articles->fetch_object();
				?>
            	<a href="index.php" style="text-decoration:none" ><span class="title-grey">HOME &gt;</span></a>
                <span class="title-red">
            		<?php echo $row->article_title ?>
            	</span>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
                            
              <div class="contenter" style="float:left" >
                  <?php echo $row->article_content ?>
              </div>
             <div style="float:left; margin-left:110px" class="contenter">
             	<b><u>Location Map</u></b>
                <a href="image/flc_location_map.jpg" download="flc_location_map.jpg" style="float:right; text-decoration:none">
                	<img src="image/download_icon.png" style="border:none" width="123" height="20" alt="FLC Models & Talents - download map"  />
                </a>
                <br /><br />
             	<img width="504" src="image/flc_location_map.jpg" alt="FLC Models & Talents - Location map"  />
             </div>                
            </td>
          </tr>
        </table>
    
    </div>


</div>

<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>

</body>
</html>
