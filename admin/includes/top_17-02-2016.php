<div class="header_main">

<div class="header">

	<div class="logo"><img name="" src="../image/logo.jpg" width="95" height="112" alt="" /></div>
    
    
    <div class="logo_caption"><span class="caption_1">We make your campaign come alive!</span><br />
    
    
    <span class="cption_2"><a style="color:#ACACAC; text-decoration:none;" href="mailto:talk2us@flcmodels.com" target="_blank">talk2us@flcmodels.com</a></span>
    
    
    
    </div>

</div>



</div>
<div class="main_menu">

	<div class="menu">
    
    <ul class="main_menu_nav">
     <?php if ($login->isUserLoggedIn() == true) {
						if($_SESSION['user_role']==2){
					?>
    <li><a href="index.php">Manager</a></li>
    <li><a href="#">MODELS & TALENTS</a>
    	<ul>
        	<li style="border:none"><a href="model.php">Models</a> </li>
            <li><a href="cast.php">Cast</a></li>
            <li><a href="teens.php">Teens</a> </li>
            <li><a href="kids.php">Kids</a> </li>
            <li><a href="hostess.php">Hostess</a> </li>
            <li><a href="stylist.php">Stylist</a></li>	
            <li><a href="photographer.php">Photographer</a> </li>
            <li><a href="#">Entertainer</a></li>
        </ul>
    </li>
    <li style="border:none"><a href="index.php?logout">LOGOUT</a></li>
    
    
    <?php } else if($_SESSION['user_role']==3){?>
    	<li><a href="index.php">Admin</a></li>
        <li><a href="banners.php">BANNER IMAGES</a></li>
        <li><a href="articles.php">ARTICLES</a></li>
        <li><a href="media_manager.php">OUR WORKS</a></li>
        <li><a href="index.php?logout">LOGOUT</a></li>
    
    <?php  }
	else if($_SESSION['user_role']==4){
		?>
        <li><a href="index.php">Admin</a></li>
        <li><a href="banners.php">BANNER IMAGES</a></li>
        <li><a href="articles.php">ARTICLES</a></li>
        <li><a href="media_manager.php">OUR WORKS</a></li>
        <li><a href="#">MODELS & TALENTS</a>
            <ul>
                <li style="border:none"><a href="model.php">Models</a> </li>
                <li><a href="cast.php">Cast</a></li>
                <li><a href="teens.php">Teens</a> </li>
                <li><a href="kids.php">Kids</a> </li>
                <li><a href="hostess.php">Hostess</a> </li>
                <li><a href="stylist.php">Stylist</a></li>	
                <li><a href="photographer.php">Photographer</a> </li>
                <li><a href="#">Entertainer</a></li>
            </ul>
        </li>
        <li><a href="index.php?logout">LOGOUT</a></li>
		
	<?php	}
	
	 } ?>
    </ul>
    
    
	</div>



</div>