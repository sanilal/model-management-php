<?php
ob_start();
?>
<style type="text/css">
.shopping-cart {
    display: inline-block;
    background: url('../image/cart_bskt.png') no-repeat 0 0;
    /*width: 24px;*/
	line-height:27px;
	padding-left:29px;
    height: 24px;
    margin: 0 10px 0 0; color:#FFF
}
.water_mark{ position:absolute; color:#E7040D; font-family: "Lucida Sans Unicode","Lucida Grande",sans-serif; filter:alpha(opacity=70); opacity:0.7}
.water_mark > b, .water_mark > img{ position:absolute; bottom:3px; border:none; left:4px}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  background="../image/left-menu-bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="13%"><img src="../image/left-bit.jpg" width="8" height="505" /></td>
            <td width="8%"><img src="../image/hidden.gif" width="20" height="20" /></td>
            <td width="79%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="34"><img src="../image/hidden.gif" width="39" height="80" /></td>
              </tr>
              <tr>
                <td>
                	<ul class="left_main_menu">
                    <?php if ($login->isUserLoggedIn() == true) {
						if($_SESSION['user_role']==2){
					?>
                    	<li><a href="index.php">Manager</a></li>
                    	<li><a href="model.php">MODELS</a> </li>
                        <li><a href="cast.php">CAST</a></li>
                        <li><a href="teens.php">TEENS</a></li>
                        <li><a href="kids.php">KIDS</a></li>
                        <li><a href="stylist.php">STYLIST</a></li>	
                        <li><a href="photographer.php">PHOTOGRAPHER</a> </li>
                        <li><a href="#">ENTERTAINER</a></li>
                        <li><a href="index.php?logout">LOGOUT</a></li>
				<?php  }
					else if($_SESSION['user_role']==3){ ?>
						<li><a href="index.php">Admin</a></li>
                        <li><a href="banners.php">BANNER IMAGES</a></li>
                        <li><a href="articles.php">ARTICLES</a></li>
                        <li><a href="media_manager.php">OUR WORKS</a></li>
                        <li><a href="index.php?logout">LOGOUT</a></li>
				<?php	}
				 }
					
				 ?>
                    </ul>
                </td>
              </tr>
            <tr>
          		<td>&nbsp; </td>
          	</tr>
            <tr>
          		<td>
                  <?php if ($login->isUserLoggedIn() == true) {
					  	if($_SESSION['user_role']==2){
				?>
					  	
                	<div style="font-family: Tahoma,Geneva,sans-serif; font-size: 12px; font-weight:bold; color:#FFF">
                		<span>
                		<a href="cart.php">
                        	<i class="shopping-cart"> SHORTLIST 
                                <span id="cart_size">
                                <?php
                                session_start();
                                if(isset($_SESSION['models_man'])){
                                    echo "(".sizeof($_SESSION['models_man']).")";
                                }
                                else
                                    echo "(0)";
                                ?>
                                </span> 
                          </i> 
                        </a>
                       </span>
                    </div>
                    <?php
						}
				  }
					?>
                 </td>
          	</tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../image/logo-flc.jpg" width="220" height="124" /></td>
      </tr>
      <tr>
        <td height="34"><img src="../image/socialmedia-icons.jpg" width="220" height="34" /></td>
      </tr>
    </table>