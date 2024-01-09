<?php
//mysqli_report(MYSQLI_REPORT_ALL);
/**
* class Registration
* handles the user registration
*
* @author Panique <panique@web.de>
* @version 1.0
*/
class Media {

    private $db_connection = null; // database connection
    
  /*  private $user_name = ""; // user's name
    private $user_email = ""; // user's email
    private $user_password = ""; // user's password (what comes from POST)
    private $user_password_hash = ""; // user's hashed and salted password*/
    

    public $errors = array(); // collection of error messages
    public $messages = array(); // collection of success / neutral messages
    
    
    /**
* the function "__construct()" automatically starts whenever an object of this class is created,
* you know, when you do "$login = new Login();"
*/
    public function __construct() {
        
            if(isset($_POST["category_edit"])){
				$this->updateCategory();
			}
			 if(isset($_POST["category_add"])){
				$this->insertCategory();
			}
			if(isset($_POST["media_edit"])){
				$this->updateMedia();
			}
			if(isset($_POST["media_add"])){
				$this->insertMedia();
			}
			if(isset($_POST["media_del"])){
				$this->deleteMedia();
			}
			 if(isset($_POST["category_delete"])){
				$this->deleteCategory();
			}
			
    }

	//
	private function insertCategory() {
        
        if (empty($_POST['category_name'])) {
            $this->errors[] = "Empty Category name";
        } 
		elseif (!empty($_POST['category_name'])) {
			$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
                $cat_name = $this->db_connection->real_escape_string($_POST['category_name']);
				$num_rows=0;
				if ($stmt = $this->db_connection->prepare("SELECT category_name FROM work_categories WHERE category_name = ? ")) {
				/* bind parameters for markers */
					$stmt->bind_param("s",$cat_name);
					/* execute query */
					$stmt->execute();
					$stmt->store_result();
					$num_rows=$stmt->num_rows;
					/* close statement */
					$stmt->close();
				}
				if ($num_rows > 0) {

                    $this->errors[] = "Oops, that Category name is already added.<br/>Please add another one.";

                }
				else {
					$stmt = $this->db_connection->prepare("INSERT INTO work_categories (category_name) VALUES(?)");
					//$stmt->set_charset("utf8");
					$stmt->bind_param("s",$cat_name);
					$result=$stmt->execute();
					if($result){
						$this->messages[] = "New Category added successfully.";
					}
					else {
						$this->errors[] = "Sorry, Please go back and try again.";
					}
					//var_dump($result); var_dump($this->messages); var_dump($this->errors);
					$stmt->close();
			   		
				}
            }
			else {
                $this->errors[] = "Sorry, no database connection.";
            }
            
        }
		else {
            $this->errors[] = "An unknown error occured.";
        }
        
    }
	//
	private function insertMedia(){
		
        
        if (empty($_POST['media_title'])) {
            $this->errors[] = "Empty Media title";
        } 
		elseif (!empty($_POST['media_title'])) {
			$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
                $media_title = $this->db_connection->real_escape_string($_POST['media_title']);
                $category = $this->db_connection->real_escape_string($_POST['media_category']);
				$type = $this->db_connection->real_escape_string($_POST['media_type']);
				$link = $this->db_connection->real_escape_string($_POST['media_link']);
				$num_rows=0;
				if ($stmt = $this->db_connection->prepare("SELECT work_title FROM our_works WHERE work_title = ? ")) {
				/* bind parameters for markers */
					$stmt->bind_param("s",$media_title);
					/* execute query */
					$stmt->execute();
					$stmt->store_result();
					$num_rows=$stmt->num_rows;
					/* close statement */
					$stmt->close();
				}
				if ($num_rows > 0) {

                    $this->errors[] = "Oops, that work title is already added.<br/>Please add another one.";

                }
				else {
					$art_img="";
					$art_img2="";
					$art_img3="";
					$art_img4="";
					$art_img5="";
					$art_img6="";
					$art_img7="";
					$art_img8="";
					$art_img9="";
					$art_img10="";
					if($_FILES['media_img']['name']!=""){
						$path = $_FILES['media_img']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img'.$ext;
						$upload=$this->img_upload('media_img',$newname);
						if($upload){
							$art_img=$newname;
						}
					}
					//
					if($_FILES['media_img2']['name']!=""){
						$path = $_FILES['media_img2']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img2'.$path;
						$upload=$this->img_upload('media_img2',$newname);
						if($upload){
							$art_img2=$newname;
						}
					}
					//
					if($_FILES['media_img3']['name']!=""){
						$path = $_FILES['media_img3']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img3'.$path;
						$upload=$this->img_upload('media_img3',$newname);
						if($upload){
							$art_img3=$newname;
						}
					}
					//
					if($_FILES['media_img4']['name']!=""){
						$path = $_FILES['media_img4']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img4'.$path;
						$upload=$this->img_upload('media_img4',$newname);
						if($upload){
							$art_img4=$newname;
						}
					}
					//
					if($_FILES['media_img5']['name']!=""){
						$path = $_FILES['media_img5']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img5'.$path;
						$upload=$this->img_upload('media_img5',$newname);
						if($upload){
							$art_img5=$newname;
						}
					}
					//
					if($_FILES['media_img6']['name']!=""){
						$path = $_FILES['media_img6']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img6'.$path;
						$upload=$this->img_upload('media_img6',$newname);
						if($upload){
							$art_img6=$newname;
						}
					}
					//
					if($_FILES['media_img7']['name']!=""){
						$path = $_FILES['media_img7']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img7'.$path;
						$upload=$this->img_upload('media_img7',$newname);
						if($upload){
							$art_img7=$newname;
						}
					}
					//
					if($_FILES['media_img8']['name']!=""){
						$path = $_FILES['media_img8']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img8'.$path;
						$upload=$this->img_upload('media_img8',$newname);
						if($upload){
							$art_img8=$newname;
						}
					}
					//
					if($_FILES['media_img9']['name']!=""){
						$path = $_FILES['media_img9']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img9'.$path;
						$upload=$this->img_upload('media_img9',$newname);
						if($upload){
							$art_img9=$newname;
						}
					}
					//
					if($_FILES['media_img10']['name']!=""){
						$path = $_FILES['media_img10']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$newname = $media_title.'_img10'.$path;
						$upload=$this->img_upload('media_img10',$newname);
						if($upload){
							$art_img10=$newname;
						}
					}
					//////
					$stmt = $this->db_connection->prepare("INSERT INTO our_works (work_title,category_id,work_type,work_image,work_image2,work_image3,work_image4,work_image5,work_image6,work_image7,work_image8,work_image9,work_image10,work_link) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					//$stmt->set_charset("utf8");
					$stmt->bind_param("sissssssssssss",$media_title,$category,$type,$art_img,$art_img2,$art_img3,$art_img4,$art_img5,$art_img6,$art_img7,$art_img8,$art_img9,$art_img10,$link);
					$result=$stmt->execute();
					if($result){
						$this->messages[] = "New Media added successfully.";
					}
					else {
						$this->errors[] = "Sorry, Please go back and try again.";
					}
					//var_dump($result); var_dump($this->messages); var_dump($this->errors);
					$stmt->close();
			   		
				}
            }
			else {
                $this->errors[] = "Sorry, no database connection.";
            }
            
        }
		else {
            $this->errors[] = "An unknown error occured.";
        }
        
    
	}
	private function updateMedia(){
		if (empty($_POST['media_title'])) {
            $this->errors[] = "Empty Media title";
        } 
		 else{
		 	$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
                $media_title = $this->db_connection->real_escape_string($_POST['media_title']);
                $category = $this->db_connection->real_escape_string($_POST['media_category']);
				$type = $this->db_connection->real_escape_string($_POST['media_type']);
				$link = $this->db_connection->real_escape_string($_POST['media_link']);
				//
				//$media_title_arb = $this->db_connection->real_escape_string($_POST['media_title_arb']);
				//$media_content_arb =$_POST['media_content_arb'];
				//
				$media_id=$this->db_connection->real_escape_string($_POST['media_id']);
				//
				$img = $this->db_connection->query("SELECT work_image,work_image2,work_image3,work_image4,work_image5,work_image6,work_image7,work_image8,work_image9,work_image10 FROM our_works WHERE work_id=$media_id ");
				$image=$img->fetch_object();
				$art_img= $image->work_image;
				$art_img2= $image->work_image2;
				$art_img3= $image->work_image3;
				$art_img4= $image->work_image4;
				$art_img5= $image->work_image5;
				$art_img6= $image->work_image6;
				$art_img7= $image->work_image7;
				$art_img8= $image->work_image8;
				$art_img9= $image->work_image9;
				$art_img10= $image->work_image10;
				//$art_img2= $image->media_img2;
				
				///////////////////
				if($_FILES['media_img']['name']!=""){
					$newname = $media_title.'_img'.$_FILES['media_img']['name'];
					$upload=$this->img_upload('media_img',$newname);
					if($upload){
						$art_img=$newname;
					}
				}
				//
					if($_FILES['media_img2']['name']!=""){
						$newname = $media_title.'_img2'.$_FILES['media_img2']['name'];
						$upload=$this->img_upload('media_img2',$newname);
						if($upload){
							$art_img2=$newname;
						}
					}
					//
					if($_FILES['media_img3']['name']!=""){
						$newname = $media_title.'_img3'.$_FILES['media_img3']['name'];
						$upload=$this->img_upload('media_img3',$newname);
						if($upload){
							$art_img3=$newname;
						}
					}
					//
					if($_FILES['media_img4']['name']!=""){
						$newname = $media_title.'_img4'.$_FILES['media_img4']['name'];
						$upload=$this->img_upload('media_img4',$newname);
						if($upload){
							$art_img4=$newname;
						}
					}
					//
					if($_FILES['media_img5']['name']!=""){
						$newname = $media_title.'_img5'.$_FILES['media_img5']['name'];
						$upload=$this->img_upload('media_img5',$newname);
						if($upload){
							$art_img5=$newname;
						}
					}
					//
					if($_FILES['media_img6']['name']!=""){
						$newname = $media_title.'_img6'.$_FILES['media_img6']['name'];
						$upload=$this->img_upload('media_img6',$newname);
						if($upload){
							$art_img6=$newname;
						}
					}
					//
					if($_FILES['media_img7']['name']!=""){
						$newname = $media_title.'_img7'.$_FILES['media_img7']['name'];
						$upload=$this->img_upload('media_img7',$newname);
						if($upload){
							$art_img7=$newname;
						}
					}
					//
					if($_FILES['media_img8']['name']!=""){
						$newname = $media_title.'_img8'.$_FILES['media_img8']['name'];
						$upload=$this->img_upload('media_img8',$newname);
						if($upload){
							$art_img8=$newname;
						}
					}
					//
					if($_FILES['media_img9']['name']!=""){
						$newname = $media_title.'_img9'.$_FILES['media_img9']['name'];
						$upload=$this->img_upload('media_img9',$newname);
						if($upload){
							$art_img9=$newname;
						}
					}
					//
					if($_FILES['media_img10']['name']!=""){
						$newname = $media_title.'_img10'.$_FILES['media_img10']['name'];
						$upload=$this->img_upload('media_img10',$newname);
						if($upload){
							$art_img10=$newname;
						}
					}
					//////
				/*if($_FILES['media_img2']['name']!=""){
					$newname = $recall_title.'_img2'.$_FILES['media_img2']['name'];
					$upload=$this->img_upload('media_img2',$newname);
					if($upload){
						$art_img2=$newname;
					}
				}*/
				$stmt = $this->db_connection->prepare("UPDATE our_works SET work_title=?, category_id=?,work_image=?,work_image2=?,work_image3=?,work_image4=?,work_image5=?,work_image6=?,work_image7=?,work_image8=?,work_image9=?,work_image10=?,work_type=?,work_link=? WHERE work_id=?");
				$stmt->bind_param("sissssssssssssi",$media_title,$category,$art_img,$art_img2,$art_img3,$art_img4,$art_img5,$art_img6,$art_img7,$art_img8,$art_img9,$art_img10,$type,$link,$media_id);
				$result=$stmt->execute();
				if($result){
					$this->messages[] = "Selected media updated successfully.";
				}
				else {
					$this->errors[] = "Sorry, Please try again.";
				}
				$stmt->close();
			}
			else {
                $this->errors[] = "Sorry, no database connection.";
            }
			
		 }
		
	}
	///////////////////
	
	private function img_upload($fieldname,$img_name){ 
		// make a note of the current working directory, relative to root. 
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 
		// make a note of the directory that will recieve the uploaded file 
	//$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'uploads/'; 
		$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] .'/uploads/'; 
		// make a note of the location of the upload form in case we need it 
		//$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.form.php'; 
		// fieldname used within the file <input> of the HTML form 
		//$fieldname = 'user_logo'; 
		// Now let's deal with the upload 
		// possible PHP upload errors 
		$errors = array(1 => 'php.ini max file size exceeded', 
						2 => 'html form max file size exceeded', 
						3 => 'file upload was only partial', 
						4 => 'no file was attached');
		// check the upload form was actually submitted else print the form 
		// check for PHP's built-in uploading errors 
		//var_dump($uploadsDirectory);
		($_FILES[$fieldname]['error'] == 0) 
			or die ($errors[$_FILES[$fieldname]['error']]); 
		// check that the file we are working on really was the subject of an HTTP upload 
		@is_uploaded_file($_FILES[$fieldname]['tmp_name']) 
			or die('not an HTTP upload'); 
			//echo 'not an HTTP upload';
		// validation... since this is an image upload script we should run a check   
		// to make sure the uploaded file is in fact an image. Here is a simple check: 
		// getimagesize() returns false if the file tested is not an image. 
		@getimagesize($_FILES[$fieldname]['tmp_name']) 
			or die ('only image uploads are allowed'); 
			//echo 'only image uploads are allowed';
		// sample filename: 1140732936-filename.jpg 
		//$now = time();
		/*while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name'])) 
		{ 
			$now++; 
		} */
		$uploadFilename=$uploadsDirectory.$img_name;
		// now let's move the file to its final location and allocate the new filename to it 
		@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
			or die ('receiving directory insuffiecient permission'); 
			//echo 'receiving directory insuffiecient permission';
		// If you got this far, everything has worked and the file has been successfully saved. 
		// We are now going to redirect the client to a success page. 
		return true;
	} 
	//////////////////////////
	////////////////////our_works//////////////////////
	public function getMedia($val=NULL,$cat=NULL,$cat_name=NULL){
		$db_connection=db_connect();
		if (!$db_connection->connect_errno) {
			if($val!=NULL){
				$id=$db_connection->real_escape_string($val);
				$stmt = $db_connection->query("SELECT work_id, work_title,category_id, work_type,work_image,work_image2,work_image3,work_image4,work_image5,work_image6,work_image7,work_image8,work_image9,work_image10,work_link,work_order FROM our_works WHERE work_id=$id ");
			}
			else if($cat!=NULL){
				$id=$db_connection->real_escape_string($cat);
				$stmt = $db_connection->query("SELECT work_id, work_title,category_id, work_type,work_image,work_image2,work_image3,work_image4,work_image5,work_image6,work_image7,work_image8,work_image9,work_image10,work_link,work_order FROM our_works WHERE category_id=$id ORDER BY work_title");
			}
			else if($cat_name!=NULL){
				$cat_n=$db_connection->real_escape_string($cat_name);
				$stmt = $db_connection->query("SELECT work_id, work_title,w.category_id, work_type,work_image,work_image2,work_image3,work_image4,work_image5,work_image6,work_image7,work_image8,work_image9,work_image10,work_link,work_order FROM our_works w INNER JOIN work_categories c ON(w.category_id=c.category_id) WHERE category_name LIKE '%$cat_n%' ORDER BY work_title");
			}
			else{
				$stmt = $db_connection->query("SELECT work_id, work_title,category_id, work_type,work_image,work_image2,work_image3,work_image4,work_image5,work_image6,work_image7,work_image8,work_image9,work_image10,work_link,work_order FROM our_works ORDER BY category_id");
			}
				
			return $stmt;

			
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	//////////////////////////////////
		private function updateCategory(){
			if (!empty($_POST['category_name'])){
		 	$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
				$cat_id=$this->db_connection->real_escape_string($_POST['category_id']);
				$cat_name = $this->db_connection->real_escape_string($_POST['category_name']);
				
				$stmt = $this->db_connection->prepare("UPDATE work_categories SET category_name=? WHERE category_id=?");
				$stmt->bind_param("si",$cat_name,$cat_id);
				$result=$stmt->execute();
				if($result){
					$this->messages[] = "Selected category updated successfully.";
				}
				else {
					$this->errors[] = "Sorry, Please try again.";
				}
				$stmt->close();
			}
			else {
                $this->errors[] = "Sorry, no database connection.";
            }
			
		 }
		 else{
			 $this->errors[] = "Empty category name";	
		}
		
	}
	///////////////////
	public function getCategory($val=NULL){
		$db_connection=db_connect();
		if (!$db_connection->connect_errno) {
			if($val!=NULL){
				$id=$db_connection->real_escape_string($val);
				$stmt = $db_connection->query("SELECT category_id, category_name FROM work_categories WHERE category_id=$id ");
			}
			else{
				$stmt = $db_connection->query("SELECT category_id, category_name FROM work_categories ");
			}
				//$stmt->bind_param("ii",$retail,$cat);
				//$stmt->execute();
				//$stmt->store_result();
				//$mt=$stmt->num_rows;
				return $stmt;
					/* close statement */
					//$stmt->close();
			
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	/////////////////////////////////////////////////////////
	private function deleteCategory(){
		$this->db_connection=db_connect();
		if(!$this->db_connection->connect_errno) {
			 $val=$this->db_connection->real_escape_string($_POST['category_id']);
			 if($stmt = $this->db_connection->prepare("DELETE FROM work_categories WHERE category_id=? ")){
				  $stmt->bind_param("i",$val);
				  $result=$stmt->execute();
				  if($result){
					  $this->messages[] = "success";
				  }
				  else {
					  $this->errors[] = "Sorry, Please go back and try again.";
				  }
				  $stmt->close();
			}
			 
		}
	}
	/////////////////////////////////
	/////////////////////////////////////////////////////////
	private function deleteMedia(){
		$this->db_connection=db_connect();
		if(!$this->db_connection->connect_errno) {
			 $val=$this->db_connection->real_escape_string($_POST['media_id']);
			 if($stmt = $this->db_connection->prepare("DELETE FROM our_works WHERE work_id=? ")){
				  $stmt->bind_param("i",$val);
				  $result=$stmt->execute();
				  if($result){
					  $this->messages[] = "success";
				  }
				  else {
					  $this->errors[] = "Sorry, Please go back and try again.";
				  }
				  $stmt->close();
			}
			 
		}
	}
	/////////////////////////////////
}