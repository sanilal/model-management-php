<?php
//mysqli_report(MYSQLI_REPORT_ALL);
/**
* class Registration
* handles the user registration
*
* @author Panique <panique@web.de>
* @version 1.0
*/
class Article {

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
        
            
			if(isset($_POST["article_edit"])){
				$this->updateArticle();
			}
			if(isset($_POST["banner_edit"])){
				$this->updateBanner();
			}
			if(isset($_POST["banner_add"])){
				$this->insertBanner();
			}
			if(isset($_POST["banner_delete"])){
				$this->deleteBanner();
			}
			
    }

	
	private function updateArticle(){
		if (empty($_POST['article_title'])) {
            $this->errors[] = "Empty Article title";
        } elseif (empty($_POST['article_content'])) {
            $this->errors[] = "Empty Article content";
        }
		 elseif (!empty($_POST['article_title'])
           && !empty($_POST['article_content'])){
		 	$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
                $article_title = $this->db_connection->real_escape_string($_POST['article_title']);
                $article_content = $_POST['article_content'];
				//
				//$article_title_arb = $this->db_connection->real_escape_string($_POST['article_title_arb']);
				//$article_content_arb =$_POST['article_content_arb'];
				//
				$article_id=$this->db_connection->real_escape_string($_POST['article_id']);
				//
				$img = $this->db_connection->query("SELECT article_img1,article_img2 FROM articles WHERE article_id=$article_id ");
				$image=$img->fetch_object();
				$art_img1= $image->article_img1;
				$art_img2= $image->article_img2;
				
				///////////////////
				if($_FILES['article_img1']['name']!=""){
					$newname = $article_title.'_img1'.$_FILES['article_img1']['name'];
					$upload=$this->img_upload('article_img1',$newname);
					if($upload){
						$art_img1=$newname;
					}
				}
				//
				if($_FILES['article_img2']['name']!=""){
					$newname = $article_title.'_img2'.$_FILES['article_img2']['name'];
					$upload=$this->img_upload('article_img2',$newname);
					if($upload){
						$art_img2=$newname;
					}
				}
				$stmt = $this->db_connection->prepare("UPDATE articles SET article_title=?, article_content=?,article_img1=?,article_img2=? WHERE article_id=?");
				$stmt->bind_param("ssssi",$article_title,$article_content,$art_img1,$art_img2,$article_id);
				$result=$stmt->execute();
				if($result){
					$this->messages[] = "Selected Article updated successfully.";
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
	////////////////////Articles//////////////////////
	public function getArticle($val=NULL){
		$db_connection=db_connect();
		if (!$db_connection->connect_errno) {
			if($val!=NULL){
				$id=$db_connection->real_escape_string($val);
				$stmt = $db_connection->query("SELECT article_id, article_title,article_page, article_content,article_img1,article_img2 FROM articles  WHERE article_id=$id ");
			}
			else{
				$stmt = $db_connection->query("SELECT article_id, article_title,article_page, article_content,article_img1,article_img2 FROM  articles ");
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
	//////////////////////////////////
		private function insertBanner(){
			if ($_FILES['banner_image']['name']!=""){
		 	$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
                //$banner_title = $this->db_connection->real_escape_string($_POST['banner_title']);
				$banner_title="";
				$banner_img="";
				//$banner_id=$this->db_connection->real_escape_string($_POST['banner_id']);
				$newname = 'bannerimg'.rand(5, 10).$_FILES['banner_image']['name'];
				$upload=$this->img_upload('banner_image',$newname);
				if($upload){
					$banner_img=$newname;
				}
				$stmt = $this->db_connection->prepare("INSERT INTO banner_images (banner_title, banner_image) VALUES(?,?)");
				$stmt->bind_param("ss",$banner_title,$banner_img);
				$result=$stmt->execute();
				if($result){
					$this->messages[] = "New Banner inserted successfully.";
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
	//////////////////////////////////
		private function updateBanner(){
			if ($_FILES['banner_image']['name']!=""){
		 	$this->db_connection=db_connect();
            if (!$this->db_connection->connect_errno) {
                //$banner_title = $this->db_connection->real_escape_string($_POST['banner_title']);
				$banner_title="";
				$banner_img="";
				$banner_id=$this->db_connection->real_escape_string($_POST['banner_id']);
				$newname = 'bannerimg'.$_FILES['banner_image']['name'];
				$upload=$this->img_upload('banner_image',$newname);
				if($upload){
					$banner_img=$newname;
				}
				$stmt = $this->db_connection->prepare("UPDATE banner_images SET banner_title=?, banner_image=? WHERE banner_id=?");
				$stmt->bind_param("ssi",$banner_title,$banner_img,$banner_id);
				$result=$stmt->execute();
				if($result){
					$this->messages[] = "Selected Banner updated successfully.";
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
	public function getBanner($val=NULL){
		$db_connection=db_connect();
		if (!$db_connection->connect_errno) {
			if($val!=NULL){
				$id=$db_connection->real_escape_string($val);
				$stmt = $db_connection->query("SELECT banner_id, banner_title,banner_image FROM banner_images  WHERE banner_id=$id ");
			}
			else{
				$stmt = $db_connection->query("SELECT banner_id, banner_title,banner_image FROM  banner_images ");
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
	//
	private function deleteBanner(){
		$this->db_connection=db_connect();
		if(!$this->db_connection->connect_errno) {
			 $val=$this->db_connection->real_escape_string($_POST['banner_id']);
			 if($stmt = $this->db_connection->prepare("DELETE FROM banner_images WHERE banner_id=? ")){
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
}