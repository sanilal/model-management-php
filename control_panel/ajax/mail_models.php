<?php  
ob_start();
include("../includes/conn.php"); 
/*$sql="select * from `".TB_pre."Smart_FLC_Resource_Details` ORDER BY Mailer_ID";
$r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));
$data=array();
while($res = mysqli_fetch_array($r1)){ 
	$sub_folder=getImageFolder($res['Mailer_ID']);
	$test_path=glob("../".image_path.$sub_folder."/".$res['Mailer_ID']."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
	$img_path='<img src="'.ltrim($test_path[0],"../").'" width="100" />';
	$data[]=array(
					'Mailer_ID' => $res['Mailer_ID'],
					'name' => $res['First_Name'],
					'image' => $img_path,
					'category' => $res['Resource_Type'],
					'status' => $res['Status'],
					'action' => "<a href='#'>action</a>"
			);
					
  }*/
function get_fullName($val){
	global $url;
	  $model=mysqli_fetch_object(mysqli_query($url,"select `First_Name`, `Last_Name` from `Smart_FLC_mail_Details` WHERE Mailer_ID='".$val."'"));
	  //var_dump($val);
	  //var_dump($model);
	  //var_dump($url);
	  //echo "select `First_Name`, `Last_Name` from `Smart_FLC_Resource_Details` WHERE Mailer_ID='".$val."'";
	  return $model->First_Name." ".$model->Last_Name;
	  //return $model;
}
function get_contactNumbers($val){
	global $url;
	  $model=mysqli_fetch_object(mysqli_query($url,"select `Cell_phone`, `whatsapp` from `Smart_FLC_mail_Details` WHERE Mailer_ID='".$val."'"));
	  $cnt=$model->Cell_phone;
	  if($model->whatsapp!=""){
		 	$cnt.='<br/><a href="https://api.whatsapp.com/send?phone='.ltrim($model->whatsapp,'+').'" target="_blank"><i class="fa fa-whatsapp"></i> '.$model->whatsapp.'</a>';
		 }
		 return $cnt;
}

// DB table to use
$table = 'Smart_FLC_mail_Details';
 
// Table's primary key
$primaryKey = 'Mailer_ID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'Mailer_ID', 'dt' => 0 ),
	 array( 
	'db' => 'images',   'dt' => 1 ,
	'formatter' => function( $d, $row ) {
		//$sub_folder=getImageFolder($row['Mailer_ID']);
		//$test_path=glob("../".image_path.$sub_folder."/".$row['Mailer_ID']."_01.{jpg,png,gif,jpeg}", GLOB_BRACE);
		$img_src=explode(",",$d);
		//var_dump($row);
		$img_path='<img src="../'.$img_src[0].'" width="100" />';
		return '<a href="javascript:;" ref="'.$row['Mailer_ID'].'" onClick="view_model(this)">'.$img_path.'</a>';
     }
	),
    array( 'db'        => 'First_Name',
			'dt' => 2,
			 'formatter' => function( $d, $row ) {
				// var_dump($row);
			$display = '<a href="javascript:;" ref="'.$row['Mailer_ID'].'" onClick="view_model(this)">'.get_fullName($row['Mailer_ID']).'</a>';
			if($row['added_status']!="" && $row['added_status']!=NULL){
				 $display.='<br/><span class="label label-success pull-right"> '.$row['added_status'].'</span>';
			}
			return $display;
        }
	
	),
    array( 'db' => 'Cell_phone', 'dt' => 3,
				'formatter' => function( $d, $row ) {
            		return get_contactNumbers($row['Mailer_ID']);
        		}
	 ),
    array('db' => 'Email1', 'dt' => 4,
			'formatter' => function( $d, $row ) {
            return '<a href="mailto:'.$d.'">'.$d.'</a>';
        }
	 ),
    array(
        'db'        => 'added_status',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return '<a href="javascript:;" ref="'.$row['Mailer_ID'].'" onClick="view_model(this)">View</a> &nbsp; &nbsp; <a href="edit-mail_model.php?m_id='.$row['Mailer_ID'].'">Edit</a> &nbsp; &nbsp; <a href="javascript:;" onclick="removeItem('."'".$row['Mailer_ID']."'".')">Delete</a>';
        }
    )
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