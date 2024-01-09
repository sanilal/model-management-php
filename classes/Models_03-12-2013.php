<?php
class Models {

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
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor, Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Gender='$gend' && Resource_Type LIKE '%$type%' LIMIT 0,27 ");
			}
			elseif($id!=NULL){
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Resource_ID='$id' " );
			} 
			else{
				$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Resource_Type LIKE '%$type%' ORDER BY Resource_ID DESC LIMIT 0,27" );
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
			$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Resource_Type LIKE '%Kids%' && Ethnicity IN('$eth_str') LIMIT 0,27 ");
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}   
	}
	///////////////////////
	public function searchModels($type,$gend,$age=NULL,$eth=NULL){
		$this->db_connection=db_connect();
		if (!$this->db_connection->connect_errno) {
			if($eth!=NULL){
				$eth_str=implode("', '", $eth);
				if($age!=NULL){
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Gender='$gend' && Age='$age' && Ethnicity IN('$eth_str') && Resource_Type LIKE '%$type%' LIMIT 0,27 ");
				}
				else{
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Gender='$gend' && Ethnicity IN('$eth_str') && Resource_Type LIKE '%$type%' LIMIT 0,27 ");
				}
			}
			else{
				if($age!=NULL){
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Gender='$gend' && Age='$age' && Resource_Type LIKE '%$type%' LIMIT 0,27 ");
				}
				else{
					$stmt = $this->db_connection->query("SELECT Resource_ID,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_ID,Height,Bust,Waist,Hips,HairColor,ShoesSize,EyesColor,Status,Date_Created,Created_By,Date_Modified,Modified_By FROM Smart_FLC_Resource_Details WHERE Gender='$gend' && Resource_Type LIKE '%$type%' LIMIT 0,27 ");
				}
			}
			return $stmt;
			$this->errors[] = "Sorry, Please go back and try again.";
		}else {
			$this->errors[] = "Sorry, no database connection.";
		}    
		
	}
	
	///////////////////////////////////////////
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
	
}