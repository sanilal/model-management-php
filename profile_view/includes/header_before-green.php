<div class="row text-center flc-header">
    <div class="col-sm-4 left-al logo">
        <img alt="FLC MODELS &amp; TALENTS" title="FLC Models" src="images/logo.jpg">
    </div>
    <div class="col-sm-8 right-al logo_caption">
        <span title="FLC Models" class="caption_1">We make your campaign come alive!</span><br>    
        <span class="cption_2"><a target="_blank" title="FLC Models" href="mailto:talk2us@flcmodels.com" class="talk2">talk2us@flcmodels.com</a></span>
    </div>
</div>
<nav class="navbar-inverse" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:;">MENU</a>
    </div>
    
    <div class="collapse navbar-collapse nav-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav flc_menu">
            <li><a href="index.php"  title="FLC MODELS">HOME</a></li>
            <li><a href="aboutus.php" title="ABOUT FLC MODELS">ABOUT US</a></li>
            <li class="dropdown"><a href="#" title="FLC MODELS PORTFOLIO" class="dropdown-toggle" data-toggle="dropdown">OUR WORK<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
						require_once("config/db.php");
						require_once("classes/Media.php");
						$media_top= new Media();
						$cat_res=$media_top->getCategory();
						while($cat_row=$cat_res->fetch_object()){
							?>
							<li ><a title="FLC MODELS <?php echo $cat_row->category_name ?>" href="work.php?cat-id=<?php echo $cat_row->category_id ?>"><?php echo $cat_row->category_name ?></a> </li>
							<?php
						}
					 ?>
                </ul>
            </li>
            <li><a href="men.php" title="FLC MEN MODELS">MEN</a></li>
            <li><a href="women.php" title="FLC WOMEN MODELS">WOMEN</a></li>
            <li class="dropdown"><a href="#" title="FLC MODELS TALENTS" class="dropdown-toggle" data-toggle="dropdown">TALENTS<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="cast.php" title="FLC MODELS CAST">CAST</a></li>
                    <li><a href="teens.php" title="FLC TEEN MODELS">TEENS</a> </li>
                    <li><a href="kids.php" title="FLC KIDS MODEL">KIDS</a> </li>
                    <li><a href="hostess.php" title="FLC HOSTESS MODEL">HOSTESS</a> </li>
                    <li><a href="stylist.php" title="FLC MODELS">STYLIST</a></li>	
                    <li><a href="photographer.php" title="FLC MODELS">PHOTOGRAPHER</a> </li>
                </ul>
            </li>
            <li><a href="register.php" title="REGISTER WITH EMODELS - dubai Modelling Agency">REGISTER</a></li>
            <li><a href="login.php" title="FLC MODELS">LOGIN</a></li>
            <li style="border:none"><a href="contact.php" title="FLC MODELS">CONTACT US</a></li>
        </ul>
    </div>
</nav>