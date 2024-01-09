<?php
error_reporting(0);
ob_start();
session_start();
 $active="model"; ?>
<?php include_once('includes/header.php'); ?>

 <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

<?php  
//ob_start();
include("includes/conn.php"); 

if(isset($_GET['p_id']) && isset($_GET['status']) ){
	$id = $_GET['p_id'];
	$status = $_GET['status'];
	$query = "UPDATE `".TB_pre."products` set status='$status' WHERE `product_id`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	if($r){
		$msg = "Status updated Successfully.";
	}
}

if(isset($_GET['remove_res'])){
	$id = $_GET['remove_res'];
	//$pr_img_res=mysqli_fetch_object(mysqli_query($url,"select images from `Smart_FLC_mail_Details` WHERE `Mailer_ID`='$id'"));
	$query = "DELETE FROM `Smart_FLC_Resource_Details` WHERE `Resource_ID`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	//unlink( "uploads/".$pr_img_res->product_img);
	
	if($r){
		$msg = "The selected model/talent deleted successfully.";
	}
}
//$sql="select * from `".TB_pre."Smart_FLC_Resource_Details` ORDER BY First_Name LIMIT 100 ";
//$r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));

?>  

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            View Models & Talents
            <small></small>
          </h1>
          
          <ol class="breadcrumb" style=" top:0">
          	<li><a href="search_advanced.php" class="btn btn-block"><i class="fa fa-search"></i> Advanced Search </a></li>
            <li><a href="add-model.php" class="btn btn-block"><i class="fa fa-plus"></i> Add new Model/Talent</a></li>
          </ol>
          
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List - Models/Talents</h3> 
              <?php if(isset($msg)){ ?>
              	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
               	</div>
               <?php } ?> 
            </div>
            
            <div class="box-body">
           <?php /*?> <table class="table">
            	<tr>
                    <td>Filter By:</td>
                    <td>
                    	<select id="dropdown-cat" class="form-control">
                          <option value="">Select Category:</option>
                          <option value="Model">Model</option>
                          <option value="Cast">Cast</option>
                          <option value="Teens">Teens</option>
                          <option value="Kids">Kids</option>
                          <option value="Hostess">Hostess</option>
                          <option value="Plus Size Model">Plus Size</option>
                          <option value="Stylist">Stylist</option>
                          <option value="Photographer">Photographer</option>
                          <option value="Presenter">Presenter</option>
                          <option value="Promoter">Promoter</option>
                        </select>
                     </td>
                    <td>
                    	<select class="form-control" id="inputGender" >
                            <option value="">Select Gender:</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                     </td>
                    <td>
                    <select class="form-control" id="select_eth">
						 <option value="">Select Ethnicity:</option>
                        <option>African</option>
                  
                      <option>Arabic</option>
                  
                      <option>European</option>
                  
                      <option>indian</option>        
                  
                      <option>Mediterranean</option>
                  
                      <option>Oriental</option>
                      </select>
                    </td>
                 </tr>
            </table><?php */?>
            		<table width="100%" cellpadding="2" cellspacing="2">
                    <tr>
                    <th >
                    	<select id="dropdown-cat" class="form-control">
                          <option value="">Select Category:</option>
                          <option value="Model">Model</option>
                          <option value="Actor">Actor</option>
                          <option value="Cast">Cast</option>
                          <option value="Teens">Teens</option>
                          <option value="Kids">Kids</option>
                          <option value="Hostess">Hostess</option>
                          <option value="Plus Size Model">Plus Size</option>
                          <option value="Stylist">Stylist</option>
                          <option value="Photographer">Photographer</option>
                          <option value="Presenter">Presenter</option>
                          <option value="Promoter">Promoter</option>
                        </select>
                 </th><th>
                    	<select class="form-control" id="inputGender" >
                            <option value="">Select Gender:</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </th><th>
                    <select class="form-control" id="select_eth">
						 <option value="">Select Ethnicity:</option>
                        <option>African</option>
                  
                      <option>Arabic</option>
                  
                      <option>European</option>
                  
                      <option>Indian</option>        
                  
                      <option>Mediterranean</option>
                  
                      <option>Oriental</option>
                      </select>
                  </th><th>
                   <?php /*?>Select Age Limit <br/><?php */?>
                   <?php /*?><input id="range_1" type="text" name="age" value="" ><?php */?>
                   	<select  name="age"  id="age_select" class="form-control">
                   		<option value="">Select Age</option>
                        <option value="0 , 3">0 - 3</option>
                        <option value="4 , 7" >4 - 7</option>
                        <option value="8 , 12" >8 - 12</option>
                        <option value="13 , 16">13 - 16</option>
                        <option value="17 , 19">17 - 19</option>
                        <option value="20 , 25" >20 - 25</option>
                        <option value="26 , 30" >26 - 30</option>
                        <option value="31 , 35" >31 - 35</option>
                        <option value="36 , 40" >36 - 40</option>
                        <option value="41 , 45" >41 - 45</option>
                        <option value="46 , 50" >46 - 50</option>
                        <option value="51 , 100" >Above 50</option>
                     </select>
                 </th><th>
                   <?php /*?> Height Limit <br/>
                     <input id="range_2" type="text" name="height" value=""><?php */?>
                     <select  name="height"  id="height_select" class="form-control">
                        <option value="">Select Height</option>
                        <option value="30 , 50">30cm - 50cm</option>
                        <option value="50 , 70">50cm - 70cm</option>
                        <option value="70 , 90">70cm - 90cm</option>
                        <option value="90 , 100">90cm - 100cm</option>
                        <option value="100 , 110">100cm - 110cm</option>
                        <option value="110 , 120">110cm - 120cm</option>
                        <option value="120 , 130">120cm - 130cm</option>
                        <option value="130 , 140">130cm - 140cm</option>
                        <option value="140 , 150">140cm - 150cm</option>
                        <option value="150 , 160">150cm - 160cm</option>
                        <option value="160 , 170">160cm - 170cm</option>
                        <option value="170 , 175">170cm - 175cm</option>
                        <option value="175 , 180">175cm - 180cm</option>
                        <option value="180 , 185">180cm - 185cm</option>
                        <option value="185 , 190">185cm - 190cm</option>
                        <option value="190 , 195">190cm - 195cm</option>
                        <option value="195 , 200">195cm - 200cm</option>
                        <option value="200 , 300">Above 200cm</option>
                     </select>
                  </th><th>
                    	<button type="button" class="btn btn-default" onClick="table_search()">Search</button>
                    &nbsp;
                    <button type="button" class="btn btn-default" onClick="clear_search()">Clear</button>
                    </th>
       			   </tr>
                    </table>
                  <table id="example2" class="table table-hover display ">
                    <thead>
                    
                      <tr>
                      	<th >Model Id </th>
                      	<th>Image</th>
                        <th>Name</th>
                        <th>Personal Details</th>
                        <th>Contact Details</th>
                        <th>Measurement Details</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Category</th>
                        <th>Ethnicity</th>
                        <th>Action</th>
                        <th>Sub_cat</th>
                      </tr>
                    </thead>
                   
                    <tfoot>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
            <div class="box-footer">
            <input type="hidden" id="min_age" value="0" /> <input type="hidden" id="max_age" value="100" /> 
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

     <div style="height:0;"><img src="../images/loader.gif" style="visibility:hidden" /></div>
      <!-- Control Sidebar -->


	<?php include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->
   <?php include_once('includes/footer-scripts.php'); ?>
    <link rel="stylesheet" href="dist/css/bootstrap-dialog.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css" type="text/css" />
    <!-- Ion Slider -->
    <link rel="stylesheet" href="plugins/ionslider/ion.rangeSlider.css">
    <!-- ion slider Nice -->
    <link rel="stylesheet" href="plugins/ionslider/ion.rangeSlider.skinNice.css">
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
 <script src="plugins/ionslider/ion.rangeSlider.min.js"></script>
     <script src="dist/js/bootstrap-dialog.min.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <!-- AdminLTE for demo purposes -->
     <script>
      $(function () {
        $('#example2').DataTable({
			"pageLength": 50,
			<?php /*?>"scrollX": true,<?php */?>
			dom: 'Bfrtip',
			"buttons": ['excelHtml5'],
         "fixedHeader" : {
                    header : true,
                    footer : true
                },
		  "processing": true,
		  
        "serverSide": true,
		"order": [[ 0, "desc" ]],
		"columnDefs": [
            {
                "targets": [ 0,2,6,7,8,9,11 ],
                "visible": false
            },
			{
                "targets": [ 1,3,4,5,10 ],
                "orderable": false
            }
        ],
		
		   "ajax": 'ajax/models.php'
		   
		   <?php /*?>"columns": [
            { "data": "Resource_ID" },
            { "data": "name" },
            { "data": "image" },
            { "data": "category" },
            { "data": "status" },
            { "data": "action" }
        ]<?php */?>
		  });
		 
		<?php /*?> $("#range_1").ionRangeSlider({
           min: 0,
          max: 120,
          from: 0,
          to: 100,
          type: 'double',
          step: 1,
          postfix: "years",
          prettify: true,
          hasGrid: false,
		  onFinish: function (data) {
				//age_filter(data);
			}
        });<?php */?>
		<?php /*?>$("#range_2").ionRangeSlider({
           min: 30,
          max: 350,
          from: 30,
          to: 300,
          type: 'double',
          step: 1,
          postfix: "cm",
          prettify: true,
          hasGrid: false,
		  onFinish: function (data) {
			  var val=data['fromNumber']+','+data['toNumber'];
			 $('#example2').DataTable().column(5).search(
				val,false, false
			  ).draw();
			}
        });<?php */?>
		
		  <?php /*?> $('#dropdown-cat').on('change', function() {
			
				  //var regex = selected.join("|");
				  var regex =$(this).val();
				  $('#example2').DataTable().column(8).search(
					regex, true, true
				  ).draw();
				})<?php */?>
		//
			<?php /*?>$('#inputGender').on('change', function() {
				  //var regex = selected.join("|");
				  var val =$(this).val();
				  $('#example2').DataTable().column(6).search(
					val,false, false
				  ).draw();
				})<?php */?>
		//
			<?php /*?>$('#select_eth').on('change', function() {
				  //var regex = selected.join("|");
				  var regex =$(this).val();
				  $('#example2').DataTable().column(9).search(
					regex, true, true
				  ).draw();
				})<?php */?>
		//
			  
	  //
      });
	  //
	 
	  function view_model(obj){
		  var id=$(obj).attr('ref');
		BootstrapDialog.show({
			type:'type-default',
			title: 'Model Complete Details',
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
	function age_filter() {
				  //alert(obj['fromNumber']);
				  //var val=obj['fromNumber']+','+obj['toNumber'];
				  var val=$("#age_select").val();
				  $('#example2').DataTable().column(7).search(
					val,false, false
				  ).draw();
			  } 
	function height_filter (){
			  var val=$("#height_select").val();
			 $('#example2').DataTable().column(5).search(
				val,false, false
			  ).draw();
	}
	//
	function table_search(){
		var cat_val =$("#dropdown-cat").val();
		var gender=$("#inputGender").val();
		var ethnicity=$("#select_eth").val();
		var age_val=$("#age_select").val();
		 var height_val=$("#height_select").val();
		
		$('#example2').DataTable()
		.column(8).search(cat_val, true, true)
		.column(6).search(gender,false, false) 
		.column(9).search(ethnicity, true, true)
		.column(7).search(age_val,false, false)
		.column(5).search(height_val,false, false)
		.draw();	
	}
	//
	function clear_search(){
		/* $('.dataTables_filter input').val('');
		 $('#example2 select').val('');
		 alert($('#example2 select').val())
         table_search();*/
		 location.reload();
	}
    </script>
    <script type="text/javascript">
    function removeItem(id){
		var c= confirm("Do you want to remove this item?");
		//alert("Delete functinality temporarily disabled"); return false;
		if(c){
			location = "models.php?remove_res="+id;
		}
	}
	
    </script>
  </body>
</html>
<?php ob_end_flush(); ?>