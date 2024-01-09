<div class="container">
	<div class="row flc-header">
    <div class="col-sm-4 logo">
        <img alt="FLC Productions &amp; MODELS MGMT" title="FLC Model MGMT" src="../images/green/flc-logo_green.png">
                <div class="logo-caption"> FLC PRODUCTION <br/>&amp; MODEL MANAGEMENT</div>
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
     <?php if ($login->isUserLoggedIn() == true) {
						if($_SESSION['user_role']==2){
					?>
    <li><a href="index.php">Manager</a></li>
    <li style="padding-top:5px" class="bull">&bull;</li>
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">MODELS & TALENTS<b class="caret"></b></a>
    	<ul class="dropdown-menu">
        	<li style="border:none"><a href="model.php">Models</a> </li>
            <li><a href="cast.php">Cast</a></li>
            <li><a href="teens.php">Teens</a> </li>
            <li><a href="kids.php">Kids</a> </li>
            <li><a href="hostess.php">Hostess</a> </li>
            <li><a href="plus_size.php">Plus Size</a></li>	
            <li><a href="stylist.php">Stylist</a></li>	
            <li><a href="photographer.php">Photographer</a> </li>
            <li><a href="#">Entertainer</a></li>
        </ul>
    </li>
    <li style="padding-top:5px" class="bull">&bull;</li>
    <li style="border:none"><a href="index.php?logout">LOGOUT</a></li>
    
    
    <?php } else if($_SESSION['user_role']==3){?>
    	<li><a href="index.php">Admin</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="banners.php">BANNER IMAGES</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="articles.php">ARTICLES</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="media_manager.php">OUR WORKS</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="index.php?logout">LOGOUT</a></li>
    
    <?php  }
	else if($_SESSION['user_role']==4){
		?>
        <li><a href="index.php">Admin</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="banners.php">BANNER IMAGES</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="articles.php">ARTICLES</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="media_manager.php">OUR WORKS</a></li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">MODELS & TALENTS <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li style="border:none"><a href="model.php">Models</a> </li>
                <li><a href="cast.php">Cast</a></li>
                <li><a href="teens.php">Teens</a> </li>
                <li><a href="kids.php">Kids</a> </li>
                <li><a href="hostess.php">Hostess</a> </li>
                 <li><a href="plus_size.php">Plus Size</a></li>	
                <li><a href="stylist.php">Stylist</a></li>	
                <li><a href="photographer.php">Photographer</a> </li>
                <li><a href="#">Entertainer</a></li>
            </ul>
        </li>
        <li style="padding-top:5px" class="bull">&bull;</li>
        <li><a href="index.php?logout">LOGOUT</a></li>
		
	<?php	}
	
	 } ?>
    </ul>
    
            </div>
        </nav>
        <div class="social_icons"> 
        	<ul>
            	<li><a href="https://www.facebook.com/FLCMODELSDUBAI" target="_blank"><img src="../images/green/fb.png" /></a></li>
                <?php /*?><li><a href="#"><img src="images/green/tw.png" /></a></li><?php */?>
                <li><a href="http://www.linkedin.com/company/1895404/24200431/product" target="_blank"><img src="../images/green/link.png" /></a></li>
                <li><a href="http://www.youtube.com/channel/UCeER1LUHOuCea0bcNOkpfRw" target="_blank"><img src="../images/green/yt.png" /></a></li>
            </ul>
        </div>
    </div>
</div>
</div>