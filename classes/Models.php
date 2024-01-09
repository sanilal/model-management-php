<?php
class Models {

    private $db_connection = null; // database connection
    
  /*  private $user_name = ""; // user's name
    private $user_email = ""; // user's email
    private $user_password = ""; // user's password (what comes from POST)
    private $user_password_hash = ""; // user's hashed and salted password*/
    

    public $errors = array(); // collection of error messages
    public $messages = array(); // collection of success / neutral messages
    public $limit=60;
    
    /**
* the function "__construct()" automatically starts whenever an object of this class is created,
* you know, when you do "$login = new Login();"
*/
    public function __construct() {
        
           /* if (isset($_POST["model_add"])) {
                
                $this->insertNewModel();
                
            }*/
    }

    /**
* registerNewUser
*
* handles the entire registration process. checks all error possibilities, and creates a new user in the database if
* everything is fine
*/
    private function insertNewModel() {
	}
	///////////////////////////////////////////////
	public function getModels($type=NULL,$id=NULL,$gend=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			if ($gend!=NULL){
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor, SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE Gender='$gend' && Resource_Type LIKE '%$type%' LIMIT 0,27 ");
			}
			elseif($id!=NULL){
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE Resource_ID='$id' " );
			} 
			else{
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE Resource_Type LIKE '%$type%' ORDER BY Resource_ID DESC LIMIT 0,27" );
			}
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	////////////////////////
	public function getKidModels($eth=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			$eth_str=implode("', '", $eth);
			$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE Resource_Type LIKE '%Kids%' && Ethnicity IN('$eth_str') LIMIT 0,27 ");
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}   
	}
	///////////////////////
	public function searchModels($type,$gend,$age=NULL,$eth=NULL,$name=""){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			//
			/*$in_town_q=="";
			if($in_town=="Yes"){
				$in_town_q=" && In_Town_Status!='No' ";
			}
			else if($in_town=="No"){
				$in_town_q=" && In_Town_Status!='Yes' ";
			}*/
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$no_limit=$this->limit;
			$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT 0,".$no_limit;
			if(isset($_REQUEST['page'])){
				$page=$_REQUEST['page']-1;
				$page=$page*$no_limit;
				$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT ".$page.",".$no_limit;
			}
			//
			if($eth!=NULL){
				//$eth_str=implode("', '", $eth);
				$eth_str="";
				foreach($eth as $ethn){
					$eth_str.=" Ethnicity Like '%".$ethn."%' ||";
				}
				$eth_str_new=substr($eth_str, 0, -2);
				if($age!=NULL){
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && Age BETWEEN ".$age." && (".$eth_str_new.") && Resource_Type LIKE '%$type%' ".$page_query);
				}
				else{
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && (".$eth_str_new.") && Resource_Type LIKE '%$type%' ".$page_query);
				}
			}
			else{
				if($age!=NULL){
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && Age BETWEEN ".$age." && Resource_Type LIKE '%$type%' ".$page_query);
				}
				else{
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && Resource_Type LIKE '%$type%' ".$page_query);
					
				}
			}
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	
	///////////////////////////////////////////
	public function paginateResult($type,$gend,$age=NULL,$eth=NULL,$name=""){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			//
			/*$in_town_q=="";
			if($in_town=="Yes"){
				$in_town_q=" && In_Town_Status!='No' ";
			}
			else if($in_town=="No"){
				$in_town_q=" && In_Town_Status!='Yes' ";
			}*/
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$page_query=$in_town_q."ORDER BY First_Name ASC";
			//
			if($eth!=NULL){
				//$eth_str=implode("', '", $eth);
				$eth_str="";
				foreach($eth as $ethn){
					$eth_str.=" Ethnicity Like '%".$ethn."%' ||";
				}
				$eth_str_new=substr($eth_str, 0, -2);
				if($age!=NULL){
					$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && Age BETWEEN ".$age." && (".$eth_str_new.") && Resource_Type LIKE '%$type%' ".$page_query);
				}
				else{
					$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && (".$eth_str_new.") && Resource_Type LIKE '%$type%' ".$page_query);
				}
			}
			else{
				if($age!=NULL){
					$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && Age BETWEEN ".$age." && Resource_Type LIKE '%$type%' ".$page_query);
				}
				else{
					$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' && Resource_Type LIKE '%$type%' ".$page_query);
				}
			}
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	
	/////////////////////////////
	
	
	
	
	
	
	
	
	
	
	
	
	
	///////////////////////////////
	public function searchSpModels($type,$name="",$cat=""){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$no_limit=$this->limit;
			$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT 0,".$no_limit;
			if(isset($_REQUEST['page'])){
				$page=$_REQUEST['page']-1;
				$page=$page*$no_limit;
				$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT ".$page.",".$no_limit;
			}
			//
			if($cat!=""){
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Sub_Category LIKE '%$cat%' && Resource_Type LIKE '%$type%' ".$page_query);
			}
			else{
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Resource_Type LIKE '%$type%' ".$page_query);
			}
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	//////////////////
	///
	public function paginateSpResult($type,$name="",$cat=""){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$page_query=$in_town_q."ORDER BY First_Name ASC";
			if($cat!=""){
				$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Resource_Type LIKE '%$type%' && Sub_Category LIKE '%$cat%' ".$page_query);
			}
			else{
				$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Resource_Type LIKE '%$type%' ".$page_query);
			}
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	///
	
	
	///////////////////////
	public function searchHost($type,$gend,$age=NULL,$eth=NULL,$name="",$lang=NULL,$cat=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
		
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$no_limit=$this->limit;
			if($type=="Model" && !isset($_REQUEST['page'])){
				$page_query=$in_town_q."ORDER BY First_Name ASC";
			}
			else{
				$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT 0,".$no_limit;
			}
			if(isset($_REQUEST['page'])){
				$page=$_REQUEST['page']-1;
				$page=$page*$no_limit;
				$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT ".$page.",".$no_limit;
			}
			//
			if($eth!=NULL){
				$eth_str="";
				foreach($eth as $ethn){
					$eth_str.=" Ethnicity Like '%".$ethn."%' ||";
				}
				$eth_str_new="&& (".substr($eth_str, 0, -2).")";
			}
			else{
				$eth_str_new="";	
			}
			//
			if($age!=NULL){
				$age_query="&& Age BETWEEN ".$age;
			}
			else{$age_query=""; }
			if($cat!=NULL){
				if($cat=="NOTIN"){
					$cat_query="&& Sub_Category NOT LIKE '%Internationals%'";
				}
				else $cat_query="&& Sub_Category LIKE '%".$cat."%'";
			}
			else{$cat_query=""; }
			//
			if($lang!=NULL){
				$lang_str="";
				foreach($lang as $langn){
					$lang_str.=" Native_Language Like '%".$langn."%' || Languages_Spoken Like '%".$langn."%' ||";
				}
				$lang_str_new="&& (".substr($lang_str, 0, -2).")";
			}
			else{ $lang_str_new=""; }
			//
			
			$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' ".$age_query." ".$eth_str_new." ".$lang_str_new." ".$cat_query." && Resource_Type LIKE '%$type%' ".$page_query);
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	
	///////////////////////////////////////////
	public function paginateHostResult($type,$gend,$age=NULL,$eth=NULL,$name="",$lang=NULL,$cat=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$page_query=$in_town_q."ORDER BY First_Name ASC";
			//
			if($eth!=NULL){
				$eth_str="";
				foreach($eth as $ethn){
					$eth_str.=" Ethnicity Like '%".$ethn."%' ||";
				}
				$eth_str_new="&& (".substr($eth_str, 0, -2).")";
			}
			else{
				$eth_str_new="";	
			}
			//
			if($age!=NULL){
				$age_query="&& Age BETWEEN ".$age;
			}
			else{$age_query=""; }
			//
			if($cat!=NULL){
				if($cat=="NOTIN"){
					$cat_query="&& Sub_Category NOT LIKE '%Internationals%'";
				}
				else $cat_query="&& Sub_Category LIKE '%".$cat."%'";
			}
			else{$cat_query=""; }
			//
			if($lang!=NULL){
				$lang_str="";
				foreach($lang as $langn){
					$lang_str.=" Native_Language Like '%".$langn."%' || Languages_Spoken Like '%".$langn."%' ||";
				}
				$lang_str_new="&& (".substr($lang_str, 0, -2).")";
			}
			else{ $lang_str_new=""; }
			
			$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%')  && Gender='$gend' ".$age_query." ".$eth_str_new." ".$lang_str_new." ".$cat_query." && Resource_Type LIKE '%$type%' ".$page_query);
				
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	
	/////////////////////////////
	//////////////////
	///////////////////////////////////////////////
	public function getallGender(){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			if ($stmt = $this->db_connection->query("SELECT DISTINCT Gender FROM Smart_FLC_Resource_Details ")){
				return $stmt;
			}else {
				$this->errors[] = "Sorry, Please go back and try again.";
			}
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	
	///////////////////////////////////////////
	///////////////////////////////////////////////
	public function getallAge($type=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			if ($stmt = $this->db_connection->query("SELECT DISTINCT Age FROM Smart_FLC_Resource_Details WHERE Age !='' && Age !='0' && Resource_Type LIKE '%$type%' ORDER BY Age ASC")){
				return $stmt;
			}else {
				$this->errors[] = "Sorry, Please go back and try again.";
			}
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	
	///////////////////////////////////////////
	public function getallEthnicity($type=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			if ($stmt = $this->db_connection->query("SELECT DISTINCT Ethnicity FROM Smart_FLC_Resource_Details WHERE Ethnicity NOT LIKE '%,%' && Resource_Type LIKE '%$type%' ORDER BY Ethnicity ASC")){
				return $stmt;
			}else {
				$this->errors[] = "Sorry, Please go back and try again.";
			}
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	//////////////////////////////////////
	///////////////////////////////////////////
	public function getallLang($type=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			if ($stmt = $this->db_connection->query("SELECT DISTINCT Native_Language FROM Smart_FLC_Resource_Details WHERE Native_Language NOT LIKE '%,%' && Resource_Type LIKE '%$type%' ORDER BY Native_Language ASC")){
				return $stmt;
			}else {
				$this->errors[] = "Sorry, Please go back and try again.";
			}
		} else {
			$this->errors[] = "Sorry, no database connection.";
		}      
	}
	//////////////////////////////////////
	/////////
	public function getImageFolder($id){
		if($id!=NULL){
			$str = $id;
		    preg_match("/([0-9]+[\.,]?)+/",$str,$matches);
		    $val = $matches[0];
			$flder_no=ceil($val/100);
			return str_pad($flder_no, 2, "0", STR_PAD_LEFT); 
			
		}
		
	}
	
	///////////////////
	////////
	////
	public function searchAny($gend=NULL,$age=NULL,$eth=NULL,$name="",$lang=NULL,$cat=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
		
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$no_limit=$this->limit;
			if($type=="Model" && !isset($_REQUEST['page'])){
				$page_query=$in_town_q."ORDER BY First_Name ASC";
			}
			else{
				$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT 0,".$no_limit;
			}
			if(isset($_REQUEST['page'])){
				$page=$_REQUEST['page']-1;
				$page=$page*$no_limit;
				$page_query=$in_town_q."ORDER BY First_Name ASC LIMIT ".$page.",".$no_limit;
			}
			//
			if($eth!=NULL){
				$eth_str="";
				foreach($eth as $ethn){
					$eth_str.=" Ethnicity Like '%".$ethn."%' ||";
				}
				$eth_str_new="&& (".substr($eth_str, 0, -2).")";
			}
			else{
				$eth_str_new="";	
			}
			//
			if($age!=NULL){
				$age_query="&& Age BETWEEN ".$age;
			}
			else{$age_query=""; }
			//
			if($gend!=""){
				$gend_query="&& Gender='$gend' ";
			}
			else{ $gend_query="";}
			//
			if($cat!=NULL){
				if($cat=="NOTIN"){
					$cat_query="&& Sub_Category NOT LIKE '%Internationals%'";
				}
				else $cat_query="&& Sub_Category LIKE '%".$cat."%'";
			}
			else{$cat_query=""; }
			//
			if($lang!=NULL){
				$lang_str="";
				foreach($lang as $langn){
					$lang_str.=" Native_Language Like '%".$langn."%' || Languages_Spoken Like '%".$langn."%' ||";
				}
				$lang_str_new="&& (".substr($lang_str, 0, -2).")";
			}
			else{ $lang_str_new=""; }
			//
			$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,SkinColor,Status,Date_Created,Created_By,Date_Modified,Modified_By,In_Town_Status FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%') ".$gend_query." ".$age_query." ".$eth_str_new." ".$lang_str_new." ".$cat_query."  ".$page_query);
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	
	///////////////////////////////////////////
	public function paginateAnyResult($gend=NULL,$age=NULL,$eth=NULL,$name="",$lang=NULL,$cat=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			
			$in_town_q=" && In_Town_Status!='No' ";
			//$in_town_q="";
			$page_query=$in_town_q."ORDER BY First_Name ASC";
			//
			if($eth!=NULL){
				$eth_str="";
				foreach($eth as $ethn){
					$eth_str.=" Ethnicity Like '%".$ethn."%' ||";
				}
				$eth_str_new="&& (".substr($eth_str, 0, -2).")";
			}
			else{
				$eth_str_new="";	
			}
			//
			if($age!=NULL){
				$age_query="&& Age BETWEEN ".$age;
			}
			else{$age_query=""; }
			//
			if($gend!=""){
				$gend_query="&& Gender='$gend' ";
			}
			else{ $gend_query="";}
			//
			if($cat!=NULL){
				if($cat=="NOTIN"){
					$cat_query="&& Sub_Category NOT LIKE '%Internationals%'";
				}
				else $cat_query="&& Sub_Category LIKE '%".$cat."%'";
			}
			else{$cat_query=""; }
			//
			if($lang!=NULL){
				$lang_str="";
				foreach($lang as $langn){
					$lang_str.=" Native_Language Like '%".$langn."%' || Languages_Spoken Like '%".$langn."%' ||";
				}
				$lang_str_new="&& (".substr($lang_str, 0, -2).")";
			}
			else{ $lang_str_new=""; }
			
			$stmt = $this->db_connection->query("SELECT count(Resource_ID) as total FROM Smart_FLC_Resource_Details WHERE  (First_Name LIKE '%$name%' || Resource_ID LIKE '%$name%') ".$gend_query." ".$age_query." ".$eth_str_new." ".$lang_str_new." ".$cat_query." ".$page_query);
				
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	/////////
	///////////////
	///////////////////
	
	
}