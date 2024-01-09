<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC - CONTACT US </title>
   
</head>

<body>

    
    
    	 <?php include_once("includes/header.php"); ?>
         <?php $cat_res_back=$media_top->getCategory(); $row_cnt=1; ?>
            
    <!-- Page Content -->
    <div class="container inner_content">
		<header class="hero-spacer">
        	<div>
                <?php /*?><a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a><?php */?>
                <?php
					require_once("../classes/Article.php");
					$article= new Article();
					$articles=$article->getArticle(2);
				
					$row=$articles->fetch_object();
				?>
                <div class="main_title"><?php echo $row->article_title ?></div>
            </div>
                        
        </header>
        <!-- Jumbotron Header -->
        <div class="row content-main">
        	    <div class="col-sm-5" style="margin-bottom:15px">
                	<div style="line-height:25px">
                        <b><u>Office Address</u></b><br><br>
                        1501 Concord Tower,<br>
                        Media City, Dubai. <br>
                        PO Box 283795, <br>
                        Phone: +971 4 4548684, <br>
                        Fax: +971 4 4548654 <br>
                        Email: <a href="mailto:talk2us@flcmodels.com" target="_blank" class="contenter">talk2us@flcmodels.com </a>
                        <br><br>
                        <a href="#" onclick="window.open('https://www.facebook.com/FLCMODELSDUBAI', '_system');" >
                            <img src="../image/fb.png">
                        </a>
                        <a href="#" onclick="window.open('http://www.linkedin.com/company/1895404/24200431/product', '_system');" >
                            <img src="../image/lin.png">
                        </a>
                        <a href="#" onclick="window.open('http://www.youtube.com/channel/UCeER1LUHOuCea0bcNOkpfRw', '_system');" >
                            <img src="../image/tube.png">
                        </a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <b><u>Location Map</u></b>
                    <br /><br />
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.1243032446496!2d55.154174115418506!3d25.097653241889983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6b43d7b41a93%3A0xec0aacf6ef4b550c!2sFLC+Models+%26+Talents!5e0!3m2!1sen!2sin!4v1446706212037" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
        
        </div>

       <!-- <hr>-->
		
        <!-- Title -->
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
    <?php /*?></div><?php */?>
</body>

</html>
