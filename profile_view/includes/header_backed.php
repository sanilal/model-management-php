<div class="row flc-header">
    <div class="col-sm-4 logo">
    <a href="http://flc-me.com/" target="_blank" >
        <img alt="FLC Productions &amp; MODELS MGMT" title="FLC Model MGMT" src="images/green/flc-logo_green.png">
         <div class="logo-caption"> FLC PRODUCTION <br/>&amp; MODEL MANAGEMENT</div>
     </a>
    </div>
    
    <div class="col-sm-8 menu_cont">
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
                    <li><a href="index.php"  title="FLC MODELS">Home</a></li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li><a href="aboutus.php" title="ABOUT FLC MODELS">About Us</a></li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li class="dropdown"><a href="#" title="FLC MODELS WORK PORTFOLIO" class="dropdown-toggle" data-toggle="dropdown">Our Works<b class="caret"></b></a>
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
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li><a href="men.php" title="FLC MEN MODELS">Men</a></li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li><a href="women.php" title="FLC WOMEN MODELS">Women</a></li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li class="dropdown"><a href="#" title="FLC MODELS TALENTS" class="dropdown-toggle" data-toggle="dropdown">Talents<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="cast.php" title="FLC MODELS CAST">Cast</a></li>
                            <li><a href="teens.php" title="FLC TEEN MODELS">Teens</a> </li>
                            <li><a href="kids.php" title="FLC KIDS MODEL">Kids</a> </li>
                            <li><a href="hostess.php" title="FLC HOSTESS MODEL">Hostess</a> </li>
                            <li><a href="stylist.php" title="FLC MODELS">Stylist</a></li>	
                            <li><a href="photographer.php" title="FLC MODELS">Photographer</a> </li>
                        </ul>
                    </li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li><a href="register.php" >Register</a></li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li><a href="login.php" title="FLC MODELS">Login</a></li>
                    <li style="padding-top:5px" class="bull">&bull;</li>
                    <li style="border:none"><a href="contact.php" >Contact Us</a></li>
                </ul>
            </div>
        </nav>
        <div class="social_icons"> 
        	<ul>
            	<li><a href="https://www.facebook.com/FLCMODELSDUBAI" target="_blank"><img src="images/green/fb.png" /></a></li>
                <?php /*?><li><a href="#"><img src="images/green/tw.png" /></a></li><?php */?>
                <li><a href="http://www.linkedin.com/company/1895404/24200431/product" target="_blank"><img src="images/green/link.png" /></a></li>
                <li><a href="http://www.youtube.com/channel/UCeER1LUHOuCea0bcNOkpfRw" target="_blank"><img src="images/green/yt.png" /></a></li>
            </ul>
        </div>
    </div>
</div>
