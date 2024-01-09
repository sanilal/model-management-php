<?php
ob_start();
/**
* A simple, clean and secure PHP Login Script

*/

// include the configs / constants for the database connection
require_once("../../config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    ?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Admin Panel</title>
<link href="../../css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.content{ min-height:581px}
.data_table{ border:1px solid #ccc}
.data_table tr:nth-child(even) {
    background-color: #f2f2f2;
}
.data_table tr:nth-child(odd) {
    background-color: #fff;
}
.data_table tr{ border-bottom:1px solid #d0d0d0}
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
            	<span class="title-grey">Admin Panel &gt;</span>
                <span class="title-red">
            		App Users List
            	</span>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
            <table width="90%" class="data_table">
                <tr style="background:#353030; color:#Fff">
                    <th>Name</th><th>Email</th><th>Company</th><th>Address</th><th>App join date</th>
                </tr>
                    <?php
                    $db_connection=db_connect();
                    $checkuser = $db_connection->query("SELECT * FROM app_users ORDER BY date_of_join DESC  ");
                    while($user_row=$checkuser->fetch_object()){
                    ?>
                    <tr>
                        <td><?php echo $user_row->name; ?></td><td><?php echo $user_row->email; ?></td><td><?php echo $user_row->company; ?></td><td><?php echo $user_row->address; ?></td>
                        <td><?php echo date( 'd-M-Y', strtotime($user_row->date_of_join) ); ?></td>
                    </tr>
                    <?php } ?>
                </td>
              </tr>
          </table>
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
    <?php
    
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
   header("Location:index.php?logout");
}