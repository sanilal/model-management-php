<?php
error_reporting(0);
ob_start();
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
else if($_SESSION['user_id']=="" || $_SESSION['user_id']==NULL){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
include("includes/conn.php"); 
//var_dump($_SESSION['user_id']);
?>

<style type="text/css">
.tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px;}
.form-group{ overflow:hidden; font-size:16px; font-weight:bold}
.form-group  label { font-weight:normal; padding-right:10px;}
.label.label-success{font-size:14px; margin-right:15px; }
.multi-item-carousel{
  .carousel-inner{
    > .item{
      transition: 500ms ease-in-out left;
    }
    .active{
      &.left{
        left:-33%;
      }
      &.right{
        left:33%;
      }
    }
    .next{
      left: 33%;
    }
    .prev{
      left: -33%;
    }
    @media all and (transform-3d), (-webkit-transform-3d) {
      > .item{
        // use your favourite prefixer here
        transition: 500ms ease-in-out left;
        transition: 500ms ease-in-out all;
        backface-visibility: visible;
        transform: none!important;
      }
    }
  }
  .carouse-control{
    &.left, &.right{
      background-image: none;
    }
  }
}
</style>
 <?php 
  $models_query=mysqli_query($url,"select * from `Smart_FLC_Resource_Details` WHERE Resource_ID LIKE '%".$_GET['q_val']."%' OR CONCAT( First_Name,  ' ', Last_Name )  LIKE '%".$_GET['q_val']."%' LIMIT 50");
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID LIKE '%".$_GET['q_val']."%' OR fname LIKE '%".$_GET['q_val']."%' OR lname LIKE '%".$_GET['q_val']."%' LIMIT 100";
  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0; ">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        
            <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List - Models</h3> 
              <?php if(isset($msg)){ ?>
              	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
               	</div>
               <?php } ?> 
               
               
            </div>
            
            <div class="box-body">
            <ol class="breadcrumb" style=" top:0">
          		<li><a href="javascript:;" class="btn btn-block" onClick="search_advanced();"><i class="fa fa-search"></i> Advanced Search </a></li>
            </ol>
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
            
                  <table id="example2" class="table table-hover display " style="width:95%;">
                    <thead>
                    <tr>
                   <th></th>
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
                    &nbsp; &nbsp;
                    	<select class="form-control" id="inputGender" >
                            <option value="">Select Gender:</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                     </th>
                     <th></th>
                    <th>
                    <select class="form-control" id="select_eth">
						 <option value="">Select Ethnicity:</option>
                        <option>African</option>
                  
                      <option>Arabic</option>
                  
                      <option>European</option>
                  
                      <option>Indian</option>        
                  
                      <option>Mediterranean</option>
                  
                      <option>Oriental</option>
                      </select>
                    &nbsp;&nbsp;
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
                    </th>
                    <th>
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
                    </th>
                    <th colspan="2">
                    	<button type="button" class="btn btn-default" onClick="table_search()">Search</button>
                   </th>
                 </tr>
                      <tr>
                      	<th>Model Id</th>
                      	<th>Image</th>
                        <th>Name</th>
                        <th>Personal Details</th>
                        <th>Contact Details</th>
                        <th>Measurement Details</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Category</th>
                        <th>Ethnicity</th>
                        <th style="background:#fff;">Action</th>
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
        <section style=" display:none">

        <div class="box box-primary">
              
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                  <?php
				  //var_dump($models_query);
				  while($model=mysqli_fetch_object($models_query)){
					 
					$img=0;
				$sub_folder=getImageFolder($model->Resource_ID);
               $img_pth= image_path.$sub_folder."/";
					$all_imgs=glob($img_pth.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					//var_dump($all_imgs);
				   ?>
                    <li class="item">
                      <div class="product-img">
                        <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>">
                      </div>
                      <div class="product-info">
                       <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default pull-right">View</a></span>
                       
                       
                        <a href="javascript::;" class="product-title" onClick="select_model(this,'<?php echo $model->Resource_ID; ?>')"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?><span class="label label-success pull-right"> Select & Add Model</span></a>  &nbsp;&nbsp;
                        <ul style="display:none">
                        	<li class="item">
                              <div class="product-img">
                                <img src="<?php if($all_imgs[0]!=""){ echo $all_imgs[0];} else{ echo $all_imgs[1];} ?>">
                              </div>
                              <div class="product-info">                               
                               
                                <a href="javascript::;"><?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?></a>  &nbsp;&nbsp;
                                <span class="product-description">
                                  <?php echo $model->Gender; ?>,  <?php echo $model->Nationality; ?>, <?php echo $model->Ethnicity; ?>
                                  <br/>Age: <?php echo $model->Age; ?>
                                </span>
                               <?php if($model->Email1=="" || $model->Email1==NULL){ ?>
                               <div style="color:#E11A1D">No Email</div>
                               <?php } ?>
                               <input type="hidden" name="job_mail[]" value="<?php echo $model->Email1; ?>" />
                               <?php  ?>
                              </div>
                              <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="view_model(this)" class="btn btn-default ">View</a></span> &nbsp;&nbsp; <span style="margin-left:10px;"><a href="javascript:;" ref="<?php echo $model->Resource_ID; ?>" onClick="unselect_model(this)" class="btn btn-default">Delete</a></span>
                             <input type="hidden" name="selct_model[]" value="<?php echo $model->Resource_ID; ?>" class="model_val" />
                            </li>
                            
                        </ul>
                        <span class="product-description">
                          <?php echo $model->Gender; ?>,  <?php echo $model->Nationality; ?>, <?php echo $model->Ethnicity; ?>
                          <br/>Age: <?php echo $model->Age; ?>
                        </span>
                      
                      </div>
                       <?php if($model->Email1=="" || $model->Email1==NULL){ ?>
                       <div style="color:#E11A1D">No Email</div>
					   <?php } ?>
                     
                    </li><!-- /.item -->
                    
                  <?php } ?>
                    
                  </ul>
                </div><!-- /.box-body -->
             
              </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css" type="text/css" />
    <!-- Ion Slider -->
    <link rel="stylesheet" href="plugins/ionslider/ion.rangeSlider.css">
    <!-- ion slider Nice -->
    <link rel="stylesheet" href="plugins/ionslider/ion.rangeSlider.skinNice.css">
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
 <script src="plugins/ionslider/ion.rangeSlider.min.js"></script>
 <script>
      $(function () {
        $('#example2').DataTable({
			"pageLength": 25,
			<?php /*?>"scrollX": true,<?php */?>
         "fixedHeader" : {
                    header : true,
                    footer : true
                },
		  "processing": true,
		  
        "serverSide": true,
		"order": [[ 0, "desc" ]],
		"columnDefs": [
            {
                "targets": [ 0,6,7,8,9 ,10,11],
                "visible": false
            },
			{
                "targets": [ 1,3,4,5,10 ],
                "orderable": false
            }
        ],
		
		   "ajax": 'ajax/search_models.php'
		   
		   <?php /*?>"columns": [
            { "data": "Resource_ID" },
            { "data": "name" },
            { "data": "image" },
            { "data": "category" },
            { "data": "status" },
            { "data": "action" }
        ]<?php */?>
		  });
		
      });
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

<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    

<?php ob_end_flush(); ?>