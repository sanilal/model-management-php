<?php
ob_start();
?>
<style type="text/css">
.shopping-cart {
    display: inline-block;
    background: url('image/cart_bskt.png') no-repeat 0 0;
    /*width: 24px;*/
	line-height:27px;
	padding-left:29px;
    height: 24px;
    margin: 0 10px 0 0; color:#FFF
}
.water_mark{ position:absolute; color:#E7040D;  filter:alpha(opacity=70); opacity:0.7; z-index:1}
.water_mark > b, .water_mark > img{ position:absolute; bottom:3px; border:none; left:4px}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" height="100%">
	<tr>
    	<td height="124">
        	<img src="image/logo-flc.jpg" width="220" height="124" />
        </td>
    </tr>
      <tr>
        <td height="537" valign="top" class="left_td"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
           <?php /*?> <td width="13%"><img src="image/left-bit.jpg" width="8" height="505" class="left_bit" /></td>
            <td width="8%"><img src="image/hidden.gif" width="20" height="20" /></td><?php */?>
            <td width="79%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="image/hidden.gif" width="39" height="15" class="top_bit" /></td>
              </tr>
              <tr>
              
                <td>
                	<ul class="left_main_menu" style="padding-left:15px">
                    	<?php /*?><li><a href="index.php">HOME</a></li>
                        <li><a href="aboutus.php">ABOUT US</a></li>
                        <li><a href="work.php">OUR WORKS</a></li>
                        <li><a href="register.php">REGISTER WITH US</a></li><?php */?>
                    	<li><a href="model.php">Models</a> </li>
                        <li><a href="cast.php">Cast</a></li>
                        <li><a href="teens.php">Teens</a> </li>
                        <li><a href="kids.php">Kids</a> </li>
                        <li><a href="stylist.php">Stylist</a></li>	
                        <li><a href="photographer.php">Photographer</a> </li>
                        <li><a href="#">Entertainer</a></li>
                        <?php /*?><li><a href="contact.php">CONTACT</a></li><?php */?>
                        
                    </ul>
                </td>
              </tr>
            <tr>
          		<td>&nbsp; </td>
          	</tr>
            <tr>
          		<td>
                	<div style="font-weight:bold; color:#FFF; padding-left:15px">
                		<span>
                		<a href="cart.php">
                        	<span class="shopping-cart"> SHORTLIST 
                                <span id="cart_size">
                                <?php
                                session_start();
                                if(isset($_SESSION['models'])){
                                    echo "(".sizeof($_SESSION['models']).")";
                                }
                                else
                                    echo "(0)";
                                ?>
                                </span> 
                          </span> 
                        </a>
                       </span>
                    </div>
                    
                 </td>
          	</tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php /*?><img src="image/logo-flc.jpg" width="220" height="124" /><?php */?></td>
      </tr>
      <tr>
        <td height="40">
        	
        </td>
      </tr>
    </table>