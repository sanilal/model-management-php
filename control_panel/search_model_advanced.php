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
<style type="text/css">
hr{ margin:10px 0; clear:both;}
#range_2,#range_1{ display:none}
.opac_div{ opacity:0.5;filter:alpha(opacity=50); width:95%; margin-top:0; margin-left:40px; position:absolute; height:50px; background:#fff; z-index:10;}
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
             <div class="form-group">
                <label for="inputCat" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-9">
                  <label class="col-sm-4">
                        <input value="Model" name="category[]" type="checkbox" class="cat_check">Model
                    </label>
                     <label class="col-sm-4">
                        <input value="Actor" name="category[]" type="checkbox" class="cat_check">Actor
                    </label>
                    <label class="col-sm-4">
                        <input value="Cast" name="category[]" type="checkbox" class="cat_check">Cast
                    </label>
                    <label class="col-sm-4">
                        <input value="Teens" name="category[]" type="checkbox" class="cat_check">Teens
                    </label>
                    <label class="col-sm-4">
                        <input value="Kids" name="category[]" type="checkbox" class="cat_check">Kids        
                    </label>
                    <label class="col-sm-4">
                        <input value="Hostess" name="category[]" type="checkbox" class="cat_check">Hostess
                    </label>
                    <label class="col-sm-4">
                        <input value="Plus Size Model" name="category[]" type="checkbox" class="cat_check">Plus Size Model          
                    </label>
                    <label class="col-sm-4">
                        <input value="Stylist" name="category[]" type="checkbox" class="cat_check">Stylist          
                    </label>
                    <label class="col-sm-4">
                        <input value="Photographer" name="category[]" type="checkbox" class="cat_check">Photographer         
                    </label>
                </div>
                <hr style="width:100%;"/>
              </div>
              
               <div class="form-group">
                <label for="inputEth" class="col-sm-3 control-label">Ethnicity</label>
                <div class="col-sm-9">
                  <label class="col-sm-4">
                      <input value="African" name="ethnicity[]" type="checkbox" class="eth_check">African
                  </label>
                  <label class="col-sm-4">
                      <input value="Arabic" name="ethnicity[]" type="checkbox" class="eth_check">Arabic
                  </label>
                  <label class="col-sm-4">
                      <input value="European" name="ethnicity[]" type="checkbox" class="eth_check">European
                  </label>
                  <label class="col-sm-4">
                      <input value="Indian" name="ethnicity[]" type="checkbox" class="eth_check">Indian        
                  </label>
                  <label class="col-sm-4">
                      <input value="Asian" name="ethnicity[]" type="checkbox" class="eth_check">Asian          
                  </label>
                  <label class="col-sm-4">
                      <input value="Mediterranean" name="ethnicity[]" type="checkbox" class="eth_check">Mediterranean
                  </label>
                  <label class="col-sm-4">
                      <input value="Oriental" name="ethnicity[]" type="checkbox" class="eth_check">Oriental          
                  </label>
                </div>
                <hr style="width:100%"/>
              </div>
               <div class="form-group">
                <label for="inputGender" class="col-sm-3 control-label">Sex</label>
                <div class="col-sm-9">
                  	<Select class="form-control required" id="inputGender" name="gender" required>
                    	<option value="">Select Both</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </Select>
                </div>
                <hr style="width:100%"/>
              </div>
              
               <div class="form-group">
              
              <label for="inputCountry" class="col-sm-3 control-label">Nationality</label>
                <div class="col-sm-9">
                  	<Select class="form-control required select2" id="inputCountry" name="nationality" required>
                    	 <option value="">Select</option>  <option value="Afghanistan">Afghanistan</option>  <option value="Albania">Albania</option>  <option value="Algeria">Algeria</option>  <option value="Argentina">Argentina</option>  <option value="Armenia">Armenia</option>  <option value="Australia">Australia</option>  <option value="Austria">Austria</option>  <option value="Azerbaijan">Azerbaijan</option>  <option value="Bahrain">Bahrain</option>  <option value="Bangladesh">Bangladesh</option>  <option value="Belarus">Belarus</option>  <option value="Belgium">Belgium</option>  <option value="Bolivia">Bolivia</option>  <option value="Brazil">Brazil</option>  <option value="Brunei">Brunei</option>  <option value="Bulgaria">Bulgaria</option>  <option value="Canada">Canada</option>  <option value="Chile">Chile</option>  <option value="China">China</option>  <option value="Colombia">Colombia</option>  <option value="Costa Rica">Costa Rica</option>  <option value="Croatia">Croatia</option>  <option value="Cuba">Cuba</option>  <option value="Cyprus">Cyprus</option>  <option value="Czech Rep">Czech Rep</option>  <option value="Denmark">Denmark</option>  <option value="Ecuador">Ecuador</option>  <option value="Egypt">Egypt</option>  <option value="Eritrea">Eritrea</option>  <option value="Estonia">Estonia</option>  <option value="Ethiopia">Ethiopia</option>  <option value="Finland">Finland</option>  <option value="France">France</option>  <option value="Gabon">Gabon</option>  <option value="Georgia">Georgia</option>  <option value="Germany">Germany</option>  <option value="Ghana">Ghana</option>  <option value="Greece">Greece</option>  <option value="Hong Kong">Hong Kong</option>  <option value="Hungary">Hungary</option>  <option value="Iceland">Iceland</option>  <option value="India">India</option>  <option value="Indonesia">Indonesia</option>  <option value="Iran">Iran</option>  <option value="Iraq">Iraq</option>  <option value="Ireland">Ireland</option>  <option value="Italy">Italy</option>  <option value="Jamaica">Jamaica</option>  <option value="Japan">Japan</option>  <option value="Jordan">Jordan</option>  <option value="Kazakhstan">Kazakhstan</option>  <option value="Kenya">Kenya</option>  <option value="Korea">Korea</option>  <option value="Kuwait">Kuwait]</option>  <option value="Kyrgyzstan">Kyrgyzstan</option>  <option value="Latvia">Latvia</option>  <option value="Lebanon">Lebanon</option>  <option value="Liberia">Liberia</option>  <option value="Libya">Libya</option>  <option value="Lithuania">Lithuania</option>  <option value="Luxembourg">Luxembourg</option>  <option value="Macedonia">Macedonia</option>  <option value="Madagascar">Madagascar</option>  <option value="Malaysia">Malaysia</option>  <option value="Mali">Mali</option>  <option value="Malta">Malta</option>  <option value="Mauritania">Mauritania</option>  <option value="Mauritius">Mauritius</option>  <option value="Mexico">Mexico</option>  <option value="Moldova">Moldova</option>  <option value="Mongolia">Mongolia</option>  <option value="Montenegro">Montenegro</option>  <option value="Morocco">Morocco</option>  <option value="Mozambique">Mozambique</option>  <option value="Namibia">Namibia</option>  <option value="Nepal">Nepal</option>  <option value="Netherlands">Netherlands</option>  <option value="New Zealand">New Zealand</option>  <option value="Niger">Niger</option>  <option value="Nigeria">Nigeria</option>  <option value="Norway">Norway</option>  <option value="Oman">Oman</option>  <option value="Others">Others</option>  <option value="Pakistan">Pakistan</option>  <option value="Palestine">Palestine</option>  <option value="Paraguay">Paraguay</option>  <option value="Peru">Peru</option>  <option value="Philippines">Philippines</option>  <option value="Poland">Poland</option>  <option value="Portugal">Portugal</option>  <option value="Puerto Rico">Puerto Rico</option>  <option value="Qatar">Qatar</option>  <option value="Romania">Romania</option>  <option value="Russia">Russia</option>  <option value="Saudi Arabia">Saudi Arabia</option>  <option value="Senegal">Senegal</option>  <option value="Serbia">Serbia</option>  <option value="Sierra Leone">Sierra Leone</option>  <option value="Singapore">Singapore</option>  <option value="Slovakia">Slovakia</option>  <option value="Slovenia">Slovenia</option>  <option value="South Africa">South Africa</option>  <option value="Spain">Spain</option>  <option value="Sri Lanka">Sri Lanka</option>  <option value="Sudan">Sudan</option>  <option value="Sweden">Sweden</option>  <option value="Switzerland">Switzerland</option>  <option value="Syria">Syria</option>  <option value="Taiwan">Taiwan</option>  <option value="Tajikistan">Tajikistan</option>  <option value="Tanzania">Tanzania</option>  <option value="Thailand">Thailand</option>  <option value="Togo">Togo</option>  <option value="Tonga">Tonga</option>  <option value="Tunisia">Tunisia</option>  <option value="Turkey">Turkey</option>  <option value="Turkmenistan">Turkmenistan</option>  <option value="Ukraine">Ukraine</option>  <option value="United Arab Emirates">United Arab Emirates</option>  <option value="United Kingdom">United Kingdom</option>  <option value="United States">United States</option>  <option value="Uruguay">Uruguay</option>  <option value="Uzbekistan">Uzbekistan</option>  <option value="Venezuela">Venezuela</option>  <option value="Vietnam">Vietnam</option>  <option value="Yemen">Yemen</option>  <option value="Zambia">Zambia</option>  <option value="Zimbabwe">Zimbabwe</option>  
                  </select>
              </div>
               <hr style="width:100%"/>
              </div>
              
              
              <div class="form-group">
              	<div class="col-sm-1"><input type="checkbox" id="height_enable" value="1" onClick="enable_slide(this);" /></div>
                 <div class="opac_div"></div>
                <label class="col-sm-2 control-label">Select Height</label>
                <div class="col-sm-9"><input id="range_2" type="text" name="height" value="" data-input-values-separator=","></div>
                <hr style="width:100%"/>
              </div>
              
              <div class="form-group">
              <div class="col-sm-1"><input type="checkbox" id="age_enable" value="1" onClick="enable_slide(this);" /></div>
              <div class="opac_div"></div>
                <label class="col-sm-2 control-label">Select Age</label>
                <div class="col-sm-9"><input id="range_1" type="text" name="age" value="" data-input-values-separator="," ></div>
              </div>
              <div class="form-group">
              		<button type="button" class="btn btn-default" onClick="table_search()">Search</button>
                    &nbsp;
                    <button type="button" class="btn btn-default" onClick="clear_search()">Clear</button>
              </div>
              <hr style="width:100%"/>
                  <table id="example2" class="table table-hover display " style="width:95%;">
                    <thead>
            
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
                "targets": [ 0,6,7,8,9 ,10],
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
		  
		  $("#range_1").ionRangeSlider({
           min: 0,
          max: 120,
          from: 0,
          to: 100,
          type: 'double',
		  input_values_separator: ",",
          step: 1,
          postfix: "years",
          prettify: true,
          hasGrid: false,
		  onFinish: function (data) {
			   //var val=data['fromNumber']+','+data['toNumber'];
			   //$("#range_1").val(val);
				//age_filter(data);
			}
        });
		$("#range_2").ionRangeSlider({
           min: 30,
          max: 350,
          from: 30,
          to: 300,
          type: 'double',
		  input_values_separator: ",",
          step: 1,
          postfix: "cm",
          prettify: true,
          hasGrid: false,
		  onFinish: function (data) {
			  //var val=data['fromNumber']+','+data['toNumber'];
			   //$("#range_2").val(val);
			 /*$('#example2').DataTable().column(5).search(
				val,false, false
			  ).draw();*/
			}
        });
		
      });
	  //
	  
	  function table_search(){
		var cat_val = $("input.cat_check:checkbox:checked").map(function(){
		  return $(this).val();
		}).get(); 
		console.log(cat_val);
		//var cat_val =$("#dropdown-cat").val();
		var ethnicity = $("input.eth_check:checkbox:checked").map(function(){
		  return $(this).val();
		}).get(); 
		console.log(ethnicity);
		//var ethnicity=$("#select_eth").val();
		var gender=$("#inputGender").val();
		var nationality=$("#inputCountry").val();
		var age_val=$("#range_1").val();
		 var height_val=$("#range_2").val();
		 if($("#height_enable").is(':checked') && $("#age_enable").is(':checked')){
		 	age_val=$("#range_1").val();
		 	height_val=$("#range_2").val();
		 }
		else if($("#height_enable").is(':checked')){
			age_val="";
		 	height_val=$("#range_2").val();
		}
		else if($("#age_enable").is(':checked')){
			age_val=$("#range_1").val();
		 	height_val="";
		}
		else {
			age_val="";
		 	height_val="";
		}
			//alert("both");
			$('#example2').DataTable()
			.column(8).search(cat_val, true, true)
			.column(6).search(gender,false, false)
			.column(4).search(nationality,false, false)
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
	function enable_slide(obj){
		if($(obj).is(':checked')){
			$(obj).parent().next().hide();
		}
		else{
			$(obj).parent().next().show();
		}
		
	}
	 
    </script>
<?php /*?><link rel="stylesheet" href="plugins/select2/select2.min.css">
     <script src="plugins/select2/select2.full.min.js"></script>
     <script>
		  $(function () {
			//Initialize Select2 Elements
			$(".select2").select2();
		  })
	  </script><?php */?>
<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    

<?php ob_end_flush(); ?>