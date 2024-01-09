<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC - ABOUT US </title>
   
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
					$articles=$article->getArticle(1);
				
					$row=$articles->fetch_object();
				?>
                <div class="main_title"><?php echo $row->article_title ?></div>
            </div>
                        
        </header>
        <!-- Jumbotron Header -->
        <div class="row content-main">
        	   <div class="col-sm-7 " style="line-height:25px">
			<?php 
			 echo $row->article_content;
			?>
			
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
