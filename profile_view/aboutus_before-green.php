<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLC - About Us , UAE Modeling Agency , Dubai Modeling Agency , Model Management Dubai, Still production, line production, UAE Casting Agency , UAE Talent Management , Fashion Show , TV Commercials, Models Coordination Talent Management, Print Ad Production, TV Commercials, Fashion Shows, Line Production, Editorials, Casting sessions, Portfolio Sessions, Screen Tests, Editorials,  Actors, actresses casting, featured extras and extras, Stylists – Make Up, Hair, Wardrobe, Fashion and Food,    Location Management and Permissions in Dubai UAE.
</title>
<meta name="author" content="www.flcmodels.com/aboutus.php"/>

<meta name="Description" content="FLC Models & Talents provide you with a range of local & international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more Dubai , UAE .Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Still production, line production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels."/>


<meta name="Keywords" content="Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Still production, line production, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist "/>

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
                <?php
					require_once("classes/Article.php");
					$article= new Article();
					$articles=$article->getArticle(1);
				
					$row=$articles->fetch_object();
				?>
                <span class="title-red"><?php echo $row->article_title ?></span>
            </div>
        </header>

       <!-- <hr>-->

        <!-- Title -->
        <div class="row content-main">
            <!--<div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>-->
            <div class="col-sm-7 ">
			<?php 
			 echo $row->article_content;
			?>
			<?php /*
            	<div style=" text-align: justify; ">We at FLC Models &amp; Talents provide you with a range of local &amp; international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more. You can view them category wise - age, height, ethnicity, experience and capabilities to bring you the right talent according to your specifications. With a wealth of experience in delivering results above clients expectation FLC strives to be the partner of choice for all fashion related events, promotional, photographic and communication campaigns.
                </div>
               	<div>
                	<div style="text-align: justify;">    	
                    	<span style="font-size: 12px; line-height: 20px;"><br></span>   
                    </div>
                    <div>
                    	<b>Our Services:</b> 
                        <ul class="about_ul">
                        	<li>  Models  Coordination </li>
                            <li>  Talent  Management </li>  
                            <li>  Print Ad  Production </li>         
                            <li>  TV  Commercials </li>          
                            <li>  Fashion  Shows </li>
                            <li>Line Production</li>
                            <li>Editorials</li>          
                            <li>  Casting  sessions </li>      
                            <li>  Portfolio  Sessions </li>    
                            <li>  Screen  Tests </li>     
                            <li>  Editorials </li>     
                            <li>  Actors,  actresses casting, featured extras and extras </li>   
                            <li>  Stylists &ndash;  Make Up, Hair, Wardrobe, Fashion and Food </li>     
                            <li>  Location Management and Permissions</li>  
                        </ul>
                    </div>
            	</div>
				*/ ?>				
                
            </div>
            
            <div class="col-sm-5 right-about">
            	<img  alt="FLC MODELS | Dubai Modeling Agency" title="FLC MODELS" src="images/devi.png" class="about_devider"  />
            	<img  alt="FLC MODELS | Dubai Modeling Agency" title="FLC MODELS" src="images/about_us_theme.png"  style="display:inline" class="about_theme" />
                
            </div>
            
        </div>
        
        
    </div>
    
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
