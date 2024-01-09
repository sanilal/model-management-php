<?php 
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Admin Panel</title>
<style type="text/css">
body {
	background-color: #E1E1E1;
}
img{ border:none}
</style>
<link href="../css/flc1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <?php
		include_once("includes/left.php");
	 ?>
    </td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%" height="587" bgcolor="#FFFFFF"><img src="../image/hidden.gif" width="34" height="611" /></td>
        <td width="99%" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="../image/hidden.gif" width="946" height="52" /></td>
          </tr>
          <tr>
            <td>
            	<span class="title-grey">Admin Panel </span>
                <span class="title-red">
            	
            	</span>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
            	<?php
					session_start();
					echo $_SESSION['user_name'];
				?>
                &nbsp;
            	logged in
           
            
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
        	<?php include_once("includes/bottom.php"); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#333333"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" height="32"><img src="../image/bottom-bit.jpg" width="10" height="32" /></td>
            <td width="99%" class="bodyfont">&copy;2013 flcmodels.com | Privacy Policy</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
