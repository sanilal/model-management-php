<?php
error_reporting(0);
ob_start();
session_start();
 $active="dash"; ?>

<?php include_once('includes/header.php');

function to_us($date)
{
//DD-MM-YYYY to YYYY-MM-DD

$bits=explode("-",$date);

return $bits[2]."-".$bits[1]."-".$bits[0];

}
 ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

      <!-- =============================================== -->
<?php
ob_start();
include("includes/conn.php"); 
$posts['search_dates']=date('01-m-Y')." - ".date('d-m-Y');
if(isset($_POST['search_dates'])){$posts['search_dates']=$_POST['search_dates'];}
$job_date_qr="";
$model_date_qr="";
if($posts['search_dates']!="" ){
		//var_dump($posts['search_dates']);
		$date_arr=explode(" - ",$posts["search_dates"]);
		if($date_arr[1]){
			$job_date_qr="  && ( ( `job_created_date` BETWEEN '".to_us($date_arr[0])."' AND '".to_us(str_replace(' ', '',$date_arr[1]))."')  OR  (job_modified_date  BETWEEN '".to_us($date_arr[0])."' AND '".to_us(str_replace(' ', '',$date_arr[1]))."') )";
			$model_date_qr=" && ( ( `Date_Created` BETWEEN '".to_us($date_arr[0])."' AND '".to_us(str_replace(' ', '',$date_arr[1]))."')  OR  (Date_Modified  BETWEEN '".to_us($date_arr[0])."' AND '".to_us(str_replace(' ', '',$date_arr[1]))."') )";
			
		}
		else{
			$job_date_qr=" && (`job_created_date` = '".to_us($date_arr[0])."' OR job_modified_date= '".to_us($date_arr[0])."')";
			$model_date_qr=" && (`Date_Created` = '".to_us($date_arr[0])."' OR Date_Modified= '".to_us($date_arr[0])."')";
		}
	}
//
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Reports</small>
          </h1>
         
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              
              <?php if(isset($msg)){ if($msg!=""){ ?>
              	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
                    
               	</div>
               <?php }} ?> 
               <?php if(isset($error)){ if($error!=""){ ?>
              	<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> <?php echo $error; ?></h4>
                    
               	</div>
               <?php } } ?> 
               
               		<div class="row">
            
                        <div class="col-sm-12">
               
                   			<form style="margin-bottom:10px" action="" method="post" class="form-horizontal">   
                                   <div class="col-xs-8 dateselect" style="margin-bottom:10px;">
                                   
                                    <input type="text" id="daterangef" class="form-control" name="search_dates">
            						<i class="fa fa-calendar"></i>

                                   
                                    </div>
                               
                                  
                                     <div class="col-xs-4" >
                                    <span class="input-group-btn">
                                            <button type="submit" id="LoadRecordsButton" class="btn btn-primary btn-flat" style="width:100%;" > Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                       </div>
              
            </div>
          </div>
            <a id="dlink"  style="display:none;"></a>
          <div class="box box-warning">
          <div class="box-header with-border">
                 <h3 class="box-title">Job Report - From: <b><?php echo date("M d: Y", strtotime($date_arr[0])); ?></b> To: <b><?php echo date("M d: Y", strtotime($date_arr[1])); ?></b></h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <div class="box-body">
           <input type="button" onclick="tableToExcel('example2', 'W3C Example Table', 'Job_Report_<?php echo date("M d: Y", strtotime($date_arr[0])); ?>_To_<?php echo date("M d: Y", strtotime($date_arr[1])); ?>.xls')" value="Export to Excel">
                        
            <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <tr>
                      <th>Sl. No</th>
                      	<th>Job Name</th>
                        <th>Last Action</th>
                        <th>View</th>
                      </tr>
                      </tr>
                    </thead>
                     <tbody>
                    <?php 
					$i = 1;
					$r=mysqli_query($url,"select * from `Smart_FLC_jobs`  WHERE `job_created_by`='".$_SESSION['user_id']."' ".$job_date_qr." ORDER BY job_id DESC ");
					while($res = mysqli_fetch_object($r)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $res->job_title; ?></td>
                       
                        <td>
                        <?php if($res->job_modified_date=='0000-00-00 00:00:00'){ echo 'Created';} else{ echo 'Updated';} ?>
                        </td>
                        <td>
                        <?php
						$en_url=base64_encode("job_id=".$res->job_id);
						?>
                        	<a href="http://flcmodels.com/view_job/?q=<?php echo $en_url; ?>" class="btn" onClick="view_job(<?php echo $res->job_id; ?>,event)">View Job</a> 
                       </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  
                    <tfoot>
                    </tfoot>
                  </table>
              
            </div><!-- /.box-body -->
            <div class="box-footer">
              
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
          
          <div class="box box-success">
          <div class="box-header with-border">
                 <h3 class="box-title">Models Status Report - From: <b><?php echo date("M d: Y", strtotime($date_arr[0])); ?></b> To: <b><?php echo date("M d: Y", strtotime($date_arr[1])); ?></b></h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
            </div>
            <div class="box-body">
           
              <input type="button" onclick="tableToExcel('example3', 'W3C Example Table', 'Models update Report_<?php echo date("M d: Y", strtotime($date_arr[0])); ?>_To_<?php echo date("M d: Y", strtotime($date_arr[1])); ?>.xls')" value="Export to Excel">
              
            <table id="example3" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      <tr>
                      	<th>Sl. No</th>
                      	<th>Model Id/ Name</th>
                        <th>Action</th>
                        <th>Last Update</th>
                        <th>Source</th>
                        <th>View</th>
                      </tr>
                      </tr>
                    </thead>
                     <tbody>
                    <?php 
					$j = 1;
					
						$model_booker_q=" WHERE (`Created_By`='".$_SESSION['user_id']."' && ( `Date_Created` BETWEEN '".to_us($date_arr[0])."' AND '".to_us(str_replace(' ', '',$date_arr[1]))."')) OR ( `Modified_By`='".$_SESSION['user_id']."' && (Date_Modified  BETWEEN '".to_us($date_arr[0])."' AND '".to_us(str_replace(' ', '',$date_arr[1]))."' )) ";
					//echo "select * from `Smart_FLC_Resource_Details`  ".$model_booker_q.$model_date_qr."  ORDER BY CAST(SUBSTR(`Resource_ID`,INSTR(`Resource_ID`, 'F') + 1) AS UNSIGNED)  DESC "; exit;
					$r2=mysqli_query($url,"select * from `Smart_FLC_Resource_Details`  ".$model_booker_q."  ORDER BY CAST(SUBSTR(`Resource_ID`,INSTR(`Resource_ID`, 'F') + 1) AS UNSIGNED)  DESC ");
					while($res2 = mysqli_fetch_object($r2)){ ?>
                      <tr>
                        <td><?php echo $j++; ?></td>
                        <td><?php echo $res2->Resource_ID; ?><br/>
                        <?php echo $res2->First_Name." ".$res2->Middle_Name." ".$res2->Last_Name; ?>
                        </td>
                        <td>
                        <?php if($res2->Date_Created >=to_us($date_arr[0])){ echo 'Created on <b>'.date("M d: Y", strtotime($res2->Date_Created)).'</b>'; echo " by <b>";
				echo mysqli_fetch_object(mysqli_query($url,"SELECT user_name FROM `".TB_pre."fdl_bookers_gin` WHERE `user_id`=".$res2->Created_By))->user_name."</b>";} else{ echo 'Updated on <b>'.date("M d: Y", strtotime($res2->Date_Modified)).'</b>'; echo " by <b>";
				echo mysqli_fetch_object(mysqli_query($url,"SELECT user_name FROM `".TB_pre."fdl_bookers_gin` WHERE `user_id`=".$res2->Modified_By))->user_name."</b>";} ?>
                        </td>
                        <td>
                        <?php if($res2->Date_Modified=='0000-00-00 00:00:00' || $res2->Date_Modified==NULL){ echo 'No Update';} else{ echo 'Updated on <b>'.date("d-M-Y", strtotime($res2->Date_Modified)) ."</b> by <b>";
				echo mysqli_fetch_object(mysqli_query($url,"SELECT user_name FROM `".TB_pre."fdl_bookers_gin` WHERE `user_id`=".$res2->Modified_By))->user_name."</b>"; 
						} ?>
                        </td>
                        <td>
                        <?php if($res2->from=="request"){ echo 'From Website Registration';} else{ echo 'Manual Entry';} ?>
                        </td>
                        <td>
                        	<a href="http://flcmodels.com/profile.php?res_id=<?php echo $res2->Resource_ID; ?>" class="btn" onClick="view_model(this,event)" ref="<?php echo $res2->Resource_ID; ?>">View Model</a> 
                       </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  
                    <tfoot>
                    </tfoot>
                  </table>
              
            </div><!-- /.box-body -->
            <div class="box-footer">
              
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

 <?php include_once('includes/footer.php'); ?>
 <link rel="stylesheet" type="text/css" href="plugins/mdp/css/mdp.css">
<script type="text/javascript" src="plugins/daterange/moment.min.js"></script>
 <script type="text/javascript" src="plugins/daterange/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="plugins/daterange/daterangepicker.css" />
<style type="text/css">
.dateselect i { position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer; }
.dataTables_filter{ display:none;}
</style>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

<script type="text/javascript">
		$(function () {
    		
	<?php
	if($posts["search_dates"]!=""){
		echo "var start = '".$date_arr[0]."';
    		var end = '".$date_arr[1]."'; ";	
	} else { ?>	
	var start = moment().startOf('month');
    var end = moment();
	<?php } ?>
	
    function cb(start, end) {
		<?php if($posts["search_dates"]!=""){ ?>
		$('#daterangef').val(start+' - '+end);
		<?php } else { ?>
        $('#daterangef').val(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
		<?php } ?>
    }

    $('#daterangef').daterangepicker({
		locale: {
		  format: 'DD-MM-YYYY'
		},
		"autoApply": true,
        showDropdowns: true,
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
	
	/////
	
	 var table=$('#example2').DataTable({
          "paging": true,
		   "pageLength": 20,
		   <?php /*?>dom: 'Bfrtip',
			"buttons": ['pdf'],<?php */?>
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
		//
		$('#dropdown-booker').on('change', function() {
				  //var regex = selected.join("|");
				  var regex =$(this).val();
				  //alert(regex);
				  table.column(2).search(
					regex, true, true
				  ).draw();
				})
		//
		
		var table2=$('#example3').DataTable({
          "paging": true,
		   "pageLength": 20,
		   <?php /*?>dom: 'Bfrtip',
			"buttons": ['pdf'],<?php */?>
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
		
		//
		$('#model-booker').on('change', function() {
				  //var regex = selected.join("|");
				  var regex =$(this).val();
				  //alert(regex);
				  table2.column(3).search(
					regex, true, true
				  ).draw();
				})
		
		
		})
		
    
	
    </script>
    <link rel="stylesheet" href="dist/css/bootstrap-dialog.css">
    <script src="dist/js/bootstrap-dialog.min.js"></script>
    <script type="text/javascript">
    function view_job(val,e){
		e.preventDefault();
		  var id=val;
		BootstrapDialog.show({
			type:'type-default',
			title: 'Job Details',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('view_job.php?j_id='+id),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	}
	//
	function view_model(obj,e){
		e.preventDefault();
		  var id=$(obj).attr('ref');
		BootstrapDialog.show({
			type:'type-default',
			title: 'Model Details',
            message: $('<div><div style="text-align:center;">LOADING...<br/><img src="../images/loader.gif"  /></div></div>').load('view_model.php?r_id='+id),
			buttons: [{
				label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
				}
			}]
        });	 
	}
	//
	
	var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
        base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        }, format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
    return function (table, name, filename) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
        }
   document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
    }
})()

    </script>
 </body>
</html>
<?php ob_end_flush(); ?>