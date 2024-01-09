<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLC Production & Model Management - Admin Login</title>

    <?php include_once("includes/head_common.php"); ?>
    <style type="text/css">
	.contenter a{ color:#E70310}
	#mytable td{ padding:5px;}
	</style>
</head>

<body>  
    
  <div class="container">
   		 <?php include_once("includes/header.php"); ?>
        
    </div>
    
    <!-- Page Content -->
    <div class="container inner_content">
		<div class="punch_cont">
        	<div class="text-left">
                <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
               
                <span>Login</span>
            </div>
        </div>
        <!-- Jumbotron Header -->
         <?php /*?><header class="hero-spacer" style="margin:15px 0px">
        	<div>
                <a class="text_none" href="index.php"><span class="title-grey">HOME &gt;</span></a>
                
                <span class="title-red">Login</span>
            </div>
        </header>
<?php */?>
       <!-- <hr>-->

        <!-- Title -->
        <div class="row content-main">
           
            <div class="col-xs-12">
            	<div class="messages">
                <?php
                    
                    // show negative messages
                    if ($login->errors) {
                        foreach ($login->errors as $error) {
                        echo $error;
						echo "<br/>";
                        }
                    }
                    
                    // show positive messages
                    if ($login->messages) {
                        foreach ($login->messages as $message) {
                        echo $message;
						echo "<br/>";
                        }
                    }
                
                ?>
                </div>   
                <div>
                	<form method="post" action="" name="loginform">
                        <table id="mytable">
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
                </div>        
                
            </div>
                        
        </div>
        
        
    </div>
    
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
</body>

</html>
