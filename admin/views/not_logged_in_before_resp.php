<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Admin Login</title>
<link href="css/flc.css" rel="stylesheet" type="text/css" />
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
            	<a href="stylist.php" style="text-decoration:none" ><span class="title-grey">Login </span></a>
                <span class="title-red">
            	
            	</span>
            </td>
          </tr>
          <tr>
            <td>
            	 <div class="messages">
                <?php
                    
                    // show negative messages
                    if ($login->errors) {
                        foreach ($login->errors as $error) {
                        echo $error;
                        }
                    }
                    
                    // show positive messages
                    if ($login->messages) {
                        foreach ($login->messages as $message) {
                        echo $message;
                        }
                    }
                
                ?>
                </div>
            </td>
          </tr>
          <tr>
            <td>
            
            	<form method="post" action="" name="loginform">
            	<table>
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
                    	<td colspan="2" align="center">
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
