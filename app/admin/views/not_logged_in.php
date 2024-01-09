<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Admin Login</title>
<link href="../../css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.content{ min-height:591px}
.contenter a{ text-decoration:none}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>

</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td>
            	
            </td>
          </tr>
         
          <tr>
            <td align="center">
            
            	<form method="post" action="index.php" name="loginform">
            	<table width="50%" style=" padding:25px; border: 1px solid #636363; border-radius:5px" cellpadding="4">
                	<tr>
                    	<td colspan="2" align="center">
                        	<h3 style=" margin-top:4px;">LOGIN</h3>
                        </td>  
    				</tr>
                	<tr>
                    	<td colspan="2" align="center">
                        	 <?php
                    
								// show negative messages
								if ($login->errors) { ?>
								<div class="errors">
								  <?php  foreach ($login->errors as $error) {
									echo $error;
									}
									?>
								   </div>
								<?php
								}
								
								// show positive messages
								if ($login->messages) {
									?>
									<div class="messages">
								   <?php foreach ($login->messages as $message) {
									echo $message;
									}
									?>
									 </div>
								   <?php 
								}
							
							?>
                        </td>  
    				</tr>
                	<tr>
                    	<td>
                			<label for="login_input_username">Username</label>
                        </td>
                        <td>
                        	<input id="login_input_username" class="login_input" type="text" name="user_name" required />
                        </td> 
                    </tr>
                    <tr>
                    	<td>
                        	<label for="login_input_password">Password</label>
                        </td>
                        <td>
                        	 <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
                        </td>    
                	</tr>
                  	<tr>
                    	<td colspan="2" align="center" style="padding-top:5px">
                        	<input type="submit" name="login" value="Log in" />
                        </td>  
    				</tr>
                 </table>   
            </form>
           
            
            </td>
          </tr>
        </table>
    
    </div>


</div>

<!---------------------------------------------------------------main_content_end------------------------------------------------------------------>

<!-------------------------------------------------------------------footer------------------------------------------------------------------------------------->
<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>
<!-----------------------------------------------------------------------footer---------------------------------------------------------------------------------------->
</body>
</html>
