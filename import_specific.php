<?php
header("Cache-Control: no-cache, must-revalidate");
/*$sql = "LOAD DATA INFILE 'test.csv'
        INTO TABLE calldetections
        FIELDS TERMINATED BY ','
        OPTIONALLY ENCLOSED BY '\"' 
        LINES TERMINATED BY ',,,\\r\\n'
        IGNORE 1 LINES 
        (@date, name, type, @number, @duration, @addr, @pin, @city, @state, @country, lat, log)
        SET date = STR_TO_DATE(@date, '%b-%d-%Y %h:%i:%s %p'),
            number = TRIM(BOTH '\'' FROM @number),
            duration = 1 * TRIM(TRAILING 'Secs' FROM @duration),
            addr = NULLIF(@addr, 'null'),
            pin  = NULLIF(@pin, 'null'),
            city = NULLIF(@city, 'null'),
            state = NULLIF(@state, 'null'),
            country = NULLIF(@country, 'null') ";*/
			
//
define("DB_HOST", "p:localhost");

/** name of the database. please note: database and database table are not the same thing! */
define("DB_NAME", "models_com");

/** user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
/** By the way, it's bad style to use "root", but for development it will work */
define("DB_USER", "models_com");

/** The password of the above user */
define("DB_PASS", "KXwEax4iNew");
clearstatcache();
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db_connection->set_charset("utf8");
//$sql1="TRUNCATE TABLE Smart_FLC_Resource_Details";
$flc_id=$_GET['flc_id'];
//echo $_SERVER['DOCUMENT_ROOT']."/DirectUpload_specific/".$flc_id."csv";
$sql1="DELETE FROM Smart_FLC_Resource_Details WHERE Resource_ID='$flc_id'";
$sql = "LOAD DATA LOCAL INFILE '".$_SERVER['DOCUMENT_ROOT']."/DirectUpload_specific/$flc_id.csv'
        INTO TABLE Smart_FLC_Resource_Details
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"' 
        LINES TERMINATED BY '\r\n'
        IGNORE 1 LINES 	(Resource_Id,Resource_Type,Sub_Category,First_Name,Gender,Age,Ethnicity,Client_Id,Height,Bust,Waist,Hips,HairColor,SkinColor,ShoesSize,EyesColor,Native_Language,Languages_Spoken,In_Town_Status,Status,@Date_Created_var,Created_By,@Date_Modified_var,Modified_By,Salutation,Middle_Name,Last_Name,Position,Department,Division,Company_Name,Main_phone,Fax,Cell_phone,Email1,Email2,Email3,Description,Address,City,State,Zip,Country,Nationality,@DOB_var,Emirates,out_of_town,DressSize,Weight,Communication,years_of_experience,Brands_worked_with,HealthCardNo,@HealthCardExpiry_var,LabourCardNo,@LabourCardExpiry_var,ReadAccess,FullAccess,@DateLastContacted_var)
		SET 
		Date_Created = STR_TO_DATE(@Date_Created_var, '%m/%d/%Y '),
		Date_Modified = STR_TO_DATE(@Date_Modified_var, '%m/%d/%Y '),
		DOB = STR_TO_DATE(@DOB_var, '%m/%d/%Y '),
		HealthCardExpiry = STR_TO_DATE(@HealthCardExpiry_var, '%m/%d/%Y '),
		LabourCardExpiry = STR_TO_DATE(@LabourCardExpiry_var, '%m/%d/%Y '),
		DateLastContacted = STR_TO_DATE(@DateLastContacted_var, '%m/%d/%Y ');
       ";
$stmt1 = $db_connection->query($sql1);
$stmt = $db_connection->query($sql);
var_dump($stmt);
echo $db_connection->error;
if($stmt){
	echo "success";
}
else{ echo "failed";}

//echo "DirectUpload_specific/$flc_id.csv";
unlink("DirectUpload_specific/$flc_id.csv");

/*$stmt=$db_connection->query("SELECT * FROM  nvcpj_content  ");
var_dump($stmt);
echo $db_connection->error;
$row=$stmt->fetch_object();
var_dump($row);*/
		
			?>