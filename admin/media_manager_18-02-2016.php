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

	require_once("../classes/Media.php");

	$media= new Media();

    //

	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>FLC Models - Our works</title>

<link href="../css/flc.css" rel="stylesheet" type="text/css" />

<style type="text/css">

.content{ min-height:581px}

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

#media_content,#category_content{ display:none}

a.tab_a{ background:#292929; color:#FFF; text-decoration:none}

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">

	///

			jQuery(function(){

				jQuery(".dialog_bg").click(function(){

					pop_close();

				}) 

				<?php if(isset($_POST['category_name'])){ ?>

				jQuery("#category_content").show();

				<?php } else{ ?>

				jQuery("#media_content").show();

				<?php } ?>

				///

				//text_editor();

				//jQuery(".datepicker").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});

			})

	function add_media_pop(){

				jQuery(".pop_media_content").show();

				jQuery(".pop_category_content").hide();

				jQuery(".loading_div").hide();

				popup();

			}

	function add_category_pop(){

				jQuery(".pop_category_content").show();

				jQuery(".pop_media_content").hide();

				jQuery(".loading_div").hide();

				popup();

			}

	function edit_media(obj){

				if(obj!=""){

					jQuery(".pop_media_content").hide();

					jQuery(".pop_category_content").hide();

					jQuery(".dialog_form").children(".pop_content").show();

					popup();

					jQuery.ajax({

						  url: "ajax.php",

						  type: "post",

						  data:  {getdata: "media_editable_data", value:obj },

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

			//

			function edit_category(obj){

				if(obj!=""){

					jQuery(".pop_media_content").hide();

					jQuery(".pop_category_content").hide();

					jQuery(".dialog_form").children(".pop_content").show();

					popup();

					jQuery.ajax({

						  url: "ajax.php",

						  type: "post",

						  data:  {getdata: "category_editable_data", value:obj },

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

			//

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

			//

			function tab_toggle(obj){

				if(obj=="media"){

					jQuery("#media_content").show();

					jQuery("#category_content").hide();

				}

				else{

					jQuery("#media_content").hide();

					jQuery("#category_content").show();

				}

			}

</script>

<style type="text/css">

	.title-grey{ font-size:14px; text-transform:none;}

	a > .title-grey{color:#FFF; padding:4px}

</style>

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

    <div class="pop_media_content">

        	<div class="title"><h3>Add Media</h3></div>

               

                <form method="post" action="" name="registerform" enctype="multipart/form-data" >

                    <table style="margin:0 auto">

                       

                       

                        <tr>

                            <td>

                                <label for="media_title">Media title</label>

                            </td>

                            <td>

                                <input id="media_title" class="product_input" type="text" name="media_title" required autocomplete="off" />

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <label for="category_id">Category</label>

                            </td>

                            <td>

                                <select id="category_id" class="product_input"  name="media_category">

                                <?php

                                $cat_res=$media->getCategory();

								while($cat_row=$cat_res->fetch_object()){

									?>

                                    <option value="<?php echo $cat_row->category_id ?>"><?php echo $cat_row->category_name ?></option>

									<?php

                                }

                                ?>

								</select>

                            </td>

                        </tr>

                  		<tr>

                            <td>

                                <label for="media_type">Media type</label>

                            </td>

                            <td>

                               <select id="media_type" class="product_input"  name="media_type">

                               		<option>Image</option>

                                    <option>Video</option>

                               </select>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <label for="media_image">Media image</label>

                            </td>

                            <td>

                               <input id="media_image" class="product_input" name="media_img"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image2">Media image 2</label>

                            </td>

                            <td>

                               <input id="media_image2" class="product_input" name="media_img2"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image3">Media image 3</label>

                            </td>

                            <td>

                               <input id="media_image3" class="product_input" name="media_img3"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image4">Media image 4</label>

                            </td>

                            <td>

                               <input id="media_image4" class="product_input" name="media_img4"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image5">Media image 5</label>

                            </td>

                            <td>

                               <input id="media_image5" class="product_input" name="media_img5"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image6">Media image 6</label>

                            </td>

                            <td>

                               <input id="media_image6" class="product_input" name="media_img6"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image7">Media image 7</label>

                            </td>

                            <td>

                               <input id="media_image7" class="product_input" name="media_img7"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image8">Media image 8</label>

                            </td>

                            <td>

                               <input id="media_image8" class="product_input" name="media_img8"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image9">Media image 9</label>

                            </td>

                            <td>

                               <input id="media_image9" class="product_input" name="media_img9"  type="file" />

                            </td>

                        </tr>

                         <tr>

                            <td>

                                <label for="media_image10">Media image 10</label>

                            </td>

                            <td>

                               <input id="media_image10" class="product_input" name="media_img10"  type="file" />

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <label for="media_link">Media link</label>

                            </td>

                            <td>

                               <input id="media_link" class="product_input" name="media_link"  type="text" />

                            </td>

                        </tr>

                        <tr>

                            <td colspan="2" align="center">                          

                                <input type="submit" name="media_add" value="Add" />

                            </td>

                         </tr>

                         

                     </table>       

                </form>

        </div>

        <div class="pop_category_content">

        	<div class="title"><h3>Add work Category</h3></div>

               

                <form method="post" action="" name="registerform" enctype="multipart/form-data" >

                    <table style="margin:0 auto">

                       

                       

                        <tr>

                            <td>

                                <label for="category_name">Category Name</label>

                            </td>

                            <td>

                                <input id="category_name" class="product_input" type="text" name="category_name" required autocomplete="off" />

                            </td>

                        </tr>

                       

                        <tr>

                            <td colspan="2" align="center">                          

                                <input type="submit" name="category_add" value="Add" />

                            </td>

                         </tr>

                         

                     </table>       

                </form>

        </div>

</div>

<?php include_once("includes/top.php"); ?>



<div class="content_main">



	<div class="content" style="margin-bottom:20px">

    

<table width="100%" border="0" cellspacing="0" cellpadding="0">

          

          <tr>

            <td>

            	<a href="javascript:;" onclick="tab_toggle('media')" class="tab_a"><span class="title-grey"> Our works  </span> </a> &nbsp; &nbsp;

                <a href="javascript:;" onclick="tab_toggle('category')" class="tab_a"><span class="title-grey"> Categories  </span> </a>

            </td>

          </tr>

          <tr>

          	<td height="10">&nbsp;</td>

          </tr>

          <tr>

            <td>

            	 <div class="messages">

                <?php

                    // show negative messages

                    if ($media->errors) {

                        foreach ($media->errors as $error) {

                        echo $error;

                        }

                    }

                    

                    // show positive messages

                    if ($media->messages) {

                        foreach ($media->messages as $message) {

                        echo $message;

                        }

                    }

                

                ?>

                </div>

            </td>

          </tr>

          <tr>

            <td>

            <div id="media_content">

            	<span class="title-grey" style="float:left;">Our Work Media list </span>

                <span style="float:left; margin-left:20px; font-weight:bold">

            		<input type="button" value="Add new work media" onclick="add_media_pop();" />

            	</span>

                <br />

            	<table id="recall_list" width="100%" cellpadding="1">

                            <tr class="title_div" bgcolor="#333333" style="color:#FFF">

                                <th>Sl No</th><th>Media Title</th><th>Media category</th><th>Media Image</th><th>Media Type</th> <th>Edit</th> <th>Delete</th> 

                            </tr>

                        	<?php

								$k=1;

								$media_res=$media->getMedia();

								while($row=$media_res->fetch_object()){

							?>

                            <tr bgcolor="#E1E1E1" >

                                <td><?php echo $k; $k++; ?></td>

                                <td><?php echo stripslashes($row->work_title); ?></td>

                                 <td>

								 	<?php

										$cat_res001=$media->getCategory($row->category_id);

										$cat_row=$cat_res001->fetch_object();

									 	echo $cat_row->category_name;

									 ?>

                                 </td>

                                <td>

                                <?php if($row->work_image!=""){ ?>

                                	<img src='../uploads/<?php echo $row->work_image; ?>' style=" max-width:120px"  />

                                 <?php } ?>

                                 </td>

                                 <td><?php echo $row->work_type ?></td>

                                <td><a href="javascript:;" onclick="edit_media('<?php echo $row->work_id ?>')">Edit</a></td>

                                <td>

                                    <form action="" method="post">

                                    	<input type="hidden" name="media_id" value="<?php echo $row->work_id; ?>"  />  

                                    	<input type="submit" value="Delete" name="media_del" />

                                    </form>

                                </td> 

                            </tr>

                            <?php } ?>

                        </table>

               </div>

                 <div id="category_content">

            	<span class="title-grey" style="float:left;">Category list </span>

                <span style="float:left; margin-left:20px; font-weight:bold">

            		<input type="button" value="Add newcategory" onclick="add_category_pop();" />

            	</span>

                <br />

            	<table id="recall_list" width="100%" cellpadding="1">

                            <tr class="title_div" bgcolor="#333333" style="color:#FFF">

                                <th>Sl No</th><th>Category Name</th><th>Edit</th> <th>Edit</th> 

                            </tr>

                        	<?php

								$k=1;

								$cat_res2=$media->getCategory();

								while($cat_row=$cat_res2->fetch_object()){

							?>

                            <tr bgcolor="#E1E1E1" >

                                <td><?php echo $k; $k++; ?></td>

                                <td><?php echo $cat_row->category_name ?></td>

                                <td><a href="javascript:;" onclick="edit_category('<?php echo $cat_row->category_id ?>')">Edit</a></td> 

                                <td>

                                    <form action="" method="post">

                                    	<input type="hidden" name="category_id" value="<?php echo $cat_row->category_id; ?>"  />  

                                    	<input type="submit" value="Delete" name="category_delete" />

                                    </form>

                                </td> 

                            </tr>

                            <?php } ?>

                        </table>

               </div>

            

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