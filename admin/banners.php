<?php

/**
* A simple, clean and secure PHP Login Script

*/

// include the configs / constants for the database connection
require_once("../config/db.php");

// load the login class
require_once("../classes/Login.php");


$login = new Login();
//session_destroy();
//unset($_SESSION['user_role']);
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
	if($_SESSION['user_role']==3 || $_SESSION['user_role']==4){
    //
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC Models - Banner Images</title>

<link rel="stylesheet" type="text/css" href="css/jHtmlArea.css" />
<style type="text/css">
.content{ min-height:581px; width:79%; margin:0 auto;}
img{ border:none}
.dialog_bg{
	background-color:#666;
	filter:alpha(opacity=50);
	left:0;
	opacity:0.5;
	position:fixed;
	top:0;
	width:100%;
	height:100%;
	z-index:1000;
	display:none
}
.dialog_form{
	min-width: 370px;
	top: 35%;
	left: 50%;
	margin-top: -170px;
	margin-left: -340px;
	overflow:hidden;
	z-index:1002;
	position:fixed;
	display:none;
	-moz-box-shadow:rgba(0,0,0,.2) 0 4px 16px;
	-webkit-box-shadow:rgba(0,0,0,.2) 0 4px 16px;
	background-color:#fff;
	border:1px solid #666;
	box-shadow:rgba(0,0,0,.2) 0 4px 16px;
	min-height:300px; text-align:left; line-height:25px; padding-bottom: 10px;
}
.loading_div{ width:100%; text-align:center; line-height:350px; /*height:350px*/}
.close-bg{background-color:#333333; height: 31px; left: 24px; top: 1px; /*width: 100%;*/}
.pop_content{ padding:8px;  }
.jHtmlArea{ width:421px !important; border:2px solid #333}
	.jHtmlArea iframe{ width:417px !important; height: 115px !important;}
	.pop_content, .pop_brand_content{ max-height:550px; overflow:auto}
.ToolBar{ width:100% !important}
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


<script src="js/jHtmlArea-0.7.5.js" type="text/javascript"></script>
<script type="text/javascript">
	///
			jQuery(function(){
				jQuery(".dialog_bg").click(function(){
					pop_close();
				}) 
				///
				text_editor();
				//jQuery(".datepicker").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
			})
	function edit_banner(obj){
				if(obj!=""){
					jQuery(".pop_banner_content").hide();
					jQuery(".dialog_form").children(".pop_content").show();
					popup();
					jQuery.ajax({
						  url: "ajax.php",
						  type: "post",
						  data:  {getdata: "banner_editable_data", value:obj },
						  success: function(message){
							  jQuery(".loading_div").hide();
							  jQuery(".dialog_form").children(".pop_content").html(message)
							  text_editor()
						  },
						  error:function(){
							alert("Failure")
						  }   
					});
				}
			}
			function popup(){
				jQuery(".dialog_bg").show()
				jQuery(".dialog_form").fadeIn('fast');
			}
			function pop_close(){
				jQuery(".dialog_form").fadeOut('fast');
				jQuery(".dialog_form").children(".pop_content").html("")
				jQuery(".dialog_bg").hide()
				jQuery(".loading_div").show();
			}
			function text_editor(){
			jQuery('.txtEditor').htmlarea();
		}
		function add_banner_pop(){
				jQuery(".pop_banner_content").show();
				jQuery(".loading_div").hide();
				popup();
			}
</script>
</head>

<body>
<div class="dialog_bg"></div>
<div class="dialog_form" style="width:auto">
    <div class="close-bg" > 
        <a onclick="pop_close();" style="float: right; margin-right: 3px; margin-top: 3px; cursor:pointer">
            <img border="0" src="../image/close-pop.png">
        </a>
    </div>      
    <div class='loading_div'>Loading....</div>
    <div class="pop_content">
                
    </div>
    <div class="pop_banner_content">
        	<div class="title"><h3>Add Banner Image</h3></div>
               <form method="post" action="" enctype="multipart/form-data" >
                    <table style="margin: 0 auto;">
                    	
                         <tr>
                            <td>
                                <label for="article_img1">Banner image</label>
                            </td>
                            <td>
                                <input id="article_img1" class="login_input" type="file" name="banner_image" /><br/>
                                
                            </td>
                        </tr>
                       
                        <tr>
                            <td colspan="2" align="center"> 
                            	                     
                                <input type="submit" name="banner_add" value="SUBMIT" />
                            </td>
                         </tr>
                         
                     </table>       
                </form>
        </div>
</div>
<?php include_once("includes/top.php"); ?>

<div class="container">
	<div class="punch_cont">
        	<div class="text-left">
                                <span>Banner Images </span>
            </div>
        </div>
        
	<div class="content" style="margin-bottom:20px">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td> &nbsp;</td>
          </tr>
          <tr>
            <td>
                <span style="float:left; margin-left:20px; font-weight:bold">
            		<input type="button" value="Add new banner" onclick="add_banner_pop();" />
            	</span>
            </td>
          </tr>
           <tr>
            <td> &nbsp;</td>
          </tr>
          <tr>
            <td>
            	 <div class="messages">
                <?php
                    require_once("../classes/Article.php");
					$article= new Article();
                    // show negative messages
                    if ($article->errors) {
                        foreach ($article->errors as $error) {
                        echo $error;
                        }
                    }
                    
                    // show positive messages
                    if ($article->messages) {
                        foreach ($article->messages as $message) {
                        echo $message;
                        }
                    }
                
                ?>
                </div>
            </td>
          </tr>
          <tr>
            <td>
            
            	<table id="recall_list" width="100%" cellpadding="1">
                            <tr class="title_div" bgcolor="#333333" style="color:#FFF">
                                <th>Sl No</th><th>Banner Image</th> <th>Edit</th><th>Delete</th> 
                            </tr>
                        	<?php
								$k=1;
								$articles=$article->getBanner();
								while($row=$articles->fetch_object()){
							?>
                            <tr class="title_div" bgcolor="#E1E1E1" >
                                <td><?php echo $k; $k++; ?></td>
                                <td><img src='../uploads/<?php echo $row->banner_image; ?>' width='200'  /></td>
                                <td><a href="javascript:;" onclick="edit_banner('<?php echo $row->banner_id ?>')">Edit</a></td> 
                                <td>
                                	 <form action="" method="post">
                                    	<input type="hidden" name="banner_id" value="<?php echo $row->banner_id; ?>"  />  
                                    	<input type="submit" value="Delete" name="banner_delete" />
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
            
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


	<?php
    //
	}
	else {
    	header("Location:../login.php");
	}
    
} else {
    header("Location:../login.php");
}