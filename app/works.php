<!DOCTYPE html>
<html lang="en">

<head>
    
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC - Media Works </title>
   
</head>

<body>
<?php include_once("includes/header.php"); ?>
<?php $cat_res_back=$media_top->getCategory(); $row_cnt=$cat_res_back->num_rows;?>
<style type="text/css">
html,body,.container
{
    height:100%;
}
body{ padding-top:76px;}
.container
{
    display:table;
    width: 100%;
    /*margin-top: -50px;
    padding: 50px 0 0 0; */
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.row.home-icons
{
    height: 100%;
    display: table-row;
}

.home-icons .col-xs-6
{
    display: table-cell; height:33.33%; width:49.4%; padding:0; background: rgba(162,162,162,0.50); margin-bottom:4px;
}
.inner_content{ padding: 50px 20px 159px 20px;}
.inner_content{background-image:url("images/bgbl.jpg");
    background-repeat: no-repeat;
    background-size:cover;}
.greylay{ background: rgba(120,120,120,0.50) !important;}
.home-icons .col-xs-6 a{  bottom:0; width:100%; color:#FFFEFE; font-size:14px; overflow:hidden;  display:block; height:100%; line-height:150px; }
.home-icons .col-xs-6 a p{ display:inline-block; line-height:normal; vertical-align:middle}
</style>
<?php /*?><div data-role="page" id="page_data"><?php */?>

    
    	 
            
    <!-- Page Content -->
    <div class="container inner_content">

        <!-- Jumbotron Header -->
        <div class="row home-icons">
        <?php 
		$i=1; $greyarr=array(1,4,5,8,9,12,13,16);
		while($cat_row=$cat_res_back->fetch_object()){ ?>
        	<div class="col-xs-6 text-center <?php if($i%2==0){echo "pull-right ";} if(in_array($i,$greyarr)){echo " greylay";}?>"> 
            	<a href="work.php?cat-id=<?php echo $cat_row->category_id ?>"> 
                <?php /*?><?php if($cat_row->category_name=="Print Campaigns") {?>
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
                <?php } ?><?php */?>
                	<p><?php echo $cat_row->category_name ?></p>
                </a>
            </div>
            <?php //if($row_cnt%2==0){ echo '</div><div class="row home-icons">'; }  $row_cnt++;?>
        <?php 
		$i++;
		} 
		?>
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
