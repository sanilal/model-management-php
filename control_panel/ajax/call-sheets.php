<?php  
ob_start();
include("../includes/conn.php"); 
/*$sql="select * from `".TB_pre."Smart_FLC_Resource_Details` ORDER BY Resource_ID";
$r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));
$data=array();
while($res = mysqli_fetch_array($r1)){ 
	$sub_folder=getImageFolder($res['Resource_ID']);
	$test_path=glob("../".image_path.$sub_folder."/".$res['Resource_ID']."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
	$img_path='<img src="'.ltrim($test_path[0],"../").'" width="100" />';
	$data[]=array(
					'Resource_ID' => $res['Resource_ID'],
					'name' => $res['First_Name'],
					'image' => $img_path,
					'category' => $res['Resource_Type'],
					'status' => $res['Status'],
					'action' => "<a href='#'>action</a>"
			);
					
  }*/
function get_fullName($val){
	global $url;
	  $model=mysqli_fetch_object(mysqli_query($url,"select `First_Name`, `Last_Name` from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$val."'"));
	  //var_dump($val);
	  //var_dump($model);
	  //var_dump($url);
	  //echo "select `First_Name`, `Last_Name` from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$val."'";
	  return $model->First_Name." ".$model->Last_Name;
	  //return $model;
}

// DB table to use
$table = 'Smart_FLC_jobs';
 
// Table's primary key
$primaryKey = 'job_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'job_title', 'dt' => 0,
			'formatter' => function( $d, $row ) {
            	return '<a onClick="view_sheet('.$row['job_id'].')" href="javascript:;">'.$d.'</a>';
        	}
	 ),
	 array('db' => 'shoot_date',   'dt' => 1),
    array( 'db' => 'client_budget', 'dt' => 2),
    array( 	'db' => 'job_id',
			 'dt' => 3,
			 'formatter' => function( $d, $row ) {
            	return '<a onClick="view_sheet('.$d.')" href="javascript:;">Models Payouts</a>';
        	}
		),
	 
	 
    array('db' => 'job_desc', 'dt' => 4 ,
		'formatter' => function( $d, $row ) {
            	return '<a href="edit-sheet.php?job_id='.$row['job_id'].'">Edit</a> ';
        	}
	),
	array( 'db' => 'job_created_by', 'dt' => 5),
	array( 'db' => 'job_status', 'dt' => 6),
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'flcmodels_com',
    'pass' => 'KXwEax4iNew',
    'db'   => 'flcmodels_com',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>