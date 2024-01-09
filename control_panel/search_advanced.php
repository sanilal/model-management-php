<?php $active="model"; ?>
<?php include_once('includes/header.php'); ?>

 <!-- Left side column. contains the sidebar -->
 <?php include_once('includes/side_bar.php'); ?>

<?php  
//ob_start();
include("includes/conn.php"); 

if(isset($_GET['p_id']) && isset($_GET['status']) ){
	
}

if(isset($_GET['remove_res'])){
	$id = $_GET['remove_res'];
	$pr_img_res=mysqli_fetch_object(mysqli_query($url,"select product_img,gallery_imgs from `".TB_pre."products` WHERE `product_id`='$id'"));
	$query = "DELETE FROM `".TB_pre."products` WHERE `product_id`='$id'";
	$r = mysqli_query($url, $query) or die(mysqli_error($url));
	unlink( "uploads/".$pr_img_res->product_img);
	$g_imgs=explode(",",$pr_img_res->gallery_imgs);
	foreach($g_imgs as $g_img){
		unlink( "uploads/".$g_img->product_img);
	}
	if($r){
		$msg = "The selected item deleted successfully.";
	}
}
//$sql="select * from `".TB_pre."Smart_FLC_Resource_Details` ORDER BY First_Name LIMIT 100 ";
//$r1=mysqli_query($url,$sql) or die("Failed".mysqli_error($url));

?>  
<style type="text/css">
hr{ margin:10px 0; clear:both;}
#range_2,#range_1{ display:none}
.opac_div{ opacity:0.5;filter:alpha(opacity=50); width:95%; margin-top:0; margin-left:40px; position:absolute; height:50px; background:#fff; z-index:10;}
</style>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Search Models & Talents
            <small></small>
          </h1>
          
       
          
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Advanced Search - Models</h3> 
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
                      </tr>
                    </thead>
                   
                    <tfoot>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
            <div class="box-footer">
            
            
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
    <!-- AdminLTE for demo purposes -->
     <script>
      $(function () {
        $('#example2').DataTable({
			"pageLength": 50,
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
                "targets": [ 0,2,6,7,8,9 ],
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
    <script type="text/javascript">
    function removeItem(id){
		var c= confirm("Do you want to remove this item?");
		<?php /*?>alert("Delete functinality temporarily disabled"); return false;<?php */?>
		if(c){
			location = "search_advanced.php?remove_res="+id;
		}
	}
	
    </script>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
     <script src="plugins/select2/select2.full.min.js"></script>
     <script>
		  $(function () {
			//Initialize Select2 Elements
			$(".select2").select2();
		  })
	  </script>
  </body>
</html>
<?php ob_end_flush(); ?>