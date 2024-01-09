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
function get_Personal_Details($val){
	global $url;
	  $model=mysqli_fetch_object(mysqli_query($url,"select `Gender`, `DOB`,`Resource_Type`,`In_Town_Status`,`Sub_Category`, `Ethnicity`, `Nationality`,`new_sub_cats` from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$val."'"));
	  $inter='<p>International Model/talent?:<b> No </b>';
	 if(strpos($model->Sub_Category,"International")!== false){$inter='<p>International Model/talent?: <b>Yes </b>';}
	 $sub_cats="";
	 if($model->new_sub_cats!=""){$sub_cats='<p>Sub Category: <b>'.$model->new_sub_cats.'</b></p>';}
	  return '<p>Category: <b>'.$model->Resource_Type.'</b></p>'.$sub_cats.'
	  <p>Ethnicity: <b>'.$model->Ethnicity.'</b></p>
	  <p>Gender: <b>'.$model->Gender.'</b></p>
	  <p>Age: <b>'.date_diff(date_create($model->DOB), date_create('today'))->y.'</b></p>
	  <p>Nationality: <b>'.$model->Nationality.'</b></p>
	  <p>In Town Status: <b>'.$model->In_Town_Status.'</b></p>'.$inter;
	  
}

function get_Physical_Details($val){
	global $url;
	  $model=mysqli_fetch_object(mysqli_query($url,"select `Height`, `Weight`,`Bust`, `Hips`, `Waist`,`EyesColor`, `SkinColor`, `HairColor`, `ShoesSize`, `DressSize` from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$val."'"));
	 
	  return '<p>Height: <b>'.$model->Height.'</b> &nbsp;&nbsp;</p>
	  <p>Bust: <b>'.$model->Bust.'</b> &nbsp;&nbsp;&nbsp;&nbsp; Hips: <b>'.$model->Hips.'</b></p>
	  <p>Waist: <b>'.$model->Waist.'</b> &nbsp;&nbsp;&nbsp;&nbsp; Eyes: <b>'.$model->EyesColor.'</b></p>
	  <p>Skin: <b>'.$model->SkinColor.'</b> &nbsp;&nbsp;&nbsp;&nbsp; Hair: <b>'.$model->HairColor.'</b></p>
	  <p>Shoe: <b>'.$model->ShoesSize.'</b> &nbsp;&nbsp;&nbsp;&nbsp; Dress: <b>'.$model->DressSize.'</b></p>';
}

function get_Email($val){
	global $url;
	  $model=mysqli_fetch_object(mysqli_query($url,"select `Email1`, `Email2`, `Email3` from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$val."'"));
	  //var_dump($val);
	  //var_dump($model);
	  //var_dump($url);
	  //echo "select `First_Name`, `Last_Name` from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$val."'";
	  if($model->Email1!="" && $model->Email1!=NULL){
			return $model->Email1;
		}
		else if($model->Email2!="" && $model->Email2!=NULL){
			return $model->Email2;
		}
		else return $model->Email3;
	  //return $model->First_Name." ".$model->Last_Name;
	  //return $model;
}

// DB table to use
$table = 'Smart_FLC_Resource_Details';
 
// Table's primary key
$primaryKey = 'Resource_ID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'Resource_ID', 'dt' => 0,
		'formatter' => function( $d, $row ) {
            return '<a href="javascript:;" ref="'.$d.'" onClick="view_model(this)">'.$d.'</a>';
        }
	 ),
	 array( 
	'db' => 'whatsapp',   'dt' => 1 ,
	'formatter' => function( $d, $row ) {
		$sub_folder=getImageFolder($row['Resource_ID']);
		$test_path=glob("../".image_path.$sub_folder."/".$row['Resource_ID']."*.{jpg,png,gif,jpeg}", GLOB_BRACE);
		$img_path='<img src="'.substr($test_path[0],3).'" width="100" />';
		return '<a href="javascript:;" ref="'.$row['Resource_ID'].'" onClick="view_model(this)">'.$row['Resource_ID'].'</a><br/><a href="javascript:;" ref="'.$row['Resource_ID'].'" onClick="view_model(this)">'.get_fullName($row['Resource_ID']).'</a><br/><a href="javascript:;" ref="'.$row['Resource_ID'].'" onClick="view_model(this)">'.$img_path.'</a>';
     }
	),
    array( 'db'        => 'First_Name',
			'dt' => 2,
			 'formatter' => function( $d, $row ) {
				// var_dump($row);
			return '<a href="javascript:;" ref="'.$row['Resource_ID'].'" onClick="view_model(this)">'.get_fullName($row['Resource_ID']).'</a>';
        }
	
	),
	array( 'db' => 'Last_Name', 'dt' => 3,
	'formatter' => function( $d, $row ) {
				// var_dump($row);
			return get_Personal_Details($row['Resource_ID']);
		}
	 ),
	array( 'db' => 'Nationality', 'dt' => 4,'formatter' => function( $d, $row ) {
				// var_dump($row);
			return '<p>Phone: <b>'.$d.'</b></p><p><a href="https://api.whatsapp.com/send?phone='.ltrim($row['whatsapp'],'+').'" target="_blank"><i class="fa fa-whatsapp"></i> '.$row['whatsapp'].'</a></p><p>Email: <a href="mailto:'.get_Email($row['Resource_ID']).'"><b>'.get_Email($row['Resource_ID']).'</b></a></p><p>Address: <b>'.$row['Address'].'</b><br/><a href="../profile.php?res_id='.$row['Resource_ID'].'" target="_blank" >View Profile</a> <br/><a href="../com_cart.php?res_id='.$row['Resource_ID'].'" target="_blank" >View Compcard</a></p>';
		}  ),
	array( 'db' => 'Height', 'dt' => 5,'formatter' => function( $d, $row ) {
				// var_dump($row);
			return get_Physical_Details($row['Resource_ID']);
		} ),
	array( 'db' => 'Gender', 'dt' => 6 ),
	array( 'db' => 'Age', 'dt' => 7 ),
    array( 'db' => 'Resource_Type', 'dt' => 8 ),
    array('db' => 'Ethnicity', 'dt' => 9 ),
    array(
        'db'        => 'Address',
        'dt'        => 10,
        'formatter' => function( $d, $row ) {
            return '<a href="javascript:;" ref="'.$row['Resource_ID'].'" onClick="view_model(this)">View</a> &nbsp; &nbsp; <a href="edit-model.php?r_id='.$row['Resource_ID'].'">Edit</a> &nbsp; &nbsp; <a href="javascript:;" onclick="removeItem('."'".$row['Resource_ID']."'".')">Delete</a>';
        }
    ),
	 array('db' => 'new_sub_cats', 'dt' => 11 )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'models_com',
    'pass' => 'KXwEax4iNew',
    'db'   => 'models_com',
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