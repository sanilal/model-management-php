<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FLC Models & Talents - Contact Us for  Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist Media City, Dubai UAE </title>
    
    <meta name="author" content="www.flcmodels.com/contact.php"/>
    <meta name="Description" content="FLC Models & Talents provide you with a range of local & international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more Dubai , UAE .Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels."/>
    
    <meta name="Keywords" content="Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist "/>
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

        <!-- Jumbotron Header -->
         <header class="hero-spacer" style="margin:15px 0px">
        	<div>
                <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                
                <span class="title-red">
                <?php
				  require_once("classes/Article.php");
				  $article= new Article();
				  $articles=$article->getArticle(2);
			  
				  $row=$articles->fetch_object();
				  echo $row->article_title;
				?>
                </span>
            </div>
        </header>

       <!-- <hr>-->

        <!-- Title -->
        <div class="row content-main">
           
            <div class="col-sm-5" style="margin-bottom:15px">
                <?php echo $row->article_content ?>
            </div>
            <div class="col-sm-7">
                <b><u>Location Map</u></b>
                <a href="image/flc_location_map.jpg" download="flc_location_map.jpg" style="float:right; text-decoration:none" target="_blank">
                	<img src="image/download_icon.png" style="border:none" width="123" height="20" alt="FLC Models & Talents - download map"  />
                </a>
                <br /><br />
             	<img src="image/flc_location_map.jpg" alt="FLC Models & Talents - Location map" style="display:inline" class="about_theme" />
            </div>
                        
        </div>
        
        
    </div>
    
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
