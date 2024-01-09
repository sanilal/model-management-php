<?php
error_reporting(0);
/**
* class Login
* handles the user login/logout/session
*
* @author Panique <panique@web.de>
* @version 1.2
*/
class Login {

    private $db_connection = null; // database connection
    
    private $user_name = ""; // user's name
    private $user_email = ""; // user's email
    private $user_password_hash = ""; // user's hashed and salted password
    private $app_user_is_logged_in = false; // status of login

    public $errors = array(); // collection of error messages
    public $messages = array(); // collection of success / neutral messages
    
    
    /**
* the function "__construct()" automatically starts whenever an object of this class is created,
* you know, when you do "$login = new Login();"
*/
    public function __construct() {
        ob_start();
        // create/read session
        session_start();

        // check the possible login actions:
        // 1. logout (happen when user clicks logout button)
        // 2. login via session data (happens each time user opens a page on your php project AFTER he has sucessfully logged in via the login form)
        // 3. login via post data, which means simply logging in via the login form. after the user has submit his login/password successfully, his
        // logged-in-status is written into his session data on the server. this is the typical behaviour of common login scripts.
        
        // if user tried to log out
        if (isset($_GET["logout"])) {

            $this->doLogout();
                    
        }
        // if user has an active session on the server
        elseif (!empty($_SESSION['app_user_email']) && ($_SESSION['app_user_logged_in'] == 1)) {

            $this->loginWithSessionData();

        // if user just submitted a login form
        } elseif (isset($_POST["login"])) {

                $this->loginWithPostData();
                
        }
    }
    

    private function loginWithSessionData() {
        
        // set logged in status to true, because we just checked for this:
        // !empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)
        // when we called this method (in the constructor)
        $this->app_user_is_logged_in = true;
        
    }
    

    private function loginWithPostData() {
        
        // if POST data (from login form) contains non-empty user_name and non-empty user_password
        if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            
            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = db_connect();
            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                
                // escape the POST stuff
                $this->user_name = $this->db_connection->real_escape_string($_POST['user_name']);
				
                // database query, getting all the info of the selected user
		$checklogin = $this->db_connection->query("SELECT user_id,user_name, user_email, user_pass, user_role FROM lcfd_users_login WHERE (user_name = '".$this->user_name."' or user_email = '".$this->user_name."') && user_role > 2");
				
                // if this user exists
				//var_dump($this->db_connection); 
                if ($checklogin->num_rows > 0) {
	//echo "keri";  exit;
                    // get result row (as an object)
                    $result_row = $checklogin->fetch_object();

                    // using PHP's crypt function to
                    // this is currently (afaik) the best way to check passwords in login processes with PHP/SQL
                    if (md5($_POST['user_password']) == $result_row->user_pass) {
                        // write user data into PHP SESSION [a file on your server]
                        $_SESSION['app_user_name'] = $result_row->user_name;
                        $_SESSION['app_user_email'] = $result_row->user_email;
                        $_SESSION['app_user_logged_in'] = 1;
						$_SESSION['app_user_role']=$result_row->user_role;
						$_SESSION['app_user_id']=$result_row->user_id;

                        // set the login status to true
                        $this->app_user_is_logged_in = true;
						$this->user_log($result_row->user_id);

                    } else {

                        $this->errors[] = "Wrong password. Try again.";

                    }

                } else {

                    $this->errors[] = "This user does not exist.";
                }
                
            } else {
                
                $this->errors[] = "Database connection problem.";
            }
            
        } elseif (empty($_POST['user_name'])) {

            $this->errors[] = "Username field was empty.";

        } elseif (empty($_POST['user_password'])) {

            $this->errors[] = "Password field was empty.";
        }
        
    }
    
    /**
* perform the logout
*/
    public function doLogout() {
            
            $_SESSION['app_user_name'] = false;
			$_SESSION['app_user_email'] =false;
			$_SESSION['app_user_logged_in'] = false;
			$_SESSION['app_user_role']=false;
			$_SESSION['app_user_id']=false;
            session_destroy();
            $this->app_user_is_logged_in = false;
            $this->messages[] = "You have been logged out.";
            
    }
    
    /**
* simply return the current state of the user's login
* @return boolean user's login status
*/
    public function isUserLoggedIn() {
        
        return $this->app_user_is_logged_in;
        
    }
	
	//////////////////
	private function user_log($id) {
		 $this->db_connection = db_connect();
		 if ($stmt = $this->db_connection->prepare("INSERT INTO user_log (user_id,login_date) VALUES(?,?)")) {
		  /* bind parameters for markers */
		 	 $cur_date=date('Y-m-d H:i:s');
			  $stmt->bind_param("is",$id,$cur_date);
			  /* execute query */
			  $result=$stmt->execute();
			  /* close statement */
			  $stmt->close();
		  }
	}
	/////////////////
	public function userlastUpdate($id) {
        $this->db_connection = db_connect();
		$val = $this->db_connection->real_escape_string($id);
		$stmt=$this->db_connection->query("SELECT user_id,pr_log_date FROM product_log WHERE user_id=$val ORDER BY pr_log_date DESC LIMIT 0,1");
		return $stmt;
        
    }
//////////////////////////////
	 public function getUserData($id) {

		 //
          $this->db_connection = db_connect();  

		$val = $this->db_connection->real_escape_string($id);
		
		$stmt=$this->db_connection->query("SELECT user_id,user_name, user_email,user_role,signature FROM lcfd_users_login WHERE user_id=$val");
		
		return $stmt;
            
    }
    
}