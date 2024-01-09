<?php

/**
* Configuration file for: Database Connection
* This is the place where your database login constants are saved
*
* For more info about constants please @see http://php.net/manual/en/function.define.php
* If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
*/


/** database host, usually it's "127.0.0.1" or "localhost", some servers also need port info, like "127.0.0.1:8080" */
define("DB_HOST", "p:localhost");

/** name of the database. please note: database and database table are not the same thing! */
define("DB_NAME", "flcmodels_com");

/** user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
/** By the way, it's bad style to use "root", but for development it will work */
define("DB_USER", "flcmodels_com");

/** The password of the above user */
define("DB_PASS", "KXwEax4iNew");

define("image_path", "FLC_Resource_Image_Folders/");

function db_connect(){
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$db_connection->set_charset("utf8");
	return $db_connection;
}
