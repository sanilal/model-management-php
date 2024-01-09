<?php 
ob_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Admin Panel</title>
<style type="text/css">

.content{ min-height:581px; width:79%; margin:0 auto;}
</style>


<link rel="icon" href="../favicon.ico" type="image/x-icon" />
  <!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
 <!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery(".navbar-brand").click(function(){
            jQuery(".navbar-toggle").click();
        })
    })
</script>


</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="container">
	<div class="punch_cont">
        	<div class="text-left">
                                <span>Admin Panel </span>
            </div>
        </div>
	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
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
