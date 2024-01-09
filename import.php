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
define("DB_HOST", "localhost");

/** name of the database. please note: database and database table are not the same thing! */
define("DB_NAME", "models_com");

/** user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
/** By the way, it's bad style to use "root", but for development it will work */
define("DB_USER", "models_com");

/** The password of the above user */
define("DB_PASS", "KXwEax4i");
clearstatcache();
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db_connection->set_charset("utf8");
$sql1="TRUNCATE TABLE Smart_FLC_Resource_Details";
$sql = "LOAD DATA LOCAL INFILE '".$_SERVER['DOCUMENT_ROOT']."/DirectUpload/flc.csv'
        INTO TABLE Smart_FLC_Resource_Details
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"' 
        LINES TERMINATED BY '\r\n'
        IGNORE 1 LINES 
       ";
$stmt1 = $db_connection->query($sql1);
$stmt = $db_connection->query($sql);
var_dump($stmt);
echo $db_connection->error;
if($stmt){
	echo "success";
}
else{ echo "failed";}

/*$stmt=$db_connection->query("SELECT * FROM  nvcpj_content  ");
var_dump($stmt);
echo $db_connection->error;
$row=$stmt->fetch_object();
var_dump($row);*/
		
			?>