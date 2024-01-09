<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>About FLC Models - Dubai Models - Model Agency Dubai  - Casting & Production Agency | FLC Models</title>

<meta name="Description" content="Models - Model Agency Dubai,FLC Models, FLC Talents, International Models, Casting & Production Agency,Cast & crew, Fashion Shows"/>

<meta name="Keywords" lang="en" content=" Models, Dubai models,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Middle east models,International Models,Casting & Production Agency, Talent Management,Fashion Show,Shoot Coordination,Print Shoot,Line Production,TV Commercials,Location Permissions,
Artists & Entertainers,Photographers,Hair Stylist,Wardrobe stylist,Make-up artist,Food Stylist,Portfolios,,Editorial shoot,Screen test,Actor's in Dubai,Actresses in Dubai"/>

<META NAME="author" CONTENT="FLC MODELS">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="cache-control" content="no-cache" />

<link href="css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.content{ min-height:581px; font-size:13px}
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
							$articles=$article->getArticle(1);
						
							$row=$articles->fetch_object();
				?>
            	<a href="index.php" class="text_none" ><span class="title-grey">HOME &gt;</span></a>
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
                            
              <div style=" float:left; width:550px; text-align:justify" >
                  <?php echo $row->article_content ?>
              </div>
               <div class="devi"><img name="" src="image/devi.png" width="11" height="402" title="FLC MODELS" alt="FLC MODELS | Dubai Modeling Agency" /></div>
              <div style="float:right; width:400px">
              	<img src="image/about_us_theme.png" title="FLC MODELS" width="400" alt="FLC MODELS | Dubai Modeling Agency"  />
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
