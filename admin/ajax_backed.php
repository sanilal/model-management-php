<?php
ob_start();
		
	if(isset($_POST['insertdata'])){
		if($_POST['insertdata']=="models"){
			$id=$_POST['id'];
			session_start();
			$_SESSION['models_man'][$id]=$id;
			echo sizeof($_SESSION['models_man']);
		}
	}
	if(isset($_POST['deldata'])){
		if($_POST['deldata']=="cart"){
			session_start();
			unset($_SESSION['models_man'][$_POST['item_id']]);
			echo "success";
		}
	}
	if(isset($_POST['getdata'])){
		if($_POST['getdata']=="cart_size"){
			session_start();
			echo sizeof($_SESSION['models_man']);
		}
	}
	//
	
	else if($_POST['getdata']=="article_editable_data"){
		
		require_once("../config/db.php");
		require_once("../classes/Article.php");
		$article = new Article();
		$articles=$article->getArticle($_POST['value']);
		$row=$articles->fetch_object();
		?>
		<div class="title"><h3>Edit Article</h3></div>
            <form method="post" action="" enctype="multipart/form-data" >
                    <table style="margin: 0 auto;">
                    	<tr>
                            <td width="200">
                                <!-- the user name input field uses a HTML5 pattern check -->
                                <label for="recall_page">Article Page</label>
                            </td>
                            <td>
                         <input id="recall_page" class="product_input" type="text" name="article_page" disabled="disabled" autocomplete="off" value="<?php echo $row->article_page; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td width="200">
                                <!-- the user name input field uses a HTML5 pattern check -->
                                <label for="recall_title">Article Title</label>
                            </td>
                            <td>
                        <input id="recall_title" class="product_input" type="text" name="article_title" required autocomplete="off" value="<?php echo $row->article_title; ?>" />
                            </td>
                        </tr>
                       
                        <tr>
                            <td >
                                <label for="recall_desc">Article Content</label>
                            </td>
                            <td width="400">
                                <textarea id="recall_desc" class="product_input txtEditor" name="article_content"  ><?php echo $row->article_content; ?></textarea>
                            </td>
                        </tr>
                        
                         <tr>
                            <td>
                                <label for="article_img1">Article image 1</label>
                            </td>
                            <td>
                                <input id="article_img1" class="login_input" type="file" name="article_img1" /><br/>
                                <?php if($row->article_img1){ echo "<img src='../uploads/$row->article_img1' width='100' height='100' />"; } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="article_img2">Article image 2</label>
                            </td>
                            <td>
                                <input id="article_img2" class="login_input" type="file" name="article_img2" /><br/>
                                <?php if($row->article_img2){ echo "<img src='../uploads/$row->article_img2' width='100' height='100' />"; } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"> 
                            	<input type="hidden" name="article_id" value="<?php echo $row->article_id; ?>"  />                         
                                <input type="submit" name="article_edit" value="SUBMIT" />
                            </td>
                         </tr>
                         
                     </table>       
                </form>
      
	<?php
    
	}
	//
		else if($_POST['getdata']=="banner_editable_data"){
		
		require_once("../config/db.php");
		require_once("../classes/Article.php");
		$article = new Article();
		$articles=$article->getBanner($_POST['value']);
		$row=$articles->fetch_object();
		?>
		<div class="title"><h3>Edit banner image</h3></div>
            <form method="post" action="" enctype="multipart/form-data" >
                    <table style="margin: 0 auto;">
                    	
                         <tr>
                            <td>
                                <label for="article_img1">Banner image</label>
                            </td>
                            <td>
                                <input id="article_img1" class="login_input" type="file" name="banner_image" /><br/>
                                <?php if($row->banner_image){ echo "<img src='../uploads/$row->banner_image' width='200'  />"; } ?>
                            </td>
                        </tr>
                       
                        <tr>
                            <td colspan="2" align="center"> 
                            	<input type="hidden" name="banner_id" value="<?php echo $row->banner_id; ?>"  />                         
                                <input type="submit" name="banner_edit" value="SUBMIT" />
                            </td>
                         </tr>
                         
                     </table>       
                </form>
      
	<?php
    
	}
	//
		else if($_POST['getdata']=="category_editable_data"){
		
		require_once("../config/db.php");
		require_once("../classes/Media.php");
		$media = new Media();
		$cat_res=$media->getCategory($_POST['value']);
		$cat_row=$cat_res->fetch_object();
		?>
		<div class="title"><h3>Edit category</h3></div>
            <form method="post" action="" enctype="multipart/form-data" >
                    <table style="margin: 0 auto;">
                    	
                         <tr>
                            <td>
                                <label for="category_name">Category name</label>
                            </td>
                            <td>
                                <input id="category_name" class="login_input" type="text" name="category_name" value="<?php echo $cat_row->category_name; ?>" />
                               
                            </td>
                        </tr>
                       
                        <tr>
                            <td colspan="2" align="center"> 
                            	<input type="hidden" name="category_id" value="<?php echo $cat_row->category_id; ?>"  />                         
                                <input type="submit" name="category_edit" value="SUBMIT" />
                            </td>
                         </tr>
                         
                     </table>       
                </form>
      
	<?php
    
	}
	//
	//
		else if($_POST['getdata']=="media_editable_data"){
		
		require_once("../config/db.php");
		require_once("../classes/Media.php");
		$media = new Media();
		$medias=$media->getMedia($_POST['value']);
		$row=$medias->fetch_object();
		?>
		<div class="title"><h3>edit work Media</h3></div>
               
                <form method="post" action="" name="registerform" enctype="multipart/form-data" >
                    <table style="margin:0 auto">
                       
                       
                        <tr>
                            <td>
                                <label for="media_title">Media title</label>
                            </td>
                            <td>
                                <input id="media_title" class="product_input" type="text" name="media_title" required autocomplete="off" value="<?php echo $row->work_title; ?>" />
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
                                    <option value="<?php echo $cat_row->category_id ?>" <?php if($row->category_id==$cat_row->category_id){ echo "selected='selected'";} ?>><?php echo $cat_row->category_name ?></option>
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
                               		<option <?php if($row->work_type=="Image"){ echo "selected='selected'";} ?>>Image</option>
                                    <option <?php if($row->work_type=="Video"){ echo "selected='selected'";} ?>>Video</option>
                               </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="media_image">Media image</label>
                            </td>
                            <td>
                               <input id="media_image" class="product_input" name="media_img"  type="file" />
                              <?php if($row->work_image!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image2">Media image 2</label>
                            </td>
                            <td>
                               <input id="media_image2" class="product_input" name="media_img2"  type="file" />
                              <?php if($row->work_image2!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image2; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image3">Media image 3</label>
                            </td>
                            <td>
                               <input id="media_image3" class="product_input" name="media_img3"  type="file" />
                              <?php if($row->work_image3!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image3; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image4">Media image 4</label>
                            </td>
                            <td>
                               <input id="media_image4" class="product_input" name="media_img4"  type="file" />
                              <?php if($row->work_image4!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image4; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image5">Media image 5</label>
                            </td>
                            <td>
                               <input id="media_image5" class="product_input" name="media_img5"  type="file" />
                              <?php if($row->work_image5!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image5; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image6">Media image 6</label>
                            </td>
                            <td>
                               <input id="media_image6" class="product_input" name="media_img6"  type="file" />
                              <?php if($row->work_image6!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image6; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image7">Media image 7</label>
                            </td>
                            <td>
                               <input id="media_image7" class="product_input" name="media_img7"  type="file" />
                              <?php if($row->work_image7!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image7; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image8">Media image 8</label>
                            </td>
                            <td>
                               <input id="media_image8" class="product_input" name="media_img8"  type="file" />
                              <?php if($row->work_image8!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image8; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image9">Media image 9</label>
                            </td>
                            <td>
                               <input id="media_image9" class="product_input" name="media_img9"  type="file" />
                              <?php if($row->work_image9!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image9; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label for="media_image10">Media image 10</label>
                            </td>
                            <td>
                               <input id="media_image10" class="product_input" name="media_img10"  type="file" />
                              <?php if($row->work_image10!=""){ ?>
                              		<br />
                                	<img src='../uploads/<?php echo $row->work_image10; ?>' style=" max-width:120px"  />
                                 <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="media_link">Media link</label>
                            </td>
                            <td>
                               <input id="media_link" class="product_input" name="media_link"  type="text" value="<?php echo $row->work_link; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">  
                            	<input type="hidden" name="media_id" value="<?php echo $row->work_id; ?>"  />                            
                                <input type="submit" name="media_edit" value="SUBMIT" />
                                
                            </td>
                         </tr>
                         
                     </table>       
                </form>
	<?php
    
	}
	?>