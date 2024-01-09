<div class="header_main">

<div class="header">

	<div class="logo"><img name="" src="image/logo.jpg" width="95" height="112"  title="FLC Models" alt="FLC MODELS & TALENTS" /></div>
    
    
    <div class="logo_caption"><span class="caption_1"  title="FLC Models">We make your campaign come alive!</span><br />
    
    
    <span class="cption_2"><a class="talk2" href="mailto:talk2us@flcmodels.com"  title="FLC Models" target="_blank">talk2us@flcmodels.com</a></span>
    
    
    
    </div>

</div>



</div>
<div class="main_menu">

	<div class="menu">
    
    <ul class="main_menu_nav">
    
    <li><a href="index.php"  title="FLC MODELS">HOME</a></li>
    <li><a href="aboutus.php" title="ABOUT FLC MODELS">ABOUT US</a></li>
    <li><a href="#" title="FLC MODELS PORTFOLIO">OUR WORK</a>
    	<ul class="work_ul">
        	<?php
				require_once("classes/Media.php");
				$media_top= new Media();
				$cat_res=$media_top->getCategory();
				while($cat_row=$cat_res->fetch_object()){
					?>
					<li ><a title="FLC MODELS" href="work.php?cat-id=<?php echo $cat_row->category_id ?>"><?php echo $cat_row->category_name ?></a> </li>
					<?php
				}
			 ?>
        	<?php /*?><li style="border:none"><a href="work.php?cat_id=1">Print Campaigns</a> </li>
            <li><a href="work.php?cat_id=2">TVCs</a></li>
            <li><a href="work.php?cat_id=3">Videos</a> </li>
            <li><a href="work.php?cat_id=4">Catalogue Shoots</a> </li>
            <li><a href="work.php?cat_id=5">Fashion Shows</a></li>	
            <li><a href="work.php?cat_id=6">Events & Exhibitions</a> </li><?php */?>
        </ul>
    </li>
    <li><a href="men.php" title="FLC MEN MODELS">MEN</a></li>
    <li><a href="women.php" title="FLC WOMEN MODELS">WOMEN</a></li>
    <li><a href="#" title="FLC MODEL TALENTS">TALENTS</a>
    	<ul>
        	<?php /*?><li style="border:none"><a href="model.php">Models</a> </li><?php */?>
            <li><a href="cast.php" title="FLC MODELS CAST">Cast</a></li>
            <li><a href="teens.php" title="FLC TEEN MODELS">Teens</a> </li>
            <li><a href="kids.php" title="FLC KIDS MODEL">Kids</a> </li>
            <li><a href="hostess.php" title="FLC HOSTESS MODEL">Hostess</a> </li>
            <li><a href="stylist.php" title="FLC MODELS">Stylist</a></li>	
            <li><a href="photographer.php" title="FLC MODELS">Photographer</a> </li>
            
            <?php /*?><li><a href="entertainer.php">Entertainer</a></li><?php */?>
        </ul>
    </li>
    <li><a href="register.php" title="REGISTER WITH EMODELS - dubai Modelling Agency">REGISTER</a></li>
    <li><a href="login.php" title="FLC MODELS">LOGIN</a></li>
    <li style="border:none"><a href="contact.php" title="FLC MODELS">CONTACT US</a></li>
 </ul>
</div>



</div>