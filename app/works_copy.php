<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC - Media Works </title>
   
</head>

<body>
<style type="text/css">body {padding-top: 140px;}</style>
<?php /*?><div data-role="page" id="page_data"><?php */?>

    
    	 <?php include_once("includes/header.php"); ?>
         <?php $cat_res_back=$media_top->getCategory(); $row_cnt=1; ?>
            
    <!-- Page Content -->
    <div class="container inner_content">

        <!-- Jumbotron Header -->
        <div class="row home-icons">
        <?php while($cat_row=$cat_res_back->fetch_object()){ ?>
        	<div class="col-md-3 col-xs-6 text-center"> 
            	<a href="work.php?cat-id=<?php echo $cat_row->category_id ?>"> <p> 
                <?php if($cat_row->category_name=="Print Campaigns") {?>
                <img src="images/print-campaign.png" />
                <?php } else if($cat_row->category_name=="TVCs & Videos"){ ?>
                <img src="images/tvcs-video.png" />
                <?php } else if($cat_row->category_name=="Catalogue Shoots"){ ?>
                <img src="images/catalogue-shoot.png" />
                <?php } else if($cat_row->category_name=="Fashion Shows"){ ?>
                <img src="images/fashion-show.png" />
                <?php } else if($cat_row->category_name=="Events & Exhibitions"){ ?>
                <img src="images/events.png" />
                <?php } else if($cat_row->category_name=="TVC & Video Production"){ ?>
                <img src="images/tvcs.png" />
                <?php } else if($cat_row->category_name=="Still Production"){ ?>
                <img src="images/stillproduction.png" />
                <?php } else{ ?>
                <img src="images/work-ico.png" /> 
                <?php } ?>
                </p> <p><?php echo $cat_row->category_name ?></p></a>
            </div>
            <?php //if($row_cnt%2==0){ echo '</div><div class="row home-icons">'; }  $row_cnt++;?>
        <?php } ?>
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
