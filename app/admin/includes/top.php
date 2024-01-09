<style type="text/css">
	.errors{ color:#C92124}
	.messages{ color:#119A25}
</style>
<div class="header_main">

<div class="header">

	<div class="logo"><img name="" src="../images/flc-logo-new.jpg" width="95"  alt="FLC MOdels" /></div>
    
    
    <div class="logo_caption"><span class="caption_1">We make your campaign come alive!</span><br />    
    
    </div>

</div>



</div>
<div class="main_menu">

	<div class="menu">
    
    <ul class="main_menu_nav">
     <?php if ($login->isUserLoggedIn() == true) {
					if($_SESSION['app_user_role']==3 || $_SESSION['app_user_role']==4 ){
					?>
    <li><a href="users.php">App users</a></li>
    <li><a href="notifications.php">Notifications</a>
    <li style="border:none; float:right"><a href="index.php?logout">LOGOUT</a></li>
	<?php	}

	 }
	?>
    	
    </ul>
    
    
	</div>



</div>