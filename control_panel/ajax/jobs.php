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
            	$cont='<a onClick="view_job('.$row['job_id'].')" href="javascript:;">'.$d.'</a>';
				$shoot_date=strtotime($row['shoot_date']);
				if($row['job_status']==1){
					$cont.='<br/><span class="label label-success"><i class="fa fa-check"></i> Completed</span>';
				}
				else if(time() > $shoot_date){
					$cont.='<br/><span class="label label-warning"><i class="fa fa-clock-o"></i> Expired</span>';
				}
				return $cont;
        	}
	 ),
	 array('db' => 'shoot_date',   'dt' => 1),
    array( 'db' => 'job_location', 'dt' => 2),
    array( 	'db' => 'job_id',
			 'dt' => 3,
			 'formatter' => function( $d, $row ) {
            	return '<a onClick="view_job('.$d.')" href="javascript:;">Models Details</a>';
        	}
		),
	 array('db' => 'mail_status',   'dt' => 4,
	 		'formatter' => function( $d, $row ) {
				if($d==1){
					return '<span class="label label-success">Mail Sent</span>';
				}
				else
            	return '<form action="" method="post"><button type="button" onClick="send_mail(this)" class="btn">Send Mail</button><input type="hidden" name="job_id" value="'.$row['job_id'].'" /></form>';
        	}
	 ),	
	 array('db' => 'job_share',   'dt' => 5,
		  'formatter' => function( $d, $row ) {
			  $en_url=base64_encode("job_id=".$row['job_id']);
					return '<a href="http://flcmodels.com/view_job/?q='.$en_url.'" target="_blank">View Link</a>
					<br/>
					<a href="http://flcmodels.com/view_job/print.php?q='.$en_url.'" class="btn btn-warning" target="_blank">Save Page</a><br/>
					<a href="http://flcmodels.com/view-confirmed/?q='.$en_url.'" class="btn btn-success" target="_blank">View Confirmed</a>
					';
				}
	 ),	
	  array('db' => 'form_mail',   'dt' => 6,
	 		'formatter' => function( $d, $row ) {
				if($d==1){
					return '<span class="label label-success">Book Form Sent</span>';
				}
				else
            	return '<form action="" method="post"><button type="button" onClick="send_form(this)" class="btn">Send Book form</button><input type="hidden" name="job_form_id" value="'.$row['job_id'].'" /></form>';
        	}
	 ),	
    array('db' => 'job_status', 'dt' => 7 ,
		'formatter' => function( $d, $row ) {
            	return '<a href="edit-job.php?job_id='.$row['job_id'].'">Edit</a> &nbsp;&nbsp; <a href="javascript:;" onclick="removeItem('.$row['job_id'].')">Delete</a>';
        	}
	),
	array( 'db' => 'job_created_by', 'dt' => 8),
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